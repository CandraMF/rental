<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penyewaan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ 
        penyewaan_id: null, 
        delete_url : null, 
        kendaraan : null, 

        changeId(payload) { 
            this.penyewaan_id = payload 
        },

        changeKendaraan(payload) {
            this.kendaraan = payload
        }
    }">
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

            @if (session('status') === 'status-changed')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Kendaraan Berhasil Diserahkan</span> 
                </div>
            </div>
            @endif

            <x-input-error class="mt-2" :messages="$errors->get('penyewaan_id')" />
            <x-input-error class="mt-2" :messages="$errors->get('kendaraan_id')" />

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                <div class="flex justify-between">
                    <div>
                        
                    </div>
                </div>
                <div class="mt-5 relative overflow-x-auto">
                    <table class=" w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Member
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kendaraan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Sewa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = ($penyewaans->currentpage()-1) * $penyewaans->perpage() + 1;
                            @endphp
                            @forelse ($penyewaans as $penyewaan)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    {{ $i++ }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900">
                                            {{ $penyewaan->member->nama }}
                                        </span>
                                        <span>
                                            {{ $penyewaan->member->no_telp }}
                                        </span>
                                    </div>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900">
                                            {{ $penyewaan->kendaraan->nama_kendaraan }}
                                        </span>
                                        <span class="text-sm text-left text-gray-500">
                                            {{ $penyewaan->kendaraan->plat_nomor }}
                                        </span>
                                    </div>
                                </th>
                                <td class="px-6 py-4 ">

                                    @php
                                    $tanggal_sewa = \Carbon\Carbon::parse($penyewaan->tanggal_sewa, 'Asia/Jakarta');
                                    $tenggat = \Carbon\Carbon::parse($penyewaan->tanggal_sewa, 'Asia/Jakarta')->addDays($penyewaan->lama_sewa);
                                    @endphp
                                    {{ $tanggal_sewa->format('d/m/Y') }}
                                    - <br>
                                    {{ $tenggat->format('d/m/Y') }}
                                    <br>
                                    <span class="text-blue-500">({{ $penyewaan->lama_sewa }} Hari)</span>
                                </td>
                                <td>
                                    <div class="space-y-2">
                                        <a href="{{ route('petugas.penyewaan.changeStatus', [$penyewaan->id, 1]) }}">
                                            <x-primary-button class="h-fit w-fit" type="button">
                                                Serahkan Kendaraan
                                            </x-primary-button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="0" class="text-center p-5">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $penyewaans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>