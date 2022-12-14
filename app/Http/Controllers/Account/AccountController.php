<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AccountController extends Controller
{
 
    //fonction t'retourner view ta3 la page profile d'utilisateur,
   public function index()
    {
        return view('account.index');
    }
    
    //fonction li t'handli le formulaire qui modifie user data
    public function updateUserData(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.auth()->user()->id,
            'address' => 'required|string',
            'bankcard' => 'string',
        ]);
        $user = auth()->user();
        $user->fname = $request->fname;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->bankcard = $request->bankcard;
        $user->save();
        return redirect()->back()->with('success', 'Profile has been updated successfully!');
    }

    //fonction t'modifier le mot de passe , lazem ykun fiha le mdp courant correct,
    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string',
            'cn_password' => 'required|string|same:password',
        ]);
        $user = auth()->user();
        if(!\Hash::check($request->current_password, $user->password))
        {
            return redirect()->back()->withErrors(['current_password'=>'mot de passe ghalet']);
        }
        $user->password = \Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Password has been updated successfully!');
    }

    //fonction t'retourni view ta3 la page commandes , w rani nb3et fiha ga3 orders ta3 l'user comme data,
    public function orders()
    {
        $orders =Order::where('user_id',auth()->user()->id)->paginate(10);
        return view('account.orders', ['orders'=>$orders]);
    }
 
}
