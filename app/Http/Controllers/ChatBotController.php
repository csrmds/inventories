<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }


    public function getmenu()
    {
        DB::connection('mysql2')->select('use chatbot');
        $mainMenu= DB::connection('mysql2')->select('select * from main_menu');

        return json_encode($mainMenu);
    }

    public function setmenu(Request $request) 
    {   
        DB::connection('mysql2')->select('use chatbot');
        $itemMenu= $request->input('menuItem');

        $action= DB::connection('mysql2')->select("select * from actions where id='$itemMenu'");

        $command= $action[0]->command;

        $resp= shell_exec($command);

        return json_encode($resp);
        
    }

}
