@extends('layouts.app')

@section('content')

    
<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{$heading}}</h1>
    <div class=" float-right-sm">
        <a href="{{url('reason/edit')}}" class="button"><i class="material-icons">add</i>Add </a>
    </div>
</div>

<div class="wrapper-fluid">
    <div class="row ">
        <div class="col-la-12">
            <div class="card ">                        
                <div class="card-container">
					<h4 class="primary-color"> Search </h4>
					<div class="row"> 
						<form class="" id="searchForm" name="frm_search_2" method="POST" action="{{action('ReasonController@list')}}" role="search">
							{{ csrf_field() }}
							<div class="col-la-2 col-me-3 col-sm-6">
								<div class="form-panel">
									<label>Reason Type</label>
									<select class="input-panel" name="type" id="type">
                                        <option value=""> Select </option>
                                        <option value="1" <?php echo ($postVal['type'] == 1)? 'selected' : ''; ?>>Complete</option>
                                        <option value="2" <?php echo ($postVal['type'] == 2)? 'selected' : ''; ?>>Re-Open</option>
                                        <option value="3" <?php echo ($postVal['type'] == 3)? 'selected' : ''; ?>>Reinitiate</option>
                                    </select>
								</div>
							</div>

                            <div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>&nbsp;</label>
                                    <div class="form-panel input-inline margin-top-es">
                                        <div class="checkbox">
                                            <input type="checkbox" id="includeDeleted" value="in_active" name="is_active" @if($postVal['is_active'] == 'in_active') checked @endif>
                                            <label for="includeDeleted">Include Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-la-3 col-me-3 col-sm-6">
								<div class="form-panel">
									<label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
									<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i>Search</button>
									<button type="reset" class="button button-gray" onclick="window.location.href='{{url('reason')}}'"><i class="material-icons">not_interested</i>Reset</button>
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

                                	<th class="align-center text-nowrap">Reason</th>
                                    <th class="align-center text-nowrap">Type</th>
								   <th class="align-center text-nowrap">Action</th>                             
                                </tr>
                            </thead>
							<tbody>
                            <?php $types = array('1'=>'Complete','2'=>'Re-Open','3'=>'Reinitiate') ?>   
                            @forelse($Details as $key=>$row)
                            <tr>
                            <td class="align-left text-nowrap @if($row->is_active == 0) only-read-view @endif">{{$row->reason}}</td>

                            <td class="align-center text-nowrap">{{ $types[$row->type] }}</td>
                            
                            <td class="align-center action-tooltip tooltip-width">
								<div class="dropdownList">
									<a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>
                                    <div class="dropdownList-content">

                                        @if($row->is_active == 1)
                                            <a href="{{ url('reason/edit',$row->id) }}" class="icon-button button-primary" ><i class="fas fa-edit"></i><span> Edit</span></a>

                                            <a href="{{ url('reason/destroy', $row->id ) }}" class="icon-button button-red deletepopup" ><i class="fas fa-trash-alt"></i><span> Delete</span></a>
                                        @else
                                            <a href="{{ url('reason/restore', $row->id ) }}" class="icon-button button-red restorepopup" ><i class="fas fa-undo"></i><span> Restore</span></a>
                                        @endif        

                                    </div>
                                </div>
							</td>
                            
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="error align-center"><em>No Data Found</em></td>
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

        //  Restore
        $('.restorepopup').on('click', function () {
            var ret = false;
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to Resote?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_restore">Yes</button></div></div>';
            showPopUp(divElementSuccess);
            
            var url = $(this).attr('href');
            $('#yes_restore').click(function(){
                window.location.replace( url );
            });
            return ret;
        });  
	});
</script>
@endsection