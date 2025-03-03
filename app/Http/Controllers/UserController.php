<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function search(Request $request)
    {
        $search = $request->input('search'); 
    
        if ($search) {
            $users = User::query()
                ->where('username', 'ILIKE', "%{$search}%")
                ->orWhere('email', 'ILIKE', "%{$search}%")
                ->get();
    
            if ($users->isEmpty()) {
                return view('userList', [
                    'message' => 'No users found.',
                    'users' => []
                ]);
            }
        } else {
            return view('userList', [
                'message' => 'Type something to find your future friend.',
                'users' => []
            ]);
        }
    
        return view('userList', compact('users'));
    }
    
}
