<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function search(Request $request)
    {
        $search = $request->input('search'); 
        if ($search){
        $users = User::query()
            ->where('username', 'ILIKE', "%{$search}%") 
            ->orWhere('email', 'ILIKE', "%{$search}%") 
            ->get();

    } else {
        $users = User::all();
    }
    return view('friendRequest', compact('users'));
}

}
