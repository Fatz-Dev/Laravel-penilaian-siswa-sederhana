<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiController extends Controller
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
    //
    public function index()
    {
        $siswa = Siswa::with('nilai')->get();
        return view('nilai.index')->with('semuasiswa', $siswa);
    }


    //
    public function store(Request $request)
    {
        foreach ($request->nilai as $siswaid => $nilai) {


            $request->validate([
                'nilai.' . $siswaid => 'required|numeric|min:0|max:100'
            ], [
                'nilai.' . $siswaid . '.required' => 'Nilai harus diisi',
                'nilai.' . $siswaid . '.numeric' => 'Nilai harus berupa angka',
                'nilai.' . $siswaid . '.min' => 'Nilai minimal 0',
                'nilai.' . $siswaid . '.max' => 'Nilai maksimal 100',
            ]);

            // $validatedNilai = $request->input('nilai.' . $siswaid . '.0');

            Nilai::updateOrCreate(
                ['siswa_id' => $siswaid],
                [
                    'nilai' => $nilai,
                    'catatan' => ($nilai >= 75) ? 'Lulus' : 'Tidak Lulus'
                ]
            );
        }

        Alert::success('Berhasil', 'Berhasil Mengupdate Nilai');
        return redirect('nilai');
    }
}
