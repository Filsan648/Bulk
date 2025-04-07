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
       /* From Uiverse.io by KapeParaguay */
.buttonpro {
  --btn-default-bg: black;
  --btn-padding: 15px 20px;
  --btn-hover-bg:#3d83ff;
  --btn-transition: 0.3s;
  --btn-letter-spacing: 0.1rem;
  --btn-animation-duration: 1.2s;
  --btn-shadow-color: #3d83ff;
  --btn-shadow: 0 2px 10px 0 var(--btn-shadow-color);
  --hover-btn-color: #3d83ff;
  --default-btn-color: #fff;
  --font-size: 16px;
  --font-weight: 600;
  --font-family: Menlo, Roboto Mono, monospace;
  border-radius: 6em;
}



.buttonpro {
  box-sizing: border-box;
  padding: var(--btn-padding);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--default-btn-color);
  font: var(--font-weight) var(--font-size) var(--font-family);
  background: var(--btn-default-bg);
  cursor: pointer;
  transition: var(--btn-transition);
  overflow: hidden;
  box-shadow: var(--btn-shadow);
  border-radius: 6em;
  border: 2px solid #2a2b3a;
}

.buttonpro span {
  letter-spacing: var(--btn-letter-spacing);
  transition: var(--btn-transition);
  box-sizing: border-box;
  position: relative;
  background: inherit;
}

.buttonpro span::before {
  box-sizing: border-box;
  position: absolute;
  content: "";
  background: inherit;
}
.buttonpro:focus {
  scale: 1.09;
}
.buttonpro:hover,
.buttonpro:focus {
  background: var(--btn-default-bg);
  box-shadow: 0px 0px 10px 0px rgba(119, 68, 255, 0.7);
  border: 2px solid #3d83ff;
}

.buttonpro:hover span,
.buttonpro:focus span {
  color:#3d83ff;
}

.buttonpro:hover span::before,
.buttonpro:focus span::before {
  animation: chitchat linear both var(--btn-animation-duration);
}

@keyframes chitchat {
  0% {
    content: "#";
  }

  5% {
    content: ".";
  }

  10% {
    content: "^{";
  }

  15% {
    content: "-!";
  }

  20% {
    content: "#$_";
  }

  25% {
    content: "№:0";
  }

  30% {
    content: "#{+.";}35%{content: "@}-?";
  }

  40% {
    content: "?{4@%";
  }

  45% {
    content: "=.,^!";
  }

  50% {
    content: "?2@%";
  }

  55% {
    content: "\;1}]";
  }

  60% {
    content: "?{%:%";
    right: 0;
  }

  65% {
    content: "|{f[4";
    right: 0;
  }

  70% {
    content: "{4%0%";
    right: 0;
  }

  75% {
    content: "'1_0<";
    right: 0;
  }

  80% {
    content: "{0%";
    right: 0;
  }

  85% {
    content: "]>'";
    right: 0;
  }

  90% {
    content: "4";
    right: 0;
  }

  95% {
    content: "2";
    right: 0;
  }

  100% {
    content: "";
    right: 0;
  }
}


