<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Verifikasi CAPTCHA Cloudflare Turnstile
        $turnstileResponse = $request->input('cf-turnstile-response');
        $secretKey = config('services.turnstile.secret');

        if (!$turnstileResponse) {
            return back()->withErrors(['captcha' => 'Verifikasi keamanan (CAPTCHA) wajib diisi.'])->withInput();
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secretKey,
            'response' => $turnstileResponse,
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return back()->withErrors(['captcha' => 'Verifikasi keamanan gagal. Silakan coba lagi.'])->withInput();
        }

        // 2. Simpan pesan kontak
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera kami balas.');
    }
}
