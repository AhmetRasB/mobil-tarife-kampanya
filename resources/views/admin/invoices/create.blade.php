@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yeni Fatura Ekle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.invoices.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subscriber_id">Abone</label>
                            <select class="form-control" id="subscriber_id" name="subscriber_id">
                                @foreach($subscribers as $subscriber)
                                    <option value="{{ $subscriber->id }}">{{ $subscriber->ad }} {{ $subscriber->soyad }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Tutar</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="due_date">Son Ödeme Tarihi</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 