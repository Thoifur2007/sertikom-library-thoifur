<x-app-layout>
    <div class="flex flex-col">
        <!-- Hero Section -->
        <div class="p-4 bg-gray-200 rounded-xl border border-gray-500">
            <div class="flex flex-row justify-between gap-8 p-8">
                <img src="images/smk.png" alt="" class="w-full max-w-md">
                {{-- @foreach ($users as $user) --}}
                <div class="flex flex-col justify-center">
                    <h1 class="font-extrabold mb-3 text-4xl">Selamat Pagi, {{Auth::user()->name}} !</h1>
                    @if (Auth::user()->role == 'admin')
                    
                    <p class="text-md mb-5 font-light">
                        Sebagai {{Auth::user()->name}}, Anda memiliki peran penting dalam mengelola dan memastikan kelancaran operasional perpustakaan. 
                        Kelola koleksi buku, data anggota, dan berbagai sumber daya untuk memberikan pengalaman terbaik bagi pengunjung. 
                        Terus tingkatkan pelayanan untuk mendukung komunitas pembaca kami.
                    </p>
                    @endif
                    @if (Auth::user()->role == 'anggota')
                    <p class="text-md mb-5 font-light">
                        Sebagai {{Auth::user()->name}} / Anggota, Anda memiliki akses penuh untuk mengeksplorasi 
                        koleksi buku, jurnal, dan sumber daya lainnya. 
                        Manfaatkan perpustakaan ini untuk memperluas wawasan, belajar, dan berkembang. 
                        Kami siap mendukung perjalanan belajar Anda!
                    </p>
                    @endif
                    @if (Auth::user()->role == 'admin')
                    <div class="flex flex-row gap-4 mt-4">
                        <a href="{{ route('admin.riwayat') }}" class="bg-[#8eb798] p-2 rounded-xl ">Lemari Buku</a>
                        <a href="{{ route('book.create') }}" class="bg-[#325039] p-2 rounded-xl text-white">Buat Buku</a>
                    </div>
                    @endif
                    @if (Auth::user()->role == 'anggota')
                    <div class="flex flex-row gap-4 mt-4">
                        <a href="{{ route('anggota.index') }}" class="bg-[#8eb798] p-2 rounded-xl ">Lemari Buku</a>
                        <a href="{{ route('anggota.riwayat') }}" class="bg-[#325039] p-2 rounded-xl text-white">Pinjam Buku</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>