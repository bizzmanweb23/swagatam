<?php

	/*
     * Function Name: getRoleDD
     * Defination: It's generate the role drop down dynamically and return the string <option>. If the selected ID is provided then it will selected the the role
     * @param: sting id list with comma separated
     * @return: string drop down list
     */
	 //use Illuminate\Http\Request;
	 use Illuminate\Routing\UrlGenerator;

    function getRoleDD($id = '', $excludeRollArr = []){
        $table = 'roles';
        //getting current user object
        // $current_user = Auth::User();
        //getting current company

        $str = '';

        //super admin can get all role
        if ($current_user['s_role_key'] == 'super_admin')
        {
            $data = \DB::table($table)
                    ->select(\DB::raw('i_role_id,  s_role, s_role_key'))
                    ->where('e_is_deleted', '=', 'No')
                    ->where([['s_role_key', '!=', 'super_admin'],['s_role_key', '!=', 'customer']])
                    ->orderBy('s_role','asc')
                    ->get();
        }
        else if ($current_user['s_role_key'] == 'admin')
        {
            $data = \DB::table($table)
                    ->select(\DB::raw('i_role_id, s_role, s_role_key'))
                    ->where('e_is_deleted', '=', 'No')
                    ->where([['s_role_key', '!=', 'super_admin'],['s_role_key', '!=', 'customer']])
                    ->orderBy('s_role','asc')
                    ->get();
        }
        else //other user get all role except admin role
        {
            $data = \DB::table($table)
                    ->select(\DB::raw('i_role_id, s_role, s_role_key'))
                    ->where('e_is_deleted', '=', 'No')
                    ->where([['s_role_key', '!=', 'super_admin'],['s_role_key', '!=', 'customer']])
                    ->orderBy('s_role','asc')
                    ->get();
        }
        if(!empty($data))
        {
            foreach($data as $val)
            {
                if(!in_array($val->s_role_key, $excludeRollArr)){
                    $selected = in_array($val->i_role_id, explode(',', $id)) ? 'selected' : '';
                    $str .= '<option value="'.$val->i_role_id.'" role-key-data="'.$val->s_role_key.'" '.$selected.'>'.$val->s_role.'</option>';
                }
            }
        }
        return $str;
    }


    function getRoleById($id = ''){
        $table = 'roles';
        $data = \DB::table('roles')
                    ->where('i_role_id', '=', $id)
                    ->get();

        return $data[0];
    }


    function getRoleByType($userId = ''){
        $data = \DB::table('roles')
                    ->join('user_roles', 'user_roles.i_role_id', 'roles.i_role_id')
                    ->where('i_user_id', '=', $userId)
                    ->where('i_is_active', '=', 1)
                    ->get();

        $getDataArr = [];
        foreach ($data as $key => $value) {
            $getDataArr[] = $value->s_role;
        }

        return $getDataArr;
    }


    /*
     * Function Name: createMenu
     * Defination: It will generate the menu of application
     * @param: sting userId
     * @return: HTML menu
     */
    function createMenu($userId = ''){
        //Session::flush(); //exit;
       // echo "<pre>"; print_r(Session::get('userId'));
	   //dd(session()->all());
	   $loggedinUserId  = Session::get('userId');
	   $s_application_alias_name  = Session::get('s_application_alias_name');

	   $application_arr 	= config( 'constants.APPLICATION_NAME' );
       $application_alias 	= '';
	   $current_url 		= explode('/',explode('//',url()->current())[1]);

	   if( $current_url[0] == 'localhost' )
			$application_alias = $current_url[2];
	   else
			$application_alias = $current_url[1];


	   if($application_alias != '' && array_key_exists( $application_alias, $application_arr ) )
	   {
			// $application_connection_name = getAppWiseDBConnection($application_alias);
			// config()->set('database.default', $application_connection_name);

			/*$base_url = env('APP_URL').'/'.$application_alias;
			$home_url = env('APP_URL');*/
			$home_url = $base_url = env('APP_URL');

			$getApplicationRoles = \DB::table('application_user_roles')->where([['e_deleted', '=', 'No']])->where([['i_is_active', '=', 1]])->where([['i_user_id', '=', $loggedinUserId]])->get();
	   }
	   else
	   {
		   $home_url = $base_url = env('APP_URL');
		   $getApplicationRoles = array();
	   }


	   /* if($s_application_alias_name != '')
	   {
			$application_connection_name = getAppWiseDBConnection($s_application_alias_name);
			config()->set('database.default', $application_connection_name);

			$base_url = env('APP_URL').'/'.$s_application_alias_name;
			$home_url = env('APP_URL');

			$getApplicationRoles = \DB::table('application_user_roles')->where([['e_deleted', '=', 'No']])->where([['i_is_active', '=', 1]])->where([['i_user_id', '=', $loggedinUserId]])->get();
	   }
	   else
	   {
		   $home_url = $base_url = env('APP_URL');
		   $getApplicationRoles = array();
	   } */
	   //$ApplicationSpecificDbConnection = DB::connection('mysql_collection');


		if(!empty($getApplicationRoles))
		{
			$roleId_arr = array(Session::get('roleId'));
			foreach($getApplicationRoles as $getApplicationRoles_val)
			{
				$roleId_arr[] = $getApplicationRoles_val->i_role_id;
			}

			$getaccess = DB::table('menu_permissions')->selectRaw('GROUP_CONCAT(`i_menu_id`) as `menuIds`')->whereIn('i_role_id', $roleId_arr)->get();
		}
		else
		{
			$getaccess = DB::table('menu_permissions')->selectRaw('GROUP_CONCAT(`i_menu_id`) as `menuIds`')->where('i_role_id', '=', Session::get('roleId'))->get();
		}


        $getparent = DB::table('menus')->selectRaw('GROUP_CONCAT(`i_parent_id`) as `parentMenuIds`')->whereIn('i_menu_id', explode(',', $getaccess[0]->menuIds))->get();

        $getaccess[0]->menuIds = $getaccess[0]->menuIds.','.$getparent[0]->parentMenuIds;

      //  if (Session::get('userType')->s_role_key != 'super_admin') {
        if (Session::get('userType') != 'super_admin') {
            $getAllMenus = DB::table('menus')->where([['i_display_status', '=', 1]])->whereIn('i_menu_id', explode(',', $getaccess[0]->menuIds))->orderBy('i_display_order', 'ASC')->get();
        }else{
            $getAllMenus = DB::table('menus')->where([['i_display_status', '=', 1], ['s_action', '!=', 'orderVendor']])->orderBy('i_display_order', 'ASC')->get();
        }

        $str = '';
        foreach ($getAllMenus as $key => $value) {
                $getenuAction = DB::table('menus')->where('s_url', '=', Session::get('roleId'))->get();
                if ($value->i_parent_id == 0) {

                    if ($value->s_url != '') {
                        $mainUrl = $base_url.'/'.$value->s_url;
                        $dropdownArrow = '';
                    }else{
                        $mainUrl = "javascript:void(0)";
                        $dropdownArrow = 'dropdown';
                    }

                    $actual_link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

                    if (strpos($actual_link, str_replace(['http://','https://'], '', $mainUrl)) !== false) {
                        $actvClsLi = ' active';
                    }else{
                        $actvClsLi = '';
                    }

					if( $application_alias != '' && $value->s_action == 'main_dashboard' )
					{
						$mainUrl = $home_url;
						$str .= '<li class="'.$dropdownArrow.$actvClsLi.' border-bottom mb-1">';
					}else{
						$str .= '<li class="'.$dropdownArrow.$actvClsLi.'">';
					}

                    $str .= '<a href="'.$mainUrl.'" class="dropdown-toggle"><i class="'.$value->s_icon.'"></i> <span class="menu-collapse-heading">'.$value->s_menu.'</span></a>';
                }

                //if (Session::get('userType')->s_role_key != 'super_admin') {
                if (Session::get('userType') != 'super_admin') {
                    $getSubMenus = DB::table('menus')
                                    ->where('i_display_status', '=', 1)
                                    ->where('i_parent_id', '=', $value->i_menu_id)
                                    ->whereIn('i_menu_id', explode(',', $getaccess[0]->menuIds))
                                    ->orderBy('i_display_order', 'ASC')
                                    ->get();
                }else{
                    $getSubMenus = DB::table('menus')
                                    ->where('i_display_status', '=', 1)
                                    ->where('i_parent_id', '=', $value->i_menu_id)
                                    ->orderBy('i_display_order', 'ASC')
                                    ->get();
                }
                if(count($getSubMenus) > 0){
                    $str .= '<ul class="dropdown-menu">';
                    foreach ($getSubMenus as $keyInner => $valueInner) {
                        $str .= '<li class="'.(((in_array($valueInner->s_url, explode('/',$_SERVER['REQUEST_URI']))))?'active':'').'"><a href="'.$base_url.'/'.$valueInner->s_url.'"><i class="far fa-circle"></i>'.$valueInner->s_menu.'</a></li>';
                    }
                    $str .= '</ul>';
                }
                $str .= '</li>';

				if( $application_alias != '' && $value->s_action == 'main_dashboard' )
					$str .= '<li class="menu-title">App Menu</li>';
        }

        config()->set('database.default', 'mysql');

        return $str;
    }


    function getMenuById($id){
		$data = \DB::table('menus')
                ->where('i_menu_id', '=', $id)
                ->get();


        return $data[0];
    }


    function pagination($limit, $total_records, $pageNo, $section='pilots', $additionalUrl = ''){

        $paginationPageDisplay = 5; //Number of pages on both side of selected page (put this value only odd number)

        $total_pages = ceil($total_records / $limit);

        if ($additionalUrl != '') {
            $additionalUrl = '/'.$additionalUrl;
        }

        if ($pageNo == '1') {
            $disabledClassPrv = ' class="disabled"';
            $urlPrv = '<span>Prev</span>';
        }else{
            $urlPrv = '<a href="javascript:void(0)" onClick="sortData(\''.url($section).'/'.($pageNo-1).$additionalUrl.'\')">Prev</a>';
            $disabledClassPrv = '';

        }

        if ($pageNo == $total_pages) {
            $disabledClassNxt = ' class="disabled"';
            $urlNxt = '<span>Next</span>';
        }else{
            $urlNxt = '<a href="javascript:void(0)" onClick="sortData(\''.url($section).'/'.($pageNo+1).$additionalUrl.'\')">Next</a>';
            $disabledClassNxt = '';

        }

        $pagLink = '<ul class="pagination align-center margin-top-la">';

        if($total_pages > 0){
            $pagLink .= '<li'.$disabledClassPrv.'>'.$urlPrv.'</li>';
        }

        if ($pageNo > ($paginationPageDisplay + 1)) {
            $pagLink .= '<li><a href="javascript:void(0)" onClick="sortData(\''.url($section).'/1'.$additionalUrl.'\')">1</a></li><li><span>...</span></li>';
        }

        if ($pageNo <= $paginationPageDisplay) {
            $uptoPage = (($paginationPageDisplay * 2)+1);
            $fromPage = ($pageNo - $paginationPageDisplay);
        }else if ($pageNo >= ($total_pages - $paginationPageDisplay)) {
            $uptoPage = $total_pages;
            $fromPage = ($total_pages - ($paginationPageDisplay * 2));
        }else{
            $uptoPage = ($pageNo + $paginationPageDisplay);
            $fromPage = ($pageNo - $paginationPageDisplay);
        }

        for ($i = max(1, $fromPage); $i <= min($uptoPage, $total_pages); $i++){
            if ($pageNo == $i) {
                $classNm = ' class="active"';
            }else{
                $classNm = '';
            }
            $pagLink .= '<li'.$classNm.'><a href="javascript:void(0)" onClick="sortData(\''.url($section).'/'.$i.$additionalUrl.'\')">'.$i.'</a></li>';
        }

        if ($pageNo < ($total_pages - $paginationPageDisplay)) {
            $pagLink .= '<li><span>...</span></li><li><a href="javascript:void(0)" onClick="sortData(\''.url($section).'/'.$total_pages.$additionalUrl.'\')">'.$total_pages.'</a></li>';
        }

        if($total_pages > 0){
            $pagLink .= '<li'.$disabledClassNxt.'>'.$urlNxt.'</li>';
        }

        $pagLink .= '</ul>';

        return $pagLink;
    }


    function findKey($array, $keySearch){
        foreach ($array as $key => $item) {
            if ($key == $keySearch) {
                return true;
            } elseif (is_array($item) && findKey($item, $keySearch)) {
                return true;
            }
        }
        return false;
    }

    /*
     * Function Name: getCompanyDetails
     * Defination: It will provide the company details
     * @param: sting userId
     * @return: HTML menu
     */
    function getCompanyDetails($id = ''){

        $data = \DB::table('company_master')
                ->where('i_id', '=', $id)
                ->get();

        if($data[0]->s_logo == ''){
            $data[0]->s_logo = 'public/images/evans.png';
        }
        return $data[0];
    }


	if( ! function_exists( 'get_class_name' ) )
	{
		function get_class_name($this_class)
		{
			return $class = strtolower( explode('Controller',((new \ReflectionClass($this_class))->getShortName()))[0] );
		//echo $className = class_basename(get_class());
		}
	}


    if( ! function_exists( 'base_url' ) )
    {
        function base_url( $url = '' )
        {
            $uri = url('/');
            if( $url )
            {
                if( substr($url, -1) != '/' )
                {
                    $url .= '/';
                }
                if( substr($url, 0, 1) != '/' )
                {
                    $url = '/'.$url;
                }

                $uri .= $url;
            }
            else
            {
                $uri .= '/';
            }


            return $uri;
        }
    }


    /***** Function to compare string ******/
    if( ! function_exists( 'my_receive_txt' ) )
    {
        function my_receive_txt($str)
        {
            return addslashes(trim($str));
        }
    }


    /***** Function to show string ******/
    if( ! function_exists( 'my_show_txt' ) )
    {
        function my_show_txt($str, $is_html = FALSE)
        {
            //return ($is_html) ? stripslashes(trim($str)) : htmlspecialchars(stripslashes(trim($str)),ENT_NOQUOTES);
            return ($is_html) ? stripslashes(trim($str)) : stripslashes(trim($str));
        }
    }


    /***
    * Encryption double ways.
    * @param string $s_var
    * @return string
    */
    if( ! function_exists( 'encrypt_data' ) )
    {
        function encrypt_data( $s_var )
        {
            $ret_ = '';

            if( $s_var )
            {
                $ret_=$s_var."#concertium";///Hardcodded here for security reasons
                $ret_=base64_encode(base64_encode($ret_));
                unset($s_var);
            }
            return $ret_;

        }
    }


    /**
    * Decryption double ways.
    *
    * @param string $s_var
    * @return string
    */
    if( ! function_exists( 'decrypt_data' ) )
    {
        function decrypt_data($s_var)
        {
            try{
                $ret_ = '';

                if( $s_var )
                {
                    $ret_=base64_decode(base64_decode($s_var));
                    $ret_=str_replace("#shieldwatch","",$ret_);
                }
                unset($s_var);
                return $ret_;
            }
            catch(Exception $err_obj){
                show_error($err_obj->getMessage());
            }
        }
    }


    /*
     * Function Name: getuserDetail
     * Defination: get user detail data.
     * @param: id
     * @return: vehicle Name
     */
    function getUserDetail( $id = '' )
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

        $whereRaw = '1 ';

        if ($id != '') {
            $whereRaw .= ' AND i_user_id = '.$id;
        }

        $data = \DB::table( $table )
                ->select( \DB::raw( 'i_user_id,  CONCAT_WS(" ", s_first_name, s_last_name) As s_name, s_phone_no, s_email, s_username' ) )
                ->whereRaw( $whereRaw )
                ->get();

        return $data[0];
    }


    /*
     * Function Name: getUserDetailByCode
     * Defination: get user detail data by User code.
     * @param: code
     */
    function getUserDetailByCode( $code = '' )
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

        $whereRaw = '1 ';

        if ($code != '') {
            $whereRaw .= ' AND s_username = "'.$code.'"';
        }

        $data = \DB::table( $table )
                ->select( \DB::raw( 'i_user_id,  CONCAT_WS(" ", s_first_name, s_last_name) As s_name, s_phone_no, s_email, s_username' ) )
                ->whereRaw( $whereRaw )
                ->get();

        return $data[0];
    }

	/*
     * Function Name: getUserDetailByCode
     * Defination: get user detail data by User code.
     * @param: code
     */
    function getUserAllDetailByCode( $code = '' )
    {
        $table  = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $table2 = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );

        $whereRaw = ' tbl_2.i_is_active = 1 ';
		$ret = false;

        if ($code != '')
		{
            $whereRaw .= ' AND tbl_1.s_username LIKE "'.$code.'"';

			$data = \DB::table( $table.' As tbl_1' )
					->join($table2.' As tbl_2','tbl_2.i_id','tbl_1.i_office_id')
					->select( \DB::raw( 'tbl_1.*, CONCAT_WS(" ", tbl_1.s_first_name, tbl_1.s_last_name) As s_name, tbl_2.s_office_code, tbl_2.s_office_name' ) )
					->whereRaw( $whereRaw )
					->get();

			if(count($data) > 0)
				$ret = $data[0];
			else
				$ret = false;
		}
		return $ret;
    }


    /*
     * Function Name: generatePassword
     * Defination: get nothing.
     * @param: ''
     * @return: formatedPassword
     */
    function generatePassword( )
    {
        $capitalLater   = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $smalllLater    = 'abcdefghjkmnpqrstuvwxyz';
        $numericChar    = '123456789';
        $specialChar    = '#@!&$';
        $alphabet       = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789';

        $pass  = '';

        $pass .= $capitalLater[rand( 0, ( strlen( $capitalLater ) - 1 ) )];
        $pass .= $smalllLater[rand( 0, ( strlen( $smalllLater ) - 1 ) )];
        $pass .= $numericChar[rand( 0, ( strlen( $numericChar ) - 1 ) )];
        $pass .= $specialChar[rand( 0, ( strlen( $specialChar ) - 1 ) )];

        for( $i = 0; $i < 4; $i++ )
        {
            $pass .= $alphabet[rand( 0, ( strlen( $alphabet ) - 1 ) )];
        }

        $pass = str_shuffle( $pass );

        return $pass; //turn the array into a string
    }


    function sendPushNotification($uid, $role, $titleText, $bodyText, $extraData = '', $toWhere = '', $toId = ''){

        if ($role == 'customer'){
            $getUserDetails = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.CUSTOMER_TABLE'))->where('i_id', $uid)->get();
        }else{
            $getUserDetails = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE'))->where('i_user_id', $uid)->get();
        }


        $json_data = [
            "notification" => [
                "body" => $bodyText,
                "title" => $titleText
            ],
            "data" => [
                $extraData
            ]
        ];

        $data = json_encode($json_data);

        if ($toWhere == 'customer'){
            $getUserIds = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.CUSTOMER_TABLE'))->select('i_id AS i_user_id')->where('i_id', $toId)->get();
        }else{
            $getUserIds = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE'))->where('s_role_key', $toWhere)->get();
        }

        foreach ($getUserIds as $key => $value) {
            $insrtArr = array(
                            'i_user_id' => $uid,
                            's_user_role' => $role,
                            's_push_text' => $data,
                            'dt_push_date' => date('Y-m-d H:i:s'),
                            's_to' => $toWhere,
                            'i_to_id' => $value->i_user_id
                        );
            $insertPustToTable = DB::table('notifications')->where('i_user_id', $uid)->insert($insrtArr);
        }

    }


    function notificationDetails($toWhom){

        $getPushDetails = DB::table('notifications')
                                ->where('i_to_id', $toWhom)
                                ->orderBy('dt_push_date', 'DESC')
                                ->offset(0)
                                ->limit(5)
                                ->get();

        $getPushCount = DB::table('notifications')
                                ->where('i_to_id', $toWhom)
                                ->where('i_is_read', 0)
                                ->count();

        return array('pushD' => $getPushDetails, 'pushC' => $getPushCount);
    }


    function time_ago_in_php($timestamp){

        $time_ago        = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;

        $minutes = round($seconds / 60); // value 60 is seconds
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
        $weeks   = round($seconds / 604800); // 7*24*60*60;
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

        if ($seconds <= 60){
            return "Just Now";
        } else if ($minutes <= 60){
            if ($minutes == 1){
                return "one minute ago";
            }else{
                return "$minutes minutes ago";
            }
        }else if ($hours <= 24){
            if ($hours == 1){
                return "An hour ago";
            }else {
                return "$hours hrs ago";
            }
        }else if ($days <= 2){
            if ($days == 1){
                return "Yesterday";
            }else {
                return "$days days ago";
            }
        }else{
            return date('m-d-Y H:i', strtotime(($timestamp)));
        }
    }


    function pr( $arr = [], $exit = 0 )
    {
        if( is_array( $arr ) )
        {
            echo "<pre>";
            print_r( $arr );
            echo "</pre>";
            if( $exit ){ exit; }
        }
    }

    function makeThumbnails($updir, $img, $isAws = 1)
    {
        $thumbnail_width = 270;
        $thumbnail_height = 244;
        $thumb_beforeword = "thumb";

        if(@getimagesize("$updir" . urlencode($img))){
            $arr_image_details = getimagesize("$updir" . urlencode($img));
        }else{
            return "";
        }
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = intval($original_height * $new_width / $original_width);
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * $new_height / $original_height);
        }
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == IMAGETYPE_GIF) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == IMAGETYPE_JPEG) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == IMAGETYPE_PNG) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom("$updir" . urlencode($img));
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            $backgroundColor = imagecolorallocate($new_image, 255, 255, 255);
            imagefill($new_image, 0, 0, $backgroundColor);
            imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);

            if ($isAws == '1') {
                $imgt($new_image, "$updir" . "$thumb_beforeword" ."_". "$img");
                return "$updir" . "$thumb_beforeword" ."_". "$img";
            }else{
                $newFielName = tempnam(null, null);

                $imgt($new_image, $newFielName);
                \Storage::disk('s3')->put(str_replace(env('RESOURCE_URL').'/', '', $updir).$thumb_beforeword."_".$img, fopen($newFielName, 'r+'), 'public');
                unlink($newFielName);
                return str_replace(env('RESOURCE_URL').'/', '', $updir). "$thumb_beforeword" ."_". "$img";
            }
        }
    }


	function getThumbImagePathFromFullImagePath($fullImagePath = ''){
		$thumbImagePath = '';
		if($fullImagePath != '')
		{
			$fullImagePathArr = explode('/',$fullImagePath);
		}
		$thumbImagePathArr[0] = $fullImagePathArr[0];
		$thumbImagePathArr[1] = $fullImagePathArr[1];
		$thumbImagePathArr[2] = $fullImagePathArr[2];
		$thumbImagePathArr[3] = 'thumb';
		$thumbImagePathArr[4] = $fullImagePathArr[3];
        $thumbImagePath = implode('/',$thumbImagePathArr);
        return $thumbImagePath;
    }

    function array_sortArr($array, $on, $order='SORT_ASC'){

        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case 'SORT_ASC':
                    asort($sortable_array);
                    break;
                case 'SORT_DESC':
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[] = $array[$k];
            }
        }

        return $new_array;
    }


    function whatever($array, $key, $val) {
        foreach ($array as $item)
            if (isset($item[$key]) && $item[$key] == $val)
                return true;
        return false;
    }


    function getIndianCurrencyInWord($number){
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ucwords(($Rupees ? $Rupees . 'Rupees ' : '') . $paise);
    }


    function fixArrayKey($arr){
		$arr = array_combine(
			array_map(
				function ($str) {
					return str_replace(" ", "", $str);
				},
				array_keys($arr)
			),
			array_values($arr)
		);

		foreach ($arr as $key => $val) {
			if (is_array($val)) {
				fixArrayKey($arr[$key]);
			}
		}

        return $arr;
	}


   function checkPasswordExpiryPortal($userId) {

        $users = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $getUserData = DB::table($users)->where([
                                                        ['i_user_id', '=', $userId]
                                                    ])->get()[0];

        $user_arr = [];
        $user_arr['is_first_time'] =  (($getUserData->dt_last_pw_changed == '' || $getUserData->dt_last_pw_changed == NULL)?1:((strtotime($getUserData->dt_last_pw_changed) < strtotime('-30 days'))?1:0));
        $user_arr['msg_to_disp'] =  (($getUserData->dt_last_pw_changed == '' || $getUserData->dt_last_pw_changed == NULL)?'Kindly Set your new password here.':((strtotime($getUserData->dt_last_pw_changed) < strtotime('-30 days'))?'Your password has expired! Please Change your password here.':''));

        $user_arr['last_password_change_date'] =  $getUserData->dt_last_pw_changed;

        $responseArr['status'] = 'success';
        $responseArr['user_info'] = $user_arr;

        return $responseArr;
    }


	function getAppWiseDBConnection($app_alias_name)
	{
		$connectionName 	= '';
		$application_arr 	= config( 'constants.APPLICATION_NAME' );

        switch ($app_alias_name) {
            case "collection":
                $connectionName = $application_arr['collection'];//'mysql_collection';
                break;
            case "los":
                $connectionName = $application_arr['los']; //'mysql_los';
                break;
            case "apna-bazar":
                $connectionName = $application_arr['apna-bazar']; //'Rejected';
                break;
            default:
                $connectionName = $application_arr['default']; //mysql
        }
        return $connectionName;
	}


	/*
     * Function Name: getGroupCountByCenterCode
     * Defination: get group count by Center code.
     * @param: code
     */
    function getGroupCountByCenterCode( $code = '' )
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.DAILY_COLLECTION_DATA_FIS' );

        $whereRaw = '1 ';

        if ($code != '') {
            $whereRaw .= ' AND s_center_code = "'.$code.'"';
			$data = \DB::table( $table )
                ->select( \DB::raw( 'i_id' ) )
                ->whereRaw( $whereRaw )
				->groupBy('s_group_code')
                ->get()
                ->toArray();

        return count($data);
		}
		else
		{
			return '0';
		}
    }


	/*
     * Function Name: validateDate
     * Defination: Return true if date is valid as format or false.
     * @param: date, format
     */
	function validateDate($date, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
		return $d && $d->format($format) === $date;
	}


    /**
     *  Get Master Districts
     *  @param: $id
     *  @return: district list
     */
    function get_master_districts_data($id = '')
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_DISTRICT' );

        $query = \DB::table( $table )
                    ->select('i_id','s_district_name','i_state_id');

        if( !empty($id) ) {
            $query = $query->where('i_id', $id );
        }else{
            $query = $query->where('i_is_active', 1 );
        }

        $query = $query->orderBy('s_district_name')
                    ->get();

        return $query;
    }


    /**
     *  Get Master Districs Name
     *  @param: $id
     *  @return: s_district_name ( Blank- for not found)
     */
    function get_master_districts_name($id = '')
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_DISTRICT' );

        $response = '';
        if( !empty($id) ) {
            $query = \DB::table( $table )
                        ->select('i_id','s_district_name')
                        ->where('i_id', $id )
                        ->first();
            if($query){
                $response = $query->s_district_name;
            }
        }
        return $response;
    }


    /**
     *  Function Name: getDistrictListDD
     *  Defination: It's generate the District drop down dynamically and return the string <option>.
     *  If the selected ID is provided then it will mark as selected that.
     *
     *  @param: (string) $selected_ids (list with comma separated)
     *  @return: string drop down list
     */
    function getDistrictListDD($stateId=0, $selected_ids = '' )
    {
        $districts = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_DISTRICT' );

        $whereRawFilter = ' `i_is_active` = 1 ';
        if (!empty($stateId)) {
            $whereRawFilter .= " AND `i_state_id` = ".$stateId;
        }

        $data = DB::table($districts)
                ->select(\DB::raw('i_id, s_district_name, i_state_id'))
                ->whereRaw($whereRawFilter)
                ->orderBy('s_district_name', 'ASC')
                ->get();

        $str = "";
        if($data->count()){
            foreach( $data as $row_id=>$val ){
                $selected = in_array( $val->i_id, explode( ',', $selected_ids ) ) ? 'selected' : '';
                $str .= '<option value="'.$val->i_id.'" role-key-data="'.$val->i_id.'" '.$selected.'>'. $val->s_district_name.'</option>';
            }
        }
        return $str;
    }


    /*
     * Function Name: getStateDD
     * Defination: It's generate the State drop down dynamically and return the string <option>. If the selected ID is provided then it will selected the the role
     * @param: sting id list with comma separated
     * @return: string drop down list
     */
    function getStateDD( $id = '' ){
        $data = getStateData();
        $str = "";
        if(!empty( $data ))
        {
            foreach( $data as $row_id=>$val )
            {
                $selected = in_array( $row_id, explode( ',', $id ) ) ? 'selected' : '';
                $str .= '<option value="'.$row_id.'" role-key-data="'.$row_id.'" '.$selected.'>'. my_show_txt( $val ) .'</option>';
            }
        }
        return $str;
    }


    function getStateData( $id = '' ){
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.STATES_TABLE' );
        $table1 = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );

        if($id != '0'){
            if ( $id != '' ) {
                $whereRaw = 'i_id = '.$id;
            }else{
                $whereRaw = '1';
            }
            $data = \DB::table( $table )
                    ->select( \DB::raw( 'i_id,  s_name' ) )
                    ->whereRaw( $whereRaw )
                    ->orderBy( 's_name','asc' )
                    ->get();
        }else{
            $data = \DB::table( $table )
                    ->select( \DB::raw( $table.'.i_id,  '.$table.'.s_name' ) )
                    ->join($table1, $table1.'.i_state_id', $table.'.i_id')
                    ->where([[$table1.'.i_is_active', '=', 1],
                            [$table1.'.e_office_type', '=', 'REGIONAL']])
                    ->orderBy( $table.'.s_name','asc' )
                    ->get();
        }

        $ret = array();
        if(!empty($data))
        {
            foreach($data as $val)
            {
                $ret[$val->i_id] = $val->s_name;
            }
        }
        return $ret;
    }


    function getOfficeLocationDD( $office_type = '', $id = '', $parent_id='' )
	{
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );

         $whereRaw = '1';

        if(is_array($office_type))
		 {
			 if ( !empty($office_type)) {
				 $office_type_text = implode('","',$office_type);
				$whereRaw .= ' AND e_office_type IN( "'.$office_type_text.'" )';
			}
		 }
		 else
		 {
			 if ( $office_type != '' ) {
				$whereRaw .= ' AND e_office_type = "'.$office_type.'"';
			}
		 }

        if ( $parent_id != '' ) {
            $whereRaw .= ' AND i_parent_id = "'.$parent_id.'"';
        }
        $data = \DB::table( $table )
                ->select( \DB::raw( 'i_id,  s_office_name, s_office_code' ) )
                ->whereRaw( $whereRaw )
                ->orderBy( 's_office_name','asc' )
                ->get();

        $ret = array();
        if(!empty($data))
        {
            foreach($data as $val)
            {
                $ret[$val->i_id] = $val->s_office_name;
            }
        }
        $office_data = $ret;
        $str = "";
        if(!empty( $office_data ))
        {
            foreach( $office_data as $row_id=>$val )
            {
                $selected = in_array( $row_id, explode( ',', $id ) ) ? 'selected' : '';
                $str .= '<option value="'.$row_id.'" role-key-data="'.$row_id.'" '.$selected.'>'. my_show_txt( $val ) .'</option>';
            }
        }
        return $str;
    }


    function getOfficeLocationDDWithCode( $office_type = '', $id = '', $parent_id='' )
	{
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );

         $whereRaw = '1';

        if(is_array($office_type))
		 {
			 if ( !empty($office_type)) {
				 $office_type_text = implode('","',$office_type);
				$whereRaw .= ' AND e_office_type IN( "'.$office_type_text.'" )';
			}
		 }
		 else
		 {
			 if ( $office_type != '' ) {
				$whereRaw .= ' AND e_office_type = "'.$office_type.'"';
			}
		 }

        if ( $parent_id != '' ) {
            $whereRaw .= ' AND i_parent_id = "'.$parent_id.'"';
        }
        $data = \DB::table( $table )
                ->select( \DB::raw( 'i_id,  s_office_name, s_office_code' ) )
                ->whereRaw( $whereRaw )
                ->orderBy( 's_office_name','asc' )
                ->get();

        $ret = array();
        if(!empty($data))
        {
            foreach($data as $val)
            {
                $ret[$val->i_id] = $val->s_office_name.' ('.$val->s_office_code.')';
            }
        }
        $office_data = $ret;
        $str = "";
        if(!empty( $office_data ))
        {
            foreach( $office_data as $row_id=>$val )
            {
                $selected = in_array( $row_id, explode( ',', $id ) ) ? 'selected' : '';
                $str .= '<option value="'.$row_id.'" role-key-data="'.$row_id.'" '.$selected.'>'. my_show_txt( $val ) .'</option>';
            }
        }
        return $str;
    }


    function getOfficeDetails($id = '', $type = ''){

        if ($id != '') {
            $getDetails = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION'))
                            ->where('i_id', $id)
                            ->get();

            return $getDetails[0];
        }else{
            $getDetails = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION'))
                            ->where('i_is_active', 1)
                            ->where('e_office_type', $type)
                            ->orderBy('s_office_name', 'ASC')
                            ->get();

            return $getDetails;
        }
    }


	/*
     * Function Name: getApplicationDetails
     * Defination: It will provide the application details
     * @param: sting alias name
     * @return: Application Details
     */
    function getApplicationDetails($alias_name = ''){
		$MasetrDbConnection = DB::connection('mysql');
        $data = $MasetrDbConnection->table('master_applications')
                ->where('s_application_alias_name', '=', $alias_name)
                ->get();

        return $data[0];
	}


    /**
     *  Get CSR List
     *  @param, $code (optional)
     *  @return, csr list (array)
     *  @example: [ username1 => name, username1 => name ]
     */
    function getCsrData($code = ''){
        $tbl_user       = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $tbl_user_roles = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_ROLES' );

        $whereRaw = "1 ";
        if ($code != '') {
            $whereRaw .= ' AND s_username = '.$code;
        }

        $data = \DB::table( $tbl_user.' as user' )
                ->selectRaw('user.s_username,  CONCAT_WS(" ", user.s_first_name, user.s_last_name) As s_name')
                ->join($tbl_user_roles.' as user_role', 'user.i_user_id', 'user_role.i_user_id')
                ->whereRaw( $whereRaw )
                ->where('user.e_is_delete', 'No')
                ->where('user.i_is_active', 1)
                ->where('user_role.s_role_key', 'csr')
                ->where('user_role.i_is_active', 1)
                ->orderBy( 's_name','asc' )
                ->get();

        $response = array();
        if($data->count()) {
            foreach($data as $val) {
                $response[$val->s_username] = $val->s_name;
            }
        }
        return $response;
    }

    /**
     *  Get CSR Dropdown Option
     *  @param, $code (optional, to mark selected option )
     *  @return, dropdown options (string)
     */
    function getCsrDD($code = ''){
        $data = getCsrData();

        $str = "";
        if(!empty( $data )){
            foreach( $data as $row_id=>$val ) {
                $selected =  ($row_id == $code) ? 'selected' : '' ;
                $str .= '<option value="'.$row_id.'" '.$selected.'>'. $val .' ('.$row_id.')</option>';
            }
        }
        echo $str;
    }


	/*
     * Function Name: getCSRCodeByCOGL
     * Defination: get CSR CODE by COGL code.
     * @param: COGL CODE
     * @return: CSR CODE
     */
    function getCSRCodeByCOGL( $cogl_code = '' )
    {
        $table 		= config( 'app.CUSTOM_CONFIG.DB_TABLES.CSR_COGL_BRANCH' );
        $csr_code 	= 0;

		if( $cogl_code != '' && strlen($cogl_code) > 5 )
		{
			$cogl_no 		= substr($cogl_code,0,1);
			$branch_code 	= substr($cogl_code,1);

            $whereRaw = ' s_branch_code = "'.$branch_code.'" AND i_cogl_code = '.$cogl_no.' AND i_is_active = 1 ';
			$con  = DB::connection('mysql_collection');
			$data = $con->table( $table )
					->select( $con->raw( 's_csr_code, s_branch_code' ) )
					->whereRaw( $whereRaw )
					->get()
					->toArray();

			if( is_array($data) && !empty($data) && count($data) > 0 )
			{
				if( count($data) > 1 )
				{
					$same_flag = 1;
					$csr 		= $data[0]->s_csr_code;
					foreach( $data As $d ){
						if( $d->s_csr_code != $csr )
							$same_flag = 0;
					}

					if($same_flag == 1)
						$csr_code = ['0'=>$data[0]];
					else
						$csr_code = $data;
				}
				else
					$csr_code = $data;
			}
			else
				$csr_code = 0;
		}

		return $csr_code;
    }


	/*
     * Function Name: getOfficeDetailsByCode
     * Defination: get details by office code.
     * @param: office code
     * @return: ROW DETAILS
     */
	function getOfficeDetailsByCode($code = '')
	{
		$getDetails = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION'))
								->where('s_office_code', $code)
								->get();
		return $getDetails[0];
	}


	/*
     * Function Name: getCSRListByBranch
     * Defination: get CSR LIST by BRANCH code.
     * @param: BRANCH CODE
     * @return: CSR LIST
     */
    function getCSRListByBranch( $branch_code = '' )
    {
        $table 		= config( 'app.CUSTOM_CONFIG.DB_TABLES.CSR_COGL_BRANCH' );
        $tableUser 	= config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $ret 	= [];

		if( $branch_code != '' )
		{
            $whereRaw = $table.'.s_branch_code = "'.$branch_code.'" AND '.$table.'.s_csr_code != "" AND '.$table.'.i_is_active = 1 AND '.$tableUser.'.i_is_active = 1 AND '.$tableUser.'.e_is_delete = "No" ';
			$con  = DB::connection('mysql_collection');
			$data = $con->table( $table )
					->join($tableUser,$table.'.s_csr_code', $tableUser.'.s_username' )
					->select( $con->raw( 'CONCAT('.$tableUser.'.s_first_name," ",(IF('.$tableUser.'.s_last_name!="",'.$tableUser.'.s_last_name,""))," (",'.$table.'.s_csr_code,")" ) As csr_name,'.$table.'.s_csr_code' ))
					->whereRaw( $whereRaw )
					->orderBy('csr_name','ASC')
					->get()
					->toArray();

			if( is_array($data) && !empty($data) && count($data) > 0 )
			{
				foreach( $data As $d ){
					$ret[$d->s_csr_code] = $d->csr_name;
				}
			}
		}
		return $ret;
    }


	/*
     * Function Name: getCSRListByBranch
     * Defination: get CSR LIST by BRANCH code.
     * @param: BRANCH CODE
     * @return: CSR LIST
     */
    function getCSRListByCOGL( $cogl_code = '' )
    {
        $table 	= config( 'app.CUSTOM_CONFIG.DB_TABLES.CSR_COGL_BRANCH' );
        $tableUser 	= config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $ret 	= [];

		if( $cogl_code != '' )
		{
			if( strlen($cogl_code) > 5 )
			{
				$cogl_id = substr($cogl_code,0,1);
				$branch_code = substr($cogl_code,1);
				//$whereRaw = 's_branch_code = "'.$branch_code.'" AND i_cogl_code = "'.$cogl_id.'" AND s_csr_code != "" AND i_is_active = 1 ';
				$whereRaw = $table.'.s_branch_code = "'.$branch_code.'"  AND '.$table.'.i_cogl_code = "'.$cogl_id.'" AND '.$table.'.s_csr_code != "" AND '.$table.'.i_is_active = 1 AND '.$tableUser.'.i_is_active = 1 AND '.$tableUser.'.e_is_delete = "No" ';
			}else{
				$branch_code = substr($cogl_code,1);
				//$whereRaw = 's_branch_code = "'.$branch_code.'" AND s_csr_code != "" AND i_is_active = 1 ';
				$whereRaw = $table.'.s_branch_code = "'.$branch_code.'" AND '.$table.'.s_csr_code != "" AND '.$table.'.i_is_active = 1 AND '.$tableUser.'.i_is_active = 1 AND '.$tableUser.'.e_is_delete = "No" ';
			}

			$con  = DB::connection('mysql_collection');
			$data = $con->table( $table )
					->join($tableUser,$table.'.s_csr_code', $tableUser.'.s_username' )
					->select( $con->raw( 'CONCAT('.$tableUser.'.s_first_name," ",(IF('.$tableUser.'.s_last_name!="",'.$tableUser.'.s_last_name,""))," (",'.$table.'.s_csr_code,")" ) As csr_name,'.$table.'.s_csr_code' ))
					->whereRaw( $whereRaw )
					->orderBy('csr_name','ASC')
					->get()
					->toArray();

			if( is_array($data) && !empty($data) && count($data) > 0 )
			{
				foreach( $data As $d ){
					$ret[$d->s_csr_code] = $d->csr_name;
				}
			}
		}
		return $ret;
    }

	/*
     * Function Name: getCSRListByBranch
     * Defination: get CSR LIST by BRANCH code.
     * @param: BRANCH CODE
     * @return: CSR LIST
     */
    function getOfficeDetailsByUserID( $user_id = 0 )
	{
		$ret = [];
		if( $user_id )
		{
			$table_1 = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );
			$table_2 = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );

			$data = DB::table( $table_2 )
						->select($table_2.'.*')
						->leftJoin($table_1,$table_1.'.i_office_id',$table_2.'.i_id')
						->where( $table_1.'.i_is_active','=','1' )
						->where( $table_2.'.i_is_active','=','1' )
						->where( $table_1.'.i_user_id','=',$user_id )
						->orderBy($table_2.'.s_office_name','ASC')
						->get()
						->toArray();
			if( is_array($data) && !empty($data) && count($data) > 0 )
			{
				$ret = $data;
			}
		}
		return $ret;
	}

    /* Get State name by state id */
    function getStateById($stateId){
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.STATES_TABLE' );
        $whereRaw = '1 ';

        if ($stateId != '') {
            $whereRaw .= ' AND i_id = '.$stateId;
        }

        $data = \DB::table( $table )
                ->select( \DB::raw( 's_name' ) )
                ->whereRaw( $whereRaw )
                ->get();

        $res = '';
        if(!empty($data))
            {
                foreach( $data As $d ){
                    $res .= $d->s_name;
                }
            }
        return $res;
    }

    /* Get Designation name by id */
    function getDesignationById($designationId){
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.DESIGNATION_MASTER' );
        $whereRaw = '1 ';

        if ($designationId != '') {
            $whereRaw .= ' AND i_dsgn_id = '.$designationId;
        }

        $data = \DB::table( $table )
                ->select( \DB::raw( 's_designation' ) )
                ->whereRaw( $whereRaw )
                ->get();

        $res = '';
        if( !empty($data) )
            {
                foreach( $data As $d ){
                    $res = $d->s_designation;
                }
            }
        return $res;
    }

    function getOfficeDetailsFromUserID($user_id = ''){
        $location_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $user_office_location_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        if ($user_id != '') {

        $sql = "SELECT ofc1.s_office_name AS Branch_name, ofc1.i_id AS Branch_id, ofc1.s_office_code AS Branch_code, ofc2.s_office_name AS Region_name , ofc2.i_id AS Region_id, ofc2.s_office_code AS Region_code, ofc3.s_office_name AS Zonal_name, ofc3.i_id AS Zonal_id, ofc3.s_office_code AS Zonal_code
                FROM ".$location_table." AS ofc1
                INNER JOIN  ".$location_table." AS ofc2 ON ofc1.i_parent_id = ofc2.i_id
                INNER JOIN  ".$location_table." AS ofc3 ON ofc2.i_parent_id = ofc3.i_id
                INNER JOIN  ".$location_table." AS ofc4 ON ofc4.i_parent_id = 0
                LEFT JOIN ".$user_office_location_table." AS u ON u.i_office_id = ofc1.i_id
                WHERE u.i_user_id = ".$user_id." AND u.i_is_active = 1  GROUP BY ofc1.i_id";

        $getDetails = DB::select($sql);
        if(!empty($getDetails))
        {
            return $getDetails[0];
        }
        else{
            return false;
        }
        }else{

            return false;
        }
    }


    function getStateCode( $id = '' ){
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.STATES' );

        $whereRaw = 'i_id = '.$id;

        $data = \DB::table( $table )
                ->select( \DB::raw( 'i_id,  s_code' ) )
                ->whereRaw( $whereRaw )
                ->orderBy( 's_name','asc' )
                ->get();

        $ret = array();
        if(!empty($data))
        {
            foreach($data as $val)
            {
                $ret[$val->i_id] = $val->s_code;
            }
        }
        return $ret;
    }

    function getCBDetails($headerArr, $resultAcknldgmnt){
        sleep(1);
        $reportId = $resultAcknldgmnt['INQUIRY-STATUS']['INQUIRY']['REPORT-ID'];
        $generateXMLWithReportId = '<?xml version="1.0" encoding="UTF-8"?>
                    <REQUEST-REQUEST-FILE>
                      <HEADER-SEGMENT>
                        <SUB-MBR-ID>AROHAN</SUB-MBR-ID>
                        <INQ-DT-TM>'.date('d-m-Y').'</INQ-DT-TM>
                        <REQ-VOL-TYP>C01</REQ-VOL-TYP>
                        <REQ-ACTN-TYP>AT02</REQ-ACTN-TYP>
                        <TEST-FLG>Y</TEST-FLG>
                        <AUTH-FLG>Y</AUTH-FLG>
                        <AUTH-TITLE>USER</AUTH-TITLE>
                        <RES-FRMT>XML/HTML</RES-FRMT>
                        <MEMBER-PRE-OVERRIDE>N</MEMBER-PRE-OVERRIDE>
                        <RES-FRMT-EMBD>Y</RES-FRMT-EMBD>
                      </HEADER-SEGMENT>
                      <INQUIRY>
                        <INQUIRY-UNIQUE-REF-NO>116f000026EGk2342</INQUIRY-UNIQUE-REF-NO>
                        <REQUEST-DT-TM>'.date('d-m-Y H:i:s').'</REQUEST-DT-TM>
                        <REPORT-ID>'.$reportId.'</REPORT-ID>
                      </INQUIRY>
                    </REQUEST-REQUEST-FILE>';

        $url = config( 'app.CUSTOM_CONFIG.CBCHECKURL.URL' );;

        // Initialize a CURL session.
        $ch1 = curl_init();

        $headerArrFnl2 = [];
        $headerArrFnl2 = $headerArr;
        $headerArrFnl2[] = 'requestxml:'.$generateXMLWithReportId;
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headerArrFnl2);

        // Return Page contents.
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

        //grab URL and pass it to the variable.
        curl_setopt($ch1, CURLOPT_URL, $url);
        curl_setopt($ch1, CURLOPT_POST, 1);

        $resultAcknldgmntFinalTemp = curl_exec($ch1);

        $resultAcknldgmntFinalTempNew = simplexml_load_string($resultAcknldgmntFinalTemp);

        $jsonFinal = json_encode($resultAcknldgmntFinalTempNew);
        $resultAcknldgmntFinalTempNew = json_decode($jsonFinal, TRUE);

        if(array_key_exists('INQUIRY-STATUS', $resultAcknldgmntFinalTempNew)){
            if (strtolower($resultAcknldgmntFinalTempNew['INQUIRY-STATUS']['INQUIRY']['RESPONSE-TYPE']) == strtolower('INPROCESS')) {
                return getCBDetails($headerArr, $resultAcknldgmnt);
            }else{
                $xml = new \SimpleXMLElement($resultAcknldgmntFinalTemp);
                $queryResult = $xml->xpath('//INDV-REPORTS/INDV-REPORT/PRINTABLE-REPORT/CONTENT');
                $resultAcknldgmntFinalTempNew['printContent'] = htmlentities($resultAcknldgmntFinalTemp);
                return $resultAcknldgmntFinalTempNew;
            }
        }else{
            $xml = new \SimpleXMLElement($resultAcknldgmntFinalTemp);
            $queryResult = $xml->xpath('//INDV-REPORTS/INDV-REPORT/PRINTABLE-REPORT/CONTENT');
            $resultAcknldgmntFinalTempNew['printContent'] = htmlentities($resultAcknldgmntFinalTemp);
            return $resultAcknldgmntFinalTempNew;
        }
    }

    function sendSms($to = '', $msg = ''){

        $url = 'https://http.myvfirst.com/smpp/sendsms?username=arohanfinserv&password=arohan123&to='.$to.'&udh=0&from=AROHAN&text='.urlencode($msg);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);

        $returnMsg = curl_exec($ch);

        return $returnMsg;
    }

    /* Loan Activity list code */
    function getLoanActivityLists()
    {
        $table      = config( 'app.CUSTOM_CONFIG.DB_TABLES.MASTER_ACTIVITY' );

        $data = \DB::table( $table )
                ->select($table.'.s_activity', $table.'.s_activity_short_code')
                ->where( $table.'.i_is_active','=','1' )
                ->orderBy($table.'.i_sort_order','asc')
                ->get()
                ->toArray();

         $result = [];
        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $data_val)
            {
                $result[$data_val->s_activity_short_code] = $data_val->s_activity;
            }
        }

        return $result;
    }

    function sendToHub($centerCode = '', $groupCode = ''){
        $getCenterDetails = \DB::table('master_center')
                ->where( 's_center_code','=', $centerCode )
                ->get();

        $getCenterCSRDetails = \DB::table('center_csr')
                ->where( 's_center_code','=', $centerCode )
                ->get();

        if(count($getCenterCSRDetails) > 0){
            $csrName = getUserDetailByCode($getCenterCSRDetails[0]->s_csr_code)->s_name;
            $csrCode = $getCenterCSRDetails[0]->s_csr_code;
        }else{
            $csrName = '';
            $csrCode = '';
        }

        $getAllGroupDetails = \DB::table('master_group')
                ->where( 'i_center_id','=', $getCenterDetails[0]->i_center_id)
                ->count();


        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        $numberSuffix = $getCenterDetails[0]->i_week_of_the_month;
        if (($numberSuffix %100) >= 11 && ($numberSuffix%100) <= 13){
           $i_week_of_the_month = $numberSuffix. 'th';
        }else{
           $i_week_of_the_month = $numberSuffix. $ends[$numberSuffix % 10];
        }

        $data = [];
        $data[]['center_info'] = 'C^'.$getCenterDetails[0]->s_center_code.'^'.$getCenterDetails[0]->s_center_name.'^'.$csrName.'^'.$csrCode.'^'.$getCenterDetails[0]->s_branch_name.' ('.$getCenterDetails[0]->s_branch_code.')'.'^"{\'lat\':'.$getCenterDetails[0]->d_center_location_lat.', \'long\':'.$getCenterDetails[0]->d_center_location_lng.'}"^"'.date('h:i a', strtotime($getCenterDetails[0]->s_center_timing)).'-'.date('h:i a', strtotime($getCenterDetails[0]->s_center_timing.' +1 hour')).', '.$i_week_of_the_month.' '.config('constants.MASTER_WEEK_DAYS')[$getCenterDetails[0]->i_day_of_the_week].'"^'.$getAllGroupDetails.'^'.$getCenterDetails[0]->s_frequency.'^'.$getCenterDetails[0]->s_branch_code.'^^'.date('d-m-Y', strtotime($getCenterDetails[0]->dt_created_at)).'^'.$getCenterDetails[0]->s_center_type.'^None^None^None^None^None^None^None^None^None^None^None^None^None^None^None^None^None^None';

        $encodedPostData = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('constants.AROHAN_LINUX_API_URL')."/api/LOSIntegration/Center");
        curl_setopt($ch, CURLOPT_POST, 1);

        // In real life you should use something like:
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedPostData);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        \DB::table('integration_api_log')
            ->insert([
                's_group_code' => $groupCode,
                's_center_code' => $centerCode,
                's_integration_api_type' => 'center',
                's_api_request' => $encodedPostData,
                's_api_response' => $server_output,
                'dt_api_request_date' => date('Y-m-d H:i:s')
            ]);


        $getGroupDetailsByTransId = \DB::table('master_group_los')
                ->where( 's_los_group_code','=', $groupCode)
                ->get();

        $getTransDetail = \DB::table('customer_transactions')
                ->where( 's_center_code','=', $centerCode )
                ->where( 's_group_code','=', $groupCode )
                ->where( 'i_is_active','=','1' )
                ->get();

        $data = [];
        $data[]['group_info'] = 'G^'.$getGroupDetailsByTransId[0]->s_los_group_code.'^'.$getGroupDetailsByTransId[0]->s_group_name.'^'.$csrName.'^'.$getCenterDetails[0]->s_center_name.'^'.$getCenterDetails[0]->s_center_code.'^'.$getCenterDetails[0]->s_branch_name.' ('.$getCenterDetails[0]->s_branch_code.')^'.'"{\'lat\':'.$getCenterDetails[0]->d_center_location_lat.', \'long\':'.$getCenterDetails[0]->d_center_location_lng.'}"^Product Id^'.$getCenterDetails[0]->s_branch_code.'^'.$csrCode.'^'.count($getTransDetail);

        $encodedPostData = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('constants.AROHAN_LINUX_API_URL')."/api/LOSIntegration/Group");
        curl_setopt($ch, CURLOPT_POST, 1);

        // In real life you should use something like:
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedPostData);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        \DB::table('integration_api_log')
            ->insert([
                's_group_code' => $groupCode,
                's_center_code' => $centerCode,
                's_integration_api_type' => 'group',
                's_api_request' => $encodedPostData,
                's_api_response' => $server_output,
                'dt_api_request_date' => date('Y-m-d H:i:s')
            ]);


        $data = [];
        foreach ($getTransDetail as $valueTransDetail) {

            $povertyIndex1 = json_decode(str_replace('\"', '"', str_replace('}"', '}', str_replace('"{', '{', $valueTransDetail->t_poverty_index1))), true);
            $povertyIndex2 = json_decode(str_replace('\"', '"', str_replace('}"', '}', str_replace('"{', '{', $valueTransDetail->t_poverty_index2))), true);

            $riskEvaluation = json_decode(str_replace('\"', '"', str_replace('}"', '}', str_replace('"{', '{', $valueTransDetail->t_risk_evalution))), true);
            $compliance = json_decode(str_replace('\"', '"', str_replace('}"', '}', str_replace('"{', '{', $valueTransDetail->t_compliance))), true);


            $nocDoc = (($valueTransDetail->s_noc_doc_path == '')?'||':$valueTransDetail->s_noc_doc_path);

            $destinationPath = "public/uploads/".$valueTransDetail->s_customer_id."/".$valueTransDetail->s_transaction_id."/cbreports/";
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            file_put_contents($destinationPath."customer_".$valueTransDetail->s_transaction_id.".xml", '<?xml version="1.0"?>'.htmlspecialchars_decode($valueTransDetail->s_cb_report));

            file_put_contents($destinationPath."coborrower_".$valueTransDetail->s_transaction_id.".xml", '<?xml version="1.0"?>'.htmlspecialchars_decode($valueTransDetail->s_coborrower_cb_report));

            $custCbReportUrl = env('APP_URL')."/public/uploads/".$valueTransDetail->s_customer_id."/".$valueTransDetail->s_transaction_id."/cbreports/customer_".$valueTransDetail->s_transaction_id.".xml";


            file_put_contents($destinationPath."coborrower_".$valueTransDetail->s_transaction_id.".xml", '<?xml version="1.0"?>'.htmlspecialchars_decode($valueTransDetail->s_coborrower_cb_report));

            $coborCbReportUrl = env('APP_URL')."/public/uploads/".$valueTransDetail->s_customer_id."/".$valueTransDetail->s_transaction_id."/cbreports/coborrower_".$valueTransDetail->s_transaction_id.".xml";


            $data[]['cust_info'] = 'A^'.$valueTransDetail->s_cb_customer_salutation.' '.$valueTransDetail->s_cb_customer_name.'^'.$valueTransDetail->s_pi_nick_name.'^'.date('d/m/Y', strtotime($valueTransDetail->dt_cb_dob)).'^'.$valueTransDetail->i_cb_age.'^'.(($valueTransDetail->s_pi_customer_gender == 'M')?'Male':(($valueTransDetail->s_pi_customer_gender == 'F')?'Female':'')).'^'.$valueTransDetail->s_cb_father_salutation.' '.$valueTransDetail->s_cb_father_name.'^'.$valueTransDetail->s_cb_mother_salutation.' '.$valueTransDetail->s_cb_mother_name.'^'.$valueTransDetail->s_customer_marital_status.'^'.(($valueTransDetail->s_cb_spouse_name != '')?$valueTransDetail->s_cb_spouse_salutation.' '.$valueTransDetail->s_cb_spouse_name:'').'^'.date('d/m/Y', strtotime($valueTransDetail->dt_pi_spouse_dob)).'^'.$valueTransDetail->i_pi_spouse_age.'^'.$valueTransDetail->s_product_code.'^'.$valueTransDetail->s_product_name.'^'.$valueTransDetail->s_loan_tenure.'^'.$valueTransDetail->s_current_village.'^'.$valueTransDetail->s_mode_of_disbrusement.'^'.$valueTransDetail->s_current_address.'^'.$valueTransDetail->s_current_taluka_block.'^'.$valueTransDetail->s_current_district.'^'.$valueTransDetail->s_current_state.'^'.$valueTransDetail->s_current_landmark.'^"'.$valueTransDetail->s_cb_permanent_address.', '.$valueTransDetail->s_pi_taluka_block.', '.$valueTransDetail->s_pi_village_city.', '.$valueTransDetail->s_cb_district.', '.$valueTransDetail->s_cb_state.', '.$valueTransDetail->s_pi_landmark.', '.$valueTransDetail->i_pi_pin_code.'"^India^'.$valueTransDetail->i_pi_pin_code.'^'.$valueTransDetail->s_pi_police_station.'^None^'.$valueTransDetail->s_customer_mobile_no.'^'.(($valueTransDetail->i_cb_kyc_type2_id == '3')?$valueTransDetail->s_cb_kyc2:'').'^'.$valueTransDetail->s_cb_kyc1.'^'.(($valueTransDetail->i_cb_kyc_type2_id == '4')?$valueTransDetail->s_cb_kyc2:'').'^'.(($valueTransDetail->i_cb_kyc_type2_id == '2')?$valueTransDetail->s_cb_kyc2:'').'^'.(($valueTransDetail->i_cb_kyc_type2_id != '3' && $valueTransDetail->i_cb_kyc_type2_id != '2' && $valueTransDetail->i_cb_kyc_type2_id != '4')?$valueTransDetail->s_cb_kyc_type2:'').'^'.(($valueTransDetail->i_cb_kyc_type2_id != '3' && $valueTransDetail->i_cb_kyc_type2_id != '2' && $valueTransDetail->i_cb_kyc_type2_id != '4')?$valueTransDetail->s_cb_kyc2:'').'^'.$valueTransDetail->s_user_loan_type.'^'.$valueTransDetail->s_center_name.'^'.$valueTransDetail->s_customer_occupation.'^None^None^'.$valueTransDetail->s_religion.'^'.$valueTransDetail->s_category.'^'.$valueTransDetail->s_education.'^'.$valueTransDetail->i_number_of_family_member.'^'.$valueTransDetail->i_male_count.'^'.$valueTransDetail->i_female_count.'^'.$valueTransDetail->i_members_less_than_18.'^'.$valueTransDetail->i_members_above_18.'^'.$valueTransDetail->i_earning_members.'^'.$valueTransDetail->s_type_of_house.'^'.$valueTransDetail->s_quality_of_house.'^'.$valueTransDetail->e_pi_area.'^'.$valueTransDetail->i_house_stay_duration.'^'.$valueTransDetail->i_no_of_room_in_house.'^'.(($valueTransDetail->i_seperate_cooking_space == '0')?'No':'Yes').'^'.(($valueTransDetail->i_seperate_cooking_space == '0')?'No':'Yes').'^'.(($valueTransDetail->i_running_water_inside_house == '0')?'No':'Yes').'^'.$valueTransDetail->s_source_energy_cooking.'^'.$valueTransDetail->s_land_measurement.'^'.$valueTransDetail->s_land_type.'^"'.$valueTransDetail->s_family_other_assets.'"^'.$valueTransDetail->s_source_of_drinking_water.'^'.(($valueTransDetail->s_borrower_name != '')?$valueTransDetail->s_borrower_salutation.' '.$valueTransDetail->s_borrower_name:'').'^'.$valueTransDetail->s_borrower_nick_name.'^^^None^'.date('d/m/Y', strtotime($valueTransDetail->dt_borrower_dob)).'^'.$valueTransDetail->i_borrower_age.'^'.(($valueTransDetail->s_borrower_gender == 'M')?'Male':(($valueTransDetail->s_borrower_gender == 'F')?'Female':'')).'^NA^'.$valueTransDetail->s_borrower_father_or_husband_salutation.' '.$valueTransDetail->s_borrower_father_or_husband_name.'^'.$valueTransDetail->s_coborrower_occupation.'^'.$valueTransDetail->s_coborrower_sub_occupation.'^'.$valueTransDetail->i_borrower_mobile_no.'^'.$valueTransDetail->s_borrower_relationship.'^'.(($valueTransDetail->i_borrower_same_kitchen == '0')?'No':'Yes').'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'No':'Yes').'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'':$valueTransDetail->s_borrower_salutation.' '.$valueTransDetail->s_borrower_name).'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'':date('d/m/Y', strtotime($valueTransDetail->dt_borrower_dob))).'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'':$valueTransDetail->i_borrower_age).'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'':(($valueTransDetail->s_borrower_gender == 'M')?'Male':(($valueTransDetail->s_borrower_gender == 'F')?'Female':''))).'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'':$valueTransDetail->i_borrower_mobile_no).'^'.(($valueTransDetail->i_borrower_nominee_each_other == '0')?'':$valueTransDetail->s_borrower_relationship).'^'.$valueTransDetail->s_borrower_kyc_type.'^'.$valueTransDetail->s_borrower_kyc.'^^^'.$valueTransDetail->s_main_loan_purpose.'^'.$valueTransDetail->s_sub_loan_purpose.'^Self^Self^Yes^'.$valueTransDetail->d_sanctioned_loan_amount.'^Monthly^1550.0^0^^'.$valueTransDetail->s_religion.'^'.$valueTransDetail->s_mode_of_disbrusement.'^'.$valueTransDetail->s_bank_name.'^'.$valueTransDetail->s_branch_detail.'^'.$valueTransDetail->s_account_holder_name.'^'.$valueTransDetail->s_account_type.'^'.$valueTransDetail->i_account_number.'^'.date('d/m/Y', strtotime($valueTransDetail->i_account_operational_since)).'^'.$valueTransDetail->s_ifsc_code.'^'.$povertyIndex1['How many Household Members are there ?'].'^'.$povertyIndex1['What is the General Education Level of the Female Head/Spouse'].'^'.$povertyIndex1['Does the House Hold possess a stove/Gas Burner'].'^'.$povertyIndex1['Does the House Hold possess a Pressure Cooker/Pressure Pan ?'].'^'.$povertyIndex1['Does the House Hold possess a Refrigerator'].'^'.$povertyIndex2['Does the Household Possess a Television?'].'^'.$povertyIndex2['Does the Household Possess a n Electric Fan?'].'^'.$povertyIndex2['Does the Household Possess an Almirah/Dressing Table?'].'^'.$povertyIndex2['Does the Household Possess a chair,stool,bench or table ?'].'^'.$povertyIndex2['Does the Household Possess a motorcycle, scooter, Motor Car or Jeep?'].'^'.(($valueTransDetail->s_bazar_name == '')?'No':'Yes').'^^^^^0^0^0^0^0^'.$valueTransDetail->s_bazar_name.'^'.$valueTransDetail->s_bazar_address.'^'.$valueTransDetail->i_stall_no.'^'.$valueTransDetail->s_business_proof.'^'.$valueTransDetail->s_type_of_proof.'^'.$valueTransDetail->s_bazar_unique_id_proof.'^'.$valueTransDetail->s_bazar_business_year.'^'.$valueTransDetail->s_comodities_sold.'^^0^^0^0.0^0.0^0.0^0.0^0.0^0.0^0^0^'.$riskEvaluation['Is there any Seasonal fluctuation in Income'].'^'.$riskEvaluation['Is the last 6 months has the family members suffered from any major health,death or accident of family members'].'^'.$riskEvaluation['Is the last 6 months has the family members suffered from any financial shock due to loss of job or major loss in business'].'^'.$riskEvaluation['Spouse/adult member of the family knows about the loan applied for'].'^'.$riskEvaluation['Is the customer eligible for arohans life insurance service'].'^'.$riskEvaluation['Does the customer herself/himself provide all financial information sought'].'^0.0^0.0^0.0^Begusarai^Seeds agricultural raw material & live animals_51205^500.0^0.0^500.0^0.0^500.0^0.0^500.0^2000.0^^^^^^^^^^^^^^^^^^^^^^^^'.$compliance['All member should know each other very well and should be of a similar socio-economical level'].'^'.$compliance['All member should be between 18 and 55 yrs at the entry time in Arohan'].'^'.$compliance['Relative are not allowed in same JLG'].'^'.(array_key_exists('All member should be a resident in their area(saral)/Business in the bazaar(Bazaar) for at least the last 3 yrs', $compliance)?$compliance['All member should be a resident in their area(saral)/Business in the bazaar(Bazaar) for at least the last 3 yrs']:'').'^'.(array_key_exists('A family can have only one primary loan from Arohan(Tatkal/Cross sell loan not counted as primary loan)', $compliance)?$compliance['A family can have only one primary loan from Arohan(Tatkal/Cross sell loan not counted as primary loan)']:'').'^YES^'.(($valueTransDetail->i_cb_kyc_type2_id == '3' && $valueTransDetail->s_applicant_kyc_image_front2 != '')?env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_front2:'').'^'.(($valueTransDetail->i_cb_kyc_type2_id == '3' && $valueTransDetail->s_applicant_kyc_image_back2 == '')?'':env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_back2).'^'.env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_front1.'^'.env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_back1.'^'.(($valueTransDetail->i_cb_kyc_type2_id == '4' && $valueTransDetail->s_applicant_kyc_image_front2 != '')?env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_front2:'').'^'.(($valueTransDetail->s_customer_recidence_img != '')?env('APP_URL').'/'.$valueTransDetail->s_customer_recidence_img:'').'^'.(($valueTransDetail->i_cb_kyc_type2_id == '3' && $valueTransDetail->s_applicant_kyc_image_front2 != '')?env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_front2:'').'^'.(($valueTransDetail->i_cb_kyc_type2_id == '3' && $valueTransDetail->s_applicant_kyc_image_back2 == '')?'':env('APP_URL').'/'.$valueTransDetail->s_applicant_kyc_image_back2).'^'.$valueTransDetail->s_transaction_id.'^'.date('d-m-Y', strtotime($valueTransDetail->dt_cb_check_date)).'^'.$custCbReportUrl.'^no^^'.(($valueTransDetail->s_application_signature == '')?'':env('APP_URL').'/'.$valueTransDetail->s_application_signature).'^'.(($valueTransDetail->s_applicant_bank_statement_img == '')?'':env('APP_URL').'/'.$valueTransDetail->s_applicant_bank_statement_img).'^'.(($valueTransDetail->s_applicant_bank_passbook_img == '')?'':env('APP_URL').'/'.$valueTransDetail->s_applicant_bank_passbook_img).'^'.explode('|', $nocDoc)[0].'^None^Application Cash Flow has Passed^'.(($valueTransDetail->s_cb_fail_reason == '')?'False':'True').'^'.$valueTransDetail->s_cb_fail_reason.'^'.(($valueTransDetail->s_customer_business_img != '')?env('APP_URL').'/'.$valueTransDetail->s_customer_business_img:'').'^'.(($valueTransDetail->s_coborrower_img != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_img:'').'^'.(($valueTransDetail->s_customer_other_image_one != '')?env('APP_URL').'/'.$valueTransDetail->s_customer_other_image_one:'').'^'.(($valueTransDetail->s_coborrower_other_image_one != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_other_image_one:'').'^'.(($valueTransDetail->i_borrower_kyc_type_id == '3' && $valueTransDetail->s_coborrower_kyc_image_front != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_kyc_image_front:'').'^'.(($valueTransDetail->i_borrower_kyc_type_id == '3' && $valueTransDetail->s_coborrower_kyc_image_back != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_kyc_image_back:'').'^'.(($valueTransDetail->i_borrower_kyc_type_id == '1' && $valueTransDetail->s_coborrower_kyc_image_front != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_kyc_image_front:'').'^'.(($valueTransDetail->i_borrower_kyc_type_id == '1' && $valueTransDetail->s_coborrower_kyc_image_back != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_kyc_image_back:'').'^'.(($valueTransDetail->i_borrower_kyc_type_id == '4' && $valueTransDetail->s_coborrower_kyc_image_front != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_kyc_image_front:'').'^'.explode('|', $nocDoc)[1].'^'.explode('|', $nocDoc)[2].'^^0.0^^^^0.0^0.0^0.0^0.0^^"'.$valueTransDetail->s_current_address.'^'.$valueTransDetail->s_current_taluka_block.'^'.$valueTransDetail->s_current_district.'^'.$valueTransDetail->s_current_state.', '.$valueTransDetail->s_current_landmark.', '.$valueTransDetail->s_current_zip.'"^^^^No^No^^^NA^^^^^^^^^^^NA^No^^^'.$coborCbReportUrl.'^'.$groupCode.'^'.$centerCode.'^'.$valueTransDetail->s_customer_id.'^'.(($valueTransDetail->s_customer_other_image_two != '')?env('APP_URL').'/'.$valueTransDetail->s_customer_other_image_two:'').'^'.(($valueTransDetail->s_coborrower_other_image_two != '')?env('APP_URL').'/'.$valueTransDetail->s_coborrower_other_image_two:'').'^'.$valueTransDetail->s_customer_profile_id;
        }

        $encodedPostData = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('constants.AROHAN_LINUX_API_URL')."/api/LOSIntegration/Loan");
        curl_setopt($ch, CURLOPT_POST, 1);

        // In real life you should use something like:
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedPostData);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        \DB::table('integration_api_log')
            ->insert([
                's_group_code' => $groupCode,
                's_center_code' => $centerCode,
                's_integration_api_type' => 'customer',
                's_api_request' => $encodedPostData,
                's_api_response' => $server_output,
                'dt_api_request_date' => date('Y-m-d H:i:s')
            ]);


        \DB::table('customer_transactions')
                ->where( 's_center_code','=', $centerCode )
                ->where( 's_group_code','=', $groupCode )
                ->update(['s_application_status' => 'Send to Hub', 'i_status_change_by' => Session::get('userId'), 'dt_status_change' => date('Y-m-d H:i:s'), 'dt_modified_at' => date('Y-m-d H:i:s')]);


    }

	/*
     * Function Name: site_date_to_db_date
     * Defination: get database formated date from site date.
     * @param: date(d-m-Y), separator
     * @return: database formated date Y-m-d
     */
	function site_date_to_db_date( $date = '' )
	{
		$ret = '';

		$local_date_format = Config('constants.LOCALE_DATE_FORMAT');
		$db_date_format    = Config('constants.DB_DATE_FORMAT');
		$separator		   = Config('constants.DATE_SEPARATOR');

		if( $date && validateDate( $date,$local_date_format ) )
		{
			$date_split = explode($separator,$date);
			$day   = $date_split[0];
			$month = $date_split[1];
			$year  = $date_split[2];

			$ret = date($db_date_format, strtotime(($year.'-'.$month.'-'.$day)));
		}
		return $ret;
	}

	/*
     * Function Name: db_date_to_site_date
     * Defination: get site formated date from database formated date.
     * @param: date(Y-m-d), separator
     * @return: site formated date d-m-Y
     */
	function db_date_to_site_date( $date = '' )
	{
		$ret = '';

		$local_date_format = Config('constants.LOCALE_DATE_FORMAT');
		$db_date_format    = Config('constants.DB_DATE_FORMAT');

		if( $date && validateDate( $date, $db_date_format ) )
		{
			$date_split = explode('-',$date);
			$day   = $date_split[2];
			$month = $date_split[1];
			$year  = $date_split[0];

			$ret =   date($local_date_format, strtotime(($year.'-'.$month.'-'.$day)));
		}
		return $ret;
	}



	# NEW - for checklist-region [Begin]
	//  Get Company Insurance Price Details
		function geInsurancrfee($id){

			$updtArr = [];
			$getInsurancefeeDetails = DB::table('master_insurance_company_fees as fee')
							->select('fee.d_insurance_fee','fee.d_insurance_gst','fee.d_total_insurance_fee')
							->where('fee.i_insurance_company_id', $id)
							->get();

		 $getDataArr = [];
			foreach ($getInsurancefeeDetails as $key => $value) {
				$getDataArr['fee'] = $value->d_insurance_fee;
				$getDataArr['gst'] = $value->d_insurance_gst;
				$getDataArr['total_fee'] = $value->d_total_insurance_fee;
			}
			if(!@empty($getDataArr)){
				return $getDataArr;
			}


		}

		//  Get Company Insurance ID
		function geInsurancrId($idd){

			$getInsurancefeeDetails = DB::table('master_insurance_company as ins_company')
							->select('ins_company.i_insurance_company_id','ins_company.s_ins_company_name')
							->where('ins_company.s_insurance_region', 'like', '%' . $idd. '%')
							->get();


		 $getDataValueArr = [];
			foreach ($getInsurancefeeDetails as $key => $value) {
				$getDataValueArr['company_id'] = $value->i_insurance_company_id;
				$getDataValueArr['name'] = $value->s_ins_company_name;

			}
			if(!@empty($getDataValueArr)){
				return $getDataValueArr;
			}


		}

		// function to get region name&code array
		function _getRegionNames(){

			$regions = DB::table('office_details as ofc')
							->select('ofc.s_office_code', 's_office_name')
							->where('ofc.i_is_active', 1)
							->where('ofc.e_office_type', 'REGIONAL')
							->orderBy('ofc.s_office_name', 'ASC')
							->get();


			$region_names_arr = [];
			foreach ($regions as $key => $value)
				$region_names_arr[$value->s_office_code] = $value->s_office_name;

			if(!@empty($region_names_arr)){
				return $region_names_arr;
			}


		}


		//  Get Region-ID by Region-Code
		function getRegionIdFromCode($region_code){

			$getOfficeDetails = DB::table('office_details as region')
								->select('region.i_id')
								->where('region.i_is_active', 1)
								->where('region.s_office_code', $region_code)
								->first();

			$region_id = ( !empty($getOfficeDetails) )? $getOfficeDetails->i_id: '';

			return $region_id;

		}


	# NEW - for checklist-region [End]


function getNomineeRelationshipId($rltnshpId){

    $filterStr = '1';
    if ($rltnshpId != '') {
        $filterStr .= ' AND `i_id` = '.$rltnshpId;
    }

    $getDetails = DB::table('master_relationship')
                    ->whereRaw($filterStr)
                    ->orderBy('s_relationship_name', 'ASC')
                    ->get();

    $nomineeRelationshipArr = [];
    foreach ($getDetails as $key => $value) {
        $nomineeRelationshipArr[$value->i_id] = $value->s_relationship_name;
    }

    // $nomineeRelationshipArr = array('1'=>'Father', '2'=>'Mother', '3'=>'Brother', '4'=>'Sister', '5'=>'Son', '6'=>'Daughter', '7'=>'Spouse', '8'=>'Other');
    return $nomineeRelationshipArr;
}


function getCenterDetailsFronCode($centerCode){

    $filterStr = '1';
    if ($centerCode != '') {
        $filterStr .= ' AND `s_center_code` = '.$centerCode;
    }

    $getDetails = DB::table('master_center')
                    ->whereRaw($filterStr)
                    ->get();

    if(count($getDetails) > 0){
        return $getDetails[0];
    }else{
        return '';
    }
}

function getCustDetailsFromGroupCode($groupCode){
    $getcustDetails = DB::table('customer_transactions')->select('s_cb_customer_name', 's_cb_customer_salutation', 'd_emi', 's_loan_amount', 'd_sanctioned_loan_amount', 'd_ins_fee', 's_product_details', 's_cb_father_salutation', 's_cb_father_name', 's_pi_customer_gender', 's_cb_spouse_salutation', 's_cb_spouse_name', 's_customer_marital_status')->where('s_group_code', $groupCode)->get();
    return $getcustDetails;
}

function getDaysValidation(){
    $getDetails = DB::table('master_days_validation')->where('dt_effective_date', '<=', date('Y-m-d'))->orderBy('dt_effective_date', 'DESC')->get();
    return $getDetails[0];
}

function elasticSearchOperations($indexName, $requestMethod, $urlStr = '', $params = ''){
    $cURLConnection = curl_init();
    $elasticUrl = config('constants.ELASTIC_SEARCH_URL');

    curl_setopt($cURLConnection, CURLOPT_URL, $elasticUrl.$indexName.$urlStr);

    if($params != ''){
        curl_setopt($cURLConnection, CURLOPT_POST, 1);
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $params);

    }

    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $serverResponse = curl_exec($cURLConnection);
    //var_dump($serverResponse);
    // var_dump(curl_errno($cURLConnection)) . '<br/>';
    //var_dump(curl_error($cURLConnection)) . '<br/>';
    curl_close($cURLConnection);

    return $serverResponse;
}


/* Samadhan Functions Start */

    function getDepartments()
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.DEPARTMENT_MASTER' );

         /* for fetch data from table */
        $data = DB::table($table)
                ->select($table.'.id', $table.'.long_name', $table.'.short_name', $table.'.keys')
                ->where($table.'.is_active', '1')
                ->get()
                ->toArray();

        $results = [];

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results[] = ['id'=>$row->id, 'short_name'=>trim($row->long_name). " (".trim($row->keys).")"];
            }


        }
        return $results;
    }

    function checkTicketReopen($ticket_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );

        $totalData = DB::table($table.' AS A')
                    ->select('A.*')
                    ->where('A.reopen', '<>', 0)
                    ->where('A.is_active', '1')
                    ->where('A.ticket_id', $ticket_id)
                    ->count();

        return $totalData;
    }

    function checkAssignmentTableData($ticket_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );

        $data = DB::table($table.' AS A')
                    ->select('A.assign_user_id')
                    ->where('A.is_active', '1')
                    ->where('A.ticket_id', $ticket_id)
                    ->get()
                    ->toArray();

        $results = '';

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results = $row->assign_user_id;
            }


        }
        return $results;
    }

    function getReasons($flag,$reason = null)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.REASON_MASTER' );

         /* for fetch data from table */
        $data = DB::table($table)
                ->select($table.'.*')
                ->where($table.'.is_active', '1')
                ->where($table.'.type', $flag)
                ->orderBy($table.'.id', 'ASC')
                ->get()
                ->toArray();

        $option = null;

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $recR)
            {
                if($reason == $recR->reason)
                   $option .=  '<OPTION value="'.$recR->reason.'" selected>'.$recR->reason.'</OPTION>';
               else
                   $option .=  '<OPTION value="'.$recR->reason.'" >'.$recR->reason.'</OPTION>';
            }


        }
        return $option;
    }

    function getAssignTicketUserInfo($ticket_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );

         /* for fetch data from table */
        $data = DB::table($table)
                ->select($table.'.assign_user_id', $table.'.assign_date')
                ->where($table.'.is_active', '1')
                ->where($table.'.ticket_id', $ticket_id)
                ->orderBy($table.'.assign_date', 'DESC')
                ->get()
                ->toArray();

        $record = array();

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $userName = getUserName($row->assign_user_id);
				$record['assign_user'] = $userName;
                $record['assigned_user_id'] = $row->assign_user_id;
                $record['assign_date'] = date('d-m-Y g:i A', strtotime($row->assign_date));
            }


        }
        return $record;
    }

    function getUserName($user_id)
    {

        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

         /* for fetch data from table */
        $data = \DB::table( $table )
                    ->select( \DB::raw( 's_first_name,  s_username' ) )
                    ->where('s_username', $user_id)
                    ->get()
                    ->toArray();

        $results = '-';

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results = $row->s_first_name . " (".$row->s_username.")";
            }


        }
        return $results;
    }

    function getStatusById($status_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.STATUS_MASTER' );

        $response = '';
        if( !empty($status_id) ) {
            $query = DB::table( $table )
                        ->select('name')
                        ->where('id', $status_id)
                        ->where('is_active', 1)
                        ->first();
            if($query){
                $response = $query->name;
            }
        }
        return $response;
    }

    function ticketReasonAndDescription($ticket_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );

        $record = array();
        if( !empty($ticket_id) ) {
            $query = DB::table( $table )
                        ->select('reopen_desc', 'reopen_reason', 'complete_desc', 'complete_reason')
                        ->where('ticket_id', $ticket_id)
                        ->where('is_active', 0)
                        ->orderBy('id', 'DESC')
                        ->limit(1)
                        ->first();
            if($query){
                $record['reopen_desc'] = $query->reopen_desc;
                $record['reopen_reason'] = $query->reopen_reason;
                $record['complete_desc'] = $query->complete_desc;
                $record['complete_reason'] = $query->complete_reason;
            }else{

                $record['reopen_desc'] = "";
                $record['reopen_reason'] = "";
                $record['complete_desc'] = "";
                $record['complete_reason'] = "";
            }
        }
        return $record;
    }

    function getTicketAttachmentFiles($ticket_id, $flag)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ATTACHMENTS' );

        $file = array();

        $queryCount = DB::table( $table )
                    ->select('*')
                    ->where('ticket_id', $ticket_id)
                    ->where('flag', $flag)
                    ->count();

        $data = DB::table( $table )
                    ->select('file_name')
                    ->where('ticket_id', $ticket_id)
                    ->where('flag', $flag)
                    ->get()
                    ->toArray();

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $file[] = $row->file_name;
            }
        }

        $result = array('counts' => $queryCount, 'data'=>$file);
        return $result;
    }

    function getTicketAttachments($ticket_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ATTACHMENTS' );

        $file = array();

        $queryCount = DB::table( $table )
                    ->select('*')
                    ->where('ticket_id', $ticket_id)
                    ->whereIn('flag', [1,3])
                    ->count();

        $data = DB::table( $table )
                    ->select('file_name')
                    ->where('ticket_id', $ticket_id)
                    ->whereIn('flag', [1,3])
                    ->get()
                    ->toArray();

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $file[] = $row->file_name;
            }
        }

        $result = array('counts' => $queryCount, 'data'=>$file);
        return $result;
    }

    function forwardedDetails($ticket_id)
    {
        #DB CONNECTION
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );

        $record = array();
        if( !empty($ticket_id) ) {
            $query = DB::table( $table )
                        ->select('forwarded_by', 'forwarded_date')
                        ->where('id', $ticket_id)
                        ->first();
            if($query){
                $forwarded_user_info = getUserInfo($query->forwarded_by);
                if($forwarded_user_info){
                    $record['forwarded_by'] = $forwarded_user_info['name'] . " (".$forwarded_user_info['username'].")";
                }else $record['forwarded_by'] = '';
                $record['forwarded_date'] = date('d-m-Y H:i', strtotime($query->forwarded_date));
            }
        }

        return $record;
    }

    function getUserInfo($user_id)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

         /* for fetch data from table */
        $query = DB::table($table)
                    ->select('i_user_id', 's_first_name',  's_username', 's_email', 's_phone_no', 'i_role_id' )
                    ->where('s_username', $user_id)
                    ->where('i_is_active', 1)
                    ->first();

        $record = array();

        if($query){

            $record['name'] = $query->s_first_name;
            $record['email'] = $query->s_email;
            $record['username'] = $query->s_username;
            $record['phone_no'] = $query->s_phone_no;
            $record['role_id'] = $query->i_role_id;
            $record['user_id'] = $query->i_user_id;
        }
        return $record;
    }

    function getUserOfficeInfo($user_id)
    {
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

         /* for fetch data from table */
         $query = DB::table($office_details_table.' as A')
                            ->select('A.i_id','A.e_office_type','A.s_office_code')
                            ->leftJoin($user_office_table.' as B', 'A.i_id', '=','B.i_office_id')
                            ->where('B.i_user_id', $user_id)
                            ->where('B.i_is_active', 1)
                            ->first();

        $record = array();

        if($query){

            $record['office_id'] = $query->i_id;
            $record['office_code'] = $query->s_office_code;
            $record['office_type'] = $query->e_office_type;
        }
        else{

            $record['office_id'] = '';
            $record['office_code'] = '';
            $record['office_type'] = '';
        }

        return $record;

    }

    function getOfficeUserList($ticket_office_code,$ticket_office_type, $role_office_type)
    {
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

        switch($ticket_office_type) {
            case 'BRANCH': $WHERE_OFC_FLD = 'od.br_code';
                           break;
            case 'REGIONAL': $WHERE_OFC_FLD = 'rod.ro_code';
                             break;
            case 'ZONAL': $WHERE_OFC_FLD = 'zod.zo_code';
                          break;
        }

        switch($role_office_type) {
            case 'BRANCH': $SELECT_OFC_FLD = 'od.br_code';
                           break;
            case 'REGIONAL': $SELECT_OFC_FLD = 'rod.ro_code';
                             break;
            case 'ZONAL': $SELECT_OFC_FLD = 'zod.zo_code';
                          break;
        }


        $sql = "SELECT
                    {$SELECT_OFC_FLD} AS `parent_ofc_code`
                FROM
                    (SELECT
                        i_id,
                            s_office_code AS br_code,
                            s_office_name AS br_name,
                            i_parent_id
                    FROM
                        {$office_details_table}
                    WHERE
                        i_is_active = 1
                            AND e_office_type IN ('BRANCH' , 'BRANCH_INORG', 'BRANCH_ICASH')) od
                        JOIN
                    (SELECT
                        i_id,
                            i_parent_id,
                            s_office_code AS ro_code,
                            s_office_name AS ro_name
                    FROM
                        {$office_details_table}
                    WHERE
                        i_is_active = 1
                            AND e_office_type = 'REGIONAL') rod ON rod.i_id = od.i_parent_id
                        JOIN
                    (SELECT
                        i_id, s_office_code AS zo_code, s_office_name AS zo_name
                    FROM
                        {$office_details_table}
                    WHERE
                        i_is_active = 1 AND e_office_type = 'ZONAL') zod ON zod.i_id = rod.i_parent_id
                        LEFT JOIN
                    (SELECT
                        usr.s_username AS am_code,
                            usr.s_first_name AS am_name,
                            uofc.i_office_id AS br_id
                    FROM
                        (SELECT
                        *
                    FROM
                        {$user_office_table}
                    WHERE
                        i_is_active = 1) uofc
                    JOIN (SELECT
                        i_user_id, s_first_name, s_username
                    FROM
                        {$user_table}
                    WHERE
                        i_role_id = 8 AND i_is_active = 1) usr ON usr.i_user_id = uofc.i_user_id) amod ON amod.br_id = od.i_id
                WHERE
                    {$WHERE_OFC_FLD}={$ticket_office_code} ";

        $getDetails = DB::select($sql);

        $results = array();
        $datas = array();
        if(!empty($getDetails))
        {
            foreach ($getDetails as $k => $row) {
                $office_code = $row->parent_ofc_code;
                $datas[] = $office_code;
            }
            if($datas)
            {
                $SQL = "SELECT
                        usr_off.i_user_id
                    FROM
                        {$user_office_table} usr_off
                    JOIN {$office_details_table} off_details ON
                        usr_off.i_office_id = off_details.i_id
                    WHERE
                        off_details.s_office_code IN(".implode(',', array_unique($datas)).")
                    AND usr_off.i_is_active = 1";
                $Lresult = DB::select($SQL);
                if(!empty($Lresult))
                {
                    foreach ($Lresult as $k => $v) {
                        $results[] = $v->i_user_id;
                    }
                }


            }
        }
        return $results;
    }

    function defaultRankofRoute($department_id, $category_id, $subcategory_id, $office_code, $office_type)
    {


        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $route_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.ROUTE_MASTER' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        /* Get total role id of route */
        $sql = DB::table( $route_master_table )
                    ->select('role_id', 'tat')
                    ->where('department_id', $department_id)
                    ->where('category_id', $category_id)
                    ->where('subcategory_id', $subcategory_id)
                    ->get()
                    ->toArray();

        $Role_Id = [];
        $Role_Id['role_id'] = "";
        $Role_Id['total_tat'] = "";
        $total_tat = 0;
        if( is_array($sql) && !empty($sql) && count($sql) > 0 )
        {
            foreach($sql as $row)
            {
                $total_tat += $row->tat;
                $RoleIds = $row->role_id;

                /* Get role type */
                $recR = DB::table( $samadhan_user_role_table )
                                ->select('type AS role_type')
                                ->where('id', $row->role_id)
                                ->first();

                /* total user count according role wise */
                $ru_R = DB::table( $samadhan_role_join_users_table.' AS a' )
                                ->selectRaw('a.`user_id`, a.`username`, COUNT(a.`user_id`) AS total_users')
                                ->where('a.role_id', $RoleIds)
                                ->groupBy('a.role_id')
                                ->havingRaw('COUNT(a.`user_id`) < 2')
                                ->first();

                if($ru_R)
                {
                    $Role_Id['total_user_count'] = $ru_R->total_users;
                    $Role_Id['assign_user_id'] = $ru_R->username;
                }else{
                    $Role_Id['total_user_count'] = 0;
                    $Role_Id['assign_user_id'] = 0;
                }

                /* Check user exists or not */
                if(($office_type == 'REGIONAL' or $office_type == 'ZONAL' or $office_type == 'BRANCH') && $recR->role_type != 'HEAD')
                {
                    $Userlists = getOfficeUserList($office_code,$office_type,$recR->role_type);
                    $where_user_condition = ' 1 ';
                    if($Userlists){
                        $where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";

                        $Sql = DB::table($user_table)
                                    ->select('s_email')
                                    ->whereIn('i_user_id', function($query) use ($samadhan_role_join_users_table, $RoleIds, $department_id, $where_user_condition){
                                           $query->select('user_id')
                                             ->from($samadhan_role_join_users_table)
                                             ->where('role_id', $RoleIds)
                                             ->where('department_id', $department_id)
                                             ->whereRaw($where_user_condition);
                                        })
                                    ->count();
                        if( $Sql > 0){

                            $Role_Id['role_id'] = $row->role_id;
                            $Role_Id['total_tat'] = $total_tat;
                            break;
                        }

                    }

                }
                else{
                    /* for fetch data from table */
                    $SQL = DB::table($user_office_table.' as usr_off')
                                ->select('usr_off.i_user_id')
                                ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                                ->join($samadhan_role_join_users_table.' as rju', 'usr_off.i_user_id', '=','rju.user_id')
                                ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                                ->where('usr_off.i_is_active', 1)
                                ->where('rju.role_id', $row->role_id)
                                ->where('rju.department_id', $department_id)
                                ->count();

                    if( $SQL > 0){

                        $Role_Id['role_id'] = $row->role_id;
                        $Role_Id['total_tat'] = $total_tat;
                        break;
                    }
                }

            }
        }

        return $Role_Id;
    }
    function getRowFromTable($table, $where)
    {
        $row = DB::table( $table)
                    ->selectRaw('*')
                    ->whereRaw($where)
                    ->first();

        return $row;
    }

    function getUserSamadhanRoles($user_id)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );

        $data = DB::table( $table )
                    ->select('*')
                    ->where('user_id', $user_id)
                    ->get()
                    ->toArray();
        $record = [];
        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $record[] = $row->role_id;
            }
        }
        return $record;
    }

    function getOfficeDeatils($office_code)
    {
        $result = [];
        if ($office_code != '') {
            $getDetails = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION'))
                            ->where('s_office_code', $office_code)
                            ->first();

            if($getDetails){
                $result['email'] = $getDetails->s_office_email;
                $result['phone_no'] = $getDetails->s_primary_phone;
                $result['name'] = $getDetails->s_office_name;
                $result['username'] = $getDetails->s_office_code;
            }
        }
        return $result;
    }

    function getAllTicketStatus($status_id=null)
    {
        $data = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.STATUS_MASTER'))
                        ->where('is_active', 1)
                        ->orderBy('id', 'ASC')
                        ->get()
                        ->toArray();

        $option = '';
        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $recR)
            {
                if($status_id == $recR->id)
                   $option .=  '<OPTION value='.$recR->id.' selected>'.$recR->name.'</OPTION>';
               else
                   $option .=  '<OPTION value='.$recR->id.' >'.$recR->name.'</OPTION>';
            }
        }
        return $option;
    }

    function getRouteRoles($department_id, $category_id, $subcategory_id)
    {
        $route_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.ROUTE_MASTER' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );

        $data = DB::table($samadhan_user_role_table.' as A')
                    ->select('A.*')
                    ->Join($route_master_table.' as B', 'A.id', '=','B.role_id')
                    ->where('B.department_id', $department_id)
                    ->where('B.category_id', $category_id)
                    ->where('B.subcategory_id', $subcategory_id)
                    ->orderBy('B.rank_order', 'ASC')
                    ->get()
                    ->toArray();

        $results = [];

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results[] = ['id'=>$row->id, 'name'=>trim($row->role_name)];
            }
        }
        return $results;
    }

    function getUserByRoles($RoleId)
    {

        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

        $data = DB::table($user_table)
                ->select('s_first_name', 's_username')
                ->whereIn('i_user_id', function($query) use ($samadhan_role_join_users_table, $RoleId){
                       $query->select('user_id')
                         ->from($samadhan_role_join_users_table)
                         ->where('role_id', $RoleId)
                         ->where('is_active', 1);
                    })
                ->get()
                ->toArray();

        $results = [];

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results[] = ['name'=>$row->s_first_name . " (".$row->s_username.")"];
            }
        }
        return $results;
    }
    function TaskFilterAutoCompleteResults($type, $terms)
    {
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

        if($type == "office")
        {
            $data = DB::table($office_details_table)
                    ->select('s_office_name AS name', 's_office_code AS id', 's_office_code AS username')
                    ->where('s_office_name', 'like', '%' . $terms . '%')
                    ->orWhere('s_office_code', 'like', '%' . $terms . '%')
                    ->orderBy('s_office_name', 'DESC')
                    ->get()
                    ->toArray();
        }
        if($type == "user")
        {
            $data = DB::table($user_table)
                    ->select('s_first_name AS name', 'i_user_id AS id', 's_username AS username')
                    ->where('i_is_active', 1)
                    ->where('s_first_name', 'like', '%' . $terms . '%')
                    ->orWhere('s_username', 'like', '%' . $terms . '%')
                    ->orderBy('s_first_name', 'DESC')
                    ->get()
                    ->toArray();
        }

        $results = [];

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results[] = ['label'=>$row->name . " (".$row->username.")",'value'=>$row->id, 'usercode'=>$row->username];
            }
        }
        return $results;
    }
    function getDepartmentByid($id)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.DEPARTMENT_MASTER' );
        $row = DB::table( $table)
                    ->select('*')
                    ->where('id', $id)
                    ->first();
        $result = '';
        if($row) $result = $row->long_name;

        return $result;
    }
    function getCategorySubcategoryByid($id)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.CATEGORY_MASTER' );
        $row = DB::table( $table)
                    ->select('*')
                    ->where('id', $id)
                    ->first();

        $result = '';
        if($row) $result = $row->name;

        return $result;
    }

    function getRoCodeForHolidays($office_code, $office_type)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $OFFICE_CODE = '';

        #ZONAL
        if($office_type == "ZONAL"){
            $row = DB::table($table.' AS a')
                    ->select('a.s_office_code as RO_ID')
                    ->join($table.' as b', 'a.i_parent_id', '=','b.i_id')
                    ->where('b.e_office_type', 'ZONAL')
                    ->Where('b.s_office_code', $office_code)
                    ->WhereNotIn('b.s_office_code', [50001])
                    ->groupBy('b.i_id')
                    ->first();

            if($row) $OFFICE_CODE = $row->RO_ID;
        }
        #BRANCH || BRANCH_ICASH
        if($office_type == "BRANCH" or $office_type == 'BRANCH_ICASH'){
            $row = DB::table($table.' AS a')
                    ->select('b.s_office_code as RO_ID')
                    ->join($table.' as b', 'a.i_parent_id', '=','b.i_id')
                    ->where('a.e_office_type', 'BRANCH')
                    ->orWhere('a.e_office_type', 'BRANCH_ICASH')
                    ->Where('a.s_office_code', $office_code)
                    ->groupBy('a.i_id')
                    ->first();

            if($row) $OFFICE_CODE = $row->RO_ID;
        }
        #REGIONAL
        if($office_type == 'REGIONAL') $OFFICE_CODE = $office_code;
        #HEAD
        if($office_type == 'HEAD' or $office_type == 'CENTRAL') $OFFICE_CODE = 30000;

        return $OFFICE_CODE;
    }
    function getHolidaysByROId($office_code)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TBL_HOLIDAY_MASTER' );

        $data = DB::table($table)
                    ->select('*')
                    ->where('office_code', $office_code)
                    ->where('status', 1)
                    ->get()
                    ->toArray();

        $results = [];

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                $results[] = $row->holiday_date;
            }
        }
        return $results;
    }
    function checkHolidayRecord($office_id, $holiday_date)
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TBL_HOLIDAY_MASTER' );
        $rec_count = DB::table($table)
                        ->select('*')
                        ->where('office_code', $office_id)
                        ->where('holiday_date', $holiday_date)
                        ->where('status', 1)
                        ->count();
        return $rec_count;
    }
    function get_working_hours($from,$to,$office_code)
    {
        /* check date is holiday */
        $f_date = date('Y-m-d', strtotime(startTimeCheck($from)));
        $t_date = date('Y-m-d', strtotime(startTimeCheck($to)));
        $cf_date = checkHolidayRecord($office_code, $f_date);
        $ct_date = checkHolidayRecord($office_code, $t_date);
        if($cf_date == 1 and $ct_date == 1) return 0;
        /* END */

        // timestamps
        $from_timestamp = strtotime(startTimeCheck($from));
        $to_timestamp = strtotime(endTimeCheck($to));

        // work day seconds
        $workday_start_hour = 9;
        $workday_end_hour = 19;
        $workday_seconds = ($workday_end_hour - $workday_start_hour)*3600;

        // work days beetwen dates, minus 1 day
        $from_date = date('Y-m-d',$from_timestamp);
        $to_date = date('Y-m-d',$to_timestamp);
        $workdays_number = count(_get_workdays($from_date,$to_date,$office_code))-1;
        $workdays_number = $workdays_number<0 ? 0 : $workdays_number;

        // start and end time
        $start_time_in_seconds = date("H",$from_timestamp)*3600+date("i",$from_timestamp)*60;
        $end_time_in_seconds = date("H",$to_timestamp)*3600+date("i",$to_timestamp)*60;

        // final calculations
        $working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds);
        $totalHr = getHoursMinutes($working_hours);
        return ($working_hours == 0)? "0" : $totalHr;
    }
    function getHoursMinutes($seconds, $format = '%02d.%02d') {

        if (empty($seconds) || ! is_numeric($seconds)) {
            return false;
        }

        $minutes = round($seconds / 60);
        $hours = floor($minutes / 60);
        $remainMinutes = ($minutes % 60);

        return sprintf($format, $hours, $remainMinutes);
    }
    function businessHours_settings()
    {
        // settings
        $start = "09:00";
        $end   = "19:00";

        // calculate amount of hours per working day
        $diff  = strtotime( $end ) - strtotime( $start );
        $hours = $diff / 3600;

        $settings = array(
            "start" => $start,
            "end"   => $end,
            "diff"  => $diff,
            "hrs"   => $hours
        );
        return $settings;
    }
    function _isWorkingHour( $time )
    {
        $settings = businessHours_settings();

        if ( date("H", $time) >= date("H", strtotime( $settings['start'] )) && date("H", $time) < date("H", strtotime( $settings['end'] )) )
        {
            return true;
        }
        else {
            return false;
        }
    }
    function _get_workdays($from,$to,$office_code)
    {

        $days_arr = [];
        //days range
        $workdays = array();
        $getAllHolidays = getHolidaysByROId($office_code);
        //loop through all days
        for($k = 1; $k <= 12; $k++)
        {
            $type = CAL_GREGORIAN;
            $month = date($k); // Month ID, 1 through to 12.
            $year = date('Y'); // Year in 4 digit 2019 format.
            $day_count = cal_days_in_month($type, $month, $year); // Get the amount of days
            //loop through all days
            for ($i = 1; $i <= $day_count; $i++) {

                    $date = $year.'/'.$month.'/'.$i; //format date

                    $c_date = date('Y-m-d',strtotime($date));
                    if(!in_array($c_date,$getAllHolidays))
                        $workdays[] = $c_date;

            }
        }
        // other variables
        $i = 0;
        $current = $from;

        if($current == $to) // same dates
        {
            $timestamp = strtotime($from);
            $days_arr[] = date("Y-m-d",$timestamp);
        }
        elseif($current < $to) // different dates
        {
            while ($current < $to) {
                $timestamp = strtotime($from." +".$i." day");
                if (in_array(date("Y-m-d",$timestamp), $workdays)) {
                    $days_arr[] = date("Y-m-d",$timestamp);
                }
                $current = date("Y-m-d",$timestamp);
                $i++;
            }
        }
        return $days_arr;
    }
    function startTimeCheck($start_datetime)
    {
        $start_datetime = date('Y-m-d H:i:s', strtotime($start_datetime));

        $now = new Datetime($start_datetime);
        $samedaycheck = date('Y-m-d', strtotime($start_datetime .' +0 day')) . ' 09:00:00';

        $checkCurrentTime = new Datetime($samedaycheck);

        if($now < $checkCurrentTime) return $samedaycheck;

        $setbegintime = date('Y-m-d', strtotime($start_datetime .' +0 day')) . ' 19:00:00';
        $setendtime = date('Y-m-d', strtotime($start_datetime .' +1 day')) . ' 09:00:00';

        $begintime = new DateTime($setbegintime);
        $endtime = new DateTime($setendtime);

        if($now >= $begintime && $now <= $endtime) $return = date('Y-m-d', strtotime($start_datetime .' +1 day')) . ' 09:00:00';
        else $return = $start_datetime;

        return $return;
    }

    function endTimeCheck($end_datetime)
    {
        $end_datetime = date('Y-m-d H:i:s', strtotime($end_datetime));

        $now = new Datetime($end_datetime);
        $before = date('Y-m-d', strtotime($end_datetime .' +0 day')) . ' 09:00:00';
        $after  = date('Y-m-d', strtotime($end_datetime .' +0 day')) . ' 19:00:00';

        $checkBeforeTime = new Datetime($before);
        $checkafterTime = new Datetime($after);

        /* Before check */
        if($now < $checkBeforeTime) return $before;
        /* After check */
        if($now > $checkafterTime) return $after;

        return $end_datetime;
    }

    /* Mail function for Tickets(Assign, forwarded and escalated) */

    function ticketMailDetails($ticket_id, $mail_type)
    {
        $ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        /* Parameters */
        $status = 0; $ticketNo = ''; $body = ''; $params = []; $emails = []; $PARAMS = [];

        /* Attchments */
        $attachments = getTicketAttachments($ticket_id);

        $row = DB::table($ticket_master_table.' AS tm')
                ->select('tm.description', 'tm.submited_date', 'tm.created_by', 'tm.phone_no', 'tm.role_id', 'tm.escalated_role_id', 'tm.department_id', 'tm.category_id', 'tm.subcategory_id', 'tm.ticket_number', 'tm.escalated_role_tat AS assign_time', 'tm.status', 'tm.forwarded_by', 'tm.no_of_cases', 'tm.office_type', 'tm.office_code', 'sur.type AS role_type')
                ->join($samadhan_user_role_table.' as sur', 'tm.role_id', '=','sur.id')
                ->where('tm.id', $ticket_id)
                ->first();

        if($row)
        {
            $ticketNo = $row->ticket_number;
            $Role_id = $row->escalated_role_id;
            $department_id = $row->department_id;
            $CheckCreatedUserRole = getUserInfo($row->created_by);
            if($row->office_type == 'BRANCH' && $CheckCreatedUserRole['role_id'] != 8)
            {
                $CreatedUserInfo = getOfficeDeatils($row->office_code);
            }else{
                $CreatedUserInfo = getUserInfo($row->created_by);
            }
            /* phone no */
            $usr_phone_no = ($row->phone_no != '')?  $row->phone_no : $CreatedUserInfo['phone_no'];
            $date = date('d-m-Y H:i', strtotime($row->submited_date));

            $body .= "<p> <b>Hello</b>,</p>";
            if($mail_type == 'escalate')
            {
               $body .= "<p> <b>The following task has been escalated to you.</p>";
            }
            else if($mail_type == 'forward')
            {
               $body .= "<p> <b>The following task has been forwarded to you.</p>";
            }
            else
            {
               $body .= "<p> <b>The following task has been assigned to you.</p>";
            }
            $body .= "<p> Ticket NO. : ".$row->ticket_number."</p>";
            $body .= "<p> Categoy : ".getCategorySubcategoryByid($row->category_id)."</p>";
            $body .= "<p> Sub Categoy : ".getCategorySubcategoryByid($row->subcategory_id)."</p>";
            $body .= "<p> Ticket Description : ".$row->description."</p>";
            $body .= "<p> TAT : ".$row->assign_time." Hr(s)</p>";
            $body .= "<p> No. of Cases : ".$row->no_of_cases." </p>";
            $body .= "<p> Office Location : ".$row->office_type." </p>";
            $body .= "<p> Office Code : ".$row->office_code." </p>";
            $body .= "<p> Ticket Created By : ".$CreatedUserInfo['name']." (".$CreatedUserInfo['username'].")</p>";

            if($mail_type == 'forward')
            {
                $ForwardedUserInfo1 = getUserInfo($row->forwarded_by);
                $body .= "<p> Ticket Forwarded By : ".$ForwardedUserInfo1['name']." (".$ForwardedUserInfo1['username'].")</p>";
            }

            $body .= "<p> User Email : ".$CreatedUserInfo['email']."</p>";
            $body .= "<p> User Phone No. : ".$usr_phone_no."</p>";
            $body .= "<p> Ticket Status : ".getStatusById($row->status)."</p>";
            $body .= "<p> Date : ".$date." </p>";

            $where_user_condition = ' 1 ';
            if(($row->office_type == 'REGIONAL' or $row->office_type == 'ZONAL' or $row->office_type == 'BRANCH') && $row->role_type != 'HEAD')
            {
                $Userlists = getOfficeUserList($row->office_code,$row->office_type,$row->role_type);
                if($Userlists){
                    $where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";
                }
            }
            else
            {

                $SQL = DB::table($user_office_table.' as usr_off')
                        ->select('usr_off.i_user_id')
                        ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                        ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                        ->where('usr_off.i_is_active', 1)
                        ->get()
                        ->toArray();
                $L_results = [];
                if( is_array($SQL) && !empty($SQL) && count($SQL) > 0 )
                {
                    foreach($SQL as $v)
                    {
                        $L_results[] = $v->i_user_id;
                    }
                }

                if($L_results){
                    $where_user_condition .= " AND user_id IN (".implode(',', array_unique($L_results)).")";
                }
            }

			#GET User List to whom email will sent start
			$where_userList_condition = '';
			$SQLUserList = DB::table($samadhan_role_join_users_table)
					->select('user_id')
					->where('role_id', $Role_id)
					->where('department_id', $department_id)
					->whereRaw($where_user_condition)
					->where('is_active', 1)
					->get()
					->toArray();
			$UserList_results = [];
			if( is_array($SQLUserList) && !empty($SQLUserList) && count($SQLUserList) > 0 )
			{
				foreach($SQLUserList as $v)
				{
					$UserList_results[] = $v->user_id;
				}
			}

			if($UserList_results){
				$where_userList_condition .= " i_user_id IN (".implode(',', array_unique($UserList_results)).")";
			}
			#GET User List to whom email will sent end
			$Sql = array();
			if($where_userList_condition != '')
			{
				/*$Sql = DB::table($user_table)
                    ->select('s_email')
                    ->where('i_user_id', function($query) use ($samadhan_role_join_users_table, $Role_id, $department_id, $where_user_condition){
                           $query->select('user_id')
                             ->from($samadhan_role_join_users_table)
                             ->where('role_id', $Role_id)
                             ->where('department_id', $department_id)
                             ->whereRaw($where_user_condition);
                        })
                    ->get()
                    ->toArray();*/
				$Sql = DB::table($user_table)
                    ->select('s_email')
                    ->whereRaw($where_userList_condition)
					->where('i_is_active', 1)
                    ->get()
                    ->toArray();
			}
            if( is_array($Sql) && !empty($Sql) && count($Sql) > 0 )
            {
                foreach($Sql as $val)
                {
                    $emails[] = $val->s_email;
                }
            }

            if($mail_type == 'forward')
            {
                $ForwardedUserInfo = getUserInfo($row->forwarded_by);
                array_push($emails, $ForwardedUserInfo['email']);
            }
            /* Ticket Escalated Mail information for ticket creater */
            if($mail_type == 'escalate')
            {
               $PARAMS['subject'] = "Samadhan - Ticket No. - " . $ticketNo;
               $PARAMS['body'] = "<p> <b>This Ticket No. - ".$ticketNo." has been escalated to next level.</b></p>";
               $PARAMS['email'] = $CreatedUserInfo['email'];
            }
            else{
                array_push($emails, $CreatedUserInfo['email']);
            }

            /* Email final params */
            $params['body'] = $body;
            $params['subject'] = "Samadhan - Ticket No. - " . $ticketNo;
            $params['email'] = $emails;
            $params['attachments'] = $attachments;
            $params[$mail_type] = $PARAMS;

        } #main query condition end

        return $params;

    } #function end

    #Cancel Ticket Mail
    function cancelMailDetails($ticket_id, $assigned_user_id)
    {
        $ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );

        $row = DB::table($ticket_master_table.' AS tm')
                ->select('tm.ticket_number', 'tm.created_by')
                ->where('tm.id', $ticket_id)
                ->where('tm.status', 7)
                ->first();

        $params = [];
        if ($row) {
            $ticket_number = $row->ticket_number;
            $CreatedUserInfo = getUserInfo($row->created_by);
            $created_user = $CreatedUserInfo['name']." (".$CreatedUserInfo['username'].")";

            /* Email Body and subject */
            $subject = 'Samadhan - Ticket No.- '.$ticket_number .' has been cancelled';
            $body = "<p> <b>Hello</b>,</p>";
            $body .= '<p> Samadhan - Ticket No.- '.$ticket_number .' has been cancelled by tikcet raised user('.$created_user.').</p>';

            /* Assigned user email */
            $userInfo = getUserInfo($assigned_user_id);
            $userEmail = $userInfo['email'];
            if(!empty($userEmail))
            {
                /* Email Params */
                $params['subject']      = $subject;
                $params['body']         = $body;
                $params['email']        = $userEmail;

            }
        }
        return $params;
    }

    function ticketReopenMailDetails($ticket_id)
    {
        $ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        #Ticket Details
        $row = DB::table($ticket_master_table.' AS tm')
                ->select('tm.*')
                ->where('tm.id', $ticket_id)
                ->where('tm.status', 5)
                ->first();

        /* Parameters */
        $emails = []; $params = [];
        if($row)
        {
            $ticketNo = $row->ticket_number;
            $Role_id = $row->escalated_role_id;
            $department_id = $row->department_id;

            $roleRow = DB::table($samadhan_user_role_table)
                    ->select('type as role_type')
                    ->where('id', $Role_id)
                    ->first();

            $where_user_condition = ' 1 ';
            if(($row->office_type == 'REGIONAL' or $row->office_type == 'ZONAL' or $row->office_type == 'BRANCH') && $roleRow->role_type != 'HEAD')
            {
                $Userlists = getOfficeUserList($row->office_code,$row->office_type,$roleRow->role_type);
                if($Userlists){
                    $where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";
                }
            }
            else
            {

                $SQL = DB::table($user_office_table.' as usr_off')
                        ->select('usr_off.i_user_id')
                        ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                        ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                        ->where('usr_off.i_is_active', 1)
                        ->get()
                        ->toArray();
                $L_results = [];
                if( is_array($SQL) && !empty($SQL) && count($SQL) > 0 )
                {
                    foreach($SQL as $v)
                    {
                        $L_results[] = $v->i_user_id;
                    }
                }

                if($L_results){
                    $where_user_condition .= " AND user_id IN (".implode(',', array_unique($L_results)).")";
                }
            }

			#GET User List to whom email will sent start
			$where_userList_condition = '';
			$SQLUserList = DB::table($samadhan_role_join_users_table)
					->select('user_id')
					->where('role_id', $Role_id)
					->where('department_id', $department_id)
					->whereRaw($where_user_condition)
					->where('is_active', 1)
					->get()
					->toArray();
			$UserList_results = [];
			if( is_array($SQLUserList) && !empty($SQLUserList) && count($SQLUserList) > 0 )
			{
				foreach($SQLUserList as $v)
				{
					$UserList_results[] = $v->user_id;
				}
			}

			if($UserList_results){
				$where_userList_condition .= " i_user_id IN (".implode(',', array_unique($UserList_results)).")";
			}
			#GET User List to whom email will sent end
			$Sql = array();
			if($where_userList_condition != '')
			{
				/*$Sql = DB::table($user_table)
                    ->select('s_email')
                    ->where('i_user_id', function($query) use ($samadhan_role_join_users_table, $Role_id, $department_id, $where_user_condition){
                           $query->select('user_id')
                             ->from($samadhan_role_join_users_table)
                             ->where('role_id', $Role_id)
                             ->where('department_id', $department_id)
                             ->whereRaw($where_user_condition);
                        })
                    ->get()
                    ->toArray();*/
				$Sql = DB::table($user_table)
                    ->select('s_email')
                    ->whereRaw($where_userList_condition)
					->where('i_is_active', 1)
                    ->get()
                    ->toArray();
			}
            if( is_array($Sql) && !empty($Sql) && count($Sql) > 0 )
            {
                foreach($Sql as $val)
                {
                    $emails[] = $val->s_email;
                }
            }

            /* Get user information from which ticket are created  */
            $CheckCreatedUserRole = getUserInfo($row->created_by);
            if($row->office_type == 'BRANCH' && $CheckCreatedUserRole['role_id'] != 8)
            {
                $userInfo = getOfficeDeatils($row->office_code);
            }else{
                $userInfo = getUserInfo($row->created_by);
            }

            /* check Attchments of complete ticket */
            $attachments = getTicketAttachmentFiles($ticket_id, 3);

            /* Email Body and subject */
            $subject = 'Samadhan - Ticket No.- '. $ticketNo .' has been reopened';
            $body = "<p> <b>Hello</b>,</p>";
            $body .= '<p> Samadhan - Ticket No.- '. $ticketNo .' has been reopened.Please login at samadhan portal to complete the task.</p>';

            /* Email Params */
            $params['subject']      = $subject;
            $params['body']         = $body;
            $params['email']        = $emails;
            $params['attachments']  = $attachments;

            /* mail send to who has re-opened this ticket */
            $subject1 = 'Samadhan - Ticket No.- '.$ticketNo .' has been reopened';
            $body1 = "<p> <b>Hello</b>,</p>";
            $body1 .= '<p> Your Samadhan - Ticket No.- '.$ticketNo .' has been successfully reopened.</p>';

            $params1 = [
                    'subject' => $subject1,
                    'body' => $body1,
                    'email' => $userInfo['email'],
                    'attachments' => $attachments
            ];
            $params['ticket_owner'] = $params1;
        }

        return $params;
    }

    function completeTicketMailDetails($ticket_id)
    {
        $ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
        $assignment_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        #Ticket Details
        $row = DB::table($ticket_master_table.' AS tm')
                ->select('tm.*')
                ->where('tm.id', $ticket_id)
                ->where('tm.status', 3)
                ->first();

        /* Parameters */
        $emails = []; $params = [];
        if($row)
        {
            $ticketNo = $row->ticket_number;
            $Role_id = $row->escalated_role_id;
            $department_id = $row->department_id;

            #Ticket Details
            $A_row = DB::table($assignment_table)
                ->select('complete_desc', 'complete_reason', 'assign_user_id')
                ->where('ticket_id', $ticket_id)
                ->where('is_active', 0)
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->first();

            $assign_user_id = $A_row->assign_user_id;
            $completed_desc = ($A_row->complete_desc != '')? $A_row->complete_desc : $A_row->complete_reason;

            $roleRow = DB::table($samadhan_user_role_table)
                    ->select('type as role_type')
                    ->where('id', $Role_id)
                    ->first();

            $where_user_condition = ' 1 ';
            if(($row->office_type == 'REGIONAL' or $row->office_type == 'ZONAL' or $row->office_type == 'BRANCH') && $roleRow->role_type != 'HEAD')
            {
                $Userlists = getOfficeUserList($row->office_code,$row->office_type,$roleRow->role_type);
                if($Userlists){
                    $where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";
                }
            }
            else
            {

                $SQL = DB::table($user_office_table.' as usr_off')
                        ->select('usr_off.i_user_id')
                        ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                        ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                        ->where('usr_off.i_is_active', 1)
                        ->get()
                        ->toArray();
                $L_results = [];
                if( is_array($SQL) && !empty($SQL) && count($SQL) > 0 )
                {
                    foreach($SQL as $v)
                    {
                        $L_results[] = $v->i_user_id;
                    }
                }

                if($L_results){
                    $where_user_condition .= " AND user_id IN (".implode(',', array_unique($L_results)).")";
                }
            }

			$where_userList_condition = '';
			$SQLUserList = DB::table($samadhan_role_join_users_table)
					->select('user_id')
					->where('role_id', $Role_id)
					->where('department_id', $department_id)
					->WhereNotIn('user_id', [$assign_user_id])
					->whereRaw($where_user_condition)
					->where('is_active', 1)
					->get()
					->toArray();
			$UserList_results = [];
			if( is_array($SQLUserList) && !empty($SQLUserList) && count($SQLUserList) > 0 )
			{
				foreach($SQLUserList as $v)
				{
					$UserList_results[] = $v->user_id;
				}
			}

			if($UserList_results){
				$where_userList_condition .= " i_user_id IN (".implode(',', array_unique($UserList_results)).")";
			}
			#GET User List to whom email will sent end
			$Sql = array();
			if($where_userList_condition != '')
			{
				/*$Sql = DB::table($user_table)
                    ->select('s_email')
                    ->where('i_user_id', function($query) use ($samadhan_role_join_users_table, $Role_id, $department_id, $where_user_condition, $assign_user_id){
                           $query->select('user_id')
                             ->from($samadhan_role_join_users_table)
                             ->where('role_id', $Role_id)
                             ->where('department_id', $department_id)
                             ->WhereNotIn('user_id', [$assign_user_id])
                             ->whereRaw($where_user_condition);
                        })
                    ->get()
                    ->toArray();*/
				$Sql = DB::table($user_table)
                    ->select('s_email')
                    ->whereRaw($where_userList_condition)
					->where('i_is_active', 1)
                    ->get()
                    ->toArray();
			}
            if( is_array($Sql) && !empty($Sql) && count($Sql) > 0 )
            {
                foreach($Sql as $val)
                {
                    $emails[] = $val->s_email;
                }
            }

            /* Get Info of assigned user */
            $AssignUserInfo = getUserInfo($assign_user_id);
            array_unshift($emails, $AssignUserInfo['email']);

            /* Get user information from which ticket are created  */
            $CheckCreatedUserRole = getUserInfo($row->created_by);
            if($row->office_type == 'BRANCH' && $CheckCreatedUserRole['role_id'] != 8)
            {
                $userInfo = getOfficeDeatils($row->office_code);
            }else{
                $userInfo = getUserInfo($row->created_by);
            }
            array_push($emails, $userInfo['email']);

            /* check Attchments of complete ticket */
            $attachments = getTicketAttachmentFiles($ticket_id, 2);

            /* Email Body and subject */
            $subject = 'Samadhan - Ticket No.- '.$ticketNo .' has been completed';
            $body = "<p> <b>Hello</b>,</p>";
            $body .= '<p> Samadhan - Ticket No.- '.$ticketNo .' has been completed.Please login at samadhan portal to further details.</p>';
            $body .= '<p> Completed Description - '.$completed_desc .' </p>';

            /* Email Params */
            $params['subject']      = $subject;
            $params['body']         = $body;
            $params['email']        = $emails;
            $params['attachments']  = $attachments;
        }

        return $params;
    }

    function ticket_auto_assign($assign_user_id, $ticket_id)
    {
        $ticket_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
        $assignment_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );

        $assign_user = $assign_user_id;
        $assign_date = date('Y-m-d H:i:s');

        //Insert Code
        $result = 0;
        if(!empty($assign_user) && !empty($ticket_id))
        {

            $rowCount = DB::table($assignment_table)
                        ->select('id')
                        ->where('is_active', 1)
                        ->where('ticket_id', $ticket_id)
                        ->where('assign_user_id', $assign_user)
                        ->count();

            if($rowCount == 0)
            {
                $save_data = array(
                        'ticket_id'         => $ticket_id,
                        'assign_user_id'    => $assign_user,
                        'assign_date'       => $assign_date
                    );
                $inserted_ticket_id = DB::table($assignment_table)
                                        ->insertGetId($save_data);
                if($inserted_ticket_id)
                {
                    $savedata = array('status' => 2);
                    $update_data = DB::table($ticket_table)
                                        ->where('id', $ticket_id)
                                        ->update($savedata);

                    $result = $inserted_ticket_id;
                }
            }

        }

       return $result;
    }

    function ticketAssignMailDetails($ticket_id)
    {
        $ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
        $assignment_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_ASSIGNMENT' );
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        #Ticket Details
        $row = DB::table($assignment_table.' AS ta')
                ->select('ta.assign_user_id', 'ta.ticket_id', 'tm.department_id', 'tm.ticket_number', 'tm.created_by', 'tm.role_id', 'tm.office_code', 'tm.office_type')
                ->join($ticket_master_table.' as tm', 'ta.ticket_id', '=','tm.id')
                ->where('ta.ticket_id', $ticket_id)
                ->where('ta.is_active', 1)
                ->first();

        /* Parameters */
        $emails = []; $params = [];
        if($row)
        {
            $ticketNo = $row->ticket_number;
            $Role_id = $row->role_id;
            $department_id = $row->department_id;
            $assign_user_id = $row->assign_user_id;

            $roleRow = DB::table($samadhan_user_role_table)
                    ->select('type as role_type')
                    ->where('id', $Role_id)
                    ->first();

            $where_user_condition = ' 1 ';
            if(($row->office_type == 'REGIONAL' or $row->office_type == 'ZONAL' or $row->office_type == 'BRANCH') && $roleRow->role_type != 'HEAD')
            {
                $Userlists = getOfficeUserList($row->office_code,$row->office_type,$roleRow->role_type);
                if($Userlists){
                    $where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";
                }
            }
            else
            {

                $SQL = DB::table($user_office_table.' as usr_off')
                        ->select('usr_off.i_user_id')
                        ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                        ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                        ->where('usr_off.i_is_active', 1)
                        ->get()
                        ->toArray();
                $L_results = [];
                if( is_array($SQL) && !empty($SQL) && count($SQL) > 0 )
                {
                    foreach($SQL as $v)
                    {
                        $L_results[] = $v->i_user_id;
                    }
                }

                if($L_results){
                    $where_user_condition .= " AND user_id IN (".implode(',', array_unique($L_results)).")";
                }
            }

            $Sql = DB::table($user_table)
                    ->select('s_email')
                    ->where('i_user_id', function($query) use ($samadhan_role_join_users_table, $Role_id, $department_id, $where_user_condition, $assign_user_id){
                           $query->select('user_id')
                             ->from($samadhan_role_join_users_table)
                             ->where('role_id', $Role_id)
                             ->where('department_id', $department_id)
                             ->WhereNotIn('user_id', [$assign_user_id])
                             ->whereRaw($where_user_condition);
                        })
                    ->get()
                    ->toArray();
            if( is_array($Sql) && !empty($Sql) && count($Sql) > 0 )
            {
                foreach($Sql as $val)
                {
                    $emails[] = $val->s_email;
                }
            }

            /* Get Info of assigned user */
            $AssignUserInfo = getUserInfo($assign_user_id);
            // $assignedUserName = getUserName($A_data['assign_user_id']);
            $assignedUserName = getUserName($assign_user_id);
            array_unshift($emails, $AssignUserInfo['email']);

            /* Get user information from which ticket are created  */
            $CheckCreatedUserRole = getUserInfo($row->created_by);
            if($row->office_type == 'BRANCH' && $CheckCreatedUserRole['role_id'] != 8)
            {
                $userInfo = getOfficeDeatils($row->office_code);
            }else{
                $userInfo = getUserInfo($row->created_by);
            }
            array_push($emails, $userInfo['email']);

            /* mail send to who has re-opened this ticket */
            $subject1 = 'Samadhan - Ticket No.- '. $row->ticket_number .' assigned information';
            $body1 = "<p> <b>Hello</b>,</p>";
            $body1 .= "<p> Currently, ".$assignedUserName." is working on this ticket number (".$row->ticket_number.") task. </p>";

            $params = [
                    'subject' => $subject1,
                    'body' => $body1,
                    'email' => $emails,
            ];
        }

        return $params;
    }

    function nextTicketAssignStage($ticket_id)
    {
        $ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
        $route_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.ROUTE_MASTER' );
        $office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
        $samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
        $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
        $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
        $user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

        #Ticket Details
        $T_row = DB::table($ticket_master_table)
                ->select('office_type', 'office_code', 'department_id')
                ->where('id', $ticket_id)
                ->first();
        $office_type = $T_row->office_type;
        $office_code = $T_row->office_code;
        $department_id = $T_row->department_id;

        $C_sql = "SELECT
                        rm.role_id, rm.tat, sur.type AS role_type
                    FROM
                        ".$route_master_table." rm
                            INNER JOIN
                        ".$ticket_master_table." tm USING (department_id , category_id , subcategory_id)
                            INNER JOIN
                        ".$samadhan_user_role_table." sur ON rm.role_id = sur.id
                    WHERE
                        rm.role_id <> tm.role_id AND tm.id = {$ticket_id}
                            AND rm.rank_order > (SELECT
                                rms.rank_order
                            FROM
                                ".$route_master_table." rms
                            WHERE
                                rms.role_id = tm.escalated_role_id
                                AND rms.department_id = tm.department_id
                                AND rms.category_id = tm.category_id
                                AND rms.subcategory_id = tm.subcategory_id)
                    ";

        $getDetails = DB::select($C_sql);

        $Role_Id = []; $total_tat = 0;
        $Role_Id['role_id'] = '';
        $Role_Id['total_tat'] = '';
        if($getDetails)
        {
           foreach ($getDetails as $key => $row) {
               $total_tat += $row->tat;
               $RoleIds = $row->role_id;
               /* Check user exists or not */
                if(($office_type == 'REGIONAL' or $office_type == 'ZONAL' or $office_type == 'BRANCH') && $row->role_type != 'HEAD')
                {
                    $Userlists = getOfficeUserList($office_code,$office_type,$row->role_type);
                    $where_user_condition = ' 1 ';
                    if($Userlists){
                        $where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";

                        $Sql = DB::table($user_table)
                                    ->select('s_email')
                                    ->where('i_user_id', function($query) use ($samadhan_role_join_users_table, $RoleIds, $department_id, $where_user_condition){
                                           $query->select('user_id')
                                             ->from($samadhan_role_join_users_table)
                                             ->where('role_id', $RoleIds)
                                             ->where('department_id', $department_id)
                                             ->whereRaw($where_user_condition);
                                        })
                                    ->count();
                        if( $Sql > 0){

                            $Role_Id['role_id'] = $row->role_id;
                            $Role_Id['total_tat'] = $total_tat;
                            break;
                        }

                    }

                }
                else{
                    /* for fetch data from table */
                    $SQL = DB::table($user_office_table.' as usr_off')
                                ->select('usr_off.i_user_id')
                                ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                                ->join($samadhan_role_join_users_table.' as rju', 'usr_off.i_user_id', '=','rju.user_id')
                                ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                                ->where('usr_off.i_is_active', 1)
                                ->where('rju.role_id', $row->role_id)
                                ->where('rju.department_id', $department_id)
                                ->count();
                    if( $SQL > 0){

                        $Role_Id['role_id'] = $row->role_id;
                        $Role_Id['total_tat'] = $total_tat;
                        break;
                    }
                }

           }
        }

       return $Role_Id;
    }

	function getRoLists($regional_id = '')
    {
        $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );

        $data = DB::table($table.' AS a')
                ->select('a.s_office_code', 'a.s_office_name')
                ->where('a.e_office_type', 'REGIONAL')
                ->Where('a.i_parent_id', '<>', 0)
                ->Where('a.i_is_active', 1)
                ->get()
                ->toArray();

        $option = '';

        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $row)
            {
                if($regional_id == $row->s_office_code){
                    $option .=  '<OPTION value='.$row->s_office_code.' selected>'.$row->s_office_name.'</OPTION>';
                }
                else{
                   $option .=  '<OPTION value='.$row->s_office_code.' >'.$row->s_office_name. ' ('.$row->s_office_code.')' .'</OPTION>';
               }
            }
        }
        return $option;
    }

    function checkDataExistOrNotFromTable($table, $where='')
    {
        $condition = ($where != '')? '1 '.$where : ' 1 ';
        $sql = DB::table($table)
                ->select('*')
                ->whereRaw($condition)
                ->count();

        return $sql;
    }

    function getCategorySubcategoryOptions($parent_id=0, $selected='', $department_id = 0)
    {

        $where_condition = ' 1 ';
        if($department_id != 0) $where_condition .= " AND department_id = ". $department_id;

        $data = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.CATEGORY_MASTER'))
                        ->select('*')
                        ->where('parent_id', $parent_id)
                        ->where('is_active', 1)
                        ->whereRaw($where_condition)
                        ->orderBy('id', 'ASC')
                        ->get()
                        ->toArray();

        $option = '';
        if( is_array($data) && !empty($data) && count($data) > 0 )
        {
            foreach($data as $recR)
            {
                if($selected == $recR->id)
                   $option .=  '<OPTION value='.$recR->id.' selected>'.$recR->name.'</OPTION>';
               else
                   $option .=  '<OPTION value='.$recR->id.' >'.$recR->name.'</OPTION>';
            }
        }
        return $option;
    }

