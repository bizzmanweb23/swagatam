@extends('layouts.app')

@section('content')

<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{$heading}}</h1>
    <div class=" float-right-sm">
        <a href="{{url('samadhanRoleUser/edit')}}" class="button"><i class="material-icons">add</i>Add </a>
    </div>
</div>

<div class="wrapper-fluid">
    <div class="row ">
        <div class="col-la-12">
            <div class="card ">                        
                <div class="card-container">
					<h4 class="primary-color"> Search </h4>
					<div class="row"> 
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{action('SamadhanRoleUserAccessController@list')}}" role="search">
							{{ csrf_field() }}
							
                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Department</label>
                                    <select class="input-panel" name="department" id="department_id" onchange="samadhanRoleAjax();">
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
                                    <label>Role</label>
                                    <select class="input-panel role-values" id="dept_role" name="dept_role">
                                        <option value=""> Select </option>
                                            <?php echo getRole($postVal['dept_role'],$postVal['department']); ?>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-la-2 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>User</label>
                                    <input type="text" name="t_created_by" id="t_created_by" placeholder="Type employee name/code" class="input-panel" value="<?php echo $postVal['t_created_by']; ?>">

                                    <input type="hidden" name="hide_user_id" id="hide_user_id" value="<?php echo $postVal['hide_user_id']; ?>">
                                </div>
                            </div>
							
							
							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('samadhanRoleUser')}}'"><i class="material-icons">not_interested</i>Reset</button>
								</div>
							</div>
						</form>
                    </div>
                    <h4 class="primary-color">{{str_replace("Manage", "",$heading)}} List</h4>
                    <div class="table-responsive">

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
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/role_id/'.$sortT)}}')"> Role {!! ($sortColmn == 'role_id')?$sortIcon:$sortIconAll !!}</a>
                                    </th>

                                    <th class="align-center text-nowrap">
                                        <a href="javascript:void(0);" onClick="sortData('{{url($pagination_url.'/'.$pageNo.'/department_id/'.$sortT)}}')"> Department {!! ($sortColmn == 'department_id')?$sortIcon:$sortIconAll !!}</a>
                                    </th>

                                    <th class="align-center text-nowrap">Users</th>
                                   
								   <th class="align-center text-nowrap">Action</th>                             
                                </tr>
                            </thead>
							<tbody>
                            @forelse($Details as $key=>$row)
                            <tr>
                            <td class="align-left text-nowrap">{{ $row->role_name }}</td>
                            <td class="align-left text-nowrap">{{ $row->department_name }}</td>
                            <td class="align-left text-wrap">{!! html_entity_decode($row->user_name) !!}</td>

                            <td class="align-center action-tooltip tooltip-width">
								<div class="dropdownList">
									<a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>
                                    <div class="dropdownList-content">

                                        <a href="{{ url('samadhanRoleUser/edit',[$row->role_id, $row->department_id]) }}" class="icon-button button-primary" ><i class="fas fa-edit"></i><span> Edit</span></a>
                                        
                                    </div>
                                </div>
							</td>
                            
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="error align-center"><em>No Data Found</em></td>
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
            $("#hide_user_id").val(ui.item.value);
        }
    }); 
	   
	});

function samadhanRoleAjax()
{
    var departmentId = $('#department_id').val();
    var selectedRole = $('#dept_role').val();
    var childLocationElementId = "#dept_role";
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url: base_url + "ajax/ajax-samadhan-roles",
    type: "post",
    data: {'department_id': departmentId, 'roles': selectedRole },
    dataType: "json",    
    success: function(response) {
            
            $('.role-values').empty();
            $('.role-values').append($('<option>').text('-- Select Role --').attr('value', ""));
            $.each(response, function(i, obj){
                $('.role-values').append($('<option>').text(obj.name).attr('value', obj.id));
            });

            hideLoader(childLocationElementId);
        }
    });
    
} 
</script>
@endsection