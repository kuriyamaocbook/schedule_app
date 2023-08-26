<?php
// app/Http/Controllers/UsersController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // ユーザー名で検索
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('list', compact('users'));
    }
}
