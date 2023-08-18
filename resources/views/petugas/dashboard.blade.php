<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col md:grid grid-cols-4 gap-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-start">
                            <div class="text-gray-900 font-bold">Total Petugas</div>
                            <div class="text-blue-800 font-bold text-3xl mt-2">
                                {{ $total_petugas }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-start">
                            <div class="text-gray-900 font-bold">Total Member</div>
                            <div class="text-blue-800 font-bold text-3xl mt-2">
                                {{ $total_member }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-start">
                            <div class="text-gray-900 font-bold">Total Kendaraan</div>
                            <div class="text-blue-800 font-bold text-3xl mt-2">
                                {{ $total_kendaraan }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-start">
                            <div class="text-gray-900 font-bold">Total Penyewaan</div>
                            <div class="text-blue-800 font-bold text-3xl mt-2">
                                {{ $total_penyewaan }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:grid grid-cols-3 gap-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {!! $penyewaanCart->container() !!}
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {!! $pieChart->container() !!}
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {!! $topMembers->container() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ $pieChart->cdn() }}"></script>
    <script src="{{ $topMembers->cdn() }}"></script>
    <script src="{{ $penyewaanCart->cdn() }}"></script>

    {{ $pieChart->script() }}
    {{ $topMembers->script() }}
    {{ $penyewaanCart->script() }}
</x-app-layout>