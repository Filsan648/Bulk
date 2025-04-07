<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recherche Analytique | Logistique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .highlight-row {
            transition: all 0.2s ease;
        }

        .highlight-row:hover {
            transform: scale(1.01);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>

    @include('navbar')
</head>
<body class="gradient-bg">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Formulaire de recherche -->
                <div class="w-full md:w-1/3 space-y-6">
                    <div class="border-b pb-4">
                        <h1 class="text-2xl font-bold text-gray-800">Recherche Analytique</h1>
                        <p class="text-sm text-gray-500 mt-2">Filtrez les données par période et client</p>
                    </div>

                    <form method="POST" action="{{ route('Rechercher_post') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Intervalle de dates</label>
                                <div class="grid grid-cols-1 gap-4">
                                    <input type="date" id="date_debut" name="date_debut"
                                           class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                           required>
                                    <input type="date" id="date_fin" name="date_fin"
                                           class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                           required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                                <select id="type" name="type"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none bg-select-arrow bg-no-repeat bg-[right_1rem_center]"
                                        required>
                                    <option value="">Sélectionner un client</option>
                                    <option value="ALL">Tous les clients</option>
                                    @foreach($client as $clien)
                                    <option value="{{$clien}}">{{$clien}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center space-x-2">
                            <i class="fas fa-search mr-2"></i>
                            Lancer la recherche
                        </button>
                    </form>
                </div>

                <!-- Visualisation -->
                <div class="w-full md:w-2/3 flex flex-col">
                    <img src="{{asset('images/Stuck at Home - Searching.png')}}" alt="Analytics"
                         class="animate-float w-full h-auto max-h-96 object-contain mt-4">
                </div>
            </div>
        </div>

        <!-- Résultats -->
        @if(isset($resultats))
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-chart-bar mr-2 text-blue-500"></i>
                    Résultats de recherche
                </h2>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                    {{ $resultats->count() }} résultats trouvés
                </span>
            </div>

            @if($resultats->isNotEmpty())
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">Référence</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">Poids Net</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">Chauffeur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-700 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($resultats as $resultat)
                        <tr class="highlight-row hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600">{{ $resultat->reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $resultat->Nom_client }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $resultat->Poids_net }} kg</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $resultat->Nom_conducteur }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $resultat->Date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg flex justify-between items-center">
                <span class="text-sm text-gray-600">Total des résultats :</span>
                <span class="text-lg font-bold text-blue-700">{{ $Total }} kg</span>
            </div>
            @else
            <div class="text-center p-8">
                <div class="text-gray-400 text-5xl mb-4">
                    <i class="fas fa-search-minus"></i>
                </div>
                <h3 class="text-gray-500 text-lg font-medium">Aucun résultat trouvé</h3>
                <p class="text-gray-400 mt-2">Essayez d'ajuster vos critères de recherche</p>
            </div>
            @endif
        </div>
        @endif
    </main>
</body>
</html>