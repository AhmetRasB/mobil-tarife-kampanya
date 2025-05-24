@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tarife Detayları</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Ad</th>
                            <td>{{ $tarife->ad }}</td>
                        </tr>
                        <tr>
                            <th>Açıklama</th>
                            <td>{{ $tarife->aciklama }}</td>
                        </tr>
                        <tr>
                            <th>Fiyat</th>
                            <td>{{ number_format($tarife->fiyat, 2) }} ₺</td>
                        </tr>
                        <tr>
                            <th>İnternet</th>
                            <td>{{ $tarife->internet_miktari }} GB</td>
                        </tr>
                        <tr>
                            <th>Dakika</th>
                            <td>{{ $tarife->dakika_miktari }} DK</td>
                        </tr>
                        <tr>
                            <th>SMS</th>
                            <td>{{ $tarife->sms_miktari }} SMS</td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td>{{ $tarife->aktif ? 'Aktif' : 'Pasif' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 