<template>
    <canvas id="my-chart" width="500" height="300"></canvas>
</template>

<script>

import axios from 'axios';
import Chart from 'chart.js';
import _ from 'lodash'; 

let dataset = [];

let dynamicBorderColors = () => {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b +  "," + 0.1 + ")";
}

let dynamicBgColors = () => {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b +  "," + 0.5 + ")";
}

export default {
  name: 'Chart',
  data () {
    return { articles: {}}
  },

  mounted()  {
   
		axios.get("http://localhost/chartDemo/src/GetHistory.php")
				.then((response) => {
          var jsonString = JSON.stringify(response);
          var jsonObject = JSON.parse(jsonString);
          this.articles = jsonObject;
         
          console.log(this.articles);

            for(let i = 0;i < this.articles.data.length;i++) {
            
              let av1 = parseFloat(this.articles.data[i].av1);
              let av2 = parseFloat(this.articles.data[i].av2);
              let av3 = parseFloat(this.articles.data[i].av3);
              let av4 = parseFloat(this.articles.data[i].av4);
              let av5 = parseFloat(this.articles.data[i].av5);
              
              dataset.push( {
                             label: '2018 Sales',
                             borderColor: dynamicBorderColors(),
                             backgroundColor: dynamicBgColors(),
                            data: [av1, av2, av3, av4, av5] 
                        })

            }
           
             let chart = new Chart(document.getElementById('my-chart'), {
                        type: 'line',
                        data: {
                          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],


                          // datasets: [
                          //   {
                          //     label: '2018 Sales',
                          //     borderColor: 'rgba(50, 115, 220, 0.5)',
                          //     backgroundColor: 'rgba(50, 115, 220, 0.1)',
                          //     data: [300, 700, 450, 750, 450]
                          //   },
                          //   {
                          //     label: '2017 Sales',
                          //     borderColor: 'rgba(255, 56, 96, 0.5)',
                          //     backgroundColor: 'rgba(255, 56, 96, 0.1)',
                          //     data: [600, 550, 750, 250, 700]
                          //   }
                          // ]
                          datasets:  dataset

                        },
                        options: {
                          scales: {
                            yAxes: [{
                              ticks: {
                                beginAtZero: true
                              }
                            }]
                          }
                        },
                          tooltips: {
                            callbacks: {
                              label(tooltipItem, data) {
                                // Get the dataset label.
                                const label = data.datasets[tooltipItem.datasetIndex].label;

                                // Format the y-axis value.
                                const value = numeral(tooltipItem.yLabel).format('$0,0');

                                return `${label}: ${value}`;
                              }
                            }
                          }
                      });
         
        }) // end of then
	}
}
</script>
