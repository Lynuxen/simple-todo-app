<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TodoList $todoList)
    {
        return view('tasks.create', compact('todoList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable|max:2048',
            'deadline' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(now())) {
                        $fail('The deadline must be today or a future date.');
                    }
                }
            ],
            'todo_list_id' => 'required|exists:todo_lists,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'todo_list_id' => $request->todo_list_id,
            'completed' => false,
        ]);

        $todoList = TodoList::findOrFail($request->todo_list_id);

        $todoList->completed = false;
        $todoList->save();

        return redirect()->route('todoLists.show', $task->todo_list_id)
            ->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        if (Carbon::parse($task->deadline)->isPast()) {
            return redirect()->route('tasks.show', $task->id)
                ->withErrors(['error' => 'This task cannot be edited because the deadline has passed.']);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:2048',
            'deadline' => 'required|date|after_or_equal:now',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Task updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $todoListId = $task->todo_list_id;

        $task->delete();

        $todoList = TodoList::findOrFail($todoListId);
        if ($todoList->tasks->isEmpty()) {
            $todoList->delete();
            return redirect()->route('todoLists.index')->with('success',
                'Task deleted and Todo List removed because it had no tasks left.');
        }

        return redirect()->route('todoLists.show', $todoListId)->with('success', 'Task deleted successfully.');
    }

    public function toggleCompletion(string $id)
    {
        $task = Task::findOrFail($id);

        if (Carbon::parse($task->deadline)->isPast()) {
            return back()->withErrors(['error' => 'This task cannot be updated because the deadline has passed.']);
        }

        $task->completed = !$task->completed;
        $task->update();

        $todoList = $task->list;

        if ($todoList) {
            $todoList->completed = $todoList->tasks->every(function ($task) {
                return $task->completed;
            });

            $todoList->save();
        }


        return back()->with('success', 'Task status updated successfully!');
    }
}
