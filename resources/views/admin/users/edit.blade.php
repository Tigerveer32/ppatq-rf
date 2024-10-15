@extends('layouts.user_type.auth')

@section('title', 'Edit Pengguna')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Pengguna</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pembina" {{ $user->role == 'pembina' ? 'selected' : '' }}>Pembina</option>
                            <option value="tahfidz" {{ $user->role == 'tahfidz' ? 'selected' : '' }}>Tahfidz</option>
                            <option value="murobby" {{ $user->role == 'murobby' ? 'selected' : '' }}>Murobby</option>
                            <option value="walsan" {{ $user->role == 'walsan' ? 'selected' : '' }}>Wali Santri</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
