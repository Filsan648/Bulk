<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Visite du stock</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @include('navbar')

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .search-container {
            flex: 1;
        }

        h2, h3 {
            color: #333;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 1.25rem;
            margin-top: 20px;
        }

        p {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.875rem;
            color: #333;
        }

        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="date"]:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
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
            padding: 12px 30px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            background-color: #357ab7;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Table styles */
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            background-color: white;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        table:hover {
            transform: scale(1.01);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a90e2;
            color: white;
            padding: 15px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-results {
            text-align: center;
            font-size: 0.9rem;
            color: #999;
            margin-top: 20px;
        }
        .img-searching{
            width: 500px;
            height: auto;
            object-fit: contain;
            margin-top: 20px;
        }

        select {
            width: 200px;
            padding: 10px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background-color: white;
            appearance: none; /* Supprime le style par défaut */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23495057' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 35px;
        }

        select:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
        }

        select:hover {
            border-color: #4a90e2;
        }
        /* From Uiverse.io by OliverZeros */
button {
  all: unset;
}

.button {
  position: relative;
  display: inline-flex;
  height: 3.5rem;
  align-items: center;
  border-radius: 9999px;
  padding-left: 2rem;
  padding-right: 2rem;
  font-family: Segoe UI;
  font-size: 1.2rem;
  font-weight: 640;
  color: #fafaf6;
  letter-spacing: -0.06em;
}

.button-item {
  background-color: transparent;
  color: #1d1d1f;
}

.button-item .button-bg {
  border-color: rgba(255, 208, 116);
  background-color: rgba(255, 208, 116);
}

.button-inner,
.button-inner-hover,
.button-inner-static {
  pointer-events: none;
  display: block;
}

.button-inner {
  position: relative;
}

.button-inner-hover {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  transform: translateY(70%);
}

.button-bg {
  overflow: hidden;
  border-radius: 2rem;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transform: scale(1);
  transition: transform 1.8s cubic-bezier(0.19, 1, 0.22, 1);
}

.button-bg,
.button-bg-layer,
.button-bg-layers {
  display: block;
}

.button-bg-layers {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  top: -60%;
  aspect-ratio: 1 / 1;
  width: max(200%, 10rem);
}

.button-bg-layer {
  border-radius: 9999px;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transform: scale(0);
}

.button-bg-layer.-purple {
  background-color: rgba(163, 116, 255);
}

.button-bg-layer.-turquoise {
  background-color: rgba(23, 241, 209);
}

.button-bg-layer.-yellow {
  --tw-bg-opacity: 1;
  background-color: rgba(255, 208, 116, var(--tw-bg-opacity));
}

.button:hover .button-inner-static {
  opacity: 0;
  transform: translateY(-70%);
  transition:
    transform 1.4s cubic-bezier(0.19, 1, 0.22, 1),
    opacity 0.3s linear;
}

.button:hover .button-inner-hover {
  opacity: 1;
  transform: translateY(0);
  transition:
    transform 1.4s cubic-bezier(0.19, 1, 0.22, 1),
    opacity 1.4s cubic-bezier(0.19, 1, 0.22, 1);
}

.button:hover .button-bg-layer {
  transition:
    transform 1.3s cubic-bezier(0.19, 1, 0.22, 1),
    opacity 0.3s linear;
}
.button:hover .button-bg-layer-1 {
  transform: scale(1);
}

.button:hover .button-bg-layer-2 {
  transition-delay: 0.1s;
  transform: scale(1);
}

.button:hover .button-bg-layer-3 {
  transition-delay: 0.2s;
  transform: scale(1);
}
</style>
</head>
<body>
    <main id="main-content">
<div>
<h1 class="text-xl text-center text-blue-700"> Choisir le stock par mois </h1>
<h1 class="text-sm text-center text-black/60"> Sélectionner le stock par mois </h1>
</div>
<form method="post" action="{{ route('montpost') }}" class="" enctype="multipart/form-data">
    @csrf
    <div class="form-section">
        <label for="mois">Mois</label>
        <select id="type" name="mois" required>
            <option value="">Sélectionner </option>

            @foreach ($pessagesmonths as $pessagesmonth)
           <option value="{{ $pessagesmonth }}">{{ $pessagesmonth }}</option>
            @endforeach
            <option value="ALL">ALL</option>
           </select>
           <div class="button-container">
            <!-- Bouton Annuler -->
            <button type="button" class="mr-20 border" onclick="document.querySelector('form').reset();">Annuler</button>

            <!-- Bouton Visiter -->
            <div class="button-container">
                <button class="button button-item">
                    <span class="button-bg">
                        <span class="button-bg-layers">
                            <span class="button-bg-layer button-bg-layer-1 -purple"></span>
                            <span class="button-bg-layer button-bg-layer-2 -turquoise"></span>
                            <span class="button-bg-layer button-bg-layer-3 -yellow"></span>
                        </span>
                    </span>
                    <span class="button-inner">
                        <span class="button-inner-static">Visiter</span>
                        <span class="button-inner-hover">Visiter</span>
                    </span>
                </button>
            </div>
        </div>

</form>
</main>
</body>