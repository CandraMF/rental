<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                <form method="post" action="{{ route('petugas.kendaraan.store') }}" class="space-y-6">
                    @csrf
                    @method('post')
                    <div class="grid grid-cols-2 gap-5">
                        <div class="cols-span-1">
                            <x-input-label for="plat_nomor" :value="__('Plat Nomor')" />
                            <x-text-input id="plat_nomor" name="plat_nomor" type="text" class="mt-1 block w-full" autocomplete="plat_nomor" />
                            <x-input-error :messages="$errors->get('plat_nomor')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="no_stnk" :value="__('Nomor STNK')" />
                            <x-text-input id="no_stnk" name="no_stnk" type="text" class="mt-1 block w-full" autocomplete="no_stnk" />
                            <x-input-error :messages="$errors->get('no_stnk')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="nama_kendaraan" :value="__('Nama Kendaraan')" />
                            <x-text-input id="nama_kendaraan" name="nama_kendaraan" type="text" class="mt-1 block w-full" autocomplete="nama_kendaraan" />
                            <x-input-error :messages="$errors->get('nama_kendaraan')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="harga_sewa" :value="__('Harga Sewa')" />
                            <x-text-input id="harga_sewa" name="harga_sewa" type="number" class="mt-1 block w-full" autocomplete="harga_sewa" />
                            <x-input-error :messages="$errors->get('harga_sewa')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('petugas.kendaraan.index') }}">
                                <x-secondary-button type="button">{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>