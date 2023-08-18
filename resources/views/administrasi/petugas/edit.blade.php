<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                <form method="post" action="{{ route('petugas.member.store') }}" class="space-y-6">
                    @csrf
                    @method('post')
                    <div class="grid grid-cols-2 gap-5">
                        <div class="cols-span-1">
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input id="nama" :value="old('nama', $member->nama)" name="nama" type="text" class="mt-1 block w-full" autocomplete="nama" />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="no_ktp" :value="__('Nomor KTP')" />
                            <x-text-input id="no_ktp" :value="old('no_ktp', $member->no_ktp)" name="no_ktp" type="text" class="mt-1 block w-full" autocomplete="no_ktp" />
                            <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="no_sim" :value="__('Nomor SIM')" />
                            <x-text-input id="no_sim" :value="old('no_sim', $member->no_sim)" name="no_sim" type="text" class="mt-1 block w-full" autocomplete="no_sim" />
                            <x-input-error :messages="$errors->get('no_sim')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="ttl" :value="__('Tanggal Lahir')" />
                            <x-text-input id="ttl" :value="old('ttl', $member->ttl)" name="ttl" type="date" class="mt-1 block w-full" autocomplete="ttl" />
                            <x-input-error :messages="$errors->get('ttl')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
                            <x-text-input id="no_telp" :value="old('no_telp', $member->no_telp)" name="no_telp" type="text" class="mt-1 block w-full" autocomplete="no_telp" />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>
                        <div class="cols-span-1">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" :value="old('email', $member->user->email)" name="email" type="text" class="mt-1 block w-full" autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <div class="cols-span-1">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" :value="old('alamat', $member->alamat)" name="alamat" type="text" class="mt-1 block w-full" autocomplete="alamat" />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>
                        <div></div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('petugas.member.index') }}">
                                <x-secondary-button type="button">{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>