@extends('layouts.app')

@section('title', 'Detail Lesson')

@push('style')
    <!-- CSS Libraries -->
@endpush
<?php
use Illuminate\Support\Str;
?>

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Lesson: {{ $lesson->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="#">{{ __('Lessons') }}</a></div>
                    <div class="breadcrumb-item">{{ $lesson->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <!-- Lesson Statistics -->
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-calendar"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Lesson Schedules') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $lesson->lessonSchedules()->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Materials') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $lesson->materials()->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Teacher') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $lesson->user->nama_lengkap ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Created At') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $lesson->created_at ? $lesson->created_at->format('M Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Lesson Schedules -->
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Lesson Schedules') }}</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Day') }}</th>
                                                <th>{{ __('Time') }}</th>
                                                <th>{{ __('Class') }}</th>
                                                <th>{{ __('Room') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($lesson->lessonSchedules()->with('class')->orderBy('day')->orderBy('time')->limit(10)->get() as $schedule)
                                                <tr>
                                                    <td>{{ $schedule->day }}</td>
                                                    <td>{{ $schedule->time ? date('H:i', strtotime($schedule->time)) : '-' }}
                                                    </td>
                                                    <td>{{ $schedule->class->name ?? '-' }}</td>
                                                    <td>{{ $schedule->room ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">{{ __('No schedules created yet') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Materials -->
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Materials') }}</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Created By') }}</th>
                                                <th>{{ __('Created At') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($lesson->materials()->with('user')->orderBy('created_at', 'desc')->limit(10)->get() as $index => $material)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $material->judul }}</td>
                                                    <td>{{ $material->user->nama_lengkap ?? '-' }}</td>
                                                    <td>{{ $material->created_at ? $material->created_at->format('d M Y') : '-' }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">{{ __('No materials created yet') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Attendances -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Recent Attendances') }}</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Student') }}</th>
                                                <th>{{ __('Schedule') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($lesson->attendances()->with(['user', 'lessonSchedule'])->orderBy('created_at', 'desc')->limit(10)->get() as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->user->nama_lengkap ?? '-' }}</td>
                                                    <td>
                                                        {{ $attendance->lessonSchedule->day ?? '-' }} -
                                                        {{ $attendance->lessonSchedule->time ? date('H:i', strtotime($attendance->lessonSchedule->time)) : '-' }}
                                                    </td>
                                                    <td>
                                                        @if ($attendance->status == 'Hadir')
                                                            <span
                                                                class="badge badge-success">{{ $attendance->status }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ $attendance->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $attendance->created_at ? $attendance->created_at->format('d M Y H:i') : '-' }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">{{ __('No attendance records yet') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <a href="/teacher/lessons/{{ $lesson->id }}/edit" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit Lesson
                                </a>
                                <a href="/teacher/lessons" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Back to Lessons
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
