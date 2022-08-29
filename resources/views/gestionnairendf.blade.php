<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <!--   Cette vue est celle ou l'administrateur peut voir les différentes note de frais de ses employés et les valider   -->

    <h2 class="h2-top-page">Notes de frais de l'utilisateur <span>{{ $utilisateurSelectionne }}</span></h2>
    <div class="w-full flex flex-row justify-around">
        <table class="table-ndf text-sm text-left text-gray-700 dark:text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Mois
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Missions
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Validation
                    </th>

                </tr>
            </thead>
            <tbody>
                @if (count($ndfsemploye) == 0)
                <td></td>
                    <td class="w-full px-6 py-3 text-center font-bold">Désolé, cet utilisateur n'a aucune note de frais...</td>
<td></td>
                @else
                    @for ($i = 0; $i < count($ndfsemploye); $i++)
                        <tr>
                            <td scope="col" class="px-6 py-3 text-center">
                                {{ $ndfsemploye[$i]->MoisEnCours }}
                            </td>
                            <td scope="col" class="px-6 py-3 text-center">
                                {{ $ndfsemploye[$i]->NombreEvenement }}
                            </td>
                            @if ($ndfsemploye[$i]->Valide == 0)
                                <td scope="col"
                                    class="px-6 py-3 text-center flex flex-row justify-around items-center">
                                    <form method="POST" action="{{route("validationNDF")}}">
                                        @csrf
                                        <input type="hidden" name="moisNDF" value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                        <input type="hidden" name="employe" value="{{ $ndfsemploye[$i]->Utilisateur }}">

                                    <x-button type="submit">Valider la note de frais</x-button>
                                </form>
                                </td>
                            @elseif($ndfsemploye[$i]->Valide == 1)
                                <td scope="col"
                                    class="px-6 py-3 text-center flex flex-row justify-around items-center">
                                    <img src="./images/icon-checkmark.png" alt="validé" width="30px" height="30px">
                                </td>
                            @endif

                    @endfor
                @endif
            </tbody>

        </table>
    </div>





</x-app-layout>
