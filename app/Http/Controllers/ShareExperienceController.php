<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShareExperienceController
{
    /**
     * Menyimpan pengalaman baru ke database.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $path = $request->file('image')->store('uploads', 'public');

        DB::table('vacation_experience')->insert([
            'user_id'     => $userId,
            'Title'       => $request->Title,
            'Description' => $request->Description,
            'Tag'         => $request->Tag,
            'image_path'  => $path,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect('/profile')->with('success', 'Experience shared!');
    }

    /**
     * Menampilkan halaman edit untuk satu data pengalaman.
     */
    public function edit($id)
    {
        // Ambil data berdasarkan ID dan pastikan milik user yang sedang login
        $experience = DB::table('vacation_experience')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$experience) {
            return redirect('/profile')->with('error', 'Data tidak ditemukan!');
        }

        return view('edit_experience', compact('experience'));
    }

    /**
     * Memperbarui data pengalaman di database.
     */
    public function update(Request $request, $id)
    {
        // Ambil data lama dari DB
        $oldData = DB::table('vacation_experience')->where('id', $id)->first();

        // Data yang akan diupdate
        $updateData = [
            'Title'       => $request->Title,
            'Description' => $request->Description,
            'Tag'         => $request->Tag,
            'updated_at'  => now(),
        ];

        // Cek apakah user mengupload gambar baru?
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari folder storage agar tidak menumpuk
            if ($oldData && $oldData->image_path) {
                Storage::disk('public')->delete($oldData->image_path);
            }

            // Simpan gambar baru
            $updateData['image_path'] = $request->file('image')->store('uploads', 'public');
        }

        // Eksekusi update ke database
        DB::table('vacation_experience')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->update($updateData);

        return redirect('/profile')->with('success', 'Pengalaman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // 1. Cari data pengalaman berdasarkan ID
        $experience = DB::table('vacation_experience')
                    ->where('id', $id)
                    ->where('user_id', Auth::id()) // Keamanan: Pastikan milik user yang login
                    ->first();

        if (!$experience) {
            return redirect('/profile')->with('error', 'Data tidak ditemukan atau bukan milik Anda!');
        }

        // 2. Hapus file gambar dari folder storage/app/public/uploads
        if ($experience->image_path) {
            Storage::disk('public')->delete($experience->image_path);
        }

        // 3. Hapus baris data dari tabel database
        DB::table('vacation_experience')
            ->where('id', $id)
            ->delete();

        return redirect('/profile')->with('success', 'Pengalaman berhasil dihapus!');
    }


}