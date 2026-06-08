<style>
  /* .card{ */
  /* padding:10px; */
  /* } */
</style>

<div class='card grafic-card'>
  <h3>{{$title}}</h3>
  <div class="data-container">
    <canvas id='{{$title}}'></canvas>
  </div>
</div>

<script>
  (() => {
    let info = @json($chartData);

    const data = {
      labels: info.labels,
      datasets: [{
        // label: 'Cantidad',
        data: info.data,
        backgroundColor: [
          "#A7C7E7", // Azul pastel
          "#F4A6A6", // Rosa suave
          "#B8E0B4", // Verde pastel
          "#F9D29D", // Durazno
          "#CDB4DB", // Lavanda
          "#FFD6A5", // Naranja pastel
          "#A8DADC", // Turquesa suave
          "#FFCAD4", // Rosa claro
          "#BDE0FE", // Celeste
          "#D8F3DC", // Menta
          "#D3D3D3" // Gris suave
        ],
        hoverOffset: 4
      }]
    };
    let ctx = document.getElementById('{{$title}}');
    new Chart(ctx, {
      type: 'doughnut',
      data
    });
  })();
</script>
