<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a class="px-4 py-2 bg-red-700 hover:bg-red-800rounded-lg text-white"
                    href="{{ route('admin.reservations.index') }}">Geri Dön</a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="sm:col-span-6">
                            <label for="firstName" class="block text-sm font-medium text-gray-700"> Ad Soyad </label>
                            <div class="mt-1">
                                <input type="text" id="firstName" name="firstName" value="{{ $reservation->firstName }}"
                                    class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="lastName" class="block text-sm font-medium text-gray-700"> Ad Soyad </label>
                            <div class="mt-1">
                                <input type="text" id="lastName" name="lastName" value="{{ $reservation->lastName }}"
                                    class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="email" class="block text-sm font-medium text-gray-700"> E-Posta </label>
                            <div class="mt-1">
                                <input type="text" id="email" name="email" value="{{ $reservation->email }}"
                                    class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="phone" class="block text-sm font-medium text-gray-700"> Telefon </label>
                            <div class="mt-1">
                                <input type="text" id="phone" name="phone" value="{{ $reservation->phone }}"
                                    class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="resTime" class="block text-sm font-medium text-gray-700"> Rezervasyon Tarihi
                            </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="resTime" name="resTime" value="{{ $reservation->resTime->format('Y-m-d\TH:i:s') }}"
                                    class="block w-full appearance-none bg-white border  rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('resTime') border-red-500 @enderror " />
                            </div>
                            <div class="text-sm text-center text-blue-400">
                                <small>Rezervasyon tarihi en geç 1 hafta sonrasına
                                    alınabilir. Saat Aralığı: 10:00 - 23:00</small>
                            </div>
                            @error('resTime')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="guestNumber" class="block text-sm font-medium text-gray-700"> Misafir Sayısı </label>
                            <div class="mt-1">
                                <input type="number" id="guestNumber" name="guestNumber" value="{{ $reservation->guestNumber }}"
                                    class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="table_id" class="block text-sm font-medium text-gray-700">Masa</label>
                            <div class="mt-1">
                                <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>{{ $table->name }} ( {{ $table->guestNumber. ' '.' kişilik' }} )</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>






                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 p-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Değişiklikleri
                                kaydet</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>
