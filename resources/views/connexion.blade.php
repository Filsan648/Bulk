<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Se connecter</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: Arial, sans-serif;
    }

    /* Vidéo en arrière-plan */
    .background-video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1; /* Place la vidéo en arrière-plan */
    }

    /* Conteneur du formulaire */
    .form-container {
      background-color: rgba(122, 117, 117, 0.9); /* Légèrement transparent */
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 8px rgba(243, 122, 122, 0.1);
      width: 90%; /* Responsive width */
      max-width: 400px;
      margin: auto;
      z-index: 1; /* Place le formulaire au-dessus de la vidéo */
    }

    h3 {
      font-size: 1.875rem;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 0.5rem;
    }

    p {
      font-size: 1rem;
      color: #4b5563;
      margin-bottom: 4rem;
    }

    form {
      max-width: 24rem;
      margin: 0 auto;
      text-align: left;
    }

    label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: #111827;
      margin-bottom: 0.5rem;
    }

    input {
      width: 100%;
      height: 2.75rem;
      padding: 0.5rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      outline: none;
      transition: border-color 0.2s;
    }

    input:focus {
      border-color: #111827;
    }

    .submit-btn {
      width: 100%;
      padding: 0.875rem;
      border-radius: 0.5rem;
      background-color: #111827;
      color: white;
      font-weight: bold;
      text-transform: uppercase;
      margin-top: 1.5rem;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .submit-btn:hover {
      background-color: #1f2937;
    }

    .forgot-password {
      display: flex;
      justify-content: flex-end;
      margin-top: 1rem;
    }

    .forgot-password a {
      font-size: 0.875rem;
      font-weight: 500;
      color: #111827;
      text-decoration: none;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 480px) {
      h3 {
        font-size: 1.5rem;
      }

      p {
        font-size: 0.875rem;
      }

      .form-container {
        padding: 1.5rem;
      }

      label {
        font-size: 0.8rem;
      }

      input {
        height: 2.5rem;
      }

      .submit-btn {
        padding: 0.75rem;
      }
    }
  </style>
</head>
<body>
  <!-- Vidéo en arrière-plan -->
  <video class="background-video" autoplay loop muted>
    <source src="images/back.mp4" type="video/mp4">
    Votre navigateur ne supporte pas les vidéos HTML5.
  </video>

  <!-- Formulaire -->
  <div class="form-container">
    <h3>Se connecter</h3>
    <p>Entrez votre email et votre mot de passe</p>
    <form action="{{ route('login_post') }}" method="POST">
      @csrf
      <div>
        <label for="email">Votre Email</label>
        <input
          id="email"
          type="email"
          name="email"
          placeholder="nom@mail.com"
        />
      </div>
      <div style="margin-top: 1.5rem;">
        <label for="password">Mot de passe</label>
        <input
          id="password"
          type="password"
          name="password"
          placeholder="********"
        />
      </div>
      <button class="submit-btn" type="submit">Se connecter</button>
      <div class="forgot-password">
        <a href="{{ route('forget_password') }}">Mot de passe oublié</a>
      </div>
    </form>
  </div>
</body>
</html>
