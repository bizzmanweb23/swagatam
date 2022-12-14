<form  id="search_form">
    {{ csrf_field() }}
<div class="row">
    <div class="col-la-12 col-me-6 col-sm-6">
        <div class="card">
            <div class="card-container clearfix">
                <div class="row">
                    <div class="col-la-2 col-me-3 col-sm-6">
                        <div class="form-panel">
                            <label for="statusSearch">Select Zone</label>
                            <div class="form-panel">
                                <select name="jobZone" id="zoneSearch" class="input-panel chosen-select">
                                                    <option value="">-- Select Zone --</option>
                                                    <option value="30001">Zone 1</option>
                                                    <option value="30002">Zone 2</option>
                                                    <option value="30003">Zone 3</option>
                                                    <option value="30004">Zone 4</option>
                                                </select>
                                <span class="error-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-la-2 col-me-3 col-sm-6">
                        <div class="form-panel">
                            <label for="regionSearch">Region</label>

                            <div class="form-panel">
                                <select name="jobRegion" id="regionSearch" class="input-panel select_custom_rgn"  >
                                    <option value="4001">Region 1</option>
                                    <option value="4002">Region 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-la-2 col-me-3 col-sm-6">
                        <div class="form-panel">
                            <label for="branchSearch">Branch</label>

                            <div class="form-panel">
                                <select name="jobBranch" id="branchSearch" class="input-panel select_custom_brnch"  >
                                    <option value="30101">Amtala 1</option>
                                    <option value="30102">Maheshtala</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-la-2 col-me-6 col-sm-6">
                        <div class="form-panel">
                            <label class="hidden-es">&nbsp;</label>
                            <div class="clearfix"></div>
                            <button type="button" search="2" id="search-form-btn" name="btn_submit" class="button button-info"><i class="material-icons">search</i> Search</button>
                            <span class="error-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@section('js')
    
<script type="text/javascript">
      $('.deletepopup').on('click', function () {
            $delId  = $(this).attr('value');
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to Delete?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_delete">Yes</button></div></div>';
            showPopUp(divElementSuccess);
 
            $('#yes_delete').click(function(){
                //window.location.replace( url );
                $.ajax({
                   url : '{{ url("delete/job" ) }}', 
                   type : 'get',
                   data : {id :$delId },
                   success : function(data){
                         document.location.href = "{{ url('jobs') }}";
//                        $.magnificPopup.open({
//                            items: {
//                                src: '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Job Deleted successfully </h3><p class="margin-bottom-0">{!! \Session::get('success') !!}</p></div><div class="alert-button alert-success"><button type="button" class="yes-updated button popup-modal-dismiss">Ok</button></div></div>',
//                                type:'inline' ,
//                            },
//                            modal: true ,
//                        });
//                        $('.yes-updated').click(function(){
//                            document.location.href = "{{ url('jobs') }}";
//                        });
                    },
                   error : function(data){
                   alert('falire');
                    }
                   
                });
            });
           
	    });
        $('#search-form-btn').on('click', function(){
            
            $.ajax({
               url : "{{ url('search/job') }}",
               type : "post",
               data : $('#search_form').serialize(),
               success : function(data){
                alert(data);
               } ,
               error : function(data){
                   alert(data);
               }
            });
        });
</script>
<script>
    
  $(function() {
            $('.select_custom_brnch').multiselect({
                columns  : 1,
                search   : true,
                selectAll: false,
                texts    : {
                    placeholder: ' -- Select Branch -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
            $('.select_custom_rgn').multiselect({
                columns  : 1,
                search   : true,
                selectAll: true,
                texts    : {
                    placeholder: ' -- Select Region -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
            $('.select_custom_zone').multiselect({
                columns  : 1,
                search   : true,
                selectAll: true,
                texts    : {
                    placeholder: ' -- Select Zone -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
        });
        
 $(function() {

            $('#forFromDateSearch' ).datepicker({
                showOn: "both",
                buttonText: "<i class='material-icons'>date_range</i>",
                dateFormat: 'dd-mm-yy',
                maxDate: '',
                onSelect : function(date,inst)
                {
                    var date2 = $('#forFromDateSearch').datepicker('getDate');
                    date2.setDate(date2.getDate() + 0);
                    $('#forToDateSearch').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    $('#forToDateSearch').datepicker('option', 'minDate', date2);

                    var dt = new Date($('#forFromDateSearch').datepicker('getDate'));
                    // GET THE MONTH AND YEAR OF THE SELECTED DATE.
                    var month = dt.getMonth(),
                        year = dt.getFullYear();

                    // GET THE FIRST AND LAST DATE OF THE MONTH.
                    var FirstDay = new Date(year, month, 1);
                    var LastDay = new Date(year, month + 1, 0);
                    //sets minDate to dt1 date + 1
                    $('#forToDateSearch').datepicker('option', 'maxDate', LastDay);
                    $('#forToDateSearch').datepicker('setDate', LastDay);
                }
            });

            $('#forToDateSearch' ).datepicker({
                showOn: "both",
                buttonText: "<i class='material-icons'>date_range</i>",
                dateFormat: 'dd-mm-yy',
                maxDate: '',
                onSelect : function(date,inst)
                {
                }
            });

        });

</script>

@endsection
