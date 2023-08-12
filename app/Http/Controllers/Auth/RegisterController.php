<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\AnotherUser; // モデル名を変更したため、別のモデルを指定
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:another_users'], // テーブル名を変更したため変更
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'family_role' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return AnotherUser::create([ // モデル名を変更したため変更
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'family_role' => $data['family_role'],
        ]);
    }
}
