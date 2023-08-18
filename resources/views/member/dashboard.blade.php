<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{id: null, url: '{{route('member.penyewaan.store', '')}}', store_url : null, changeId(payload) { this.id = payload; this.store_url = this.url + '/' + payload } }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'saved')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Berhasil</span> Mengajukan Penyewaan
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
                    Data <span class="font-medium">Berhasil</span> Dihapus
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
                    Data <span class="font-medium">Berhasil</span> Diubah
                </div>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                
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
                                Harga Sewa
                            </th>
                            <th scope="col" class="px-6 py-3">

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
                            <td class="px-6 py-4">
                                Rp. {{ number_format($kendaraan->harga_sewa) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-primary-button x-on:click.prevent="changeId({{$kendaraan->id}}); $dispatch('open-modal', 'confirm-sewa')">
                                        Sewa Kendaraan
                                    </x-primary-button>
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
                        {{ $kendaraans->links() }}
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="confirm-sewa" focusable :show="$errors->get('tanggal_sewa') || $errors->get('lama_sewa')">
            <form method="post" action="{{ route('member.penyewaan.store') }}" class="p-6">

                @csrf
                @method('post')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Anda Akan Menyewa Kendaraan Ini') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Isi Data Penyewaan, Data Akan Dikirim dan Diberikan Persetujuan Oleh Petugas') }}
                </p>

                <div class="grid grid-cols-2 gap-5">
  
                    <input :value="id" id="kendaraan_id" name="kendaraan_id" type="hidden" class="mt-1 block w-full" />

                    <div class="mt-6 col-span-1 gap-2">
                        <x-input-label for="tanggal_sewa" value="{{ __('Tanggal Sewa') }}" class="sr-only" />
                        <x-text-input id="tanggal_sewa" name="tanggal_sewa" type="date" class="mt-1 block w-full" placeholder="{{ __('Tanggal Sewa') }}" />
                        <x-input-error :messages="$errors->get('tanggal_sewa')" class="mt-2" />
                    </div>

                    <div class="mt-6 col-span-1">
                        <x-input-label for="lama_sewa" value="{{ __('Lama Sewa') }}" class="sr-only" />
                        <x-text-input id="lama_sewa" name="lama_sewa" type="number" class="mt-1 block w-full" placeholder="{{ __('Lama Sewa') }}" />
                        <x-input-error :messages="$errors->get('lama_sewa')" class="mt-2" />
                    </div>

                    <!-- <div class="mt-6 col-span-1">
                        <x-input-label for="estimasi" value="{{ __('Estimasi') }}" class="sr-only" />
                        <x-text-input id="estimasi" name="estimasi" type="number" class="mt-1 block w-full" placeholder="{{ __('estimasi') }}" />
                        <x-input-error :messages="$errors->get('estimasi')" class="mt-2" />
                    </div> -->
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        {{ __('Ajukan Penyewaan') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>



</x-app-layout>