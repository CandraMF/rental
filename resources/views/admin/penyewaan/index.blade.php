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

            <x-input-error class="mt-2" :messages="$errors->get('penyewaan_id')" />
            <x-input-error class="mt-2" :messages="$errors->get('kendaraan_id')" />

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                <div class="flex justify-between">
                    <div>
                        <x-text-input id="email" name="email" type="email" class="block w-full" required autocomplete="search" placeholder="search" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <a href="{{ route('admin.penyewaan.create') }}">
                        <x-primary-button>{{ __('Tambah Penyewaan') }}</x-primary-button>
                    </a>
                </div>
                <div class="mt-5 relative overflow-x-auto"">
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
                                Total Bayar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
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
                                        {{ $penyewaan->member->member->nama }}
                                    </span>
                                    <span>
                                        {{ $penyewaan->member->member->no_telp }}
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

                                    @if ($penyewaan->kendaraan->status == 1)
                                    <span class="w-fit bg-green-300 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Tersedia</span>
                                    @else
                                    <span class="w-fit bg-red-300 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Sedang Disewa</span>
                                    @endif

                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $penyewaan->tanggal_sewa }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($penyewaan->total_bayar) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-warning-button x-on:click.prevent="changeId({{$penyewaan->id}}); changeKendaraan({{$penyewaan->kendaraan}}); $dispatch('open-modal', 'confirm-terima')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 mr-2">
                                            <path fill-rule="evenodd" d="M3 3.5A1.5 1.5 0 014.5 2h6.879a1.5 1.5 0 011.06.44l4.122 4.12A1.5 1.5 0 0117 7.622V16.5a1.5 1.5 0 01-1.5 1.5h-11A1.5 1.5 0 013 16.5v-13zm10.857 5.691a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 00-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                        </svg>

                                        Terima
                                    </x-warning-button>
                                    <x-danger-button x-on:click.prevent="changeId({{$penyewaan->id}}); $dispatch('open-modal', 'confirm-tolak')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 mr-2">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                        </svg>

                                        Tolak
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
                        {{ $penyewaans->links() }}
                    </div>
                </div>
            </div>
        </div>
        <x-modal name="confirm-terima" focusable :show="$errors->get('lama_sewa') || $errors->get('uang_muka')">
            <form method="post" action="{{ route('admin.penyewaan.terima') }}" class="p-6">

                @csrf
                @method('post')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Terima Ajuan Penyewaan') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Masukan Lama Penyewaan Dan Uang Muka') }}
                </p>

                <div class="bg-gray-200 mt-4 rounded-xl p-5 flex-col gap-4">
                    <span>Detail Kendaraan</span>
                    <span></span>
                    <div class="grid grid-cols-2">
                        <span class="col-span-1">Nama Kendaraan</span>
                        <span class="col-span-1" x-text="': ' + kendaraan.nama_kendaraan"></span>
                        <span class="col-span-1">Plat Nomor</span>
                        <span class="col-span-1" x-text="': ' + kendaraan.plat_nomor"></span>
                        <span class="col-span-1">Status</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-5">

                    <input :value="penyewaan_id" id="penyewaan_id" name="penyewaan_id" type="hidden" class="mt-1 block w-full" />
                    <input :value="kendaraan.id" id="kendaraan_id" name="kendaraan_id" type="hidden" class="mt-1 block w-full" />

                    <div class="mt-6 col-span-1">
                        <x-input-label for="lama_sewa" value="{{ __('Lama Sewa') }}" class="sr-only" />
                        <x-text-input id="lama_sewa" name="lama_sewa" type="number" class="mt-1 block w-full" placeholder="{{ __('Lama Sewa (Hari)') }}" />
                        <x-input-error :messages="$errors->get('lama_sewa')" class="mt-2" />
                    </div>

                    <div class="mt-6 col-span-1">
                        <x-input-label for="total_bayar" value="{{ __('Total Biaya') }}" class="sr-only" />
                        <x-text-input readonly id="total_bayar" name="total_bayar" type="text" class="mt-1 block w-full" placeholder="{{ __('Total Bayar') }}" />
                        <x-input-error :messages="$errors->get('total_bayar')" class="mt-2" />
                    </div>

                    <div class=" col-span-1">
                        <x-input-label for="uang_muka" value="{{ __('Lama Sewa') }}" class="sr-only" />
                        <x-text-input id="uang_muka" name="uang_muka" type="number" class="mt-1 block w-full" placeholder="{{ __('Uang Muka (Rp)') }}" />
                        <x-input-error :messages="$errors->get('uang_muka')" class="mt-2" />
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

        <x-modal name="confirm-tolak" focusable>
            <form method="post" action="{{ route('member.penyewaan.store') }}" class="p-6">

                @csrf
                @method('post')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Anda Yakin Ingin Menolak Pengajuan Ini?') }}
                </h2>

                <div class="mt-6 flex justify-end">
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('Ya') }}
                        </x-danger-button>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>



</x-app-layout>