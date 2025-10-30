@extends('layouts.app')

@section('title', 'Detail Guru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Guru: {{ $user->nama_lengkap }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item">Guru</div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card profile-widget">
                            <div class="profile-widget-header text-center mt-3">
                                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                            </div>
                            <div class="profile-widget-description p-3">
                                <h4 class="ml-4 text-capitalize">{{ $user->nama_lengkap }} </h4>
                                <p class="ml-4 text-muted">{{ $user->role }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Informasi Guru</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="200"><strong>Nama Lengkap</strong></td>
                                        <td>{{ $user->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nomor Induk</strong></td>
                                        <td>{{ $user->nomor_induk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat Pada</strong></td>
                                        <td>{{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ url('/admin/gurus/' . $user->id . '/edit') }}" class="btn btn-warning">Ubah</a>
                                <form action="{{ url('/admin/gurus/' . $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                                <a href="{{ url('/admin/gurus') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