function getRole($role_id=null, $department_id = null,$rejected_role = null, $ret_json=false)
{

    $condition = ' 1 ';
    if(!empty($rejected_role))
        $condition .= " AND id NOT IN({$rejected_role})";

    if(!empty($department_id))
       $condition .= " AND department_id = {$department_id}";

    $data = DB::table(config('app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE'))
                ->select('*')
                ->WhereNotIn('id', [1])
                ->where('is_active', 1)
                ->whereRaw($condition)
                ->orderBy('role_name', 'ASC')
                ->get()
                ->toArray();

    $option = null;
    $option_arr = array();
    if( is_array($data) && !empty($data) && count($data) > 0 )
    {
        foreach($data as $recR)
        {
            if($ret_json) {
                $department_name = getDepartmentNameById($recR->department_id);
                $option_arr[] = array('id' => $recR->id, 'value' => $recR->role_name, 'label' => $recR->role_name,'dep_id'=>$recR->department_id,'value2'=>$department_name);
            } else {
               if($role_id == $recR->id)
                   $option .=  '<OPTION value='.$recR->id.' selected>'.$recR->role_name.'</OPTION>';
               else
                   $option .=  '<OPTION value='.$recR->id.' >'.$recR->role_name.'</OPTION>';
            }
        }
    }
    return $ret_json ? $option_arr : $option;
}
function getDepartmentNameById($department_id)
{
    $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.DEPARTMENT_MASTER' );

    $row = DB::table($table.' AS tm')
            ->select('tm.long_name', 'tm.short_name', 'tm.keys')
            ->where('tm.id', $department_id)
            ->where('tm.is_active', 1)
            ->first();

    if ($row) {
        return trim($row->long_name). " (".trim($row->keys).")";
    } else {
        return '-';
    }
}
function getRoleNameById($role_id)
{
    $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );

    $row = DB::table($table.' AS tm')
                ->select('*')
                ->WhereNotIn('id', [1])
                ->where('is_active', 1)
                ->where('id', $role_id)
                ->first();

    if ($row) {
        return trim($row->role_name);
    } else {
        return '-';
    }
}
function getRoleUserList($is_assigned = false, $role_id, $department_id)
{
    $samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
    $user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

    if(!$is_assigned):

        $SQL = DB::table($user_table)
                    ->select('i_user_id as id', 's_first_name as user_name', 's_username as user_id')
                    ->where('i_is_active', 1)
                    ->orderBy('i_user_id', 'DESC')
                    ->get()
                    ->toArray();
    else:

        $SQL = DB::table($user_table)
                    ->select('i_user_id as id', 's_first_name as user_name', 's_username as user_id')
                    ->WhereIn('i_user_id', function($query) use ($samadhan_role_join_users_table, $role_id, $department_id){
                           $query->select('user_id')
                             ->from($samadhan_role_join_users_table)
                             ->where('role_id', $role_id)
                             ->where('department_id', $department_id);
                        })
                    ->where('i_is_active', 1)
                    ->orderBy('i_user_id', 'DESC')
                    ->get()
                    ->toArray();
    endif;

    $result_arr = array();
    if( is_array($SQL) && !empty($SQL) && count($SQL) > 0 )
    {
        foreach($SQL as $recR)
        {
           $result_arr[] = array('id' => $recR->id, 'name' => $recR->user_name." (".$recR->user_id.")");
        }
    }

    return $result_arr;
}

