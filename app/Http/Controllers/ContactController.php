<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // Model untuk menyimpan pesan
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // Menampilkan halaman kontak
    public function index()
    {
        return view('contact.index');
    }

    // Menyimpan pesan dari pengguna
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan pesan ke database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('contact.index')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}