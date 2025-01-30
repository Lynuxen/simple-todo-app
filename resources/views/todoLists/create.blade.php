@extends('main')

@section('content')
    <div class="container max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Create New Todo List</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('todoLists.store') }}" method="POST">
            @csrf

            <div class="flex justify-between mt-4">
                <a href="{{ route('todoLists.index') }}"
                   class="inline-flex items-center gap-2 px-14 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all duration-300 ease-in-out shadow-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Cancel
                </a>

                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 transition-all duration-300 ease-in-out shadow-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Create Task List
                </button>
            </div>

            <div class="form-group mb-4">
                <label for="title" class="text-lg text-gray-700">Title</label>
                <input type="text" name="title"
                       class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       id="title" value="{{ old('title') }}" placeholder="Enter todo list title" required>
                @error('title')
                <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="tasks" class="text-lg text-gray-700">Tasks</label>
                <div id="tasks" class="space-y-4">
                    <div class="task flex items-start justify-between" id="task-0">
                        <div class="flex-1">
                            <input type="text" name="tasks[0][title]"
                                   class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Task Title" value="{{ old('tasks[0][title]') }}" required>
                            <textarea name="tasks[0][description]"
                                      class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2"
                                      placeholder="Task Description">{{ old('tasks[0][description]') }}</textarea>
                            <input type="datetime-local" name="tasks[0][deadline]"
                                   class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2"
                                   value="{{ old('tasks[0][deadline]') }}" required>
                        </div>
                        <button type="button" class="remove-task-btn text-red-600 hover:text-red-800 mt-2 ml-4"
                                onclick="removeTask(0)" style="display: none;">Remove
                        </button>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button type="button" id="addTask"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400 transition block mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Add Another Task
                    </button>
                </div>

                @error('tasks')
                <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </div>

    <script>
        let taskCount = 1;
        document.getElementById('addTask').addEventListener('click', function () {
            const tasksDiv = document.getElementById('tasks');
            const newTask = document.createElement('div');
            newTask.classList.add('task', 'flex', 'items-start', 'justify-between');
            newTask.id = `task-${taskCount}`;
            newTask.innerHTML = `
            <div class="flex-1">
                <input type="text" name="tasks[${taskCount}][title]" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Task Title">
                <textarea name="tasks[${taskCount}][description]" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2" placeholder="Task Description"></textarea>
                <input type="datetime-local" name="tasks[${taskCount}][deadline]" class="form-control w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
            </div>
            <button type="button" class="remove-task-btn text-red-600 hover:text-red-800 mt-2 ml-4" onclick="removeTask(${taskCount})">Remove</button>
        `;
            tasksDiv.appendChild(newTask);
            taskCount++;
            toggleRemoveButton();
        });

        function removeTask(taskId) {
            const taskElement = document.getElementById(`task-${taskId}`);
            taskElement.remove();
            toggleRemoveButton();
        }

        function toggleRemoveButton() {
            const removeButtons = document.querySelectorAll('.remove-task-btn');
            if (removeButtons.length <= 1) {
                removeButtons.forEach(button => button.style.display = 'none');
            } else {
                removeButtons.forEach(button => button.style.display = 'inline-block');
            }
        }

        toggleRemoveButton();
    </script>
@endsection
