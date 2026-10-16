
<div class="modal-header">
    <div>
        <h2>Task details</h2>
        <p>Review the details of this task.</p>
    </div>
</div>

<div class="view-task-content">
    <div class="view-field">
        <span>Task title</span>
        <h3>{{ $task->title }}</h3>
    </div>

    <div class="view-field">
        <span>Description</span>
        <p>{{ $task->description ?? 'No description provided.' }}</p>
    </div>

    <div class="modal-form-grid">
        <div class="view-field">
            <span>Due date</span>
            <p>{{ $task->due_date?->format('d M Y') ?? 'Not set' }}</p>
        </div>

        <div class="view-field">
            <span>Status</span>
            <p>{{ $task->status }}</p>
        </div>
    </div>

    <div class="view-field">
        <span>Created date</span>
        <p>{{ $task->created_at->format('d M Y') }}</p>
    </div>

    <div class="modal-actions">
        <button
            type="button"
            class="task-button task-button-light"
            onclick="closeTaskModal()">
            Close
        </button>

        <button
            type="button"
            class="task-button task-button-primary"
            data-modal-url="{{ route('tasks.edit', $task) }}"
            onclick="window.openTaskModal(this)">
            Edit task
        </button>
    </div>
</div>
