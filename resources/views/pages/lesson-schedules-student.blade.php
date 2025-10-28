@extends('layouts.app')

@section('title', 'Jadwal Pelajaran Saya')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item">Jadwal Pelajaran</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Hari</th>
                                                <th>Waktu</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Ruang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($data as $i => $schedule)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $schedule->day }}</td>
                                                    <td>{{ $schedule->time ? date('H:i', strtotime($schedule->time)) : '-' }}
                                                    </td>
                                                    <td>{{ $schedule->lesson->name ?? '-' }}</td>
                                                    <td>{{ $schedule->room ?? '-' }}</td>
                                                    <td>
                                                        @php
                                                            $isOpen =
                                                                isset($schedule->is_absensi) &&
                                                                $schedule->is_absensi == 'Y';
                                                            $att = $schedule->lessonAttendances->first() ?? null;
                                                        @endphp
                                                        @if ($att)
                                                            @if (isset($att->status) && $att->status == 'Hadir')
                                                                <button class="btn btn-info btn-sm" disabled>Sudah
                                                                    Hadir</button>
                                                            @else
                                                                <button class="btn btn-danger btn-sm" disabled>Tidak
                                                                    Hadir</button>
                                                            @endif
                                                        @else
                                                            <form method="POST"
                                                                action="/student/lesson-schedules/{{ $schedule->id }}/attend"
                                                                class="d-inline">
                                                                @csrf
                                                                <button
                                                                    class="{{ $isOpen ? 'btn btn-success btn-sm' : 'btn btn-secondary btn-sm' }}"
                                                                    type="submit"
                                                                    {{ $isOpen ? '' : 'disabled' }}>{{ $isOpen ? 'Hadir' : 'Absensi Belum di buka' }}</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Belum ada jadwal untuk kelas Anda
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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
@endpush
