<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sprint Board</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-indigo-50 h-screen border border-red-400">
    <div class="border h-full p-4">
        <h1 class="text-xl text-gray-600 text-center font-bold mb-2">Sprint Board</h1>
        <p class="text-center text-gray-600 mb-6">Complete the tasks on time</p>

        <div class="flex justify-center gap-8">
            <!-- Task Columns -->
            <div class="task-column w-72 p-4 border border-gray-400 rounded-lg bg-gray-100" data-status="Not Started">
                <h2 class="text-sm font-semibold text-gray-600 mb-2 bg-gray-200 rounded-full px-2 inline-block">Not
                    Started</h2>
                <div class="tasks-container mb-4 min-h-[50px]"></div>
                <a href="{{ route('task.create') }}"
                    class="border border-gray-400 py-1 px-2 w-full rounded text-gray-600 bg-gray-200 hover:bg-gray-300 duration-300 cursor-pointer">
                    <i class="fa-solid fa-plus text-gray-600"></i> New task
                </a>
            </div>

            <div class="task-column w-72 bg-blue-100 p-4 border border-blue-400 rounded-lg" data-status="In Progress">
                <h2 class="text-sm font-semibold text-blue-600 mb-2 bg-blue-200 rounded-full px-2 inline-block">In
                    Progress</h2>
                <div class="tasks-container mb-4 min-h-[50px]"></div>
                <a href="{{ route('task.create') }}"
                    class="border border-blue-400 py-1 px-2 w-full rounded text-blue-600 bg-blue-200 hover:bg-blue-300 duration-300 cursor-pointer">
                    <i class="fa-solid fa-plus text-blue-600"></i> New task
                </a>
            </div>

            <div class="task-column w-72 bg-green-100 p-4 rounded-lg border border-green-400" data-status="Done">
                <h2 class="text-sm font-semibold text-green-600 mb-2 bg-green-200 rounded-full px-2 inline-block">Done
                </h2>
                <div class="tasks-container mb-4 min-h-[50px]"></div>
                <a href="{{ route('task.create') }}"
                    class="border border-green-400 py-1 px-2 w-full rounded text-green-600 bg-green-200 hover:bg-green-300 duration-300 cursor-pointer">
                    <i class="fa-solid fa-plus text-green-600"></i> New task
                </a>
            </div>

            <div class="task-column w-72 bg-gray-100 p-4 rounded-lg border border-gray-400" data-status="Archived">
                <h2 class="text-sm font-semibold text-gray-600 mb-2 bg-gray-200 rounded-full px-2 inline-block">Archived
                </h2>
                <div class="tasks-container mb-4 min-h-[50px]"></div>
                <a href="{{ route('task.create') }}"
                    class="border border-gray-400 py-1 px-2 w-full rounded text-gray-600 bg-gray-200 hover:bg-gray-300 duration-300 cursor-pointer">
                    <i class="fa-solid fa-plus text-gray-600"></i> New task
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/api/tasks')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let tasks = data.tasks;

                        tasks.forEach(task => {
                            let container = document.querySelector(
                                `[data-status="${task.status}"] .tasks-container`);
                            if (container) {
                                let taskDiv = document.createElement('div');
                                taskDiv.className =
                                    "p-3 border border-gray-400 rounded mb-2 bg-gray-200 task-item cursor-move";
                                taskDiv.setAttribute("data-id", task.id);
                                taskDiv.setAttribute("data-position", task.position);

                                taskDiv.innerHTML = `
                            <div class="mb-2">
                                <p class="font-semibold text-gray-600">${task.title}</p>
                                <p class="text-gray-600 text-sm">${task.description || ''}</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <span class="rounded text-white px-2 bg-gray-400">${task.priority}</span>
                                <i class="fa-solid delete-btn text-red-500 fa-trash cursor-pointer" title="Delete"></i>
                            </div>
                        `;

                                // delete task
                                taskDiv.querySelector('.delete-btn').addEventListener('click',
                                    function() {
                                        if (confirm("Do you really want to delete this task?")) {
                                            fetch(`/api/tasks/${task.id}`, {
                                                    method: 'DELETE'
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        taskDiv.remove();
                                                        updatePositions(container);
                                                    }
                                                })
                                                .catch(error => console.error('Error:', error));
                                        }
                                    });

                                container.appendChild(taskDiv);
                            }
                        });

                        // sortable js for all columns
                        document.querySelectorAll(".tasks-container").forEach(container => {
                            new Sortable(container, {
                                group: "tasks",
                                animation: 150,
                                onEnd: function(evt) {
                                    let newStatus = evt.to.closest(".task-column")
                                        .getAttribute("data-status");
                                    updatePositions(evt.to, newStatus);
                                }
                            });
                        });

                        // update task order(position within the column)
                        function updatePositions(container, newStatus = null) {
                            let tasks = [...container.children].map((task, index) => ({
                                id: task.getAttribute("data-id"),
                                position: index + 1
                            }));

                            fetch(`/api/tasks/update-positions`, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    status: newStatus || container.closest(".task-column")
                                        .getAttribute("data-status"),
                                    tasks: tasks
                                })
                            }).catch(error => console.error("Task update error:", error));
                        }
                    }
                })
                .catch(error => console.error("Task fetch error:", error));
        });
    </script>

</body>

</html>
