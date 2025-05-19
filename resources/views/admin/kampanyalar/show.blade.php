@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kampanya Detayları</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Ad</th>
                            <td>{{ $kampanya->ad }}</td>
                        </tr>
                        <tr>
                            <th>Açıklama</th>
                            <td>{{ $kampanya->aciklama }}</td>
                        </tr>
                        <tr>
                            <th>İndirim Oranı</th>
                            <td>{{ $kampanya->indirim_orani }}%</td>
                        </tr>
                        <tr>
                            <th>Başlangıç Tarihi</th>
                            <td>{{ $kampanya->baslangic_tarihi->format('d.m.Y') }}</td>
                        </tr>
                        <tr>
                            <th>Bitiş Tarihi</th>
                            <td>{{ $kampanya->bitis_tarihi->format('d.m.Y') }}</td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td>{{ $kampanya->aktif ? 'Aktif' : 'Pasif' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 