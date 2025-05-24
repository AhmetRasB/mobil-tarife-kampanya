@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SMS Kayıtları</h3>
                    <div class="card-tools">
                        <a href="{{ route('sms-logs.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni SMS Kaydı
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
                                <th>SIM Kart</th>
                                <th>Alıcı</th>
                                <th>Mesaj</th>
                                <th>Tarih</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($smsLogs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>
                                        @if($log->simCard)
                                            <a href="{{ route('sim-cards.show', $log->simCard) }}">
                                                {{ $log->simCard->numara }}
                                            </a>
                                        @else
                                            <span class="text-muted">Silinmiş SIM Kart</span>
                                        @endif
                                    </td>
                                    <td>{{ $log->alici }}</td>
                                    <td>{{ Str::limit($log->mesaj, 50) }}</td>
                                    <td>{{ $log->tarih->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $log->durum === 'gonderildi' ? 'success' : 'danger' }}">
                                            {{ ucfirst($log->durum) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('sms-logs.show', $log) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('sms-logs.edit', $log) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sms-logs.destroy', $log) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Emin misiniz?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $smsLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 