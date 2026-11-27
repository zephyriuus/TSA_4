@include('partials.header', [
    'title' => 'Create Task'
])

<section class="form-page">
    <div class="form-card">
        <h1>Create Task</h1>

        <p class="form-description">
            Add a new task to your task list.
        </p>

        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Task title</label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter task title"
                    required
                >
            </div>

            <div class="form-group">
                <label for="status">Status</label>

                <select id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="form-group">
                <label for="task_date">Task date</label>

                <input
                    id="task_date"
                    type="date"
                    name="task_date"
                    value="{{ old('task_date') }}"
                    required
                >
            </div>

            <div class="form-actions">
                <button class="submit-button" type="submit">
                    Create Task
                </button>

                <a class="cancel-button" href="{{ route('tasks.index') }}">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

@include('partials.footer')