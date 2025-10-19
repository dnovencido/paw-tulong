@extends('layouts.app')

@php
    $layoutCss = 'manage_users.css';
    $layoutJs = 'admin.js';
    $page = 'manage_users';
@endphp

@section('content')
<div class="profile-box">
    <h2>Manage Users</h2>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->user_type }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <div class="actions">
                        <button type="button" class="button edit open-modal"
                            data-id="{{ $user->id }}"
                            data-username="{{ $user->username }}"
                            data-email="{{ $user->email }}"
                            data-type="{{ $user->user_type }}">
                            <i class="fas fa-pen"></i>
                        </button>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete" onclick="return confirm('Delete this user?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeX">&times;</span>
        <h2><i class="fas fa-pen"></i> Edit User</h2>
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">

            <div class="form-group">
                <label for="edit-username">Username:</label>
                <input type="text" name="username" id="edit-username" required>
            </div>

            <div class="form-group">
                <label for="edit-email">Email:</label>
                <input type="email" name="email" id="edit-email" required>
            </div>

            <div class="form-group">
                <label for="edit-type">User Type:</label>
                <select name="user_type" id="edit-type" required>
                    <option value="client">Client</option> 
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="edit-password">New Password (leave blank to keep current):</label>
                <input type="password" id="edit-password" name="password" placeholder="Enter new password">
            </div>

            <button type="submit" class="save-btn"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editModal');
    const openButtons = document.querySelectorAll('.open-modal');
    const closeModalBtn = document.getElementById('closeModal');
    const closeX = document.getElementById('closeX');
    const editForm = document.getElementById('editForm');
    const baseUpdateUrl = @json(url('admin/manage-users'));

    openButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-username').value = btn.dataset.username;
            document.getElementById('edit-email').value = btn.dataset.email;
            document.getElementById('edit-type').value = btn.dataset.type;
            editForm.action = `${baseUpdateUrl}/${id}`;
            modal.style.display = 'flex';
        });
    });

    function hideModal() { modal.style.display = 'none'; }

    if (closeModalBtn) closeModalBtn.addEventListener('click', hideModal);
    closeX.addEventListener('click', hideModal);

    window.addEventListener('click', function(event) {
        if (event.target === modal) hideModal();
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') hideModal();
    });
});
</script>
@endpush
