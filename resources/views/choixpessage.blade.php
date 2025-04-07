<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>client</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        main {
            max-width: 1100px;
            margin: 20px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 0.875rem;
            color: #666;
        }

        label {
            display: block;
            font-size: 0.875rem;
            margin-bottom: 6px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            color: #333;
        }

        input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            border: none;
        }

        .cancel-button {
            background-color: transparent;
            color: #333;
            margin-right: 10px;
        }

        .submit-button {
            background-color: #4a90e2;
            color: white;
        }

        .submit-button:hover {
            background-color: #357ab7;
        }

        .screenshot-button {
            background-color: #ff6b6b;
            color: white;
            margin-right: 10px;
        }

        .screenshot-button:hover {
            background-color: #e63946;
        }
    </style>
        @include('navbar')
</head>
<body>

<main id="main-content">
    <h2>Informations</h2>
    <p>Veuillez fournir les informations  des pessage</p>
    <form method="post"  action="{{ route('client_post') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-section">
            <div class="grid">
                <div>

     <label for="Nom_client">choisir un client </label>
    <select id="Nom_client" name="Nom_client" required>
    @foreach($pessages->unique('Nom_client') as $pessage)
        <option value="{{ $pessage->Nom_client}}">{{ $pessage->Nom_client }}</option>
        @endforeach
    </select>

                </div>


            </div>
        </div>
        <div class="button-container">
            <button type="button" class="cancel-button" onclick="document.querySelector('form').reset();">Annuler</button>
            <button type="submit" class="submit-button">Rechercher</button>
        </div>
    </form>
</main>


</body>
</html>
