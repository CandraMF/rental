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
        tahun: 'all',
        bulan: 'all', 

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
                    <div class="flex gap-2">


                       

                        @php
                            $tahun = \Carbon\Carbon::now()->format('Y');
                            $bulan = \Carbon\Carbon::now()->format('m');
                        @endphp

                        <a href="{{ route('admin.penyewaan.cetak-laporan', [$bulan, $tahun]) }}" target="_blank">
                            <x-warning-button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
                                    <path fill-rule="evenodd" d="M5 2.75C5 1.784 5.784 1 6.75 1h6.5c.966 0 1.75.784 1.75 1.75v3.552c.377.046.752.097 1.126.153A2.212 2.212 0 0118 8.653v4.097A2.25 2.25 0 0115.75 15h-.241l.305 1.984A1.75 1.75 0 0114.084 19H5.915a1.75 1.75 0 01-1.73-2.016L4.492 15H4.25A2.25 2.25 0 012 12.75V8.653c0-1.082.775-2.034 1.874-2.198.374-.056.75-.107 1.127-.153L5 6.25v-3.5zm8.5 3.397a41.533 41.533 0 00-7 0V2.75a.25.25 0 01.25-.25h6.5a.25.25 0 01.25.25v3.397zM6.608 12.5a.25.25 0 00-.247.212l-.693 4.5a.25.25 0 00.247.288h8.17a.25.25 0 00.246-.288l-.692-4.5a.25.25 0 00-.247-.212H6.608z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Cetak Laporan Bulan Ini') }}
                            </x-warning-button>
                        </a>

                        <a href="{{ route('admin.penyewaan.cetak-laporan', ['all', $tahun]) }}" target="_blank">
                            <x-warning-button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
                                    <path fill-rule="evenodd" d="M5 2.75C5 1.784 5.784 1 6.75 1h6.5c.966 0 1.75.784 1.75 1.75v3.552c.377.046.752.097 1.126.153A2.212 2.212 0 0118 8.653v4.097A2.25 2.25 0 0115.75 15h-.241l.305 1.984A1.75 1.75 0 0114.084 19H5.915a1.75 1.75 0 01-1.73-2.016L4.492 15H4.25A2.25 2.25 0 012 12.75V8.653c0-1.082.775-2.034 1.874-2.198.374-.056.75-.107 1.127-.153L5 6.25v-3.5zm8.5 3.397a41.533 41.533 0 00-7 0V2.75a.25.25 0 01.25-.25h6.5a.25.25 0 01.25.25v3.397zM6.608 12.5a.25.25 0 00-.247.212l-.693 4.5a.25.25 0 00.247.288h8.17a.25.25 0 00.246-.288l-.692-4.5a.25.25 0 00-.247-.212H6.608z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Cetak Laporan Tahun Ini') }}
                            </x-warning-button>
                        </a>

                        <a href="{{ route('admin.penyewaan.create') }}">
                            <x-primary-button>{{ __('Tambah Penyewaan') }}</x-primary-button>
                        </a>
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
                                    Uang Muka
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sisa Bayar + Denda
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="flex gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M5 2.75C5 1.784 5.784 1 6.75 1h6.5c.966 0 1.75.784 1.75 1.75v3.552c.377.046.752.097 1.126.153A2.212 2.212 0 0118 8.653v4.097A2.25 2.25 0 0115.75 15h-.241l.305 1.984A1.75 1.75 0 0114.084 19H5.915a1.75 1.75 0 01-1.73-2.016L4.492 15H4.25A2.25 2.25 0 012 12.75V8.653c0-1.082.775-2.034 1.874-2.198.374-.056.75-.107 1.127-.153L5 6.25v-3.5zm8.5 3.397a41.533 41.533 0 00-7 0V2.75a.25.25 0 01.25-.25h6.5a.25.25 0 01.25.25v3.397zM6.608 12.5a.25.25 0 00-.247.212l-.693 4.5a.25.25 0 00.247.288h8.17a.25.25 0 00.246-.288l-.692-4.5a.25.25 0 00-.247-.212H6.608z" clip-rule="evenodd" />
                                        </svg>

                                        Cetak
                                    </span>
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
                                <td class="px-6 py-4 w-44">
                                    Rp. {{ number_format($penyewaan->uang_muka) }} / <br> Rp. {{ number_format($penyewaan->total_bayar) }}
                                </td>
                                <td class="px-6 py-4 w-44">
                                    <span class="text-black">Rp. {{ number_format($penyewaan->pengembalian->sisa_bayar) }} <br></span>
                                    <span class="text-red-600">+ (Rp. {{ number_format($penyewaan->pengembalian->denda) }})</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                    $is_telat = \Carbon\Carbon::now()->gt($tenggat);
                                    $telat = \Carbon\Carbon::now()->diffInDays($tenggat);
                                    @endphp


                                    @if ($is_telat && $penyewaan->status != 2)
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Terlambat</span>
                                    <br>({{ $telat }} Hari)
                                    @elseif ($penyewaan->status == 0)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Menunggu</span>
                                    @elseif ($penyewaan->status == 1)
                                    @if($penyewaan->kendaraan->status == 0 || $penyewaan->kendaraan->status == 2)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Berlangsung</span>
                                    @else
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Kendaraan Dikembalikan</span>
                                    @endif
                                    @elseif($penyewaan->status == 2)
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="flex flex-col justify-center items-center gap-2 py-2">
                                        <a href="{{ route('admin.penyewaan.cetak-kwitansi', $penyewaan->id) }}" target="_blank">
                                            <x-secondary-button class="h-fit w-fit" type="button">
                                                Kwitansi Uang Muka
                                            </x-secondary-button>
                                        </a>
                                        @if(($penyewaan->status == 1 || $penyewaan->status) == 2 && $penyewaan->pengembalian->petugas)
                                        <a href="{{ route('admin.penyewaan.cetak-kwitansi-denda', $penyewaan->id) }}" target="_blank">
                                            <x-secondary-button class="h-fit w-fit" type="button">
                                                Kwitansi Pelunasan
                                            </x-secondary-button>
                                        </a>
                                        @endif
                                        @if($penyewaan->status == 1 && $penyewaan->kendaraan->status == 1)
                                        <a href="{{ route('admin.penyewaan.selesaikan', $penyewaan->id) }}">
                                            <x-warning-button class="h-fit w-fit" type="button">
                                                Selesaikan
                                            </x-warning-button>
                                        </a>
                                        @endif

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

    </div>
</x-app-layout>