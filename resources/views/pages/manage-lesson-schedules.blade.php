@extends('layouts.app')

@section('title', 'Manajemen Jadwal Pelajaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Jadwal Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="#">Jadwal Pelajaran</a></div>
                </div>
            </div>

            @include('components.alerts')

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ Session('user')['role'] == 'Guru' ? url('/teacher/lesson-schedules/create') : url('/admin/lesson-schedules/create') }}"
                            class="btn btn-success btn-block w-25">+ Tambah
                            Jadwal</a>
                        <div class="card mt-4">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Hari</th>
                                            <th>Waktu</th>
                                            <th>Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Ruang</th>
                                            <th>Kehadiran</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>

                                        @foreach ($data as $list)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>
                                                    <div class="badge badge-primary">{{ $list->day }}</div>
                                                </td>
                                                <td>
                                                    @if ($list->start_time)
                                                        @if ($list->end_time)
                                                            {{ date('H:i', strtotime($list->start_time)) }} -
                                                            {{ date('H:i', strtotime($list->end_time)) }}
                                                        @else
                                                            {{ date('H:i', strtotime($list->start_time)) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $list->lesson_name }}</td>
                                                <td>{{ $list->class_name }}</td>
                                                <td>{{ $list->room ?? '-' }}</td>
                                                <td>
                                                    <div class="badge badge-info">
                                                        {{ \App\Models\LessonAttendance::where('lesson_schedule_id', $list->id)->count() }}
                                                        Catatan
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ Session('user')['role'] == 'Guru' ? url('/teacher/lesson-schedules/' . $list->id . '/edit') : url('/admin/lesson-schedules/' . $list->id . '/edit') }}"
                                                        class="btn btn-secondary btn-sm">Ubah</a>
                                                    <a href="{{ Session('user')['role'] == 'Guru' ? url('/teacher/lesson-schedules/' . $list->id) : url('/admin/lesson-schedules/' . $list->id) }}"
                                                        class="btn btn-info btn-sm">Detail</a>
                                                    <form class="d-inline mt-2" method="POST"
                                                        action="{{ Session('user')['role'] == 'Guru' ? url('/teacher/lesson-schedules/' . $list->id) : url('/admin/lesson-schedules/' . $list->id) }}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Anda yakin ingin menghapus jadwal ini?')">
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
