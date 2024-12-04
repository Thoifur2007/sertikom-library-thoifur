<x-app-layout>
    <div class="bg-gray-900 min-h-screen p-4 md:p-8">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-white mb-6">Riwayat Peminjaman Buku</h1>
    
            @if($riwayat->isEmpty())
                <div class="bg-gray-700 text-white p-4 rounded-lg shadow-md">
                    Anda belum memiliki riwayat peminjaman.
                </div>
            @else
            @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                {{ session('error') }}
            </div>
        @endif
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-400">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Anggota</th>
                                <th scope="col" class="px-6 py-3">Judul Buku</th>
                                <th scope="col" class="px-6 py-3">Tanggal Pinjam</th>
                                <th scope="col" class="px-6 py-3">Tanggal Kembali</th>
                                <th scope="col" class="px-6 py-3">sisa hari</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $item)
                            
                            <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $item->user->name }}</td>
                                <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                    {{ $item->book->judul_buku}}
                                </td>
                                <td class="px-6 py-4">{{ $item->tanggal_pinjam }}</td>
                                <td class="px-6 py-4">{{ $item->tanggal_kembali }}</td>
                                <td class="px-5 py-3">
                                    @php
                                        $sisaHari = round(\Carbon\Carbon::parse($item->tanggal_pinjam)->diffInDays(
                                            \Carbon\Carbon::parse($item->tanggal_kembali),
                                            false
                                        ));
                                    @endphp
                                    <span class="{{ $sisaHari < 2 ? 'text-red-500' : 'text-green-500' }}">
                                        {{ $sisaHari >= 0 ? $sisaHari . ' Hari' : 'Terlambat ' . abs($sisaHari) . ' Hari' }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if($item->status == 'borrowed')
                                        <span class="bg-yellow-900 text-yellow-300 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="bg-green-900 text-green-300 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->status == 'borrowed')
                                    <form action="{{ route('anggota.kembalikan_buku', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan {{ $item->book->judul_buku }} ini?')">
                                        @csrf
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Kembalikan
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>