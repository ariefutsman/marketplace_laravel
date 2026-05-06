@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar User</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        {{-- Tampilkan Pesan Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tampilkan Pesan Error --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-bordered m-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Bergabung</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(auth()->user()->role === 'admin' && $user->id !== auth()->id())
                                <form action="{{ route('users.update-role', $user->id) }}" method="POST" class="d-inline" id="form-{{ $user->id }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="form-select form-select-sm" onchange="document.getElementById('form-{{ $user->id }}').submit()">
                                        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                                @elseif($user->id === auth()->id())
                                <span class="text-muted small">(Anda sendiri)</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection