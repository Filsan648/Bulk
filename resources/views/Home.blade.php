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

.card-2 {
  position: relative;
  width: 100%;
  height: 400px;
  background-image: linear-gradient(to top,rgb(117, 117, 197),white);
  border-radius: 30px;
  border: 2px solid white;
  overflow: hidden;
}

.h1-circle {
  position: absolute;
  right: 70px;
  border-radius: 50%;
  width: 400px;
  height: 400px;
  background-image: radial-gradient(circle at center, #8798c5, #494fa1);
  opacity: .8;
}

.card-2:hover .h1-circle,
.h1-circle:hover {
  animation: moving-weel 1s linear;
  animation-fill-mode: forwards;
}

.h1-circle:not(:hover) {
  animation: moving-weel-2 1s linear;
  animation-fill-mode: backwards;
}

@keyframes moving-weel-2 {
  0% {
    rotate: 160deg;
    right: -170px;
  }

  50% {
    right: 20px;
    rotate: 75deg;
  }

  100% {
    rotate: 0deg;
  }
}

@keyframes moving-weel {
  0% {
    rotate: 0deg;
  }

  50% {
    right: 20px;
    rotate: 90deg;
  }

  100% {
    rotate: 180deg;
    right: -170px;
  }
}

.h1-circle ul li {
  list-style: none;
  color: white;
  font-size: 20px;
  margin: 20px;
}

#h1-circle-ul-1 {
  display: flex;
  flex: 1;
  flex-direction: column;
  position: absolute;
  top: 100px;
  left: 200px;
  transition: 500ms ease-in;
}

#h1-circle-ul-2 {
  opacity: 0;
  flex: 1;
  flex-direction: column;
  position: absolute;
  top: 100px;
  left: 200px;
  transition: 1s ease-in;
}

#h1-circle-ul-2 li {
  transform: rotate(180deg);
  font-size: 20px;
  margin: 30px;
}

#card-2-h1 {
  position: absolute;
  left: 60px;
  top: 10px;
  color: transparent;
  font-size: 40px;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  z-index: 700;
  background: linear-gradient(to bottom right, transparent, white 90%),white;
  -webkit-background-clip: text;
  background-clip: text;
  text-transform: uppercase;
  transition: 1s ease-in;
}

.card-2:hover #h1-circle-ul-2 {
  opacity: 1;
  transition: 1s ease-in;
}

.card-2:hover #h1-circle-ul-1 {
  opacity: 0;
  transition: 500ms ease-in;
}
    </style>
     @include('navbar')
    </head>
    <body>
        <div class="card-2">
            <span id="card-2-h1">Welcome To CIMAS </span>
            <div class="h1-circle">
                 <ul id="h1-circle-ul-1">
                <li>Easer</li>
                <li>Cheaper</li>
                <li>World Wild</li>
                </ul>
                <ul id="h1-circle-ul-2">
                <li>Secrets</li>
                <li>Expensive</li>
                <li>World Wild</li>
                </ul>
            </div>
        </div>
    </body>
</html>
