@extends('layouts.app')

@section('title', 'Pengumpulan Tugas')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
<?php
use App\Models\AssignmentSubmission;
use Carbon\Carbon;

?>
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Pengumpulan') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">{{ __('Dasbor') }}</a></div>
                    <div class="breadcrumb-item"><a href="#">{{ __('Tugas') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Pengumpulan') }}</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-header">
                                <h4>{{ __('Detail Tugas') }}</h4>
                            </div>

                            <div class="card-body">


                                <h4 class="text-capitalize text-dark">{{ $assignment->judul }} ( Materi :
                                    {{ $assignment->materi->judul }})</h4>

                                <h6 class="text-danger">Batas Waktu :
                                    {{ Carbon::parse($assignment->end_date)->format('j F Y') }}</h6>

                                <h6 class="mt-4 text-capitalize text-dark">
                                    Deskripsi :

                                </h6>
                                <p class="text-dark">
                                    {{ $assignment->deskripsi }}
                                </p>

                                <h6 class="text-dark mt-4"> Unduh Berkas Tugas</h6>
                                <a href="{{ asset('file_upload/assignment/' . $assignment->file) }}"
                                    class="btn btn-info btn-md" download>
                                    Unduh
                                </a>

                            </div>


                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card ">
                            {{-- <div class="card-header">
                                <h4>{{ __('Submission') }}</h4>
                            </div> --}}
                            <?php
                            $cek = AssignmentSubmission::where('user_id', '=', Session('user')['id'])->where('assignment_id', '=', $assignment->id)->first();
                            
                            // dd($cek);
                            $currentDateTime = Carbon::now();
                            $endTime = Carbon::parse($assignment->end_date);
                            
                            $checkDelayed = $currentDateTime->lessThanOrEqualTo($endTime);
                            
                            // dd($checkDelayed);
                            
                            ?>
                            <form class="form" action="{{ route('student.submission-assignment', $assignment->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                @if ($checkDelayed == true)
                                    @if ($cek)
                                        <div class="card-body">
                                            <h5 class="text-primary">{{ __('Pengumpulan') }}
                                            </h5>
                                            <h6 class="text-dark mt-4">{{ __('Berkas Pengumpulan Anda') }}</h6>
                                            <a href="{{ asset('file_upload/assignment/' . $cek->file) }}"
                                                class="btn btn-info btn-md" download>
                                                Unduh
                                            </a>

                                            <div class="form-group mt-3">
                                                <label
                                                    class="col-form-label text-md-right ">{{ __('Unggah Berkas Anda') }}</label>
                                                <div class="">

                                                    <input type="file" class="form-control" name="file">

                                                </div>
                                            </div>
                                            <div class="form-group mb-4">

                                                <div class="col-sm-12 col-md-12">
                                                    <button class="btn btn-success"
                                                        type="submit">{{ __('Kirim') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-body">
                                            <h5 class="text-primary">{{ __('Pengumpulan') }}
                                            </h5>


                                            <div class="form-group mt-3">
                                                <label
                                                    class="col-form-label text-md-right ">{{ __('Unggah Berkas Anda') }}</label>
                                                <div class="">

                                                    <input type="file" class="form-control" name="file">

                                                </div>
                                            </div>
                                            <div class="form-group mb-4">

                                                <div class="col-sm-12 col-md-12">
                                                    <button class="btn btn-success"
                                                        type="submit">{{ __('Kirim') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @if ($cek)
                                        <div class="card-body">
                                            <h5 class="text-primary">{{ __('Pengumpulan') }}
                                            </h5>
                                            <h6 class="text-dark mt-4">{{ __('Berkas Pengumpulan Anda') }}</h6>
                                            <a href="{{ asset('file_upload/assignment/' . $cek->file) }}"
                                                class="btn btn-info btn-md" download>
                                                Unduh
                                            </a>


                                        </div>
                                    @else
                                        <div class="card-body">
                                            <h5 class="text-primary">{{ __('Pengumpulan') }} <span class="text-danger"
                                                    style="font-size: 18px"> ({{ __('Terlambat') }})</span>
                                            </h5>


                                            <div class="form-group mt-3">
                                                <label
                                                    class="col-form-label text-md-right ">{{ __('Unggah Berkas Anda') }}</label>
                                                <div class="">

                                                    <input type="file" class="form-control" name="file">

                                                </div>
                                            </div>
                                            <div class="form-group mb-4">

                                                <div class="col-sm-12 col-md-12">
                                                    <button class="btn btn-success"
                                                        type="submit">{{ __('Kirim') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                {{-- @if ($cek !== null)
                                    @if ($checkDelayed == true)
                                        <div class="card-body">
                                            <h5 class="text-primary">Submission <span class="text-danger">{{ __('Delayed') }}</span>
                                            </h5>


                                            <div class="form-group mt-3">
                                                <label class="col-form-label text-md-right ">{{ __('Upload Your
                                                    Submission') }}</label>
                                                <div class="">

                                                    <input type="file" class="form-control" name="file">

                                                </div>
                                            </div>
                                            <div class="form-group mb-4">

                                                <div class="col-sm-12 col-md-12">
                                                    <button class="btn btn-success" type="submit">{{ __('Submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-body">
                                            <h5 class="text-primary">{{ __('Submission') }}</h5>

                                            <h6 class="text-dark mt-4"> Your Submission File</h6>
                                            <a href="{{ asset('file_upload/assignment/' . $cek->file) }}"
                                                class="btn btn-info btn-md" download>
                                                Download
                                            </a>

                                        </div>
                                    @endif
                                @else
                                    <div class="card-body">
                                        <h5 class="text-primary">{{ __('Submission') }}</h5>


                                        <div class="form-group mt-3">
                                            <label class="col-form-label text-md-right ">{{ __('Upload Your
                                                Submission') }}</label>
                                            <div class="">

                                                <input type="file" class="form-control" name="file">

                                            </div>
                                        </div>
                                        <div class="form-group mb-4">

                                            <div class="col-sm-12 col-md-12">
                                                <button class="btn btn-success" type="submit">{{ __('Submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}


                                {{-- </form> --}}
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
    <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

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
