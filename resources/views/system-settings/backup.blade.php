@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yedekleme</h3>
                    <div class="card-tools">
                        <a href="{{ route('system-settings.general') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-cog"></i> Genel Ayarlar
                        </a>
                        <a href="{{ route('system-settings.notifications') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-bell"></i> Bildirim Ayarları
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Manuel Yedekleme -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manuel Yedekleme</h3>
                        </div>
                        <div class="card-body">
                            <p>Veritabanının tam bir yedeğini almak için aşağıdaki butona tıklayın.</p>
                            <form action="{{ route('system-settings.create-backup') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-download"></i> Yedek Oluştur
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Mevcut Yedekler -->
                    <div class="card card-info mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Mevcut Yedekler</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Dosya Adı</th>
                                            <th>Boyut</th>
                                            <th>Oluşturulma Tarihi</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($backups as $backup)
                                            <tr>
                                                <td>{{ basename($backup) }}</td>
                                                <td>{{ number_format(Storage::disk('backups')->size($backup) / 1024 / 1024, 2) }} MB</td>
                                                <td>{{ date('d.m.Y H:i:s', Storage::disk('backups')->lastModified($backup)) }}</td>
                                                <td>
                                                    <a href="{{ route('system-settings.download-backup', ['filename' => basename($backup)]) }}" 
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="deleteBackup('{{ basename($backup) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Henüz yedek bulunmuyor.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Otomatik Yedekleme -->
                    <div class="card card-warning mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Otomatik Yedekleme</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Otomatik Yedekleme Bilgileri</h5>
                                <p>Otomatik yedekleme için Laravel'in zamanlanmış görevlerini kullanabilirsiniz. Aşağıdaki komutu crontab'a ekleyin:</p>
                                <code>* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Backup Modal -->
<div class="modal fade" id="deleteBackupModal" tabindex="-1" role="dialog" aria-labelledby="deleteBackupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBackupModalLabel">Yedek Silme Onayı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bu yedeği silmek istediğinizden emin misiniz? Bu işlem geri alınamaz.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <form id="deleteBackupForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yedeği Sil</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deleteBackup(filename) {
    $('#deleteBackupForm').attr('action', '{{ route("system-settings.delete-backup", ["filename" => ""]) }}/' + filename);
    $('#deleteBackupModal').modal('show');
}
</script>
@endpush
@endsection 