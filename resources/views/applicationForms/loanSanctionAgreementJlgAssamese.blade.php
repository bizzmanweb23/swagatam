<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Loan Sanction Letter and Loan Agreement </title>

  <style>

    body, page {
    font-family: "bang", sans-serif;
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
            <h2>ঋণ মঞ্জুৰী পত্র আৰু ঋণ চুক্তি</h2>
          </td>

        </tr>
        <!--header end-->


        <!--address box-->
        <tr>
          <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td colspan="4" align="center"><h3>ঋণ মঞ্জুৰী পত্র</h3></td>
              </tr>
              <tr>

                <td>আপোনালোকর ঋণ আবেদনপত্র দ্বাৰা গৃহীত অনুৰোধ অনুয়াযী, আমি আৰোহণে নিম্নলিখিত গ্রাহকৰ নিম্নলিখিত
                  অর্থৰাশি ঋণ হিচাপে মঞ্জুৰ কৰিছো।</td>
              </tr>
            </table>
          </td>
        </tr>
        <!--address box end-->

        <!--content part-->
        <tr>
          <td colspan="4" style="padding-bottom:10px;">
            <table width="100%" cellspacing="0" cellpadding="4" style="border: 1px solid #dddddd">
              <thead>
                <tr>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ক্র.সং.</th>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">নাম</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ঋণৰ পৰিমাণ (টকা)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ঋণৰ প্রছেচিং ফি + জিএছটি
                    (টকা)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">কিস্তিৰ পৰিমাণ</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">িবমাৰ পৰিমাণ</th>
                </tr>
              </thead>
              <thead>
                <?php
                    $custDetails = getCustDetailsFromGroupCode($detailVal->s_group_code)
                ?>
                @foreach($custDetails as $keyCust => $custD)
                  <tr>
                    <td colspan="4" rowspan="0" align="left" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">{{($keyCust+1)}}</td>
                    <td colspan="4" rowspan="0" align="left" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">
                      {!! $custD->s_cb_customer_salutation !!} {!! $custD->s_cb_customer_name !!}

                      @if($custD->s_pi_customer_gender == 'Male')
                        @php ($extraDtl = 'S/o '.$custD->s_cb_father_salutation.' '.$custD->s_cb_father_name)
                      @else
                        @if($custD->s_customer_marital_status == 'Married')
                          @php ($extraDtl = 'W/o '.$custD->s_cb_spouse_salutation.' '.$custD->s_cb_spouse_name)
                        @else
                          @php ($extraDtl = 'D/o '.$custD->s_cb_father_salutation.' '.$custD->s_cb_father_name)
                        @endif
                      @endif  
                      {{$extraDtl}}
                    </td>
                    <td colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">
                      {!! (($custD->d_sanctioned_loan_amount !='')?number_format($custD->d_sanctioned_loan_amount, 2, '.', ','):number_format($custD->s_loan_amount, 2, '.', ',')) !!}
                    </td>
                    <td colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">
                      {!! number_format((json_decode(str_replace('\"', '"', $custD->s_product_details), true)['lpf_amount']+json_decode(str_replace('\"', '"', $custD->s_product_details), true)['gst_amount']), 2, '.', ',') !!}
                    </td>
                    <td colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd"> 
                      {!! number_format($custD->d_emi, 2, '.', ',') !!}  
                    </td>
                    <td colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">
                      {!! number_format($custD->d_ins_fee, 2, '.', ',') !!}
                    </td>
                  </tr>
                @endforeach
              </thead>

            </table>
          </td>
        </tr>
        <!--From design end-->
        <!--text start-->
        
        <tr>
          <td colspan="4" align="center" style="padding-bottom:3px;" ><h3>গোটৰ যুগ্ম দায়বদ্বতা নিশিচত কৰা চুক্তিপত্র</h3></td>
        </tr>
        
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p>__{!! (($detailVal->dt_disbursement_date != '')?date('Y', strtotime($detailVal->dt_disbursement_date)):'') !!}__চনৰ ___{!! (($detailVal->dt_disbursement_date != '')?date('F', strtotime($detailVal->dt_disbursement_date)):'') !!}____ মাহৰ ___{!! (($detailVal->dt_disbursement_date != '')?date('d', strtotime($detailVal->dt_disbursement_date)):'') !!}___ তাৰিখে এই চুক্তিপত্রখন প্রস্তুত কৰা হৈছে, যাৰ পক্ষবোৰ হৈছে আৰোহণ
              ফাইনেন্সিয়েল চার্ভিচেচ লিমিটেড, কোম্পানী অধিনিয়ম ১৯৫৬-ৰ অধীনত পঞ্জীভুক্ত এক অনা বেঙ্ক বিত্তীয় কোম্পানী,
              যাৰ পঞ্জীভুক্ত কার্য্যালয়র ঠিকনা হৈছে ৪র্থ মহলা, পি.টি.আই. ভৱন, ডিপি-৯, চেক্টৰ ৫, চল্ট লেক, কলকাতা-৭০০০৯১।
              একেলগে যাক 'ঋণ লওতা' বুলি সমোধন কৰা হ'ব। <br>
              ঋণ লওতা সকলে তেওঁলোকে লোৱা ঋণটো হ্রস্বমান বকেয়া আধাৰত গণনা কৰা ___{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}____% হাৰৰ সূতত ___{{$detailVal->s_loan_tenure}}___  টা সাপ্তাহিক¡/পাক্ষিক¡/মাহিলী কিস্তিত সময়মতে পৰিশোধ কৰিব বুলি প্রতিশ্রুতি দিছে। প্রতিটো কিস্তি ধার্য্য ___{{getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month}}{{ ((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '1')?'st':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '2')?'nd':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '3')?'rd':'th')))}}___ সপ্তাহৰ _____{{config('constants.MASTER_WEEK_DAYS')[getCenterDetailsFronCode($detailVal->s_center_code)->i_day_of_the_week]}}______-ত  (দিন) দিযা হ'ব, আৰু প্রথম কিস্তিটোৰ দিয়া তাৰিখ হৈছে _______________। বিতং পৰিশোধৰ অনুসূচী আৰু ঋণটোৰ সকলো প্রাসঙ্গিক নিয়মাৱলী আৰু চর্তাৱলী ঋণ পৰিশোধ পত্রিকাত ডল্লেখ কৰা আছে যি প্রতিজন ঋণ লওতাই প্রাপ্ত কৰিছে বুলি স্বীকাৰ কৰিছে।

            </p>
          </td>
        </tr>
       
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;"><h3>গোটটোৰ ঋণ লওতাসকলে নিশিচতি দিযে য়ে:</h3>
            <ol>
              <li>এই জেএলজি গ্রুপৰ সদস্যসকলক সদস্য সকলে নিজেই বাছনি কৰি লৈছে আৰু আৰোহণ-এ কোনোভাবে প্রভাবিত কৰা নাই।</li>
              <li>আৰোহণক দিয়া ৰাশি পৰিশোধ কৰাত বিফল হোৱাৰ পৰিস্থিতি এটা ডদ্ভৱ হ'লে, এনে ব্যক্তিৰ(সকলৰ) পৰা দিয়া পৰিমাণ প্রতিহত আৰু বা প্রাপ্ত কৰাত গোটটোৱে আৰোহণৰ সৈতে সহায় আৰু সহযেগিতা কৰিব।</li>
              <li>গোটৰ যিকোনো সদস্যই দিয়া ৰাশি পৰিশোধ নকৰাৰ ফলত ডদ্ভৱ হোৱা যিকোনো দায়বদ্বতা পূৰণ কৰিবলৈ প্রতিশ্রুতি দিছে।</li>
              <li>স্বীকাৰ কৰো যে, গোটৰ ভিতৰত কোনো পৰিশোধ নকৰা স্থিতি হ'লে, গোটটোৰ সকলো সদস্য ভৱিষ্যতে আৰোহণৰ পৰা ঋণ প্রাপ্ত কৰাৰ বাবে অযোগ্য বিবেচিত হ'ব পাৰে।</li>
              <li>কেন্দ্রৰ যিকোনো সদস্যই দিয়া ৰাশি পৰিশোধ নকৰাৰ ফলত ডদ্ভৱ হোৱা যিকোনো দায়বদ্বতা পূৰণ কৰিবলৈ প্রতিশ্রুতি দিছে।</li>
              <li>স্বীকাৰ কৰে যে, কেন্দ্রৰ ভিতৰত কোনো পৰিশোধ নকৰা স্থিতি হ'লে, ঋণ লওতাসকল আৰোহণৰ পৰা ঋণ প্রাপ্ত কৰাৰ বাবে অযোগ্য বিবেচিত হ'ব পাৰে।</li>
              <li>আৰু ঋণ লওতাই প্রতিশ্রুতি দিযে যে তেওঁ ঋণটো ঋণ আৱেদন প্রপত্র ডল্লেখ কৰা উদ্দেশ্যৰে নিজৰ বাবেই ঋণটো লৈছে, আৰু আৰোহণৰ পৰা লোৱা ঋণৰ পৰিমাণটো আনক নিদিয়ে বা অপব্যৱহাৰ নকৰে বুলি প্রতিশ্রুতি দিছে।</li>
              <li>ঋণ লওতাজন আৰোহণৰ সৈতে এটাতকৈ অধিক জে.এল.জি.-ৰ সদস্য হ'ব নোৱাৰে।</li>
            </ol>
          </td>
        </tr>
        
        <tr>
          <td colspan="3" style="font-size: 7pt;padding-bottom:5px;"><h3>লগতে দুয়ো পক্ষই স্বীকাৰ কৰিছে যে :</h3>
            <ol>
              <li value="1">ঋণ বিতৰণ কৰা তাৰিখৰ পৰা সূত আদায় কৰা হ'ব আৰু দৈনিক আধাৰত সূত গণনা কৰা হ'ব।</li>
              <li>{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_lpf'] !!}% প্রচেছিং মাচুল যোগ প্রযোজ্য কৰ আৰু প্রতি বছৰে প্রতি হাজাৰত {!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!} টকাৰ বীমা প্রিমিয়াম যোগ প্রযোজ্য কৰ গ্রাহকে পৰিশোধ কৰিব লাগিব।</li>
              <li>ঋণ লওতা(সকলে) যদি ঋণটো পূর্বসমাপ্ত কৰিব বিচাৰে কোনো জৰিমনা আদায় কৰা নহ'ব।</li>
              <li>এই ঋণটো দিয়াৰ বাবে আৰোহণৰ দ্বাৰা কোনো প্রকাৰ জামিন/চিকিউৰিটি ডিপোজিট/মার্জিন টকা লোৱা হোৱা নাই।</li>
              <li>এই ঋণৰ সন্দর্ভত ঋণ লওতাই স্বাক্ষৰ কৰা সকলো দস্তাবেজ এই চুক্তপত্রখনৰ অন্তর্নিহিত অংশ।</li>
              <li>পলমকৈ কৰা পৰিশোধৰ বাবে কোনো জৰিমনা নালাগে, ঋণ লওতাসকলে পলম হোৱাৰ ফলত প্রযোজ্য অতিৰিক্ত সূত পৰিশোধ কৰিব লাগিব।</li>
              <li>সদস্যই ঋণ পৰিশোধ নকৰাৰ স্থিতিত, আৰোহণে এই ঋণ পৰিশোধ নকৰাৰ বিষয়ে ক্রেডিট ব্যুৰোবোৰক অৱগত কৰিব, যাৰ ফলত ঋণ লওতাই আন এনে ধৰণৰ প্রতিষ্ঠানৰ পৰা ঋণ ল'বলৈ অক্ষম হ'ব।</li>
              <li>30 দিনৰ আগতীয়া জাননী দি ঋণৰ চর্তাৱলী সলনি কৰাৰ অধিকাৰ আৰোহণে সংৰক্ষিত ৰাখিছে।</li>
              <li>ঋণৰ মূল্য হিচাবে গ্রাহকক, মাথোন উভতাব নলগা সুদ, ঋণ প্র'ছেচিং আৰু ইঞ্চুৰেঞ্চ প্রিমিয়াম (প্রযোজ্য কৰ সহ) দিব লাগিব।</li>
              <li>আৰোহণে ঋণগ্রহীতাক এমফিন নাইবা স্বা-ধন-ৰ অধীনত একাধিক এনবিএফচি  এমএফআই-ৰ পৰা ঋণ প্রদান নকৰিব।</li>
              <li>নিয়মৰ উল্লঙ্ঘন কৰি দিয়া ঋণৰ ৰিকভাৰি, বর্তমান ঋণ সম্পূর্ণভাবে পৰিশোধ নকৰা লৈকে বন্ধ থাকিব।</li>
              <li>ঋণৰ আবেদন পত্র গ্রাহকক উভতাই দিয়া নহব, কিয়নো এইটো সংস্থাৰ সম্পত্তি।</li>
              <li>ঋণ কার্ডত উল্লিখিত কিস্তি বাদে, নগদ লেনদেনৰ বাবে আৰোহণ নগদ ৰচিদ স্বীকৃতি প্রদান কৰে।</li>
              <li>ঋণ সম্পর্কিত যিকোনো বিবাদৰ ক্ষেত্রত সেইয়া বর্তমানেই হওঁক নাইবা ইয়াৰ পিছত, কলকাতাৰ আদালতত তাৰ বিচাৰ কৰা হ'ব। ইয়াৰ ফলত, যিকোনো সক্ষম অধিকাৰ ক্ষেত্রৰ আন আন আদালতত ব্যৱস্থা লোৱাৰ আৰোহণৰ অধিকাৰ সীমিত নহয়।</li>
            </ol>
          </td>
        </tr>

       
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;"><h3>আৰোহণে ঋণ লঅওঁতাক নিশিচতি দিযে যে:</h3>
            <ol>
              <li value="1">ঋণগ্রহণকাৰীৰ তথ্যৰ গোপনীয়তাক মর্য্যদা প্রদান কৰা হ'ব। কিন্তু ক্রেডিট ব্যুৰো, বীমা প্রদানকাৰী, দেশৰ আন কোনো আইনী এনফর্চমেন্ট এজেন্সিৰ দ্বাৰা তথ্য জমা কৰাৰ নির্দেশ আৰোহণে পালন কৰিব।</li>
              <li>অতীতৰ ক্রেডিট ইতিহাস জনাৰ বাবে গ্রাহকৰ তথ্য ক্রেডিট ব্যুৰোক জনোৱা হ'ব।</li>
              <li>গ্রাহকক বীমা সেৱা প্রদান কৰাৰ বাবে, বীমা প্রদানকাৰী বা থার্ড পার্টী প্রদানকাৰীক গ্রাহকৰ তথ্য জনোৱা হ'ব।</li>
              <li>ৰেটিং আৰু চার্টিফিকেচন এজেন্সি ইত্যাদিক তথ্য জনোৱাৰ সময়ত, আৰোহণে সুনিশ্চিত কৰিব যে্ এই তথ্যসমূহ কেৱল মাত্র জনাৰ বাবে প্রদান কৰা হ'ব আৰু গ্রাহকৰ তথ্যৰ গোপনীয়তা সুনিশ্চিত কৰিব।</li>
              <li>কর্মচাৰীৰ অনুচিত আচৰণ প্রতিৰোধ কৰা আৰু সময়মতে অভিযোগ নিষ্পত্তি কৰাৰ বাবে কোম্পানী দাযবদ্ব হ'ব।</li>
              <li>আৰবিআই দ্বাৰা প্রস্তাবিত সচ্ছ আৰু স্পষ্ট ঋণ দিয়াৰ প্রক্রিয়াৰ প্রতি আৰোহণ অঙ্গীকাৰবদ্ধ।</li>
              <li>এই ঋণ আৰোহণ বা অন্য কোনো তৃতীয় পক্ষৰ দ্বাৰা প্রস্তাবিত আন কোনো প্র'ডাক্ট বা সেৱাৰ সৈতে যুক্ত নহয়।</li>
              <li>সূতৰ হাৰ আৰু মাচুলৰ পৰিৱর্তন কেৱল পিছৰ তাৰিখৰ পৰা প্রযোজ্য হ'ব আৰু আগৰ তাৰিখৰ পৰা প্রযোজ্য নহয়।</li>
              <li>ঋণ আবেদনপত্রত ঋণনিওঁতাৰ দ্বাৰা নির্বাচিত এটা কিস্তিৰ মিয়াদৰ (সাপ্তাহিক/পাক্ষিক/মাহেকীযা, যিটো হয়) সমান সময়ৰ বাবে ঋণ পৰিশোধ বন্ধ থাকিব।</li>
              <li>ঋণৰ আবেদনপত্রৰ বাবে কোম্পানী ৰচিদৰ মাধ্যমে স্বীকৃতি জ্ঞাপন কৰিব।</li>
              <li>কেচলেচ ডিচবার্চমেন্টৰ ক্ষেত্রত গ্রাহকৰ বেংক একাউন্টত টকা ট্রেন্সফাৰ হোৱা বা চেক প্রদান কৰা দিনত এই চুক্তিটো বৈধ হব।</li>
            </ol>
          </td>
        </tr>

        <tr>
          <td colspan="4">
            <table width="100%" colspacing="0" cellpadding="0">
              <tr>
                <td >
                <p style="padding-bottom:3px;"><strong>ঋণ লওঁতাসকলৰ স্বাক্ষৰ:</strong></p>
                  <table  width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td width="40%">
                        <div style="margin-bottom: 20px;">1.	_________________________________________</div>                    
                      </td>
                      <td width="60%" align="center">
                        <p style="text-align: center">আৰোহণ ফাইনেন্সিয়েল চার্ভিচেছ প্রাইভেট লিমিটেডৰ হৈ</p>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td>                        
                        <div style="margin-bottom: 20px;">2.  _________________________________________</div>
                      </td>
                      <td width="60%" align="center">
                        <p style="text-align: center">(স্বাক্ষৰ)</p>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td>                        
                        <div style="margin-bottom: 20px;">3.	_________________________________________</div>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td width="40%">                        
                        <div style="margin-bottom: 20px;">4.  _________________________________________</div>
                      </td>
                      <td width="60%" align="center">
                        <p style="text-align: center">(কর্তৃত্বশীল স্বাক্ষৰকর্তাৰ নাম)</p>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td>                        
                        <div style="margin-bottom: 20px;">5.	_________________________________________</div>
                      </td>
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
          <td align="left" colspan="2" style="font-size: 6pt;">
            <p>আৰবিআই ৰেজিষ্ট্রেশ্বন নমৰ: B.05.02932CIN: U74140WB1991PLC053189</p>
          </td>

        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>

        <!--footer part end-->

        <tr>
          <td colspan="3" align="center"><strong>ক্রচ চেল ঋণৰ বাবে গ্রাহকৰ ঘোষণা</strong></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        
        </tr>
        <tr>
          <td align="left" colspan="3" style="font-size: 6pt">
            <p>প্রাথমিক ঋণ গ্রহণ কৰাৰ সময়ত, মই উপযোগী সামগ্রীসমূহৰ তালিকা দেখিছো। সেই অনুযাযী মই..............................প্রডাক্ট বাচি লৈছো আৰু আৰোহণক এটাৰ ব্যৱস্থা কৰি দিয়াৰ বাবে অনুৰোধ কৰিছো।
            </p>
          </td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        
        <tr>
          <td colspan="2">
          .......................................................................... গ্রাহকৰ স্বাক্ষৰ
          </td>
          <td colspan="1"></td>
        </tr>

      </table>

    </article>

  </section>

</body>

</html>