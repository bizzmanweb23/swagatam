@extends('layouts.app')

@section('content')

    
<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{$heading}}</h1>
    
</div>


<div class="wrapper-fluid">
    <div class="row ">
        <div class="col-la-12">
            <div class="card ">                        
                <div class="card-container">
					<h4 class="primary-color"> Search </h4>
					<div class="row margin-bottom-es"> 
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{url('tasks')}}" role="search">
							{{ csrf_field() }}
							
                             <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Department</label>
                                    <select class="input-panel" name="department" id="department_id" onchange="categoryAjax(this.value);">
                                        <option value=""> Select </option>

                                        <?php $departments = getDepartments(); ?>
                                        <?php foreach($departments as $department): ?>
                                            <?php
                                                $selected = ($postVal['department'] == $department['id'])? 'selected':'';
                                            ?>
                                            <option value="<?php echo $department['id']; ?>" <?php echo $selected; ?>><?php echo $department['short_name']; ?></option>

                                        <?php endforeach; ?>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Category</label>
                                    <select class="input-panel" name="category" id="category_id" onchange="subcategoryAjax(this.value);">
                                        <option value=""> Select </option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Sub Category</label>
                                    <select class="input-panel" name="sub_category" id="sub_category_id">
                                        <option value=""> Select </option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Ticket Number</label>
                                    <input type="text" name="ticket_number" id="ticket_number" class="input-panel" value="<?php echo $postVal['ticket_number']; ?>">
                                </div>
                            </div>
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Office Location</label>
                                    <input type="text" name="office_location" id="office_location" placeholder="Type office name/code" class="input-panel" value="<?php echo $postVal['office_location']; ?>">

                                    <input type="hidden" name="hide_office_code" id="hide_office_code" value="<?php echo $postVal['hide_office_code']; ?>">

                                </div>
                            </div>
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Created By</label>
                                    <input type="text" name="t_created_by" id="t_created_by" placeholder="Type employee name/code" class="input-panel" value="<?php echo $postVal['t_created_by']; ?>">

                                    <input type="hidden" name="hide_user_id" id="hide_user_id" value="<?php echo $postVal['hide_user_id']; ?>">
                                </div>
                            </div>
