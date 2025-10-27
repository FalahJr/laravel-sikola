@extends('layouts.app')

@section('title', 'Tambah Jadwal Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Jadwal Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="#">Jadwal Pelajaran</a></div>
                    <div class="breadcrumb-item">Tambah Jadwal</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Formulir Tambah Jadwal Pelajaran</h4>
                            </div>
                            <form class="form" action="/teacher/lesson-schedules" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pelajaran</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="lesson_id" required>
                                                <option value="">Pilih Pelajaran</option>
                                                @foreach ($lessons as $lesson)
                                                    <option value="{{ $lesson->id }}">{{ $lesson->name }} -
                                                        {{ $lesson->user->nama_lengkap ?? 'Tanpa Guru' }}</option>
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
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hari</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="day" required>
                                                <option value="">Pilih Hari</option>
                                                <option value="Monday">Senin</option>
                                                <option value="Tuesday">Selasa</option>
                                                <option value="Wednesday">Rabu</option>
                                                <option value="Thursday">Kamis</option>
                                                <option value="Friday">Jumat</option>
                                                <option value="Saturday">Sabtu</option>
                                                <option value="Sunday">Minggu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="time" class="form-control" name="time" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ruang</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="room"
                                                placeholder="Masukkan nomor ruang atau lokasi (mis. Lab 101, Ruang A1)">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Buat Jadwal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
