<div class="modal-header"><div><h2 id="editTitle">Edit task</h2><p>Update the task details below.</p></div></div>

<form action="{{ route('tasks.update', $task) }}" method="POST" class="modal-form">

@csrf @method('PUT')
    <label for="edit_title">Title <span>*</span></label>
    <input id="edit_title" name="title" maxlength="255" required value="{{ old('title', $task->title) }}">

    @error('title') <small class="field-error">{{ $message }}</small> @enderror
    <label for="edit_description">Description</label>
    <textarea id="edit_description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>

    @error('description') <small class="field-error">{{ $message }}</small> @enderror
    <div class="modal-form-grid">
        <div><label for="edit_due_date">Due date</label><input type="date" id="edit_due_date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">@error('due_date') <small class="field-error">{{ $message }}</small> @enderror</div>
        <div><label for="edit_status">Status</label><select id="edit_status" name="status" required>@foreach (['Pending', 'In Progress', 'Completed'] as $status)<option value="{{ $status }}" @selected(old('status', $task->status) === $status)>{{ $status }}</option>@endforeach</select>@error('status') <small class="field-error">{{ $message }}</small> @enderror</div>
    </div>

    <div class="modal-actions"><button type="button" class="task-button task-button-light" onclick="closeTaskModal()">Cancel</button><button type="submit" class="task-button task-button-primary">Save changes</button></div>
</form>
