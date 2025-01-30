@extends('main')

@section('content')
    <div class="container mx-auto px-6 py-12 max-w-screen-lg">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">All Todo Lists</h1>
        </div>

        @if($todoLists->isEmpty())
            <div class="text-center text-gray-600 mt-4">
                <p>No task lists available.</p>
            </div>
        @else
            <div class="mt-8">
                <ul class="space-y-4">
                    @foreach($todoLists as $todoList)
                        <li class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                            <a href="{{ route('todoLists.show', $todoList->id) }}"
                               class="text-lg font-medium text-blue-600 hover:text-blue-800">
                                {{ $todoList->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-10 flex justify-center">
            <a href="{{ route('todoLists.create') }}" class="w-1/2 sm:w-1/3 lg:w-1/3 py-4 px-8 bg-green-500 text-white
            rounded-xl flex items-center justify-center space-x-3 hover:bg-green-600 transition-all duration-300 ease-in-out shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="text-lg font-semibold">Create New Todo List</span>
            </a>
        </div>
    </div>
@endsection
