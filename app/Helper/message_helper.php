<?php

if( ! function_exists( 'get_msg_body_by_id' ) )
{
	function get_msg_body_by_id( $msg_id = '' )
	{
		$ret_msg = '';
		
		#~~~~~~~~~~~~~~~~~ MISMATCH SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['MismatchEditSuccess'] 						= "Mismatch updated successfully.";
		$msg['MismatchEditFailiure'] 						= "Failed to update the Mismatch data, please try again later.";
		#~~~~~~~~~~~~~~~~~ MISMATCH SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		#~~~~~~~~~~~~~~~~~ MANAGE SCHEDULE SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['DailyScheduleAddtSuccess'] 					= "Daily schedule added successfully.";
		$msg['DailyScheduleAddFailiure'] 					= "Failed to add the Daily schedule data, please try again later.";
		$msg['mismatchDataFoundInBranch'] 					= "Some Center of this Branch has no CSR.";
		$msg['plannedScheduleAddtSuccess'] 					= "Planned schedule added successfully.";
		$msg['plannedScheduleAddFailiure'] 					= "Failed to add the Planned schedule data, please try again later.";
		$msg['plannedScheduleEditIDNotFound'] 				= "Something happening wrong, please try again later.";
		$msg['plannedScheduleEdittSuccess'] 				= "Planned schedule updated successfully.";
		$msg['plannedScheduleEditFailiure'] 				= "Failed to update the Planned schedule data, please try again later.";
		$msg['plannedScheduleDeleteSuccess'] 				= "Planned schedule deleted successfully.";
		$msg['plannedScheduleDeleteFailiure'] 				= "Failed to delete the Planned schedule, please try again later.";		
		$msg['duplicateDailyScheduleFound'] 				= "Daily Schedule already exist for selected Center(s) in this date range.";
		$msg['duplicatePlannedScheduleFound'] 				= "Planned Schedule already exist for selected Center(s) in this date range.";
		$msg['redirectToManageMismatchFailed'] 				= "Failed to found mismatch. Please try again later.";
		$msg['transactionDataFound'] 						= "Today Some amount already collected at this center.";
		$msg['duplicateDailyScheduleFound2'] 				= "Daily Schedule already exist at this Center for the day.";
		$msg['duplicatePlannedScheduleFound2'] 				= "Planned Schedule already exist at this Center for the day.";
		$msg['CSRChangedFromDailyPlannedSchedule'] 			= "Permanent CSR assigned successfully.";
		$msg['CSRandPermanentCSRFromDailySchedule'] 		= "Daily Schedule & Permanent CSR assigned successfully.";
		$msg['CSRandPermanentCSRFromPlannedSchedule'] 		= "Planned Schedule & Permanent CSR assigned successfully.";
		
		#~~~~~~~~~~~~~~~~~ MANAGE SCHEDULE SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		
		#~~~~~~~~~~~~~~~~~ MANAGE ADVANCE COLLECTION SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#		
		$msg['advanceCollectionEditIDNotFound'] 			= "Something happening wrong, please try again later.";	
		$msg['duplicateAdvanceCollectionFound'] 			= "Advance Collection already exist in that date range for some of the selected Region.";
		$msg['advanceCollectionAddFailiure'] 				= "Failed to add Advance collection data, please try again later.";
		$msg['advanceCollectionAddSuccess'] 				= "Advance collection data added successfully.";
		$msg['regionNotFound'] 								= "No region found, failed to add Advance collection data.";
		$msg['advanceCollectionEditIDNotFound'] 			= "Something happening wrong, please try again later.";
		$msg['advanceCollectionEditFailiure'] 				= "Failed to update the Advance collection data, please try again later.";
		$msg['advanceCollectionEditSuccess'] 				= "Advance collection data updated successfully.";
		$msg['EditRegionNotFound'] 							= "No region found, failed to update Advance collection data.";
		$msg['advanceCollectionDeleteSuccess'] 				= "Advance collection deleted successfully.";
		$msg['advanceCollectionDeleteFailiure'] 			= "Failed to delete the Advance collection, please try again later.";
		
		#~~~~~~~~~~~~~~~~~ MANAGE ADVANCE COLLECTION SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#


		#~~~~~~~~~~~~~~~~~ USER SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['userAddSuccess'] 								= "User has been added successfully.";
		$msg['userEditSuccess'] 							= "User has been updated successfully.";
		$msg['userDeleteSuccess'] 							= "User has been deleted successfully.";
		
		#~~~~~~~~~~~~~~~~~ USER SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#

		#~~~~~~~~~~~~~~~~~ USER ROLES SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['roleAddSuccess'] 								= "Role has been added successfully.";
		$msg['roleEditSuccess'] 							= "Role has been updated successfully.";
		$msg['menuSavedSuccess'] 							= "Menu Permissions has been saved successfully";
		$msg['menuSavedError'] 								= "Oops! Failed to save Menu Permissions. Please try later.";
		$msg['roleDeleteSuccess'] 							= "Role has been deleted successfully";
		
		#~~~~~~~~~~~~~~~~~ USER ROLES SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		
		#~~~~~~~~~~~~~~~~~ COMPANY SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['companyEditSuccess'] 							= "Company updated successfully.";
		
		#~~~~~~~~~~~~~~~~~ COMPANY SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#

		#~~~~~~~~~~~~~~~~~ MY PROFILE SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['myProfileEditSuccess'] 						= "Information has been changed successfully.";
		$msg['myProfileEditError'] 							= "It seems some error has occured. Please login again and change your password.";
		
		#~~~~~~~~~~~~~~~~~ MY PROFILE SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#

		#~~~~~~~~~~~~~~~~~ CHANGE PASSWORD SECTION MESSAGES [START] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
		$msg['changePasswordSuccess'] 						= "Password has been changed successfully";
		$msg['changePasswordError'] 						= "Old password is not matched with existing password";
		
		#~~~~~~~~~~~~~~~~~ CHANGE PASSWORD SECTION MESSAGES [END] ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#


		$msg['generalDeleteMsg'] 							= "Are you sure you want to delete this record?";
		$msg['generalErrorMsg'] 							= "Oops! Something went wrong.";


		if( $msg_id != '' && array_key_exists( $msg_id, $msg ) )
		{
			$ret_msg = $msg[trim($msg_id)];
		}

		return $ret_msg;
	}

}









