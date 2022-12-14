<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Loan Agreement cum Loan Sanction Individual Odia</title>

  <style>

    body, page {
      font-family: "odia", sans-serif;
    }
    html {
      width: 100%;
      margin: 0;
      padding: 0;
    }    
    body {
      font-size: 8pt;
      color: #000000;
      -webkit-text-size-adjust: none;
      -ms-text-size-adjust: none;
      margin: 0;
      padding: 10mm;
      padding-top:26mm;
      -webkit-font-smoothing: antialiased;
      width: 100%;
    }

    table {
      border-spacing: 0;
    }

    img {
      display: block !important;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
      border: none;
      height: auto;
      line-height: 100%;
    }

    img.image-inline {
      display: inline-block !important;
    }

    p {
      margin: 0;
      padding: 0;
    }

    table td,
    table tr {
      border-collapse: collapse;
    }

    ol {

      margin: 0;
      padding: 0;
      padding-left: 13px;
    }

    li {
      margin: 3px 0;

    }

    ul {
      margin: 0;
      padding: 0;
      list-style-type: none;
    }
    .heading-01{
      font-weight:bold;
      font-size:11pt;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <article>
      <table width="100%" cellspacing="0" cellpadding="0">
        <!--header-->
        <tr>
        <td colspan="1" align="left" width="38%">
            <img src="{{env('DASHBOARD_RESOURCE_URL').'/'.getCompanyDetails(1)->s_logo}}" alt="logo" style="width: 150px;">
          </td>
          <td colspan="2" align="left" width="50%">
            <h2 class="heading-01">ଋଣ ମଞ୍ଜୁରୀ ପତ୍ର ଏବଂ ଋଣ ଚୁକ୍ତି</h2>
          </td>

        </tr>
        <!--header end-->


        <!--address box-->
        <tr>
          <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td colspan="3" align="center"><h3 class="heading-01">ଋଣ ମଞ୍ଜୁରୀ ପତ୍ର</h3></td>
              </tr>
              <tr>

                <td> ଆପଣଙ୍କର ଆବେଦନପତ୍ର ଦ୍ବାରା ଅନୁରୋଧ ଅନୁଯାୟୀ, ଆମ୍ଭେ ଆରୋହଣ ନିମ୍ନଲିଖିତ.....................ର ପାଇଁ ଋଣ ସ୍ବୀକୃତି ପ୍ରଦାନ କରୁଛି।</td>
              </tr>
            </table>
          </td>
        </tr>
        <!--address box end-->

        <!--content part-->
        <tr>
          <td colspan="3" style="padding-bottom:10px;">
            <table width="100%" cellspacing="0" cellpadding="4" style="border: 1px solid #dddddd">
              <thead>
                <tr>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">କ୍ର. ସଂ</th>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ନାମ</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ଋଣ ଅର୍ଥରାଶି (ଟ.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ଋଣର ପ୍ରସେସିଂ ଫି + ଜିଏସଟି
                    (ଟ.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">କିସ୍ତିର ଅର୍ଥରାଶି (ଟ.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ବୀମା ରାଶି</th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <td colspan="4" rowspan="0" align="left" style="border-right: 1px solid #dddddd">1</td>
                  <td colspan="4" rowspan="0" align="left" style="border-right: 1px solid #dddddd">
                    {!! $detailVal->s_cb_customer_salutation !!} {!! $detailVal->s_cb_customer_name !!}

                    @if($detailVal->s_pi_customer_gender == 'Male')
                      @php ($extraDtl = 'S/o '.$detailVal->s_cb_father_salutation.' '.$detailVal->s_cb_father_name)
                    @else
                      @if($detailVal->s_customer_marital_status == 'Married')
                        @php ($extraDtl = 'W/o '.$detailVal->s_cb_spouse_salutation.' '.$detailVal->s_cb_spouse_name)
                      @else
                        @php ($extraDtl = 'D/o '.$detailVal->s_cb_father_salutation.' '.$detailVal->s_cb_father_name)
                      @endif
                    @endif  
                    {{$extraDtl}}
                  </td>
                  <td colspan="4" rowspan="0" align="right" style="border-right: 1px solid #dddddd">
                    {!! (($detailVal->d_sanctioned_loan_amount !='')?number_format($detailVal->d_sanctioned_loan_amount, 2, '.', ','):number_format($detailVal->s_loan_amount, 2, '.', ',')) !!}
                  </td>
                  <td colspan="4" rowspan="0" align="right" style="border-right: 1px solid #dddddd">
                    {!! number_format((json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['lpf_amount']+json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['gst_amount']), 2, '.', ',') !!}
                  </td>
                  <td colspan="4" rowspan="0" align="right" style="border-right: 1px solid #dddddd"> 
                    {!! number_format($detailVal->d_emi, 2, '.', ',') !!}  
                  </td>
                  <td colspan="4" rowspan="0" align="right" style="border-right: 1px solid #dddddd">
                    {!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!}
                  </td>
                </tr>
              </thead>

            </table>
          </td>
        </tr>
        <!--From design end-->
        <!--text start-->
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom:5px; border-top:1px solid #000; width:100%; margin-top:5px;"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="center" style="padding-bottom:3px;"><h3 class="heading-01">ସଂଘର ଯୌଥ ବାଧ୍ୟବାଧକତା ସୁନିଶ୍ଚିତକରଣ ଚୁକ୍ତି</h3></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>

       
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p>
            ଉକ୍ତ ଚୁକ୍ତିଟି ଆରୋହଣ ଫାଇନାନସିୟାଲ ସର୍ଭିସେସ ପ୍ରା. ଲି., କମ୍ପାନୀ ଧାରା 1956, ଅଧୀନରେ ରେଜିଷ୍ଟ୍ରିଭୁକ୍ତ ଏକ ଅଣ ବ୍ୟାଙ୍କିଙ୍ଗ୍ ସଂସ୍ଥା, ଯାହାର ରେଜିଷ୍ଟାର୍ଡ ମୁଖ୍ୟ କାର୍ଯ୍ୟାଳୟ 4ମ ତଳ, ପିଟିଆଇ ବିଲ୍ଡିଂ, ଡିପି-9, ସେକ୍ଟର-5, ସଲ୍ଟ ଲେକ, କୋଲକାତା – 700091 ଅବସ୍ଥିତ ଏବଂ..................................................ର ମଧ୍ୟରେ...........{!! (($detailVal->dt_disbursement_date != '')?date('d', strtotime($detailVal->dt_disbursement_date)):'') !!}............. (ଦିନ)................{!! (($detailVal->dt_disbursement_date != '')?date('F', strtotime($detailVal->dt_disbursement_date)):'') !!}.......................(ମାସ), ...........{!! (($detailVal->dt_disbursement_date != '')?date('Y', strtotime($detailVal->dt_disbursement_date)):'') !!}..............ତାରିଖରେ କରା ହୋଇଛି । 
            </p>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>

        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p>
            ସମବେତ ଭାବରେ ‘’ଋଣଗ୍ରହିତା’’ ଉଲ୍ଲେଖ କରୁଛନ୍ତି ଯେ,  ଋଣ ଗ୍ରହିତାମାନେ ତାଙ୍କ ଦ୍ବାରା............{{$detailVal->s_loan_tenure}}............ସାପ୍ତାହିକ/ପାକ୍ଷିକ/ମାସିକ କିସ୍ତିରେ, ଅର୍ଥରାଶି ହ୍ରାସ କରିବା ଉପରେ ଗଣନା କରାଯାଉଥିବା.........{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}.........% ସୁଧ ହାରରେ ଗୃହୀତ ଋଣ ସମୟ ମଧ୍ୟରେ ପରିଶୋଧ କରିବେ ବୋଲି ପ୍ରତିଶ୍ରୁତି ଦେଇଛନ୍ତି। ପ୍ରତ୍ୟେକ କିସ୍ତି ମାସର............{{getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month}}{{ ((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '1')?'st':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '2')?'nd':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '3')?'rd':'th')))}}............ସପ୍ତାହର...........{{config('constants.MASTER_WEEK_DAYS')[getCenterDetailsFronCode($detailVal->s_center_code)->i_day_of_the_week]}}............. (ଦିନରେ) ବକେୟା ରହିବ ଏବଂ ପରିଶୋଧ କରିବା ପ୍ରଥମ ନିର୍ଦ୍ଦିଷ୍ଟ ତାରିଖ ହେଲା........................ (ତାରିଖ) । ବିଶଦ ଭାବରେ ପରିଶୋଧ କରିବାର ସମୟସୂଚୀ ଏବଂ ଉତ୍ତର ଋଣର ପ୍ରାସଙ୍ଗିକ ନିୟମ ଓ ସର୍ତ୍ତାବଳୀ, ପ୍ରତ୍ୟେକଟି ଋଣଗ୍ରହିତା ଦ୍ବାରା ପ୍ରାପ୍ତ ଋଣ ପରିଶୋଧ ପୁସ୍ତିକାରେ ଉଲ୍ଲେଖିତ ରହି ଅଛି । </p>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:3px;"><h3 class="heading-01">ଋଣଗ୍ରହିତାମାନେ ସୁନିଶ୍ଚିତ କରିଛନ୍ତି ଯେ:</h3></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" style="font-size: 6.6pt;  padding-bottom:5px;">
          
            <ol>
              <li>ଆରୋହଣ ପକ୍ଷରୁ ବକେୟା ସମ୍ବନ୍ଧିତ କୌଣସି ପରିଶୋଧରେ ବ୍ୟର୍ଥ ହେଲେ, ଏହି ସଂଘ ଉକ୍ତ ବ୍ୟକ୍ତିକୁ ପରିଶୋଧ ଏବଂ-ବା ତା ଠାରୁ ବକେୟା ଅର୍ଥରାଶି ଆଦାୟ କରିବା ପାଇଁ ସାହାଯ୍ୟ ଓ ସହଯୋଗ କରିବେ।</li>
              <li>ଏହାଦ୍ବାରା ସ୍ବୀକୃତି ହେଉଛନ୍ତି ଯେ ଗ୍ରୁପର କୌଣସି ସଦସ୍ୟ ଋଣ ପରିଶୋଧରେ ବ୍ୟର୍ଥ ହୋଇଥିବା ଯୋଗୁଁ ଉତ୍ପନ୍ନ ବାଧ୍ୟବାଧକତାର ଦାୟିତ୍ବ ଗ୍ରହଣ କରିବେ ।</li>
              <li>ସ୍ବୀକୃତି ପ୍ରଦାନ କରୁଛନ୍ତି ଯେ ସଂଘର କୌଣସି ବ୍ୟକ୍ତିର ଋଣ ପରିଶୋଧ ଭବିବାରେ ବ୍ୟର୍ଥ ହେଲେ ଗ୍ରୁପର ସମସ୍ତ ସଦସ୍ୟ ଆରୋହଣରୁ ଭବିଷ୍ୟତରେ କୌଣସି ଋଣ ପାଇବାକୁ ଅଯୋଗ୍ୟ ବିବେଚିତ ହେବେ କିମ୍ବା ବଞ୍ଚିତ ହେବେ।</li>
              <li>ଏବଂ ଋଣଗ୍ରହିତା ସୁନିସ୍ଚିତ କରିଛନ୍ତି ଯେ ଋଣଗ୍ରହିତା ଆବେଦନ ପତ୍ରରେ ଉଲ୍ଲେଖିତ କାର୍ଯ୍ୟ ପାଇଁ ଋଣଟି ଦେଉଛନ୍ତି ଏବଂ ପ୍ରତିଶ୍ରୁତି ଦେଉଛନ୍ତି ଯେ ଆରୋହଣରୁ ଗୃହୀତ ଋଣ ଅର୍ଥରାଶି ଅନ୍ୟ କାହାରିକୁ ଦେବେ ନାହିଁ ବା ଅପବ୍ୟବହାର କରିବେ ନାହିଁ।</li>
              <li>ଋଣଗ୍ରହିତା ଆରୋହଣର ଜେଏଲଜିର ସଦସ୍ୟ ହୋଇ ପାରିବେ ନାହିଁ।</li>
            </ol>
          </td>
        </tr>
        
          <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:3px;"><h3 class="heading-01">ଦୁଇ ପକ୍ଷ ଆହୁରି ସ୍ବୀକୃତି ପ୍ରଦାନ କରୁଛନ୍ତି ଯେ:</h3></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        
        <tr>
          <td colspan="3" style="font-size: 6.6pt;  padding-bottom:5px;">
            <ol>
              <li value="1">ଋଣ ଦେବାର ତାରିଖରୁ ସୁଧ ଲାଗୁ କରା ହେବ ଏବଂ ଦୈନିକ ଭିତ୍ତିରେ ସୁଧ ଏକତ୍ରିତ ହେବ।</li>
              <li>{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_lpf'] !!}% ପ୍ରୋସେସିଂ ଫି ଏବଂ ପ୍ରଯୋଜ୍ୟ କର ଓ ପ୍ରତି ବର୍ଷ ପ୍ରତି ହଜାର ଟହ୍କା ଉପରେ {!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!} ଟଙ୍କାର ବୀମା ପ୍ରିମିୟମ ଏହଂ ପ୍ରଯୋଜ୍ୟ କର ଗ୍ରାହକଙ୍କୁ ପୈଠ କରିବାକୁ ହେବ।</li>
              <li>ଯଦି ଋଣଗ୍ରହିତା (ମାନେ) ସମୟ ପୂର୍ବରୁ ଋଣ ପରିଶୋଧ କରନ୍ତି ତେବେ କୌଣସି ଜୋରିମାନା ଧାର୍ଯ୍ୟ କରାହେବ ନାହିଁ।</li>
              <li>ଏହି ଋଣଟି ପ୍ରଦାନ ପାଇଁ ଆରୋହଣ ଆରୋହଣ ଦ୍ବାରା କୌଣସି ପ୍ରକାର ଜାମିନ/ସିକ୍ୟୁରିଟି ଡିପୋଜିଟ/ମାର୍ଜିନ ଟଙ୍କା ନିଆ ଯାଇ ନାହିଁ।</li>
              <li>ଋଣଗ୍ରହିତା ଦ୍ବାରା ଏହି ଋଣ ସମ୍ବନ୍ଧିତ ସ୍ବାକ୍ଷରିତ ସମସ୍ତ ନଥିପତ୍ର ଏହି ଚୁକ୍ତିର ଅବିଚ୍ଛେଦ୍ୟ ଅଂଶ।</li>
              <li>ବିଳମ୍ବିତ ପରିଶୋଧ ପାଇଁ କୌଣସି ଜୋରିମାନା ନାହିଁ, ଋଣଗ୍ରହିତାମାନଙ୍କର ବିଳମ୍ବର କାରଣ ଯୋଗୁଁ ଏକତ୍ରିତ ଅତିରିକ୍ତ ଅତିରିକ୍ତ ସୁଧ ପରିଶୋଧ କରିବାକୁ ହେବ।</li>
              <li>ଯଦି ସଦସ୍ୟ ପରିଶୋଧ କରିବାକୁ ବ୍ୟର୍ଥ ହୁଅନ୍ତି, ତେବେ ଆରୋହଣ ଏ ଧରଣର ବ୍ୟର୍ଥ ପରିଶୋଧ ବିଷୟରେ କ୍ରେଡିଟ୍ ବ୍ୟୁରୋକୁ ଜଣାଇବେ ଏବଂ ଯାହା ଫଳରେ ଋଣଗ୍ରହିତା ଏଭଳି ଅନ୍ୟ କୌଣସି ସଂସ୍ଥାରୁ ଋଣ ପାଇ ପାରିବେ ନାହିଁ।</li>
              <li>ଆରୋହଣ ନିକଟରେ 30 ଦିନ ପୂର୍ବରୁ ଜଣାଇବା ପୂର୍ବରୁ ଜଣାଇବା ପରେ ନିୟମାବଳୀ ପରିବର୍ତ୍ତନ କରିବାର ଅଧିକାର ସଂରକ୍ଷିତ ରହିଛି।</li>
              <li>ଋଣର ମୂଲ୍ୟ ହିସାବରେ ଗ୍ରାହକକୁ କେବଳ ଅଫେରସ୍ତଯୋଗ୍ୟ ସୁଧ, ଋଣ ପ୍ରସେସିଙ୍ଗ ଚାର୍ଜ ଏବଂ ଇନ୍ସ୍ୟୁରେନ୍ସ ପ୍ରିମିୟମ (ପ୍ରଯୋଜ୍ୟ କର ସହ) ଦେବାକୁ ହେବ।</li>
              <li>ଆରୋହଣ ଋଣଗ୍ରହିତାକୁ ଏମଏଫଆଇଏ ବହା ସ୍ବା-ଧନର ଅଧୀନରେ ଏକାଧିକ ଏନବିଏଫସି-ଏମଏଫଆଇରୁ ଋଣ ପ୍ରଦାନ କରିବେ ନାହିଁ।</li>
              <li>ନିୟମର ଉଲଂଘନ କରି ଦିଆ ଯାଉଥିବା ଋଣର ରିକଭାରି, ଯେ ପର୍ୟ୍ୟନ୍ତ ବର୍ତ୍ତମାନ ଋଣ ସମ୍ପୂର୍ଣ୍ଣଭାବରେ ପରିଶୋଧ କରା ହୋଇଛି ଯେ ପର୍ଯ୍ୟନ୍ତ ବନ୍ଦ କରା ଯିବ।</li>
              <li>ଋଣର ଆବେଦନପତ୍ର ଗ୍ରାହକକୁ ଫେରସ୍ତ ଦିଆ ଯିବ ନାହିଁ କାରଣ ଏହା ସଂସ୍ଥାର ସମ୍ପତ୍ତି।</li>
              <li>ଋଣ କାର୍ଡରେ ଉଲ୍ଲେଖିତ କିସ୍ତି ଛଡ଼ା, ନଗଦ ଲେଣଦେଣ ପାଇଁ ଆରୋହଣ ନଗଦ ରସିଦ/ସ୍ବୀକୃତି ପ୍ରଦାନ କରେ।</li>
              <li>ଋଣ ସମ୍ବନ୍ଧିତ ଯେ କୌଣସି ବିବାଦ କ୍ଷେତ୍ରରେ, ଯାହା ବର୍ତ୍ତମାନ ହେଉ ବା ପରେ, କୋଲକାତା ଆଦାଲତରେ ଏହା ବିଚାର କରା  ହେବ। ଏଙା ଫଳରେ, ଯେ କୌଣସି ସକ୍ଷମ ଅଧିକାର ସୀମିତ ନୁହେଁ।</li>
            </ol>
          </td>
        </tr>

        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:3px;"><h3 class="heading-01">ଆରୋହଣ ଋଣଗ୍ରହିତାମାନଙ୍କୁ ସୁନିଶ୍ଚିତ କରୁଛି ଯେ:</h3></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" style="font-size:6.6pt; padding-bottom:5px;">
            <ol>
              <li value="1">ଋଣଗ୍ରହିତାଙ୍କର ତଥ୍ୟ ଗୋପନୀୟତାକୁ ମର୍ଯ୍ୟାଦା ଦିଆ ଯିବ କିନ୍ତୁ କ୍ରେଡିଟ୍ ବ୍ୟୁରୋ, ବୀମା ପ୍ରଦାନକାରୀ, ଦେଶର ଯେ କୌଣସି ଆଇନି ଏନଫୋର୍ସମେଣ୍ଟ ଏଜେନ୍ସି ଦ୍ବାରା ତଥ୍ୟ ଜମା କରିବାର ନିର୍ଦ୍ଦେଶ ଆରୋହଣ ପାଳନ କରିବ । </li>
              <li>ଅତୀତରେ କ୍ରେଡିଟ୍ ଇତିହାସ ଜାଣିବା ପାଇଁ ଗ୍ରାହକଙ୍କର ତଥ୍ୟ କ୍ରେଡିଟ ବ୍ୟୁରୋକୁ ଜଣାଦିଆ ହେବ।</li>
              <li>ଗ୍ରାହକଙ୍କୁ ବୀମା ସେବା ପ୍ରଦାନ କରିବା ପାଇଁ, ବୀମା ପ୍ରଦାନକାରୀ ବା ଥାର୍ଡ ପାର୍ଟି ପ୍ରଦାନକାରୀକୁ ଗ୍ରାହକଙ୍କର ତଥ୍ୟ ଜଣାଦିଆ ହେବ।</li>
              <li>ରେଟିଙ୍ଗ ଏବଂ ସର୍ଟିଫିକେସନ୍ ଏଜେନ୍ସି ଇତ୍ୟାଦିକୁ ତଥ୍ୟ ଜମା କରିବା ସମୟରେ, ଆରୋହଣ ସୁନିଶ୍ଚିତ କରିବ ଯେ ଏହି ତଥ୍ୟ ଗୁଡ଼ିକ “କେବଳ ଜାଣିବା ପାଇଁ” ପ୍ରଦାନ କରା ହେବ ଏବଂ ଗ୍ରାହକଙ୍କ ତଥ୍ୟ ଗୋପନୀୟତା ସୁନିଶ୍ଚିତ କରିବେ।</li>
              <li>କର୍ମୀମାନଙ୍କର ଅନୁଚିତ ବ୍ୟବହାର ଏବଂ ସମୟ ମୁତାବକ ଅଭିଯୋଗର ସମାଧାନର ଦାୟିତ୍ବ କମ୍ପାନୀର ପରିସରରେ ରହିବ।</li>
              <li>ଆରବିଆଇ ଦ୍ବାରା ପ୍ରସ୍ତାବିତ ପରିଚ୍ଛନ୍ନ ଏବଂ ସ୍ପଷ୍ଟ ଋଣ ଦେବାର ପ୍ରକ୍ରିୟା ପ୍ରତି ଆରୋହଣ ଅଙ୍ଗୀକାରବଦ୍ଧ।</li>
              <li>ଏହି ଋଣ ଆରୋହଣ ବା କୌଣସି ତୃତୀୟ ପକ୍ଷ ଦ୍ବାରା ପ୍ରସ୍ତାବିତ ଅନ୍ୟ କୌଣସି ପ୍ରଡକ୍ଟ ସେବା ସହିତ ଯୁକ୍ତ ନୁହେଁ।</li>
              <li>ସୁଧର ହାର ଏବଂ ଚାର୍ଜର ପରିବର୍ତ୍ତନ କେବଳମାତ୍ର ପୂର୍ବ ତାରିଖ ଠାରୁ ପ୍ରଯୋଜ୍ୟ ହେବ ଏବଂ ପରବର୍ତ୍ତୀ ତାରିଖ ଠାରୁ ନୁହେଁ । </li>
              <li>ଋଣ ଆବେଦନ ପତ୍ରରେ ଋଣ ଗ୍ରହଣ ଦ୍ବାରା ନିର୍ବାଚିତ ଗୋଟିଏ କିସ୍ତିର ସମୟସୀମାର ସମାନ ସମୟ (ପ୍ରସ୍ତାବିତ/ପାକ୍ଷିକ/ମାସିକ, ଯେମିତି ହେବ) ପାଇଁ ଋଣ ପରିଶୋଧ ବନ୍ଦ ରହିବ। </li>
              <li>ଋଣର ଆବେଦନପତ୍ର ପାଇଁ କମ୍ପାନି ରସିଦ ମାଧ୍ୟମରେ ସ୍ବୀକତ ଜ୍ଞାପନ କରିବ।  </li>
              <li>କ୍ୟାଶଲେସ ଋଣ ପ୍ରଦାନ କ୍ଷେତ୍ରରେ, ଗ୍ରାହକମାନଙ୍କ ବ୍ୟାଙ୍କ ଆକାଉଣ୍ଟରେ ଋଣ ଟଙ୍କା ଟ୍ରାନ୍ସଫର କିମ୍ବା ଚେକ ପ୍ରଦାନ ଭେଲେ, ଏହି ଚୁକ୍ତିଟି ବୈଧ ସାପେକ୍ଷ।</li>
            </ol>
          </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">
            <table width="100%" colspacing="0" cellpadding="0">
              <tr>
                <td >
                <p style="padding-bottom:3px;"><strong>ଗ୍ରାହକମାନଙ୍କର ସ୍ବାକ୍ଷର:</strong></p>
                  <table  width="100%" colspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                    <tr>
                      <td width="60%">
                        <div style="margin-bottom: 20px;">1.	_________________________________________</div>                    
                      </td>
                      <td></td>
                      <td width="40%" align="center">
                        <p style="text-align: center">ଆରୋହଣ ଫାଇନାନସିୟାଲ ସର୍ଭିସେସ ପ୍ରାଇଭେଟ ଲିମିଟେଡ ପାଇଁ</p>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="center">                        
                        
                        <p style="text-align: center">(ସ୍ବାକ୍ଷର)</p>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td height="12"></td>
                    </tr>
                    
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="center">
                        <p style="text-align: center">(ପ୍ରଧିକୃତ ସ୍ବାକ୍ଷରକାରୀଙ୍କର ନାମ)</p>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td height="12"></td>
                    </tr>                    
                  </table>
                </td>

                
              </tr>
            </table>
          </td>
        </tr>

       



        <!--content part end-->

        <!--footer part start-->
        <tr>
          <td colspan="3">
            <table width="100%" colspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:50%;">&nbsp;</td> 
                    <td align="right" colspan="2" style="font-size: 6pt; width:25%">
                      <p> ଆରବିଆଇ ରେଜିଷ୍ଟ୍ରେସନ ନଂ: B.05.02932</p>
                    </td>
                    <td align="left" style="font-size: 6pt; width:30%;padding-left:10px;">
                      <p>CIN: U74140WB1991PLC053189</p>
                    </td>
                </tr>
            </table>
            </td>
        </tr>
         <tr>
          <td>&nbsp;</td>
        </tr>

        <!--footer part end-->

        <tr>
          <td colspan="3" align="center"><strong>କ୍ରସ ସେଲ ଲୋନ ପାଇଁ ଗ୍ରାହକଙ୍କର ଯୋଗ୍ୟତା</strong></td>
        </tr>
        
        <tr>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td align="left" colspan="3" style="font-size: 6pt">
            <p>ପ୍ରାଥମିକ ଲୋନ ନେବା ସମୟ, ମୁଁ ଉପଯୋଗୀ ଜିନିସଗୁଡ଼ିକର ତାଲିକା ଦେଖିଛି, ସେହି ଅନୁଯାୟୀ ମୁଁ...............................ପ୍ରଡକ୍ଟ ବାଛି ନେଉଛି ଏବଂ ଆରୋହଣକୁ ଏହାର ବ୍ୟବସା କରିବା ପାଇଁ ଅନୁରୋଧ କରିଛି
            </p>
          </td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">
             ..........................................................................(ଗ୍ରାହକମାନଙ୍କର ସ୍ବାକ୍ଷର)
          </td>
          <td colspan="1"></td>
        </tr>

      </table>

    </article>

  </section>

</body>

</html>