<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


use Validator;

use App\User; // Model
use App\CustomModel; // MODEL

class HomeController extends SwiController
{
    public $months,$week,$crm_status, $empty_return, $from_date, $to_date, $from_fetch_date, $to_fetch_date, $days_range_dropdown, $days_range_order_trend_query, $days_range_order_trend_groupBy, $days_range_order_trend_date_type;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        #parent::__construct();
        $this->middleware('auth')->except('logout');
        $this->custom_model = new CustomModel();
        $this->months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');


        /***************** TABLE NAMES ************************/
        $this->tbl_customer         = config( 'app.CUSTOM_CONFIG.DB_TABLES.CUSTOMER_TABLE' );
        $this->tbl_states           = config( 'app.CUSTOM_CONFIG.DB_TABLES.STATES_TABLE' );
        $this->user                 = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

		$this->tableOfficeLocation		= config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
		$this->customer_transaction_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.CUSTOMER_TRANSACTIONS' );
		$this->nFeedback = config( 'app.CUSTOM_CONFIG.DB_TABLES.NEIGHBOUR_FEEDBACK' );
		$this->group_master_los = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_GROUP_LOS' );
		$this->group_members_los = config( 'app.CUSTOM_CONFIG.DB_TABLES.GROUP_MEMBERS_LOS' );
		$this->group_master   = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_GROUP' );
		$this->group_members   = config( 'app.CUSTOM_CONFIG.DB_TABLES.GROUP_MEMBERS' );
		$this->center_master   = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_CENTER' );
		$this->cgt1_cgt2 = config( 'app.CUSTOM_CONFIG.DB_TABLES.CGT1_CGT2' );
		$this->grt_details   = config( 'app.CUSTOM_CONFIG.DB_TABLES.GRT_DETAILS' );
		$this->luc_details   = config( 'app.CUSTOM_CONFIG.DB_TABLES.LUC_DETAILS' );

	   //$this->class_name   			= get_class_name( $this );
		$this->zone_access_role_arr 	= config( 'constants.DASHBOARD_ACCESS_ROLE.ZONE' );
		$this->region_access_role_arr	= config( 'constants.DASHBOARD_ACCESS_ROLE.REGION' );
		$this->branch_access_role_arr	= config( 'constants.DASHBOARD_ACCESS_ROLE.BRANCH' );

		$this->JLG_GROUPING_ARR = ['jlg' => 'JLG',
								   'indv' => 'Individual',
								   'both' => 'Both'];
		$this->JLG_GROUPING_PROCESS_ARR = ['jlg' => 'JLG',
										   'indv' => 'Individual',
										   'both' => ''];
		$this->ASSET_ARR = ['qualifying' => 'Qualifying Asset',
							'non_qualifying' => 'Non-Qualifying Asset',
							'' => 'None of them'];
		$this->AREA_TYPE_ARR = ['all' => 'All',
								'urban' => 'Urban',
								'semi_urban' => 'Semi Urban',
								'rural' => 'Rural'];

		//$this->EXCLUDE_OCCUPATIONS_ARR = _fetchExcludedPurposeList();

