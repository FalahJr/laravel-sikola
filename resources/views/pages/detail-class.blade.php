@extends('layouts.app')

@section('title', 'Detail Class')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Class: {{ $class->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Classes</a></div>
                    <div class="breadcrumb-item">{{ $class->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <!-- Class Statistics -->
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Students</h4>
                                </div>
                                <div class="card-body">
                                    {{ $class->users()->where('role', 'Murid')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="far fa-calendar"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Lesson Schedules</h4>
                                </div>
                                <div class="card-body">
                                    {{ $class->lessonSchedules()->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Assignments</h4>
                                </div>
                                <div class="card-body">
                                    {{ $class->assignments()->count() }}
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Created At</h4>
                                </div>
                                <div class="card-body">
                                    {{ $class->created_at ? $class->created_at->format('M Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Students List -->
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Students in This Class</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Student ID</th>
                                                <th>Major</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($class->users()->where('role', 'Murid')->get() as $index => $student)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $student->nama_lengkap }}</td>
                                                    <td>{{ $student->nomor_induk }}</td>
                                                    <td>{{ $student->jurusan ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No students assigned yet</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Schedules -->
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Lesson Schedules</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Lesson</th>
                                                <th>Room</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($class->lessonSchedules()->with('lesson')->orderBy('day')->orderBy('time')->limit(10)->get() as $schedule)
                                                <tr>
                                                    <td>{{ $schedule->day }}</td>
                                                    <td>{{ $schedule->time ? date('H:i', strtotime($schedule->time)) : '-' }}
                                                    </td>
                                                    <td>{{ $schedule->lesson->name ?? '-' }}</td>
                                                    <td>{{ $schedule->room ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No schedules created yet</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Assignments -->


                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <a href="/teacher/classes/{{ $class->id }}/edit" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit Class
                                </a>
                                <a href="/teacher/classes" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Back to Classes
                                </a>
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
@endpush
