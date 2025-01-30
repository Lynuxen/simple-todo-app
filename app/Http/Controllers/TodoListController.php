<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todoLists = TodoList::all();

        return view('todoLists.index', ['todoLists' => $todoLists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todoLists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'tasks' => 'required|array|min:1',
            'tasks.*.title' => 'required|max:255',
            'tasks.*.description' => 'max:2048',
            'tasks.*.deadline' => 'required|date|after_or_equal:now',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $todoList = new TodoList();
        $todoList->title = $validated['title'];
        $todoList->completed = false;
        $todoList->save();

        foreach ($validated['tasks'] as $taskData) {
            $task = new Task();
            $task->title = $taskData['title'];
            $task->description = $taskData['description'];
            $task->deadline = $taskData['deadline'];
            $task->completed = false;
            $task->todo_list_id = $todoList->id;
            $task->save();
        }

        return redirect()->route('todoLists.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todoList = TodoList::with(['tasks' => function ($query) {
            $query->orderBy('id');
        }])->findOrFail($id);

        return view('todoLists.show', compact('todoList'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $todoList = TodoList::findOrFail($id);
        return view('todoLists.edit', compact('todoList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todoList = TodoList::findOrFail($id);
        $todoList->title = $request->title;
        $todoList->update();

        return redirect()->route('todoLists.show', $todoList->id)
            ->with('success', 'Todo List title updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todoList = TodoList::findOrFail($id);

        $todoList->tasks()->delete();
        $todoList->delete();

        return redirect()->route('todoLists.index')->with('success', 'Task list and its tasks deleted successfully.');
    }
}
