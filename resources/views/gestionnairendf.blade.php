<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <!--   Cette vue est celle ou l'administrateur peut voir les différentes note de frais de ses employés et les valider   -->

    <h2 class="h2-top-page">Notes de frais de l'utilisateur <span>{{ $utilisateurSelectionne }}</span></h2>
    <div class="w-full flex flex-row justify-around">
        <table class="table-ndf text-sm text-left text-gray-700 dark:text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 text-center">
                        Mois
                    </th>
                    <th class="px-6 py-3 text-center">
                        Missions
                    </th>
                    <th class="px-6 py-3 text-center">
                        Validation
                    </th>
                     @if (Auth::user()->superadmin == 1)

                        <th class="px-6 py-3 text-center">Note de frais</th>
                        <th class="px-6 py-3 text-center">Suppression</th>

                        <!-- * permet a l'admin de pouvoir voir les ndfs validé des salariés ainsi que ces propres NDFs mais pas celles du super admin ni celles des autres admins -->

                        @elseif ((Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $isSalarie == 1 && count($ndfsemploye) != 0)||($utilisateurSelectionne == Auth::user()->name && Auth::user()->admin == 1 && Auth::user()->superadmin == 0))

                        <th class="px-6 py-3 text-center">Note de frais</th>
                        <th class="px-6 py-3 text-center">Suppression</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @if (count($ndfsemploye) == 0)
                    <td></td>
                    <td class="w-full px-6 py-3 text-center font-bold">Désolé, cet utilisateur n'a aucune note de
                        frais...</td>
                    <td></td>
                    <td></td>
                @else
                    @for ($i = 0; $i < count($ndfsemploye); $i++)

                            <td class="px-6 py-3 text-center">
                                {{ $ndfsemploye[$i]->MoisEnCours }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $ndfsemploye[$i]->NombreEvenement }}
                            </td>
                            @if($ndfsemploye[$i]->Valide == 0)
                                <td class="px-6 py-3 text-center flex flex-row justify-around items-center">
                                    <form method="POST" action="{{ route('validationNDF') }}">
                                        @csrf
                                        <input type="hidden" name="moisNDF"
                                            value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                        <input type="hidden" name="employe"
                                            value="{{ $ndfsemploye[$i]->Utilisateur }}">

                                        <x-button type="submit">voir la note de frais</x-button>
                                    </form>
                                </td>
                            @elseif($ndfsemploye[$i]->Valide == 1)
                                <td
                                    class="px-6 py-3 text-center flex flex-row justify-around items-center">
                                    <img src="./images/icon-checkmark.png" alt="validé" width="30px" height="30px">
                                </td>

                                @endif
                                @if(Auth::user()->superadmin == 1)
                                    @if($ndfsemploye[$i]->Valide == 1)
                                        <td>
                                            <form method="POST" action="{{route('PDFgeneratorPerMonth')}}" class="flex flex-row items-center justify-around" target="_blank">
                                                @csrf
                                                <input type="hidden" value="{{ $userId }}" name="idUser">
                                                <input type="hidden" value="{{ $ndfsemploye[$i]->MoisEnCours }}" name="selectedMonth">
                                                <button type ="submit" class="text-blue-600 text-bold border-4 border-blue-600  py-1 px-1">Voir la note de frais</button>
                                            </form>
                                        </td>
                                        @else
                                        <td class="text-center">. . .</td>
                                    @endif
                                <td
                                    class="px-6 py-3 text-center">
                                    <form method="POST" action="{{ route('supprimerNDF') }}">
                                        @csrf
                                        <input type="hidden" name="username"
                                            value="{{ $ndfsemploye[$i]->Utilisateur }}">
                                        <input type="hidden" name="moisndf"
                                            value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                        <button type="submit" class="text-red-600 text-bold border-4 border-red-600  py-1 px-1">Supprimer</button>
                                    </form>
                                </td>
                                @endif
                                <!-- * permet a l'admin de pouvoir voir les ndfs validé des salariés ainsi que ces propres NDFs mais pas celles du super admin ni celles des autres admins -->
                                @if((Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $isSalarie == 1)||($utilisateurSelectionne == Auth::user()->name && Auth::user()->admin == 1 && Auth::user()->superadmin == 0))
                                @if($ndfsemploye[$i]->Valide == 1)
                                    <td>
                                        <form method="POST" action="{{route('PDFgeneratorPerMonth')}}" class="flex flex-row items-center justify-around" target="_blank">
                                            @csrf
                                            <input type="hidden" value="{{ $userId }}" name="idUser">
                                            <input type="hidden" value="{{ $ndfsemploye[$i]->MoisEnCours }}" name="selectedMonth">
                                            <button type ="submit" class="text-blue-600 text-bold border-4 border-blue-600  py-1 px-1">Voir la note de frais</button>
                                        </form>
                                    </td>
                                    @else
                                    <td class="text-center">. . .</td>
                                @endif
                            <td
                                class="px-6 py-3 text-center">
                                <form method="POST" action="{{ route('supprimerNDF') }}">
                                    @csrf
                                    <input type="hidden" name="username"
                                        value="{{ $ndfsemploye[$i]->Utilisateur }}">
                                    <input type="hidden" name="moisndf"
                                        value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                    <button type="submit" class="text-red-600 text-bold border-4 border-red-600  py-1 px-1">Supprimer</button>
                                </form>
                            </td>
                            @endif



                    @endfor
                @endif

            </tbody>

        </table>
    </div>





</x-app-layout>
