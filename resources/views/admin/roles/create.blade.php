@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yeni Rol Oluştur</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Rol</label>
                            <select class="form-control @error('name') is-invalid @enderror" id="role-select" name="name" required>
                                <option value="">Rol Seçin</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" id="user-list-group" style="display:none;">
                            <label>Kullanıcılar (Admin yapmak için seçin)</label>
                            <div class="border rounded p-2" style="max-height:200px;overflow-y:auto;">
                                @foreach($users as $user)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="user_ids[]" value="{{ $user->id }}" id="user-{{ $user->id }}">
                                        <label class="form-check-label" for="user-{{ $user->id }}">
                                            {{ $user->name }} ({{ $user->email }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Oluştur</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role-select');
        const userListGroup = document.getElementById('user-list-group');
        function toggleUserList() {
            if (roleSelect.value === 'Admin') {
                userListGroup.style.display = '';
            } else {
                userListGroup.style.display = 'none';
            }
        }
        roleSelect.addEventListener('change', toggleUserList);
        toggleUserList();
    });
</script>
@endpush 