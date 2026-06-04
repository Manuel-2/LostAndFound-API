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
    let data = @json($chartData);
    let colors = data.data.map(val => (val > {{$indicator}}?'red':'#9ad0f5'));
    console.log({{$indicator}});
    console.log(data.data);
    console.log(colors);


    new Chart(ctx, {
      type: 'bar',
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
