
<section class="content-header">
	<h1>Users</h1>

	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a><i class="fa fa-users"></i>Users</a></li>
	</ol>
</section>

<section class="content">
	<div class="box box-default">
		<div class="box-body">
			<div id="toolbar">
				<button id="btnAdd" type="button" class="btn btn-link"><i class="fa fa-plus"></i>&nbsp;Add Users</button>
			</div>
			<table id="tblUsers" class="table" data-pagination="true" data-search="true" data-toolbar="#toolbar">
				<thead>
					<tr>
						<th data-field="AccessLevel" data-sortable="true">Access Level</th>
						<th data-field="EmpID" data-sortable="true">Employee #</th>
						<th data-field="NTID" data-sortable="true">NTID</th>
						<th data-field="EmpName" data-sortable="true">Employee Name</th>
						<th data-field="EmpLevel" data-sortable="true">Employee Level</th>
						<th data-field="LeaveBal" data-sortable="true">Leave Balance (PTO)</th>
						<th data-field="LeaveBalCTO" data-sortable="true">Leave Balance (CTO)</th>
						<th data-field="JobDesc" data-sortable="true">Job Description</th>
						<th data-field="DeptCode" data-sortable="true">Department Code</th>
						<th data-field="DeptName" data-sortable="true">Department Name</th>
						<th data-field="MngrID" data-sortable="true">Manager ID</th>
						<th data-field="MngrNTID" data-sortable="true">Manager NTID</th>
						<th data-field="MngrName" data-sortable="true">Manager Name</th>
						<th data-field="BusinessUnit" data-sortable="true">Business Unit</th>
						<th data-field="BusinessUnitHead" data-sortable="true">Business Unit Head</th>
						<th data-field="EmpID" data-formatter="action"></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</section>

<div id="modalAdd" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-6">
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Employee ID:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddEmpID" type="text" class="form-control input-sm" />
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>NTID:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddNTID" type="text" class="form-control input-sm" />
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Last Name:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddLN" type="text" class="form-control input-sm" />
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>First Name:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddFN" type="text" class="form-control input-sm" />
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Middle Name:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddMN" type="text" class="form-control input-sm" />
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Gender:</label>
							</div>
							<div class="col-xs-6">
								<select id="slctAddGender" class="form-control input-sm">
									<option value="">--Select One Below--</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Date Joined:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddDateJoined" type="text" class="form-control input-sm datepicker" />
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Employee Level:</label>
							</div>
							<div class="col-xs-6">
								<select id="slctAddEmpLvl" class="form-control input-sm">
									<option value="">--Select One Below--</option>
									<option value="EE">EE</option>
									<option value="TL">TL</option>
									<option value="AM">AM</option>
									<option value="MGR">MGR</option>
									<option value="SR. MGR">SR. MGR</option>
									<option value="DIR">DIR</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Job Description:</label>
							</div>
							<div class="col-xs-6">
								<input id="inAddJD" type="text" class="form-control input-sm" />
							</div>
						</div>
						<div class="col-xs-12" style="margin-top: 1%;">
							<div class="col-xs-5">
								<label>Immediate Superior:</label>
							</div>
							<div class="col-xs-6">
								<select id="slctAddIS" class="form-control input-sm"></select>
							</div>
						</div>
					</div>
					<div class="col-xs-12 text-center" style="margin-top: 1%;">
						<button id="btnAddUser" type="button" class="btn btn-default"><i class="fa fa-save"></i>&nbsp;Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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