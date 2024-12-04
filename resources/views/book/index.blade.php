<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 ">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">Daftar Buku</h1>
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

            <!-- Tabel Daftar Buku -->
            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                <table class="w-full table-auto text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Judul Buku</th>
                            <th scope="col" class="px-6 py-4">Penulis</th>
                            <th scope="col" class="px-6 py-4">Kategori</th>
                            <th scope="col" class="px-6 py-4">Tahun Terbit</th>
                            <th scope="col" class="px-6 py-4">Jumlah Stok</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Deskripsi</th>
                            <th scope="col" class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($book as $buku)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 w-max">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ $buku->judul_buku }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ $buku->penulis }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        {{ $buku->kategori == 'fiksi' ? 'bg-blue-100 text-blue-600' : '' }}
                                        {{ $buku->kategori == 'non_fiksi' ? 'bg-green-100 text-green-600' : '' }}
                                        {{ $buku->kategori == 'horor' ? 'bg-purple-100 text-purple-600' : '' }}
                                        {{ $buku->kategori == 'pendidikan' ? 'bg-yellow-100 text-yellow-600' : '' }}">
                                        {{ ucfirst($buku->kategori) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ $buku->tahun_terbit }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ $buku->jumlah_stock }}
                                </td>
                                <td class=" py-4">
                                    <span class="p-1 rounded-full text-xs font-semibold 
                                        {{ $buku->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ $buku->status ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ $buku->deskripsi }}
                                </td>
                                <td class="px-6 py-4 flex items-center gap-2">
                                    <form action="{{ route('book.edit', $buku->id) }}" method="POST" 
                                        class="inline" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin mengedit {{ $buku->judul_buku }} ini?')">
                                      @csrf
                                      @method('GET')
                                      <button type="submit" 
                                              class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-300">
                                          Edit
                                      </button>
                                  </form>
                                    <form action="{{ route('book.destroy', $buku->id) }}" method="POST" 
                                          class="inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
