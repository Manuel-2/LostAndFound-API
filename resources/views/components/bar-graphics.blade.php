<style>

</style>

<div class="card grafic-card">
  <h3>{{$title}}</h3>
  <div class="data-container" style="position: relative; width:{{$width}}px; height:{{$height}}px">
    <canvas id="{{$title}}"></canvas>
  </div>
</div>

<script>
  (() => {
    //TODO: cargar datos
    let ctx = document.getElementById('{{$title}}');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue'],
        datasets: [{
          label: '{{$title}}',
          data: [12, 19],
          borderWidth: 1
        }]
      },
      options: {
        aspectRatio: 0,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  })();
</script>
