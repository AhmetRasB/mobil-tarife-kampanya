@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Faturalar</h3>
                    <div class="btn-group">
                        <a href="{{ route('admin.invoices.index') }}" 
                           class="btn btn-{{ !request('status') ? 'primary' : 'outline-primary' }}">
                            Tümü
                        </a>
                        <a href="{{ route('admin.invoices.index', ['status' => 'paid']) }}" 
                           class="btn btn-{{ request('status') === 'paid' ? 'success' : 'outline-success' }}">
                            Ödenen
                        </a>
                        <a href="{{ route('admin.invoices.index', ['status' => 'unpaid']) }}" 
                           class="btn btn-{{ request('status') === 'unpaid' ? 'warning' : 'outline-warning' }}">
                            Bekleyen
                        </a>
                        <a href="{{ route('admin.invoices.index', ['status' => 'suspended']) }}" 
                           class="btn btn-{{ request('status') === 'suspended' ? 'danger' : 'outline-danger' }}">
                            Askıya Alınan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fatura No</th>
                                    <th>Müşteri</th>
                                    <th>Tarife</th>
                                    <th>Kampanya</th>
                                    <th>Orijinal Tutar</th>
                                    <th>İndirim</th>
                                    <th>Net Tutar</th>
                                    <th>Fatura Tarihi</th>
                                    <th>Son Ödeme</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>
                                        {{ optional($invoice->abonelik)->musteri_adi ?? '-' }}<br>
                                        <small class="text-muted">{{ optional($invoice->abonelik)->email ?? '-' }}</small>
                                    </td>
                                    <td>{{ optional($invoice->abonelik)->tarife->ad ?? '-' }}</td>
                                    <td>
                                        @if(optional($invoice->abonelik)->kampanya)
                                            <span class="badge badge-info">
                                                {{ $invoice->abonelik->kampanya->ad }}
                                                ({{ $invoice->abonelik->kampanya->indirim_orani }}%)
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>₺{{ number_format(optional($invoice->abonelik)->tarife  ->fiyat ?? 0, 2) }}</td>
                                    <td>
                                        @if(optional($invoice->abonelik)->kampanya)
                                            ₺{{ number_format((optional($invoice->abonelik)->tarife->fiyat ?? 0) * ($invoice->abonelik->kampanya->indirim_orani / 100), 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>₺{{ number_format($invoice->amount, 2) }}</td>
                                    <td>{{ $invoice->created_at->format('d.m.Y') }}</td>
                                    <td>{{ $invoice->due_date->format('d.m.Y') }}</td>
                                    <td>
                                        @switch($invoice->status)
                                            @case('paid')
                                                <span class="badge badge-success">Ödendi</span>
                                                @break
                                            @case('unpaid')
                                                <span class="badge badge-warning">Beklemede</span>
                                                @break
                                            @case('suspended')
                                                <span class="badge badge-danger">Askıya Alındı</span>
                                                @break
                                            @default
                                                <span class="badge badge-secondary">{{ $invoice->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($invoice->status === 'unpaid')
                                                <form action="{{ route('admin.invoices.mark-paid', $invoice) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-success btn-sm" 
                                                            title="Ödenmiş Olarak İşaretle"
                                                            onclick="return confirm('Bu faturayı ödenmiş olarak işaretlemek istediğinize emin misiniz?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.invoices.suspend', $invoice) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            title="Askıya Al"
                                                            onclick="return confirm('Bu faturayı askıya almak istediğinize emin misiniz?')">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-info btn-sm" title="Detay">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center">Fatura bulunamadı.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $invoices->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Detail Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Fatura Detayı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="invoiceDetail">
                <!-- Invoice details will be loaded here -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function viewInvoice(id) {
    // Here you can add AJAX call to get invoice details
    $('#invoiceModal').modal('show');
}
</script>
@endpush
@endsection 