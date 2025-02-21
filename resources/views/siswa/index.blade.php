@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Siswa</div>

                    <div class="card-body">
                        <a href="/siswa/create" class="btn btn-primary">Tambah Siswa</a>
                        <hr>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nisn</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuasiswa as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->user->name }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->kelas }}</td>
                                        <td>{{ $siswa->jurusan }}</td>
                                        <td>
                                            <a href="/siswa/{{ $siswa->id }}/edit"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="/siswa/{{ $siswa->id }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
