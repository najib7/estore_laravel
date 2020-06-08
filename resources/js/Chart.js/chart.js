window.addEventListener("load", function() {
   let chart;
   Chart.defaults.global.defaultFontFamily = '"Almarai", sans-serif'
   Chart.defaults.global.defaultFontSize = 14
   axios.get("/api/stats/chart").then(res => {
      // console.log(res.data);
      chart = res.data;

      createChart({
         id: 'chart-count',
         type: 'line',
         data: {
            labels: Object.keys(chart.purchases['count']),
            datasets: [
               {
                  label: lang('app.common.purchases'),
                  data: Object.values(chart.purchases['count']),
                  borderWidth: 1,
                  fill: false,
                  borderColor: '#0080ff',
                  borderWidth: 4,
                  lineTension: 0
               },
               {
                  label: lang('app.common.sales'),
                  data: Object.values(chart.sales['count']),
                  borderWidth: 1,
                  fill: false,
                  borderColor: '#f32f2f',
                  borderWidth: 4,
                  lineTension: 0
               }
            ]
         }
      })

      createChart({
         id: 'chart-profits',
         type: 'bar',
         data: {
            labels: Object.keys(chart.purchases['profits']),
            datasets: [
               {
                  label: lang('app.common.purchases'),
                  data: Object.values(chart.purchases['profits']),
                  borderWidth: 1,
                  fill: false,
                  backgroundColor: '#0080ff',
                  borderWidth: 4,
                  lineTension: 0
               },
               {
                  label: lang('app.common.sales'),
                  data: Object.values(chart.sales['profits']),
                  borderWidth: 1,
                  fill: false,
                  backgroundColor: '#f32f2f',
                  borderWidth: 4,
                  lineTension: 0
               }
            ]
         }
      })
   });

   function createChart(object) {
      var ctx = document.getElementById(object.id).getContext("2d");
      var myChart = new Chart(ctx, {
         type: object.type,
         data: object.data,
         options: {
            scales: {
               yAxes: [
                  {
                     ticks: {
                        beginAtZero: true
                     }
                  }
               ]
            }
         }
      });
   }
});
