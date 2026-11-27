@include('partials.header', [
    'title' => 'Edit Task',
    'active' => 'tasks'
])

<section class="hero">
    <h1>Edit Task</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <label>Task title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title) }}"
            required
        >

        <label>Status</label>
        <select name="status" required>
            <option value="pending" @selected(old('status', $task->status) === 'pending')>
                Pending
            </option>
            <option value="done" @selected(old('status', $task->status) === 'done')>
                Done
            </option>
        </select>

        <label>Task date</label>
        <input
            type="date"
            name="task_date"
            value="{{ old('task_date', $task->task_date->format('Y-m-d')) }}"
            required
        >

        <button type="submit">Update Task</button>
    </form>
</section>

@include('partials.footer')