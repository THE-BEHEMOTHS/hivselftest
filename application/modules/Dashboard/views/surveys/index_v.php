<div class="row">
	<div class="col-lg-4">
		<div class="hpanel stats">
			<div class="panel-body text-center h-200">
				<i class="pe-7s-display1 fa-4x"></i>
				<h1 class="m-xs"><span id = "total_monthly_surveys">100</span></h1>
				<h3 class="font-extra-bold no-margins text-success">Surveys</h3>
				<small>These are the number of surveys (<?= @date('F'); ?>)</small>
			</div>
			<div class="panel-footer text-center">
				<div class="row">
					<div class="col-xs-4">
						<span id = "month_counter_male">0</span> <br/>Male
					</div>
					<div class="col-xs-4">
						<span id = "month_counter_female">0</span> <br/>Female
					</div>
					<div class="col-xs-4">
						<span id = "month_counter_other">0</span> <br/>Not Specified
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="hpanel stats">
			<div class="panel-body h-200">
				<div class="stats-title pull-left">
					<h4>Gender Statistcs</h4>
				</div>
				<div class="stats-icon pull-right">
					<i class="pe-7s-users fa-4x"></i>
				</div>
				<div class="clearfix"></div>
				<div class="flot-chart">
					<div class="flot-chart-content" id="flot-users-chart" style="height: 112px"></div>
				</div>
			</div>
			<div class="panel-footer text-center">
				<div class="row">
					<div class="col-xs-4">
						<span id = "gender_number_counter_male">0</span> <br/>Male
					</div>
					<div class="col-xs-4">
						<span id = "gender_number_counter_female">0</span> <br/>Female
					</div>
					<div class="col-xs-4">
						<span id = "gender_number_counter_other">0</span> <br/>Not Specified
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="hpanel stats">
			<div class="panel-body text-center h-200">
				<i class="pe-7s-id fa-4x"></i>
				<h1 class="m-xs"><span id = "overall_average_age">25</span> Years</h1>
				<h3 class="font-extra-bold no-margins text-success">Average Age</h3>
				<small>The average age is calculated as per the surveys</small>
			</div>
			<div class="panel-footer text-center">
				<div class="row">
					<div class="col-xs-4">
						<span id = "age_counter_male">0</span> <br/>Male
					</div>
					<div class="col-xs-4">
						<span id = "age_counter_female">0</span> <br/>Female
					</div>
					<div class="col-xs-4">
						<span id = "age_counter_other">0</span> <br/>Not Specified
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="hpanel stats">
			<div class="panel-body text-center h-200">
				<i class="pe-7s-coffee fa-4x"></i>
				<h1 class="m-xs"><span id = "preferred_kit_no"><?= @$preferred_kit->number; ?></h1>
				<h3 class="font-extra-bold no-margins text-success" id = "preferred_kit_name"><?= @$preferred_kit->kit; ?></h3>
				<small>Most Preferred kit</small>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="hpanel stats">
			<div class="panel-body text-center h-200">
				<i class="pe-7s-id fa-4x"></i>
				<h1 class="m-xs"><span id = "median_age">25</span> Years</h1>
				<h3 class="font-extra-bold no-margins text-success">Median Age</h3>
				<small>The median age is calculated as per the surveys</small>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="hpanel">
			<div class="panel-heading">
				Age & Gender Kit Preferrence
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<th>Kit Name</th>
						<th>Oldest</th>
						<th>Youngest</th>
					</thead>
					<tbody>
						<?= @$table['age_kit_table']; ?>
					</tbody>
				</table>

				<table class="table table-bordered">
					<thead>
						<th>Kit Name</th>
						<?= @$gender_header; ?>
					</thead>
					<tbody>
						<?= @$table['gender_kit_table']; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="hpanel">
			<div class="panel-heading">
				Monthly Surveys Conducted By Users
			</div>
			<div class="panel-body">
				<div>
					<canvas id="monthlyCurve" height="140"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="row">
	<div class="col-lg-12"> -->
		<div class="hpanel hblue">
			<div class="panel-heading hbuilt">
				Raw Data
				<!-- <div class="pull-right">
					<a href="#">Export Excel</a>
				</div> -->
			</div>
			<div class="panel-body">
				<table class="table table-bordered" id = "survey_raw_data">
					<thead>
						<th style="width: 4%;">#</th>
						<th>Gender</th>
						<th>Age</th>
						<th>Kit(s)</th>
						<th style="width: 40%;">Comments</th>
						<th>Date Submitted</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
<!-- 	</div>
	
</div> -->