<!-- 
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>From Date</label>
                                    <div class="form-panel">
                                        <input type="text" name="forFromDateSearch" id="forFromDateSearch" placeholder="From" class="input-panel" data-role="datepicker2" value="<?php //echo $postVal['forFromDateSearch']; ?>" readonly="true" autocomplete="off" />
                                    </div>
                                </div> 
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>To Date</label>
                                    <div class="form-panel">
                                        <input type="text" name="forToDateSearch" id="forToDateSearch" placeholder="To" class="input-panel" data-role="datepicker3" value="<?php //echo $postVal['forToDateSearch']; ?>" readonly="true" autocomplete="off" />
                                    </div>
                                </div> 
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Status</label>
                                    <select name="criteria" value="" class="input-panel">
                                        <option value="">Select</option>
                                        <option value="1" <?php //echo ($postVal['criteria'] == 1)? 'selected':''; ?> >New</option>
                                        <option value="5" <?php //echo ($postVal['criteria'] == 5)? 'selected':''; ?> >Re-opened</option>
                                        <option value="6" <?php //echo ($postVal['criteria'] == 6)? 'selected':''; ?> >Forwarded</option>
                                        <option value="2" <?php //echo ($postVal['criteria'] == 2)? 'selected':''; ?> >Assigned</option>
                                    </select>
                                </div>
                            </div>
                        -->
							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('tasks')}}'"><i class="material-icons">not_interested</i>Reset</button>
								</div>
							</div>
						</form>
                    </div>
                    <h4 class="primary-color">{{str_replace("Manage", "",$heading)}} List (Total Records - {{$totalData}})</h4>
                    <div class="table-responsive table-responsive-auto">

                    	@if($sortType == '' || $sortType == 'DESC')
							@php ($sortT = 'ASC')
							@php ($sortIcon = '<i class="fas fa-sort-down"></i>')
						@elseif($sortType == 'ASC')
							@php ($sortT = 'DESC')
							@php ($sortIcon = '<i class="fas fa-sort-up"></i>')
						@endif
						@php ($sortIconAll = '<i class="fas fa-sort"></i>')
						@php ($addtnlQuryStrng = $sortColmn.'/'.$sortType)


                        <table class="table-border table-head-color table-odd-even">
                            <thead>
                                <tr>

                                	<th class="align-center text-nowrap">
										<a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/ticket_number/'.$sortT)}}')">Ticket Number {!! ($sortColmn == 'ticket_number')?$sortIcon:$sortIconAll !!}</a>
									</th>
                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/category/'.$sortT)}}')">Category {!! ($sortColmn == 'category')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/sabcategory/'.$sortT)}}')">Sub Category {!! ($sortColmn == 'sabcategory')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Description</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/created_by/'.$sortT)}}')">Created By {!! ($sortColmn == 'created_by')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/submited_date/'.$sortT)}}')">Created On {!! ($sortColmn == 'submited_date')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Phone No.</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/office_code/'.$sortT)}}')">Office Location {!! ($sortColmn == 'office_code')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Attchments</th>
                                   <th class="align-center text-nowrap">TAT</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/status/'.$sortT)}}')">Status {!! ($sortColmn == 'status')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="text-center text-nowrap">Assign Details</th>
                                   <th class="align-center text-nowrap">Action</th>                             
                                </tr>
                            </thead>
							<tbody>
                            @forelse($Details as $key=>$row)
                                <?php 
                                    $assignInfo = getAssignTicketUserInfo($row->ticket_id);
                                ?>
                            <tr>
                            <td class="align-left text-nowrap">{{$row->ticket_number}}</td>
                            <td class="align-left text-nowrap">{{ getCategorySubcategoryByid($row->category_id) }}</td>
                            <td class="align-left text-nowrap">{{getCategorySubcategoryByid( $row->subcategory_id) }}</td>
                            <td class="align-center text-wrap">

                                <a href="javascript:void(0);" class="tooltip top-center width-50 icon-button button-primary viewProductDetail" data-tooltip="View" data-info="{{$row->description}}" onclick="viewDesc(this);"><i class="fas fa-eye"></i></a>
                            </td>
                            <td class="align-left text-nowrap"><?php echo getUserName($row->created_by); ?></td>
                            <td class="align-left text-nowrap"><?php
                                if($row->status == 5)
                                    echo date('d-m-Y g:i A', strtotime($row->escalated_date));
                                else
                                    echo date('d-m-Y g:i A', strtotime($row->submited_date));
                            ?>            
                            </td>
                            <td class="align-left text-nowrap">
                                <?php
                                            
                                    if($row->phone_no != '')
                                    {
                                        echo $row->phone_no;
                                    }
                                    else{
                                        $userInfo = getUserInfo($row->created_by);

                                        if($userInfo)
                                            echo (trim($userInfo['phone_no']) != '')? trim($userInfo['phone_no']) : "N/A";
                                        else
                                            echo "N/A";
                                    }
                                ?>
                            </td>
                            <td class="align-center text-nowrap">
                                <?php 
                                    $officeData = getOfficeDeatils($row->office_code);
                                    if($officeData)
                                    {
                                        echo $officeData['name'] . " (".$officeData['username'].")";
                                    }else{
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td class="align-center text-nowrap" id="tableRowItem_<?php echo $row->ticket_id; ?>">
                                <?php $attachments = getTicketAttachments($row->ticket_id); ?>
                                <?php if($attachments['counts'] > 0) { ?>
                                    
                                    <a href="javascript:void(0);" class="tooltip top-center width-50 icon-button button-primary viewImages" data-tooltip="Attachments" data-toggle="modal" data-id="<?php echo $row->ticket_id; ?>"><i class="fas fa-paperclip"></i></a>
                                
                                    <?php foreach($attachments['data'] as $file) { ?>
                                        <input type="hidden" name="itemImagesHdn[<?php echo $row->ticket_id; ?>][]" value="{{Storage::disk('s3')->url('public/uploads/' . $file)}}" data-itm="<?php echo $file; ?>">
                                    <?php } ?>
                                
                                <?php } else { ?>
                                    <?php echo "N/A"; ?>
                                <?php }?>
                            </td>
                            <td class="align-left text-nowrap">
                                <?php
                                    if($row->role_id != $row->escalated_role_id)
                                        echo "<span class='button-red'>" . $row->assign_time . " Hr(s) </span>";
                                    else
                                        echo $row->assign_time . " Hr(s)";
                                    
                                ?>
                            </td>
                            <td class="align-center text-nowrap">
                                <?php echo getStatusById($row->status); ?>
								
                                <?php if($row->status == 5) { ?>
                                    <?php $status_info = ticketReasonAndDescription($row->ticket_id); ?>
                                    <a href="javascript:void(0)" class="icon-button" data-reopen="<?php echo $status_info['reopen_desc']; ?>" data-reopen-reason="<?php echo $status_info['reopen_reason']; ?>" data-complete="<?php echo $status_info['complete_desc']; ?>" onclick="reopen_popup(this);"><i class="fas fa-question-circle" aria-hidden="true"></i> </a>
                                
                                <?php } ?>
                                
                                <?php if($row->status == 6) { ?>
                                    <?php $forwarded_info = forwardedDetails($row->ticket_id); ?>

                                    <a href="javascript:void(0)" class="icon-button" data-forward="<?php echo $forwarded_info['forwarded_by']; ?>" data-date="<?php echo $forwarded_info['forwarded_date']; ?>" onclick="forward_popup(this);"><i class="fas fa-question-circle" aria-hidden="true"></i> </a>
                                   
                                <?php } ?>
								
								<?php if($row->status == 2) { ?>
                                    <?php $status_info = ticketReasonAndDescription($row->ticket_id); ?>
                                   <?php $checkReopen = checkTicketReopen($row->ticket_id); 								   
										if($checkReopen == 1)
										{
								   ?>								   
                                    <a href="javascript:void(0)" class="icon-button" data-reopen="<?php echo $status_info['reopen_desc']; ?>" data-reopen-reason="<?php echo $status_info['reopen_reason']; ?>" data-complete="<?php echo $status_info['complete_desc']; ?>" onclick="reopen_popup(this);"><i class="fas fa-question-circle" aria-hidden="true"></i> </a>
                                
                                <?php } }?>
                            </td>
                            <td class="align-center text-nowrap assign-task">
                                
                                <?php if($assignInfo) { ?>
                                   <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <i class="fa fa-user"></i> 
                                            </td>
                                            <td>
                                                <?php echo $assignInfo['assign_user']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </td>
                                            <td>
                                                <?php echo $assignInfo['assign_date']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <?php } else { ?>
                                   <?php if(in_array($row->role_id, getUserSamadhanRoles($session_user_id))) { ?> 
                                    
                                        <a class="icon-button button-primary assign-ticket" data-user="<?php echo $row->username;?>" data-ticket="<?php echo $row->ticket_id;?>" data-status="<?php echo $row->status; ?>" href="javascript:void(0);" title="Assign Ticket"><i class="fas fa-tasks"></i></a>
                                    
                                        <a class="icon-button button-red" href="{{ url('tasks/ticket-forward', $row->ticket_id ) }}" title="Forward Ticket"><i class="fas fa-forward"></i></a>
                                    
                                    <?php } else { ?>
                                        <?php echo "N/A"; ?>
                                    <?php } ?> 
                                <?php } ?> 
                                        
                            </td>
                            <td class="actions  action-tooltip align-center quick-link">
                                <ul>
                                    <li class="quick-link-dropdown">
                                        <a href="javascript:void(0);" class="quick-icon"><span class="material-icons">reorder</span></a>
                                        <ul class="quick-link-dropdown-menu" style="display: none;">
                                            <?php if(in_array($row->role_id, getUserSamadhanRoles($session_user_id))): ?>
                            
                                                <?php if($assignInfo): ?> 
                            
                                                    <?php if($assignInfo['assigned_user_id'] == $session_username && ($row->status != 3 || $row->status != 4)): ?>
                            
                                                        <li>
                                                            <a href="javascript:void(0);" class="icon-button button-green assign-status-update" data-id="<?php echo $row->ticket_id; ?>"><i class="fas fa-check-square"></i><span> Complete</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('tasks/ticketCompleteAttachments', $row->ticket_id ) }}" class="icon-button button-blue"><i class="fas fa-edit"></i><span> Edit Ticket </span></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('tasks/ticket-forward', $row->ticket_id ) }}" class="icon-button button-blue"><i class="fas fa-forward"></i><span> Forward Ticket </span></a>
                                                        </li>
                            
                                                        <?php else: ?>
                                                        <li>
                                                            <a href='javascript:void(0);' class='icon-button button-yellow' data-tooltip='Assigned to other'><i class='fas fa-user' aria-hidden='true'></i><span>Assigned to other</span></a>
                                                        </li>
                                                    <?php endif; ?>  
                            
                                                    <?php else: ?>
                                                        <li>
                                                            <a href='javascript:void(0);' class='icon-button button-yellow'>N/A</a>
                                                        </li>
                                                <?php endif; ?>  
                            
                                                <?php else: ?>
                                                    <li>
                                                        <a href='javascript:void(0);' class='icon-button button-yellow'>N/A</a>
                                                    </li>
                                            <?php endif; ?>  
                                        </ul>
                                    </li>
                                </ul>
                            </td>                   
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="error align-center"><em>No Data Found</em></td>
                                </tr>
                            @endforelse
                         
                        </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
					{!!pagination($limit, $totalData, $pageNo, $pagination_url, $sortColmn.'/'.$sortType)!!}
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.delete_confirmation_modal')