function device_push_notification( $registrationIds = [], $title = '', $body = '', $payload = '' )
{
    if( strtoupper(env('APP_ENV')) == 'PROD' ){
        $api_key = config( 'constants.PUSH_NOTIFICATION_API_KEY_PROD' );
    }else{
        $api_key = config( 'constants.PUSH_NOTIFICATION_API_KEY_OTHERS' );
    }

    @define('API_ACCESS_KEY',$api_key);

    $url = config( 'constants.PUSH_NOTIFICATION_API_URL' );

    // prepare the message
    $message = array(
        'title'     => $title,
        'body'      => $body,
        'vibrate'   => 1,
        'sound'     => 1,
        'tap'       => true,
        'payload'   => $payload
    );

    $fields = array(
        'registration_ids' => $registrationIds,
        'data'             => $message
    );

    $headers = array(
        'Authorization: key='.API_ACCESS_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL,$url);
    curl_setopt( $ch,CURLOPT_POST,true);
    curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function getTicketDetailById( $id = '' )
{
    $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );

    $whereRaw = '1 ';

    if ($id != '') {
        $whereRaw .= ' AND id = '.$id;
    }

    $data = \DB::table( $table )
            ->select( \DB::raw( 'id as ticket_id, ticket_number, submited_date' ) )
            ->whereRaw( $whereRaw )
            ->get();

    return $data[0];
}

