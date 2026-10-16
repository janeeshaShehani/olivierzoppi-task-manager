<div class="modal-header"><div><h2 id="createTitle">Add new task</h2><p>Fill in the details below. Only the title is required.</p></div></div>
<form action="{{ route('tasks.store') }}" method="POST" class="modal-form">
    @csrf
    <label for="create_title">Title <span>*</span></label>
    <input id="create_title" name="title" maxlength="255" required value="{{ old('title') }}" placeholder="e.g. Prepare monthly sales report">
    
    @error('title') <small class="field-error">{{ $message }}</small> @enderror
    
    <label for="create_description">Description</label>
    
    <textarea id="create_description" name="description" rows="4" placeholder="Add any notes or context">{{ old('description') }}</textarea>
    
    @error('description') <small class="field-error">{{ $message }}</small> @enderror
    
    <div class="modal-form-grid">
        <div><label for="create_due_date">Due date</label><input type="date" id="create_due_date" name="due_date" value="{{ old('due_date') }}">@error('due_date') <small class="field-error">{{ $message }}</small> @enderror</div>
        <div><label for="create_status">Status</label><select id="create_status" name="status" required>@foreach (['Pending', 'In Progress', 'Completed'] as $status)<option value="{{ $status }}" @selected(old('status', 'Pending') === $status)>{{ $status }}</option>@endforeach</select>@error('status') <small class="field-error">{{ $message }}</small> @enderror</div>
    </div>
    
    <div class="modal-actions"><button type="button" class="task-button task-button-light" onclick="closeTaskModal()">Cancel</button><button type="submit" class="task-button task-button-primary">Create task</button></div>
</form>
