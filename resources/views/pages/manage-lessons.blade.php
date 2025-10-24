@extends('layouts.app')

@section('title', 'Management Lessons')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Management Lessons</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Lessons</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('add-lesson') }}" class="btn btn-success btn-block w-25">+ Tambah Lesson</a>
                        <div class="card mt-4">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Lesson Name</th>
                                            <th>Teacher</th>
                                            <th>Total Schedules</th>
                                            <th>Total Materials</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php $no = 1; ?>

                                        @foreach ($data as $list)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->nama_lengkap }}</td>
                                                <td>
                                                    <div class="badge badge-info">
                                                        {{ \App\Models\LessonSchedule::where('lesson_id', $list->id)->count() }}
                                                        Schedules
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-success">
                                                        {{ \App\Models\Materi::where('lesson_id', $list->id)->count() }}
                                                        Materials
                                                    </div>
                                                </td>
                                                <td>{{ $list->created_at ? $list->created_at->format('d M Y') : '-' }}</td>
                                                <td>
                                                    <a href="lessons/{{ $list->id }}/edit"
                                                        class="btn btn-secondary">Edit</a>
                                                    <a href="lessons/{{ $list->id }}" class="btn btn-info">Detail</a>
                                                    <form class="ml-auto mr-auto mt-3" method="POST"
                                                        action="/teacher/lessons/{{ $list->id }}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this lesson?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
