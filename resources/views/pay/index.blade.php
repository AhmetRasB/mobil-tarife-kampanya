@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Faturalarım</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fatura No</th>
                                    <th>Abonelik</th>
                                    <th>Tutar</th>
                                    <th>Fatura Tarihi</th>
                                    <th>Son Ödeme Tarihi</th>
                                    <th>Dönem</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $invoice)
                                    <tr>
                                        <td>#{{ $invoice->id }}</td>
                                        <td>{{ $invoice->abonelik->tarife->ad }}</td>
                                        <td>{{ number_format($invoice->amount, 2) }} ₺</td>
                                        <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                                        <td>{{ $invoice->due_date->format('d.m.Y') }}</td>
                                        <td>{{ $invoice->billing_period }}</td>
                                        <td>
                                            @if($invoice->status === 'paid')
                                                <span class="badge badge-success">Ödendi</span>
                                            @elseif($invoice->status === 'suspended')
                                                <span class="badge badge-danger">Askıya Alındı</span>
                                            @else
                                                <span class="badge badge-warning">Ödenmedi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($invoice->status === 'unpaid')
                                                <form action="{{ route('pay.pay', $invoice) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-credit-card"></i> Öde
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="#" class="btn btn-info btn-sm" onclick="viewInvoice({{ $invoice->id }})">
                                                <i class="fas fa-eye"></i> Görüntüle
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Henüz fatura bulunmuyor.</td>
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