@endsection


@section('js')
<script type="text/javascript">
	$(document).ready(function(){

        var Dep_Id = "<?php echo $postVal['department']; ?>";
        var Cat_Id = "<?php echo $postVal['category']; ?>";  
        var Subcat_Id = "<?php echo $postVal['sub_category']; ?>";  
        //categoryAjax(Dep_Id, Cat_Id);
        //subcategoryAjax(Cat_Id,Subcat_Id);
	    
	    //	Delete Insurance Fees
     	$('.assign-ticket').on('click', function () {
     		var ret = false;
     		var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to assign this ticket to yourself?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_popup">Yes</button></div></div>';
    		showPopUp(divElementSuccess);
            
    		var url = $(this).attr('href');
            var user_id = $(this).data('user');
            var ticket_id = $(this).data('ticket');
            var status_id = $(this).data('status');
    		$('#yes_popup').click(function(){
                
                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
            
                var ajax_url = base_url + 'ajax/ticket-assign';
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: ajax_url,
                    type: "POST",
                    data: { 'ticket_id':ticket_id, 'user_id': user_id, 'status_id': status_id },
                    dataType: 'json',
                    success: function(data) {
                        if (data.flag=='error') {
                            markAsError(obj_product_code, data.msg);
                            is_valid = false;
                        } else {
                            hideLoader("body");
                            showUIMsg(data.msg);
                            $.magnificPopup.close();
                            window.location.reload();
                        }
                    }
                });

            });
            return ret;
	    });

        // Ticket Reopen
        $('.assign-status-update').on('click', function() {
            
            var ticket_id = $(this).data('id');
            var ajax_url = base_url + 'ajax/view-ticket-complete';
            
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
            $("body").addClass('only-read-view');

            var data_string = {ticket_id:ticket_id };
            $.ajax({
                url: ajax_url,
                type: "POST",
                data: data_string,
                dataType: 'html',
                beforeSend: function() {},
                success: function(data) {
                    hideLoader("body");
                    $("body").removeClass('only-read-view');
                    var divElement = '<div class="product_detail_popup"><div class="popup-container popup-container-me"><div class="content">';
                    divElement += data;
                    divElement += '</div><button title="Close" type="button" class="mfp-close">×</button></div></div>';
                    showPopUp(divElement);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });

    $("#office_location").autocomplete({
        source: base_url + "ajax/autoComplete-filter?type=office",
        focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
        },
        select: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox and hidden field
            $(this).val(ui.item.label);
            $("#hide_office_code").val(ui.item.value);
        }
    });

    $("#t_created_by").autocomplete({
        source: base_url + "ajax/autoComplete-filter?type=user",
        focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
        },
        select: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox and hidden field
            $(this).val(ui.item.label);
            $("#hide_user_id").val(ui.item.usercode);
        }
    });  
});

