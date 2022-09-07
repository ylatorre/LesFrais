<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-xl py-5" style="border-bottom: 4px solid black">Vos notes de frais validées : </h1>
    </x-slot>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">Date de la note de frais</th>
                <th scope="col" class="px-6 py-3 text-center">Nombre d'évènements</th>
                <th scope="col" class="px-6 py-3 text-center">Chevaux fiscaux</th>
                <th scope="col" class="px-6 py-3 text-center">Votre taux/km</th>
                <th scope="col" class="px-6 py-3 text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authInfosndfs as $authInfosndf)
                <tr
                    class="overflow-visible border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndf->MoisEnCours }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndf->NombreEvenement }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndf->ChevauxFiscaux }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndf->tauxKM }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        <form method="POST" action="{{ route('PDFgeneratorPerMonth') }}" target="_blank">
                            @csrf
                            <input type="hidden" name="selectedMonth" value="{{$authInfosndf->MoisEnCours}}">
                            <button
                                class="mr-2 inline-flex items-center px-3.5 py-2.5 whitespace-nowrap bg-gray-800 border border-transparent rounded-md font-medium text-sm text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                type="submit">
                                Note de frais
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

</x-app-layout>
