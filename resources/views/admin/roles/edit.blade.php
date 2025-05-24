@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rol Düzenle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Rol</label>
                            <select class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                <option value="">Rol Seçin</option>
                                <option value="Admin" {{ $role->name === 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ $role->name === 'User' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 