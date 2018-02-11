<script type="text/javascript">
	var rawDataTable = $('#survey_raw_data');

	$(document).ready(function(){
		createPieChart();
		createDataTable();
	});

	function createPieChart(){
		var pieChartOptions = {
			series: {
				pie: {
					show: true
				}
			},
			grid: {
				hoverable: true
			},
			tooltip: true,
			tooltipOpts: {
				content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
				shifts: {
					x: 20,
					y: 0
				},
				defaultTheme: false
			}
		};

		var sharpLineOptions = {
			responsive: true,
			legend: {
				display: false
			}
		};

		var barOptions = {
			responsive:true
		};

		$.ajax({
			url: "<?= @base_url('Dashboard/Surveys/getAnalyticsData'); ?>",
			type: "POST",
			data: []
		})
		.done(function(res){
			var pieChartData = res.data.gender_counts;
			var sharpLineData = res.data.monthly_curve_data;

			$('#gender_number_counter_male').text(res.data.gendernos.Male);
			$('#gender_number_counter_female').text(res.data.gendernos.Female);
			$('#gender_number_counter_other').text(res.data.gendernos.Other);

			$('#overall_average_age').text(res.data.overall_average);
			$('#median_age').text(res.data.median_age);
			$("#age_counter_male").text(res.data.average_ages.Male);
			$("#age_counter_female").text(res.data.average_ages.Female);
			$("#age_counter_other").text(res.data.average_ages.Other);

			$('#total_monthly_surveys').text(res.data.monthly_total);
			$("#month_counter_male").text(res.data.monthly_count.Male);
			$("#month_counter_female").text(res.data.monthly_count.Female);
			$("#month_counter_other").text(res.data.monthly_count.Other);

			var ctx = document.getElementById("monthlyCurve").getContext("2d");

			new Chart(ctx, {type: 'line', data: sharpLineData, options: sharpLineOptions});
			
			$.plot($("#flot-users-chart"), pieChartData, pieChartOptions);
		});
	}

	function createDataTable(){
		if (rawDataTable[0]) {
			var aoColumnDefs = [
			{
				"aTargets": [0, 1, 3, 4],
				"bSortable": false
			}];

			raw_data_table_options = {
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>rtp",
				aaSorting: [[5, 'desc']],
				buttons: [
					{extend: 'csv',title: 'Surveys Raw Data', className: 'btn-sm'},
					{extend: 'pdf', title: 'Surveys Raw Data', className: 'btn-sm'},
					{extend: 'print',className: 'btn-sm'}
				],
				"aoColumnDefs": aoColumnDefs,
				serverSide: true,
				processing: true,
				ajax: {
					url: "<?= @base_url('Dashboard/API/getSurveyRawData'); ?>",
					type: "POST",
					error: function(){
						console.log("There was an error pulling in your data");
					}
				}
			};

			var oTable = rawDataTable.DataTable(raw_data_table_options);
		}
	}
</script>