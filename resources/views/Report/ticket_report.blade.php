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
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{url('ticketReports')}}" role="search">
							{{ csrf_field() }}
							
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Ticket Number</label>
                                    <input type="text" name="ticket_number" id="ticket_number" class="input-panel" value="<?php echo $postVal['ticket_number']; ?>">
                                </div>
                            </div>
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>From Date</label>
                                    <div class="form-panel">
                                        <input type="text" name="forFromDateSearch" id="forFromDateSearch" placeholder="From" class="input-panel" data-role="datepicker2" value="<?php echo $postVal['forFromDateSearch']; ?>" readonly="true" autocomplete="off" />
                                    </div>
                                </div> 
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>To Date</label>
                                    <div class="form-panel">
                                        <input type="text" name="forToDateSearch" id="forToDateSearch" placeholder="To" class="input-panel" data-role="datepicker3" value="<?php echo $postVal['forToDateSearch']; ?>" readonly="true" autocomplete="off" />
                                    </div>
                                </div> 
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Criteria</label>
                                    <select name="criteria" value="" class="input-panel">
                                        <option value="">--Select Criteria--</option>
                                        <option value="1" <?php echo ($postVal['criteria'] == 1)? 'selected':''; ?> >New</option>
                                        <option value="2" <?php echo ($postVal['criteria'] == 2)? 'selected':''; ?> >Assigned</option>
                                        <option value="3" <?php echo ($postVal['criteria'] == 3)? 'selected':''; ?> >Completed</option>
                                        <option value="4" <?php echo ($postVal['criteria'] == 4)? 'selected':''; ?> >Close</option>
                                        <option value="5" <?php echo ($postVal['criteria'] == 5)? 'selected':''; ?> >Re-open</option>
                                    </select>
                                </div>
                            </div>
							
							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('ticketReports')}}'"><i class="material-icons">not_interested</i>Reset</button>

                                    <button type="submit" search="3" id="btn_submit_excel" name="btn_submit_excel" value="excel" class="button excel-icon"><i class="far fa-file-excel"></i>&nbsp;&nbsp;Download</button>

								</div>
							</div>
						</form>
                    </div>
                    <h4 class="primary-color">{{str_replace("Manage", "",$heading)}} List</h4>
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
                                   <th class="align-center text-nowrap">Raise Description</th>
                                   <th class="align-center text-nowrap">Resolved Description</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/office_code/'.$sortT)}}')">Office Location {!! ($sortColmn == 'office_code')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/department_id/'.$sortT)}}')">Department {!! ($sortColmn == 'department_id')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/submited_date/'.$sortT)}}')">Created On {!! ($sortColmn == 'submited_date')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   
                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/completed_date/'.$sortT)}}')">Resolved On {!! ($sortColmn == 'completed_date')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                    <th class="text-center">Current assign By</th>
                                    <th class="text-center">Resolved By</th>
                                   <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/status/'.$sortT)}}')">Status {!! ($sortColmn == 'status')?$sortIcon:$sortIconAll !!}</a>
                                    </th>                             
                                </tr>
                            </thead>
							<tbody>
                            @forelse($Details as $key=>$row)
                                
                            <tr>
                            <td class="align-center text-nowrap">{{$row->ticket_number}}</td>
                            <td class="align-center text-nowrap">{{ getCategorySubcategoryByid($row->category_id) }}</td>
                            <td class="align-center text-nowrap">{{getCategorySubcategoryByid( $row->subcategory_id) }}</td>
                            <td class="align-center text-wrap">
                                <a href="javascript:void(0);" class="tooltip top-center width-50 icon-button button-primary viewProductDetail" data-tooltip="View"  data-info="{{$row->description}}" onclick="viewDesc(this);"><i class="fas fa-eye"></i></a>
                            </td>

                            <td class="align-center text-wrap">
                                
                                <a href="javascript:void(0);" class="tooltip top-center width-50 icon-button button-primary viewProductDetail" data-tooltip="View"  data-info="{{$row->complete_desc}}" onclick="viewDesc(this);"><i class="fas fa-eye"></i></a>
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

                             <td class="align-center text-nowrap">
                                <?php echo getDepartmentByid($row->department_id); ?>
                            </td>

                            <td class="align-center text-nowrap">
                                <?php echo $row->created_on; ?>
                            </td>
                            <td class="align-center text-nowrap">
                                <?php echo ($row->resolved_on != '00-00-0000 00:00')? $row->resolved_on : '-';?>
                            </td>
                            <td class="align-center text-nowrap">
                                <?php echo getUserName($row->current_resolve_by); ?>
                            </td>
                            <td class="align-center text-nowrap">
                                <?php echo getUserName($row->resolved_by); ?>
                            </td>
                            <td class="align-center text-nowrap">
                                <?php echo getStatusById($row->status); ?>
                            </td>
                            
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="error align-center"><em>No Data Found</em></td>
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

});

/* Ticket Raise description view */    
function viewDesc(e)
{
    var $txt = $(e).attr('data-info');
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i>Description</h3><p class="margin-bottom-0">'+$txt+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
    showPopUp(divElementSuccess);
    return ret;
}

$(function() {

        var selected_from_date = '';
        var selected_to_date = '';
                
        $('[data-role="datepicker2"]' ).datepicker({
            showOn: "both",
            buttonText: "<i class='material-icons'>date_range</i>",
            dateFormat: 'dd-mm-yy',
            onSelect : function(date,inst)
                        {
                            var selected_date = date.split('-');
                            var cur_date = new Date();
                            var from_date = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
                            
                            cur_date = cur_date.getDate()+'-'+cur_date.getMonth()+'-'+cur_date.getFullYear();
                            from_date = from_date.getDate()+'-'+from_date.getMonth()+'-'+from_date.getFullYear();
                                                        
                            if( cur_date == from_date ){
                                var date2 = new Date();
                                date2.setDate(date2.getDate());
                                $('[data-role="datepicker3"]').datepicker('option','minDate',date2);
                            }else{
                                var date2 = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
                                $('[data-role="datepicker3"]').datepicker('option','minDate',date2);
                            }
                            
                        }
        });
        $('[data-role="datepicker3"]' ).datepicker({
            showOn: "both",
            buttonText: "<i class='material-icons'>date_range</i>",
            dateFormat: 'dd-mm-yy',
            minDate: ((selected_from_date)?selected_from_date:(new Date(new Date().setDate(new Date().getDate() + 1)))),
            onSelect : function(date,inst)
                        {
                            var selected_date = date.split('-');
                            
                            var date2 = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
                            $('[data-role="datepicker2"]').datepicker('option','maxDate',date2);
                        },
        });
                
        
     });

</script>
@endsection