<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .table-header {
            background-color: #4a90e2;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
    </style>
</head>
@include('navbar')

<body class="bg-gray-100">

    <main id="main-content" class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations</h2>
        <p class="text-gray-600 mb-6">Veuillez vérifier les informations ci-dessous</p>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                <thead>
                    <tr class="table-header text-sm md:text-base">
                    <th class="py-3 px-2 sm:px-4 border-b">Marticule</th>
                    <th class="py-3 px-2 sm:px-4 border-b">N° reference</th>
                        <th class="py-3 px-2 sm:px-4 border-b">Nom Conducteur</th>
                        <th class="py-3 px-2 sm:px-4 border-b">Nom Client</th>

                        <th class="py-3 px-2 sm:px-4 border-b">Numéro Véhicule</th>
                        <th class="py-3 px-2 sm:px-4 border-b">Type Matériel</th>

                        <th class="py-3 px-2 sm:px-4 border-b">Opérateur</th>
                        <th class="py-3 px-2 sm:px-4 border-b">Date</th>
                        <th class="py-3 px-2 sm:px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pessages as $pessage)

                    <tr class="hover:bg-gray-50 text-sm md:text-base">
                    <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->pessageID}}</td>

                    <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->reference}}</td>
                        <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->Nom_conducteur}}</td>
                        <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->Nom_client}}</td>

                        <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->numero_vehicule}}</td>

                        <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->Poids_brut}}</td>
                        <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->Operateur}}</td>

                        <td class="py-3 px-2 sm:px-4 border-b">{{$pessage->created_at}}</td>
                        <td class="py-3 px-2 sm:px-4 border-b">
                            <div class="action-buttons relative">
                                <form id="delete-form-{{ $pessage->pessageID }}" action="{{ route('pessage.destroy', ['id' =>$pessage->pessageID,'ref' =>$pessage->reference]) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-black hover:text-gray-700" onclick="confirmDeletion(event, {{ $pessage->pessageID }})">
                                        <i class="fas fa-trash-alt text-2xl"></i>
                                    </button>
                                </form>
                                @php
                                $user = Auth::user();
                       $pessageentre = isset($pessage->reference)
                           ? App\Models\pessage::where('reference', $pessage->reference)->where('type', 'entree')->first()
                                  : null;
                           $counteentre= isset($pessage->reference)? App\Models\pessage::where('reference', $pessage->reference)->where('type', 'entree')->count() : null;

                            @endphp

                            @if($user && $user->id == 1)
                                <a href="{{ route('pen_entry', ['id' => $pessage->pessageID]) }}"
                                   class="text-blue-500 hover:text-blue-700 transition duration-300">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                            @endif
                                <a href="{{ route('Imprimer', ['id' => $pessage->pessageID]) }}" class="bg-blue-500 text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 hover:bg-blue-600">Reference de sorti</a>
                                @if($user && $user->id == 1 ||  $user->id == 300  &&  $counteentre === 1  )

                                       @if($pessageentre)
                                <a href="{{ route('pen_exit', ['id' => $pessageentre->pessageID]) }}"
                                    class="text-blue-500 hover:text-blue-700 transition duration-300">
                                  <i class="fas fa-edit text-lg"></i>
                                    @endif

                                 </a>
                             @endif
                                <a href="{{ route('Refernce_entrer', ['id' => $pessage->reference]) }}"
                                    class="{{ $pessage->color== 1 ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300"
                                    onclick="deletePessage({{ $pessage->pessageID }})">
                                    Reference d'entree
                                 </a>

                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function confirmDeletion(event, id) {
                event.preventDefault();
                if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            }
        </script>
    </main>
</body>

</html>
