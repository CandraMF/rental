<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ url: '{{route('admin.kendaraan.destroy', '')}}', delete_url : null, changeId(payload) { this.delete_url = this.url + '/' + payload } }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'saved')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Berhasil</span> Data Berhasil Ditambahkan
                </div>
            </div>
            @endif

            @if (session('status') === 'deleted')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Berhasil</span> Data Berhasil Dihapus
                </div>
            </div>
            @endif

            @if (session('status') === 'updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Berhasil</span> Data Berhasil Diubah
                </div>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                <div class="flex justify-between">
                    <div>
                        <x-text-input id="email" name="email" type="email" class="block w-full" required autocomplete="search" placeholder="search" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <a href="{{ route('admin.kendaraan.create') }}">
                        <x-primary-button>{{ __('Tambah Data') }}</x-primary-button>
                    </a>
                </div>
                <div class="mt-5 relative overflow-x-auto">
                    <table class=" w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kendaraan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Plat Nomor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor STNK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga Sewa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = ($kendaraans->currentpage()-1) * $kendaraans->perpage() + 1;
                        @endphp
                        @forelse ($kendaraans as $kendaraan)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">
                                {{ $i++ }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kendaraan->nama_kendaraan }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $kendaraan->plat_nomor }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $kendaraan->no_stnk }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($kendaraan->harga_sewa) }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($kendaraan->status == 1)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Tersedia</span>
                                @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Sedang Disewa</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}">
                                        <x-warning-button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                                <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                            </svg>
                                        </x-warning-button>
                                    </a>
                                    <x-danger-button x-on:click.prevent="changeId({{$kendaraan->id}}); $dispatch('open-modal', 'confirm-deletion')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                        </svg>
                                    </x-danger-button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        Data Kosong
                        @endforelse

                    </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $kendaraans->links() }}
                    </div>
                </div>
            </div>
        </div>
        
        <x-modal name="confirm-deletion" focusable>
            <form method="post" :action="delete_url" class="p-6">

                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Yakin Ingin Menghapus Data?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Data yang Dihapus Akan Hilang Secara Permanen') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Ya') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>



</x-app-layout>