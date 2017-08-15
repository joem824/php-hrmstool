
<section class="content-header">
	<h1>Roster Update</h1>

	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a><i class="fa fa-user-plus"></i>Roster Update</a></li>
	</ol>
</section>

<section class="content">
	<div class="box box-default">
		<div class="box-body">
			<div class="col-xs-6">
				<div class="col-xs-2">
					<label>Select Users:</label>
					<button id="btnClear" type="button" class="btn btn-default btn-sm"><i class="fa fa-times-circle"></i>&nbsp;Clear All</button>
				</div>
				<div class="col-xs-9">
					<select id="slctUsers" class="form-control" multiple="multiple" style="width: 100%;"></select>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="col-xs-3">
					<label>Select Immediate Superior:</label>
				</div>
				<div class="col-xs-5">
					<select id="slctIS" class="form-control" style="width: 100%;"></select>
				</div>
			</div>
			<div class="col-xs-12" style="margin-top: 1%;">
				<table id="tblRoster">
					<thead>
						<tr>
							<th colspan="3">Employee Details</th>
							<th colspan="3">Reporting To</th>
							<th colspan="3">Transfer To</th>
						</tr>
						<tr>
							<th>EmpID</th>
							<th>NTID</th>
							<th>EmpName</th>
							<th>MngrID</th>
							<th>MngrNTID</th>
							<th>MngrName</th>
							<th>EmpID</th>
							<th>NTID</th>
							<th>EmpName</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="col-xs-12 text-right" style="margin-top: 1%;">
				<button id="btnApply" type="button" class="btn btn-default btn-sm" style="margin: 1%;"><i class="fa fa-check-circle"></i>&nbsp;Apply Changes</button>
			</div>
		</div>
	</div>
</section>

<div id="modalEdit" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Edit User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-6">
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Employee #:</span>
								</div>
								<div class="col-xs-7">
									<input id="inEmpNum" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Employee NTID:</span>
								</div>
								<div class="col-xs-7">
									<input id="inNTID" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Employee Name:</span>
								</div>
								<div class="col-xs-7">
									<input id="inEmpName" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Employee Level:</span>
								</div>
								<div class="col-xs-7">
									<input id="inEmpLevel" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Leave Balance (PTO):</span>
								</div>
								<div class="col-xs-7">
									<input id="inLeavePTO" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Leave Balance (CTO):</span>
								</div>
								<div class="col-xs-7">
									<input id="inLeaveCTO" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Job Description:</span>
								</div>
								<div class="col-xs-7">
									<input id="inJobDesc" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Department Code:</span>
								</div>
								<div class="col-xs-7">
									<input id="inDeptCode" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Department Name:</span>
								</div>
								<div class="col-xs-7">
									<input id="inDeptName" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Manager ID:</span>
								</div>
								<div class="col-xs-7">
									<input id="inMngrID" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Manager NTID:</span>
								</div>
								<div class="col-xs-7">
									<input id="inMngrNTID" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Manager Name:</span>
								</div>
								<div class="col-xs-7">
									<input id="inMngrName" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Business Unit:</span>
								</div>
								<div class="col-xs-7">
									<input id="inBU" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Business Unit Head:</span>
								</div>
								<div class="col-xs-7">
									<input id="inBUHead" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-2">
									<span>Remarks:</span><span style="color: red; font-weight: bold; font-size: medium;">*</span>
								</div>
								<div class="col-xs-10">
									<textarea id="taRemarks" class="form-control input-sm" style="resize: none; width: 50%; height: 100px;"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
				<button id="btnSave" type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>