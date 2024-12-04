<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 py-10">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Pengguna</h1>
            <form action="{{ route('user.update', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengedit {{ $user->name }} ini?')">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan nama pengguna" required>
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan email pengguna" required>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Peran</label>
                        <select id="role" name="role" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                        </select>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password (optional)</label>
                        <input type="password" name="password" id="password" class="w-full rounded-md border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-400 dark:focus:border-indigo-400 p-2.5" placeholder="Masukkan password pengguna (kosongkan untuk mempertahankan password lama)">
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full py-2.5 px-4 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">Simpan Perubahan</button>
            </form>
        </div>
    </section>
</x-app-layout>