function categoryAjax(DEPARTMENT_ID, CAT_ID = '')
{
    var departmentId = DEPARTMENT_ID;
    if(departmentId == '')
    {
       return false;
    }
    var childLocationElementId = "#category_id";
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url: base_url + "ajax/category",
    type: "POST",
    data: {'department_id': departmentId, 'mode': 'cat' },
    dataType: "json",    
    success: function(response) {
            var selected = '';
            $('#category_id, #sub_category_id').empty();
            $('#category_id, #sub_category_id').val('');
            $('#category_id, #sub_category_id').append($('<option>').text('--Select--').attr('value', ""));
            $.each(response, function(i, obj){
                $('#category_id').append($('<option>').text(obj.name).attr('value', obj.id));
            });
            if(CAT_ID != '')
            {
                $('#category_id').val(CAT_ID);
            }
            
           hideLoader(childLocationElementId); 
        }
    });
    
}

function subcategoryAjax(CAT_ID, SUBCAT_ID = '')
{
    var department_id = $('#department_id').val();
    var category_id = CAT_ID;
    
    if(department_id == '' && category_id == '')
    {
       return false;
    }
    else{

        var childLocationElementId = "#sub_category_id";
        showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
            url: base_url + "ajax/category",
            type: "POST",
            data: { 'department_id': department_id, 'category_id': category_id ,'mode': 'subcat' },
            dataType: "json",
            success: function(response) {
                var selected = '';
                $('#sub_category_id').empty();
                $('#sub_category_id').val('');
                $('#sub_category_id').append($('<option>').text('--Select--').attr('value', ""));
                $.each(response, function(i, obj){
                    $('#sub_category_id').append($('<option>').text(obj.name).attr('value', obj.id));
                });
                if(SUBCAT_ID != '')
                {
                    $('#sub_category_id').val(SUBCAT_ID);
                }
                hideLoader(childLocationElementId);
            }
        });
        
        return true;
    }
}


