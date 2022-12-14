@extends('layouts.app')

@section('content')

<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{$heading}}</h1>
    <div class=" float-right-sm">
        <a href="{{url('route/edit')}}" class="button"><i class="material-icons">add</i>Add </a>
    </div>
</div>


<div class="wrapper-fluid">
    <div class="row ">
        <div class="col-la-12">
            <div class="card ">                        
                <div class="card-container">
					<h4 class="primary-color"> Search </h4>
					<div class="row"> 
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{action('SamadhanRoutesController@list')}}" role="search">
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
                                            <?php echo getCategorySubcategoryOptions("0", $postVal['category'], $postVal['department']); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Sub Category</label>
                                    <select class="input-panel" name="sub_category" id="sub_category_id">
                                        <option value=""> Select </option>
                                            <?php echo getCategorySubcategoryOptions($postVal['category'], $postVal['sub_category'], $postVal['department']); ?>
                                    </select>
                                </div>
                            </div>
							
							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('route')}}'"><i class="material-icons">not_interested</i>Reset</button>
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


                        <table class="table-border no-margin table-head-color manage-aircraft-table table-odd-even">
                            <thead>
                                <tr>

                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/department_id/'.$sortT)}}')"> Department {!! ($sortColmn == 'department_id')?$sortIcon:$sortIconAll !!}</a>
                                    </th>

                                	<th class="align-center text-nowrap">
										<a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/category_id/'.$sortT)}}')"> Category {!! ($sortColmn == 'category_id')?$sortIcon:$sortIconAll !!}</a>
									</th>
                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/subcategory_id/'.$sortT)}}')"> Sub Category {!! ($sortColmn == 'subcategory_id')?$sortIcon:$sortIconAll !!}</a>
                                    </th>

                                    <th class="align-center text-nowrap">Route</th>
                                    <th class="align-center text-nowrap">Total TAT</th>

                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/created_on/'.$sortT)}}')"> Created On {!! ($sortColmn == 'created_on')?$sortIcon:$sortIconAll !!}</a>
                                    </th>
                                   
								   <th class="align-center text-nowrap">Action</th>                             
                                </tr>
                            </thead>
							<tbody>
                            @forelse($Details as $key=>$row)
                            <tr>
                            
                            <td class="align-left text-nowrap">{{ $row->long_name . " (".$row->short_name.")" }}</td>
                            <td class="align-left text-nowrap">{{ $row->category_name }}</td>
                            <td class="align-left text-nowrap">{{ $row->subcategory_name }}</td>
                            <td class="align-left text-nowrap">{{ $row->routes }}</td>
                            <td class="align-left text-nowrap">{{ $row->total_tat }}</td>
                            <td class="align-center text-nowrap">
                                {{ date('d-m-Y g:i A', strtotime($row->created_on)) }}
                            </td>

                            <td class="align-center action-tooltip tooltip-width">
								<div class="dropdownList">
									<a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>
                                    <div class="dropdownList-content">

                                        <a href="{{ url('route/edit',[$row->department_id, $row->category_id, $row->subcategory_id]) }}" class="icon-button button-primary" ><i class="fas fa-edit"></i><span> Edit</span></a>

                                        <a href="{{ url('route/destroy', [$row->department_id, $row->category_id, $row->subcategory_id]) }}" class="icon-button button-red deletepopup" ><i class="fas fa-trash-alt"></i><span> Delete</span></a>
                                        
                                    </div>
                                </div>
							</td>
                            
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="error align-center"><em>No Data Found</em></td>
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
	    //	Delete
     	$('.deletepopup').on('click', function () {
     		var ret = false;
     		var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to Delete?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_delete">Yes</button></div></div>';
    		showPopUp(divElementSuccess);
            
    		var url = $(this).attr('href');
    		$('#yes_delete').click(function(){
                window.location.replace( url );
            });
            return ret;
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

</script>
@endsection