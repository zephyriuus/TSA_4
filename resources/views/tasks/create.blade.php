@include('partials.header', [
    'title' => 'Create Task',
    'active' => 'tasks'
])

<section class="hero">
    <h1>Create Task</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <label>Task title</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label>Status</label>
        <select name="status" required>
            <option value="pending">Pending</option>
            <option value="done">Done</option>
        </select>

        <label>Task date</label>
        <input type="date" name="task_date" value="{{ old('task_date') }}" required>

        <button type="submit">Create Task</button>
    </form>
</section>

@include('partials.footer')