@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kullanıcı Detayları</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Ad Soyad</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>E-posta</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rol</th>
                            <td>{{ $user->role->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Oluşturulma</th>
                            <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 