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
                    @elseif ((Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $isSalarie == 1 && count($ndfsemploye) != 0) ||
                        ($utilisateurSelectionne == Auth::user()->name && Auth::user()->admin == 1 && Auth::user()->superadmin == 0))
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
                        @if ($ndfsemploye[$i]->Valide == 0)
                            <td class="  text-center TD-gestion">
                                <form method="POST" action="{{ route('validationNDF') }}">
                                    @csrf
                                    <input type="hidden" name="moisNDF" value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                    <input type="hidden" name="employe" value="{{ $ndfsemploye[$i]->Utilisateur }}">

                                    <button class="button-visu" type="submit">Vérifier la note de frais</button>
                                </form>
                            </td>
                        @elseif($ndfsemploye[$i]->Valide == 1)
                            <td class="flex flex-col items-center justify-around check mt-1 mb-1">
                                <img src="./images/icon-checkmark.png" alt="validé" width="30px" height="30px">
                            </td>
                        @endif
                        @if (Auth::user()->superadmin == 1)
                            @if ($ndfsemploye[$i]->Valide == 1)
                                <td>
                                    <form method="POST" action="{{ route('PDFgeneratorPerMonth') }}"
                                        class="flex flex-row items-center justify-around" target="_blank">
                                        @csrf
                                        <input type="hidden" value="{{ $userId }}" name="idUser">
                                        <input type="hidden" value="{{ $ndfsemploye[$i]->MoisEnCours }}"
                                            name="selectedMonth">
                                        <button type="submit"
                                            class="text-blue-600 text-bold border-4 border-blue-600  py-1 px-1 TD-gestion">Voir
                                            la note de frais</button>
                                    </form>
                                </td>
                            @else
                                <td class="text-center">. . .</td>
                            @endif
                            @if ($ndfsemploye[$i]->Valide == 1)
                                <td class=" text-center">

                                    <button type="button"
                                        class="text-red-600 text-bold border-4 border-red-600  py-1 px-1 TD-gestion"
                                        data-modal-toggle="sure-modal{{ $i }}">Supprimer</button>

                                </td>
                            @else
                                <td>
                                    <h5 class="text-center">Pas encore validée</h5>
                                </td>
                            @endif
                        @endif
                        <!-- * permet a l'admin de pouvoir voir les ndfs validé des salariés ainsi que ces propres NDFs mais pas celles du super admin ni celles des autres admins -->
                        @if ((Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $isSalarie == 1) ||
                            ($utilisateurSelectionne == Auth::user()->name && Auth::user()->admin == 1 && Auth::user()->superadmin == 0))
                            @if ($ndfsemploye[$i]->Valide == 1)
                                <td>
                                    <form method="POST" action="{{ route('PDFgeneratorPerMonth') }}"
                                        class="flex flex-row items-center justify-around" target="_blank">
                                        @csrf
                                        <input type="hidden" value="{{ $userId }}" name="idUser">
                                        <input type="hidden" value="{{ $ndfsemploye[$i]->MoisEnCours }}"
                                            name="selectedMonth">
                                        <button type="submit"
                                            class="text-blue-600 text-bold border-4 border-blue-600  py-1 px-1 button-visu">Voir
                                            la note de frais</button>
                                    </form>
                                </td>
                            @else
                                <td class="text-center">. . .</td>
                            @endif
                            @if ($ndfsemploye[$i]->Valide == 1)
                                <td class=" text-center">

                                    <button type="button"
                                        class="text-red-600 text-bold border-4 border-red-600  py-1 px-1 TD-gestion"
                                        data-modal-toggle="sure-modal{{ $i }}">Supprimer</button>

                                </td>
                            @else
                                <td>
                                    <h5 class="text-center">Pas encore validée</h5>
                                </td>
                            @endif
                        @endif
                    </tr>


                    <div id="sure-modal{{ $i }}" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full"
                        aria-hidden="true">
                        <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                    data-modal-toggle="sure-modal{{ $i }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Etes-vous sûr
                                        de bien
                                        vouloir supprimer cette note de frais ?</h3>
                                    <form action="{{ route('supprimerNDF') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="username"
                                            value="{{ $ndfsemploye[$i]->Utilisateur }}">
                                        <input type="hidden" name="moisndf"
                                            value="{{ $ndfsemploye[$i]->MoisEnCours }}">
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Oui, je suis sûr
                                        </button>

                                    <button data-modal-toggle="sure-modal{{ $i }}" type="button"
                                        class="mt-2 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        Non
                                    </button>
                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor


            </tbody>

        </table>


    </div>
    @if (count($ndfsemploye) == 0)
        <div class="w-full flex  flex-row text-center items-center justify-around border-2 border-gray-800 py-2">Désolé
            , {{ $utilisateurSelectionne }} n'a pas de notes de frais enregistrées.</div>
    @endif





</x-app-layout>
