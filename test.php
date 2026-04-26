<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

$u = User::create(['nombre'=>'t', 'correo'=>'t@t.com', 'contrasena'=>Hash::make('12345678')]); 
dump(Auth::attempt(['correo'=>'t@t.com', 'password'=>'12345678']));
