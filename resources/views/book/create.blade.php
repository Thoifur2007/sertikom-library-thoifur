<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <h1 class="text-3xl font-semibold text-gray-500 dark:text-white mb-6">Tambah Buku</h1>
            <form action="{{ route('book.store') }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md"onsubmit="return confirm('Apakah Anda yakin ingin membuat buku ini?')">
                @csrf

                <!-- Judul Buku -->
                <div>
                    <label for="judul_buku" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Judul Buku
                    </label>
                    <input type="text" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Penulis
                    </label>
                    <input type="text" id="penulis" name="penulis" placeholder="Tuliskan nama penulis"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Kategori
                    </label>
                    <select id="kategori" name="kategori"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <option selected disabled>Pilih Kategori</option>
                        <option value="fiksi">Fiksi</option>
                        <option value="non_fiksi">Non Fiksi</option>
                        <option value="horor">Horor</option>
                        <option value="pendidikan">Pendidikan</option>
                    </select>
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tahun Terbit
                    </label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit" placeholder="Tahun terbit buku"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                <!-- Jumlah Stok -->
                <div>
                    <label for="jumlah_stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Jumlah Stok
                    </label>
                    <input type="number" id="jumlah_stock" name="jumlah_stock" placeholder="Jumlah stok buku"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Status
                    </label>
                    <select id="status" name="status"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <option value="1">Tersedia</option>
                        <option value="0">Tidak Tersedia</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="5"
                        class="mt-1 block w-full px-4 py-2 text-sm border rounded-md focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Deskripsi buku" required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:bg-primary-500 dark:hover:bg-primary-600">
                        Tambah Buku
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
