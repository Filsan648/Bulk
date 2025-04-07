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

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px; /* Espace pour l'icône */
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
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

        .submit-button {
            background-color: #4a90e2;
            color: white;
        }

        .submit-button:hover {
            background-color: #357ab7;
        }
    </style>
 
</head>
<body>

<main id="main-content">
    <h2>Informations</h2>
    <p>Veuillez remplir les informations ci-dessous.</p>
    <form method="post" action="{{ route('update_password_post') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-section">
            <div class="grid">
                <div>
                    <label for="email">Votre email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Entrez le nouveau mot de passe</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <div>
                    <button type="submit" class="submit-button">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute between 'password' and 'text'
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon between eye and eye-slash
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
