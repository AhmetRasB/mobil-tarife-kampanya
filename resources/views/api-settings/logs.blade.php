@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">API Logları</h3>
                    <div class="card-tools">
                        <a href="{{ route('api-settings.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-cog"></i> API Ayarları
                        </a>
                        <a href="{{ route('api-settings.credentials') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-key"></i> API Anahtarları
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Endpoint</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Response Time</th>
                                    <th>IP Address</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->endpoint }}</td>
                                        <td>
                                            <span class="badge badge-{{ $log->method === 'GET' ? 'info' : ($log->method === 'POST' ? 'success' : 'warning') }}">
                                                {{ $log->method }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $log->status_code < 400 ? 'success' : 'danger' }}">
                                                {{ $log->status_code }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($log->response_time, 2) }}ms</td>
                                        <td>{{ $log->ip_address }}</td>
                                        <td>{{ $log->created_at->format('d.m.Y H:i:s') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" 
                                                onclick="showLogDetails({{ $log->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Henüz API log kaydı bulunmuyor.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Log Details Modal -->
<div class="modal fade" id="logDetailsModal" tabindex="-1" role="dialog" aria-labelledby="logDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logDetailsModalLabel">Log Detayları</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Request</h6>
                        <pre id="requestData" class="bg-light p-3"></pre>
                    </div>
                    <div class="col-md-6">
                        <h6>Response</h6>
                        <pre id="responseData" class="bg-light p-3"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showLogDetails(logId) {
    // Here you would typically make an AJAX call to fetch the log details
    // For now, we'll just show the modal
    $('#logDetailsModal').modal('show');
}

// Format JSON for display
function formatJSON(json) {
    try {
        return JSON.stringify(JSON.parse(json), null, 2);
    } catch (e) {
        return json;
    }
}
</script>
@endpush
@endsection 