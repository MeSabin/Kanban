<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Task</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded-lg border border-gray-300 w-96">
        <h2 class="text-lg font-semibold text-center text-gray-600 mb-4">Add New Task</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <label class="block text-gray-600 font-medium mb-1">Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border px-3 py-2 rounded">
            {{-- @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror --}}

            <label class="block text-gray-600 font-medium mt-4 mb-1">Description:</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>

            <label class="block text-gray-600 font-medium mt-4 mb-1">Priority:</label>
            <select name="priority" class="w-full border px-3 py-2 rounded">
                <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ old('priority', 'Medium') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
            </select>

            <label class="block text-gray-600 font-medium mt-4 mb-1">Status:</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="Not Started" {{ old('status', 'Not Started') == 'Not Started' ? 'selected' : '' }}>Not
                    Started</option>
                <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                <option value="Archived" {{ old('status') == 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>

            <button type="submit"
                class="bg-indigo-500 text-white px-4 py-2 rounded mt-4 w-full hover:bg-indigo-600 duration-300 cursor-pointer">
                Add Task
            </button>
        </form>
    </div>
</body>

</html>
