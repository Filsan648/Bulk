<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cimenterie</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                width: 100%;
                margin: 0;
            }

            main {
                max-width: 100%;
                border: 1px solid #ccc;
                padding: 20px;
            }
        }

        /* Ajout de styles pour l'image */
        .logo {
            width: 50px;
            height: auto;
            margin-right: 1rem;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
    </style>
    <script>
        function printContent() {
            window.print();
        }
    </script>
</head>

<body class="bg-gray-100">

<main id="main-content" class="max-w-screen-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <h2 class="text-3xl font-semibold text-gray-800">CIMENTERIE D'ALI-SABIEH CIMAS</h2>
    </div>

    <p class="text-gray-600 mb-4 font-bold">Djibouti - Tel :+(+253) 21 35-89-59 - 21 34-51-24 E-mail:cimeneteriealisabieh2015@gmail.com </p>
    <h2 class="text-3xl font-semibold text-gray-800 text-center font-bold">WEIGH BRIDGE SLIP</h2> <!-- Modifié pour centrer -->
    <div class="flex justify-between items-center mb-4">
        <div></div>
        <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-600" onclick="printContent()">
            Imprimer
        </a>

    </div>

    <!-- Tableau pour les informations -->
    @foreach($pessages as $pessage)
    <div class="bg-gray-50 rounded-lg p-4 mb-4 shadow-md">

        <table class="min-w-full table-auto border-collapse">

        <tbody>
            <form id="delete-form-{{ $pessage->pessageID }}" action="{{ route('pessage.destroy', ['id' =>$pessage->pessageID,'ref' =>$pessage->reference]) }}" method="POST" class="absolute top-4 right-4">
                @csrf
                @method('DELETE')
                <button type="button" class="text-black hover:text-gray-700" onclick="confirmDeletion(event, {{ $pessage->pessageID }})">
                    <i class="fas fa-trash-alt text-2xl"></i>
                </button>
            </form>
    <tr>
        <!-- Première colonne avec 4 éléments -->
        <td colspan="2">

            <table>
                <tr>
                    <th class="text-left py-2">Reference NO:</th>
                    <td class="py-2">{{ $pessage->reference }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">Truck nO:</th>
                    <td class="py-2">{{ $pessage->numero_vehicule }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">Customer Name:</th>
                    <td class="py-2">{{ $pessage->Nom_client }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">Date/Time out:</th>
                    <td class="py-2">{{  $pessages_sorti->Date}}</td>

                </tr>
                <tr>
                    <th class="text-left py-2">Date/Time in:</th>
                    <td class="py-2">{{ $pessage->Date }}</td>
                </tr>

                <tr>
                    <th class="text-left py-2">Comming from:</th>
                    <td class="py-2">{{ $pessage->origine }}</td>

                </tr>


            </table>
        </td>

        <!-- Deuxième colonne avec le reste des éléments -->
        <td colspan="2">
            <table>
            <tr>
                    <th class="text-left py-2">Ticket No:</th>
                    <td class="py-2">{{ $pessage->Numero_tiket }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">Operator:</th>
                    <td class="py-2">{{ $pessage->Operateur }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">Driver :</th>
                    <td class="py-2">{{ $pessage->Nom_conducteur }}</td>
                </tr>

                <tr>
                    <th class="text-left py-2">Matérial:</th>
                    <td class="py-2">{{ $pessage->type_materiel }}</td>
                </tr>

                <tr>
                    <th class="text-left py-2">Destination:</th>
                    <td class="py-2">{{ $pessage->destination }}</td>
                </tr>
            </table>
        </td>
    </tr>
</tbody>



       <!-- Ajout des valeurs de poids au milieu -->
<tbody>
    <tr>
        <td colspan="2" class="text-center py-4">
            <table class="mx-auto">
                <tr>
                    <th class="text-left py-2">GROSS WT (in T):</th>
                    <td class="py-2">{{ $pessage->Poids_brut }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">TARE WT (in T):</th>
                    <td class="py-2">{{ $pessage->Poids_tare }}</td>
                </tr>
                <tr>
                    <th class="text-left py-2">NET WT (in T):</th>
                    <td class="py-2">{{ $pessage->Poids_net }}</td>
                </tr>
            </table>
        </td>
    </tr>
</tbody>
        </table>


        <div class="mt-4">
            <strong>Operator's Signature:</strong> _____________________ &nbsp;
            <strong>Customer's Signature:</strong> _____________________ &nbsp;
            <strong>Driver's Signature:</strong> _____________________&nbsp;
        </div>
    </div>
    @endforeach
</main>

</body>
<script>
    function confirmDeletion(event, id) {
        event.preventDefault();
        if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
</script>
</html>
