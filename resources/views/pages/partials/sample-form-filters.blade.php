	<!-- ==================== Row of Header(s) [Begin] ==================== -->
		<div class="col-la-2 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>Disbursement Date (not less than)</label>
				<div class="form-panel">
					<input type="text" name="filter_date" id="filter_date" placeholder="Date" class="input-panel" data-role="datepicker2" value="{{ isset($filter_date) ? $filter_date : ''}}" readonly="true" autocomplete="off" />
					@if( isset($filter_date) && strpos($pageName, '/book-debt-screen') !== FALSE)
						<i class="filter_date_clearable__clear_new fas fa-times-circle tooltip top-center" data-tooltip="Clear" style="top: 0px; position: absolute; right: 21px; padding: 10px 7px; font-size: 1.5em; user-select: none; cursor: pointer; height: 3.7rem"></i>
					@else
						<span class="error-message"></span>
					@endif
				</div>
			</div>
		</div>
		<div class="col-la-2 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>Security of POS Percentage *</label>
				<div class="form-panel">
					<input type="text" name="filter_percent_pos" id="filter_percent_pos" placeholder="Percentage POS" class="input-panel" value="{{ $filter_percent_pos?? '' }}" autocomplete="off" />
					<span class="error-message"></span>
				</div>
			</div>
		</div>
		<div class="col-la-2 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>Term Loan Amount *</label>
				<div class="form-panel">
					<input type="text" name="filter_term_loan_amt" id="filter_term_loan_amt" placeholder="Term Loan Amount" class="input-panel" value="{{ $filter_term_loan_amt?? ''}}" autocomplete="off" />
					<span class="error-message"></span>
				</div>
			</div>
		</div>
		<div class="col-la-2 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>Term Loan End Date</label>
				<div class="form-panel">
					<input type="text" name="filter_term_loan_end_dt" id="filter_term_loan_end_dt" placeholder="Date" class="input-panel" data-role="datepicker2" value="{{ isset($filter_term_loan_end_dt) ? $filter_term_loan_end_dt : ''}}" readonly="true" autocomplete="off" />
					@if( isset($filter_term_loan_end_dt) && strpos($pageName, '/book-debt-screen') !== FALSE)
						<i class="filter_term_loan_end_dt_clearable__clear_new fas fa-times-circle tooltip top-center" data-tooltip="Clear" style="top: 0px; position: absolute; right: 21px; padding: 10px 7px; font-size: 1.5em; user-select: none; cursor: pointer; height: 3.7rem"></i>
					@else
						<span class="error-message"></span>
					@endif
				</div>
			</div>
		</div>
		<div class="col-la-2 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>Deal-ID Mapping </label>
				<div class="form-panel">
					<select name="filter_deal_code_mapping" id="filter_deal_code_mapping" class="input-panel chosen-select">
						<?= _getDealCodeMappingMasterDD() ?>												
					</select>
					<span class="error-message"></span>
				</div>
			</div>
		</div>
		<div class="col-la-2 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>Tag *</label>
				<div class="form-panel">
					<input type="text" name="filter_sec_deal_cde" id="filter_sec_deal_cde" placeholder="Sec Deal Code" class="input-panel" value="{{ $filter_sec_deal_cde?? '' }}" autocomplete="off" />
					<span class="error-message"></span>
				</div>
			</div>
		</div>
	<!-- ==================== Row of Header(s) [End] ==================== -->

	<div class="clearfix"></div>

	<!-- ################### Set of Filter(s) [Begin] ################### -->
		<!-- ==================== 2nd Row of Filter(s) [Begin] ==================== -->
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">DPD Days</label>
					<div class="form-panel">
						<input type="number" min="0" name="filter_dpd_days" id="filter_dpd_days" placeholder="DPD Days" class="input-panel" value="" autocomplete="off" />
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Occupation</label>
					<div class="form-panel">
						<select name="filter_occu[]" id="filter_occu" class="input-panel" multiple="multiple">
							<?= _getOccupationSubOccupationDD() ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Percentage</label>
					<div class="form-panel">
						<input type="number" min="0" step=".01" name="filter_occu_percent" id="filter_occu_percent" placeholder="Min. Portfolio Allocation" class="input-panel" value="" autocomplete="off" />
						<span class="error-message"></span>
					</div>
				</div>
			</div>
		<!-- ==================== 2nd Row of Filter(s) [End] ==================== -->

		<div class="clearfix"></div>

		<!-- ==================== 3rd Row of Filter(s) [Begin] ==================== -->
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Max. Loan Size</label>
					<div class="form-panel">
						<input type="text" name="filter_max_loan_size" id="filter_max_loan_size" placeholder="Max Loan Size" class="input-panel" value="" autocomplete="off" />
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">State(s)</label>
					<div class="form-panel">
						<select name="filter_states[]" id="filter_states" class="input-panel" multiple="multiple">
							<?= _getStatesDD() ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Customer Gender</label>
					<div class="form-panel">
						<select name="filter_cust_gender" id="filter_cust_gender" class="input-panel">
							<?= _getGenderDD() ?>
						</select>
					</div>
				</div>
			</div>
		<!-- ==================== 3rd Row of Filter(s) [End] ==================== -->

		<div class="clearfix"></div>

		<!-- ==================== 4th Row of Filter(s) [Begin] ==================== -->
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Interest Rate</label>
					<div class="form-panel">
						<input type="text" id="filter_int_rate" name="filter_int_rate" data-min-rate="{{ $int_rates['min-int-rate'] }}" data-max-rate="{{ $int_rates['max-int-rate'] }}" readonly style="border:0; color:#f6931f; font-weight:bold;" />
						<div id="slider-range"></div>
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Loan starting from</label>
					<div class="form-panel">
						<input type="text" name="filter_loan_start_from" id="filter_loan_start_from" placeholder="Date" class="input-panel dt-restricted" data-role="datepicker2" value="" readonly="true" autocomplete="off" />
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label>First EMI Date</label>
					<div class="form-panel">
						<input type="text" name="filter_first_emi_dt" id="filter_first_emi_dt" placeholder="First EMI Date" class="input-panel" data-role="datepicker2" value="{{ isset($filter_first_emi_dt) ? $filter_first_emi_dt : ''}}" readonly="true" autocomplete="off" />
						@if( isset($filter_first_emi_dt) && strpos($pageName, '/book-debt-screen') !== FALSE)
							<i class="filter_first_emi_dt_clearable__clear_new fas fa-times-circle tooltip top-center" data-tooltip="Clear" style="top: 0px; position: absolute; right: 21px; padding: 10px 7px; font-size: 1.5em; user-select: none; cursor: pointer; height: 3.7rem"></i>
						@else
							<span class="error-message"></span>
						@endif
					</div>
				</div>
			</div>
			<div class="col-la-2 col-me-3 col-sm-6">
				<div class="form-panel">
					<label for="app">Product(s)</label>
					<div class="form-panel">
						<select name="filter_product_types[]" id="filter_product_types" class="input-panel" multiple="multiple">
							<?= _getProductTypesDD() ?>
						</select>
					</div>
				</div>
			</div>
		<!-- ==================== 4th Row of Filter(s) [End] ==================== -->
	<!-- ################### Set of Filter(s) [End] ################### -->

	<div class="clearfix"></div>

	<!-- ~~~~~~~~~~~~~~~~~~~~~~ Set of Filter(s) Checkbox, Radio-Button etc [Begin] ~~~~~~~~~~~~~~~~~~~~~~ -->
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel">
				<label>&nbsp;</label>
				<div class="form-panel input-inline margin-top-es">
					<div class="checkbox">
						<input id="filter_exclude_inorganic_zone" name="filter_exclude_inorganic_zone" type="checkbox" style="display: inline-block;" value="y" />
						<label for="filter_exclude_inorganic_zone">Exclude Inorganic Zone</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel">
				<div class="form-panel input-inline">
					<div class="checkbox">
						<input id="filter_restructure_loan" name="filter_restructure_loan" type="checkbox" value="y" />
						<label for="filter_restructure_loan">Include Re-structure Loan</label>
					</div>
				</div>
			</div>
		</div>
		<!-- #################################### New Field(s) [Begin] #################################### -->
			<div class="col-la-12 col-me-3 col-sm-6">
				<div class="form-panel">
					<div class="form-panel input-inline">
						<div class="checkbox">
							<input id="filter_include_cross_sell_products" name="filter_include_cross_sell_products" type="checkbox" value="y" />
							<label for="filter_include_cross_sell_products">Include Cross-Sell Product(s)</label>
						</div>
					</div>
				</div>
			</div>
		<!-- #################################### New Field(s) [End] #################################### -->
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel radio-input">
			@foreach($jlg_grouping as $chkbox_val=>$label)
				<input id="filter_grouping" name="filter_grouping" type="radio" style="display: inline-block;" value="{{ $chkbox_val }}" @if ($chkbox_val==$default_jlg) checked @endif />
				<label for="app">{{ $label }}</label>
			@endforeach
			</div>
		</div>
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel radio-input">
			@foreach($asset_types as $chkbox_val=>$label)
				<input id="filter_asset" name="filter_asset" type="radio" style="display: inline-block;" value="{{ $chkbox_val }}" @if ($chkbox_val==$default_asset) checked @endif />
				<label for="app">{{ $label }}</label>
			@endforeach
			</div>
		</div>
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel radio-input">
			@foreach($area_types as $chkbox_val=>$label)
				<input id="filter_area_type" name="filter_area_type" type="radio" style="display: inline-block;" value="{{ $chkbox_val }}" @if ($chkbox_val==$default_area_type) checked @endif />
				<label for="app">{{ $label }}</label>
			@endforeach
			</div>
		</div>
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel">
				<div class="form-panel input-inline">
					<div class="checkbox">
						<input id="filter_cotrminus" name="filter_cotrminus" type="checkbox" value="y" />
						<label for="filter_cotrminus">Should be Coterminus with the loan</label>
					</div>
					<div id="msg_cotrminus" class="hide-div">
						<label>Loan can end upto</label> <input type="text" name="filter_residual_period" id="filter_residual_period" placeholder="90" class="input-control txtbox-sm" value="90" autocomplete="off" /> <label>days later of End date of term loan.</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel">
				<div class="form-panel input-inline">
					<div class="checkbox">
						<input id="filter_exclude_assam" name="filter_exclude_assam" type="checkbox" value="y" />
						<label for="filter_exclude_assam">Exclude Assam</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-6">
			<div class="form-panel">
				<label for="app">Single States not exceeding</label>
				<input type="text" name="filter_state_not_exceed_portfolio" id="filter_state_not_exceed_portfolio" placeholder="% portfolio" class="input-control txtbox-mid" value="" autocomplete="off" />
				<label for="app"> portfolio</label>
			</div>
		</div>
		<div class="col-la-12 col-me-3 col-sm-6">
			<div class="form-panel">
				<label for="app">Branch PAR </label>
					<input type="text" name="filter_branch_glp_par" id="filter_branch_glp_par" placeholder="Branch PAR" class="input-control txtbox-mid" value="" autocomplete="off" />
				<label for="app"> to GLP not exceeds more than </label>
					<input type="text" name="filter_branch_glp_par_percent" id="filter_branch_glp_par_percent" placeholder="%" class="input-control txtbox-sm" value="" autocomplete="off" />
				<label for="app"> %</label>
			</div>
		</div>
	<!-- ~~~~~~~~~~~~~~~~~~~~~~ Set of Filter(s) Checkbox, Radio-Button etc [End] ~~~~~~~~~~~~~~~~~~~~~~ -->

	<input type="hidden" name="hdn_prev_process_id" id="hdn_prev_process_id" value="" />

<div class="col-la-2 col-me-6 col-sm-6">
	<div class="form-panel">
		<label class="hidden-es">&nbsp;</label>
		<div class="clearfix"></div>
		<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i> Generate</button>
		<span class="error-message"></span>
		<button type="reset" id="btn_reset_search" name="btn_reset_search" class="button button-gray" ><i class="material-icons">not_interested</i> Reset</button>
	</div>
</div>
