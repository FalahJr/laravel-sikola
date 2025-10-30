@extends('layouts.app')

@section('title', 'Manajemen Materi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Materi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item">Materi</div>
                </div>
            </div>

            @include('components.alerts')

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Materi</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('add-materi') }}" class="btn btn-primary">Tambah Materi Baru</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th>
                                                <th>Pelajaran</th>
                                                <th>Dibuat Oleh</th>
                                                <th>Dibuat Pada</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $materi)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $materi->judul }}</td>
                                                    <td>
                                                        @if ($materi->lesson_name)
                                                            <span class="badge badge-info">{{ $materi->lesson_name }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Tanpa Pelajaran</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $materi->nama_lengkap }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($materi->created_at)->format('d M Y, H:i') }}
                                                    </td>
                                                    <td>
                                                        <a href="materi/{{ $materi->id }}/edit"
                                                            class="btn btn-secondary btn-sm">Ubah</a>
                                                        <a href="materi/{{ $materi->id }}"
                                                            class="btn btn-info btn-sm">Detail</a>
                                                        <form class="d-inline mt-2" method="POST"
                                                            action="/admin/materi/{{ $materi->id }}">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Anda yakin ingin menghapus materi ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
@endpush
