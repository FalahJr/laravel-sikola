@extends('layouts.app')

@section('title', 'Dashboard Admin')

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

        .stats-gradient-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stats-gradient-5 {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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

        .quick-action-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-radius: 12px;
            text-decoration: none;
            color: #495057;
            transition: all 0.3s ease;
            margin-bottom: 10px;
            background: #f8f9fa;
        }

        .quick-action-btn:hover {
            background: #667eea;
            color: white;
            text-decoration: none;
        }

        .quick-action-btn i {
            font-size: 24px;
            margin-right: 15px;
            width: 40px;
            text-align: center;
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
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Admin</h1>
            </div>

            <!-- Welcome Card -->
            <div class="welcome-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-hand-wave"></i> Selamat Datang, {{ Session('user')['nama'] ?? 'Admin' }}!</h2>
                        <p>Kelola seluruh sistem pembelajaran Sikola App dengan mudah dan efisien. Dashboard ini memberikan
                            ringkasan lengkap tentang pengguna, kelas, dan aktivitas pembelajaran.</p>
                    </div>
                    <div class="col-md-4 text-right d-none d-md-block">
                        <i class="fas fa-user-shield" style="font-size: 80px; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-1">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Total Guru</div>
                                <div class="stats-number">{{ $guruCount ?? 0 }}</div>
                                <small><i class="fas fa-chalkboard-teacher"></i> Pengajar Aktif</small>
                            </div>
                            <i class="fas fa-chalkboard-teacher stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-2">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Total Siswa</div>
                                <div class="stats-number">{{ $muridCount ?? 0 }}</div>
                                <small><i class="fas fa-user-graduate"></i> Peserta Didik</small>
                            </div>
                            <i class="fas fa-user-graduate stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-3">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Total Kelas</div>
                                <div class="stats-number">{{ $kelasCount ?? 0 }}</div>
                                <small><i class="fas fa-school"></i> Kelas Aktif</small>
                            </div>
                            <i class="fas fa-school stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-4">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Mata Pelajaran</div>
                                <div class="stats-number">{{ $mataPelajaranCount ?? 0 }}</div>
                                <small><i class="fas fa-book"></i> Mapel Tersedia</small>
                            </div>
                            <i class="fas fa-book stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-5">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Total Tugas</div>
                                <div class="stats-number">{{ $tugasCount ?? 0 }}</div>
                                <small><i class="fas fa-tasks"></i> Assignment</small>
                            </div>
                            <i class="fas fa-tasks stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="section-title">Aksi Cepat</h4>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card quick-action-card">
                        <div class="card-header">
                            <h4><i class="fas fa-users"></i> Manajemen Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('admin/gurus') }}" class="quick-action-btn">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <div>
                                    <strong>Kelola Guru</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Tambah, edit, atau hapus data guru</div>
                                </div>
                            </a>
                            <a href="{{ url('admin/manage-student') }}" class="quick-action-btn">
                                <i class="fas fa-user-graduate"></i>
                                <div>
                                    <strong>Kelola Siswa</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Tambah, edit, atau hapus data siswa</div>
                                </div>
                            </a>
                            <a href="{{ url('admin/classes') }}" class="quick-action-btn">
                                <i class="fas fa-school"></i>
                                <div>
                                    <strong>Kelola Kelas</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Atur dan organisir kelas</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card quick-action-card">
                        <div class="card-header">
                            <h4><i class="fas fa-book-open"></i> Manajemen Pembelajaran</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('admin/lessons') }}" class="quick-action-btn">
                                <i class="fas fa-book"></i>
                                <div>
                                    <strong>Kelola Pelajaran</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Tambah dan atur mata pelajaran</div>
                                </div>
                            </a>
                            <a href="{{ url('admin/materi') }}" class="quick-action-btn">
                                <i class="fas fa-book-open"></i>
                                <div>
                                    <strong>Kelola Materi</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Upload dan kelola materi pembelajaran</div>
                                </div>
                            </a>
                            <a href="{{ url('admin/lesson-schedules') }}" class="quick-action-btn">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <strong>Jadwal Pelajaran</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Atur jadwal pembelajaran</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <!-- Page Specific JS copied from dashboard-guru to keep layout parity -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-calendar.js') }}"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
