<x-app-layout>
    <link rel="stylesheet" href="{{asset('css/mesndfs.css')}}">
    <x-slot name="header">
        <h1 class="font-bold text-base py-5" style="border-bottom: 4px solid black">Vos notes de frais : </h1>
    </x-slot>
<style>
    td{
        font-size:0.75rem;
    }
    th{
        font-size:.75rem;
    }
    @media screen and (max-width:860px){
        td{
            font-size: 0.5rem;


        }
        th{
            font-size: 0.5rem;
        }
        .bye860{
            display:none;
        }
    }
</style>
    <table class=" w-full text-left text-gray-500 dark:text-gray-400">
        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="TH-mesndfs  text-center">Date de la note de frais</th>
                <th scope="col" class="bye860 TH-mesndfs   text-center">Nombre d'évènements</th>
                <th scope="col" class="TH-mesndfs  text-center">Chevaux fiscaux</th>
                <th scope="col" class="TH-mesndfs  text-center">Votre taux/km</th>
                <th scope="col" class="TH-mesndfs  text-center"></th>
                @if(Auth::user()->superadmin == 1)
                        <th scope="col" class="px-6 py-3 text-center">
                            Suppression
                        </th>
                    @endif
            </tr>
        </thead>
        <tbody>

            @for ($i = 0 ; $i < count($authInfosndfs) ; $i++)
            @if ($authInfosndfs[$i]->Valide == 1)

                <tr
                    class="overflow-visible border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->MoisEnCours }}
                    </td>
                    <td class="bye860 px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->NombreEvenement }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->ChevauxFiscaux }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->tauxKM }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        <form method="POST" action="{{ route('PDFgeneratorPerMonth') }}" target="_blank">
                            @csrf
                            <input type="hidden" name="selectedMonth" value="{{$authInfosndfs[$i]->MoisEnCours}}">
                            <input type="hidden" name="idUser" value="{{$idUser}}">
                            <button
                                class="mr-2 inline-flex items-center px-3.5 py-2.5 whitespace-nowrap bg-gray-800 border border-transparent rounded-md font-medium text-sm text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                type="submit">
                                Note de frais
                            </button>
                        </form>
                    </td>
                    @if(Auth::user()->superadmin == 1)
                        <td class="px-6 py-4 text-center" style="background:white; color:black;">
                            <form method="POST" action="{{ route('supprimerNDF') }}">
                                @csrf
                                <input type="hidden" name="username"
                                            value="{{$authInfosndfs[$i]->Utilisateur }}">
                                        <input type="hidden" name="moisndf"
                                            value="{{$authInfosndfs[$i]->MoisEnCours}}">
                                        <button type="submit" class="text-red-600 text-bold border-4 border-red-600  py-1 px-1">Supprimer</button>
                            </form>
                        </td>
                    @endif
                </tr>
                @else
                <tr
                    class="overflow-visible border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->MoisEnCours }}
                    </td>
                    <td class="bye860 px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->NombreEvenement }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->ChevauxFiscaux }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                        {{ $authInfosndfs[$i]->tauxKM }}
                    </td>
                    <td class="px-6 py-4 text-center" style="background:white; color:black;">
                       En cours de validation...
                    </td>
                </tr>
                @endif
            @endfor

        </tbody>

    </table>

</x-app-layout>
