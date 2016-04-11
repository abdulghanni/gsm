'use strict';
var Index = function() {

	//CHART PO
	var chartPoHandler = function() {
		$.ajax({
            url : "/gsm/dashboard/get_chart/",
            type: "GET",
            dataType: "JSON",
            success: function(json)
            {
            	//alert(json);
				var data = {
					labels: json.tanggal,
					datasets: [{
						label: 'PO',
						fillColor: 'rgba(220,220,220,0.2)',
						strokeColor: 'rgba(220,220,220,1)',
						pointColor: 'rgba(220,220,220,1)',
						pointStrokeColor: '#fff',
						pointHighlightFill: '#fff',
						pointHighlightStroke: 'rgba(220,220,220,1)',
						data: json.num_data_po
					}, {
						label: 'Pembelian',
						fillColor: 'rgba(151,187,205,0.2)',
						strokeColor: 'rgba(151,187,205,1)',
						pointColor: 'rgba(151,187,205,1)',
						pointStrokeColor: '#fff',
						pointHighlightFill: '#fff',
						pointHighlightStroke: 'rgba(151,187,205,1)',
						data: json.num_data_pembelian
					}]
				};

				var options = {

					maintainAspectRatio: false,

					// Sets the chart to be responsive
					responsive: true,

					///Boolean - Whether grid lines are shown across the chart
					scaleShowGridLines: true,

					//String - Colour of the grid lines
					scaleGridLineColor: 'rgba(0,0,0,.05)',

					//Number - Width of the grid lines
					scaleGridLineWidth: 1,

					//Boolean - Whether the line is curved between points
					bezierCurve: false,

					//Number - Tension of the bezier curve between points
					bezierCurveTension: 0.4,

					//Boolean - Whether to show a dot for each point
					pointDot: true,

					//Number - Radius of each point dot in pixels
					pointDotRadius: 4,

					//Number - Pixel width of point dot stroke
					pointDotStrokeWidth: 1,

					//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
					pointHitDetectionRadius: 20,

					//Boolean - Whether to show a stroke for datasets
					datasetStroke: true,

					//Number - Pixel width of dataset stroke
					datasetStrokeWidth: 2,

					//Boolean - Whether to fill the dataset with a colour
					datasetFill: true,

					// Function - on animation progress
					onAnimationProgress: function() {
					},

					// Function - on animation complete
					onAnimationComplete: function() {
					},

					//String - A legend template
					legendTemplate: '<ul class="tc-chart-js-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].strokeColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
				};
				// Get context with jQuery - using jQuery's .get() method.
				var ctx = $("#chart1").get(0).getContext("2d");
				// This will get the first returned node in the jQuery collection.
				var chart1 = new Chart(ctx).Line(data, options);
				//generate the legend
				var legend = chart1.generateLegend();
				//and append it to your page somewhere
				$('#chartPoLegend').append(legend);
			}
		});
	};

	//CHART SO
	var chartSoHandler = function() {
		$.ajax({
            url : "/gsm/dashboard/get_chart/",
            type: "GET",
            dataType: "JSON",
            success: function(json)
            {
				var data = {
					labels: json.tanggal,
					datasets: [{
						label: 'SO',
						fillColor: 'rgba(220,220,220,0.2)',
						strokeColor: 'rgba(220,220,220,1)',
						pointColor: 'rgba(220,220,220,1)',
						pointStrokeColor: '#fff',
						pointHighlightFill: '#fff',
						pointHighlightStroke: 'rgba(220,220,220,1)',
						data: json.num_data_so
					}, {
						label: 'Penjualan',
						fillColor: 'rgba(151,187,205,0.2)',
						strokeColor: 'rgba(151,187,205,1)',
						pointColor: 'rgba(151,187,205,1)',
						pointStrokeColor: '#fff',
						pointHighlightFill: '#fff',
						pointHighlightStroke: 'rgba(151,187,205,1)',
						data: json.num_data_penjualan
					}]
				};

				var options = {

					maintainAspectRatio: false,

					// Sets the chart to be responsive
					responsive: true,

					///Boolean - Whether grid lines are shown across the chart
					scaleShowGridLines: true,

					//String - Colour of the grid lines
					scaleGridLineColor: 'rgba(0,0,0,.05)',

					//Number - Width of the grid lines
					scaleGridLineWidth: 1,

					//Boolean - Whether the line is curved between points
					bezierCurve: false,

					//Number - Tension of the bezier curve between points
					bezierCurveTension: 0.4,

					//Boolean - Whether to show a dot for each point
					pointDot: true,

					//Number - Radius of each point dot in pixels
					pointDotRadius: 4,

					//Number - Pixel width of point dot stroke
					pointDotStrokeWidth: 1,

					//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
					pointHitDetectionRadius: 20,

					//Boolean - Whether to show a stroke for datasets
					datasetStroke: true,

					//Number - Pixel width of dataset stroke
					datasetStrokeWidth: 2,

					//Boolean - Whether to fill the dataset with a colour
					datasetFill: true,

					// Function - on animation progress
					onAnimationProgress: function() {
					},

					// Function - on animation complete
					onAnimationComplete: function() {
					},

					//String - A legend template
					legendTemplate: '<ul class="tc-chart-js-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].strokeColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
				};
				// Get context with jQuery - using jQuery's .get() method.
				var ctx = $("#chart2").get(0).getContext("2d");
				// This will get the first returned node in the jQuery collection.
				var chart1 = new Chart(ctx).Line(data, options);
				//generate the legend
				var legend = chart1.generateLegend();
				//and append it to your page somewhere
				$('#chartSoLegend').append(legend);
			}
		});
	};

	//CHART2
	var chartUtHandler = function() {
		// Chart.js Data
		var data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec' ],
			datasets: [{
				label: 'Utang',
				fillColor: 'rgba(220,220,220,0.5)',
				strokeColor: 'rgba(220,220,220,0.8)',
				highlightFill: 'rgba(220,220,220,0.75)',
				highlightStroke: 'rgba(220,220,220,1)',
				data: [1000, 1500, 1200, 3000, 2500, 1000, 1500, 1200, 3000, 2500, 1555, 2220]
			}, {
				label: 'Piutang',
				fillColor: 'rgba(151,187,205,0.5)',
				strokeColor: 'rgba(151,187,205,0.8)',
				highlightFill: 'rgba(151,187,205,0.75)',
				highlightStroke: 'rgba(151,187,205,1)',
				data: [1200, 3000, 2500, 1555, 2220, 1000, 1500, 1200, 3000, 2500, 1000, 1500]
			}]
		};

		// Utang Piutang Options
		var options = {
			maintainAspectRatio: false,

			// Sets the chart to be responsive
			responsive: true,

			//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			scaleBeginAtZero: true,

			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,

			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",

			//Number - Width of the grid lines
			scaleGridLineWidth: 1,

			//Boolean - If there is a stroke on each bar
			barShowStroke: true,

			//Number - Pixel width of the bar stroke
			barStrokeWidth: 2,

			//Number - Spacing between each of the X value sets
			barValueSpacing: 5,

			//Number - Spacing between data sets within X values
			barDatasetSpacing: 1,

			//String - A legend template
			legendTemplate: '<ul class="tc-chart-js-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
		};
		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#chartUt").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var chart2 = new Chart(ctx).Bar(data, options);
		//generate the legend
		var legend = chart2.generateLegend();
		//and append it to your page somewhere
		$('#chartUtLegend').append(legend);
	};

	
	return {
		init: function() {
			chartPoHandler();
			chartSoHandler();
			chartUtHandler();
			//chart4Handler();
			//sparklineHandler();
		}
	};
}();
