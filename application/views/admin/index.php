<div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary ">
      <!-- <h6 class="m-0 font-weight-bold text-danger">Bienvenido <?php echo $this->session->userdata('first_name'). ' '.$this->session->userdata('last_name'); ?>!</h6> -->
    </div>
    <div class="card-body">
      <p class="text-center h5 mb-4 text-primary text-uppercase">Total de prestamos por tipo de moneda</p>
      
      <canvas id="grafica"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Parse the data with JSON.parse(), and the data becomes a JavaScript object.
  var cData = JSON.parse('<?php echo $countLC; ?>');
 
  console.log("datos", cData);

  // Obtener una referencia al elemento canvas del DOM
  const ctx = document.getElementById('grafica');

  // Adjust the canvas height
  ctx.height =60; // Set the height to make the canvas shorter

  const data = {
    labels: cData.label, // Las etiquetas son las categorías del eje X
    datasets: [{
      label: "Total Prestamos",
      data: cData.data, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
      backgroundColor: [
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(255, 99, 132, 0.2)',
      ], // Color de fondo
      borderColor: [
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(255, 99, 132, 1)',
      ], // Color del borde
      borderWidth: 1 // Ancho del borde
    }]
  };

  const config = {
    type: 'bar', // Tipo de gráfica: line
    data: data,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: '',
        }
      },
      scales: {
        y: {
          beginAtZero: true // Comenzar el eje Y desde cero
        }
      }
    }

  
  };

  new Chart(ctx, config);
</script>



<div class="row">
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
            Numero clientes</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $qCts->cantidad ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
            Numero Prestamos</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $qLoans->cantidad ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-coins fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Numero cobranzas
            </div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $qPaids->cantidad ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
