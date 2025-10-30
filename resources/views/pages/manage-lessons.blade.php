@extends('layouts.app')

@section('title', 'Manajemen Pelajaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="#">Pelajaran</a></div>
                </div>
            </div>

            @include('components.alerts')

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('add-lesson') }}" class="btn btn-success btn-block w-25">+ Tambah Pelajaran</a>
                        <div class="card mt-4">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Total Jadwal</th>
                                            <th>Total Materi</th>
                                            <th>Dibuat Pada</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>

                                        @foreach ($data as $list)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->nama_lengkap }}</td>
                                                <td>
                                                    <div class="badge badge-info">
                                                        {{ \App\Models\LessonSchedule::where('lesson_id', $list->id)->count() }}
                                                        Jadwal
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-success">
                                                        {{ \App\Models\Materi::where('lesson_id', $list->id)->count() }}
                                                        Materi
                                                    </div>
                                                </td>
                                                <td>{{ $list->created_at ? $list->created_at->format('d M Y') : '-' }}</td>
                                                <td>
                                                    <a href="lessons/{{ $list->id }}/edit"
                                                        class="btn btn-secondary">Ubah</a>
                                                    <a href="lessons/{{ $list->id }}" class="btn btn-info">Detail</a>
                                                    <form class="ml-auto mr-auto mt-3" method="POST"
                                                        action="/admin/lessons/{{ $list->id }}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Anda yakin ingin menghapus pelajaran ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">{{ __('(current)') }}</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
