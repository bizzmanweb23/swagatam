<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use MPDF;
use Validator; 

use App\User; // Model
use App\Helper\message_helper;
use App\CustomModel; // MODEL
use PDF;


class ManageApplicationController extends Controller
{
    public function __construct()
    {
        //parent::__construct();
        //$this->middleware('auth')->except('logout');
		
		$this->customer_transaction_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.CUSTOMER_TRANSACTIONS' ); 
		$this->tableOfficeLocation		= config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
		$this->class_name   			= get_class_name( $this );
		$this->show_per_page            = config( 'constants.SHOW_PER_PAGE' ); 
		$this->nFeedback = config( 'app.CUSTOM_CONFIG.DB_TABLES.NEIGHBOUR_FEEDBACK' ); 
		$this->group_master_los = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_GROUP_LOS' );
		$this->group_members_los = config( 'app.CUSTOM_CONFIG.DB_TABLES.GROUP_MEMBERS_LOS' );
		$this->group_master   = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_GROUP' );
		$this->group_members   = config( 'app.CUSTOM_CONFIG.DB_TABLES.GROUP_MEMBERS' );		
		$this->center_master   = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_CENTER' );
		$this->cgt1_cgt2 = config( 'app.CUSTOM_CONFIG.DB_TABLES.CGT1_CGT2' );
		$this->grt_details   = config( 'app.CUSTOM_CONFIG.DB_TABLES.GRT_DETAILS' );
		$this->luc_details   = config( 'app.CUSTOM_CONFIG.DB_TABLES.LUC_DETAILS' );
		$this->cross_verification_audit_log = config( 'app.CUSTOM_CONFIG.DB_TABLES.CROSS_VERIFICATION_AUDIT_LOG' );
		$this->bank_details = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_BANK_MFI' ); 
		$this->master_states 	= config( 'app.CUSTOM_CONFIG.DB_TABLES.STATES_TABLE' );
        $this->master_districts 	= config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_DISTRICT' );		
		
		$this->branch_access_role_arr	= config( 'constants.REPORT_ACCESS_ROLE.BRANCH' );
		$this->zone_access_role_arr 	= config( 'constants.REPORT_ACCESS_ROLE.ZONE' );
		$this->region_access_role_arr	= config( 'constants.REPORT_ACCESS_ROLE.REGION' );

		$this->user = config('app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE');
		$this->userOffice = config('app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE');
		$this->userRole = config('app.CUSTOM_CONFIG.DB_TABLES.USER_ROLES');
    }  
    	
		
	public function showList( Request $request, $pageNo = 1, $sortColmn='', $type='' )
    {

    	$pageName = str_replace(env('APP_URL').'/', '/',\Request::url()); 

    	if(substr($pageName , -1) != '/'){
    	    $pageName = $pageName.'/';
    	}


		$user_type 					= $request->session()->get('userType');
		$user_id 					= $request->session()->get('userId');	
		$username 					= $request->session()->get('username');	
		
		if(strpos($pageName, '/disbursedApplications') !== FALSE){
			$data['heading'] 			= 'Disbursed Application(s)';
			$data['title'] 				= 'Disbursed Application(s)';
		}else if(strpos($pageName, '/rejectedApplications') !== FALSE){
			$data['heading'] 			= 'Rejected Application(s)';
			$data['title'] 				= 'Rejected Application(s)';
		}else if(strpos($pageName, '/rejectedBqhApplications') !== FALSE){
			$data['heading'] 			= 'BQH Rejected Application(s)';
			$data['title'] 				= 'BQH Rejected Application(s)';
		}else{
			$data['heading'] 			= 'Ongoing Application(s)';
			$data['title'] 				= 'Ongoing Application(s)';
		}
		
		$data["zoneSearch"] 		= '';		
		$data["regionSearch"] 		= '';	
		$data["centerSearch"] 		= '';		
		$data["arohan_center_name"] 		= '';		
		$data["arohan_customer_code"] 		= '';	
		$data["customer_name"] 		= '';
		$data["loanId"] 		= '';	
		$data["statusSearch"] 		= '';		
		$data['search_header_name'] = "los_manage_application".$this->class_name.'_search';
		$search_sql 				= '';		
		$current_date				= date('Y-m-d');
		$first_day_month = date('Y-m-01');
		$print_mode 				= false;		
		$data['pagination_url'] 	= 'manage-application';        
        $limit  					= $this->show_per_page;
		$user_access_type			= 'ALL';
		$zone_code_ = '';
        
		$pageNo = (intval($pageNo)) ? $pageNo : 1 ;
        $offset = (( $pageNo* $limit ) - $limit ); 
		$zonal_office 		= [];
		$regional_office 	= [];
		$branch_office 		= [];
		
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
										->whereRaw('ofc.s_office_code IN("'.$region_codes_text.'")')
										->orderBy('office_name', 'ASC')
										->get()
										->toArray();
			
				$search_sql .= ' AND region.s_office_code IN ( "'.$region_codes_text.'" )';
			}
		}
		elseif( in_array( $user_type, $this->branch_access_role_arr ) )
		{
			$branch_codes 		= [];			
			$office_details 	= getOfficeDetailsByUserID($user_id);  
			$user_access_type			= 'BRANCH';
			if( !empty( $office_details ) )  // Regional Offices
			{	
				foreach( $office_details As $offices ){
					$branch_codes[] = $offices->s_office_code;
				}
							
				$branch_codes_text = implode('","',$branch_codes);
													
				$search_sql .= ' AND dt.s_branch_code IN ( "'.$branch_codes_text.'" )';
				
				$branch_office = DB::table($this->tableOfficeLocation.' as ofc')
										->select('ofc.s_office_code',DB::raw('CONCAT(ofc.s_office_name," (",ofc.s_office_code,")") As office_name'))
										->where('ofc.i_is_active', 1)
										->whereRaw('ofc.e_office_type LIKE "BRANCH%"')
										->whereRaw('ofc.s_office_code="'.$branch_codes_text.'"')
										->orderBy('office_name', 'ASC')
										->get()
										->toArray();
			}
		}
		else if($user_type == 'csr')
		{
			$user_access_type	= 'CSR';
			$search_sql .= ' AND dt.s_collected_user_code = "'.$username.'"';
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
			$search_variable['forFromDateSearch'] 		= isset($request->forFromDateSearch)?$request->forFromDateSearch:''; 
			$search_variable['forToDateSearch'] 	= isset($request->forToDateSearch)?$request->forToDateSearch:''; 
			$search_variable['zoneSearch'] 			= $request->zoneSearch; 
			$search_variable['regionSearched'] 		= isset($request->regionSearch)?$request->regionSearch:''; 
			$search_variable['branchSearched'] 		= isset($request->branchSearch)?$request->branchSearch:'';
			$search_variable['arohan_center_name'] 		= isset($request->arohan_center_name)?$request->arohan_center_name:''; 
			$search_variable['arohan_customer_code'] 		= isset($request->arohan_customer_code)?$request->arohan_customer_code:''; 
			$search_variable['customer_name'] 		= isset($request->customer_name)?$request->customer_name:''; 
			$search_variable['loanId'] 		= isset($request->loanId)?$request->loanId:''; 
			$search_variable['statusSearch'] 		= isset($request->statusSearch)?$request->statusSearch:''; 
		}
		else
		{
			$s_search                        		= isset($arr_session_data["h_search"])?$arr_session_data["h_search"] : '';
			$search_variable['forFromDateSearch'] 		= isset($arr_session_data["forFromDateSearch"])?$arr_session_data["forFromDateSearch"]:'';
			$search_variable['forToDateSearch'] 	= isset($arr_session_data["forToDateSearch"])?$arr_session_data["forToDateSearch"]:'';
			$search_variable['zoneSearch'] 			= isset($arr_session_data["zoneSearch"])?$arr_session_data["zoneSearch"]:'';
			$search_variable['regionSearched'] 		= isset($arr_session_data["regionSearched"])?$arr_session_data["regionSearched"]:'';
			$search_variable['branchSearched'] 		= isset($arr_session_data["branchSearched"])?$arr_session_data["branchSearched"]:'';
			$search_variable['arohan_center_name'] 		= isset($arr_session_data["arohan_center_name"])?$arr_session_data["arohan_center_name"]:'';
			$search_variable['arohan_customer_code'] 		= isset($arr_session_data["arohan_customer_code"])?$arr_session_data["arohan_customer_code"]:'';
			$search_variable['customer_name'] 		= isset($arr_session_data["customer_name"])?$arr_session_data["customer_name"]:'';
			$search_variable['loanId'] 		= isset($arr_session_data["loanId"])?$arr_session_data["loanId"]:'';
			$search_variable['statusSearch'] 		= isset($arr_session_data["statusSearch"])?$arr_session_data["statusSearch"]:'';
		}// regionSearched
		
		if( $s_search == $data['search_header_name'] )
		{       
			$arr_session                   = array();
			$arr_session["searching_name"] = $data['search_header_name'];
			
			if( $search_variable['forFromDateSearch'] != '' && $search_variable['forToDateSearch'] != '' )
			{				
				$search_sql .= " AND( (dt.dt_created_at >= '".(date( 'Y-m-d 00:00:00', strtotime(site_date_to_db_date($search_variable['forFromDateSearch']))))."') AND (dt.dt_created_at <= '".(date( 'Y-m-d 23:59:59', strtotime(site_date_to_db_date($search_variable['forToDateSearch']))))."') )";
				
			}
			elseif( $search_variable['forFromDateSearch'] != '' )			
			{
				$search_sql .= " AND( dt.dt_created_at >= '".(date( 'Y-m-d 00:00:00', strtotime(site_date_to_db_date($search_variable['forFromDateSearch']))))."' )";
			}
			elseif( $search_variable['forToDateSearch'] != '' )			
			{
				$search_sql .= " AND( dt.dt_created_at <= '".(date('Y-m-d 23:59:59', strtotime(site_date_to_db_date($search_variable['forToDateSearch']))))."' ) ";
			}
			if( $search_variable["zoneSearch"] != "" )
			{
					$search_sql .= ' AND zone.s_office_code IN ( '.$search_variable['zoneSearch'].' )';
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
					$search_sql .= ' AND dt.s_branch_code IN ( '.$branch_codes_str.' )';
				}				
			}
			if( $search_variable["arohan_center_name"] != "" )
			{
				$arohan_center_name = $search_variable["arohan_center_name"];
				$search_sql .= ' AND dt.s_center_name LIKE "'.$arohan_center_name.'%"';				
			}
			if( $search_variable["arohan_customer_code"] != "" )
			{
				$arohan_customer_code = $search_variable["arohan_customer_code"];
				$search_sql .= ' AND dt.s_customer_id LIKE "'.$arohan_customer_code.'%"';				
			}
			if( $search_variable["customer_name"] != "" )
			{
				$customer_name = $search_variable["customer_name"];
				$search_sql .= ' AND dt.s_cb_customer_name LIKE "'.$customer_name.'%"';				
			}
			if( $search_variable["loanId"] != "" )
			{
				$loanId = $search_variable["loanId"];
				$search_sql .= ' AND dt.s_loan_id LIKE "'.$loanId.'%"';				
			}
			if( $search_variable["statusSearch"] != "" )
			{
				$statusSearch = $search_variable["statusSearch"];
				if($statusSearch == '99') //LAF Incomplete
				{
					$search_sql .= ' AND dt.i_current_step = 1 AND dt.i_last_step_saved IS NULL';	
				}else if($statusSearch == 44) //CGT 1 Failed
				{
					$search_sql .= ' AND dt.i_current_step = 4 AND dt.i_cgt1_status = 0';	
				}
				else if($statusSearch == 4) //CGT 1 Done
				{
					$search_sql .= ' AND dt.i_last_step_saved = 4 AND dt.i_cgt1_status = 1';	
				}
				else if($statusSearch == 55) //CGT 2 Failed
				{
					$search_sql .= ' AND dt.i_current_step = 5 AND dt.i_cgt2_status = 0';	
				}
				else if($statusSearch == 5) //CGT 2 Done
				{
					$search_sql .= ' AND dt.i_last_step_saved = 5 AND dt.i_cgt2_status = 1';	
				}
				else if($statusSearch == 66) //Cross Verification Failed
				{
					$search_sql .= ' AND dt.i_current_step = 6 AND dt.i_cross_verification_status = 2';	
				}
				else if($statusSearch == 6) //Cross Verification Done
				{
					$search_sql .= ' AND dt.i_last_step_saved = 6 AND dt.i_cross_verification_status = 1';	
				}
				else if($statusSearch == 77) //GRT Failed
				{
					$search_sql .= ' AND dt.i_current_step = 7 AND dt.i_grt_status = 0';	
				}
				else if($statusSearch == 7) //GRT Done
				{
					$search_sql .= ' AND dt.i_last_step_saved = 7 AND dt.i_grt_status = 1';	
				}
				else
				{
					$search_sql .= ' AND dt.i_last_step_saved = "'.$statusSearch.'"';	
				}					
			}

			$arr_session["forFromDateSearch"] 	= $data["forFromDateSearch"] 	= $search_variable["forFromDateSearch"];
			$arr_session["forToDateSearch"] 	= $data["forToDateSearch"] 	= $search_variable["forToDateSearch"];
			$arr_session["zoneSearch"] 			= $data["zoneSearch"] 			= $search_variable["zoneSearch"];
			$arr_session["regionSearched"] 		= $data["regionSearched"] 		= $search_variable["regionSearched"];
			$arr_session["branchSearched"] 		= $data["branchSearched"] 		= $search_variable["branchSearched"];
			$arr_session["arohan_center_name"] 		= $data["arohan_center_name"] 		= $search_variable["arohan_center_name"];
			$arr_session["arohan_customer_code"] 		= $data["arohan_customer_code"] 		= $search_variable["arohan_customer_code"];
			$arr_session["customer_name"] 		= $data["customer_name"] 		= $search_variable["customer_name"];
			$arr_session["loanId"] 		= $data["loanId"] 		= $search_variable["loanId"];
			$arr_session["statusSearch"] 		= $data["statusSearch"] 		= $search_variable["statusSearch"];
			$arr_session["h_search"]     		= $data["h_search"]     		= $s_search;
			
			if($search_variable["regionSearched"] != ''){
				$data["regionSearched"] = implode(',',$search_variable["regionSearched"]);
			}else{
				$data["regionSearched"] = $search_variable["regionSearched"];
			}
			if($search_variable["branchSearched"] != '')
			{
				$data["branchSearched"] = implode(',',$search_variable["branchSearched"]);
			}
			else
			{
				$data["branchSearched"] = $search_variable["branchSearched"];
			}
			Session::put( 'arr_search_session',$arr_session );
		}
		else
		{
			if( $search_variable['forFromDateSearch'] == '' && $search_variable['forToDateSearch'] == '' )			
			{
				$search_sql .= " AND( (dt.dt_created_at >= '".(date( 'Y-m-d 00:00:00', strtotime(site_date_to_db_date($first_day_month))))."') AND (dt.dt_created_at <= '".(date( 'Y-m-d 23:59:59'))."') )";
				
				$data["forFromDateSearch"] 	= date('d-m-Y', strtotime($first_day_month));
				$data["forToDateSearch"] 	= date('d-m-Y');
			}
			else{				
				$data["forFromDateSearch"] 	= date('d-m-Y', strtotime($search_variable["forFromDateSearch"]));
				$data["forToDateSearch"] 	= date('d-m-Y', strtotime($search_variable["forToDateSearch"]));
			}
			$data["h_search"]     		= $s_search;
			if($data["zoneSearch"] == '')
			{
				$data["zoneSearch"] = $zone_code_;
			}
			if($search_variable["branchSearched"] != '')
			{
				$data["branchSearched"] = implode(',',$search_variable["branchSearched"]);
			}
			else
			{
				$data["branchSearched"] = $search_variable["branchSearched"];
			}
			if($search_variable["regionSearched"] != '')
			{
				$data["regionSearched"] = implode(',',$search_variable["regionSearched"]);
			}
			else
			{
				$data["regionSearched"] = $search_variable["regionSearched"];
			}
			
			Session::forget( 'arr_search_session' );
		}	
		#~~~~~~~~~~~~~~~~~~~~~~~~~ SEARCH SECTION [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#	

		$whereRaw 	  = " dt.i_is_active = 1";	

		if(strpos($pageName, '/manage-application') !== FALSE){
			$whereRaw .= " AND ((i_current_step < 8 AND i_last_step_saved < 7) OR (i_last_step_saved = '' OR i_last_step_saved IS NULL))";
		}else if(strpos($pageName, '/disbursedApplications') !== FALSE){
			$whereRaw .= " AND s_application_status = 'Disbursed' ";	
		}else if(strpos($pageName, '/rejectedApplications') !== FALSE){
			$whereRaw .= " AND s_application_status = 'Rejected' ";	
		}else if(strpos($pageName, '/rejectedBqhApplications') !== FALSE){
			$whereRaw .= " AND s_application_status = 'Rejected by BQH' ";	
		}

		$whereRaw .= $search_sql;	
		
		$raw_qry = "SELECT
						dt.i_id,
						dt.s_transaction_id,
						dt.s_branch_code,
						dt.s_branch_name,
						dt.s_center_code,
						dt.s_center_name,
						dt.s_group_code,
						dt.s_group_name,
						dt.s_customer_id,
						dt.s_cb_customer_name,
						dt.s_product_code,
						dt.s_product_name,
						dt.s_loan_amount,
						dt.s_loan_tenure,
						dt.s_loan_type,
						dt.s_product_type,
						dt.s_collected_user_code,
						dt.s_collected_user_name,
						dt.i_status_change_by,
						dt.s_application_status,
						dt.i_current_step,
						dt.i_last_step_saved,
						dt.dt_created_at,
						dt.s_cb_fail_reason,
						dt.s_cb_report,
						dt.s_coborrower_cb_report,
						dt.s_user_loan_type,  
						dt.i_cross_verification_status,  
						dt.i_grt_status,  
						dt.i_cgt1_status,  
						dt.i_cgt2_status,
						dt.dt_disbursement_date,
						dt.s_loan_id,
						dt.dt_status_change
						FROM ".$this->customer_transaction_table." AS dt
						INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = dt.s_branch_code
						INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id
						INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id
						WHERE ".$whereRaw." ORDER BY dt.s_group_code DESC, dt.dt_created_at DESC, dt.s_customer_id DESC";
						
		if( $print_mode == false )
		{						
			$limit_query = 	' LIMIT '.(($pageNo*$limit)-$limit).', '.$limit;
			
			$report_data  = DB::select($raw_qry.$limit_query);				
	
			$raw_qry2 = "SELECT
						dt.i_id
						FROM ".$this->customer_transaction_table." AS dt
						INNER JOIN ".$this->tableOfficeLocation." AS branch ON branch.s_office_code = dt.s_branch_code
						INNER JOIN ".$this->tableOfficeLocation." AS region ON branch.i_parent_id = region.i_id
						INNER JOIN ".$this->tableOfficeLocation." AS zone ON region.i_parent_id = zone.i_id
						WHERE ".$whereRaw."";

				$data_count_arr  = DB::select($raw_qry2);				
		}
		else
		{
			$report_data = $data_count_arr = [];
		}
				
		$data['user_access_type']   = $user_access_type;			
		
		$data['user_id'] 			= $user_id;
		$data['report_data'] 		= $report_data;
		$data['data_count'] 		= count($data_count_arr);						
				
		$data['pageNo']      = $pageNo; 
		$data['limit']       = $limit;
		
		return view('manageApplication.show_list')->with($data);
				
	}	
	
	public function get_center_list( Request $request )
	{
		$branchID 	= $request->post('branchID');
		$ret 		= ['center_flag'=>false,'center_data'=>[],'center_ids'=>[]];
		$center_data= [];
		
		if( $branchID > 0 ) 
		{
			$branch_code = $branchID;
				
			if( $branch_code > 0 )
				$center_data = get_center_list_by_branch( $branch_code );
			
			if( !empty($center_data))
			{	
				$ret['center_flag'] = true;	
				
				foreach( $center_data As $d ){
						$ret['center_data'][] = my_show_txt($d->center_name.' ('.$d->s_center_code.')');
						$ret['center_ids'][] = $d->s_center_code;
				}				

			}
		}
		//echo "<pre>"; print_r(json_encode($ret)); exit;
		echo json_encode($ret);
		exit;
	}
	
	public function ajax_change_application_status( Request $request )
	{
		$user_id 		= $request->session()->get('userId');
		$groupCode 	= $request->groupCode;
		$applicationStatus 	= $request->applicationStatus;
		$ret 		= ['status'=>'success','applicationStatus'=>''];
		
		if( $groupCode != '') 
		{
			$dataArr['dt_status_change'] = date('Y-m-d H:i:s');
			$dataArr['s_application_status'] = $applicationStatus;
			$dataArr['i_status_change_by'] = $user_id;
			$dataArr['i_modified_by'] = $user_id;
			$dataArr['dt_modified_at'] = date('Y-m-d H:i:s');
			DB::table($this->customer_transaction_table)->where('s_group_code', $groupCode)->update($dataArr);
			$ret['applicationStatus'] = $applicationStatus;
		}
		//echo "<pre>"; print_r(json_encode($ret)); exit;
		echo json_encode($ret);
		exit;
	}
	
	/**
     *  Get Product Details
     *  @return html page for ajax request
     */
    public function ajax_view_details(Request $request)
    {
        $context = array();
        if($request->isMethod('post')){
            $transactionID = $request->post('transactionID');

            $details = DB::table($this->customer_transaction_table)
						->where('i_is_active', 1)
                        ->where('s_transaction_id', $transactionID)
                        ->get();
            $groupCode = '';
            $nfeedbackTransId = [];
            foreach ($details as $key => $value) {
				$groupCode = $value->s_group_code;
            	$nfeedbackTransId[] = $value->s_transaction_id;
            }

            $nFeedback = DB::table($this->nFeedback)
            			->selectRaw($this->nFeedback.'.*, '.$this->customer_transaction_table.'.s_customer_id, '.$this->customer_transaction_table.'.dt_created_at AS applicationDate,'.$this->customer_transaction_table.'.i_current_step,'.$this->customer_transaction_table.'.s_application_status, '.$this->customer_transaction_table.'.i_last_step_saved,'.$this->customer_transaction_table.'.i_cross_verification_status,'.$this->customer_transaction_table.'.i_grt_status,'.$this->customer_transaction_table.'.i_cgt1_status,'.$this->customer_transaction_table.'.i_cgt2_status' )
            			->join($this->customer_transaction_table, $this->customer_transaction_table.'.s_transaction_id', $this->nFeedback.'.s_transaction_id')
						->where($this->nFeedback.'.i_is_active', 1)
                        ->whereIn($this->nFeedback.'.s_transaction_id', $nfeedbackTransId)
                        ->get();
            
            $context['details'] = $details;

            $arrnFdback = [];
            foreach ($nFeedback as $key => $value) {
            	$arrnFdback[$value->s_transaction_id][] = $value;
            }

            $context['nFeedback'] = $arrnFdback;


            $detailsGrp = DB::table($this->customer_transaction_table)
						->where('i_is_active', 1)
                        ->where('s_group_code', $details[0]->s_group_code)
                        ->get();
            
            $nfeedbackTransIdGrp = [];
            foreach ($detailsGrp as $key => $value) {
            	$nfeedbackTransIdGrp[] = $value->s_transaction_id;
            }
			
            $gFormation = DB::table($this->group_members_los)
            			->selectRaw($this->group_members_los.'.*, '.$this->center_master.'.s_center_name, '.$this->group_master_los.'.s_group_id, '.$this->group_master_los.'.i_is_active, '.$this->group_master_los.'.s_group_type, '.$this->group_master_los.'.s_group_name, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.s_group_range, '.$this->group_master_los.'.d_location_lat, '.$this->group_master_los.'.d_location_lng')
            			->join($this->group_master_los, $this->group_master_los.'.s_los_group_code', $this->group_members_los.'.s_los_group_code')
            			->join($this->center_master, $this->center_master.'.s_center_code', $this->group_members_los.'.s_center_code')
						->where($this->group_master_los.'.i_is_active', 1)
						->where($this->group_members_los.'.i_is_active', 1)
                        ->whereIn($this->group_members_los.'.s_transaction_id', $nfeedbackTransIdGrp)
                        ->get();
            

            $arrgFormation = [];
            foreach ($gFormation as $key => $value) {
            	$arrgFormation[] = $value;
            }

            $context['gFormation'] = $arrgFormation;


            $cgt1 = DB::table($this->cgt1_cgt2)
            			->selectRaw($this->cgt1_cgt2.'.*, '.$this->group_master_los.'.s_group_id, '.$this->group_members_los.'.i_is_leader, '.$this->group_master_los.'.i_is_active, '.$this->group_master_los.'.s_group_type, '.$this->group_master_los.'.s_group_name, '.$this->group_members_los.'.s_los_group_code, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.s_group_range, '.$this->group_members_los.'.s_customer_name, '.$this->group_members_los.'.s_phone_no, '.$this->group_master_los.'.d_location_lat, '.$this->group_master_los.'.d_location_lng')
            			->join($this->group_master_los, $this->group_master_los.'.s_los_group_code', $this->cgt1_cgt2.'.s_group_id')
            			->join($this->group_members_los, $this->group_members_los.'.s_customer_id', $this->cgt1_cgt2.'.s_customer_id')
						->where($this->cgt1_cgt2.'.i_is_active', 1)
						->where($this->cgt1_cgt2.'.s_cgt_type', 'cgt1')
                        ->whereIn($this->cgt1_cgt2.'.s_transaction_id', $nfeedbackTransIdGrp)
                        ->groupBy($this->cgt1_cgt2.'.s_customer_id')
                        ->get();
            

            $arrCgt1 = [];
            foreach ($cgt1 as $key => $value) {
            	$arrCgt1[] = $value;
            }

            $context['cgt1'] = $arrCgt1;


            $cgt2 = DB::table($this->cgt1_cgt2)
            			->selectRaw($this->cgt1_cgt2.'.*, '.$this->group_master_los.'.s_group_id, '.$this->group_members_los.'.i_is_leader, '.$this->group_master_los.'.i_is_active, '.$this->group_master_los.'.s_group_type, '.$this->group_master_los.'.s_group_name, '.$this->group_members_los.'.s_los_group_code, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.s_group_range, '.$this->group_members_los.'.s_customer_name, '.$this->group_members_los.'.s_phone_no, '.$this->group_master_los.'.d_location_lat, '.$this->group_master_los.'.d_location_lng')
            			->join($this->group_master_los, $this->group_master_los.'.s_los_group_code', $this->cgt1_cgt2.'.s_group_id')
            			->join($this->group_members_los, $this->group_members_los.'.s_customer_id', $this->cgt1_cgt2.'.s_customer_id')
						->where($this->cgt1_cgt2.'.i_is_active', 1)
						->where($this->cgt1_cgt2.'.s_cgt_type', 'cgt2')
                        ->whereIn($this->cgt1_cgt2.'.s_transaction_id', $nfeedbackTransIdGrp)
                        ->groupBy($this->cgt1_cgt2.'.s_customer_id')
                        ->get();
            

            $arrCgt2 = [];
            foreach ($cgt2 as $key => $value) {
            	$arrCgt2[] = $value;
            }
			$context['cgt2'] = $arrCgt2;
            
			
			$grt = DB::table($this->grt_details)
            			->selectRaw($this->grt_details.'.*, '.$this->group_master_los.'.i_is_active, '.$this->group_members_los.'.i_is_leader,  '.$this->group_master_los.'.s_group_type, '.$this->group_master_los.'.s_group_name, '.$this->group_members_los.'.s_los_group_code, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.i_member_count, '.$this->group_master_los.'.s_group_range, '.$this->group_members_los.'.s_customer_name, '.$this->group_members_los.'.s_phone_no, '.$this->group_master_los.'.d_location_lat, '.$this->group_master_los.'.d_location_lng')
            			->join($this->group_master_los, $this->group_master_los.'.s_los_group_code', $this->grt_details.'.s_group_id')
            			->join($this->group_members_los, $this->group_members_los.'.s_customer_id', $this->grt_details.'.s_customer_id')
            			->where($this->grt_details.'.i_is_active', 1)
						->whereIn($this->grt_details.'.s_transaction_id', $nfeedbackTransId)
						->groupBy($this->grt_details.'.s_customer_id')
                        ->get();
            

            $arrGrt = [];
            foreach ($grt as $key => $value) {
            	$arrGrt[] = $value;
            }
            $context['grt'] = $arrGrt;
			
			// Cross Verification
			$cross_verification_log = DB::table($this->cross_verification_audit_log)
            			->selectRaw($this->cross_verification_audit_log.'.*, '.$this->customer_transaction_table.'.s_customer_id, '.$this->customer_transaction_table.'.dt_created_at AS applicationDate,'.$this->customer_transaction_table.'.s_application_status,'.$this->customer_transaction_table.'.i_last_step_saved,'.$this->customer_transaction_table.'.i_cross_verification_status,'.$this->customer_transaction_table.'.i_grt_status,'.$this->customer_transaction_table.'.i_cgt1_status,'.$this->customer_transaction_table.'.i_cgt2_status,'.$this->customer_transaction_table.'.i_current_step,'.$this->customer_transaction_table.'.d_cross_verification_location_lat,'.$this->customer_transaction_table.'.d_cross_verification_location_lng')
            			->join($this->customer_transaction_table, $this->customer_transaction_table.'.s_transaction_id', $this->cross_verification_audit_log.'.s_transaction_id')
            			->where($this->cross_verification_audit_log.'.i_is_active', 1)
						->whereIn($this->cross_verification_audit_log.'.s_transaction_id', $nfeedbackTransId)
						->get();
            $arrCrossVerification = [];
            foreach ($cross_verification_log as $key => $value) {
            	$arrCrossVerification[$value->s_transaction_id][] = $value;
            }
            $context['crossVerification'] = $arrCrossVerification;
			
			//LUC_DETAILS
			$luc_details = DB::table($this->luc_details)
            			->selectRaw($this->luc_details.'.*, '.$this->customer_transaction_table.'.s_cb_customer_name')
						->join($this->customer_transaction_table, $this->customer_transaction_table.'.s_transaction_id', $this->luc_details.'.s_transaction_id')
            			->where($this->luc_details.'.i_is_active', 1)
            			->where($this->luc_details.'.s_group_code', $groupCode)
						->get();
            $arrLuc = [];
            foreach ($luc_details as $key => $value) {
            	$arrLuc[] = $value;
            }
            $context['luc'] = $arrLuc;
			
            return view('manageUnapprovedApplication.ajax_view_details')->with($context);
        }
    }
	
	public function downloadInvoice(Request $request)
    {
		$detailArr = array();
		$pdfEReceiptForm = MPDF::loadView('manageUnapprovedApplication.download_invoice', $detailArr);
		$outputLoanSanctionAgreementLetterBengaliIndividual = $pdfEReceiptForm->output();
			return $pdfEReceiptForm->stream('ereceipt.pdf');
	}
	
	public function ajax_region_list_by_zone( Request $request )
	{
		$zoneIDs 	= $request->post('zoneIDs');
		$ret 		= ['region_flag'=>false,'region_data'=>[]];
		
		if( $zoneIDs != '' ) 
		{
			$office_location = DB::table($this->tableOfficeLocation.' as ofc')
								->select('ofc.s_office_code',DB::raw('CONCAT(ofc.s_office_name," (",ofc.s_office_code,")") As office_name'),'ofc.i_parent_id',
									'ofc_parent.s_office_name as s_parent_name'
								)
								->join($this->tableOfficeLocation.' as ofc_parent','ofc.i_parent_id', '=','ofc_parent.i_id')
								->where('ofc.i_is_active', 1)
								->where('ofc.e_office_type', 'REGIONAL')
								->whereRaw('ofc_parent.s_office_code="'.$zoneIDs.'"')
								->orderBy('ofc_parent.s_office_name', 'ASC')
								->orderBy('office_name', 'ASC')
								->get();
			$office_region_asParent = $office_location->groupBy('s_parent_name')->toArray();
			
			$ret['region_data'] = $office_region_asParent;	
			$ret['region_flag'] = true;				
		}
		//echo "<pre>"; print_r(json_encode($office_location)); exit;
		echo json_encode($ret);
		exit;
	}
	
		
	public function get_branch_list_by_region( Request $request )
	{
		$regionIDs 	= $request->post('regionIDs');
		$ret 		= ['branch_flag'=>false,'branch_data'=>[]];
		
		if( $regionIDs != '' ) 
		{
			$office_location = DB::table($this->tableOfficeLocation.' as ofc')
								->select('ofc.s_office_code',DB::raw('CONCAT(ofc.s_office_name," (",ofc.s_office_code,")") As office_name'),'ofc.i_parent_id',
									'ofc_parent.s_office_name as s_parent_name'
								)
								->join($this->tableOfficeLocation.' as ofc_parent','ofc.i_parent_id', '=','ofc_parent.i_id')
								->where('ofc.i_is_active', 1)
								->whereRaw('ofc.e_office_type LIKE "BRANCH%"')
								->whereIn('ofc_parent.s_office_code', $regionIDs)
								->orderBy('office_name', 'ASC')
								->orderBy('ofc.s_office_name', 'ASC')
								->get();
			$office_region_asParent = $office_location->groupBy('s_parent_name')->toArray();
			
			$ret['branch_data'] = $office_region_asParent;	
			$ret['branch_flag'] = true;				
		}
		//echo "<pre>"; print_r(json_encode($office_location)); exit;
		echo json_encode($ret);
		exit;
	}


    public function uploadNocDocView(Request $request){
        $context = array();
        $transactionID = $request->post('transactionID');

        $dataDetail = DB::table($this->customer_transaction_table)
					//->select('s_noc_doc_path', 's_cb_fail_reason', 's_transaction_id')
                    ->where('s_transaction_id', $transactionID)
                    ->get();

        echo json_encode($dataDetail);
    }

    public function viewHighMark(Request $request, $transactionID){

        $detailVal = DB::table($this->customer_transaction_table)
                    ->where([['s_transaction_id', '=', $transactionID]])
                    ->get()[0];

        $xml = new \SimpleXMLElement(htmlspecialchars_decode($detailVal->s_cb_report));

        echo $queryResult = $xml->xpath('//INDV-REPORTS/INDV-REPORT/PRINTABLE-REPORT/CONTENT')[0];

        exit;
    }

    public function viewHighMarkCobor(Request $request, $transactionID){

        $detailVal = DB::table($this->customer_transaction_table)
                    ->where([['s_transaction_id', '=', $transactionID]])
                    ->get()[0];

        $xml = new \SimpleXMLElement(htmlspecialchars_decode($detailVal->s_coborrower_cb_report));

        echo $queryResult = $xml->xpath('//INDV-REPORTS/INDV-REPORT/PRINTABLE-REPORT/CONTENT')[0];

        exit;
    }


    public function uploadNocDoc(Request $request){
        $transactionId = $request->transactionId;
        $customerId = $request->customerId;


        $getPath = DB::table($this->customer_transaction_table)->select('s_noc_doc_path', 's_laf_sync_info')->where('s_transaction_id', $transactionId)->get();
        
        $nocFilePath = '';

        /*********Uploading NOC Docs Start*********/

            
            $nocFilePathMain = '';

            $nocFilePath1 = '';
            $nocDoc1 = $request->file('nocDoc1');
            if (isset($nocDoc1)) {

                $destinationPath = 'public/uploads/'.$customerId.'/'.$transactionId.'/customer/nocDocs/';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image_type = $nocDoc1->getClientOriginalExtension();

                $name = 'nocDoc1-'.$customerId.'-'.round(microtime(true) * 1000).'.'.$image_type;
                $pathImage = $destinationPath.$name;
                $nocDoc1->move($destinationPath, $name);
                makeThumbnails($destinationPath, $name);
                $nocFilePath1 = $pathImage.'|';

                if($getPath[0]->s_noc_doc_path != '||'){
                    $exploadedPathArr = explode('|', $getPath[0]->s_noc_doc_path);
                    if(array_key_exists('0', $exploadedPathArr) && $exploadedPathArr[0] != ''){
                        unlink($exploadedPathArr[0]);
                    }
                }
            }else{
                if($getPath[0]->s_noc_doc_path != '||'){
                    $exploadedPathArr = explode('|', $getPath[0]->s_noc_doc_path);
                    if(array_key_exists('0', $exploadedPathArr)){
                        $nocFilePath1 = $exploadedPathArr[0].'|';
                    }else{
                        $nocFilePath1 = '|';
                    }
                }else{
                    $nocFilePath1 = '|';
                }
            }

            $nocFilePath2 = '';
            $nocDoc2 = $request->file('nocDoc2');
            if (isset($nocDoc2)) {

                $destinationPath = 'public/uploads/'.$customerId.'/'.$transactionId.'/customer/nocDocs/';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image_type = $nocDoc2->getClientOriginalExtension();

                $name = 'nocDoc2-'.$customerId.'-'.round(microtime(true) * 1000).'.'.$image_type;
                $pathImage = $destinationPath.$name;
                $nocDoc2->move($destinationPath, $name);
                makeThumbnails($destinationPath, $name);
                $nocFilePath2 = $pathImage.'|';

                if($getPath[0]->s_noc_doc_path != '||'){
                    $exploadedPathArr = explode('|', $getPath[0]->s_noc_doc_path);
                    if(array_key_exists('1', $exploadedPathArr) && $exploadedPathArr[1] != ''){
                        unlink($exploadedPathArr[1]);
                    }
                }
            }else{
                if($getPath[0]->s_noc_doc_path != '||'){
                    $exploadedPathArr = explode('|', $getPath[0]->s_noc_doc_path);
                    if(array_key_exists('1', $exploadedPathArr)){
                        $nocFilePath2 = $exploadedPathArr[1].'|';
                    }else{
                        $nocFilePath2 = '|';
                    }
                }else{
                    $nocFilePath2 = '|';
                }
            }


            $nocFilePath3 = '';
            $nocDoc3 = $request->file('nocDoc3');
            if (isset($nocDoc3)) {

                $destinationPath = 'public/uploads/'.$customerId.'/'.$transactionId.'/customer/nocDocs/';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image_type = $nocDoc3->getClientOriginalExtension();

                $name = 'nocDoc3-'.$customerId.'-'.round(microtime(true) * 1000).'.'.$image_type;
                $pathImage = $destinationPath.$name;
                $nocDoc3->move($destinationPath, $name);
                makeThumbnails($destinationPath, $name);
                $nocFilePath3 = $pathImage.'';

                if($getPath[0]->s_noc_doc_path != '||'){
                    $exploadedPathArr = explode('|', $getPath[0]->s_noc_doc_path);
                    if(array_key_exists('2', $exploadedPathArr) && $exploadedPathArr[2] != ''){
                        unlink($exploadedPathArr[2]);
                    }
                }
            }else{
                if($getPath[0]->s_noc_doc_path != '||'){
                    $exploadedPathArr = explode('|', $getPath[0]->s_noc_doc_path);
                    if(array_key_exists('2', $exploadedPathArr)){
                        $nocFilePath3 = $exploadedPathArr[2];
                    }else{
                        $nocFilePath3 = '';
                    }
                }else{
                    $nocFilePath3 = '';
                }
            }

            $nocFilePath = $nocFilePath1.$nocFilePath2.$nocFilePath3;
        
            $updateDataArr['s_noc_doc_path'] = $nocFilePath;
        /*********Uploading NOC Docs End*********/

        if($getPath[0]->s_laf_sync_info != ''){
        	$decodedStr = json_decode($getPath[0]->s_laf_sync_info, true);
        	$decodedStr['i_is_noc_synced'] = 1;
        	$updateDataArr['s_laf_sync_info'] = json_encode($decodedStr);
        }
        
        $updateDataArr['dt_modified_at'] = date('Y-m-d H:i:s');

        $updtQuery = DB::table($this->customer_transaction_table)->where('s_transaction_id', $transactionId)->update($updateDataArr);

        $responseArr['status'] = 'success';
        $responseArr['msg'] = 'NOC documents have been uploaded successfully for customer.';
        if($getPath[0]->s_noc_doc_path != ''){
            $nocDocPathExploaded = explode('|', $nocFilePath);
            foreach ($nocDocPathExploaded as $keyNoc => $valueNoc) {
                $responseArr['nocDocPath'][0]['nocDoc'.($keyNoc+1)] =  $valueNoc;
            }
        }else{
            $responseArr['nocDocPath'] =  [];
        }

        echo json_encode($responseArr);
        exit;

        
    }


    public function deleteNocDoc(Request $request){
        $transactionId = $request->transactionId;
        $fileName = $request->fileName;

        $nocFilePath = '';
        $fileUploadedCnt = 0;
        
        $getPath = DB::table($this->customer_transaction_table)->select('s_noc_doc_path')->where('s_transaction_id', $transactionId)->get();
        
        if($getPath[0]->s_noc_doc_path != ''){
            $explodedNocDocPath = explode('|', $getPath[0]->s_noc_doc_path);
            unlink($fileName);
            foreach ($explodedNocDocPath as $key => $nocDocsEach) {
                if($nocDocsEach != ''){
                    if (($keytemp = array_search($fileName, $explodedNocDocPath)) !== false) {
                        $explodedNocDocPath[$keytemp] = '';
                    }

                    if($explodedNocDocPath[$keytemp] != ''){
                        $fileUploadedCnt++;
                    }
                }
            }
            
            $nocFilePath = implode('|', $explodedNocDocPath);
        }

        $updtQuery = DB::table($this->customer_transaction_table)->where('s_transaction_id', $transactionId)->update(['s_noc_doc_path' => $nocFilePath, 'dt_modified_at' => date('Y-m-d H:i:s')]);

        $responseArr['status'] = 'success';
        $responseArr['msg'] = 'Customer NOC document have been deleted successfully.';
        $responseArr['fileName'] = $fileName;
        $responseArr['fileUploadedCnt'] = $fileUploadedCnt;


        echo json_encode($responseArr);
        exit;
    }


    public function downloadPDF($transactionId, $type = '', $groupCode = ''){

        if($groupCode != ''){
        	$getTransDetailQry = DB::table($this->customer_transaction_table)->where('s_group_code', $groupCode)->get();
        }else{
        	$getTransDetailQry = DB::table($this->customer_transaction_table)->where('s_transaction_id', $transactionId)->get();
        }

        if($type != '1'){
        	$folderNm = 'public/uploads/Disbursement_kit_'.$getTransDetailQry[0]->s_group_code.'_'.date('YmdHis').'/';
        }else{
        	$folderNm = 'public/uploads/LAF_DOGH_'.$getTransDetailQry[0]->s_group_code.'_'.date('YmdHis').'/';
        }
        

        if (!file_exists($folderNm)) {
            mkdir($folderNm, 0777, true);
        }
        
        foreach ($getTransDetailQry as $keyTransDetail => $getTransDetail) {
	        $getOfficeDetailsByCode = getOfficeDetailsByCode($getTransDetail->s_branch_code);

	        $branchHeadData = DB::table($this->userOffice)
	                            ->selectRaw('users.s_first_name as branchHeadName, users.s_username as branchHeadCode')
	                            ->join($this->user, $this->userOffice.'.i_user_id', $this->user.'.i_user_id')
	                            ->join($this->userRole, $this->userOffice.'.i_user_id', $this->userRole.'.i_user_id')
	                            ->where([
	                                [$this->userOffice.'.i_office_id', $getOfficeDetailsByCode->i_id],
	                                [$this->userOffice.'.i_is_active', 1],
	                                [$this->userRole.'.i_role_id', 13],
	                                [$this->user.'.i_is_active', 1]
	                            ])
	                            ->get();

	        if(count($branchHeadData) > 0){
	            $branchHeadData = $branchHeadData[0];
	        }else{
	            $branchHeadData = json_decode(json_encode(['branchHeadName' => '', 'branchHeadCode' => '']));
	        }

	        if($getTransDetail->i_is_old_member == '1'){
		        $ch1 = curl_init();  
		        $url = config('app.arohanCustUrl');  

		        $fields = array(
		            'userid' => $getTransDetail->s_customer_profile_id
		        );
		        // Return Page contents. 
		        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
		          
		        //grab URL and pass it to the variable. 
		        curl_setopt($ch1, CURLOPT_URL, $url); 
		        curl_setopt($ch1, CURLOPT_POST, 1);
		        curl_setopt($ch1,CURLOPT_POSTFIELDS, json_encode($fields));
		          
		        $resltFromServ = json_decode(curl_exec($ch1), true)[0];

		        curl_close($ch1);
		    }else{
		    	$resltFromServ = [];
		    }

		    if($getTransDetail->s_loan_type == 'Secondary'){
		    	$arrnFdback = [];
		    }else{
	            $nFeedback = DB::table($this->nFeedback)
	            			->where($this->nFeedback.'.i_is_active', 1)
	                        ->where($this->nFeedback.'.s_transaction_id', $transactionId)
	                        ->get();
	            
		        $arrnFdback = [];
	            foreach ($nFeedback as $key => $value) {
	            	$arrnFdback[] = $value;
	            }
	        }

	        $detailArr = array("detailVal" => $getTransDetail, "branchHeadData" => $branchHeadData, "custAddtnlData" => $resltFromServ, "arrnFdback" => $arrnFdback);


	        if($getTransDetail->s_loan_type == 'Secondary'){
	        	$pdf = PDF::loadView('applicationForms.loanApplicationTatkal', $detailArr);
	        }else{
	        	$pdf = PDF::loadView('applicationForms.loanApplicationPrimary', $detailArr);
	        }


	        if($getTransDetail->i_ins_company_id != ''){
	            if($getTransDetail->i_ins_company_id == '1'){
	                $pdfDoGH = MPDF::loadView('applicationForms.balicDoGh', $detailArr);
	                $outputDoGH = $pdfDoGH->output();
	                file_put_contents($folderNm.$getTransDetail->s_customer_id."_BALIC_DOGH_Borrower.pdf", $outputDoGH);

	                $pdfDoGHCBorrwer = MPDF::loadView('applicationForms.balicDoGhCBorrwer', $detailArr);
	                $outputDoGHCBorrwer = $pdfDoGHCBorrwer->output();
	                file_put_contents($folderNm.$getTransDetail->s_customer_id."_BALIC_DOGH_CoBorrower.pdf", $outputDoGHCBorrwer);
	            }

	            if($getTransDetail->i_ins_company_id == '3'){
                    $pdfHdfc = MPDF::loadView('applicationForms.hdfcAuth', $detailArr);
                    $outputHdfc = $pdfHdfc->output();
                    file_put_contents($folderNm.$getTransDetail->s_customer_id."_HDFC_Authantication_Borrower.pdf", $outputHdfc);

                    $pdfHdfcCBorrower = MPDF::loadView('applicationForms.hdfcAuthCBorrower', $detailArr);
                    $outputHdfcCBorrower = $pdfHdfcCBorrower->output();
                    file_put_contents($folderNm.$getTransDetail->s_customer_id."_HDFC_Authantication_CoBorrower.pdf", $outputHdfcCBorrower);
                }

	            if($getTransDetail->i_ins_company_id == '4'){
	                $pdfKLI = MPDF::loadView('applicationForms.kLIForm', $detailArr, [], [ 
	                  'format' => 'A4',
	                  'orientation' => 'L'
	                ]);
	                $outputKLI = $pdfKLI->output();
	                file_put_contents($folderNm.$getTransDetail->s_customer_id."_KLI_Authantication.pdf", $outputKLI);
	            }
	        }



	        if($type != '1'){
	            $pdfPronote = PDF::loadView('applicationForms.pronote', $detailArr);
	            $output = $pdfPronote->output();
	            file_put_contents($folderNm."pronote.pdf", $output);

	        

		        if($getTransDetail->i_cb_state_id == '19' || $getTransDetail->i_cb_state_id == '16'){
		        	if($getTransDetail->s_user_loan_type == 'JLG'){
    	    	    	$pdfLoanSanctionAgreementJlgBengaliForm = MPDF::loadView('applicationForms.loanSanctionAgreementJlgBengali', $detailArr);
    	    	    	$outputLoanSanctionAgreementLetterBengali = $pdfLoanSanctionAgreementJlgBengaliForm->output();
    	    	    	file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterJlgBengali.pdf", $outputLoanSanctionAgreementLetterBengali);
    	    	    }else{
		                $pdfLoanSanctionAgreementIndividualBengaliForm = MPDF::loadView('applicationForms.loanSanctionAgreementIndividualBengali', $detailArr);
		                $outputLoanSanctionAgreementLetterBengaliIndividual = $pdfLoanSanctionAgreementIndividualBengaliForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterIndividualBengali.pdf", $outputLoanSanctionAgreementLetterBengaliIndividual);
    	    	    }
		        }else if($getTransDetail->i_cb_state_id == '9' || $getTransDetail->i_cb_state_id == '10' || $getTransDetail->i_cb_state_id == '20' || $getTransDetail->i_cb_state_id == '23'){
		        	if($getTransDetail->s_user_loan_type == 'JLG'){
			        	$pdfLoanSanctionAgreementJlgHindiForm = MPDF::loadView('applicationForms.loanSanctionAgreementJlgHindi', $detailArr);
		                $outputLoanSanctionAgreementLetterHindi = $pdfLoanSanctionAgreementJlgHindiForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterJlgHindi.pdf", $outputLoanSanctionAgreementLetterHindi);
		            }else{
			        	$pdfLoanSanctionAgreementIndividualHindiForm = MPDF::loadView('applicationForms.loanSanctionAgreementIndividualHindi', $detailArr);
		                $outputLoanSanctionAgreementLetterHindiIndividual = $pdfLoanSanctionAgreementIndividualHindiForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterIndividualHindi.pdf", $outputLoanSanctionAgreementLetterHindiIndividual);
		            }
	            }else if($getTransDetail->i_cb_state_id == '18'){
	            	if($getTransDetail->s_user_loan_type == 'JLG'){
	            		$pdfLoanSanctionAgreementJlgAssameseForm = MPDF::loadView('applicationForms.loanSanctionAgreementJlgAssamese', $detailArr);
		                $outputLoanSanctionAgreementLetterAssamese = $pdfLoanSanctionAgreementJlgAssameseForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterJlgAssamese.pdf", $outputLoanSanctionAgreementLetterAssamese);
	            	}else{
		            	$pdfLoanSanctionAgreementIndividualAssameseForm = MPDF::loadView('applicationForms.loanSanctionAgreementIndividualAssamese', $detailArr);
		                $outputLoanSanctionAgreementLetterAssameseIndividual = $pdfLoanSanctionAgreementIndividualAssameseForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterIndividualAssamese.pdf", $outputLoanSanctionAgreementLetterAssameseIndividual);
	            	}
	            }else if($getTransDetail->i_cb_state_id == '21'){
	            	if($getTransDetail->s_user_loan_type == 'JLG'){
	            		$pdfLoanSanctionAgreementJlgOdiaForm = MPDF::loadView('applicationForms.loanSanctionAgreementJlgOdia', $detailArr);
		                $outputLoanSanctionAgreementLetterOdia = $pdfLoanSanctionAgreementJlgOdiaForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterJlgOdia.pdf", $outputLoanSanctionAgreementLetterOdia);
	            	}else{
		            	$pdfLoanSanctionAgreementIndividualOdiaForm = MPDF::loadView('applicationForms.loanSanctionAgreementIndividualOdia', $detailArr);
		                $outputLoanSanctionAgreementLetterOdiaIndividual = $pdfLoanSanctionAgreementIndividualOdiaForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterIndividualOdia.pdf", $outputLoanSanctionAgreementLetterOdiaIndividual);
		            }
	            }else{
	            	if($getTransDetail->s_user_loan_type == 'JLG'){
	            		$pdfLoanSanctionAgreementJlgEnglishForm = MPDF::loadView('applicationForms.loanSanctionAgreementIndJlgEnglish', $detailArr);
		                $outputLoanSanctionAgreementLetterEnglish = $pdfLoanSanctionAgreementJlgEnglishForm->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementLetterJlgEnglish.pdf", $outputLoanSanctionAgreementLetterEnglish);
	            	}else{
		        		$pdfLoanSanctionAgreementLetter = PDF::loadView('applicationForms.loanSanctionAgreementIndividualEnglish', $detailArr);
		                $outputLoanSanctionAgreementLetter = $pdfLoanSanctionAgreementLetter->output();
		                file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanSanctionAgreementIndividualEnglish.pdf", $outputLoanSanctionAgreementLetter);
		            }
		        }
	        }
	        

	        $outputLoanApplctn = $pdf->output();
	        file_put_contents($folderNm.$getTransDetail->s_customer_id."_loanApplicationForm.pdf", $outputLoanApplctn);
		}


    	$rootPath = realpath($folderNm);

    	if($type != '1'){
    		$zip_file = 'public/uploads/Disbursement_kit_'.$getTransDetailQry[0]->s_group_code.'_'.date('YmdHis').'.zip';
    	}else{
    		$zip_file = 'public/uploads/LAF_DOGH_'.$getTransDetailQry[0]->s_group_code.'_'.date('YmdHis').'.zip';
    	}

    	// Initialize archive object
    	$zip = new \ZipArchive();
    	$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

    	$files = new \RecursiveIteratorIterator(
    	    new \RecursiveDirectoryIterator($rootPath),
    	    \RecursiveIteratorIterator::LEAVES_ONLY
    	);

    	foreach ($files as $name => $file)
    	{
    	    // Skip directories (they would be added automatically)
    	    if (!$file->isDir())
    	    {
    	        // Get real and relative path for current file
    	        $filePath = $file->getRealPath();
    	        $relativePath = substr($filePath, strlen($rootPath) + 1);

    	        // Add current file to archive
    	        $zip->addFile($filePath, $relativePath);
    	    }
    	}

    	// Zip archive will be created only after closing object
    	$zip->close();

    	return response()->download($zip_file);

    	unlink($zip_file);
    	unlink($folderNm);

        exit;

        
        // $pdfLoanSanctionAgreementIndividualBengaliForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualBengali', $detailArr);
        // return $pdfLoanSanctionAgreementIndividualBengaliForm->stream('loanSanctionAgreementIndividualBengali.pdf');
        
        // $pdfLoanSanctionAgreementIndividualHindiForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualHindi', $detailArr);
        // return $pdfLoanSanctionAgreementIndividualHindiForm->stream('loanSanctionAgreementIndividualHindi.pdf');

        // $pdfLoanSanctionAgreementIndividualAssameseForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualAssamese', $detailArr);
        // return $pdfLoanSanctionAgreementIndividualAssameseForm->stream('loanSanctionAgreementIndividualAssamese.pdf');

        // $pdfLoanSanctionAgreementIndividualOdiaForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualOdia', $detailArr);
        // return $pdfLoanSanctionAgreementIndividualOdiaForm->stream('loanSanctionAgreementIndividualOdia.pdf');

        // $pdfLoanSanctionAgreementLetter = PDF::loadView('manageOrders.loanSanctionAgreementLetter', $detailArr);
        // return $pdfLoanSanctionAgreementLetter->stream('loanSanctionAgreementLetter.pdf');










        // if($type != '1'){
        //     $pdfPronote = PDF::loadView('manageOrders.pronote', $detailArr);
        //     // return $pdfPronote->stream('pronote.pdf');


        //     if($getCustomerDetails->i_state_id == '19' || $getCustomerDetails->i_state_id == '16'){
        //         //$pdfLoanSanctionAgreementJlgBengaliForm = MPDF::loadView('manageOrders.loanSanctionAgreementJlgBengali', $detailArr);
        //         $pdfLoanSanctionAgreementIndividualBengaliForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualBengali', $detailArr);
        //     }else if($getCustomerDetails->i_state_id == '9' || $getCustomerDetails->i_state_id == '10' || $getCustomerDetails->i_state_id == '20' || $getCustomerDetails->i_state_id == '23'){
        //         //$pdfLoanSanctionAgreementJlgHindiForm = MPDF::loadView('manageOrders.loanSanctionAgreementJlgHindi', $detailArr);
        //         $pdfLoanSanctionAgreementIndividualHindiForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualHindi', $detailArr);
        //     }else if($getCustomerDetails->i_state_id == '18'){
        //         //$pdfLoanSanctionAgreementJlgAssameseForm = MPDF::loadView('manageOrders.loanSanctionAgreementJlgAssamese', $detailArr);
        //         $pdfLoanSanctionAgreementIndividualAssameseForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualAssamese', $detailArr);
        //     }else if($getCustomerDetails->i_state_id == '21'){
        //         //$pdfLoanSanctionAgreementJlgOdiaForm = MPDF::loadView('manageOrders.loanSanctionAgreementJlgOdia', $detailArr);
        //         $pdfLoanSanctionAgreementIndividualOdiaForm = MPDF::loadView('manageOrders.loanSanctionAgreementIndividualOdia', $detailArr);
        //     }else{
        //         $pdfLoanSanctionAgreementLetter = PDF::loadView('manageOrders.loanSanctionAgreementLetter', $detailArr);
        //     }
        // }

        // $insuranceCompanyGet = DB::table($this->productPricing)->where('i_prod_id', $getOrderDetailsById->i_product_id)->where('i_region_id', $getOrderDetailsById->i_region_id)->where('dt_effective_date', '<=', date('Y-m-d', strtotime($getOrderDetailsById->dt_created_date)))->orderBy('dt_effective_date', 'DESC')->limit(1)->get();

        // if($type == '1'){
        //     $folderNm = 'public/uploads/LAF_DOGH'.$getOrderDetailsById->s_document_number.'_'.date('YmdHis').'/';
        // }else{
        //     $folderNm = 'public/uploads/DisbursmentKit_'.$getOrderDetailsById->s_document_number.'_'.date('YmdHis').'/';
        // }
        
        // if (!file_exists($folderNm)) {
        //     mkdir($folderNm, 0777, true);
        // }

        
        
        // if(count($insuranceCompanyGet) > 0){
        //     if($insuranceCompanyGet[0]->i_insurance_company == '1'){
        //         $pdfDoGH = MPDF::loadView('manageOrders.balicDoGh', $detailArr);
        //         //return $pdfDoGH->stream($getCustomerDetails->s_customer_profile_id.'_balicDoGh.pdf');
        //         $outputDoGH = $pdfDoGH->output();
        //         file_put_contents($folderNm.$getCustomerDetails->s_customer_profile_id."_BALIC_DOGH_Borrower.pdf", $outputDoGH);

        //         $pdfDoGHCBorrwer = MPDF::loadView('manageOrders.balicDoGhCBorrwer', $detailArr);
        //         //return $pdfDoGHCBorrwer->stream($getCustomerDetails->s_customer_profile_id.'_balicDoGhCBorrwer.pdf');
        //         $outputDoGHCBorrwer = $pdfDoGHCBorrwer->output();
        //         file_put_contents($folderNm.$getCustomerDetails->s_customer_profile_id."_BALIC_DOGH_CoBorrower.pdf", $outputDoGHCBorrwer);
        //     }

        //     //if($type != '1'){
        //         if($insuranceCompanyGet[0]->i_insurance_company == '3'){
        //             $pdfHdfc = MPDF::loadView('manageOrders.hdfcAuth', $detailArr);
        //             //return $pdfHdfc->stream($getCustomerDetails->s_customer_profile_id.'_hdfcAuth.pdf');
        //             $outputHdfc = $pdfHdfc->output();
        //             file_put_contents($folderNm.$getCustomerDetails->s_customer_profile_id."_HDFC_Authantication_Borrower.pdf", $outputHdfc);

        //             $pdfHdfcCBorrower = MPDF::loadView('manageOrders.hdfcAuthCBorrower', $detailArr);
        //             //return $pdfHdfcCBorrower->stream($getCustomerDetails->s_customer_profile_id.'_hdfcAuthCBorrower.pdf');
        //             $outputHdfcCBorrower = $pdfHdfcCBorrower->output();
        //             file_put_contents($folderNm.$getCustomerDetails->s_customer_profile_id."_HDFC_Authantication_CoBorrower.pdf", $outputHdfcCBorrower);
        //         }
        //     //}

        //     if($insuranceCompanyGet[0]->i_insurance_company == '4'){
        //         $pdfKLI = MPDF::loadView('manageOrders.kLIForm', $detailArr, [], [ 
        //           'format' => 'A4',
        //           'orientation' => 'L'
        //         ]);
        //         //return $pdfHdfc->stream($getCustomerDetails->s_customer_profile_id.'_hdfcAuth.pdf');
        //         $outputKLI = $pdfKLI->output();
        //         file_put_contents($folderNm.$getCustomerDetails->s_customer_profile_id."_KLI_Authantication.pdf", $outputKLI);
        //     }
        // }

        

        






        

        
    }


    public function approveNoc(Request $request){
    	$transactionId = $request->transactionId;

    	$updtQuery = DB::table($this->customer_transaction_table)->where('s_transaction_id', $transactionId)->update(['i_is_noc_approved_by_bh' => 1,'dt_modified_at'=>date('Y-m-d H:i:s')]);

    	$responseArr['status'] = 'success';
    	$responseArr['msg'] = 'Customer NOC document(s) have been approved successfully.';


    	echo json_encode($responseArr);
    	exit;
    }

	 public function editApplication(Request $request, $application_id)
    {
        $sess_user_id   = session('userId');
        $sess_username  = session('username');
        
        $context = array();
        $context['heading'] = "Edit Application"; 
        $context['title']   = "Edit Application";
        $details = DB::table($this->customer_transaction_table)
						->where('i_is_active', 1)
                        ->where('i_id', $application_id)
                        ->get();
        $context['application_id']     = $application_id;
        $context['detail'] = $details[0]; 
		
		$context['bank_list'] = DB::table( $this->bank_details)->select('i_id','s_name','s_type')->where([['i_is_active',"=",1],['s_type',"=",'BANK']])->get()->toArray();
		$context['state_list'] = DB::select("SELECT i_id, s_name, s_code FROM ".$this->master_states." ORDER BY s_name ASC");
		$context['district_list'] = DB::select("SELECT i_id, s_district_name, i_state_id FROM ".$this->master_districts." WHERE i_is_active = 1 ORDER BY s_district_name ASC");
		
        return view('manageApplication.edit_application', $context);
        
    }
	public function updateApplication(Request $request)
    {
		$sess_user_id   = session('userId');
		if( $request->isMethod('post') ){
            
            $i_id       = $request->post('i_id');
            $s_mode_of_disbrusement     = $request->post('s_mode_of_disbrusement');
            $s_account_holder_type = $request->post('s_account_holder_type');
            $s_bank_name     = $request->post('s_bank_name');
            $s_branch_detail     = $request->post('s_branch_detail');
            $s_account_holder_name     = $request->post('s_account_holder_name');
            $i_account_number     = $request->post('i_account_number');
            $i_account_operational_since     = $request->post('i_account_operational_since');
            $s_ifsc_code     = $request->post('s_ifsc_code');
            
			$s_current_address     = $request->post('s_current_address');
            $s_current_village     = $request->post('s_current_village');
            $i_current_district_id     = $request->post('i_current_district_id');
			if($i_current_district_id >0)
			{
				$s_current_district     = get_master_districts_name($i_current_district_id);
			}
			else
			{
				$s_current_district     = '';
			}
			$i_current_state_id     = $request->post('i_current_state_id');
			if($i_current_state_id >0)
			{
				$s_current_state     = getStateById($i_current_state_id);
			}
			else
			{
				$s_current_state     = '';
			}
            $s_current_zip     = $request->post('s_current_zip');
            $s_current_taluka_block     = $request->post('s_current_taluka_block');
            $s_current_police_station     = $request->post('s_current_police_station');
            $s_current_post_office     = $request->post('s_current_post_office');
            $e_current_area     = $request->post('e_current_area');
            $s_current_landmark     = $request->post('s_current_landmark');

            $save_account_data = array(
                's_mode_of_disbrusement' => $s_mode_of_disbrusement, 
                's_account_holder_type' => $s_account_holder_type,
                's_bank_name' => $s_bank_name, 
                's_branch_detail' => $s_branch_detail, 
                's_account_holder_name'     => $s_account_holder_name,
                'i_account_operational_since'   => $i_account_operational_since,
                's_ifsc_code' => $s_ifsc_code,
                's_current_address' => $s_current_address,
                's_current_village' => $s_current_village,
                'i_current_district_id' => $i_current_district_id,
                's_current_district' => $s_current_district,
                'i_current_state_id' => $i_current_state_id,
                's_current_state' => $s_current_state,
                's_current_zip' => $s_current_zip,
                's_current_taluka_block' => $s_current_taluka_block,
                's_current_police_station' => $s_current_police_station,
                's_current_post_office' => $s_current_post_office,
                'e_current_area' => $e_current_area,
                's_current_landmark' => $s_current_landmark,
            );
			
            if($i_id)
			{
				$details = DB::table($this->customer_transaction_table)
						->select('s_applicant_kyc_image_front1','s_applicant_kyc_image_back1','s_applicant_kyc_image_front2','s_applicant_kyc_image_back2','s_customer_recidence_img','s_customer_business_img','s_coborrower_kyc_image_front','s_coborrower_kyc_image_back','s_coborrower_img','s_applicant_bank_passbook_img','s_applicant_bank_statement_img','s_noc_doc_path','s_application_signature','s_coborrower_signature','s_customer_id','s_transaction_id')
						->where('i_is_active', 1)
                        ->where('i_id', $i_id)
                        ->get();
				if(!empty($details))
				{
					$s_applicant_kyc_image_front1_path = $details[0]->s_applicant_kyc_image_front1;
					$s_applicant_kyc_image_back1_path = $details[0]->s_applicant_kyc_image_back1;
					$s_applicant_kyc_image_front2_path = $details[0]->s_applicant_kyc_image_front2;
					$s_applicant_kyc_image_back2_path = $details[0]->s_applicant_kyc_image_back2;
					$s_customer_recidence_img_path = $details[0]->s_customer_recidence_img;
					$s_customer_business_img_path = $details[0]->s_customer_business_img;
					$s_coborrower_kyc_image_front_path = $details[0]->s_coborrower_kyc_image_front;
					$s_coborrower_kyc_image_back_path = $details[0]->s_coborrower_kyc_image_back;
					$s_coborrower_img_path = $details[0]->s_coborrower_img;
					$s_applicant_bank_passbook_img_path = $details[0]->s_applicant_bank_passbook_img;
					$s_applicant_bank_statement_img_path = $details[0]->s_applicant_bank_statement_img;
					$s_noc_doc_path = $details[0]->s_noc_doc_path;
					$s_application_signature_path = $details[0]->s_application_signature;
					$s_coborrower_signature_path = $details[0]->s_coborrower_signature;
					
					if($request->file('s_applicant_kyc_image_front1'))
					{
						if($s_applicant_kyc_image_front1_path != '')
						{
							$s_applicant_kyc_image_front1_path_info = pathinfo($s_applicant_kyc_image_front1_path);
							$s_applicant_kyc_image_front1_dir = public_path(substr(strstr($s_applicant_kyc_image_front1_path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_applicant_kyc_image_front1_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/kyc";
						$s_applicant_kyc_image_front1_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($s_applicant_kyc_image_front1_dir)){
							\File::makeDirectory($s_applicant_kyc_image_front1_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_applicant_kyc_image_front1');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($s_applicant_kyc_image_front1_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_applicant_kyc_image_front1'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
					}
					
					if($request->file('s_applicant_kyc_image_back1'))
					{
						if($s_applicant_kyc_image_back1_path != '')
						{
							$path_info = pathinfo($s_applicant_kyc_image_back1_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_applicant_kyc_image_back1_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_applicant_kyc_image_back1');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_applicant_kyc_image_back1'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_applicant_kyc_image_front2'))
					{
						if($s_applicant_kyc_image_front2_path != '')
						{
							$path_info = pathinfo($s_applicant_kyc_image_front2_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_applicant_kyc_image_front2_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_applicant_kyc_image_front2');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_applicant_kyc_image_front2'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_applicant_kyc_image_back2'))
					{
						if($s_applicant_kyc_image_back2_path != '')
						{
							$path_info = pathinfo($s_applicant_kyc_image_back2_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_applicant_kyc_image_back2_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_applicant_kyc_image_back2');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_applicant_kyc_image_back2'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_customer_recidence_img'))
					{
						if($s_customer_recidence_img_path != '')
						{
							$path_info = pathinfo($s_customer_recidence_img_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_customer_recidence_img_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_customer_recidence_img');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_customer_recidence_img'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_customer_business_img'))
					{
						if($s_customer_business_img_path != '')
						{
							$path_info = pathinfo($s_customer_business_img_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_customer_business_img_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_customer_business_img');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_customer_business_img'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					
					if($request->file('s_coborrower_kyc_image_front'))
					{
						if($s_coborrower_kyc_image_front_path != '')
						{
							$path_info = pathinfo($s_coborrower_kyc_image_front_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_coborrower_kyc_image_front_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/coborrower/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_coborrower_kyc_image_front');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_coborrower_kyc_image_front'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_coborrower_kyc_image_back'))
					{
						if($s_coborrower_kyc_image_back_path != '')
						{
							$path_info = pathinfo($s_coborrower_kyc_image_back_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_coborrower_kyc_image_back_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/coborrower/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_coborrower_kyc_image_back');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_coborrower_kyc_image_back'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_coborrower_img'))
					{
						if($s_coborrower_img_path != '')
						{
							$path_info = pathinfo($s_coborrower_img_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_coborrower_img_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/coborrower/kyc";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_coborrower_img');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_coborrower_img'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_coborrower_signature'))
					{
						if($s_coborrower_signature_path != '')
						{
							$path_info = pathinfo($s_coborrower_signature_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_coborrower_signature_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/coborrower/signature";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_coborrower_signature');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_coborrower_signature'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_application_signature'))
					{
						if($s_application_signature_path != '')
						{
							$path_info = pathinfo($s_application_signature_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_application_signature_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/signature";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_application_signature');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_application_signature'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_applicant_bank_passbook_img'))
					{
						if($s_applicant_bank_passbook_img_path != '')
						{
							$path_info = pathinfo($s_applicant_bank_passbook_img_path);
							$s_applicant_kyc_image_back1_dir = public_path(substr(strstr($path_info['dirname'],"/"),1));
							$file_path = env('APP_URL').'/'.$s_applicant_bank_passbook_img_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/bankDetails";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_applicant_bank_passbook_img');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_applicant_bank_passbook_img'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
					if($request->file('s_applicant_bank_statement_img'))
					{
						if($s_applicant_bank_statement_img_path != '')
						{
							$path_info = pathinfo($s_applicant_bank_statement_img_path);
							$file_path = env('APP_URL').'/'.$s_applicant_bank_statement_img_path;
							if (file_exists($file_path)) 
							{
								unlink($file_path);
							}							
						}						
						$zip_extract_folder = "uploads/".$details[0]->s_customer_id."/".$details[0]->s_transaction_id."/customer/bankDetails";
						$upload_path_dir    = public_path($zip_extract_folder);
						if(!\File::isDirectory($upload_path_dir)){
							\File::makeDirectory($upload_path_dir, 0777, true);
						}
						$fileInfo  = $request->file('s_applicant_bank_statement_img');
						$file_name = $fileInfo->getClientOriginalName();
						$file_ext  = $fileInfo->getClientOriginalExtension();
						$file_uploaded = $fileInfo->move($upload_path_dir, $file_name, $file_ext);
						$file_name_with_path = 'public/'.$zip_extract_folder.'/'.$file_name;
						$save_account_data['s_applicant_bank_statement_img'] = $file_name_with_path;
						unset($fileInfo);
						unset($file_name);
						unset($file_ext);
						unset($file_name_with_path);
						unset($file_path);
						unset($path_info);
						unset($upload_path_dir);
					}
					
				}
                //  Upadte Application 
                $currntTime = date('Y-m-d H:i:s');
                $save_account_data['i_modified_by'] = $sess_user_id;
                $save_account_data['dt_modified_at'] = $currntTime;

                $is_saved = DB::table($this->customer_transaction_table)
                                ->where('i_id', $i_id)
                                ->update($save_account_data);
                if($is_saved){
                    return redirect('manage-application')->with('success', "Application Updated Successfully.");
                }
				else{
                    return redirect('manage-application')->with('error', "Failed to Update.");
                }         
			}
		}
	}
	
	public function getJsonDistrictListByStateId(Request $request){
        $stateId = $request->post('stateId');
        $childLocations = getDistrictListDD($stateId);
        
        echo json_encode(array("childLocations" => $childLocations));
    }
}
