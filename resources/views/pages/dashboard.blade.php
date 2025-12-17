@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/fullcalendar/dist/fullcalendar.min.css') }}">
    <style>
        .modern-stats-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .modern-stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .stats-gradient-1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stats-gradient-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-gradient-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .modern-stats-card .card-body {
            padding: 25px;
            color: white;
        }

        .stats-icon {
            font-size: 48px;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .stats-number {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 500;
        }

        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .welcome-card h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .welcome-card p {
            font-size: 15px;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .announcement-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);
            margin-bottom: 30px;
        }

        .announcement-card h6 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .btn-announcement {
            background: white;
            color: #f5576c;
            font-weight: 600;
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-announcement:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
            color: #f5576c;
        }

        .schedule-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .schedule-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        .schedule-card .table thead th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 15px 20px;
            font-size: 14px;
        }

        .schedule-card .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .schedule-card .table tbody tr:last-child td {
            border-bottom: none;
        }

        .schedule-card .table tbody tr:hover {
            background-color: #f8f9ff;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #495057;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .quick-link-btn {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .quick-link-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            color: white;
        }

        .quick-link-btn i {
            font-size: 28px;
            margin-right: 15px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Siswa</h1>
            </div>

            <!-- Welcome Card -->
            <div class="welcome-card">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <h2><i class="fas fa-hand-sparkles"></i> Halo, {{ Session('user')['nama'] ?? 'Siswa' }}!</h2>
                        <p>Selamat datang di Sikola App. Yuk, mulai belajar dan kembangkan potensimu! Akses materi, kerjakan
                            tugas, dan pantau progres belajarmu dengan mudah.</p>
                    </div>
                    <div class="col-md-3 text-right d-none d-md-block">
                        <i class="fas fa-user-graduate" style="font-size: 80px; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-1">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Teman Sekelas</div>
                                <div class="stats-number">{{ $studentsInClass ?? 0 }}</div>
                                <small><i class="fas fa-users"></i> Siswa</small>
                            </div>
                            <i class="fas fa-users stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-2">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Mata Pelajaran</div>
                                <div class="stats-number">{{ $totalLessons ?? 0 }}</div>
                                <small><i class="fas fa-book"></i> Mapel</small>
                            </div>
                            <i class="fas fa-book-open stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-3">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Materi Tersedia</div>
                                <div class="stats-number">{{ $totalMaterials ?? 0 }}</div>
                                <small><i class="fas fa-folder-open"></i> Materi</small>
                            </div>
                            <i class="fas fa-folder-open stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ url('student/materi') }}" class="quick-link-btn"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-book-open"></i>
                        <div>
                            <strong>Materi Pembelajaran</strong>
                            <div style="font-size: 12px; opacity: 0.9;">Akses semua materi pelajaran</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ url('student/assignment') }}" class="quick-link-btn"
                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-tasks"></i>
                        <div>
                            <strong>Tugas Saya</strong>
                            <div style="font-size: 12px; opacity: 0.9;">Lihat dan kerjakan tugas</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="{{ url('student/lesson-schedules') }}" class="quick-link-btn"
                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-calendar-alt"></i>
                        <div>
                            <strong>Jadwal Pelajaran</strong>
                            <div style="font-size: 12px; opacity: 0.9;">Cek jadwal harian kamu</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Announcement -->
            @if ($newest_notifikasi)
                <div class="announcement-card">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <h6><i class="fas fa-bullhorn"></i> Pengumuman</h6>
                            <h5 style="font-weight: 700;">{{ $newest_notifikasi->judul }}</h5>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="{{ url('student/materi') }}" class="btn btn-announcement">
                                <i class="fas fa-arrow-right"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Schedule Section -->
            <div class="row">
                <div class="col-12">
                    <h4 class="section-title mb-4">Jadwal Pelajaran Anda</h4>
                    <div class="card schedule-card">
                        <div class="card-header">
                            <h4 style="margin: 0;"><i class="fas fa-calendar-week"></i> Jadwal Mingguan</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;"><i class="fas fa-calendar-day"></i> Hari</th>
                                            <th style="width: 25%;"><i class="fas fa-clock"></i> Waktu</th>
                                            <th style="width: 35%;"><i class="fas fa-book"></i> Mata Pelajaran</th>
                                            <th style="width: 20%;"><i class="fas fa-door-open"></i> Ruang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($lessonSchedules as $schedule)
                                            <tr>
                                                <td><strong>{{ $schedule->day }}</strong></td>
                                                <td>
                                                    @if ($schedule->start_time)
                                                        @if ($schedule->end_time)
                                                            <span class="badge badge-info" style="font-size: 13px;">
                                                                {{ date('H:i', strtotime($schedule->start_time)) }} -
                                                                {{ date('H:i', strtotime($schedule->end_time)) }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-info" style="font-size: 13px;">
                                                                {{ date('H:i', strtotime($schedule->start_time)) }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <i class="fas fa-book-open text-primary"></i>
                                                    <strong>{{ $schedule->lesson->name ?? '-' }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light" style="font-size: 12px;">
                                                        <i class="fas fa-door-open"></i> {{ $schedule->room ?? '-' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5">
                                                    <i class="fas fa-calendar-times"
                                                        style="font-size: 48px; color: #ddd; margin-bottom: 15px;"></i>
                                                    <p style="color: #999;">Belum ada jadwal untuk kelas Anda</p>
                                                </td>
                                            </tr>
                                        @endempty
                                </tbody>
                            </table>
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
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<!-- JS Libraies -->
<script src="{{ asset('library/fullcalendar/dist/fullcalendar.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-calendar.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
