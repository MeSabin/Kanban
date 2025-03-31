<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json(['success' => true, 'message' => 'All tasks data', 'tasks' => $tasks], 200);
    }

    public function create()
    {
        return view('tasks.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:70|unique:tasks,title',
            'description' => 'nullable|string|max:255',
            'priority' => 'nullable|in:Low,Medium,High',
            'status' => 'nullable|in:Not Started,In Progress,Done,Archived',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => true, 'errors' => $validation->errors()], 422);
        }

        $task = Task::create($request->all());
        return response()->json(['success' => true, 'message' => 'Task created successfully', 'task' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return response()->json(['success' => true, 'message' => 'Task deleted successfully'], 200);
        }
        return response()->json(['error' => true, 'message' => 'Task not found'], 404);
    }

    public function updateStatus(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'status' => 'required|in:Not Started,In Progress,Done,Archived',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => true, 'errors' => $validation->errors()], 422);
        }

        $task = Task::find($request->id);
        if ($task) {
            $task->status = $request->status;
            $task->save();
            return response()->json(['success' => true, 'message' => 'Task status updated successfully', 'task' => $task], 200);
        }
        return response()->json(['error' => true, 'message' => 'Task not found'], 404);
    }
}
