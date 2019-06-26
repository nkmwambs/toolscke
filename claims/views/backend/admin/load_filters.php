<table class="table" id="table_search">
					<thead>
						<tr>
							<th><?=get_phrase("search_by");?></th>
							<th><?=get_phrase("operator");?></th>
							<th><?=get_phrase("value");?></th>
							<th><?=get_phrase("action");?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select class="form-control" name="field[]" id="" onchange="return selected_option(this)">
									<option value=""><?=get_phrase('select');?></option>
									<option value="connect_incident_id"><?=get_phrase('connect_incident_id');?></option>
									<option value="claimCnt"><?=get_phrase('claim_count');?></option>
									<option value="proNo"><?=get_phrase('ke_no');?></option>
									<option value="cluster"><?=get_phrase('cluster');?></option>
									<option value="childNo"><?=get_phrase('child_number');?></option>
									<option value="childName"><?=get_phrase('child_name');?></option>
									<option value="date"><?=get_phrase('claim_date');?></option>
									<option value="treatDate"><?=get_phrase('treatment_date');?></option>
									<option value="reinstatementdate"><?=get_phrase('reinstatement_date');?></option>
									<option value="totAmt"><?=get_phrase('amount_incurred');?></option>
									<option value="careContr"><?=get_phrase('contribution');?></option>
									<option value="nhif"><?=get_phrase('N.H.I.F_number');?></option>
									<option value="amtReim"><?=get_phrase('amount_reimbursed');?></option>
									<option value="facName"><?=get_phrase('facility_name');?></option>
									<option value="facClass"><?=get_phrase('facility_type');?></option>
									<option value="vnum"><?=get_phrase('voucher_number');?></option>
									<option value="rmks"><?=get_phrase('status');?></option>

								</select>
							</td>
							<td>
								<select class="form-control" name="operator[]" id="">
									<option value=""><?=get_phrase('select');?></option>
									<option value="="><?=get_phrase('equals_to');?></option>
									<option value="<>"><?=get_phrase('not_equal_to');?></option>
									<option value="LIKE"><?=get_phrase('contains');?></option>
									<option value=">"><?=get_phrase('greater_than');?></option>
									<option value="<"><?=get_phrase('less_than');?></option>
									<option value=">="><?=get_phrase('greater_than_or_equal_to');?></option>
									<option value="<="><?=get_phrase('less_than_or_equal_to');?></option>
								</select>
							</td>
							<td class="val"><input type="text" class="form-control" name="val[]" id=""/></td>
							<td><div class="fa fa-plus" onclick="return add_filter();"></div>&nbsp;</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">
								<button type="submit" id="btn_search" class="btn btn-primary btn-icon"><i class="fa fa-search"></i><?=get_phrase('search');?></button>
								<div class="btn btn-red" id="reset"><?=get_phrase('reset');?></div>
							</td>
						</tr>
					</tfoot>
				</table>