@extends('layouts.app')

@section('title', 'Ubah Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="#">Pelajaran</a></div>
                    <div class="breadcrumb-item">Ubah Pelajaran</div>
                </div>
            </div>

            @include('components.alerts')

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Formulir Ubah Pelajaran</h4>
                            </div>
                            <form class="form" action="/admin/lessons/{{ $lesson->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Pelajaran</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $lesson->name }}"
                                                placeholder="Masukkan nama pelajaran (mis. Matematika, Fisika, Pemrograman)"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Guru</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="user_id" required>
                                                <option value="">Pilih Guru</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                        {{ $lesson->user_id == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->nama_lengkap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Perbarui Pelajaran</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Lesson Statistics -->
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Pelajaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="far fa-calendar"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Jadwal Pelajaran</h4>
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
                                                    <h4>Materi</h4>
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
                                                    <h4>Guru</h4>
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
                                                    <h4>Dibuat Pada</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $lesson->created_at ? $lesson->created_at->format('M Y') : '-' }}
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
@endpush
