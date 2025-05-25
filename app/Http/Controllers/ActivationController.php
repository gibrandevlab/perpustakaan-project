<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class ActivationController extends Controller
{
    public function showForm()
    {
        return view('activation.form');
    }

    public function activate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
        ]);

        $inputKey = $request->input('license_key');
        $permanentHash = env('LICENSE_KEY_HASH_PERMANENT');
        $expireHash = env('LICENSE_KEY_HASH_EXPIRE');
        $e1 = 'MjAyNS0wNi0wMg==';
        $x1y2z3 = base64_decode($e1);
        $s1 = 'UmFoYXNpYVN1cGVyQW1hbjIwMjQ=';
        $kunciRahasiaX = base64_decode($s1);

        if (Hash::check($inputKey, $permanentHash)) {
            $data = [
                'type' => 'permanent',
                'activated_at' => now()->toDateString(),
            ];
            File::put(storage_path('activated.key'), json_encode($data));
            return redirect('/')
                ->with('success', 'Aplikasi berhasil diaktivasi! Lisensi permanen.');
        }

        if (Hash::check($inputKey, $expireHash)) {
            if (now()->format('Y-m-d') <= $x1y2z3) {
                $data = [
                    'type' => 'temporary',
                    'activated_at' => now()->toDateString(),
                    'expires_at' => $x1y2z3,
                ];
                $data['signature'] = hash('sha256', $data['type'].$data['activated_at'].$data['expires_at'].$kunciRahasiaX);
                File::put(storage_path('activated.key'), json_encode($data));
                return redirect('/')
                    ->with('success', 'Aplikasi berhasil diaktivasi! Lisensi aktif sampai: ' . $x1y2z3);
            } else {
                return back()->withErrors(['license_key' => 'Kode ini sudah kedaluwarsa.']);
            }
        }

        return back()->withErrors(['license_key' => 'Kode aktivasi salah.']);
    }
}
