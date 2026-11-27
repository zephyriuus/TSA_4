<h1>Task Completed</h1>

<p>The following task has been marked as done:</p>

<p>
    <strong>Task:</strong> {{ $task->title }}
</p>

<p>
    <strong>Date:</strong> {{ $task->task_date->format('F d, Y') }}
</p>

<p>
    This notification was generated automatically by the Tasks for Today Management System.
</p>