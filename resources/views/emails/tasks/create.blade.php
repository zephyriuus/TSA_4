@include('partials.header', [
    'title' => 'Create Task',
    'active' => 'tasks'
])

<style>
    .form-page {
        max-width: 650px;
        margin: 0 auto;
        padding: 40px 0;
    }

    .form-card {
        padding: 32px;
        background: white;
        border: 3px solid #ffb8e3;
        border-radius: 24px;
        box-shadow: 0 7px 0 #f5d6e8;
    }

    .form-card h1 {
        margin-bottom: 25px;
        color: #75172d;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        color: #75172d;
        font-weight: bold;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #f3b2d5;
        border-radius: 10px;
        font-size: 15px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .submit-button,
    .cancel-button {
        padding: 11px 18px;
        border: 0;
        border-radius: 10px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
    }

    .submit-button {
        background: #ce4a4a;
        color: white;
    }

    .cancel-button {
        background: #f7c95c;
        color: #5f4310;
    }

    .error-list {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-radius: 10px;
        background: #ffe0e0;
        color: #a93636;
    }
</style>

<section class="form-page">
    <div class="form-card">
        <h1>Create Task</h1>

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