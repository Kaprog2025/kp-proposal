<!-- resources/views/proposals/create.blade.php -->

@extends('layouts.app')

@section('title', 'Buat Draf Proposal KP')

@section('content')
    <div class="container">
        <h2>Buat Draf Proposal KP</h2>
        
        <!-- Form untuk membuat proposal -->
        <form action="{{ route('proposals.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul">Judul Proposal</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi Proposal</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mahasiswa_id">Pilih Mahasiswa</label>
                <select name="mahasiswa_id" id="mahasiswa_id" class="form-control" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ old('mahasiswa_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->nim }})
                        </option>
                    @endforeach
                </select>
                @error('mahasiswa_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Buat Proposal</button>
        </form>
    </div>
@endsection
