@extends('layouts.app')

@section('title', 'Manajemen Guru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Guru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
                    <div class="breadcrumb-item">Guru</div>
                </div>
            </div>

            @include('components.alerts')

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ url('/admin/gurus/create') }}" class="btn btn-success btn-block w-25">+ Tambah Guru</a>

                        <div class="card mt-4">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor Induk</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->nomor_induk ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ url('/admin/gurus/' . $item->id . '/edit') }}"
                                                        class="btn btn-secondary btn-sm">Ubah</a>
                                                    <form class="d-inline" method="POST"
                                                        action="{{ url('/admin/gurus/' . $item->id) }}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus guru ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
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