function getPushNotificationCountByUser( $userId = '' )
{
    $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.PUSH_NOTIFICATIONS' );

    $whereRaw = ' 1 ';

    if ($userId != '') {
        $whereRaw .= ' AND s_user_name = '. trim($userId);
    }

    $total_records = \DB::table( $table )
                        ->select( \DB::raw( 'i_id' ) )
                        ->where('i_is_active', '1')
                        ->where('i_is_read', '0')
                        ->whereRaw( $whereRaw )
                        ->count();

    return $total_records;
}

function getUserDevices( $userId = '' )
{
    $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_DEVICES' );

    $whereRaw = ' 1 ';

    if ($userId != '') {
        $whereRaw .= ' AND s_user_name = '. trim($userId);
    }

    $data = \DB::table( $table )
                ->select('*')
                ->where('i_is_active', '1')
                ->whereRaw( $whereRaw )
                ->orderBy('dt_updated_date', 'DESC')
                ->get()
                ->toArray();

    $results = [];
    if( is_array($data) && !empty($data) && count($data) > 0 )
    {
        foreach($data as $recR)
        {
            $results[] = $recR->s_device_registration_no;
        }
    }
    return $results;
}

function getusersByOfficeLocation($ticket_id)
{
	$ticket_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.TICKET_MASTER' );
	$route_master_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.ROUTE_MASTER' );
	$office_details_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.OFFICE_LOCATION' );
	$samadhan_user_role_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_USER_ROLE' );
	$samadhan_role_join_users_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.SAMADHAN_ROLE_JOIN_USERS' );
	$user_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );
	$user_office_table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_OFFICE' );

	#Ticket Details
	$t_row = DB::table($ticket_master_table)
			->select('*')
			->where('id', $ticket_id)
			->first();
	$office_type = $t_row->office_type;
	$office_code = $t_row->office_code;
	$office_id   = $t_row->office_id;

    $result = [];

    if($office_code != '' and $office_type != '' and $office_id != '')
    {
        /* Get ticket escalated roles */
        $r_sql = "SELECT
                        r.role_id
                  FROM
                        route_master r
                  WHERE
                        r.department_id = ".$t_row->department_id."
                            AND r.category_id = ".$t_row->category_id."
                            AND r.subcategory_id = ".$t_row->subcategory_id."
                            AND r.rank_order BETWEEN (SELECT
                                r1.rank_order
                            FROM
                                route_master r1
                            WHERE
                                r1.department_id = ".$t_row->department_id."
                                    AND r1.category_id = ".$t_row->category_id."
                                    AND r1.subcategory_id = ".$t_row->subcategory_id."
                                    AND r1.role_id = ".$t_row->role_id.") AND (SELECT
                                r2.rank_order
                            FROM
                                route_master r2
                            WHERE
                                r2.department_id = ".$t_row->department_id."
                                    AND r2.category_id = ".$t_row->category_id."
                                    AND r2.subcategory_id = ".$t_row->subcategory_id."
                                    AND r2.role_id = ".$t_row->escalated_role_id.")
				  AND r.role_id <> ".$t_row->role_id."
                  ORDER BY r.rank_order ASC";

		$CountQuery = count(DB::select(DB::raw($r_sql)));
        $details = DB::select(DB::raw($r_sql));
        if($CountQuery > 0)
        {
            foreach($details as $r_row)
            {
				$RoleIds = $r_row->role_id;
                /* Get role type */
                $recR	= DB::table($samadhan_user_role_table)
							->select('type AS role_type')
							->where('id', $r_row->role_id)
							->first();

                /* Check user exists or not */
                if(($office_type == 'REGIONAL' or $office_type == 'ZONAL' or $office_type == 'BRANCH') && $recR->role_type != 'HEAD')
                {
					$Userlists = getOfficeUserList($office_code,$office_type,$recR->role_type);
                    $where_user_condition = ' 1 ';
                    if($Userlists){

						$where_user_condition .= " AND user_id IN (".implode(',', $Userlists).")";

                        $Sql = DB::table($samadhan_role_join_users_table)
                                    ->select(DB::raw( "GROUP_CONCAT(user_id SEPARATOR ',') AS user_ids" ))
                                    ->where('role_id', $RoleIds)
									->where('department_id', $t_row->department_id)
									->whereRaw($where_user_condition)
									->get();

                        if(count($Sql) > 0){

							$u_sql = DB::table($user_table)
										->select(DB::raw( "GROUP_CONCAT(concat(s_first_name, '(', s_username , ')') SEPARATOR ',') AS user_ids" ))
										->whereIn('i_user_id', explode(',', $Sql[0]->user_ids))
										->get();
                            $result[] = $u_sql[0]->user_ids;

                        }
                    }

                }else{

					 $Sql = DB::table($user_office_table.' as usr_off')
                                ->select(DB::raw("GROUP_CONCAT(usr_off.i_user_id SEPARATOR ',') AS user_ids"))
                                ->join($office_details_table.' as off_details', 'usr_off.i_office_id', '=','off_details.i_id')
                                ->join($samadhan_role_join_users_table.' as rju', 'usr_off.i_user_id', '=','rju.user_id')
                                ->whereIn('off_details.s_office_code', ['30000','30050','30001','30002','30003','30004','30005','30006'])
                                ->where('usr_off.i_is_active', 1)
                                ->where('rju.role_id', $t_row->role_id)
                                ->where('rju.department_id', $t_row->department_id)
                                ->get();

                    if( count($Sql) > 0){

                        $u_sql = DB::table($user_table)
										->select(DB::raw( "GROUP_CONCAT(concat(s_first_name, '(', s_username , ')') SEPARATOR ',') AS user_ids" ))
										->whereIn('i_user_id', explode(',', $Sql[0]->user_ids))
										->get();
                        $result[] = $u_sql[0]->user_ids;
                    }
            }

    }
  }
}
return $result;

}

function getFirstRoleTat($department_id, $category_id, $subcategory_id, $role_id)
{
	$sql = "SELECT
                tat
            FROM
                `route_master`
            WHERE
                department_id = {$department_id}
            AND category_id = {$category_id}
            AND subcategory_id = {$subcategory_id}
            AND role_id = {$role_id}";

    $CountQuery = count(DB::select(DB::raw($sql)));
	$details = DB::select(DB::raw($sql));
	if($CountQuery > 0)
	{
		return $details['0']->tat;
	}
    else
	{
		return '';
	}
}

function getUserNameFromId($user_id)
{

	$table = config( 'app.CUSTOM_CONFIG.DB_TABLES.USER_TABLE' );

	 /* for fetch data from table */
	$data = \DB::table( $table )
				->select( \DB::raw( 's_first_name,  s_username' ) )
				->where('i_user_id', $user_id)
				->get()
				->toArray();

	$results = '-';

	if( is_array($data) && !empty($data) && count($data) > 0 )
	{
		foreach($data as $row)
		{
			$results = $row->s_first_name . " (".$row->s_username.")";
		}


	}
	return $results;
}

    /* End */
