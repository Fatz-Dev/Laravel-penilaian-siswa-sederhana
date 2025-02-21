@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <p>Selamat Datang</p>
                        <h5>{{ Auth::user()->name }}</h5>
                        @if (Auth::user()->peran == 'siswa')
                            <p>Setelah menimbang nilai anda adalah</p>
                            <h3 class="text-center">
                                @if (Auth::user()->siswa->nilai)
                                    {{ Auth::user()->siswa->nilai->nilai }}
                                @else
                                    Belum di nilai
                                @endif
                            </h3>
                            <h3 class="text-center">
                                @if (Auth::user()->siswa->nilai)
                                    {{ Auth::user()->siswa->nilai->catatan }}
                                @endif
                            </h3>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
