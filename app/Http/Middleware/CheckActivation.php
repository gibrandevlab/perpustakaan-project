<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CheckActivation
{
    public function handle(Request $request, Closure $next)
    {
        $path = storage_path('activated.key');
        $s1 = 'UmFoYXNpYVN1cGVyQW1hbjIwMjQ=';
        $kunciRahasiaX = base64_decode($s1);
        // Allow access to activation page even if not activated
        if ($request->is('activate') || $request->is('activate/*')) {
            return $next($request);
        }
        if (!File::exists($path)) {
            return redirect('/activate')->withErrors(['license_key' => 'Aplikasi belum diaktivasi.']);
        }
        $data = json_decode(File::get($path), true);
        if (!$data) {
            File::delete($path);
            return redirect('/activate')->withErrors(['license_key' => 'File aktivasi rusak. Silakan aktivasi ulang.']);
        }
        if (isset($data['type']) && $data['type'] === 'temporary') {
            $expires = Carbon::parse($data['expires_at']);
            $expected = hash('sha256', $data['type'].$data['activated_at'].$data['expires_at'].$kunciRahasiaX);
            if (!isset($data['signature']) || $data['signature'] !== $expected) {
                File::delete($path);
                return redirect('/activate')->withErrors(['license_key' => 'File aktivasi tidak valid.']);
            }
            if (now()->gt($expires)) {
                File::delete($path);
                return redirect('/activate')->withErrors(['license_key' => 'Aktivasi Anda sudah kedaluwarsa.']);
            }
            session()->flash('activation_info', 'Lisensi aktif sampai: ' . $expires->format('d-m-Y'));
        } else {
            session()->flash('activation_info', 'Lisensi permanen.');
        }
        return $next($request);
    }
}
