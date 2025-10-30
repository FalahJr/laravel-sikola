@extends('layouts.app')

@section('title', 'Detail Murid')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Murid: {{ $murid->nama_lengkap }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item">Murid</div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card profile-widget">
                            <div class="profile-widget-header text-center mt-3">
                                @if ($murid->gambar)
                                    <img alt="image" src="{{ asset('img/murid/' . $murid->gambar) }}"
                                        class="rounded-circle profile-widget-picture">
                                @else
                                    <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @endif
                            </div>
                            <div class="profile-widget-description p-3">
                                <h4 class="text-center">{{ $murid->nama_lengkap }}</h4>
                                <p class="text-center text-muted">{{ $murid->class ? $murid->class->name : '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Informasi Murid</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="200"><strong>Nama Lengkap</strong></td>
                                        <td>{{ $murid->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>{{ $murid->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nomor Induk</strong></td>
                                        <td>{{ $murid->nomor_induk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat</strong></td>
                                        <td>{{ $murid->alamat ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat Pada</strong></td>
                                        <td>{{ $murid->created_at ? $murid->created_at->format('d M Y H:i') : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ url('/admin/manage-student/' . $murid->id . '/edit') }}"
                                    class="btn btn-warning">Ubah</a>
                                <form action="{{ url('/admin/manage-student/' . $murid->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus murid ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                                <a href="{{ url('/admin/manage-student') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
