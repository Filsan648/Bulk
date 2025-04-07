<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Chart</title>
    @include('navbar')
</head>

<style>
  .barchar-container{
    width: 80%;
    height: 90%;
    margin-left:50px;
  }
  h1{
    text-align: center;

  }
  h2{

    margin-left:50px;

  }
  .piechar-container{
    width: 50%;
    height: 50%;
    margin-top:50px;
    margin-left:50px;
  }
</style>
<body>
    <h1>
        Analyse mensuel des données
    </h1>
    <h2>
        Analyse des ventes mensuelles
    </h2>
    <div class="barchar-container">
        <canvas id="myChart"></canvas>
      </div>
      <h2>
        Nombre de voyages effectués par les chauffeurs
     </h2>
      <div class="piechar-container">
        <canvas id="pieChart"></canvas>
      </div>
      <div class="barchar-container">
        <canvas id="lineChart"></canvas>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        const ctx = document.getElementById('myChart');
        const pieChart = document.getElementById('pieChart');
        const lineChart = document.getElementById('lineChart');
        const data = @json($data);

        // Ensure data is an array
        const dataArray = Array.isArray(data) ? data : Object.values(data);

        // Extract unique months for labels
        const labels = [...new Set(dataArray.flatMap(client => client.map(entry => entry.Mois)))]; // Unique months

        // Create datasets for each client
        const datasets = Object.keys(data).map(clientName => {
            return {
                label: clientName,
                data: labels.map(month => {
                    const entry = data[clientName].find(e => e.Mois === month);
                    return entry ? entry.Poid : 0; // Use 0 if no data for that month
                }),

                borderWidth: 1
            };
        });

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels:@json($mont_bar),
            datasets: [{
              label: 'Sale',
              data:@json($pessage_bar),
              borderWidth: 1
            },]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
        new Chart(pieChart, {
          type: 'pie',
          data: {
            labels:@json($chauffeur),
            datasets: [{
              label: 'Sale',
              data:@json($countchauffeur),
              borderWidth: 1
            }]
          },

        });
        new Chart(lineChart, {
  type: 'line', // Keep the line type
  data: {
    labels: labels, // Months on the x-axis
    datasets: datasets.map(dataset => ({
      ...dataset, // Retain existing dataset properties
      tension: 0.4 // Adds a smooth curve to the line
    }))
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Poids net par client'
      },
    },
    interaction: {
      intersect: false,
    },
    suggestedMin: -10,
    suggestedMax: 200
  }
});

      </script>
</body>
</html>
