@extends(Auth::user() && Auth::user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('title', 'Aboneler')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Aboneler</h3>
                </div>
                <div class="card-body">
                    @if(count($abonelikler) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Müşteri Adı</th>
                                        <th>Telefon</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abonelikler as $abonelik)
                                    <tr>
                                        <td>{{ $abonelik->id }}</td>
                                        <td>{{ $abonelik->user_id }}</td>
                                        <td>{{ $abonelik->musteri_adi }}</td>
                                        <td>{{ $abonelik->telefon }}</td>
                                        <td>{{ $abonelik->email }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $abonelikler->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Henüz abone bulunmuyor.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 