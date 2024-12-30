<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container">
        <h2>Dashboard Admin</h2>

        <!-- Menampilkan pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistik Proposal -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-header">Total Proposal</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalProposals }}</h5>
                        <p class="card-text">Jumlah total proposal yang telah dibuat.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-header">Proposal Diterima</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $acceptedProposals }}</h5>
                        <p class="card-text">Jumlah proposal yang diterima.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger">
                    <div class="card-header">Proposal Ditolak</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $rejectedProposals }}</h5>
                        <p class="card-text">Jumlah proposal yang ditolak.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form untuk menambah mahasiswa -->
        <div class="card mb-4">
            <div class="card-header">Tambah Mahasiswa</div>
            <div class="card-body">
                <form action="{{ route('admin.add-student') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Mahasiswa</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" name="nim" id="nim" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
                </form>
            </div>
        </div>

        <!-- Form untuk membuat jadwal pengajuan -->
        <div class="card">
            <div class="card-header">Buat Jadwal Pengajuan</div>
            <div class="card-body">
                <form action="{{ route('admin.create-schedule') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                </form>
            </div>
        </div>
    </div>
@endsection
