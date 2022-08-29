<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //fonction treje3 page utilisateurs f admin dashboard, w fiha ga3 users
    public function index(Request $request)
    {
        //
        $users = User::all();

        return view('admin.users.index',['users'=>$users]);
    }

    //fonction treje3 page de creation d'un user
    public function create(Request $request)
    {
        //
        return view('admin.users.add');
    }

    //fonction li t'creei le user lui meme , t'handli formulaire li f la page ta3 creation
    public function store(Request $request)
    {
        //
        $request->validate([
            'fname' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id'=> 'required',
            'address'=> 'required',
        ]);
            $data = $request->all();
            $data['password']=Hash::make($request->password);
           
            User::create($data);
   
             
        return redirect("/admin/users")->withSuccess('Great! User created');

    }


    //treje3 la page de modification d'un user
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        return view('admin.users.edit',['user'=>$user]);


    }

    //fonction li t'handli lform ta3 modification, tjib les donnees w t'modifier la ligne f la bdd
    public function update(Request $request, $id)
    {
        //
       
        $request->validate([
            'fname' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'role_id'=> 'required',
            'address'=> 'required',
        ]);

        $user=User::findOrFail($id);

        if($user->email!=$request->email && User::where('email',$request->email)->where('id','!=',$id)->exists()){
            return redirect()->back()->withErrors(['email'=>'Email already exists']);
        }

        $data = $request->all();
        if($request->password){
            $data['password']=Hash::make($request->password);
        }else{
            $data['password']=$user->password;
        }
           
        $user->update($data);
             
        return redirect("/admin/users")->withSuccess('Great! User updated');

    }

    //fonction t'supprimi un user b son id
      public function destroy($id)
    {
        //
        $user=User::findOrFail($id);

        if($user){
            $user->delete();
            return redirect("/admin/users")->withSuccess('Great! User deleted');
        }

        return redirect("/admin/users")->withError('Error! User not found');
    }
  

    //fonction t'bloqui l'user,
    public function block($id)
    {
        //
        $user = User::findOrFail($id);
        $user->update([
            'is_blocked'=> !$user->is_blocked
        ]);
        return redirect("/admin/users")->withSuccess('Great! User Unblocked');
    }

}
