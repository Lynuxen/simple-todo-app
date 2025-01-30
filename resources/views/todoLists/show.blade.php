@extends('main')

@section('content')
    <div class="container max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Todo List Details</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('todoLists.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400 transition-all ease-in-out shadow-lg text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                </svg>
                Back to Todo Lists
            </a>
        </div>

        <div class="task-details p-4 bg-gray-100 rounded-lg">
            <h3 class="text-2xl font-semibold text-gray-700">{{ $todoList->title }}</h3>
            <p class="mt-2 text-lg text-gray-600">
                <strong>Status:</strong>
                @if($todoList->isCompleted())
                    <span class="text-green-600 font-semibold">Completed</span>
                @else
                    <span class="text-red-600 font-semibold">Not Completed</span>
                @endif
            </p>
        </div>

        <div class="flex justify-center gap-4 mt-6">
            <a href="{{ route('todoLists.edit', $todoList->id) }}"
               class="btn btn-warning flex items-center gap-2 px-4 py-2 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                </svg>
                Edit Todo List Title
            </a>

            <a href="{{ route('tasks.create', $todoList->id) }}"
               class="btn btn-primary flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Add New Task
            </a>
        </div>

        <h4 class="text-lg font-semibold mt-6">Tasks:</h4>
        @if($todoList->tasks->isEmpty())
            <p class="text-gray-600">No tasks available for this todo list.</p>
        @else
            <ul class="mt-4 space-y-2">
                @foreach($todoList->tasks as $task)
                    <li class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        <a href="{{ route('tasks.show', $task->id) }}"
                           class="text-lg text-blue-600 hover:text-blue-800">
                            {{ $task->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-8 flex justify-center">
            <form action="{{ route('todoLists.destroy', $todoList->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this task list and all associated tasks?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-danger flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                    Delete Todo List
                </button>
            </form>
        </div>
    </div>
@endsection