		$this->DEFAULT_JLG = 'both';
		$this->DEFAULT_ASSET = '';
		$this->DEFAULT_AREA_TYPE = 'all';
    }

    /*
     * Go to descire dahboard url by user role
     * **/
    public function goto_dashboard()
    {
        $t = '';
        if(session('status'))
        {
            $t = session('status');
            return redirect(url(get_role_wise_dachboard_url()))->with('success', $t);
        }
        else
            return redirect(url(get_role_wise_dachboard_url()))->with('success', $t);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        return view('home',$data);
    }

    /*
     * To Logout a user forcefully by this url
     */
    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }

    // CSM Dashboard
    public function dashboard(Request $request)
    {
		$user_type    = Auth::user()->s_role_key;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '0');
		$user_type 					= $request->session()->get('userType');
		$user_id 					= $request->session()->get('userId');
		$username 					= $request->session()->get('username');
		$data["zoneSearch"] 		= '';
		$data["regionSearch"] 		= '';
		$data["centerSearch"] 		= '';
		$data['search_header_name'] = "los_dashboard_".$this->class_name.'_search';
		$search_sql 				= '';
		$current_date				= date('Y-m-d');
		$print_mode 				= false;
		$user_access_type			= 'ALL';
		$zone_code_ = '';
		$user_type_text = '';
		$filter_search = '';

		#~~~~~~~~~~~~~~~~~~~~~~~~~ USER TYPE WISE ACCESS [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$zonal_office 		= [];
		$regional_office 	= [];
		$branch_office 		= [];
		$center_list 		= [];

		if( in_array( $user_type, $this->zone_access_role_arr ) )		  // ZONAL USER
		{
			$user_access_type 	= 'ZONE';
			$zone_codes 		= [];
			$office_details 	= getOfficeDetailsByUserID($user_id);

			if( !empty( $office_details ) )
			{
				$office_details_zone = '';
				if($office_details[0]->e_office_type == 'BRANCH' || $office_details[0]->e_office_type == 'BRANCH_INORG' || $office_details[0]->e_office_type == 'BRANCH_ICASH')
				{
					$office_details_region 	= getOfficeDetails($office_details[0]->i_parent_id);
					$region_parent_id = $office_details_region->i_parent_id;
					$office_details_zone 	= getOfficeDetails($region_parent_id);
				}
				else if($office_details[0]->e_office_type == 'REGIONAL')
				{
					$office_details_zone 	= getOfficeDetails($office_details[0]->i_parent_id);
				}
				if( $office_details_zone != '' )  // Regional Offices
				{
					$zone_codes[] = $office_details_zone->s_office_code;
				}
				else
				{
					foreach( $office_details As $offices )
					{
						$zone_codes[] = $offices->s_office_code;
					}
				}

				$zone_codes_text = implode('","',$zone_codes);

				$zonal_office 	= DB::table($this->tableOfficeLocation.' As ofc')
									->select('ofc.i_id','ofc.s_office_code','ofc.s_office_name')
									->where('ofc.i_is_active', 1)
									->whereRaw('ofc.s_office_code IN("'.$zone_codes_text.'")')
									->where('ofc.e_office_type', 'ZONAL')
									->orderBy('ofc.s_office_name', 'ASC')
									->get()
									->toArray();

				$search_sql .= ' AND zone.s_office_code IN( "'.$zone_codes_text.'" )';
				$zone_code_ = $zone_codes_text;
				$user_type_text = $zone_codes_text;
			}
		}
		elseif( in_array( $user_type, $this->region_access_role_arr ) )   // REGIONAL USER
		{
			$user_access_type 	= 'REGION';
			$region_codes		= [];
			$office_details 	= getOfficeDetailsByUserID($user_id);
			$office_details_region = '';
			if( !empty( $office_details ) )  // Regional Offices
			{
				if($office_details[0]->e_office_type == 'BRANCH' || $office_details[0]->e_office_type == 'BRANCH_INORG' || $office_details[0]->e_office_type == 'BRANCH_ICASH')
				{
					$office_details_region 	= getOfficeDetails($office_details[0]->i_parent_id);
				}

				if( $office_details_region != '' )  // Regional Offices
				{
					$region_codes[] = $office_details_region->s_office_code;
				}
				else
				{
					foreach( $office_details As $offices )
					{
						$region_codes[] = $offices->s_office_code;
					}
				}

				$region_codes_text = implode('","',$region_codes);

				$regional_office = DB::table($this->tableOfficeLocation.' as ofc')
										->select('ofc.s_office_code',DB::raw('CONCAT(ofc.s_office_name," (",ofc.s_office_code,")") As office_name'))
										->where('ofc.i_is_active', 1)
										->where('ofc.e_office_type', 'REGIONAL')
										->whereRaw('ofc.s_office_code="'.$region_codes_text.'"')
										->orderBy('office_name', 'ASC')
										->get()
										->toArray();


				$search_sql .= ' AND region.s_office_code IN ( "'.$region_codes_text.'" )';
				$user_type_text = $region_codes_text;
			}
		}
		elseif( in_array( $user_type, $this->branch_access_role_arr ) )   // BRANCH USER
		{
			$user_access_type 	= 'BRANCH';
			$branch_codes 		= [];
			$office_details 	= getOfficeDetailsByUserID($user_id);

			if( !empty( $office_details ) )  // Regional Offices
			{
				foreach( $office_details As $offices ){
					$branch_codes[] = $offices->s_office_code;
				}

				$branch_codes_text = implode('","',$branch_codes);

				$branch_office = DB::table($this->tableOfficeLocation.' as ofc')
										->select('ofc.s_office_code',DB::raw('CONCAT(ofc.s_office_name," (",ofc.s_office_code,")") As office_name'))
										->where('ofc.i_is_active', 1)
										->whereRaw('ofc.e_office_type LIKE "BRANCH%"')
										->whereIn('ofc.s_office_code', $branch_codes)
										->orderBy('office_name', 'ASC')
										->get()
										->toArray();

				$search_sql .= ' AND branch.s_office_code IN ( "'.$branch_codes_text.'" )';
				$user_type_text = $branch_codes_text;
			}
		}
		else
		{
			$zonal_office 	= DB::table($this->tableOfficeLocation.' As ofc')
								->select('ofc.i_id','ofc.s_office_code','ofc.s_office_name')
								->where('ofc.i_is_active', 1)
								->where('ofc.e_office_type', 'ZONAL')
								->orderBy('ofc.s_office_name', 'ASC')
								->get()
								->toArray();

		}

		$data['zonal_office']  		= $zonal_office;
		$data['regional_office']  	= $regional_office;
		$data['branch_office']  	= $branch_office;
		#~~~~~~~~~~~~~~~~~~~~~~~~~ USER TYPE WISE ACCESS [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#


		#~~~~~~~~~~~~~~~~~~~~~~~~~ SEARCH SECTION [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#

		$arr_session_data = Session::has( 'arr_search_session' )?Session::get( 'arr_search_session' ):[];

		if( isset( $arr_session_data['searching_name'] ) && $arr_session_data['searching_name'] != $data['search_header_name'] )
		{
			Session::forget( 'search_header_name' );
			$arr_session_data = array();
		}

		$filterStr = ' 1';

		if( isset( $_POST['h_search'] ) )
		{
			$s_search                        		= isset($request->h_search)?$request->h_search:'';
			$search_variable['zoneSearch'] 			= isset($request->zoneSearch)?$request->zoneSearch:'';
			$search_variable['regionSearched'] 		= isset($request->regionSearch)?$request->regionSearch:'';
			$search_variable['branchSearched'] 		= isset($request->branchSearch)?$request->branchSearch:'';
		}
		else
		{
			$s_search                        		= isset($arr_session_data["h_search"])?$arr_session_data["h_search"] : '';
			$search_variable['zoneSearch'] 			= isset($arr_session_data["zoneSearch"])?$arr_session_data["zoneSearch"]:'';
			$search_variable['regionSearched'] 		= isset($arr_session_data["regionSearched"])?$arr_session_data["regionSearched"]:'';
			$search_variable['branchSearched'] 		= isset($arr_session_data["branchSearched"])?$arr_session_data["branchSearched"]:'';

		}// regionSearched

		if( $s_search == $data['search_header_name'] )
		{
			$arr_session                   = array();
			$arr_session["searching_name"] = $data['search_header_name'];

			if(in_array( $user_type, $this->zone_access_role_arr ))
			{
				$search_variable["zoneSearch"] = $zone_codes;
			}
			if( $search_variable["zoneSearch"] != "" )
			{
					$search_sql .= ' AND zone.s_office_code IN ( '.$search_variable['zoneSearch'].' )';
			}
			if(in_array( $user_type, $this->region_access_role_arr ))
			{
				$search_variable["regionSearched"] = $region_codes;
			}
			if( $search_variable["regionSearched"] != "" )
			{
				$region_code 	= $search_variable['regionSearched'];
				if(is_array($region_code))
				{
					$region_code_str = "'".implode("','", $region_code)."'";
					$search_sql .= ' AND region.s_office_code IN ( '.$region_code_str.' )';
				}
			}

			if( $search_variable["branchSearched"] != "" )
			{
				$branch_codes 	= $search_variable['branchSearched'];
				if(is_array($branch_codes))
				{
					$branch_codes_str = "'".implode("','", $branch_codes)."'";
					$search_sql .= ' AND branch.s_office_code IN ( '.$branch_codes_str.' )';
				}
			}

			$arr_session["zoneSearch"] 			= $data["zoneSearch"] 			= $search_variable["zoneSearch"];
			$arr_session["regionSearched"] 		= $data["regionSearched"] 		= $search_variable["regionSearched"];
			$arr_session["branchSearched"] 		= $data["branchSearched"] 		= $search_variable["branchSearched"];
			$arr_session["h_search"]     		= $data["h_search"]     		= $s_search;

			Session::put( 'arr_search_session',$arr_session );
		}
		else
		{
			if(in_array( $user_type, $this->zone_access_role_arr ))
			{
				$search_variable["zoneSearch"] = $zone_code_;
			}
			$data["zoneSearch"] 		= $search_variable["zoneSearch"];
			if(in_array( $user_type, $this->region_access_role_arr ))
			{
				$search_variable["regionSearched"] = $region_codes;
			}
			if($search_variable["regionSearched"] != '')
			{
				$data["regionSearched"] = implode(',',$search_variable["regionSearched"]);
			}
			else
			{
				$data["regionSearched"] = $search_variable["regionSearched"];
			}
			if(in_array( $user_type, $this->branch_access_role_arr ))
			{
				$search_variable["branchSearched"] = $branch_codes;
			}
			if($search_variable["branchSearched"] != '')
			{
				$data["branchSearched"] = implode(',',$search_variable["branchSearched"]);
			}
			else
			{
				$data["branchSearched"] = $search_variable["branchSearched"];
			}
			$data["h_search"]     		= $s_search;

			Session::forget( 'arr_search_session' );
		}
		#~~~~~~~~~~~~~~~~~~~~~~~~~ SEARCH SECTION [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#

		$data['user_access_type']   = $user_access_type;
		$data['user_type_text']   = $user_type_text;
		$data['user_id'] 			= $user_id;
		$data['search_sql'] 		= $search_sql;
		//$data['data_count'] 		= count($data_count_arr);
		$data["zoneSearch"] 		= $search_variable["zoneSearch"];

		if($search_variable["regionSearched"] != ''){
			$data["regionSearched"] = implode(',',$search_variable["regionSearched"]);
		}else{
			$data["regionSearched"] = $search_variable["regionSearched"];
		}
		if($search_variable["branchSearched"] != ''){
			$data["branchSearched"] = implode(',',$search_variable["branchSearched"]);
		}else{
			$data["branchSearched"] = $search_variable["branchSearched"];
		}
		$view_page  = "manageDashboard.dashboard";
        return view('manageDashboard.dashboard')->with($data);
    }

    public function ajaxGetApplicationCountTatRoleWise(Request $request)
    {
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '0');
		$resultSetArr = array();
		$current_date = date('Y-m-d');
		$first_day_month = date('Y-m-01 00:00:00');
		$current_date_time_start = date('Y-m-d 00:00:00');
		$current_date_time_end = date('Y-m-d 23:59:59');
		$user_access_type = $request->post('user_access_type');
		$user_type_text = $request->post('user_type_text');
		$search_sql_filter = $request->post('search_sql');


		$total_applications = 0;
		$total_laf = 0;
		$total_neighbour_feedback = 0;
		$total_group_formation = 0;
		$total_cgt1 = 0;
		$total_cgt2 = 0;
		$total_cross_verification = 0;
		$total_grt = 0;
		$total_luc = 0;
		$total_incomplete_applications = 0;
		$total_send_to_hub = 0;
		$total_disbursed = 0;

		$all_application_amount = 0;
		$grt_amount = 0;
		$send_to_hub_amount = 0;
		$disbursment_amount = 0;

		$total_applications_tat = 0;
		$laf_tat = 0;
		$neighbour_feedback_tat = 0;
		$group_formation_tat = 0;
		$cgt1_tat = 0;
		$cgt2_tat = 0;
		$cross_verification_tat = 0;
		$grt_tat = 0;
		$luc_tat = 0;
		$incomplete_applications_tat = 0;
		$send_to_hub_tat = 0;
		$disbursment_tat = 0;

		$search_sql = '';

		if($user_access_type == 'ZONE')
		{
			$search_sql .= ' AND zone.s_office_code IN( "'.$user_type_text.'" )';
		}
		else if($user_access_type == 'REGION')
		{
			$search_sql .= ' AND region.s_office_code IN( "'.$user_type_text.'" )';
		}
		else if($user_access_type == 'BRANCH')
		{
			$search_sql .= ' AND branch.s_office_code IN( "'.$user_type_text.'" )';
		}

		$search_sql .= " AND ( (ct.dt_created_at >= '".($first_day_month)."') AND (ct.dt_created_at <= '".($current_date_time_end)."') )";

		$whereRaw = $search_sql.$search_sql_filter;

		$all_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_application, SUM(CASE
		WHEN ct.s_application_status = 'Send to Hub' OR ct.s_application_status = 'LUC' OR ct.s_application_status = 'Disbursed' THEN ct.d_sanctioned_loan_amount
		WHEN ct.s_application_status IS NULL AND ct.i_last_step_saved = 7 AND ct.i_grt_status = 1 THEN ct.d_sanctioned_loan_amount
		ELSE ct.s_loan_amount
		END) AS total_amount FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.s_application_status != 'Rejected' OR ct.s_application_status IS NULL)".$whereRaw."");
		if(!empty($all_applications_data_count))
		{
			$total_applications = $all_applications_data_count[0]->total_application;
			$all_application_amount = $all_applications_data_count[0]->total_amount;
			if($total_applications >0)
			{
				$total_applications = sprintf("%02d", $total_applications);
			}
			if($all_application_amount >0)
			{
				$all_application_amount = $all_application_amount;
			}
			else
			{
				$all_application_amount = '0.00';
			}
		}

		$laf_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_laf FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND ct.i_last_step_saved = 1".$whereRaw."");
		if(!empty($laf_applications_data_count))
		{
			$total_laf = $laf_applications_data_count[0]->total_laf;
			if($total_laf >0)
			{
				$total_laf = sprintf("%02d", $total_laf);
			}
		}

		$neighbour_feedback_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_neighbour_feedback FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND ct.i_last_step_saved = 2 AND ct.s_application_status IS NULL".$whereRaw."");
		if(!empty($neighbour_feedback_applications_data_count))
		{
			$total_neighbour_feedback = $neighbour_feedback_applications_data_count[0]->total_neighbour_feedback;
			if($total_neighbour_feedback >0)
			{
				$total_neighbour_feedback = sprintf("%02d", $total_neighbour_feedback);
			}
		}

		$group_formation_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_group_formation FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND ct.i_last_step_saved = 3 AND ct.i_cgt1_status IS NULL AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw."");
		if(!empty($group_formation_applications_data_count))
		{
			$total_group_formation = $group_formation_applications_data_count[0]->total_group_formation;
			if($total_group_formation >0)
			{
				$total_group_formation = sprintf("%02d", $total_group_formation);
			}
		}

		$cgt1_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_cgt1 FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.i_last_step_saved = 4 OR (ct.i_last_step_saved = 3 AND ct.i_cgt1_status = 0)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw."");
		if(!empty($cgt1_applications_data_count))
		{
			$total_cgt1 = $cgt1_applications_data_count[0]->total_cgt1;
			if($total_cgt1 >0)
			{
				$total_cgt1 = sprintf("%02d", $total_cgt1);
			}
		}

		$cgt2_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_cgt2 FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.i_last_step_saved = 5 OR (ct.i_last_step_saved = 4 AND ct.i_cgt2_status = 0)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw."");
		if(!empty($cgt2_applications_data_count))
		{
			$total_cgt2 = $cgt2_applications_data_count[0]->total_cgt2;
			if($total_cgt2 >0)
			{
				$total_cgt2 = sprintf("%02d", $total_cgt2);
			}
		}

		$cross_verification_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_cross_verification FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.i_last_step_saved = 6 OR (ct.i_last_step_saved = 5 AND ct.i_cross_verification_status = 2)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw."");
		if(!empty($cross_verification_applications_data_count))
		{
			$total_cross_verification = $cross_verification_applications_data_count[0]->total_cross_verification;
			if($total_cross_verification >0)
			{
				$total_cross_verification = sprintf("%02d", $total_cross_verification);
			}
		}

		$grt_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_grt, SUM(CASE
		WHEN ct.s_application_status IS NULL AND ct.i_last_step_saved = 7 AND ct.i_grt_status = 1 THEN ct.d_sanctioned_loan_amount
		ELSE ct.s_loan_amount
		END) AS grt_amount FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.i_last_step_saved = 7 OR (ct.i_last_step_saved = 6 AND ct.i_grt_status = 0)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw."");
		if(!empty($grt_applications_data_count))
		{
			$grt_amount = $grt_applications_data_count[0]->grt_amount;
			$total_grt = $grt_applications_data_count[0]->total_grt;
			if($total_grt >0)
			{
				$total_grt = sprintf("%02d", $total_grt);
			}
			if($grt_amount >0)
			{
				$grt_amount = $grt_amount;
			}
			else
			{
				$grt_amount = '0.00';
			}
		}

		$disbursment_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_disbursed, SUM(ct.d_sanctioned_loan_amount) AS disbursment_amount FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.s_application_status = 'Disbursed' OR ct.s_application_status = 'LUC')".$whereRaw."");
		if(!empty($disbursment_applications_data_count))
		{
			$disbursment_amount = $disbursment_applications_data_count[0]->disbursment_amount;
			$total_disbursed = $disbursment_applications_data_count[0]->total_disbursed;
			if($total_disbursed >0)
			{
				$total_disbursed = sprintf("%02d", $total_disbursed);
			}
			if($disbursment_amount >0)
			{
				$disbursment_amount = $disbursment_amount;
			}
			else
			{
				$disbursment_amount = '0.00';
			}
		}

		$luc_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_luc FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND ct.s_application_status = 'LUC'".$whereRaw."");
		if(!empty($luc_applications_data_count))
		{
			$total_luc = $luc_applications_data_count[0]->total_luc;
			if($total_luc >0)
			{
				$total_luc = sprintf("%02d", $total_luc);
			}
		}

		$send_to_hub_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_send_to_hub, SUM(ct.d_sanctioned_loan_amount) AS send_to_hub_amount FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND ct.s_application_status = 'Send To Hub'".$whereRaw."");
		if(!empty($send_to_hub_applications_data_count))
		{
			$send_to_hub_amount = $send_to_hub_applications_data_count[0]->send_to_hub_amount;
			$total_send_to_hub = $send_to_hub_applications_data_count[0]->total_send_to_hub;
			if($total_send_to_hub >0)
			{
				$total_send_to_hub = sprintf("%02d", $total_send_to_hub);
			}
			if($send_to_hub_amount >0)
			{
				$send_to_hub_amount = $send_to_hub_amount;
			}
			else
			{
				$send_to_hub_amount = '0.00';
			}
		}

		$incomplete_applications_data_count = DB::select("SELECT COUNT(ct.i_id) as total_incomplete_applications FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active=1 AND (ct.i_last_step_saved IS NULL OR ct.i_last_step_saved = '')".$whereRaw."");
		if(!empty($incomplete_applications_data_count))
		{
			$total_incomplete_applications = $incomplete_applications_data_count[0]->total_incomplete_applications;
			if($total_incomplete_applications >0)
			{
				$total_incomplete_applications = sprintf("%02d", $total_incomplete_applications);
			}
		}

		$neighbour_feedback_data_tat = DB::select("SELECT AVG(total_hr) AS neighbour_feedback_tat FROM (SELECT (time_to_sec(timediff(nf.dt_created_at, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->nFeedback." AS nf ON ct.s_transaction_id = nf.s_transaction_id INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND ct.i_last_step_saved = 2 AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw." GROUP BY nf.s_transaction_id) AS all_data");
		if(!empty($neighbour_feedback_data_tat))
		{
			$neighbour_feedback_tat = $neighbour_feedback_data_tat[0]->neighbour_feedback_tat;
			if($neighbour_feedback_tat >0)
			{
				$neighbour_feedback_tat = round($neighbour_feedback_tat/24).' Day(s)';
			}
			else
			{
				$neighbour_feedback_tat = '-';
			}
		}
		else
		{
			$neighbour_feedback_tat = '-';
		}

		$cgt1_data_tat = DB::select("SELECT AVG(total_hr) AS cgt1_tat FROM (SELECT (time_to_sec(timediff(nf.dt_created_at, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->cgt1_cgt2." AS nf ON ct.s_transaction_id = nf.s_transaction_id AND nf.s_cgt_type = 'cgt1' INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND (ct.i_last_step_saved = 4 OR (ct.i_last_step_saved = 3 AND ct.i_cgt1_status = 0)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw." GROUP BY nf.s_transaction_id) AS all_data");
		if(!empty($cgt1_data_tat))
		{
			$cgt1_tat = $cgt1_data_tat[0]->cgt1_tat;
			if($cgt1_tat >0)
			{
				$cgt1_tat = round($cgt1_tat/24).' Day(s)';
			}
			else
			{
				$cgt1_tat = '-';
			}
		}
		else
		{
			$cgt1_tat = '-';
		}

		$cgt2_data_tat = DB::select("SELECT AVG(total_hr) AS cgt2_tat FROM (SELECT (time_to_sec(timediff(nf.dt_created_at, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->cgt1_cgt2." AS nf ON ct.s_transaction_id = nf.s_transaction_id AND nf.s_cgt_type = 'cgt2' INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND (ct.i_last_step_saved = 5 OR (ct.i_last_step_saved = 4 AND ct.i_cgt2_status = 0)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw." GROUP BY nf.s_transaction_id) AS all_data");
		if(!empty($cgt2_data_tat))
		{
			$cgt2_tat = $cgt2_data_tat[0]->cgt2_tat;
			if($cgt2_tat >0)
			{
				$cgt2_tat = round($cgt2_tat/24).' Day(s)';
			}
			else
			{
				$cgt2_tat = '-';
			}
		}
		else
		{
			$cgt2_tat = '-';
		}

		$group_formation_data_tat = DB::select("SELECT AVG(total_hr) AS group_formation_tat FROM (SELECT (time_to_sec(timediff(nf.dt_created_at, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->group_master_los." AS nf ON ct.s_group_code = nf.s_los_group_code AND nf.i_is_active = 1 INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND ct.i_last_step_saved = 3 AND ct.i_cgt1_status IS NULL AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw." GROUP BY nf.s_transaction_id) AS all_data");
		if(!empty($group_formation_data_tat))
		{
			$group_formation_tat = $group_formation_data_tat[0]->group_formation_tat;
			if($group_formation_tat >0)
			{
				$group_formation_tat = round($group_formation_tat/24).' Day(s)';
			}
			else
			{
				$group_formation_tat = '-';
			}
		}
		else
		{
			$group_formation_tat = '-';
		}

		$grt_data_tat = DB::select("SELECT AVG(total_hr) AS grt_tat FROM (SELECT (time_to_sec(timediff(nf.dt_created_at, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->grt_details." AS nf ON ct.s_transaction_id = nf.s_transaction_id INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND (ct.i_last_step_saved = 7 OR (ct.i_last_step_saved = 6 AND ct.i_grt_status = 0)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw." GROUP BY nf.s_transaction_id) AS all_data");
		if(!empty($grt_data_tat))
		{
			$grt_tat = $grt_data_tat[0]->grt_tat;
			if($grt_tat >0)
			{
				$grt_tat = round($grt_tat/24).' Day(s)';
			}
			else
			{
				$grt_tat = '-';
			}
		}
		else
		{
			$grt_tat = '-';
		}

		$cross_verification_data_tat = DB::select("SELECT AVG(total_hr) AS cross_verification_tat FROM (SELECT (time_to_sec(timediff(ct.dt_cross_verification, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND (ct.i_last_step_saved = 6 OR (ct.i_last_step_saved = 5 AND ct.i_cross_verification_status = 2)) AND (ct.s_application_status IS NULL OR ct.s_application_status = '')".$whereRaw.") AS all_data");
		if(!empty($cross_verification_data_tat))
		{
			$cross_verification_tat = $cross_verification_data_tat[0]->cross_verification_tat;
			if($cross_verification_tat >0)
			{
				$cross_verification_tat = round($cross_verification_tat/24).' Day(s)';
			}
			else
			{
				$cross_verification_tat = '-';
			}
		}
		else
		{
			$cross_verification_tat = '-';
		}

		$disbursment_data_tat = DB::select("SELECT AVG(total_hr) AS disbursment_tat FROM (SELECT (time_to_sec(timediff(ct.dt_disbursement_date, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND (ct.s_application_status = 'Disbursed' OR ct.s_application_status = 'LUC')".$whereRaw.") AS all_data");
		if(!empty($disbursment_data_tat))
		{
			$disbursment_tat = $disbursment_data_tat[0]->disbursment_tat;
			if($disbursment_tat >0)
			{
				$disbursment_tat = round($disbursment_tat/24).' Day(s)';
			}
			else
			{
				$disbursment_tat = '-';
			}
		}
		else
		{
			$disbursment_tat = '-';
		}

		$send_to_hub_data_tat = DB::select("SELECT AVG(total_hr) AS send_to_hub_tat FROM (SELECT (time_to_sec(timediff(ct.dt_status_change, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND ct.s_application_status = 'Send To Hub'".$whereRaw.") AS all_data");
		if(!empty($send_to_hub_data_tat))
		{
			$send_to_hub_tat = $send_to_hub_data_tat[0]->send_to_hub_tat;
			if($send_to_hub_tat >0)
			{
				$send_to_hub_tat = round($send_to_hub_tat/24).' Day(s)';
			}
			else
			{
				$send_to_hub_tat = '-';
			}
		}
		else
		{
			$disbursment_tat = '-';
		}

		$luc_data_tat = DB::select("SELECT AVG(total_hr) AS luc_tat FROM (SELECT (time_to_sec(timediff(nf.dt_created_at, ct.dt_created_at )) / 3600) AS total_hr, ct.dt_created_at, ct.s_transaction_id FROM ".$this->customer_transaction_table." AS ct INNER JOIN ".$this->luc_details." AS nf ON ct.s_group_code = nf.s_group_code INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = ct.s_branch_code INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id WHERE ct.i_is_active = 1 AND ct.s_application_status = 'LUC'".$whereRaw.") AS all_data");
		if(!empty($luc_data_tat))
		{
			$luc_tat = $luc_data_tat[0]->luc_tat;
			if($luc_tat >0)
			{
				$luc_tat = round($luc_tat/24).' Day(s)';
			}
			else
			{
				$luc_tat = '-';
			}
		}
		else
		{
			$luc_tat = '-';
		}

		$ret['total_applications'] = $total_applications;
		$ret['total_laf'] = $total_laf;
		$ret['total_neighbour_feedback'] = $total_neighbour_feedback;
		$ret['total_group_formation'] = $total_group_formation;
		$ret['total_cgt1'] = $total_cgt1;
		$ret['total_cgt2'] = $total_cgt2;
		$ret['total_cross_verification'] = $total_cross_verification;
		$ret['total_grt'] = $total_grt;
		$ret['total_disbursed'] = $total_disbursed;
		$ret['total_send_to_hub'] = $total_send_to_hub;
		$ret['total_luc'] = $total_luc;
		$ret['total_incomplete_applications'] = $total_incomplete_applications;

		$ret['neighbour_feedback_tat'] = $neighbour_feedback_tat;
		$ret['cgt1_tat'] = $cgt1_tat;
		$ret['cgt2_tat'] = $cgt2_tat;
		$ret['grt_tat'] = $grt_tat;
		$ret['group_formation_tat'] = $group_formation_tat;
		$ret['cross_verification_tat'] = $cross_verification_tat;
		$ret['luc_tat'] = $luc_tat;
		$ret['disbursment_tat'] = $disbursment_tat;
		$ret['send_to_hub_tat'] = $send_to_hub_tat;

		$ret['all_application_amount'] = number_format($all_application_amount, 2, '.', '');
		$ret['grt_amount'] = number_format($grt_amount, 2, '.', '');
		$ret['send_to_hub_amount'] = number_format($send_to_hub_amount, 2, '.', '');
		$ret['disbursment_amount'] = number_format($disbursment_amount, 2, '.', '');

		echo json_encode($ret);
		exit;
	}

    // My Profile: Change logged in user's basic profile details
    public function myProfile()
    {
        $id         = Auth::user()->i_user_id;
        //$user_type  = Auth::user()->s_role_key;

        #if( $id > 0  && $user_type )
        if( $id > 0   )
        {
            $data = array('heading' => 'Edit Information', 'mode' => 'Edit', 'id'=> $id);

            /*if( $user_type != 'customer' )
            {*/
                $user       = User::find($id);
                $view_page  = 'User.my_profile';
            /*}
            else
            {
                $user  =  DB::table($this->tbl_customer)
                            ->select($this->tbl_customer.'.*',
                                     DB::raw('CONCAT('.$this->tbl_customer.'.s_first_name," ",'.$this->tbl_customer.'.s_last_name) As s_contact_person'))
                            ->where('i_id', $id)
                            ->get();

                if( !empty( $user ) )
                {
                    $user = $user[0];
                    $view_page  = 'User.my_profile_customer';
                }
                else
                {
                    return redirect('dashboard')->with('error', get_msg_body_by_id('generalErrorMsg'));
                }
            }*/

            //ECHO "<PRE>";
            //print_r($user); exit;

            return view($view_page, compact('user'))->with($data);
        }
        else
        {
            return redirect('dashboard')->with('error', get_msg_body_by_id('generalErrorMsg'));
        }

    }

    public function saveMyProfile( Request $request )
    {
        $user_id    = Auth::user()->i_user_id;
        #$user_type  = Auth::user()->s_role_key;

        if( $user_id > 0   )
        {

                $user = User::find( $user_id );
                 // Validate user data
                // $validator = $this->validate( request(), [
                //     's_first_name'      => 'required',
                //     's_last_name'       => 'required',
                //     's_phone_number'    => 'required'
                // ]);

                $validator = Validator::make($request->all(), [
                's_first_name'        => 'required',
                's_phone_number'      => 'required'
                ])->setAttributeNames([
                                        's_first_name'      =>'First Name',
                                        's_phone_number'    =>'Phone'
                                    ]);

                if( $validator->fails( ) )
                {
                    return redirect('my-profile')->withErrors($validator)->withInput();
                }
                else
                {
                    $user->s_first_name = $request->post( 's_first_name' );
                    $user->s_phone_no   = $request->post( 's_phone_number' );

                    // Save the user information into the database
                    $user->save();

                    $currentRole = explode('|', $request->post('currentRole'));

                    $currentRoleKey = $currentRole[0];
                    $currentRoleId = $currentRole[1];
                    $currentRoleName = $currentRole[2];

                    Session::put('userType', $currentRoleKey);
                    Session::put('roleId', $currentRoleId);
                    Session::put('lastRoleSavedKey', $currentRoleKey);
                    Session::put('lastRoleSavedId', $currentRoleId);
                    Session::put('roleName', $currentRoleName);

                    $updtdata = DB::table($this->user)
                                    ->where('i_user_id', $user_id)
                                    ->update(
                                        ['i_last_login_role_id' => $currentRoleId,
                                        's_last_login_role_key' => $currentRoleKey,
                                        's_last_login_role_name' => $currentRoleName]
                                    );
                    return redirect( 'my-profile' )->with('success', get_msg_body_by_id( 'myProfileEditSuccess' ));
                }

        }
        else
            return redirect( 'my-profile' )->with( 'error', get_msg_body_by_id( 'myProfileEditError' ));

    }

    // Change Password: Change logged in user's password
    public function changePassword()
    {
        $user_id = Auth::user()->i_user_id;
        $data = array('heading' => 'Change Password', 'mode' => 'Edit', 'i_user_id'=> $user_id);

        return view('User.change_password',$data);
    }

    public function saveChangePassword(Request $request)
    {
        $user_id = Auth::user()->i_user_id;
        if($user_id > 0)
        {
            $user = User::find($user_id);

            if (Hash::check($request->get('old_password'), $user->password)) // Old password and exsiting password are same
            {
                $this->validate($request, [
                    'old_password'          => 'required',
                    'password'              => 'required|min:6',
                    'password_confirmation' => 'required|same:password'
                ]);

                $user->password = Hash::make(Input::get('password'));
                $user->save();

                return redirect('change-pssword')->with('success', get_msg_body_by_id('changePasswordSuccess'));
            }
            else
            {
                return redirect('change-pssword')->with('error', get_msg_body_by_id('changePasswordError'));
            }
        }
        else
        {
            return redirect('change-pssword')->with('error', get_msg_body_by_id('myProfileEditError'));
        }
    }


    public function setMenu(Request $request){
        Session::put('menuClass', $request->post('menuClass'));

        echo Session::get('menuClass');
    }


	# =============================================================================================
	# 		Sample Form [Begin]
	# =============================================================================================

		public function _display_sample_form() {

			$data = ['jlg_grouping' 	=> $this->JLG_GROUPING_ARR,
					 'asset_types'  	=> $this->ASSET_ARR,
					 'area_types'		=> $this->AREA_TYPE_ARR,
					 'default_jlg'		=> $this->DEFAULT_JLG,
					 'default_asset'	=> $this->DEFAULT_ASSET,
					 'default_area_type' => $this->DEFAULT_AREA_TYPE];

			# NEW - fetching Interest-Rate(s) [Begin]
				$int_rates = _fetchMinMaxInterestRates();
				$data['int_rates'] = $int_rates;
			# NEW - fetching Interest-Rate(s) [End]

			return view('pages.swagatam.sample-form', $data);
		}

		public function _display_sample_CRUD() {
			$data = [];
			return view('pages.swagatam.sample-CRUD', $data);
		}

	# =============================================================================================
	# 		Sample Form [End]
	# =============================================================================================
}
