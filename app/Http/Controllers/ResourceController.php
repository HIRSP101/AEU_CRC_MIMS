<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index() {
        return view('dashboard.partials.uploadpic');
    }

    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = 'test-'.time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
    }
}
