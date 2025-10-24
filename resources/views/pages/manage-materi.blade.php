@extends('layouts.app')

@section('title', 'Manage Materials')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manage Materials</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Materials</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Materials List</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('add-materi') }}" class="btn btn-primary">Add New Material</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Lesson</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
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
                                                            <span class="badge badge-secondary">No Lesson</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $materi->nama_lengkap }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($materi->created_at)->format('d M Y, H:i') }}
                                                    </td>
                                                    <td>
                                                        <a href="materi/{{ $materi->id }}/edit"
                                                            class="btn btn-secondary btn-sm">Edit</a>
                                                        <a href="materi/{{ $materi->id }}"
                                                            class="btn btn-info btn-sm">Detail</a>
                                                        <form class="d-inline mt-2" method="POST"
                                                            action="/teacher/materi/{{ $materi->id }}">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this material?')">
                                                                Delete
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
