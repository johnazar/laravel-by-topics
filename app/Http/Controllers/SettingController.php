<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $notifications =auth()->user()->notifications->whereNull('read_at')?? [];
        return view('settings.index',compact('notifications'));
    }

    public function markNotification(Request $request)
    {
        auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

        return response()->noContent();

    }
}
