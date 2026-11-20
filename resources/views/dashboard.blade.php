@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Buku</h5>
                    <p class="card-text fs-2">{{ $totalBooks }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Kategori</h5>
                    <p class="card-text fs-2">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Member</h5>
                    <p class="card-text fs-2">{{ $totalMembers }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Dipinjam</h5>
                    <p class="card-text fs-2">{{ $activeBorrowings }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    Peminjaman Overdue: {{ $overdueBorrowings }}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Peminjaman Terbaru</div>
                <div class="card-body">
                    @if($recentBorrowings->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBorrowings as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->member->name }}</td>
                                        <td>{{ $borrowing->book->title }}</td>
                                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                        <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                                        <td>
                                            @if($borrowing->status === 'borrowed')
                                                <span class="badge bg-warning">Dipinjam</span>
                                            @else
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada peminjaman terbaru.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
