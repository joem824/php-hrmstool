<section class="content-header">
	<h1>Logs</h1>

	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="#"><i class="fa fa-clock-o"></i>Logs</a></li>
	    <li><a><i class="fa fa-check-circle-o"></i>Disputes</a></li>
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
			<div class="row" style="margin-top: 1%;">
				<div class="col-xs-12">
					<div class="col-xs-1">
						<button id="btnSearch" type="button" class="btn btn-default btn-sm" style="width: 100%;"><i class="fa fa-search"></i>&nbsp;Search</button>
					</div>
				</div>
			</div>

			<div id="divRow" class="row" style="margin-top: 1%; display: none;">
				<div class="col-xs-1">
					<label>Schedule:</label>
				</div>
				<div class="col-xs-2">
					<button id="btnAddSched" type="button" class="btn btn-default btn-sm" data-id="sched" style="width: 100%;"><i class="fa fa-plus"></i>&nbsp;<span>Add Schedule</span></button>
				</div>
				<div class="col-xs-2">
					<button type="button" class="btn btn-default btn-sm btnDel" data-id="sched" style="width: 100%;"><i class="fa fa-trash"></i>&nbsp;<span>Delete Schedule</span></button>
				</div>
				<div class="col-xs-12" style="margin-top: 1%; margin-bottom: 1%;">
					<table id="tblSched" class="table" data-pagination="true" >
						<thead>
							<tr>
								<th data-field="SeriesID" data-formatter="cbSeriesId" data-halign="center"></th>
								<th data-field="SchedDate" data-sortable="true" data-halign="center">Schedule Date</th>
								<th data-field="SchedType" data-sortable="true" data-halign="center">Schedule Type</th>
								<th data-field="SchedIN" data-sortable="true" data-halign="center">Schedule In</th>
								<th data-field="SchedOUT" data-sortable="true" data-halign="center">Schedule Out</th>
								<th data-field="Break1" data-sortable="true" data-halign="center">Break 1</th>
								<th data-field="Lunch" data-sortable="true" data-halign="center">Lunch</th>
								<th data-field="Break2" data-sortable="true" data-halign="center">Break 2</th>
								<th data-field="UploadedBy" data-sortable="true" data-halign="center">Uploaded By</th>
								<th data-field="DateUploaded" data-sortable="true" data-halign="center">Date Uploaded</th>
								<th data-field="EditedBy" data-sortable="true" data-halign="center">Edit By</th>
								<th data-field="DateEdited" data-sortable="true" data-halign="center">Date Edited</th>
								<th data-field="SeriesID" data-formatter="actionSched" data-halign="center">Action</th>
							</tr>
						</thead>
						<tbody class="text-center"></tbody>
					</table>
				</div>
				<div class="col-xs-1">
					<label>Activity:</label>
				</div>
				<div class="col-xs-2">
					<button id="btnAddAct" type="button" class="btn btn-default btn-sm" data-id="act" style="width: 100%;"><i class="fa fa-plus"></i>&nbsp;<span>Add Activity</span></button>
				</div>
				<div class="col-xs-2">
					<button type="button" class="btn btn-default btn-sm btnDel" data-id="act" style="width: 100%;"><i class="fa fa-trash"></i>&nbsp;<span>Delete Activity</span></button>
				</div>
				<div class="col-xs-12" style="margin-top: 1%;">
					<table id="tblAct" class="table" data-pagination="true" >
						<thead>
							<tr>
								<th data-field="SeriesID" data-formatter="cbSeriesId" data-halign="center"></th>
								<th data-field="SchedDate" data-sortable="true" data-halign="center">Schedule Date</th>
								<th data-field="Start_Time" data-sortable="true" data-halign="center">Start Time</th>
								<th data-field="End_Time" data-sortable="true" data-halign="center">End Time</th>
								<th data-field="ReasonDesc" data-sortable="true" data-halign="center">Activity Tag</th>
								<th data-field="TotalTimeHour" data-sortable="true" data-halign="center">Total Hours</th>
								<th data-field="SeriesID" data-formatter="actionAct" data-halign="center">Action</th>
							</tr>
						</thead>
						<tbody class="text-center"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="modalAdd" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Add</h4>
			</div>
			<div class="modal-body">
				<label id="lblAddType" hidden></label>
				<div class="row">
					<div class="col-xs-12">
						<div id="divAddSched" class="col-xs-12" style="display: none;">
							<table id="tblAddSched" class="table">
								<thead>
									<tr>
										<th>Schedule Date</th>
										<th>Schedule IN</th>
										<th>Schedule OUT</th>
										<th>Schedule Type</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="text" class="form-control input-sm datepicker" />
										</td>
										<td>
											<input type="text" class="form-control input-sm datetimepicker" />
										</td>
										<td>
											<input type="text" class="form-control input-sm datetimepicker" />
										</td>
										<td>
											<select class="form-control input-sm">
												<option value="">--Select One Below--</option>
												<option value="IN">IN</option>
												<option value="RD">RD</option>
											</select>
										</td>
										<td style="display: none;">
											<button type="button" class="btn btn-link removeRow" onclick="removeRow(this)"><i class="fa fa-times"></i></button>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>
											<button id="btnAddRowSched" type="button" class="btn btn-link"><i class="fa fa-plus"></i>&nbsp; Add Row</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div id="divAddAct" class="col-xs-12" style="display: none;">
							<table id="tblAddAct" class="table">
								<thead>
									<tr>
										<th>Schedule Date</th>
										<th>Start Time</th>
										<th>End Time</th>
										<th>Reason</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="text" class="form-control input-sm datepicker" />
										</td>
										<td>
											<input type="text" class="form-control input-sm datetimepicker" />
										</td>
										<td>
											<input type="text" class="form-control input-sm datetimepicker" />
										</td>
										<td>
											<select class="form-control input-sm">
												<option value="" selected="selected">--Select One Below--</option>
												<option value="1">Log-in</option>
												<option value="2">Working</option>
												<option value="3">In-call</option>
												<option value="4">Off-the Phone Work</option>
												<option value="5">Meeting</option>
												<option value="6">Coaching</option>
												<option value="7">Training</option>
												<option value="8">System Issue</option>
												<option value="9">First Break</option>
												<option value="10">Lunch Break</option>
												<option value="11">Last Break</option>
												<option value="12">Clinic</option>
												<option value="13">Bio Break</option>
												<option value="14">Log-out</option>
												<option value="15">Idle</option>
												<option value="16">Forced Logout</option>
											</select>
										</td>
										<td style="display: none;">
											<button type="button" class="btn btn-link removeRow" onclick="removeRow(this)"><i class="fa fa-times"></i></button>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>
											<button id="btnAddRowAct" type="button" class="btn btn-link"><i class="fa fa-plus"></i>&nbsp; Add Row</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="col-xs-12 text-right">
						<button id="btnSaveSchedAct" type="button" class="btn btn-default btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modalReason" class="modal">
	<div class="modal-dialog" style="width: 30%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Reason</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<label id="lblType" hidden></label>
								<textarea id="taReason" class="form-control input-sm" style="resize: none;"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
				<button id="btnDelDispute" type="button" class="btn btn-primary">Save changes</button>
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
				<h4 class="modal-title">Edit <span id="sTitle"></span></h4>
				<label id="lblSeries" hidden></label>
			</div>
			<div class="modal-body">
				<div class="row">
					<div id="divSched" class="col-xs-6" style="display: none;">
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Schedule Date:</span>
								</div>
								<div class="col-xs-7">
									<input id="inSchedDate1" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Schedule In:</span>
								</div>
								<div class="col-xs-7">
									<input id="inSchedIn" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Schedule Out:</span>
								</div>
								<div class="col-xs-7">
									<input id="inSchedOut" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Break 1:</span>
								</div>
								<div class="col-xs-7">
									<input id="inBreak1" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Lunch:</span>
								</div>
								<div class="col-xs-7">
									<input id="inLunch" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Break 2:</span>
								</div>
								<div class="col-xs-7">
									<input id="inBreak2" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Schedule Type:</span>
								</div>
								<div class="col-xs-7">
									<input id="inSchedType" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
					</div>
					<div id="divAct" class="col-xs-6" style="display: none;">
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Schedule Date:</span>
								</div>
								<div class="col-xs-7">
									<input id="inSchedDate2" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Start Time:</span>
								</div>
								<div class="col-xs-7">
									<input id="inStart" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>End Time:</span>
								</div>
								<div class="col-xs-7">
									<input id="inEnd" type="text" class="form-control input-sm" />
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 1%;">
							<div class="col-xs-12">
								<div class="col-xs-4">
									<span>Activity Tag:</span>
								</div>
								<div class="col-xs-7">
									<input id="inTag" type="text" class="form-control input-sm" />
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
				<button id="btnUpdate" type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>