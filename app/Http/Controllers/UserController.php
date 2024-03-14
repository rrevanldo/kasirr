<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $userAccounts = User::paginate(10);
        return view("pages.user.index", compact("userAccounts"));
    }
    public function create()
    {
        return view("pages.user.create");
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view("pages.user.edit", compact("user"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "password" => "required"
        ]);
        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "password" => bcrypt($request->password)
        ]);

        if ($request->role == "administrator") {
            $user->assignRole("administrator");
        }
        $user->assignRole("petugas");

        return redirect("/user")->with("success", "Berhasil membuat account baru");
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
        ]);
        $user = User::find($id);
        
        
        $user->update([
            "name" => $request->name,
            "username" => $request->username,
        ]);
        $user->syncRoles([]);
        $user->assignRole($request->role);

        return back()->with("success", "Berhasil merubah akun");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with("success", "Berhasil menghapus akun");
    }
}
