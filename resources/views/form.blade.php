<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #edf2f7 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        main {
            max-width: 1400px;
            margin: 20px auto;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            backdrop-filter: blur(10px);
            display: flex;
            gap: 60px;
            align-items: flex-start;
        }

        h2 {
            font-size: 1.75rem;
            color: #1a1a1a;
            margin-bottom: 16px;
            font-weight: 600;
        }

        p {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-size: 0.875rem;
            margin-bottom: 8px;
            color: #2d3748;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #2d3748;
            transition: all 0.2s ease;
            background-color: #f8fafc;
        }

        input:hover, select:hover {
            border-color: #cbd5e0;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
            background-color: white;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 24px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
            gap: 20px;
        }

        button {
            padding: 14px 28px;
            font-size: 0.95rem;
            border-radius: 12px;
            cursor: pointer;
            border: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .cancel-button {
            background-color: #f7fafc;
            color: #4a5568;
            border: 2px solid #e2e8f0;
        }

        .cancel-button:hover {
            background-color: #edf2f7;
            border-color: #cbd5e0;
        }

        .submit-button {
            background: linear-gradient(135deg, #2eadff, #3d83ff, #7e61ff);
            color: white;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.2);
        }

        .image-droit {
            width: 320px;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .image-droit:hover {
            transform: scale(1.02);
        }

        .content-1 {
            flex: 1;
        }

        .form-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.7);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .hidden {
            display: none;
        }
    </style>
    @include('navbar')
</head>
<body>
<main id="main-content">
    <img src="{{asset('images/logo.png')}}" alt="droit"  class="image-droit">
    <div class="content-1">
    <h2>Informations</h2>
    <p>Veuillez remplir les informations ci-dessous.</p>
    <form method="post" action="{{ route('form_post') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-section">
            <div class="grid">
            <div>
        <label for="reference">Il s'agit d'un</label>
        <select id="reference" name="reference" required >
        <option value="entree">Pessage entrée</option>
        <option value="sorti">Pessage sortie</option>
        <option value="Stock">ajout dans le stock</option>
        </select>
        </div>

    <div>
     <label for="Nom_conducteur">N° marticule(sinon 0)</label>
     <input type="number" id="marticule" name="marticule" required>
    </div>
     <div>
      <label for="Nom_conducteur">Nom du conducteur</label>
       <input type="text" id="Nom_conducteur" name="Nom_conducteur" required>
      </div>
      <div>
    <label id="client-label" for="extra-section">Livraision au </label>
      <select id="client-select" name="Nom_client" class="form-section hidden" required >
        @foreach($pessages->unique('Nom_client') as $pessage)
            <option value="{{ $pessage->Nom_client }}">{{ $pessage->Nom_client }}</option>
        @endforeach
        <option value="Al-buruuj">Al-buruuj</option>
        <option value="Al-Nasri Construction">Al-Nasri Construction</option>
       <option value="CCECC Djibouti">CCECC Djibouti</option>
       <option value="Al Gamil Concasseur">Al Gamil Concasseur</option>
       <option value="Hawk Construction">Hawk Construction</option>


  </select>

</div>
  <div>
                    <label for="numero_vehicule">Numéro du véhicule</label>
                    <input type="text" id="numero_vehicule" name="numero_vehicule" required>
                </div>
                <div>
                    <label for="type_materiel">Type de matériel</label>
                    <input type="text" id="type_materiel" name="type_materiel" required>
                </div>

                <div>
                    <label for="Operateur">Opérateur</label>
                    <input type="text" id="Operateur" name="Operateur" required>
                </div>
                <div>
                    <label id="origine-label" for="origine" class="form-section">Origine</label>
                    <input type="text" id="origine-input" name="origine" required>
                </div>
                <div>
                    <label id="destination-label" for="destination">Destination</label>
                    <input type="text" id="destination-input" name="destination" required>
                </div>
                <div>
                    <label for="Poids_tare">Poids tare</label>
                    <input type="number" id="extra-section" step="0.01" name="Poids_tare" required>
                </div>
                <div>
                    <label for="Poids_brut">Poids brut</label>
                    <input type="number" id="Poids_brut" step="0.01" name="Poids_brut" required>
                </div>
                <div>
                    <label for="Date">Date</label>
                    <input type="datetime-local" id="Date" name="Date" required>
                </div>
            </div>
        </div>
        <div class="button-container">
            <button type="button" class="cancel-button" onclick="document.querySelector('form').reset();">Annuler</button>
            <button type="submit" class="submit-button">Enregistrer</button>
        </div>
    </form>
    <div>
</main>
<script>
    const referenceSelect = document.getElementById('reference');
    const clientSelect = document.getElementById('client-select');
    const clientLabel = document.getElementById('client-label');
    const origineInput = document.getElementById('origine-input');
    const origineLabel = document.getElementById('origine-label');
    const destinationInput = document.getElementById('destination-input');
    const destinationLabel = document.getElementById('destination-label');

    function toggleExtraSection() {
        if (referenceSelect.value === 'Stock') {
            // Masquer client
            clientSelect.classList.add('hidden');
            clientLabel.classList.add('hidden');
            clientSelect.removeAttribute('required');

            // Masquer origine et destination
            origineInput.classList.add('hidden');
            origineLabel.classList.add('hidden');
            origineInput.removeAttribute('required');

            destinationInput.classList.add('hidden');
            destinationLabel.classList.add('hidden');
            destinationInput.removeAttribute('required');
        } else {
            // Afficher client
            clientSelect.classList.remove('hidden');
            clientLabel.classList.remove('hidden');
            clientSelect.setAttribute('required', 'required');


            origineInput.classList.remove('hidden');
            origineLabel.classList.remove('hidden');
            origineInput.setAttribute('required', 'required');

            destinationInput.classList.remove('hidden');
            destinationLabel.classList.remove('hidden');
            destinationInput.setAttribute('required', 'required');
        }
    }

    referenceSelect.addEventListener('change', toggleExtraSection);

    toggleExtraSection();
</script>
</body>
</html>
