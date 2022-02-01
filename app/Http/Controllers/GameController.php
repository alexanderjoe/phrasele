<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('admin.addphrase');
    }

    public function store(Request $request)
    {
        $request->validate([
           'phrase' => 'required|min:3|max:16',
           'password' => 'required'
        ]);

        if($request->password != config('app.password')) {
            return back();
        }

        $solution = collect(str_split("Hello World"))->map(function ($word) {
            if($word == " ") {
                return "";
            } else {
                return strtoupper($word);
            }
        });

        Solution::create([
            'solution' => json_encode($solution),
            'starts_at' => now()->addHour(),
            'max_attempts' => 6
        ]);

        return back()->with(['message' => 'New Phrase Added']);
    }
}
