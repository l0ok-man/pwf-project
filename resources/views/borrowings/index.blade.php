@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Daftar Peminjaman</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('borrowings.create') }}" class="btn btn-primary">+ Catat Peminjaman</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Buku</th>
                    <th>Member</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowings as $borrowing)
                    <tr>
                        <td>{{ ($borrowings->currentPage() - 1) * $borrowings->perPage() + $loop->iteration }}</td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td>{{ $borrowing->member->name }}</td>
                        <td>{{ $borrowing->borrow_date->format('d-m-Y') }}</td>
                        <td>
                            {{ $borrowing->due_date->format('d-m-Y') }}
                            @if ($borrowing->isOverdue())
                                <span class="badge bg-danger">OVERDUE</span>
                            @endif
                        </td>
                        <td>{{ $borrowing->return_date?->format('d-m-Y') ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $borrowing->status === 'returned' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($borrowing->status) }}
                            </span>
                        </td>
                        <td>{{ $borrowing->user->name }}</td>
                        <td>
                            @if ($borrowing->status === 'borrowed')
                                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Kembalikan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada peminjaman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $borrowings->links() }}
    </div>
</div>
@endsection
