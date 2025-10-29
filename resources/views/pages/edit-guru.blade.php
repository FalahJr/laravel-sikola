@extends('layouts.app')

@section('title', 'Ubah Guru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Guru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item">Guru</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('/admin/gurus/' . $user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control"
                                            value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Nomor Induk</label>
                                        <input type="text" name="nomor_induk" class="form-control"
                                            value="{{ old('nomor_induk', $user->nomor_induk) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Password (kosongkan jika tidak ingin mengubah)</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ url('/admin/gurus') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
