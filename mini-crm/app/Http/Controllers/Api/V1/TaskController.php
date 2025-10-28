<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;  


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Task::paginate(15), 200);
    }
    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return response()->json($task, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'due_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);
        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }
    public function update(Request $request, string $id)
    {
       
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'due_date' => 'sometimes|date',
            'status' => 'sometimes|string|max:255',
        ]);
        $task->update($validatedData);
        return response()->json([
            'success'=> true,
            'data'=>$task,
        ], 200);
    }
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
