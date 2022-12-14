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
					<div class="row"> 
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{url('taskHistory')}}" role="search">
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
                                    <label>Created By</label>
                                    <input type="text" name="t_created_by" id="t_created_by" placeholder="Type employee name/code" class="input-panel" value="<?php echo $postVal['t_created_by']; ?>">

                                    <input type="hidden" name="hide_user_id" id="hide_user_id" value="<?php echo $postVal['hide_user_id']; ?>">
                                </div>
                            </div>
							
                            <!-- <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Status</label>
                                    <select name="criteria" value="" class="input-panel">
                                        <option value="">Select</option>
                                        <option value="3" <?php //echo ($postVal['criteria'] == 3)? 'selected':''; ?> >Completed</option>
                                        <option value="4" <?php //echo ($postVal['criteria'] == 4)? 'selected':''; ?> >Closed</option>
                                    </select>
                                </div>
                            </div>
                            
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
                            </div> -->

							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('taskHistory')}}'"><i class="material-icons">not_interested</i>Reset</button>
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
                                   <th class="align-center text-nowrap">Raise Description</th>
                                   <th class="align-center text-nowrap">Resolved Description</th>
                                   <th class="align-center text-nowrap">Office Location</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/submited_date/'.$sortT)}}')">Created On {!! ($sortColmn == 'submited_date')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                    <th class="align-center text-nowrap">Created By</th>
                                   <th class="align-center text-nowrap">Resolved On</th>
                                   <th class="align-center text-nowrap">Resolution Time / TAT</th>
                                                                
                                </tr>
                            </thead>
							<tbody>
                            @forelse($Details as $key=>$row)
                            <tr>
                            <td class="align-left text-nowrap">{{$row->ticket_number}}</td>
                            <td class="align-left text-nowrap">{{ getCategorySubcategoryByid($row->category_id) }}</td>
                            <td class="align-left text-nowrap">{{ getCategorySubcategoryByid($row->subcategory_id) }}</td>
                            <td class="align-center text-nowrap" id="tableRowItem_<?php echo $row->id; ?>">

                                <a href="javascript:void(0)" class="tooltip top-center width-50 icon-button button-primary" data-tooltip="View" data-title="Ticket Raise Description" data-info="{{$row->description}}" onclick="viewDesc(this);"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                <?php $attachments = getTicketAttachments($row->id); ?>
                                    <?php if($attachments['counts'] > 0) { ?>
                                        <a href="javascript:void(0);" class="success-color viewImages text-right" data-tooltip="Attachments" data-toggle="modal" data-id="<?php echo $row->id; ?>"><i class="fa fa-paperclip"></i></a>
                                
                                        <?php foreach($attachments['data'] as $file) { ?>
                                            <input type="hidden" name="itemImagesHdn[<?php echo $row->id; ?>][]" value="{{Storage::disk('s3')->url('public/uploads/' . $file)}}" data-itm="<?php echo $file; ?>">
                                        <?php } ?>
                                    <?php } ?>
                            </td>
                            <td class="align-center text-nowrap" id="tableRowItem_<?php echo $row->ticket_number; ?>">
                                <a href="javascript:void(0)" class="tooltip top-center width-50 icon-button button-primary" data-tooltip="View" data-title="Ticket Resolved Description" data-info="{{$row->complete_desc}}" onclick="viewDesc(this);"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <?php $completeAttachment = getTicketAttachmentFiles($row->id, 2); ?>
                                <?php if($completeAttachment['counts'] > 0) { ?>
                                    <a class="success-color viewImages text-right" title="Attachment" data-toggle="modal" data-id="<?php echo $row->ticket_number; ?>"  href="#"> <i class="fa fa-paperclip" aria-hidden="true"></i></a>

                                    <?php foreach($completeAttachment['data'] as $file1) { ?>
                                        <input type="hidden" name="itemImagesHdn[<?php echo $row->ticket_number; ?>][]" value="{{Storage::disk('s3')->url('public/uploads/' . $file1)}}" data-itm="<?php echo $file1; ?>">
                                    <?php } ?>

                                <?php }  ?>

                            </td>
                            <td class="text-center text-nowrap">
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
                            <td class="align-left text-nowrap">{{ date('d-m-Y g:i A', strtotime($row->submited_date)) }}</td>
                            <td class="align-left text-nowrap">
                                <?php echo getUserName($row->created_by); ?>                            
                            </td> 
                            <td class="align-left text-nowrap">{{date('d-m-Y g:i A', strtotime($row->completed_date)) }}</td>

                            <td class="align-center text-nowrap">
                                <?php
                                    /* Get RO for holidays */
                                    $RO_CODE = getRoCodeForHolidays($row->office_code,$row->office_type);
                                    $total_calculation_hrs = get_working_hours($row->submited_date,$row->completed_date,$RO_CODE);
                                    echo $total_calculation_hrs." / ".$row->assign_time; 
                                ?>
                            </td>
                               
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="error align-center"><em>No Data Found</em></td>
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
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Description</h3><p class="margin-bottom-0">'+$txt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
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