<style>


    /* .card{ */
      /* padding:10px; */
    /* } */


</style>

<div class='card grafic-card'>
    <h3>{{$title}}</h3>
    <br>
  <div style="position: relative; width:500px; height:500px">
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
