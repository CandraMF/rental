<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penyewaan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{
        kendaraan: null,
        member: null,
        setKendaraan(kendaraan) {
            this.kendaraan = kendaraan
        },
        setMember(member) {
            this.member = member
        },
        lama_sewa: 0,
        uang_muka: 0,
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col">
                <form method="post" action="{{ route('admin.penyewaan.store') }}" class="space-y-6">
                    @csrf
                    @method('post')
                    <div class="grid grid-cols-2 gap-5">
                        <div class="col-span-1">
                            <x-input-label for="kendaraan_id" :value="__('Kendaraan')" />
                            <div x-show="kendaraan == null" class="border bg-gray-100 p-10 rounded-xl mt-1 text-center cursor-pointer hover:bg-gray-200" x-on:click.prevent="$dispatch('open-modal', 'modal-kendaraan')">
                                <span class="font-medium text-gray-600">Pilih Kendaraan</span>
                            </div>
                            <div x-if="kendaraan" x-show="kendaraan" class="border text-blue-800 group bg-gray-100 p-10 rounded-xl mt-1 text-center cursor-pointer hover:bg-gray-200" x-on:click.prevent="$dispatch('open-modal', 'modal-kendaraan')">
                                <span x-text="kendaraan.nama_kendaraan"></span>
                                <span class="font-bold " x-text="'(' + kendaraan.plat_nomor +')'"></span>
                            </div>
                            <input type="hidden" :value='kendaraan.id' name="kendaraan_id">
                            <x-input-error :messages="$errors->get('kendaraan_id')" class="mt-2" />

                        </div>
                        <div class="col-span-1">
                            <x-input-label for="member_id" :value="__('Member')" />
                            <div x-show="member == null" class="border bg-gray-100 p-10 rounded-xl mt-1 text-center cursor-pointer hover:bg-gray-200" x-on:click.prevent="$dispatch('open-modal', 'modal-member')">
                                <span class="font-medium text-gray-600">Pilih Member</span>
                            </div>
                            <div x-if="member" x-show="member" class="border text-blue-800 group bg-gray-100 p-10 rounded-xl mt-1 text-center cursor-pointer hover:bg-gray-200" x-on:click.prevent="$dispatch('open-modal', 'modal-member')">
                                <span x-text="member.nama"></span>
                            </div>
                            <input type="hidden" :value='member.id' name="member_id">
                            <x-input-error :messages="$errors->get('member_id')" class="mt-2" />
                        </div>
                        <div class="col-span-1 flex justify-center text-center">
                            <div class="w-fit">
                                <x-input-label for="lama_sewa" :value="__('Lama Sewa (Hari)')" />
                                <x-text-input x-model="lama_sewa" id="lama_sewa" name="lama_sewa" type="number" class="text-center mt-1 block w-full" autocomplete="lama_sewa" />
                                <x-input-error :messages="$errors->get('lama_sewa')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-span-1 flex justify-center text-center">
                            <div class="w-fit">
                                <x-input-label for="uang_muka" :value="__('Uang Muka (Rp)')" />
                                <x-text-input x-model="uang_muka" id="uang_muka" name="uang_muka" type="number" class="text-center mt-1 block w-full" autocomplete="uang_muka" />
                                <x-input-error :messages="$errors->get('uang_muka')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-span-1 flex justify-center text-center" x-show='lama_sewa'>
                            <div>
                                <x-input-label for="total_bayar" :value="__('Total Bayar')" />
                                <input :value="lama_sewa * kendaraan.harga_sewa" readonly id="total_bayar" name="total_bayar" type="hidden" class="text-center mt-1 block w-full font-bold text-xl border-none focus:border-none focus:outline-none" autocomplete="total_bayar" />
                                <input :value="'Rp. ' + (lama_sewa * kendaraan.harga_sewa).toLocaleString()" readonly id="total_bayar_preview" name="total_bayar_preview" type="text" class="text-center mt-1 block w-full font-bold text-xl border-none focus:border-none focus:outline-none" autocomplete="total_bayar_preview" />
                                <x-input-error :messages="$errors->get('total_bayar')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-span-1 flex justify-center text-center" x-show='uang_muka'>
                            <div>
                                <x-input-label for="sisa_bayar" :value="__('Sisa')" />
                                <input :value="(lama_sewa * kendaraan.harga_sewa - uang_muka)" readonly id="sisa_bayar" name="sisa_bayar" type="hidden" class="text-center mt-1 block w-full font-bold border-none focus:border-none focus:outline-none" autocomplete="sisa_bayar" />
                                <input :value="'Rp. ' + ((lama_sewa * kendaraan.harga_sewa) - uang_muka).toLocaleString()" readonly id="sisa_bayar_preview" name="sisa_bayar_preview" type="text" class="text-center mt-1 block w-full font-bold border-none focus:border-none focus:outline-none" autocomplete="sisa_bayar_preview" />
                                <x-input-error :messages="$errors->get('sisa_bayar')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-4">
                        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        <a href="{{ route('admin.kendaraan.index') }}">
                            <x-secondary-button type="button">{{ __('Cancel') }}</x-secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <x-modal name="modal-kendaraan" focusable>
            <div class="p-6">

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pilih Kendaraan') }}
                </h2>

                <div class=""></div>

                <div class="flex flex-col gap-2 mt-3">
                    @foreach ($kendaraans as $kendaraan)
                    @if($kendaraan->status == 1)
                    <div x-on:click.prevent="setKendaraan({{ $kendaraan }}); $dispatch('close')" class="p-5 border rounded-lg flex justify-between items-center bg-white hover:bg-gray-100 cursor-pointer">
                        <div>
                            <div class="text-gray-700">{{ $kendaraan->nama_kendaraan }}</div>
                            <div class="text-gray-700 font-semibold">{{ $kendaraan->plat_nomor }}</div>
                        </div>
                        <div class="flex justify-end flex-col items-end">
                            <div class="w-fit bg-blue-100 text-blue-800 text-xs font-medium mb-3 px-2.5 py-0.5 rounded">Tersedia</div>
                        </div>
                    </div>
                    @else
                    <div class="relative overflow-hidden p-5 border rounded-lg flex justify-between items-center bg-white cursor-not-allowed">
                        <div>
                            <div class="text-gray-700">{{ $kendaraan->nama_kendaraan }}</div>
                            <div class="text-gray-700 font-semibold">{{ $kendaraan->plat_nomor }}</div>
                        </div>
                        <div class="flex justify-end flex-col items-end">

                            <div class="w-fit bg-gray-100 text-gray-800 text-xs font-medium mb-3 px-2.5 py-0.5 rounded">Sedang Disewa</div>
                            <span class="text-blue-800 font-bold">Rp. {{ number_format($kendaraan->harga_sewa) }}</span>
                        </div>

                        <div class="absolute bg-black/50 h-full w-full top-0 right-0 flex justify-center items-center text-center">
                            <span class="text-white">Tidak Tersedia</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="mt-6 flex justify-end">
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </x-modal>
        <x-modal name="modal-member" focusable>
            <div class="p-6">

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pilih Member') }}
                </h2>

                <div class=""></div>

                <div class="flex flex-col gap-2 mt-3">
                    @foreach ($members as $member)
                    <div x-on:click.prevent="setMember({{ $member }}); $dispatch('close')" class="p-5 border rounded-lg flex justify-between items-center bg-white hover:bg-gray-100 cursor-pointer">
                        <div>
                            <div class="text-gray-700">{{ $member->nama }}</div>
                            <div class="text-gray-700 font-semibold">{{ $member->no_ktp }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 flex justify-end">
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
</x-app-layout>