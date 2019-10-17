<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.index', compact('users'));
    }
    public function edit($id){
        $user = User::find($id);
        return view('admin.edit')->with('user', $user);
    }
}
