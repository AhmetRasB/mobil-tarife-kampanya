@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abonelik Detayları</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.abonelikler.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                        <a href="{{ route('admin.abonelikler.edit', $abonelik) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Müşteri Bilgileri</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Müşteri Adı</th>
                                    <td>{{ $abonelik->musteri_adi }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>{{ $abonelik->telefon }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $abonelik->email }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Abonelik Bilgileri</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Tarife</th>
                                    <td>{{ $abonelik->tarife->ad }}</td>
                                </tr>
                                <tr>
                                    <th>Kampanya</th>
                                    <td>{{ $abonelik->kampanya ? $abonelik->kampanya->ad : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Başlangıç Tarihi</th>
                                    <td>{{ $abonelik->baslangic_tarihi->format('d.m.Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Bitiş Tarihi</th>
                                    <td>{{ $abonelik->bitis_tarihi ? $abonelik->bitis_tarihi->format('d.m.Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Durum</th>
                                    <td>
                                        @if($abonelik->aktif)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Pasif</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Faturalar</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Fatura No</th>
                                            <th>Tarih</th>
                                            <th>Tutar</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($abonelik->faturalar as $fatura)
                                        <tr>
                                            <td>{{ $fatura->fatura_no }}</td>
                                            <td>{{ $fatura->created_at->format('d.m.Y') }}</td>
                                            <td>{{ number_format($fatura->tutar, 2) }} TL</td>
                                            <td>
                                                @if($fatura->odendi)
                                                    <span class="badge badge-success">Ödendi</span>
                                                @else
                                                    <span class="badge badge-warning">Beklemede</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.faturalar.show', $fatura) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Henüz fatura bulunmuyor.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 