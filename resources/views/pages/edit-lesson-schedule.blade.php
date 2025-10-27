@extends('layouts.app')

@section('title', 'Ubah Jadwal Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Jadwal Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="#">Jadwal Pelajaran</a></div>
                    <div class="breadcrumb-item">Ubah Jadwal</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Formulir Ubah Jadwal Pelajaran</h4>
                            </div>
                            <form class="form" action="/admin/lesson-schedules/{{ $schedule->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pelajaran</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="lesson_id" required>
                                                <option value="">Pilih Pelajaran</option>
                                                @foreach ($lessons as $lesson)
                                                    <option value="{{ $lesson->id }}"
                                                        {{ $schedule->lesson_id == $lesson->id ? 'selected' : '' }}>
                                                        {{ $lesson->name }} -
                                                        {{ $lesson->user->nama_lengkap ?? 'Tanpa Guru' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="class_id" required>
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $schedule->class_id == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hari</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="day" required>
                                                <option value="">Pilih Hari</option>
                                                <option value="Monday" {{ $schedule->day == 'Monday' ? 'selected' : '' }}>
                                                    Senin</option>
                                                <option value="Tuesday"
                                                    {{ $schedule->day == 'Tuesday' ? 'selected' : '' }}>Selasa</option>
                                                <option value="Wednesday"
                                                    {{ $schedule->day == 'Wednesday' ? 'selected' : '' }}>Rabu</option>
                                                <option value="Thursday"
                                                    {{ $schedule->day == 'Thursday' ? 'selected' : '' }}>Kamis</option>
                                                <option value="Friday" {{ $schedule->day == 'Friday' ? 'selected' : '' }}>
                                                    Jumat</option>
                                                <option value="Saturday"
                                                    {{ $schedule->day == 'Saturday' ? 'selected' : '' }}>Sabtu</option>
                                                <option value="Sunday" {{ $schedule->day == 'Sunday' ? 'selected' : '' }}>
                                                    Minggu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="time" class="form-control" name="time"
                                                value="{{ $schedule->time ? date('H:i', strtotime($schedule->time)) : '' }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ruang</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="room"
                                                value="{{ $schedule->room }}"
                                                placeholder="Masukkan nomor ruang atau lokasi (mis. Lab 101, Ruang A1)">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Perbarui Jadwal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Schedule Statistics -->
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Jadwal</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="far fa-book"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Pelajaran</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $schedule->lesson->name ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-info">
                                                <i class="far fa-building"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Kelas</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $schedule->class->name ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-warning">
                                                <i class="far fa-users"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Kehadiran</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $schedule->lessonAttendances()->count() }}
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
                                                    <h4>Dibuat Pada</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $schedule->created_at ? $schedule->created_at->format('M Y') : '-' }}
                                                </div>
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
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
@endpush
