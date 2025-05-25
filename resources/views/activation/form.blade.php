@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light px-3">
    <div class="card shadow-sm w-100" style="max-width: 420px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-3 text-primary">Aktivasi Aplikasi</h2>
            <p class="text-center text-muted mb-4">Masukkan kode aktivasi untuk melanjutkan.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi Kesalahan:</strong> {{ $errors->first('license_key') }}<br>
                    <a href="https://wa.me/6285814701149" target="_blank" class="text-decoration-underline text-primary">
                        Hubungi Admin WhatsApp: 0858-1470-1149
                    </a>
                </div>
            @endif

            <form method="POST" action="{{ route('activation.activate') }}">
                @csrf
                <div class="mb-3">
                    <label for="license_key" class="form-label">Kode Aktivasi</label>
                    <input
                        type="text"
                        id="license_key"
                        name="license_key"
                        required
                        autofocus
                        class="form-control @error('license_key') is-invalid @enderror"
                        placeholder="Masukkan kode aktivasi"
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Aktifkan Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