/* Ticket Raise description view */    
function viewDesc(e)
{
    var $txt = $(e).attr('data-info');
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; Description</h3><p class="margin-bottom-0">'+$txt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
    showPopUp(divElementSuccess);
    return ret;
}    
function forward_popup(e)
{
    var $forwarded_by = $(e).attr('data-forward');
    var $forwarded_date = $(e).attr('data-date');
    var $txt = '<p></p><p style="font-size: 16px;">Forwarded User - '+ $forwarded_by +'</p> '+'<p style="font-size: 16px;">Forwarded Date - '+ $forwarded_date +'</p> ';
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Forwarded Details</h3><p class="margin-bottom-0">'+$txt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
    showPopUp(divElementSuccess);
    return ret;
}

function reopen_popup(e)
{
    var $reopenData = $(e).attr('data-reopen');
    var $reopenReasonData = $(e).attr('data-reopen-reason');
    var $completedData = $(e).attr('data-complete');
    var $txt = '<p></p><p style="font-size: 14px;">Re-open Desc - '+ $reopenData +'</p> '+'<p style="font-size: 14px;">Previous Complete Desc - '+ $completedData +'</p> ';
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Re-opened Details</h3><p class="margin-bottom-0">'+$txt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
    showPopUp(divElementSuccess);
    return ret;
}    

// $(function() {

// var selected_from_date = '';
// var selected_to_date = '';
        
// $('[data-role="datepicker2"]' ).datepicker({
//     showOn: "both",
//     buttonText: "<i class='material-icons'>date_range</i>",
//     dateFormat: 'dd-mm-yy',
//     onSelect : function(date,inst)
//                 {
//                     var selected_date = date.split('-');
//                     var cur_date = new Date();
//                     var from_date = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
                    
//                     cur_date = cur_date.getDate()+'-'+cur_date.getMonth()+'-'+cur_date.getFullYear();
//                     from_date = from_date.getDate()+'-'+from_date.getMonth()+'-'+from_date.getFullYear();
                                                
//                     if( cur_date == from_date ){
//                         var date2 = new Date();
//                         date2.setDate(date2.getDate());
//                         $('[data-role="datepicker3"]').datepicker('option','minDate',date2);
//                     }else{
//                         var date2 = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
//                         $('[data-role="datepicker3"]').datepicker('option','minDate',date2);
//                     }
                    
//                 }
// });
// $('[data-role="datepicker3"]' ).datepicker({
//     showOn: "both",
//     buttonText: "<i class='material-icons'>date_range</i>",
//     dateFormat: 'dd-mm-yy',
//     minDate: ((selected_from_date)?selected_from_date:(new Date(new Date().setDate(new Date().getDate() + 1)))),
//     onSelect : function(date,inst)
//                 {
//                     var selected_date = date.split('-');
                    
//                     var date2 = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
//                     $('[data-role="datepicker2"]').datepicker('option','maxDate',date2);
//                 },
// });
        

// });

</script>
@endsection