<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->id == $user->id) {
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }

        if (!$currentUser->following()->where('followed_id', $user->id)->exists()) {
            $currentUser->following()->attach($user->id);
        }

        return redirect()->back()->with('status', 'User followed successfully!');
    }

    public function unfollow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->following()->where('followed_id', $user->id)->exists()) {
            $currentUser->following()->detach($user->id);
        }

        return redirect()->back()->with('status', 'User unfollowed successfully!');
    }
}
