@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Siswa</div>

                    <div class="card-body">
                        <form action="/siswa/{{ $editsiswa->id }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $editsiswa->user->name }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $editsiswa->nisn }}">
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $editsiswa->user->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" >
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select name="jurusan" class="form-control">
                                    <option @if ($editsiswa->jurusan == 'RPL') selected @endif value="RPL">RPL</option>
                                    <option @if ($editsiswa->jurusan == 'TKJ') selected @endif value="TKJ">TKJ</option>
                                    <option @if ($editsiswa->jurusan == 'MM') selected @endif value="MM">MM</option>
                                    <option @if ($editsiswa->jurusan == 'BC') selected @endif value="BC">BC</option>
                                </select>
                                @error('jurusan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" class="form-control">
                                    <option @if ($editsiswa->kelas == '10') selected @endif value="10">10</option>
                                    <option @if ($editsiswa->kelas == '11') selected @endif value="11">11</option>
                                    <option @if ($editsiswa->kelas == '12') selected @endif value="12">12</option>
                                </select>
                                @error('kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
