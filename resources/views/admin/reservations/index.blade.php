<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center m-2 p-2">
                <a class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 rounded-lg text-white"
                    href="{{ route('admin.reservations.create') }}">Yeni Rezervasyon</a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Ad Soyad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                E-Posta
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Telefon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rezervasyon Tarihi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Misafir Sayısı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Masa Numarası
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $reservation->firstName . ' ' . $reservation->lastName }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $reservation->email }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $reservation->phone }}
                                </th>


                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $reservation->getresTime() }}

                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $reservation->guestNumber }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $reservation->table->name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                            class="px-4 py-2 bg-indigo-700 hover:bg-indigo-800 text-white rounded-2xl">Düzenle</a>
                                            <form class="px-4 py-2 bg-red-700 hover:bg-red-800 text-white rounded-2xl"
                                            method="POST" action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                            onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Sil</button>
                                        </form>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
