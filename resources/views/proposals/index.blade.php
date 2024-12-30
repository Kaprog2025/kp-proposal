<!-- resources/views/proposals/index.blade.php -->

@extends('layouts.app')

@section('title', 'Daftar Proposal KP')

@section('content')
    <div class="container">
        <h2>Daftar Proposal KP</h2>

        <!-- Tampilkan daftar proposal -->
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Proposal</th>
                    <th>Deskripsi</th>
                    <th>Status Pengajuan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                    <tr>
                        <td>{{ $proposal->judul }}</td>
                        <td>{{ Str::limit($proposal->deskripsi, 50) }}</td>
                        <td>
                            @if ($proposal->submission)
                                {{ ucfirst($proposal->submission->status) }}
                            @else
                                <span class="text-muted">Belum diajukan</span>
                            @endif
                        </td>
                        <td>
                            @if (!$proposal->submission)
                                <!-- Tombol ajukan proposal -->
                                <form action="{{ route('proposals.submit', $proposal) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Ajukan Proposal</button>
                                </form>
                            @else
                                <!-- Menampilkan tombol berdasarkan status pengajuan -->
                                @if ($proposal->submission->status == 'pending')
                                    <span class="badge badge-warning">Menunggu Persetujuan</span>
                                @elseif ($proposal->submission->status == 'accepted')
                                    <span class="badge badge-success">Diterima</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
