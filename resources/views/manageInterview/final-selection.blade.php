@extends('layouts.app')
@section('content')
<div class="admin-content-header">
	<h3 class="float-left-sm primary-color">{{ $heading?? 'Final Selection' }}</h3>
</div>
<div class="wrapper-fluid">
 
 
<div class="row">
<div class="col-la-12">
    <div class="card">
        <div class="card-container clearfix">
        <h4 class="primary-color">Manage List</h4>
        <div class="table-responsive">
        <table class="table-border no-margin table-head-color manage-aircraft-table table-odd-even">
        <thead>
        <th>Title</th>
        <th>Action</th>
        </thead>
        <tbody class="table-body">
            <tr>
            <td>Title</td>
            <td class="align-center action-tooltip tooltip-width">
            <div class="dropdownList">
            <a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>
            <div class="dropdownList-content">
                    <a href="javascript:void(0)" class="icon-button button-primary" ><i class="fas fa-edit"></i><span> Edit</span></a>

                    <a href="javascript:void(0)" class="icon-button button-primary" ><i class="fas fa-money-bill"></i><span> Set Loan Limit</span></a>

            </div>
            </div>
            </td>
            </tr>
        </tbody>
        </table>
        </div>
        <div class="clearfix"></div> 
        @include('pages.partials.sample-pagination-html')
        </div>
    </div>
</div>
</div>  
</div> 
@include('layouts.delete_confirmation_modal')

@endsection
@section('js')

@endsection
