<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\pinjambuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = book::all();
        return view('anggota.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loan = pinjambuku::all();
        return view('anggota.create', compact('loan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);
    
        // Ambil buku berdasarkan ID
        $book = Book::findOrFail($request->input('book_id'));
    
        // Cek apakah buku tersedia
        if ($book->jumlah_stock <= 0 || !$book->status) { 
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }
    
        // Kurangi stok buku
        $book->decrement('jumlah_stock');
    
        // Buat data peminjaman
        Pinjambuku::create([
            'user_id' => Auth::id(),
            'book_id' => $request->input('book_id'),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'borrowed',
        ]);
    
        // Update status buku jika stok habis
        if ($book->jumlah_stock <= 0) {
            $book->update([
                'status' => false, // Buku tidak tersedia
                'loan_status' => 'borrowed', // Status pinjam
            ]);
        } else {
            $book->update([
                'loan_status' => 'borrowed', // Buku sedang dipinjam
            ]);
        }
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
 * Menampilkan riwayat peminjaman buku untuk pengguna yang sedang login
 */
public function riwayatPeminjaman()
{
    // Ambil riwayat peminjaman untuk user yang sedang login, diurutkan dari yang terbaru
    $riwayat = Pinjambuku::where('user_id', Auth::id())
        ->with('book') // Eager loading untuk mengambil data buku terkait
        ->orderBy('created_at', 'desc')
        ->get();

    return view('anggota.riwayat', compact('riwayat'));
}

/**
 * Proses pengembalian buku
 */
public function kembalikanBuku(Request $request, $id)
{
    // Cari data peminjaman
    $pinjaman = Pinjambuku::findOrFail($id);

    // Pastikan hanya pemilik peminjaman yang bisa mengembalikan
    if ($pinjaman->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengembalikan buku ini.');
    }

    // Cari buku terkait
    $book = Book::findOrFail($pinjaman->book_id);

    // Update status peminjaman
    $pinjaman->update([
        'status' => 'returned',
        'tanggal_pengembalian' => now() // Tambahkan tanggal pengembalian aktual
    ]);

    // Kembalikan stok buku
    $book->increment('jumlah_stock');

    // Update status buku
    $book->update([
        'status' => true, // Buku kembali tersedia
        'loan_status' => 'available' // Status pinjam diubah
    ]);

    return redirect()->route('anggota.riwayat')->with('success', 'Buku berhasil dikembalikan!');
}

/**
 * Menampilkan riwayat buku yang telah dipinjam dan sedang dipinjam oleh anggota
 */
public function riwayatPeminjamanAdmin()
{
    $riwayat = Pinjambuku::with(['book', 'user'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.riwayat', compact('riwayat'));
}

/**
 * Memperpanjang tanggal peminjaman
 */
public function perpanjangPeminjaman(Request $request, $id)
{
    $request->validate([
        'tanggal_kembali_baru' => 'required|date|after:today'
    ]);

    $pinjaman = Pinjambuku::findOrFail($id);

    if ($pinjaman->status !== 'borrowed') {
        return redirect()->back()->with('error', 'Peminjaman ini tidak dapat diperpanjang.');
    }
    

    $pinjaman->update([
        'tanggal_kembali' => $request->tanggal_kembali_baru,
    ]);

    return redirect()->back()->with('success', 'Tanggal peminjaman berhasil diperpanjang.');
}

/**
 * Menyelesaikan peminjaman
 */
public function selesaikanPeminjaman($id)
{
    $pinjaman = Pinjambuku::findOrFail($id);

    // Pastikan peminjaman berstatus "borrowed"
    if ($pinjaman->status !== 'borrowed') {
        return redirect()->back()->with('error', 'Peminjaman ini sudah selesai.');
    }

    // Cari buku terkait
    $book = Book::findOrFail($pinjaman->book_id);

    // Update status peminjaman
    $pinjaman->update([
        'status' => 'returned',
        'tanggal_pengembalian' => now(),
    ]);

    // Kembalikan stok buku
    $book->increment('jumlah_stock');

    // Update status buku
    $book->update([
        'status' => true,
        'loan_status' => 'available',
    ]);

    return redirect()->back()->with('success', 'Peminjaman berhasil diselesaikan.');
}

}