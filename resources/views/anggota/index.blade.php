<x-app-layout>
    <section class="py-8 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            @if($book->isEmpty())
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <p class="text-2xl text-gray-500">No books available at the moment</p>
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
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($book as $buku)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                            
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ $buku->judul_buku }}
                                </h3>
                                
                                <div class="space-y-2 mb-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium">Author:</span> {{ $buku->penulis }}
                                    </p>
                                    
                                    <p class="text-sm {{ $buku->status ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $buku->status ? 'Available' : 'Not Available' }}
                                    </p>
                                    
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">Category:</span> {{ $buku->kategori }}
                                    </p>
                                </div>
                                
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                                        Stock: {{ $buku->jumlah_stock }}
                                    </span>
                                </div>
                                
                                @if ($buku->status == '1' && $buku->jumlah_stock > 0)
                                    <button 
                                        type="button" 
                                        data-modal-target="modal-{{ $buku->id }}" 
                                        data-modal-toggle="modal-{{ $buku->id }}"
                                        class="w-full bg-blue-700 text-white py-2 rounded-lg hover:bg-primary-800 transition-colors duration-300 dark:bg-primary-600 dark:hover:bg-primary-700"
                                    >
                                        Borrow Book
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Modal Pinjam Buku - Unchanged from original -->
                        <div 
                            id="modal-{{ $buku->id }}" 
                            tabindex="-1" 
                            aria-hidden="true" 
                            class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
                        >
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Borrow Book
                                        </h3>
                                        
                                        <button 
                                            type="button" 
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                                            data-modal-hide="modal-{{ $buku->id }}"
                                        >
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    
                                    <div class="p-4 md:p-5">
                                        <form 
                                            class="grid gap-4 sm:grid-cols-2 sm:gap-6" 
                                            action="{{ route('anggota.store') }}" 
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin meminjam {{ $buku->judul_buku }} ini?')"
                                        >
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $buku->id }}">

                                            <div class="sm:col-span-2">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Member Name
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="name" 
                                                    id="name" 
                                                    value="{{ auth()->user()->name }}" 
                                                    readonly 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                />
                                            </div>

                                            <div class="sm:col-span-2">
                                                <label for="judul_buku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Book Title
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="judul_buku" 
                                                    id="judul_buku" 
                                                    value="{{ $buku->judul_buku }}" 
                                                    readonly 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                />
                                            </div>

                                            <div>
                                                <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Author
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="penulis" 
                                                    id="penulis" 
                                                    value="{{ $buku->penulis }}" 
                                                    readonly 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                />
                                            </div>

                                            <div>
                                                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Category
                                                </label>
                                                <select 
                                                    id="kategori" 
                                                    name="kategori" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                >
                                                    <option selected disabled>{{ $buku->kategori }}</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="tanggal_pinjam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Borrow Date
                                                </label>
                                                <input 
                                                    type="date" 
                                                    name="tanggal_pinjam" 
                                                    id="tanggal_pinjam" 
                                                    required 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                />
                                            </div>

                                            <div>
                                                <label for="tanggal_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Return Date
                                                </label>
                                                <input 
                                                    type="date" 
                                                    name="tanggal_kembali" 
                                                    id="tanggal_kembali" 
                                                    required 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                />
                                            </div>

                                            <button 
                                                type="submit" 
                                                class="sm:col-span-2 w-full text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            >
                                                Borrow Book
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-app-layout>