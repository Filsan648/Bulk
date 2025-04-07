<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        .navbar {
          position: sticky; /* Sticks the navbar to the top */
            top: 0; /* Position it at the top */
            z-index: 1000; /* Ensures the navbar is on top of other elements */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px; /* Add some padding for aesthetics */
            background-color: #fff; /* Added background color */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Added shadow */
            transition: all 0.3s ease-in-out; /* Smooth transition for all properties */
        }



        .navbar img {
            height: 50px; /* Adjust the height of the logo */
            margin-right: 10px; /* Space between logo and title */
            transition: transform 0.3s ease;
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .navbar .title {
            color:#7e61ff; /* Title color */
            font-size: 24px; /* Title size */
            margin: 0; /* Remove default margin */
            font-weight: 600; /* Make the title bold */
            letter-spacing: 1px;
            margin-left: 150px; /* Space between letters */
            animation: colorChange 5s infinite alternate;
        }

        @keyframes colorChange {
            0% { color: #2eadff; }
            50% { color: #7e61ff; }
            100% { color: #2eadff; }
        }

        .navbar a {
            color: black;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 4px; /* Add rounded corners */
            transition: all 0.3s ease; /* Updated transition */
            position: relative; /* Added for hover effect */
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar a:hover {
            /* Light yellow background */
            transform: translateY(-2px); /* Slight lift effect */
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }



        .navbar .dropdown .dropbtn {

            padding: 14px 16px;
            background-color: inherit;
            border: none;
            font-family: inherit;
            font-size: 16px;
            color: black;
            font-weight: bold;

        }

        .navbar .dropdown-content {
            display: block; /* Changed from none */
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            z-index: 1;
            border-radius: 4px;
            opacity: 0; /* Start hidden */
            visibility: hidden; /* Start hidden */
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .navbar .dropdown-content a {
            color: black; /* Text color */
            padding: 12px 16px;
            display: block;
            text-align: left;
            font-weight: bold;

        }



        .navbar .dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation pour le hover des liens du dropdown */
        .navbar .dropdown-content a:hover {
            animation: slideRight 0.3s ease-out;
            background-color: #2eadff;
        }

        @keyframes slideRight {
            from { transform: translateX(-10px); }
            to { transform: translateX(0); }
        }


        section {
            padding: 60px 20px;
            height: 100vh; /* Makes each section fill the viewport height */
        }

        /* Background colors for sections */

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        /* Add underline animation */
        .navbar a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #7e61ff;
            transition: width 0.3s ease;
        }

        .navbar a:hover::after {
            width: 100%;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 20px;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">

            <div class="nav-links">

                <a href="{{ route('form_get') }}">Formulaire</a>
                <a href="{{ route('Rechercher') }}">Rechercher</a>
                  <a href="{{ route('client_get') }}">Affichage</a>
                  <a href="{{ route('stock') }}">Stock @if ($COUNT !=0)
                    <span style="font-size:10px;color:red; ">{{$COUNT }} </span></a>
                  @endif
                <a href="{{ route('Bar_chart') }}">Analyser les données</a>

            </div>
        </div>

        <div class="dropdown">
            <a class="dropbtn" onclick="toggleDropdown(event, 'dropdown2')">
                <i class="fas fa-cog"></i> Paramètres
            </a>
            <div id="dropdown2" class="dropdown-content">
                <a href="{{ route('updat_password') }}">Modifier mot de passe</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</div>

        <a href="#about"></a>
        <a href="#services"></a>
        <div class="dropdown">
            <button class="dropbtn" onclick="toggleDropdown(event, 'dropdown2')"></button>
            <div id="dropdown2" class="dropdown-content">

            </div>
        </div>
    </div>



</body>
</html>
