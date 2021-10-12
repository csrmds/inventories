<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        $groups= Group::all();

        return view('group.index', compact('groups'));
    }

    public function create(Request $request)
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function search(Request $request)
    {
        $data= $request->all();
        $groups= DB::table('groups')->where('name', 'like', $data['word'].'%')->get();

        return json_encode($groups);
    }

    public function getById(Request $request)
    {
        $data= $request->all();
        $group= (new Group)->find($data['id']);

        return json_encode($group);
    }

    public function all()
    {
        $group= Group::all();

        return json_encode($group);
    }

    public function getByTable(Request $request)
    {
        $data= $request->all();
        $groups= DB::table('groups')->where('table', $data['word'])->get();

        return json_encode($groups);
    }

}