.notification {
  display: flex;
  flex-direction: column;
  isolation: isolate;
  position: relative;
  width: 15rem;
  height: 20rem;
  background: #29292c;
  border-radius: 1rem;
  overflow: hidden;
  margin-top:40px;
  margin-right: 20px;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  font-size: 16px;
  --gradient: linear-gradient(to bottom, #2eadff, #3d83ff, #7e61ff);
  --color: #32a6ff
}

.notification:before {
  position: absolute;
  content: "";
  inset: 0.0625rem;
  border-radius: 0.9375rem;
  background: #18181b;
  z-index: 2
}

.notification:after {
  position: absolute;
  content: "";
  width: 0.25rem;
  inset: 0.65rem auto 0.65rem 0.5rem;
  border-radius: 0.125rem;
  background: var(--gradient);
  transition: transform 300ms ease;
  z-index: 4;
}

.notification:hover:after {
  transform: translateX(0.15rem)
}

.notititle {
  color: var(--color);
  padding: 0.65rem 0.25rem 0.4rem 1.25rem;
  font-weight: 500;
  font-size: 1.1rem;
  transition: transform 300ms ease;
  z-index: 5;
}

.notification:hover .notititle {
  transform: translateX(0.15rem)
}

.notibody {
  color: #99999d;
  padding: 0 1.25rem;
  transition: transform 300ms ease;
  z-index: 5;
  margin-top:20px;
}

.notification:hover .notibody {
  transform: translateX(0.25rem)
}

.notiglow,
.notiborderglow {
  position: absolute;
  width: 10rem;
  height: 10rem;
  transform: translate(-50%, -50%);
  background: radial-gradient(circle closest-side at center, white, transparent);
  opacity: 0;
  transition: opacity 300ms ease;
}

.notiglow {
  z-index: 3;
}

.notiborderglow {
  z-index: 1;
}

.notification:hover .notiglow {
  opacity: 0.1
}

.notification:hover .notiborderglow {
  opacity: 0.1
}

.note {
  color: var(--color);
  position: fixed;
  top: 80%;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  font-size: 0.9rem;
  width: 75%;
}
.containair{
    display:flex;
    flex-direction: row;


}

.notification-group {
    display: flex;
    flex-direction: row;
    gap: 10px;
}

.iteration-number {
    color: var(--color);
    font-weight: bold;
    font-size: 1.2rem;
}

.containair {
    display: flex;
    flex-wrap: wrap;
    padding-top: 40px;
    justify-content: center;
    gap: 20px;
}

.notification-group {
    flex: 0 0 calc(50% - 20px);
    display: flex;
    align-items: flex-start;
    max-width: 600px;
}

.notification {
    width: 60%;
    margin-right: 0;
}
</style>
    @include('navbar')
</head>
<body>
    <h1 style="font-size:40px;margin-left:150px">  Consultez et suivez en temps réel l'état de votre stock.<h1>
        <main id="main-content" class="flex flex-col items-center ">


            <form method="post" action="{{ route('montpost') }}" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
                @csrf
                <div class="mb-4">
                    <label for="mois" class="block text-gray-700 font-medium mb-2">Mois</label>
                    <select id="mois" name="mois" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400">
                        <option value="">Sélectionner</option>
                        <option value="ALL">ALL</option>
                        @foreach ($pessagesmonths as $pessagesmonth)
                            <option value="{{ $pessagesmonth }}">{{ $pessagesmonth }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between">
                    <!-- Bouton Annuler -->
                    <button type="button" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition"
                        onclick="document.querySelector('form').reset();">
                        Annuler
                    </button>

                    <!-- Bouton Visiter -->
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Visiter
                    </button>
                </div>
            </form>
        </main>

    <div class="containair">
        @foreach ($pessages as $stock)
            <div class="notification-group">

                <div class="notification">
                    <div class="notiglow"></div>
                    <div class="notiborderglow"></div>
                    <div class="notititle"> {{$stock->Date}} <a style="margin-left: 100px"  href="{{ route('stockaffiche', ['id' => $stock->pessageID]) }}"> Voir </a> </div>
                    <div class="notibody">
                        <p>
                            Numero de reference: {{$stock->reference}} <br>
                            Numero de Operateur: {{$stock->Operateur}} <br>
                            Nom du conduteur: {{$stock->Nom_conducteur}} <br>
                            Numero du vehicule: {{$stock->numero_vehicule}} <br>
                            Poids brut: {{$stock->Poids_brut}} kg<br>
                            Poids tare: {{$stock->Poids_tare}} kg<br>
                            Poids net: {{$stock->Poids_net}} kg

                        </p>
                        @if ($stock->Nom_client==='null')
</p>


                        <button class="buttonpro" onclick="toggleForm(this)">
                          <span> Ajouter </span>
                        </button>

                        @else
                       <P style="margin-top:20px; color: green">Cet bulk n'est plus en stock 😁 </P>

                       @endif
                        <div class="containaire" style="display: none;">
                            <form action="{{route('post_stock',['id' => $stock->pessageID])}}" method="POST" class="flex flex-col gap-4">
                                @csrf
                                @method('PUT')
                                <div class="notification" style="width: 100%;height:100%">
                                    <div class="notititle">Ajouter le pessage</div>
                                    <div class="notibody">


                                        <label for="client" class="block"></label>
                                        <select id="client" name="client"class="border rounded p-2 w-full" required >
                                            @foreach ($Nom_client as $Nom) <option value="{{$Nom}}">{{$Nom}}</option>

                                          @endforeach
                                        </select>


                                        <label for="origine" class="block">origine</label>
                                        <input type="text" id="origine" name="origine" required class="border rounded p-2 w-full">

                                        <label for="destination" class="block">destination</label>
                                        <input type="text" id="destination" name="destination" required class="border rounded p-2 w-full">

                                        <label for="poids_brut" class="block">Poids brut (kg):</label>
                                        <input type="number" id="poids_brut" name="poids_brut" required class="border rounded p-2 w-full">

                                        <label for="poids_tare" class="block">Poids tare (kg):</label>
                                        <input type="number" id="poids_tare" name="poids_tare" required class="border rounded p-2 w-full">



                                        <label for="Date" class="block">Date:</label>
                                        <input type="datetime-local" id="Date" name="Date" required class="border rounded p-2 w-full">

                                        <button type="submit" class="buttonpro" style="width: 100%;">
                                            <span>Ajouter</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        @endforeach
    </div>
    <script>
    function toggleForm(button) {
        const formContainer = button.nextElementSibling; // Get the next sibling (the form container)
        const notification = button.closest('.notification'); // Get the closest notification container
        if (formContainer.style.display === "none" || formContainer.style.display === "") {
            formContainer.style.display = "block"; // Show the form
            notification.style.height = '55rem'; // Adjust the height of the notification
        } else {
            formContainer.style.display = "none"; // Hide the form
            notification.style.height = '';
        }
    }
    </script>
</body>
</html>
