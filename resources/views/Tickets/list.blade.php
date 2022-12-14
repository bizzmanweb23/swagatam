@extends('layouts.app')

@section('content')

    
<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{$heading}}</h1>
    <div class=" float-right-sm">
        <a href="{{url('tickets/edit')}}" class="button"><i class="material-icons">add</i>Add </a>
    </div>
</div>


<div class="wrapper-fluid">
    <div class="row ">
        <div class="col-la-12">
            <div class="card ">                        
                <div class="card-container">
					<h4 class="primary-color"> Search </h4>
					<div class="row"> 
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{url('tickets')}}" role="search">
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
                                        <option value="3" <?php //echo ($postVal['criteria'] == 3)? 'selected':''; ?> >Completed</option>
                                    </select>
                                </div>
                            </div> -->
							
							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('tickets')}}'"><i class="material-icons">not_interested</i>Reset</button>
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
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/subcategory/'.$sortT)}}')">Sub Category {!! ($sortColmn == 'subcategory')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Description</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/department/'.$sortT)}}')">Department {!! ($sortColmn == 'department')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Attchments</th>
                                   <th class="align-center text-nowrap">No. of Cases</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/submited_date/'.$sortT)}}')">Created Date {!! ($sortColmn == 'submited_date')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Office Location</th>
                                   <th class="align-center text-nowrap">Office Code</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/status/'.$sortT)}}')">Status {!! ($sortColmn == 'status')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">Assign Details</th><!-- 9-2-22 -->
                                   <th class="align-center text-nowrap">Action</th>                             
                                </tr>
                            </thead>
							<tbody>
                            @forelse($Details as $key=>$row)
                            <tr>
                            <td class="align-left text-nowrap">{{$row->ticket_number}}</td>
                            <td class="align-left text-nowrap">{{$row->category_name}}</td>
                            <td class="align-left text-nowrap">{{$row->subcategory_name}}</td>
                            <td class="align-center text-wrap">
                            <a href="javascript:void(0);" class="tooltip top-center viewProductDetail width-50" data-tooltip="View" data-info="{{$row->description}}" onclick="viewDesc(this);" > <i class="fas fa-eye"></i> </a>
                                <!-- <a href="javascript:void(0);" class="icon-button button-primary viewProductDetail" data-info="{{$row->description}}" onclick="viewDesc(this);"><i class="fas fa-eye"></i><span> View</span></a> -->
                            </td>
                            <td class="align-left text-nowrap">{{$row->department_name}}</td>
                            <td class="align-center text-nowrap" id="tableRowItem_<?php echo $row->id; ?>">
                                <?php $attachments = getTicketAttachments($row->id); ?>
                                <?php if($attachments['counts'] > 0) { ?>
                                    
                                    <a href="javascript:void(0);" class="tooltip top-center width-50 icon-button button-primary viewImages " data-tooltip="Attachments" data-toggle="modal" data-id="<?php echo $row->id; ?>"><i class="fas fa-eye"></i></a>
                                
                                    <?php foreach($attachments['data'] as $file) { ?>
                                        <input type="hidden" name="itemImagesHdn[<?php echo $row->id; ?>][]" value="{{Storage::disk('s3')->url('public/uploads/' . $file)}}" data-itm="<?php echo $file; ?>">
                                    <?php } ?>
                                
                                <?php } else { ?>
                                    <?php echo "N/A"; ?>
                                <?php }?>
                            </td>
                            <td class="align-left text-nowrap">{{$row->no_of_cases}}</td>
                            <td class="align-left text-nowrap"><?php echo date('d-m-Y g:i A', strtotime($row->submited_date))?></td>
                            <td class="align-left text-nowrap">{{$row->office_type}}</td>
                            <td class="align-left text-nowrap">{{$row->office_code}}</td>
                            <td class="align-center text-nowrap" id="tableRowItem_<?php echo $row->ticket_number; ?>">
                                <?php
                                    $statusClass = "";
                                    if($row->status == 1) $statusClass = "primary-color";
                                    if($row->status == 3) $statusClass = "success-color";
                                    if($row->status == 5) $statusClass = "warning-color";
                                    if($row->status == 6) $statusClass = "error-color";  
                                ?>
                                <?php echo "<p class='".$statusClass."'>". getStatusById($row->status) . "</p>"; ?>
                                <?php if($row->status == 3) { ?>
                                    <?php 
                                        $status_info = ticketReasonAndDescription($row->id); 
                                        $completeAttachment = getTicketAttachmentFiles($row->id, 2);
                                    ?>
                                    <p class="align-center">
                                        <a href="javascript:void(0)" data-com-res="<?php echo $status_info['complete_reason']; ?>" data-comp-dec="<?php echo $status_info['complete_desc']; ?>" onclick="complete_status_popup(this);" class="success-color"><i class="fas fa-check-circle success-color" aria-hidden="true"></i></a><!-- 9-2-22 -->
                                        
                                        <?php if($completeAttachment['counts'] > 0) { ?>
                                            <a class="icon-button button-primary viewImages text-right" title="Attachment" data-toggle="modal" data-id="<?php echo $row->ticket_number; ?>"  href="#"><i class="fa fa-paperclip" aria-hidden="true"></i></a>

                                            <?php foreach($completeAttachment['data'] as $file1) { ?>
                                                <input type="hidden" name="itemImagesHdn[<?php echo $row->ticket_number; ?>][]" value="{{Storage::disk('s3')->url('public/uploads/' . $file1)}}" data-itm="<?php echo $file1; ?>">
                                            <?php } ?>

                                        <?php }  ?>
                                    </p>
                                <?php } ?>
                                
                                <?php if($row->status == 6) { ?>
                                    <?php $forwarded_info = forwardedDetails($row->id); ?>
                                   
                                    <a href="javascript:void(0)" class="error-color" data-forward="<?php echo $forwarded_info['forwarded_by']; ?>" data-date="<?php echo $forwarded_info['forwarded_date']; ?>" onclick="forward_popup(this);"><i class="fas fa-chevron-circle-right" aria-hidden="true"></i> </a>
                                
                                <?php } ?>
                                 <?php if($row->status == 5) { ?>
                                    <?php $status_info = ticketReasonAndDescription($row->id); ?>
                                   
                                    <a href="javascript:void(0)" class="icon-button" data-reopen="<?php echo $status_info['reopen_desc']; ?>" data-reopen-reason="<?php echo $status_info['reopen_reason']; ?>" data-complete="<?php echo $status_info['complete_desc']; ?>" onclick="reopen_popup(this);"><i class="fas fa-question-circle" aria-hidden="true"></i> </a>
                                
                                <?php } ?>       
								<?php if($row->status == 2) { ?>
                                    <?php $status_info = ticketReasonAndDescription($row->id); ?>
                                   <?php $checkReopen = checkTicketReopen($row->id); 								   
										if($checkReopen == 1)
										{
								   ?>								   
                                    <a href="javascript:void(0)" class="icon-button" data-reopen="<?php echo $status_info['reopen_desc']; ?>" data-reopen-reason="<?php echo $status_info['reopen_reason']; ?>" data-complete="<?php echo $status_info['complete_desc']; ?>" onclick="reopen_popup(this);"><i class="fas fa-question-circle" aria-hidden="true"></i> </a>
                                
                                <?php } }?>
                                        
                            </td>

                            <td class="text-center text-wrap assign-task">
                                <?php 
                                    $assignInfo = getAssignTicketUserInfo($row->id);
                                ?>
                                <?php if($assignInfo) { ?>
                                   <table class="table table-bordered no-margin" style="min-width: 180px;"><!-- 9-2-22--> 
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
                                       <p>N/A</p>
                                <?php } ?>
                                        
                            </td>

                            <td class="actions  action-tooltip align-center quick-link">
                                <ul>
                                    <li class="quick-link-dropdown">
                                        <a href="javascript:void(0);" class="quick-icon"><span class="material-icons">reorder</span></a>
                                        <ul class="quick-link-dropdown-menu" style="display: none;">
                                            @if($row->status == 3)
                                                <?php $checkReopen = checkTicketReopen($row->id); ?>

                                                @if($checkReopen == 0)
                                                    <li>
                                                        <a href="javascript:void(0);" class="icon-button button-blue reopen-ticket" data-id="<?php echo $row->id; ?>"><i class="fas fa-folder-open"></i><span> Reinitiate</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('tickets/reopen', $row->id ) }}" class="icon-button button-blue reopen-ticket-att"><i class="fas fa-paperclip"></i><span> Reinitiate Attachments</span></a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ url('tickets/close', $row->id ) }}" class="icon-button button-red close-ticket colsepopup"><i class="fas fa-times"></i><span> Close</span></a>
                                                </li>
                                            @else
                                                @if($row->status != 7)
                                                    <li>
                                                        <a href="{{ url('tickets/cancel', $row->id ) }}" class="icon-button button-red cancel-ticket"><i class="fas fa-times"></i><span> Cancel</span></a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="javascript:void(0);" class="icon-button button-red"><i class="fas fa-times"></i> Cancelled</a>
                                                    </li>
                                                @endif 
                                            @endif
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
        categoryAjax(Dep_Id, Cat_Id);
        subcategoryAjax(Cat_Id,Subcat_Id);
	    
	    //	Delete Insurance Fees
     	$('.cancel-ticket').on('click', function () {
     		var ret = false;
     		var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Confirm!</h3><p class="margin-bottom-0">Are you sure you want to cancel this ticket?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_delete">Yes</button></div></div>';
    		showPopUp(divElementSuccess);
            
    		var url = $(this).attr('href');
    		$('#yes_delete').click(function(){
                window.location.replace( url );
            });
            return ret;
	    });

        //  Restore
        $('.colsepopup').on('click', function () {
            var ret = false;
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Confirm!</h3><p class="margin-bottom-0">Are you sure you want to close this ticket?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_restore">Yes</button></div></div>';
            showPopUp(divElementSuccess);
            
            var url = $(this).attr('href');
            $('#yes_restore').click(function(){
                window.location.replace( url );
            });
            return ret;
        });


        // Ticket Reopen
        $('.reopen-ticket').on('click', function() {
            
            var ticket_id = $(this).data('id');
            var ajax_url = base_url + 'ajax/view-ticket-reopen';
            
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

/* complete description popup show */    
function complete_status_popup(e)
{
    var $complete_res = $(e).attr('data-com-res');
    var $complete_desc = $(e).attr('data-comp-dec');
    
    if($complete_desc != '')
        var $completeTxt = '<p style="font-size: 16px;"><b>description - </b> '+$complete_desc+'</p>';
    else
       var $completeTxt = '<p style="font-size: 16px;"><b>description - </b> '+$complete_res+'</p>';   
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Complete Information</h3><p class="margin-bottom-0">'+$completeTxt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
    showPopUp(divElementSuccess);
    return ret;
}

/* Ticket Raise description view */    
function viewDesc(e)
{
    var $txt = $(e).attr('data-info');
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Description</h3><p class="margin-bottom-0">'+$txt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
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