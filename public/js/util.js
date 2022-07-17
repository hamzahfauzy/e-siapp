function appendToSelect(el, data, id, val, selected = false)
{
    // reset the select
    el.innerHTML = '<option>- Pilih -</option>'
    data.forEach(d => {
        el.innerHTML += '<option value="'+d[id]+'" '+(selected && selected == d[id] ? 'selected=""' : '')+'>'+d[val]+'</option>'
    })
}

function statisticsChart(labels, data)
{
	var ctx = document.getElementById('statisticsChart').getContext('2d');
	
	var statisticsChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: labels,
			datasets: [ {
				label: "Program Prioritas",
				borderColor: '#f3545d',
				pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
				pointRadius: 0,
				backgroundColor: 'rgba(243, 84, 93, 0.4)',
				legendColor: '#f3545d',
				fill: true,
				borderWidth: 2,
				data: data
			}]
		},
		options : {
			responsive: true, 
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			tooltips: {
				bodySpacing: 4,
				mode:"nearest",
				intersect: 0,
				position:"nearest",
				xPadding:10,
				yPadding:10,
				caretPadding:10
			},
			layout:{
				padding:{left:5,right:5,top:15,bottom:15}
			},
			scales: {
				yAxes: [{
					ticks: {
						fontStyle: "500",
						beginAtZero: false,
						maxTicksLimit: 5,
						padding: 10
					},
					gridLines: {
						drawTicks: false,
						display: false
					}
				}],
				xAxes: [{
					gridLines: {
						zeroLineColor: "transparent"
					},
					ticks: {
						padding: 10,
						fontStyle: "500"
					}
				}]
			}, 
			legendCallback: function(chart) { 
				var text = []; 
				text.push('<ul class="' + chart.id + '-legend html-legend">'); 
				for (var i = 0; i < chart.data.datasets.length; i++) { 
					text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
					if (chart.data.datasets[i].label) { 
						text.push(chart.data.datasets[i].label); 
					} 
					text.push('</li>'); 
				} 
				text.push('</ul>'); 
				return text.join(''); 
			}  
		}
	});
	
	var myLegendContainer = document.getElementById("myChartLegend");
	
	// generate HTML legend
	myLegendContainer.innerHTML = statisticsChart.generateLegend();
	
	// bind onClick event to all LI-tags of the legend
	var legendItems = myLegendContainer.getElementsByTagName('li');
	for (var i = 0; i < legendItems.length; i += 1) {
		legendItems[i].addEventListener("click", legendClickCallback, false);
	}
}