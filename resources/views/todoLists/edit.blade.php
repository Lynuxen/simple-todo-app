@extends('main')

@section('content')
    <div class="container max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Edit Todo List Title</h1>

        <form action="{{ route('todoLists.update', $todoList->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="text-lg text-gray-700">Todo List Title</label>
                <input type="text" name="title"
                       class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       id="title" value="{{ old('title', $todoList->title) }}" required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('todoLists.show', $todoList->id) }}"
                   class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all duration-300 ease-in-out shadow-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Discard Changes
                </a>

                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 transition-all duration-300 ease-in-out shadow-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
