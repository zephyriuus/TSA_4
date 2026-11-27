<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>All Tasks</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #fff8f2;
            color: #75172d;
        }

        .container {
            width: min(92%, 1100px);
            margin: 0 auto;
        }

        header {
            margin-top: 28px;
            padding: 24px 32px;
            background: #fef9b7;
            border-radius: 25px;
            box-shadow: 0 7px 0 #fbdd95;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        header h1 {
            color: #ce4a4a;
            font-size: 38px;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav a {
            color: #ce4a4a;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #75172d;
        }

        main {
            padding: 48px 0;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .page-heading h2 {
            font-size: 30px;
        }

        .create-button {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 10px;
            background: #ce4a4a;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .create-button:hover {
            background: #a93636;
        }

        .success-message {
            margin-bottom: 20px;
            border-radius: 10px;
            color: #216b35;
            font-weight: bold;
            font-size: 18px;
        }

        .task-list {
            display: grid;
            gap: 18px;
        }

        .task-card {
            position: relative;
            padding: 24px;
            background: white;
            border: 3px solid #ffb8e3;
            border-radius: 20px;
            box-shadow: 0 5px 0 #f5d6e8;
        }

        .task-card h3 {
            max-width: 70%;
            margin-bottom: 10px;
            color: #75172d;
            font-size: 23px;
        }

        .task-date {
            color: #ce4a4a;
            margin-bottom: 15px;
        }

        .status {
            position: absolute;
            top: 24px;
            right: 24px;
            display: inline-block;
            padding: 7px 14px;
            border-radius: 999px;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        .status.pending {
            background: #ff819c;
        }

        .status.done,
        .status.completed {
            background: #69b578;
        }

        .task-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .edit-button,
        .archive-button {
            border: 0;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .edit-button {
            background: #f7c95c;
            color: #5f4310;
            text-decoration: none;
        }

        .archive-button {
            background: #e58b8b;
            color: white;
        }

        .edit-button:hover {
            background: #eab83e;
        }

        .archive-button:hover {
            background: #c96c6c;
        }

        .empty-message {
            padding: 25px;
            background: white;
            border-radius: 15px;
            color: #ce4a4a;
        }

        footer {
            padding: 25px 0 40px;
            text-align: center;
            color: #ce4a4a;
        }

        @media (max-width: 700px) {
            .header-top,
            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            header h1 {
                font-size: 30px;
            }

            nav {
                flex-wrap: wrap;
                gap: 12px;
            }

            .status {
                position: static;
                margin-top: 12px;
            }

            .task-card h3 {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="header-top">
                <h2>Astrelyx</h2>

                <nav>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('tasks.index') }}">Tasks</a>
                    <a href="{{ url('/profile') }}">Profile</a>
                    <a href="{{ route('about') }}">About</a>
                </nav>
            </div>
        </header>

        <main>
            @if (session('success'))
                <p class="success-message">
                    {{ session('success') }}
                </p>
            @endif

            <div class="page-heading">
                <h1>Task List</h1>

                @auth
                    <a class="create-button" href="{{ route('tasks.create') }}">
                        + Create Task
                    </a>
                @endauth
            </div>

            <section class="task-list">
                @forelse ($tasks as $task)
                    <article class="task-card">
                        <h3>{{ $task->title }}</h3>

                        <p class="task-date">
                            Due: {{ $task->task_date->format('F d, Y') }}
                        </p>

                        <span class="status {{ strtolower($task->status) }}">
                            {{ ucfirst($task->status) }}
                        </span>

                        @auth
                            <div class="task-actions">
                                <a
                                    class="edit-button"
                                    href="{{ route('tasks.edit', $task) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('tasks.destroy', $task) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="archive-button"
                                        type="submit"
                                    >
                                        Archive
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </article>
                @empty
                    <p class="empty-message">
                        No tasks found.
                    </p>
                @endforelse
            </section>
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} Tasks for Today</p>
        </footer>
    </div>
</body>
</html>