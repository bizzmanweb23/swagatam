@extends('layouts.app')
@section('content')

    <div class="wrapper-fluid">
        <div class="row">
            <div class="col-la-2 col-me-6 col-sm-6">
                <div class="form-panel">
                    <label class="hidden-es">&nbsp;</label>
                    <div class="clearfix"></div>
                    <button type="submit" search="2" id="go-back"   class="button button-info">
                        Main Page
                    </button>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-la-12">
                <div class="card ">
                    <div class="card-container">
                        <h4 class="primary-color">View job </h4>
                        <div class="row">
                            <form class="col-sm-12" id="save_job_form" name="frm_search_2"   role="search"  autocomplete="off">
                                {{--                                <input type="hidden" id="h_search" name="h_search" value="" />--}}
                                {{--                                <input type="hidden" id="h_extension" name="h_extension" value="" />--}}
                                {{ csrf_field() }}
                                @foreach($result as $row)

                                    <div class="row">
                                        <div class="col-la-6 col-me-3 col-sm-6">
                                            <table class="table table-sm border table-stripped">
                                                <tbody>
                                                <tr>
                                                    <td><strong>Job Code</strong></td>
                                                    <td> : {{$row->job_code}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job link</strong></td>
                                                    <td> : {{url($row->job_link)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Title</strong></td>
                                                    <td> : {{$row->job_title}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Created By</strong></td>
                                                    <td> : {{ $row->job_created_by }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Updated By</strong></td>
                                                    <td> : {{ $row->job_updated_by }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Validity Date</strong></td>
                                                    <td> : {{ $row->job_created_by }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Effective Date</strong></td>
                                                    <td> : {{ $row->job_created_by }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>job Zone</strong></td>
                                                    <td> : {{ $row->job_zone}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Reign</strong></td>
                                                    <td> : {{ $row->job_region }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Branch</strong></td>
                                                    <td> : {{ $row->job_branch }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Job Description</strong></td>
                                                    <td> : {{ $row->job_description }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/chosen/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','#go-back',function(){
                document.location.href = '{{ url('jobs') }}';
            });
            $(document).on('click','.save-job-btn', function(data){

                $job = $('#save_job_form').serialize();

                $.ajax({
                    url : '{{ url("store/job") }}',
                    method : 'post',
                    data : $job,
                    success : function(data){


                        if (Notification.permission !== "granted")
                        {
                            Notification.requestPermission();
                        }
                        else
                        {
                            var notification = new Notification('New Job Added', {
                                icon:"url('public/assets/Logo-small.png')",
                                body: 'this is body',
                            });
                            /* Remove the notification from Notification Center when clicked.*/
                            notification.onclick = function () {
                                window.open('url');
                            };
                            /* Callback function when the notification is closed. */
                            notification.onclose = function () {
                                console.log('Notification closed');
                            };
                        }
                    },
                    error : function(response){
                        $.each(response.responseJSON.errors, function(key, value){
                            var notification = new Notification( value, {
                                body: '',
                            });
                        });
                    }
                });
            });
            //	Delete Insurance Fees
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
    </script>

    

@endsection
