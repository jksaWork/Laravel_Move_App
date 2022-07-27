<div class="col-md-12">
    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <span>
                Movie In Year
            </span>
            <select id="moveChart" style="width: 30px">
                @for ($i = 0 ; $i < 5 ; $i++)
                <option value="{{now('Y')->subYears($i)->format('Y')}}">{{now()->subYears($i)->format('Y')}}</option>
                @endfor
            </select>
        </div>
        <canvas id="myChart" ></canvas>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.js" integrity="sha512-/MqITtqQfmjLnDtBC8yxrsERbn3dvqyxtc1B/3x57xp+J3srVBcgyr9VXgDj8BYScxSJ9MauIMY7F9Fr2TJHkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
let lables = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
let data = [12, 19, 3, 5, 2, 3];
getChart(lables, data);

function getChart(lables , data){
console.log(lables);
console.log(data);
console.log('jksa' ,  '-----------------------')
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:lables,
        datasets: [{
            label: '# of Votes',
            data:data ,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

window.myChart = myChart;

}


$(function(){
    HandelChartWithYears(2020);
    $('#moveChart').change(function(){
        HandelChartWithYears($(this).val());
    })
});

function HandelChartWithYears(year){
$.ajax({
                        url: 'http://localhost:8000/Chart?year=' + year,
                        method:'get',
                        success:function(res){
                            // alert(data);
                            console.log(res, 'data')
                            console.log(res.labels , 'lables')
                            console.log(res.data , 'data')
                            window.myChart?.destroy();
                            getChart(res.labels , res.data);
                        },
                        error:(err) => alert(err),
                    }
                );
}

</script>
