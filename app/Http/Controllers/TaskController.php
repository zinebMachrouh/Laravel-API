<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);
        return response()->json([
            'status' => true,
            'tasks' => $tasks
        ]);
    }

    public function show(string $id)
    {
        $task = Task::find($id);
        return response()->json([
            'status' => true,
            'task' => $task
        ]);
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "Task Created Successfully!",
            'task' => $task
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task Not Found!'], 404);
        }
        $task->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Task Created Successfully!",
            'task' => $task
        ], 200);
    }

    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task Not Found!'], 404);
        }

        $task->delete();
        return response()->json([
            'message' => 'Task Deleted Successfully!'
        ]);
    }
}
