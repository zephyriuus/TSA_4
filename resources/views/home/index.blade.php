@include('partials.header', [
    'title' => 'Home'
])

<style>
    .home-page {
        padding: 50px 0;
    }

    .home-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .home-heading h1 {
        color: #75172d;
        font-size: 32px;
        font-weight: 700;
    }

    .home-description {
        margin-top: 8px;
        color: #ce4a4a;
    }

    .home-actions {
        display: flex;
        gap: 12px;
    }

    .home-button {
        display: inline-block;
        padding: 11px 18px;
        border-radius: 10px;
        background: #ce4a4a;
        color: white;
        font-weight: 700;
        text-decoration: none;
    }

    .home-button.secondary {
        background: #f7c95c;
        color: #5f4310;
    }

    .home-button:hover {
        opacity: 0.85;
    }

    .today-task-list {
        display: grid;
        gap: 18px;
    }

    .today-task-card {
        position: relative;
        padding: 24px;
        background: white;
        border: 3px solid #ffb8e3;
        border-radius: 20px;
        box-shadow: 0 5px 0 #f5d6e8;
    }

    .today-task-card h2 {
        max-width: 70%;
        margin-bottom: 10px;
        color: #75172d;
        font-size: 23px;
        font-weight: 700;
    }

    .today-task-date {
        color: #ce4a4a;
    }

    .today-status {
        position: absolute;
        top: 24px;
        right: 24px;
        padding: 7px 14px;
        border-radius: 999px;
        color: white;
        font-size: 13px;
        font-weight: 700;
    }

    .today-status.pending {
        background: #ff819c;
    }

    .today-status.done,
    .today-status.completed {
        background: #69b578;
    }

    .no-tasks {
        padding: 25px;
        background: white;
        border-radius: 15px;
        color: #ce4a4a;
    }

    @media (max-width: 700px) {
        .home-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .home-actions {
            flex-wrap: wrap;
        }

        .today-task-card h2 {
            max-width: 100%;
        }

        .today-status {
            position: static;
            display: inline-block;
            margin-top: 15px;
        }
    }
</style>

<section class="home-page">
    <div class="home-heading">
        <div>
            <h1>Today's Tasks</h1>
        </div>

        <div class="home-actions">
            <a class="home-button" href="{{ route('tasks.index') }}">
                View All Tasks
            </a>
        </div>
    </div>

    <section class="today-task-list">
        @forelse ($tasks as $task)
            <article class="today-task-card">
                <h2>{{ $task->title }}</h2>

                <p class="today-task-date">
                    Due: {{ $task->task_date->format('F d, Y') }}
                </p>

                <span class="today-status {{ strtolower($task->status) }}">
                    {{ ucfirst($task->status) }}
                </span>
            </article>
        @empty
            <p class="no-tasks">
                You have no tasks scheduled for today.
            </p>
        @endforelse
    </section>
</section>

@include('partials.footer')