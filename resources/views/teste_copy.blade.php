@extends('include.page')

@section('content')

<?php
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\People;







$questoes= ["questão 123", "questão 9393", "questão blablabla"];
$opcoes= ["opção A", "opção B", "opção C", "opção D"];

?>

<div class="container">
    <h1>Questões</h1>

<form action="respostas" method="get">

    <?php
    /* Ilustração do banco de dados.
    Em um banco de dados temos a tabela "questoes" configurada da seguinte forma:
    id-> integer
    questao-> varchar
    opcao1-> varchar
    opcao2-> varchar
    opcao3-> varchar
    opcao4-> varchar
    resposta-> varchar
    */
    
    //$pdo= new PDO($server, $database, $user, $password); //simulação de conexão com banco utilizando a biblioteca PDO
    

    try {
        $pdo= new PDO("mysql:host=localhost; dbname=inventories", 'root', 'root');
        echo "connect OK!!<br/>";
    } catch (PDOException $e) {
        echo "connect failed: ".$e->getMessage();
    }

    $sql= $pdo->query("select * from people limit 5");
    while ($row= $sql->fetch()) {
        echo "<p>".$row['first_name']."</p>";
        echo 
            "<input type='radio' name='".$row['id']."' value='".$row['first_name']."'>".$row['first_name']."<br/>
            
            <input type='radio' name='".$row['id']."' value='".$row['last_name']."'>".$row['last_name']."<br/>
            
            <input type='radio' name='".$row['id']."' value='".$row['address']."'>".$row['address']."<br/>
            
            <input type='radio' name='".$row['id']."' value='".$row['number']."'>".$row['number']."<br/><br/>";
    }
    ?>

    <input type='submit' value='Enviar Respostas'>
</form>




<?php

$sql02= $pdo->query("select * from people limit 5");

$rows= $sql02->fetchAll();
$i=0;
foreach ($rows as $key=> $value) {
    $user[$i]['id']= $key;
    $user[$i]['resposta']= $value['last_name'];
    $i++;
}


echo "<pre>";
print_r($user);
echo "</pre>";

?>














    <?php
    
        // foreach ($questoes as $questao) {
        //     echo "<p>$questao</p>";
        //     foreach($opcoes as $key=> $opcao) {
        //         echo 
        //             "<input type='radio' id='$key' name='opcao' value='$opcao'>$opcao<br/>";
        //     }
        //     echo "<br/>";
        // }

    ?>



</div>

@endsection

@section('script')

<script>

$("#submit").click( ()=> {
    event.preventDefault()
    console.log("eita...")
})

</script>

@endsection