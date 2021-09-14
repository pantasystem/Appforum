<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modeles\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function show(){

        $user = Auth::user();
        $icon_url = $user->avatar_icon_path;

        return view('pages.profile.index', compact('user', 'icon_url'));
    }
}
