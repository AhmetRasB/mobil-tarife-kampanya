@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Fatura Detayları</h3>
                    <div>
                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary btn-sm d-print-none me-2">
                            <i class="fas fa-arrow-left"></i> Geri Dön
                        </a>
                        <button onclick="window.print()" class="btn btn-primary btn-sm d-print-none">
                            <i class="fas fa-print"></i> PDF olarak indir / Yazdır
                        </button>
                    </div>
                </div>
                <div class="card-body" id="invoice-detail">
                    <table class="table table-bordered mb-4">
                        <tr>
                            <th>Fatura No</th>
                            <td>{{ $invoice->id }}</td>
                        </tr>
                        <tr>
                            <th>Müşteri</th>
                            <td>{{ optional($invoice->abonelik)->musteri_adi ?? '-' }}<br><small>{{ optional($invoice->abonelik)->email ?? '-' }}</small></td>
                        </tr>
                        <tr>
                            <th>Tarife</th>
                            <td>{{ optional($invoice->abonelik->tarife)->ad ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kampanya</th>
                            <td>
                                @if(optional($invoice->abonelik->kampanya))
                                    {{ $invoice->abonelik->kampanya->ad }} ({{ $invoice->abonelik->kampanya->indirim_orani }}%)
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Orijinal Tutar</th>
                            <td>₺{{ number_format(optional($invoice->abonelik->tarife)->fiyat ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <th>İndirim</th>
                            <td>
                                @if(optional($invoice->abonelik->kampanya))
                                    ₺{{ number_format((optional($invoice->abonelik->tarife)->fiyat ?? 0) * ($invoice->abonelik->kampanya->indirim_orani / 100), 2) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Net Tutar</th>
                            <td>₺{{ number_format($invoice->amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Fatura Tarihi</th>
                            <td>{{ $invoice->invoice_date ? $invoice->invoice_date->format('d.m.Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Son Ödeme</th>
                            <td>{{ $invoice->due_date ? $invoice->due_date->format('d.m.Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td>
                                @switch($invoice->status)
                                    @case('paid')
                                        <span class="badge bg-success">Ödendi</span>
                                        @break
                                    @case('unpaid')
                                        <span class="badge bg-warning">Beklemede</span>
                                        @break
                                    @case('suspended')
                                        <span class="badge bg-danger">Askıya Alındı</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $invoice->status }}</span>
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Açıklama</th>
                            <td>{{ $invoice->description ?? '-' }}</td>
                        </tr>
                    </table>
                    <div class="text-center d-print-none">
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
@media print {
    .main-header, .main-sidebar, .main-footer, .d-print-none { display: none !important; }
    .content-wrapper, .container-fluid { margin: 0; padding: 0; }
    body { background: #fff !important; }
}
</style>
@endsection 