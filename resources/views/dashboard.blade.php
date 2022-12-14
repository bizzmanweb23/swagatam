@extends('layouts.app')

@section('content')

<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">Dashboard</h1>

    <div class=" float-right-sm margin-bottom-sm align-right">
        <div class=" float-right-sm">
        </div>
    </div>

</div>


<div class="wrapper-fluid">

    <div class="row">
        <div class="col-la-12">
            <div class="dashboard-widget">
                <div class="card ">
                    <div class="card-container clearfix">
                        <div class="row">
                            <div class="col-la-3 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <label>Zone</label>
                                    <select class="input-panel" id="select-box">
                                        <option>Select Zone</option>
                                        <option>In Inventory</option>
                                        <option>In-Transit</option>
                                        <option>Out for Delivery</option>
                                        <option>Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-la-3 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <label>Region</label>
                                    <select class="input-panel" id="select-box">
                                        <option>Select Region</option>
                                        <option>In Inventory</option>
                                        <option>In-Transit</option>
                                        <option>Out for Delivery</option>
                                        <option>Delivered</option>
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="col-la-2 col-me-2 col-sm-6">
                                <label>Delivery Date</label>
                                <div class="form-panel">
                                    <input type="text" placeholder="Date" class="input-panel"
                                        data-role="datepicker">
                                </div>
                            </div> -->
                            <div class="col-la-3 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <label>Branch</label>
                                    <select class="input-panel" id="select-box">
                                        <option>Select Branch</option>
                                        <option>In Inventory</option>
                                        <option>In-Transit</option>
                                        <option>Out for Delivery</option>
                                        <option>Delivered</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-la-3 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <label class="hidden-es">&nbsp;</label>
                                    <div class="clearfix"></div>
                                    <button class="button">
                                        <span class="material-icons">search</span> 
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-smart-box">
        <div class="row ">
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/Application.svg"></i>
                            L.A.F
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">09</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">9:12 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/NFeedback.svg"></i>
                            N Feedback
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">12</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">11:12 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/GFormation.svg"></i>
                            G Formation
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">9</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">4:55 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/CGT1.svg"></i>
                            CGT1
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">02</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">5:12 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/CGT2.svg"></i>
                            CGT2
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">05</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">7:55 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/CVerification.svg"></i>
                            C Verification
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">11</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">10:09 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/GRT.svg"></i>
                            GRT
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">07</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">8:40 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-la-3 col-me-4 col-sm-4">
                <div class="card top-overview-box margin-bottom-sm">
                    <div class="card-container top-overview-card-container">
                        <div class="icon-view">
                            <i class="icon-dashboard"><img src="{{env('RESOURCE_URL')}}/public/images/LUC.svg"></i>
                            LUC
                        </div>
                        <div class="application-amount">
                            <div class="top-overview-box-value">
                                Applications Count
                                <span class="overview-big-text">01</span>                                        
                            </div>
                            <div class="top-overview-box-value">
                                Turnaround Time
                                <span class="overview-big-text">2:12 hours</span>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <div class="col-la-12">
            <!-- Todays DL Order/ Picklist  -->
            <div class="dashboard-widget">
                <div class="card ">
                    <div class="card-container">
                        <!-- <div class="dashboard-box-header">
                            <h5 class="text-primary primary-color float-left-sm">
                                Table
                            </h5>
                        </div> -->

                        <div class="table-responsive">
                            <table class="table-odd-even no-margin table-head-color border-round">
                                <thead>
                                    <tr>
                                        <th class="align-center" width="100px">Total Sourcing</th>
                                        <th class="align-center">Application Count</th>
                                        <th class="align-center">Application Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td class="align-center">08</td>
                                        <td class="align-center">12</td>
                                        <td class="align-center">12,0000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Todays DL Order/ Picklist  -->
        </div>

    </div>
    </div>
</div>
@endsection
    



       