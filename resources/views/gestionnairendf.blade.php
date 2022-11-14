<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <!--   Cette vue est celle ou l'administrateur peut voir les différentes note de frais de ses employés et les valider   -->

    <h2 class="h2-top-page">Notes de frais de l'utilisateur <span>{{ $utilisateurSelectionne }}</span></h2>
    <div class="w-full flex flex-row justify-around">
        <table class="table-ndf text-sm text-left text-gray-700 dark:text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 text-center TH-gestion">
                        Mois
                    </th>
                    <th class="px-6 py-3 text-center tchao900">
                        Déplacements
                    </th>
                    <th class="px-6 py-3 text-center TH-gestion">
                        Validation
                    </th>
                     @if (Auth::user()->superadmin == 1)

                        <th class=" text-center TH-gestion">Note de frais</th>
                        <th class=" text-center TH-gestion">Suppression</th>

                        <!-- * permet a l'admin de pouvoir voir les ndfs validé des salariés ainsi que ces propres NDFs mais pas celles du super admin ni celles des autres admins -->

                        @elseif ((Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $isSalarie == 1 && count($ndfsemploye) != 0)||($utilisateurSelectionne == Auth::user()->name && Auth::user()->admin == 1 && Auth::user()->superadmin == 0))

                        <th class=" text-center TH-gestion">Note de frais</th>
                        <th class=" text-center TH-gestion">Suppression</th>
                    @endif

                </tr>
            </thead>
            <tbody>

                    @for ($i = 0; $i < count($ndfsemploye); $i++)
                     <tr>

                            <td class=" text-center TD-gestion">
                                {{ $ndfsemploye[$i]->MoisEnCours }}
                            </td>
                            <td class=" text-center items-center tchao900 TD-gestion">
                                {{ $ndfsemploye[$i]->NombreEvenement }}
                            </td>
                            @if($ndfsemploye[$i]->Valide == 0)
                                <td class="  text-center TD-gestion">
                                    <form method="POST" action="{{ route('validationNDF') }}">
                                        @csrf
                                        <input type="hidden" name="moisNDF"
                                            value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                        <input type="hidden" name="employe"
                                            value="{{ $ndfsemploye[$i]->Utilisateur }}">

                                        <button class="button-visu" type="submit">Vérifier la note de frais</button>
                                    </form>
                                </td>
                            @elseif($ndfsemploye[$i]->Valide == 1)

                                <td class="flex flex-col items-center justify-around check mt-1 mb-1">
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
                                                <button type ="submit" class="text-blue-600 text-bold border-4 border-blue-600  py-1 px-1 TD-gestion">Voir la note de frais</button>
                                            </form>
                                        </td>
                                        @else
                                        <td class="text-center">. . .</td>
                                    @endif
                                    @if($ndfsemploye[$i]->Valide == 1)
                                        <td
                                        class=" text-center">
                                        <form method="POST" action="{{ route('supprimerNDF') }}">
                                            @csrf
                                            <input type="hidden" name="username"
                                                value="{{ $ndfsemploye[$i]->Utilisateur }}">
                                            <input type="hidden" name="moisndf"
                                                value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                            <button type="submit" class="text-red-600 text-bold border-4 border-red-600  py-1 px-1 TD-gestion">Supprimer</button>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                        <h5 class="text-center">Pas encore validée</h5>
                                    </td>
                                    @endif
                                @endif
                                <!-- * permet a l'admin de pouvoir voir les ndfs validé des salariés ainsi que ces propres NDFs mais pas celles du super admin ni celles des autres admins -->
                                @if((Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $isSalarie == 1)||($utilisateurSelectionne == Auth::user()->name && Auth::user()->admin == 1 && Auth::user()->superadmin == 0))
                                @if($ndfsemploye[$i]->Valide == 1)
                                    <td>
                                        <form method="POST" action="{{route('PDFgeneratorPerMonth')}}" class="flex flex-row items-center justify-around" target="_blank">
                                            @csrf
                                            <input type="hidden" value="{{ $userId }}" name="idUser">
                                            <input type="hidden" value="{{ $ndfsemploye[$i]->MoisEnCours }}" name="selectedMonth">
                                            <button type ="submit" class="text-blue-600 text-bold border-4 border-blue-600  py-1 px-1 button-visu">Voir la note de frais</button>
                                        </form>
                                    </td>
                                    @else
                                    <td class="text-center">. . .</td>
                                @endif
                                @if($ndfsemploye[$i]->Valide == 1)
                                <td
                                class=" text-center">
                                <form method="POST" action="{{ route('supprimerNDF') }}">
                                    @csrf
                                    <input type="hidden" name="username"
                                        value="{{ $ndfsemploye[$i]->Utilisateur }}">
                                    <input type="hidden" name="moisndf"
                                        value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                    <button type="submit" class="text-red-600 text-bold border-4 border-red-600  py-1 px-1 TD-gestion">Supprimer</button>
                                </form>
                            </td>
                            @else
                            <td>
                                <h5 class="text-center">Pas encore validée</h5>
                            </td>
                            @endif
                            @endif
                        </tr>



                    @endfor


            </tbody>

        </table>

    </div>
    @if(count($ndfsemploye) == 0)
        <div class="w-full flex  flex-row text-center items-center justify-around border-2 border-gray-800 py-2">Désolé , {{$utilisateurSelectionne}} n'a pas de notes de frais enregistrées.</div>
    @endif





</x-app-layout>
