<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 py-10">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
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
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Buku</h1>
            <form action="{{ route('book.update', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengedit {{ $book->judul_buku }} ini?')">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="col-span-2">
                        <label for="judul_buku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Buku</label>
                        <input type="text" name="judul_buku" id="judul_buku" value="{{ $book->judul_buku }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan judul buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="penulis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penulis</label>
                        <input type="text" name="penulis" id="penulis" value="{{ $book->penulis }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan nama penulis" required>
                    </div>
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                        <select id="kategori" name="kategori" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" required>
                            <option value="fiksi" {{ $book->kategori == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                            <option value="non_fiksi" {{ $book->kategori == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
                            <option value="horor" {{ $book->kategori == 'horor' ? 'selected' : '' }}>Horor</option>
                            <option value="pendidikan" {{ $book->kategori == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ $book->tahun_terbit }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan tahun terbit" required>
                    </div>
                    <div>
                        <label for="jumlah_stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Stok</label>
                        <input type="number" name="jumlah_stock" id="jumlah_stock" value="{{ $book->jumlah_stock }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan jumlah stok" required>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select id="status" name="status" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" required>
                            <option value="1" {{ $book->status ? 'selected' : '' }}>Tersedia</option>
                            <option value="0" {{ !$book->status ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="6" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan deskripsi buku" required>{{ $book->deskripsi }}</textarea>
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full py-2.5 px-4 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">Simpan Perubahan</button>
            </form>
        </div>
    </section>
</x-app-layout>
