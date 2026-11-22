<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Perpustakaan SI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('borrowings.index') }}">Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('members.index') }}">Member</a>
                    </li>
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">User</a>
                    </li>
                    @endif
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">
                        {{ Auth::user()->name }} 
                        <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'warning' }}">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
