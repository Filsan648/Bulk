<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier le Pessage d'entrée</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="container mx-auto mt-10">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Modifier  le Pessage d'entrée</h1>

      <!-- Formulaire de modification -->
      <form method="POST" action="{{ route('update_reference_entry', $pessage->pessageID) }}">
        @csrf
        @method('PUT')

        <!-- Champ pour le nom avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checkNom_conducteur" name="modify_fields[]" value="Nom_conducteur" class="mr-2">
          <label for="Nom_conducteur" class="block text-gray-700 w-full">Nom_conducteur</label>
          <input type="text" id="Nom_conducteur" name="Nom_conducteur" value="{{ old('Nom', $pessage->Nom_conducteur) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('Nom_conducteur')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Champ pour le prénom avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checNom_client" name="modify_fields[]" value="Nom_client" class="mr-2">
          <label for="Nom_client" class="block text-gray-700 w-full">Nom_client</label>
          <input type="text" id="Nom_client" name="Nom_client" value="{{ old('Nom_client', $pessage->Nom_client) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('Nom_client')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Champ pour la date d'embauche avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checkNumero_tiket" name="modify_fields[]" value="Numero_tiket" class="mr-2">
          <label for="Numero_tiket" class="block text-gray-700 w-full">Numero_tiket</label>
          <input type="text" id="Numero_tiket" name="Numero_tiket" value="{{ old('Numero_tiket', $pessage->Numero_tiket) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('Numero_tiket')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Champ pour le département avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checknumero_vehicule" name="modify_fields[]" value="numero_vehicule" class="mr-2">
          <label for="numero_vehicule" class="block text-gray-700 w-full">numero_vehicule</label>
          <input type="text" id="numero_vehicule" name="numero_vehicule" value="{{ old('numero_vehicule', $pessage->numero_vehicule) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('numero_vehicule')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>





        @enderror

        <!-- Champ pour la fonction avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checkOperateur" name="modify_fields[]" value="Operateur" class="mr-2">
          <label for="Fonction" class="block text-gray-700 w-full">Operateur</label>
          <input type="text" id="Operateur" name="Operateur" value="{{ old('Operateur', $pessage->Operateur) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('Operateur')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Champ pour le type de contrat avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checkorigine" name="modify_fields[]" value="origine" class="mr-2">
          <label for="origine" class="block text-gray-700 w-full">origine</label>
          <input type="text" id="origine" name="origine" value="{{ old('origine', $pessage->origine) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('origine')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <!-- Champ pour le lieu de travail avec checkbox -->
        <div class="mb-4 flex items-center">
          <input type="checkbox" id="checktype_materiel" name="modify_fields[]" value="type_materiel" class="mr-2">
          <label for="type_materiel" class="block text-gray-700 w-full">type_materiel</label>
          <input type="text" id="type_materiel" name="type_materiel" value="{{ old('type_materiel', $pessage->type_materiel) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
        </div>
        @error('type_materiel')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
          <!-- Champ pour le département avec checkbox -->
          <div class="mb-4 flex items-center">
            <input type="checkbox" id="checkNPoids_brut" name="modify_fields[]" value="Poids_brut" class="mr-2">
            <label for="Poids_brut" class="block text-gray-700 w-full">Poids_brut</label>
            <input type="number" id="Poids_brut" step="0.01" name="Poids_brut" value="{{ old('Poids_brut', $pessage->Poids_brut) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
          </div>
          @error('Poids_brut')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
            <!-- Champ pour le département avec checkbox -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="checkPoids_tare" name="modify_fields[]" value="Poids_tare" class="mr-2">
            <label for="Poids_tare" class="block text-gray-700 w-full">Poids_tare</label>
            <input type="number" id="Poids_tare"step="0.01" name="Poids_tare" value="{{ old('Poids_tare', $pessage->Poids_tare) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
          </div>
          @error('Poids_tare')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror
            <!-- Champ pour le département avec checkbox -->

            <!-- Champ pour le département avec checkbox -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="checkDate" name="modify_fields[]" value="Date" class="mr-2">
            <label for="Date" class="block text-gray-700 w-full">Date</label>
            <input type="datetime-local" id="Date" name="Date" value="{{ old('Date', $pessage->Date) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
          </div>
          @error('Date')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
          @enderror

            <!-- Bouton de soumission -->
        <div class="flex justify-end mt-6">
          <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">Mettre à jour</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Activer/Désactiver les champs en fonction de la checkbox
    document.getElementById('checkNom_conducteur').addEventListener('change', function() {
      document.getElementById('Nom_conducteur').disabled = !this.checked;
    });

    document.getElementById('checNom_client').addEventListener('change', function() {
      document.getElementById('Nom_client').disabled = !this.checked;
    });

    document.getElementById('checkNumero_tiket').addEventListener('change', function() {
      document.getElementById('Numero_tiket').disabled = !this.checked;
    });

    document.getElementById('checknumero_vehicule').addEventListener('change', function() {
      document.getElementById('numero_vehicule').disabled = !this.checked;
    });

    document.getElementById('checkOperateur').addEventListener('change', function() {
      document.getElementById('Operateur').disabled = !this.checked;
    });

    document.getElementById('checkorigine').addEventListener('change', function() {
      document.getElementById('origine').disabled = !this.checked;
    });

    document.getElementById('checktype_materiel').addEventListener('change', function() {
      document.getElementById('type_materiel').disabled = !this.checked;
    });
    document.getElementById('checkNPoids_brut').addEventListener('change', function() {
      document.getElementById('Poids_brut').disabled = !this.checked;
    });
    document.getElementById('checkPoids_tare').addEventListener('change', function() {
      document.getElementById('Poids_tare').disabled = !this.checked;
    });

    document.getElementById('checkDate').addEventListener('change', function() {
      document.getElementById('Date').disabled = !this.checked;
    });



  </script>
</body>
</html>
