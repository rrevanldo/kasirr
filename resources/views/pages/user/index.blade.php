@extends('layout.dashboard')
@section('title', 'Accounts')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Akun</h1>
        </div>
    </section>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <b>Success:</b>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tabel Akun</h4>
                    <div class="card-header-form">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Akun Baru</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Terakhir Login</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($userAccounts as $acc)
                                <tr>
                                    <td>{{ $acc->name }}</td>
                                    <td>{{ $acc->username }}</td>
                                    @if ($acc->hasRole('administrator'))
                                        <td>
                                            <div class="badge badge-danger">Admin</div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="badge badge-warning">Petugas</div>
                                        </td>
                                    @endif
                                    @if ($acc->last_login == null)
                                        <td>Belum Login</td>
                                    @else
                                        <td>{{ $acc->last_login }}</td>
                                    @endif
                                    <td>
                                        <form method="post" action="{{ route('user.delete', $acc->id) }}">
                                            <a href="{{ route('user.edit', $acc->id) }}" class="btn btn-primary">Edit</a>
                                            @method('DELETE')
                                            @csrf
                                            @if (Auth::user()->id != $acc->id)
                                                <button class="btn btn-danger" onclick="buttonConfirm()">Delete</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="p-4">
                        {{ $userAccounts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
