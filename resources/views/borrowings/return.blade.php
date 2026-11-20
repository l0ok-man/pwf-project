@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Konfirmasi Pengembalian</div>

                <div class="card-body">
                    <p>Anda yakin ingin mengembalikan peminjaman ini?</p>

                    <div class="alert alert-info">
                        <strong>ID Peminjaman:</strong> {{ $borrowing->id }}<br>
                        <strong>Anggota:</strong> {{ $borrowing->member->name }}<br>
                        <strong>Buku:</strong> {{ $borrowing->book->title }}<br>
                        <strong>Tanggal Pinjam:</strong> {{ $borrowing->borrow_date->format('d/m/Y') }}<br>
                        <strong>Jatuh Tempo:</strong> {{ $borrowing->due_date->format('d/m/Y') }}<br>
                    </div>

                    <form method="POST" action="{{ route('borrowings.confirmReturn', $borrowing) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Konfirmasi Pengembalian</button>
                        <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
