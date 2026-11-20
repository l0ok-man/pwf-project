@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="mb-4">Catat Peminjaman</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('borrowings.store') }}" method="POST" class="card p-4">
                @csrf

                <div class="mb-3">
                    <label for="book_id" class="form-label">Buku</label>
                    <select class="form-select @error('book_id') is-invalid @enderror" 
                            id="book_id" name="book_id" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                {{ $book->title }} ({{ $book->category->name }}) - Tersedia: {{ $book->available_stock }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="member_id" class="form-label">Member</label>
                    <select class="form-select @error('member_id') is-invalid @enderror" 
                            id="member_id" name="member_id" required>
                        <option value="">-- Pilih Member --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->name }} ({{ $member->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('member_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Tanggal Tempo</label>
                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                           id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                    @error('due_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">Simpan</button>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
