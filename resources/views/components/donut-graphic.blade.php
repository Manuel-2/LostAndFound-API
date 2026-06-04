<style>
    #{{$title}}
    {
        width: 340px;
    }

    /* .card{ */
      /* padding:10px; */
    /* } */


</style>

<div class='card grafic-card'>
    <h3>{{$title}}</h3>
    <br>
    <canvas id='{{$title}}'></canvas>
</div>

<script>
    (() => {
        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
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
