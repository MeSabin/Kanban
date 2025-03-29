<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sprint Board</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-indigo-50 h-screen border border-red-400">
    <div class="border h-full p-4">
        <h1 class="text-xl text-gray-600 text-center font-bold mb-2">Sprint Board</h1>
        <p class="text-center text-gray-600 mb-6">Complete the tasks on time</p>

        <div class="flex justify-center gap-8">
            {{-- Not started --}}
            <div class="max-w-72 bg-white p-4 border border-gray-400 rounded-lg">
                <h2 class="text-sm font-semibold text-gray-600 mb-2 bg-gray-200 rounded-full px-2 inline-block">Not
                    Started</h2>
                <div class="bg-gray-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="bg-gray-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('task.create') }}"
                        class="border border-gray-400 py-1 px-2 w-full rounded text-gray-600 bg-gray-200 hover:bg-gray-300 duration-300 cursor-pointer">
                        <i class="fa-solid fa-plus text-gray-600"></i>
                        New task
                    </a>
                </div>
            </div>

            {{-- In Progress --}}
            <div class="max-w-72 bg-white p-4 border border-blue-400 rounded-lg">
                <h2 class="text-sm font-semibold text-blue-600 mb-2 bg-blue-200 rounded-full px-2 inline-block">In
                    Progress</h2>
                <div class="bg-blue-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="bg-blue-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('task.create') }}"
                        class="border border-blue-400 py-1 px-2 w-full rounded text-blue-600 bg-blue-200 hover:bg-blue-300 duration-300 cursor-pointer">
                        <i class="fa-solid fa-plus text-blue-600"></i>
                        New task
                    </a>
                </div>
            </div>

            {{-- Done --}}
            <div class="max-w-72 bg-white p-4 rounded-lg border border-green-400">
                <h2 class="text-sm font-semibold text-green-600 mb-2 bg-green-200 rounded-full px-2 inline-block">Done
                </h2>
                <div class="bg-green-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="bg-green-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('task.create') }}"
                        class="border border-green-400 py-1 px-2 w-full rounded text-green-600 bg-green-200 hover:bg-green-300 duration-300 cursor-pointer">
                        <i class="fa-solid fa-plus text-green-600"></i>
                        New task
                    </a>
                </div>
            </div>
            {{-- Archived --}}
            <div class="max-w-72 bg-white p-4 rounded-lg border border-gray-400">
                <h2 class="text-sm font-semibold text-gray-600 mb-2 bg-gray-200 rounded-full px-2 inline-block">Archived
                </h2>
                <div class="bg-gray-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="bg-gray-200 p-3 rounded mb-2">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-600">Invite team members</p>
                        <p class="text-gray-600 text-sm">Getting started with projects and tasks</p>
                    </div>
                    <span class="rounded text-white px-2 bg-red-400 mt-4">High</span>
                </div>
                <div class="mt-4 w-full">
                    <a href="{{ route('task.create') }}"
                        class="border border-gray-400 py-1 px-2 w-[100%] rounded text-gray-600 bg-gray-200 hover:bg-gray-300 duration-300 cursor-pointer">
                        <i class="fa-solid fa-plus text-gray-600"></i>
                        New task
                    </a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
