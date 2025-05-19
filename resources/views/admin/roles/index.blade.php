@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Roller</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Rol
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rol</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                @if($role && $role->name === 'Admin')
                                    @php $admins = \App\Models\User::where('is_admin', 1)->get(); @endphp
                                    @if($admins->count() > 0)
                                        @foreach($admins as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>Admin<br><span class="text-muted small"><i class="fas fa-user"></i> {{ $user->name }} ({{ $user->email }})</span></td>
                                                <td>
                                                    <form action="{{ route('admin.admins.remove', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $user->name }} admin yetkisi kaldırılsın mı?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-user-slash"></i> Adminliği Kaldır
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td colspan="2">
                                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Tüm adminleri kaldırıp Admin rolünü silmek istediğinize emin misiniz?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Admin Rolünü Sil
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>Admin<br><span class="text-muted small">Hiç admin yok</span></td>
                                            <td>
                                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu rolü silmek istediğinize emin misiniz?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Sil
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @elseif($role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu rolü silmek istediğinize emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Sil
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 