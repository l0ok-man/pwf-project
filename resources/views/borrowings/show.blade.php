@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Peminjaman #{{ $borrowing->id }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Anggota:</div>
                        <div class="col-md-8">{{ $borrowing->member->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email Anggota:</div>
                        <div class="col-md-8">{{ $borrowing->member->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Buku:</div>
                        <div class="col-md-8">{{ $borrowing->book->title }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Kategori:</div>
                        <div class="col-md-8">{{ $borrowing->book->category->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Petugas:</div>
                        <div class="col-md-8">{{ $borrowing->user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Pinjam:</div>
                        <div class="col-md-8">{{ $borrowing->borrow_date->format('d/m/Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Jatuh Tempo:</div>
                        <div class="col-md-8">{{ $borrowing->due_date->format('d/m/Y') }}</div>
                    </div>
                    @if($borrowing->return_date)
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Kembali:</div>
                            <div class="col-md-8">{{ $borrowing->return_date->format('d/m/Y') }}</div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status:</div>
                        <div class="col-md-8">
                            @if($borrowing->status === 'borrowed')
                                <span class="badge bg-warning">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                    @if($borrowing->status === 'borrowed')
                        <a href="{{ route('borrowings.return', $borrowing) }}" class="btn btn-success">Kembalikan Buku</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
