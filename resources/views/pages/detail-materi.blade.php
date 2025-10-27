@extends('layouts.app')

@section('title', 'Material')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-capitalize">{{ $materi->judul }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="/student/materi">Materi</a></div>
                    @if ($materi->lesson_name)
                        <div class="breadcrumb-item">{{ $materi->lesson_name }}</div>
                    @endif
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $materi->judul }}</h4>
                                @if ($materi->lesson_name)
                                    <div class="card-header-action">
                                        <span class="badge badge-info">{{ $materi->lesson_name }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="content">
                                            {!! $materi->deskripsi !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-header">
                                                <h6>Sumber Tambahan</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <strong>Dibuat oleh:</strong><br>
                                                    <span class="text-muted">{{ $materi->nama_lengkap }}</span>
                                                </div>

                                                @if ($materi->file)
                                                    <div class="mb-3">
                                                        <strong>Dokumen Tambahan (PPT / PDF):</strong><br>
                                                        <a href="{{ asset('file_upload/materi/' . $materi->file) }}"
                                                            class="btn btn-primary btn-block mt-2" target="_blank">
                                                            <i class="fas fa-download"></i> Lihat File
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mb-3">
                                                        <strong>Dokumen Tambahan:</strong><br>
                                                        <span class="text-muted">Tidak ada file tambahan</span>
                                                    </div>
                                                @endif

                                                @if ($materi->gambar)
                                                    <div class="mb-3">
                                                        <strong>Gambar Materi:</strong><br>
                                                        <img src="{{ asset('img/materi/' . $materi->gambar) }}"
                                                            alt="{{ $materi->judul }}" class="img-fluid mt-2 rounded">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function logEndTime() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", '{{ route('materi.logEndTime') }}', false); // 'false' makes the request synchronous
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(JSON.stringify({
                log_id: {{ $activityLog->id }}
            }));
        }

        window.addEventListener('beforeunload', function(e) {
            logEndTime();
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    logEndTime();
                });
            });
        });
    </script>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
