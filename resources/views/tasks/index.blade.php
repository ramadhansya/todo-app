<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 30px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin: 10px 0;
        }
        .done {
            text-decoration: line-through;
            color: gray;
        }
    </style>
</head>
<body>

    <h1>To-Do List</h1>

    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task title" required>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        @foreach($tasks as $task)
            <li>
                <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" name="is_done" onchange="this.form.submit()" {{ $task->is_done ? 'checked' : '' }}>
                </form>
                
                <span class="{{ $task->is_done ? 'done' : '' }}">
                    {{ $task->title }}
                </span>

                <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>