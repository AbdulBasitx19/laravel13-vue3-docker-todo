<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Todos retrieved successfully.',
            'data'    => $todos
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'title'        => $validated['title'],
            'is_completed' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Todo created successfully.',
            'data'    => $todo
        ], 201);
    }

    public function update($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        return response()->json([
            'success' => true,
            'message' => 'Todo status updated successfully.',
            'data'    => $todo
        ], 200);
    }

    public function destroy($id)
    {
        // Finding record and deleting
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Todo deleted successfully.',
            'data'    => null
        ], 200);
    }
}