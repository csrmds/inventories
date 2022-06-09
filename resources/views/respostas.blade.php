@extends('include.page')

@section('content')

<?php

try {
    $pdo= new PDO("mysql:host=localhost; dbname=inventories", 'root', 'root');
    echo "connect OK!!<br/>";
} catch (PDOException $e) {
    echo "connect failed: ".$e->getMessage();
}

//uma query para selecionar as respostas corretas 
//cadastradas no banco
$sql= $pdo->query("select * from people limit 5");
$rows= $sql->fetchAll();

$i=1;
foreach ($rows as $key=> $value) {
    $respostas[$i]['id']= $key;
    $respostas[$i]['resposta']= $value['last_name'];
    $i++;
}


//Nesse laço, é verificado se as respostas recebidas pelo usuário
//através do método POST, estão iguais as respostas do banco
foreach ($_GET as $id=> $value) {
    if ($respostas[$id]['resposta']== $value) {
        echo 
            "Questão nº $id: Resposta correta.<br/>".
            $value."<br/><br/>";
    } else {
        echo 
            "Questão nº $id: Resposta incorreta.<br/>".
            $value."<br/><br/>";
    }
}

?>

@endsection