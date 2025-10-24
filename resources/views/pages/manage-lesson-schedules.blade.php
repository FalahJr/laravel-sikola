@extends('layouts.app')

@section('title', 'Management Lesson Schedules')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Management Lesson Schedules</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Lesson Schedules</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('add-lesson-schedule') }}" class="btn btn-success btn-block w-25">+ Tambah
                            Schedule</a>
                        <div class="card mt-4">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                            <th>Lesson</th>
                                            <th>Class</th>
                                            <th>Room</th>
                                            <th>Attendances</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php $no = 1; ?>

                                        @foreach ($data as $list)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>
                                                    <div class="badge badge-primary">{{ $list->day }}</div>
                                                </td>
                                                <td>{{ $list->time ? date('H:i', strtotime($list->time)) : '-' }}</td>
                                                <td>{{ $list->lesson_name }}</td>
                                                <td>{{ $list->class_name }}</td>
                                                <td>{{ $list->room ?? '-' }}</td>
                                                <td>
                                                    <div class="badge badge-info">
                                                        {{ \App\Models\LessonAttendance::where('lesson_schedule_id', $list->id)->count() }}
                                                        Records
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="lesson-schedules/{{ $list->id }}/edit"
                                                        class="btn btn-secondary btn-sm">Edit</a>
                                                    <a href="lesson-schedules/{{ $list->id }}"
                                                        class="btn btn-info btn-sm">Detail</a>
                                                    <form class="d-inline mt-2" method="POST"
                                                        action="/teacher/lesson-schedules/{{ $list->id }}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this schedule?')">
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
