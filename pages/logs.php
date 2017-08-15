<section class="content-header">
	<h1>Logs</h1>

	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="#"><i class="fa fa-clock-o"></i>Logs</a></li>
	    <li><a><i class="fa fa-search"></i>Search Logs</a></li>
	</ol>
</section>

<section class="content">
	<div class="box box-default">
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-2">
						<label>Search Employee:</label>
					</div>
					<div class="col-xs-5">
						<select id="slctSrchEmp" class="form-control input-sm">
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 1%;">
				<div class="col-xs-12">
					<div class="col-xs-2">
						<label>Date:</label>
					</div>
					<div class="col-xs-2">
						<input id="inDtFrom" type="text" class="form-control input-sm datepicker" />
					</div>
					<div class="col-xs-1 text-center">
						<label>to</label>
					</div>
					<div class="col-xs-2">
						<input id="inDtTo" type="text" class="form-control input-sm datepicker" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<button id="btnSearch" type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i>&nbsp;Search</button>
				</div>
			</div>

			<div class="row" style="margin-top: 1%;">
				<div class="col-xs-12">
					<table id="tblLogs" class="table" data-pagination="true" style="display: none;">
						<thead>
							<tr>
								<th data-field="EmpName" data-sortable="true">Employee Name</th>
								<th data-field="SchedDate" data-sortable="true">Schedule Date</th>
								<th data-field="SchedType" data-sortable="true">Schedule Type</th>
								<th data-field="SchedIn" data-sortable="true">Schedule In</th>
								<th data-field="SchedOut" data-sortable="true">Schedule Out</th>
								<th data-field="Start_Time" data-sortable="true">Start Time</th>
								<th data-field="End_Time" data-sortable="true">End Time</th>
								<th data-field="ReasonDesc" data-sortable="true">Activity Tag</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>