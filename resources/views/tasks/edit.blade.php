@include('partials.header', [
    'title' => 'Edit Task'
])

<section class="form-page">
    <div class="form-card">
        <h1>Edit Task</h1>

        <p class="form-description">
            Update the details of this task.
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

        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Task title</label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    placeholder="Enter task title"
                    required
                >
            </div>

            <div class="form-group">
                <label for="status">Status</label>

                <select id="status" name="status" required>
                    <option
                        value="pending"
                        @selected(old('status', $task->status) === 'pending')
                    >
                        Pending
                    </option>

                    <option
                        value="done"
                        @selected(old('status', $task->status) === 'done')
                    >
                        Done
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="task_date">Task date</label>

                <input
                    id="task_date"
                    type="date"
                    name="task_date"
                    value="{{ old('task_date', $task->task_date->format('Y-m-d')) }}"
                    required
                >
            </div>

            <div class="form-actions">
                <button class="submit-button" type="submit">
                    Save Changes
                </button>

                <a class="cancel-button" href="{{ route('tasks.index') }}">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

@include('partials.footer')