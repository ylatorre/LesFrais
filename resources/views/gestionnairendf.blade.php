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
                    <th scope="col" class="px-6 py-3 text-center"></th>
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
                            @if ($ndfsemploye[$i]->Validation == 0)
                                <td scope="col"
                                    class="px-6 py-3 text-center flex flex-row justify-around items-center">
                                    <img src="./images/icon-annuler.png" alt="pasencorevalidé" width="30px"
                                        height="30px">
                                </td>
                            @else
                                <td scope="col"
                                    class="px-6 py-3 text-center flex flex-row justify-around items-center">
                                    <img src="./images/icon-checkmark.png" alt="validé" width="30px" height="30px">
                                </td>
                            @endif
                            @if ($ndfsemploye[$i]->Validation == 0)
                                <td class="td-validation px-6 py-3 text-center font-bold">
                                    <button type="submit">Validation</button>
                                </td>
                            @else
                                <td scope="col" class="px-6 py-3 text-center font-bold"
                                    style="color:rgb(19, 151, 19);">
                                    Validé
                                </td>
                            @endif
                    @endfor
                @endif
            </tbody>

        </table>
    </div>





</x-app-layout>
