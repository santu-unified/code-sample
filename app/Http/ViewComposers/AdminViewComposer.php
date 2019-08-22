<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\User;
use Auth;

class AdminViewComposer {

    public function compose(View $view) {
    	$user = Auth::guard('admin')->user();
    	$user = User::where('id', $user->id)->first();
    	$profilePhoto = $user->profileImage->imagePath();
    	$userName = $user->name;
        $view->with(compact('userName','profilePhoto'));
    }
}