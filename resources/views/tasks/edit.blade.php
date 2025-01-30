@extends('main')

@section('content')
    <div class="container max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Edit Task</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="text-lg text-gray-700">Task Title</label>
                <input type="text"
                       class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       id="title" name="title" value="{{ old('title', $task->title) }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="text-lg text-gray-700">Description</label>
                <textarea
                    class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="deadline" class="text-lg text-gray-700">Deadline</label>
                <input type="datetime-local"
                       class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       id="deadline" name="deadline"
                       value="{{ old('deadline', \Carbon\Carbon::parse($task->deadline)->format('Y-m-d\TH:i')) }}"
                       required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('todoLists.show', $task->todo_list_id) }}"
                   class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all duration-300 ease-in-out shadow-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Discard Changes
                </a>

                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600 transition-all duration-300 ease-in-out shadow-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Update Task
                </button>
            </div>
        </form>
    </div>
@endsection
