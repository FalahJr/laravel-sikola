@extends('layouts.app')

@section('title', 'Material Details')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Material Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/teacher/materi') }}">Materials</a></div>
                    <div class="breadcrumb-item">Details</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $materi->judul }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ url('/teacher/materi/' . $materi->id . '/edit') }}"
                                        class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/teacher/materi') }}" class="btn btn-secondary">Back to List</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Title:</strong></td>
                                                    <td>{{ $materi->judul }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Lesson:</strong></td>
                                                    <td>
                                                        @if ($materi->lesson_name)
                                                            <span class="badge badge-info">{{ $materi->lesson_name }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">No Lesson Assigned</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Created By:</strong></td>
                                                    <td>{{ $materi->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Created At:</strong></td>
                                                    <td>{{ \Carbon\Carbon::parse($materi->created_at)->format('d M Y, H:i') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Updated At:</strong></td>
                                                    <td>{{ \Carbon\Carbon::parse($materi->updated_at)->format('d M Y, H:i') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($materi->gambar)
                                            <div class="form-group">
                                                <label><strong>Thumbnail:</strong></label>
                                                <div class="mt-2">
                                                    <img src="{{ asset('img/materi/' . $materi->gambar) }}"
                                                        alt="{{ $materi->judul }}" class="img-fluid"
                                                        style="max-width: 100%; height: auto; border-radius: 5px;">
                                                </div>
                                            </div>
                                        @endif

                                        @if ($materi->file)
                                            <div class="form-group mt-3">
                                                <label><strong>Additional Document:</strong></label>
                                                <div class="mt-2">
                                                    <a href="{{ asset('file_upload/materi/' . $materi->file) }}"
                                                        class="btn btn-primary btn-block" target="_blank">
                                                        <i class="fas fa-download"></i> View/Download File
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if ($materi->deskripsi)
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h5>Description:</h5>
                                            <div class="content">
                                                {!! $materi->deskripsi !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
