@extends('layouts.app')

@section('title', 'Dashboard Guru')

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
                <h1>Dashboard Guru</h1>
            </div>

            <!-- Welcome Card -->
            <div class="welcome-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-chalkboard-teacher"></i> Selamat Datang,
                            {{ Session('user')['nama'] ?? 'Guru' }}!</h2>
                        <p>Kelola pembelajaran, materi, dan tugas siswa dengan mudah. Platform digital untuk pendidikan yang
                            lebih efektif dan efisien.</p>
                    </div>
                    <div class="col-md-4 text-right d-none d-md-block">
                        <i class="fas fa-graduation-cap" style="font-size: 80px; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-1">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Total Murid</div>
                                <div class="stats-number">{{ $totalMurid ?? 0 }}</div>
                                <small><i class="fas fa-user-graduate"></i> Siswa Terdaftar</small>
                            </div>
                            <i class="fas fa-users stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-2">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Mata Pelajaran</div>
                                <div class="stats-number">{{ $lessonCount ?? 0 }}</div>
                                <small><i class="fas fa-book"></i> Mapel Diampu</small>
                            </div>
                            <i class="fas fa-book stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-3">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Materi</div>
                                <div class="stats-number">{{ $materiCount ?? 0 }}</div>
                                <small><i class="fas fa-file-alt"></i> Materi Tersedia</small>
                            </div>
                            <i class="fas fa-book-open stats-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card modern-stats-card stats-gradient-4">
                        <div class="card-body">
                            <div style="position: relative; z-index: 1;">
                                <div class="stats-label">Tugas</div>
                                <div class="stats-number">{{ $assignmentCount ?? 0 }}</div>
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
                            <h4><i class="fas fa-book-open"></i> Kelola Konten Pembelajaran</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('teacher/materi') }}" class="quick-action-btn">
                                <i class="fas fa-book-open"></i>
                                <div>
                                    <strong>Materi Pembelajaran</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Upload dan kelola materi untuk siswa</div>
                                </div>
                            </a>
                            <a href="{{ url('teacher/assignment') }}" class="quick-action-btn">
                                <i class="fas fa-tasks"></i>
                                <div>
                                    <strong>Kelola Tugas</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Buat dan kelola tugas siswa</div>
                                </div>
                            </a>
                            <a href="{{ url('teacher/assignments/submission') }}" class="quick-action-btn">
                                <i class="fas fa-file-alt"></i>
                                <div>
                                    <strong>Hasil Tugas</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Lihat dan nilai hasil pengerjaan tugas</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card quick-action-card">
                        <div class="card-header">
                            <h4><i class="fas fa-calendar-check"></i> Jadwal & Kehadiran</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('teacher/lesson-schedules') }}" class="quick-action-btn">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <strong>Jadwal Pelajaran</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Lihat dan kelola jadwal mengajar</div>
                                </div>
                            </a>
                            <a href="{{ url('teacher/profile') }}" class="quick-action-btn">
                                <i class="fas fa-user-circle"></i>
                                <div>
                                    <strong>Profil Saya</strong>
                                    <div style="font-size: 12px; opacity: 0.7;">Update informasi profil</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">


                    {{-- <div class="col-lg-3 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Leaderboard') }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($list_leaderboard as $list_ranking)
                                    <li class="media">
                                        <img class="rounded-circle mr-3" width="50"
                                            src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar">
                                        <div class="media-body">

                                            <div class="media-title">{{ $list_ranking->nama_lengkap }}</div>
                                            <span class="text-small text-muted">Score {{ $list_ranking->score }}</span>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                            <div class="pt-1 pb-1 text-center">
                                <a href="#" class="btn btn-primary btn-lg btn-round">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
