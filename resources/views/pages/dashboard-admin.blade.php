@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('style')
    <!-- CSS Libraries (copy from dashboard-guru) -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/fullcalendar/dist/fullcalendar.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="d-flex flex-column">
                    <h1>Beranda Admin</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Guru</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $guruCount ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Murid</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $muridCount ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Kelas</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $kelasCount ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 col-sm-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Mata Pelajaran</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $mataPelajaranCount ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Tugas</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $tugasCount ?? 0 }}
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
