<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ 
        id: null,
        telat: 0,
        isTelat: false,
        changeId(payload) { 
            this.id = payload 
        },
        changeTelat(telat, isTelat) { 
            this.telat = telat
            this.isTelat = isTelat
        },
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
                        <x-text-input id="email" name="email" type="email" class="block w-full" required autocomplete="search" placeholder="search" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
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
                                    Status
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
                                    @php
                                    $is_telat = \Carbon\Carbon::now()->gt($tenggat);
                                    $telat = \Carbon\Carbon::now()->diffInDays($tenggat);
                                    @endphp

                                    @if ($is_telat && !($penyewaan->status == 2 || $penyewaan->status == 0 || $penyewaan->kendaraan->status == 1))
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Terlambat</span>
                                    <br>({{ $telat }} Hari)
                                    @elseif ($penyewaan->status == 1 && $penyewaan->kendaraan->status != 1)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Berlangsung</span>
                                    @elseif ($penyewaan->status == 1 && $penyewaan->kendaraan->status == 1)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Kendaraan Dikembalikan</span>
                                    <br>
                                    <span class="text-sm ">Denda : Rp. {{ number_format($penyewaan->pengembalian->denda) ?? '-' }}</span>
                                    <br>
                                    <span class="text-sm">Catatan : {{ $penyewaan->pengembalian->catatan ?? '-' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="space-y-2">
                                        <x-primary-button type="button" x-on:click.prevent="changeId({{$penyewaan->id}}); changeTelat({{ $telat }}, {{ $is_telat }}); $dispatch('open-modal', 'confirm-kembalikan')">
                                            @if ($penyewaan->kendaraan->status == 1)
                                                Ubah Detail
                                            @elseif($penyewaan->kendaraan->status == 0)
                                                Kembalikan Kendaraan
                                            @endif 
                                        </x-primary-button>
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
        <x-modal name="confirm-kembalikan" focusable>
            <form method="post" action="{{ route('petugas.pengembalian.kembalikan') }}" class="p-6">

                @csrf
                @method('post')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pengembalian Kendaraan') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Isi Form Dibawah Ini Untuk Mengembalikan Kendaraan') }}
                </p>

                <input type="hidden" :value="id" name="id">

                <div class="grid grid-cols-2 gap-5 mt-5">

                    <div class="flex">
                        <span x-show="isTelat" class="text-red-500">Terlambat <span x-text="telat"></span> Hari</span>
                        <span x-show="!isTelat" class="text-green-500">Tepat Waktu</span>
                    </div>
                    <div></div>
                    <div class="col-span-1 gap-2">
                        <x-input-label for="lama_sewa" :value="__('Denda (Rp)')" />
                        <x-text-input id="denda" name="denda" type="number" class="mt-1 block w-full" placeholder="{{ __('Masukan Denda') }}" />
                        <x-input-error :messages="$errors->get('denda')" class="mt-2" />
                    </div>

                    <div class="col-span-1">
                        <x-input-label for="catatan" value="{{ __('Catatan (Opsional)') }}" />
                        <x-text-input id="catatan" name="catatan" type="text" class="mt-1 block w-full" placeholder="{{ __('Masukan Catatan') }}" />
                        <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                    </div>

                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        {{ __('Kembalikan Kendaraan') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>