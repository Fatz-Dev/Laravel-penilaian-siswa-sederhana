<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SiswaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($req, $next) {
            if (Auth::user()->peran != 'guru') {
                abort(403, 'Anda tidak memiliki izin untuk mengakases halaman ini');
            }
            return $next($req);
        });
    }
    //untuk menampilkan data siswa
    public function index()
    {
        $semuasiswa = Siswa::all();
        return view('siswa.index', compact('semuasiswa'));
    }

    //untuk menampilkan form tambah data siswa
    public function create()
    {
        return view('siswa.create');
    }


    //untuk menyimpan data siswa
    public function store(Request $req)
    {
        //validasi inputan
        $this->validate($req, [
            //validasi inputan
            'nama' => 'required',
            'nisn' => 'required|numeric',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required',
            'kelas' => 'required|integer',
            'jurusan' => 'required',
        ], [
            //pesan error
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.numeric' => 'NISN harus berupa angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'kelas.required' => 'Kelas harus dipilih',
            'kelas.integer' => 'Kelas harus berupa dipilih'
        ]);

        //untuk menyimpan data user
        $simpan = new User();
        $simpan->name = $req->nama;
        $simpan->email = $req->email;
        $simpan->password = bcrypt($req->password);
        $simpan->peran = 'siswa';
        $simpan->save();

        //untuk menyimpan data siswa
        $simpansiswa = new Siswa();
        $simpansiswa->user_id = $simpan->id;
        $simpansiswa->nisn = $req->nisn;
        $simpansiswa->kelas = $req->kelas;
        $simpansiswa->jurusan = $req->jurusan;
        $simpansiswa->save();

        return redirect('/siswa')->with('sukses', 'Data berhasil disimpan');
    }


    //untuk menampilkan form edit data siswa
    public function edit($id)
    {
        $editsiswa = Siswa::find($id);
        return view('siswa.edit')->with('editsiswa', $editsiswa);
    }

    //untuk menyimpan data siswa yang sudah diedit
    public function update(Request $req, $id)
    {
        //validasi inputan
        $this->validate($req, [
            //validasi inputan
            'nama' => 'required',
            'nisn' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . Siswa::find($id)->user_id,
            'kelas' => 'required|integer',
            'jurusan' => 'required',
        ], [
            //pesan error
            'nama.required' => 'Nama harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.numeric' => 'NISN harus berupa angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'kelas.required' => 'Kelas harus dipilih',
            'kelas.integer' => 'Kelas harus berupa dipilih'
        ]);
        $userid = Siswa::find($id)->user_id;
        $siswaid = Siswa::find($id)->id;

        //
        $simpan = User::find($userid);
        $simpan->name = $req->nama;
        $simpan->email = $req->email;
        if ($req->password != null) {
            $simpan->password = bcrypt($req->password);
        }
        $simpan->peran = 'siswa';
        $simpan->save();

        //untuk menyimpan data siswa
        $simpansiswa = Siswa::find($siswaid);
        $simpansiswa->user_id = $simpan->id;
        $simpansiswa->nisn = $req->nisn;
        $simpansiswa->kelas = $req->kelas;
        $simpansiswa->jurusan = $req->jurusan;
        $simpansiswa->save();

        return redirect('/siswa')->with('sukses', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        $userid = Siswa::find($id)->user_id;
        $siswaid = Siswa::find($id)->id;

        Siswa::destroy($siswaid);
        User::destroy($userid);

        return redirect('/siswa');
    }
}
