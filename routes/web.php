<?php

Route::get('/', function(){
  return view('welcome');
});
Route::post('/ajax_region_list_by_zone', 'ManageApplicationController@ajax_region_list_by_zone');
Route::post('/get_branch_list_by_region', 'ManageApplicationController@get_branch_list_by_region');
# sample - forms
Route::get('/sample-form','JobsController@_display_sample_form');
Route::get('/sample-crud','JobsController@_display_sample_CRUD');
#jobs posting 
Route::get('jobs/add','JobsController@add_new_job')->name('add-job-form');
Route::any('/jobs','JobsController@index');
Route::get('get/data','JobsController@get_data');
Route::get('job/add/form','JobsController@store_job_page');
Route::post('store/job','JobsController@store_job');
Route::get('delete/job','JobsController@delete')->name('delete-job');
Route::get('edit/job/{id}','JobsController@edit')->name('edit-form');
Route::post('update/job','JobsController@update');
Route::get('view/job/{id}','JobsController@view')->name('view-job'); 
Route::post('search/job','JobsController@search_data'); 
Route::post('get/zone','JobsController@get_zone');
Route::post('get/region','JobsController@get_region');
# interview - pannel 
Route::get('hr/manage','InterviewController@hr_manage');
Route::get('final/selection','InterviewController@final_selection');
