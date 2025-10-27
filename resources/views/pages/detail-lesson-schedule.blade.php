@extends('layouts.app')

@section('title', 'Detail Jadwal Pelajaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Jadwal Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item"><a href="#">Jadwal Pelajaran</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <!-- Schedule Information -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Informasi Jadwal</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>Pelajaran:</strong></td>
                                                <td>{{ $schedule->lesson->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Guru:</strong></td>
                                                <td>{{ $schedule->lesson->user->nama_lengkap ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Kelas:</strong></td>
                                                <td>{{ $schedule->class->name ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>Hari:</strong></td>
                                                <td><span class="badge badge-primary badge-lg">{{ $schedule->day }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Waktu:</strong></td>
                                                <td><span
                                                        class="badge badge-info badge-lg">{{ $schedule->time ? date('H:i', strtotime($schedule->time)) : '-' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ruang:</strong></td>
                                                <td><span
                                                        class="badge badge-warning badge-lg">{{ $schedule->room ?? 'Tidak ditentukan' }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Statistics -->
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Murid</h4>
                                </div>
                                <div class="card-body">
                                    {{ $schedule->class->users()->where('role', 'Murid')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="far fa-check-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Hadir</h4>
                                </div>
                                <div class="card-body">
                                    {{ $schedule->lessonAttendances()->where('status', 'Hadir')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-times-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Tidak Hadir</h4>
                                </div>
                                <div class="card-body">
                                    {{ $schedule->lessonAttendances()->where('status', 'Tidak Hadir')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="far fa-calendar"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Dibuat Pada</h4>
                                </div>
                                <div class="card-body">
                                    {{ $schedule->created_at ? $schedule->created_at->format('M Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Class Students -->
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Murid di Kelas Ini</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Nomor Induk</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($schedule->class->users()->where('role', 'Murid')->get() as $index => $student)
                                                @php
                                                    $attendance = $schedule
                                                        ->lessonAttendances()
                                                        ->where('user_id', $student->id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $student->nama_lengkap }}</td>
                                                    <td>{{ $student->nomor_induk }}</td>
                                                    <td>
                                                        @if ($attendance)
                                                            @if ($attendance->status == 'Hadir')
                                                                <span
                                                                    class="badge badge-success">{{ $attendance->status }}</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-danger">{{ $attendance->status }}</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-secondary">Belum ada catatan</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Belum ada murid di kelas ini</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Records -->
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Kehadiran</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <thead>
                                            <tr>
                                                <th>Murid</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($schedule->lessonAttendances()->with('user')->orderBy('created_at', 'desc')->get() as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->user->nama_lengkap ?? '-' }}</td>
                                                    <td>
                                                        @if ($attendance->status == 'Hadir')
                                                            <span
                                                                class="badge badge-success">{{ $attendance->status }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ $attendance->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $attendance->created_at ? $attendance->created_at->format('d M Y H:i') : '-' }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">Belum ada catatan kehadiran</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <a href="/teacher/lesson-schedules/{{ $schedule->id }}/edit" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Ubah Jadwal
                                </a>
                                <a href="/teacher/lesson-schedules" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Kembali ke Jadwal
                                </a>
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
@endpush
