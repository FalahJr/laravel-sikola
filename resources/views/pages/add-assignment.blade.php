@extends('layouts.app')

@section('title', 'Tambah Tugas')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Tambah Tugas') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">{{ __('Dasbor') }}</a></div>
                    <div class="breadcrumb-item"><a href="#">{{ __('Tugas') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Tambah Tugas') }}</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Form Tambah Tugas') }}</h4>
                            </div>
                            <form class="form" action="/teacher/assignment" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Materi') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="materi_id">
                                                <option value="" disabled selected>{{ __('Pilih Materi') }}</option>

                                                @foreach ($materi as $list)
                                                    <option value="{{ $list->id }}">{{ $list->judul }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Judul') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="judul">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Deskripsi') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="w-100" rows="6" name="deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Gambar') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">{{ __('Pilih Gambar') }}</label>
                                                <input type="file" name="gambar" id="image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Berkas') }}</label>
                                        <div class="col-sm-12 col-md-7">

                                            <input type="file" class="form-control" name="file">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">

                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Tanggal
                                                                                        Mulai') }}</label>
                                        <div class="col-sm-12 col-md-7">

                                            <input type="text" class="form-control datepicker" name="start_date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">

                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Tanggal
                                                                                        Selesai') }}</label>
                                        <div class="col-sm-12 col-md-7">

                                            <input type="text" class="form-control datepicker" name="end_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">{{ __('Terbitkan') }}</button>
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
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    {{-- <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script> --}}

    <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>



    <!-- Page Specific JS File -->
@endpush
