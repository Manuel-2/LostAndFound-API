<style>

</style>

<div class="card grafic-card">
  <h3>{{$title}}</h3>
  <div class="data-container container-bar">
    <canvas id="{{$title}}"></canvas>
  </div>
</div>

<script>
  (() => {
    let ctx = document.getElementById('{{$title}}');
    let data = @json($chartData);
    let colors = data.data.map(val => (val > {{$indicator}}?'red':'#9ad0f5'));


    new Chart(ctx, {
      type: '{{$type}}',
      data: {
        labels: data.labels,
        datasets: [{
          label: '{{$title}}',
          data: data.data,
            backgroundColor: colors,
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
