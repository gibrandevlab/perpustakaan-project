@extends('layouts.welcome')

@section('content')

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Aktivasi Berhasil',
            html: @json(session('success')) + '<br><br><a href="https://wa.me/6285814701149" target="_blank">Hubungi Admin WhatsApp 085814701149</a>',
            footer: @json(session('expire_date') ? 'Lisensi aktif sampai: ' . session('expire_date') : null),
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('activation_info'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Info Aktivasi',
            html: @json(session('activation_info')) + '<br><br><a href="https://wa.me/6285814701149" target="_blank">Hubungi Admin WhatsApp 085814701149</a>',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<div class="container">
@if (Route::has('login'))
    <div class="auth">
        @auth
            <h1>Welcome Back, {{auth()->user()->name}}</h1>
            <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
        @else
        <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-lg text-dark">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-dark">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-dark">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                        <span class="col-md-8 mb-3 text-md-end text-dark">Belum Punya Akun ? <a href="{{ route('register') }}" class="p-0">register</a></span>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary px-5">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
</div>
</div>
        @endif
@endsection
