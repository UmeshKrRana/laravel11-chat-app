<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function dashboard(): View
    {
        $users = User::whereNot('id', Auth::user()->id)->withCount(['unreadMessages'])->get();
        return view('dashboard', compact('users'));
    }

    public function chatUser($userId)
    {
        return view('user-chat', compact('userId'));
    }
}
