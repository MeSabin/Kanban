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
        $tasks = Task::orderBy('position', 'asc')->get();
        return response()->json(['success' => true, 'message' => 'All tasks data', 'tasks' => $tasks], 200);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:70|unique:tasks,title',
            'description' => 'nullable|string|max:255',
            'priority' => 'nullable|in:Low,Medium,High',
            'status' => 'nullable|in:Not Started,In Progress,Done,Archived',
        ]);

        $data = $request->all();
        $taskCount = Task::count() ?? 0;
        $data['position'] = $taskCount + 1;

        if ($validation->fails()) {
            return response()->json(['error' => true, 'errors' => $validation->errors()], 422);
        }

        $task = Task::create($data);
        return response()->json(['success' => true, 'message' => 'Task created successfully', 'task' => $task], 201);
    }


    public function updatePositions(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'status' => 'required|in:Not Started,In Progress,Done,Archived',
            'tasks' => 'required|array',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => true, 'errors' => $validation->errors()], 422);
        }

        foreach ($request->tasks as $taskData) {
            $task = Task::find($taskData['id']);
            if ($task) {
                $task->status = $request->status;
                $task->position = $taskData['position'];
                $task->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Task positions updated successfully']);
    }


    public function destroy(string $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return response()->json(['success' => true, 'message' => 'Task deleted successfully'], 200);
        }
        return response()->json(['error' => true, 'message' => 'Task not found'], 404);
    }
}
