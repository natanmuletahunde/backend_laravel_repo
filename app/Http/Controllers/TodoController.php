<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        $path = $request->file('img')->store('images', 'public');

        $todo = Todo::create([
            'name' => $request->name,
            'img' => $path,
            'description' => $request->description,
        ]);

        return response()->json($todo, 201);
    }
}