<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold text-white mb-6">Riwayat Peminjaman Buku</h1>

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
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
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
                    @forelse($riwayat as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $item->user->name }}</td>
                            <td class="px-6 py-4">{{ $item->book->judul_buku }}</td>
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
                                @if($item->status === 'borrowed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Dipinjam
                                    </span>
                                @elseif($item->status === 'returned')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Dikembalikan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-y-2">
                                @if($item->status === 'borrowed')
                                    <!-- Tombol Perpanjang -->
                                    <button data-modal-target="modal-perpanjang-{{ $item->id }}" 
                                        data-modal-toggle="modal-perpanjang-{{ $item->id }}" 
                                        class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">
                                        Perpanjang
                                    </button>

                                    <!-- Form Selesaikan -->
                                    <form action="{{ route('admin.selesaikan-peminjaman', $item->id) }}" method="POST" class="inline" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                            Selesaikan
                                        </button>
                                    </form>

                                    <!-- Modal Perpanjang -->
                                    <div id="modal-perpanjang-{{ $item->id }}" tabindex="-1" 
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal h-full">
                                        <div class="relative w-full max-w-md mx-auto">
                                            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                                                <div class="flex justify-between items-center p-4 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Perpanjang Peminjaman
                                                    </h3>
                                                    <button type="button" 
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                                                        data-modal-hide="modal-perpanjang-{{ $item->id }}">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="p-6">
                                                    <form action="{{ route('admin.perpanjang-peminjaman', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memperpanjang tanggal peminjaman?')">
                                                        @csrf
                                                        <label for="tanggal_kembali_baru" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                                            Tanggal Kembali Baru
                                                        </label>
                                                        <input type="date" id="tanggal_kembali_baru" name="tanggal_kembali_baru" required 
                                                            class="w-full px-3 py-2 mb-4 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-600 dark:text-gray-200">
                                                        <button type="submit" 
                                                            class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            Perpanjang
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button class="px-3 py-1 text-gray-500 bg-gray-200 rounded" disabled>Sudah Dikembalikan</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada riwayat peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
