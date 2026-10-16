
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Task Management System</title>
</head>
<body>

<header class="task-header">
    <div class="task-logo">
        <span>✓</span> Task Management System
    </div>

    <button
        type="button"
        class="task-button task-button-primary"
        onclick="window.openTaskModalUrl(window.taskModalUrls.create)">
        + New Task
    </button>
</header>

<main class="task-main">

    <div class="task-heading">
        <div>
            <h1>All Tasks</h1>
            <p class="task-muted">Manage and track your tasks in one place.</p>
        </div>

        <p class="task-muted">{{ $tasks->total() }} tasks in total</p>
    </div>

    @if (session('success'))
        <div class="task-message">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="task-message task-error-message">
            Please check the highlighted form errors.
        </div>
    @endif

    {{-- Search and status filter --}}
    <div class="task-panel">
        <form class="task-filters"
              action="{{ route('tasks.index') }}"
              method="GET">

            <input
                type="text"
                name="search"
                placeholder="Search tasks by title..."
                value="{{ request('search') }}">

            <select name="status">
                <option value="">All statuses</option>

                @foreach (['Pending', 'In Progress', 'Completed'] as $status)
                    <option
                        value="{{ $status }}"
                        @selected(request('status') === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>

            <input
                type="hidden"
                name="per_page"
                value="{{ $tasks->perPage() }}">

            <button
                class="task-button task-button-primary"
                type="submit">
                Search / Filter
            </button>

            <a
                class="task-button task-button-light"
                href="{{ route('tasks.index') }}">
                Clear
            </a>
        </form>
    </div>

    {{-- Tasks table --}}
    <div class="task-table-wrapper">
        <table class="task-table">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Created Date</th>
                    <th class="actions-heading">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        {{-- Task title --}}
                        <td class="task-name-cell">
                            <button
                                type="button"
                                class="task-title-button"
                                data-modal-url="{{ route('tasks.show', $task) }}"
                                onclick="openTaskModal(this)">
                                {{ $task->title }}
                            </button>

                            @if ($task->description)
                                <p>{{ $task->description }}</p>
                            @endif
                        </td>

                        {{-- Task status --}}
                        <td>
                            <span class="task-status {{ $task->status === 'Completed' ? 'status-completed' : ($task->status === 'In Progress' ? 'status-progress' : 'status-pending') }}">
                                {{ $task->status }}
                            </span>
                        </td>

                        {{-- Due date --}}
                        <td class="date-cell">
                            {{ $task->due_date?->format('d M Y') ?? 'Not set' }}
                        </td>

                        {{-- Created date --}}
                        <td class="date-cell">
                            {{ $task->created_at->format('d M Y') }}
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="task-actions">

                                {{-- View --}}
                                <button
                                    type="button"
                                    class="task-icon-button"
                                    title="View task"
                                    aria-label="View task"
                                    data-modal-url="{{ route('tasks.show', $task) }}"
                                     onclick="window.openTaskModal(this)">

                                    <svg viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>

                                {{-- Edit --}}
                                <button
                                    type="button"
                                    class="task-icon-button task-edit-icon"
                                    title="Edit task"
                                    aria-label="Edit task"
                                    data-modal-url="{{ route('tasks.edit', $task) }}"
                                    onclick="window.openTaskModal(this)">

                                    <svg viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                                    </svg>
                                </button>

                                {{-- Delete --}}
                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="task-icon-button task-delete-icon"
                                        type="submit"
                                        title="Delete task"
                                        aria-label="Delete task">

                                        <svg viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             aria-hidden="true">
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="m19 6-1 14H6L5 6"/>
                                            <path d="M10 11v5M14 11v5"/>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="table-empty">
                            <h3>No tasks found</h3>
                            <p>Try a different search or create a new task.</p>

                            <button
                                type="button"
                                class="task-button task-button-primary"
                                onclick="openTaskModalUrl(window.taskModalUrls.create)">
                                + Create Task
                            </button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="task-pagination">

        <div class="pagination-info">
            @if ($tasks->total() > 0)
                Showing {{ $tasks->firstItem() }}–{{ $tasks->lastItem() }}
                of {{ $tasks->total() }} tasks
            @else
                Showing 0 tasks
            @endif
        </div>

        <div class="pagination-controls">

            {{-- Rows per page --}}
            <form
                method="GET"
                action="{{ route('tasks.index') }}"
                class="per-page-form">

                @if (request('search'))
                    <input
                        type="hidden"
                        name="search"
                        value="{{ request('search') }}">
                @endif

                @if (request('status'))
                    <input
                        type="hidden"
                        name="status"
                        value="{{ request('status') }}">
                @endif

                <label for="per_page">Rows per page</label>

                <select
                    id="per_page"
                    name="per_page"
                    onchange="this.form.submit()">

                    @foreach ([5, 10, 15, 25] as $size)
                        <option
                            value="{{ $size }}"
                            @selected($tasks->perPage() === $size)>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
            </form>

            {{-- Page buttons --}}
            <div class="pagination-buttons">

                @if ($tasks->onFirstPage())
                    <span class="page-button disabled"
                          aria-disabled="true">‹</span>
                @else
                    <a class="page-button"
                       href="{{ $tasks->previousPageUrl() }}">‹</a>
                @endif

                @for ($page = 1; $page <= $tasks->lastPage(); $page++)
                    <a
                        class="page-button {{ $tasks->currentPage() === $page ? 'active' : '' }}"
                        href="{{ $tasks->url($page) }}"
                        @if ($tasks->currentPage() === $page)
                            aria-current="page"
                        @endif>
                        {{ $page }}
                    </a>
                @endfor

                @if ($tasks->hasMorePages())
                    <a class="page-button"
                       href="{{ $tasks->nextPageUrl() }}">›</a>
                @else
                    <span class="page-button disabled"
                          aria-disabled="true">›</span>
                @endif

            </div>
        </div>
    </div>

</main>

{{-- Modal container --}}
<div
    class="modal-overlay"
    id="taskModal"
    aria-hidden="true">

    <section
        class="task-modal"
        role="dialog"
        aria-modal="true"
        aria-label="Task details">

        <button
            type="button"
            class="modal-close"
            onclick="closeTaskModal()"
            aria-label="Close">
            ×
        </button>

        <div id="taskModalContent">
            <p>Loading...</p>
        </div>
    </section>
</div>


<script>
    window.taskModalUrls = {
        create: "{{ route('tasks.create') }}",
        index: "{{ route('tasks.index') }}"
    };
</script>


</body>
</html>
