<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = book::all();
        return view('book.index', compact(('book')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            'judul_buku' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'status' => 'required|boolean',
            'tahun_terbit' => 'required|integer',
            'jumlah_stock' => 'required|integer',
            'deskripsi' => 'required',
        ]);

        book::create($request->all());

        return redirect('book');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = book::findOrFail($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'status' => 'required|boolean',
            'tahun_terbit' => 'required|integer',
            'jumlah_stock' => 'required|integer',
            'deskripsi' => 'required',
        ]);
       
        $book = book::findOrFail($id);
        $book->update($request->all()); 

        return redirect('book');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan buku berdasarkan ID
        $book = Book::find($id);

        // Cek apakah data ditemukan
        if (!$book) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        // Hapus buku
        $book->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('book.index')->with('success', 'Buku berhasil dihapus.');
    }
}
