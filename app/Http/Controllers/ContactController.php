<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('kontak');
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->safe()->only(['name', 'email', 'phone', 'subject', 'message']),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('kontak')
            ->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera dibalas.');
    }
}
