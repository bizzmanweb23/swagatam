<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Loan Agreement cum Loan Sanction Individual Bengali </title>
  <!--font-->
  <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,500,600,700&display=swap" rel="stylesheet">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
    <style>

      body, page {
        font-family: 'Hind Siliguri', sans-serif;
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
            <h2 class="heading-01">ঋণ মংজুরী পত্র এবং ঋণ চুক্তি</h2>
          </td>

        </tr>
        <!--header end-->


        <!--address box-->
        <tr>
          <td colspan="3">
            <table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td colspan="3" align="center"><h3 class="heading-01">ঋণ মঁজুরী পত্র</h3></td>
              </tr>
              <tr>

                <td> আপনার আবেদনপত্রের দ্বারা অনুরোধের অনুয়াযী, আমরা আরোহণ
                  নিম্নলিখিত....................................-এর জন্য ঋণের সীকৃতি প্রদান করছি।</td>
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
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ক্র.সং.</th>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">নাম</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ঋণের রাশি (টা.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ঋণ প্রসেসিং ফি + জিএসটি
                    (টা.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">কিস্তির অর্থরাশি</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">বীমা রাশি</th>
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
          <td colspan="3" align="center" style="padding-bottom:3px;">
            <h3 class="heading-01">সেন্টরের যৌথ দায়বদ্ধতার সমতির চুত্তি</h3>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p>
              এই ঋণ চুক্তিটি ...{!! (($detailVal->dt_disbursement_date != '')?date('Y', strtotime($detailVal->dt_disbursement_date)):'') !!}....সালের....{!! (($detailVal->dt_disbursement_date != '')?date('F', strtotime($detailVal->dt_disbursement_date)):'') !!}....মাসের.....{!! (($detailVal->dt_disbursement_date != '')?date('d', strtotime($detailVal->dt_disbursement_date)):'') !!}.....তারিখে, আরোহণ ফিনান্সিয়াল সার্ভিসেস প্রাইভেট লিমিটেড,
              (এখানে আরোহণ হিসেবে উল্লেখিত) কোম্পানি আইন-১৯৫৬ দ্বারা নিবন্ধীকৃত একটি নন ব্যাঙ্কিং ফিনান্স কোম্পানী, যার
              রেজিস্টার্ড অফিস-৪র্থ তলা পি.টি.আই. বিল্ডিং, ডি.পি. ব্লক, ডিপি-৯, সেক্টর-৫, সল্টলেক, কোলকাতা-৭০০০৯১।
              'ঋণগ্রহিতা' হিসেবে উল্লেখ করা এই দুই পক্ষের মধ্যে সম্পন্ন হল। 
              
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="3"> &nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p>
              ঋণগ্রহিতা তাঁর দ্বারা গৃহীত ঋণ শতকরা......{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}......% সুদের হারে (ক্রমহ্রাসমান) {{$detailVal->s_loan_tenure}}টি সাপ্তাহিক/পাক্ষিক/মাসিক কিস্তিতে নিয়মিতভাবে সঠিক সময়ে
              পরিশোধ করবেন বলে প্রতিশ্রুতি দিচ্ছেন। প্রতিটি কিস্তি জমা দেওয়ার নির্দিষ্ট দিন প্রতি
              মাসের......{{getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month}}{{ ((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '1')?'st':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '2')?'nd':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '3')?'rd':'th')))}}........সপ্তাহের.......{{config('constants.MASTER_WEEK_DAYS')[getCenterDetailsFronCode($detailVal->s_center_code)->i_day_of_the_week]}}.......(বার), এবং প্রথম কিস্তি পরিশোধ করার নির্দিষ্ট তারিখ
              হল............ (তারিখ)। ঋণগ্রহিতা দ্বারা প্রাপ্ত লোন রিপেমেন্ট কার্ডে ঋণ পরিশোধের সমযসূচী এবং ঋণ সংক্রান্ত
              নিয়ম ও শর্তাবলী বিস্তারিতভাবে উল্লেখিত আছে।
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-01">ঋণগ্রহিতা সুনিশ্চিত করছেন যে,</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
      
        <tr>
          <td colspan="3" style="font-size:7pt; padding-bottom:5px;">          
            <ol style="margin-top:10px;">
              <li>আরোহণের বকেয়া কিস্তি পরিশোধের ক্ষেত্রে সেন্টারের কোনও সদস্য/সদস্যা ব্যর্থ হলে, ঋণগ্রহিতা হিসেবে এই অবস্থাকে প্রতিরোধ করবেন এবং উক্ত ব্যক্তির কাছ থেকে বকেয়া কিস্তি আদায় করার জন্য আরোহণের সঙ্গে সবরকম সহযোগিতা করবেন।</li>
              <li>সেন্টারের কোনও সদস্য/সদস্যা ঋণ পরিশোধে ব্যর্থ হলে তার দায়ভার গ্রহণ করবেন।</li>
              <li>সেন্টারের কোনও ব্যক্তি ঋণ পরিশোধে ব্যর্থ হলে, ঋণগ্রহিতা ভবিষ্যতে আরোহণের থেকে কোনও ঋণ পাওযার জন্য অযোগ্য বিবেচিত হতে পারেন।</li>
              <li>ঋণগ্রহিতা নিজের জন্য ঋণটি নিচ্ছেন এবং ঋণের আবেদনপত্রে উল্লেখিত কাজের জন্য ব্যবহার করবেন এবং প্রতিশ্রুতি দিচ্ছেন যে আরোহণের থেকে গৃহীত ঋণের অর্থরাশি অন্যকে দেবেন না বা অপব্যবহার করবেন না।</li>
              <li>ঋণগ্রহিতা আরোহণের কোনও গ্রুপের সদস্য/সদস্যা হতে পারবেন না।</li>              
            </ol>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
          <h3 class="heading-01">উভয়পক্ষ আরও স্বীকৃতি জানাচ্ছেন য়ে:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
   
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">          
            <ol style="margin-top:10px;">
              <li value="1">লোন দেওয়ার তারিখ থেকে সুদ ধার্য করা হবে এবং দৈনিক ভিত্তিতে সুদ জমা হবে।</li>
              <li>{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_lpf'] !!}% লোন প্রসেসিং ফি এবং প্রযোজ্য কর ও প্রতি বছরে প্রতি হাজার টাকার উপর {!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!} টাকার বীমা প্রিমিয়াম এবং প্রযোজ্য কর গ্রাহককে প্রদান করতে হবে।</li>
              <li>যদি ঋণগ্রহিতা নির্ধারিত সময়ের আগে ঋণ পরিশোধ করেন তাহলে কোনও জরিমানা ধার্য করা হবে না।</li>
              <li>এই ঋণটি প্রদানের জন্য আরোহণের দ্বারা কোনও প্রকার জামিন/সিকিউরিটি ডিপোজিট/মার্জিন টাকা নেওয়া হয় নি।
              </li>
              <li>ঋণগ্রহিতা দ্বারা স্বাক্ষরিত ঋণ সম্পর্কিত সমস্ত নথিপত্র এই চুক্তির অবিচ্ছেদ্য অংশ।</li>
              <li>নির্ধারিত সময়ের পরে ঋণ পরিশোধের ক্ষেত্রে কোনও জরিমানা নেই, কিন্তু ঋণগ্রহিতাদের শুধুমাত্র বিলম্বের
                কারণে জমা হওয়া অতিরিক্ত সুদের টাকা দিতে হবে।</li>
              <li>যদি কোনও সদস্য/সদস্যা ঋণ পরিশোধ করতে ব্যর্থ হন, তাহলে আরোহণ ঐ ব্যক্তির ঋণ পরিশোধে ব্যর্থতার তথ্য ক্রেডিট ব্যুরোকে জানাবে এবং যার ফলশ্রুতি হিসেবে ঋণগ্রহিতা অনুরূপ কোনও সংস্থা থেকে ঋণ পাওয়ার ক্ষেত্রে অযোগ্য বিবেচিত হবেন।</li>
              <li>৩০ দিন আগে অবগতি করার পর ঋণ সম্পর্কিত শর্তাবলী পরিবর্তন করার অধিকার আরোহণের আছে।</li>
              <li>ঋণের মূল্য হিসেবে গ্রাহককে কেবল অফেরতযোগ্য সুদ, ঋণ প্রসেসিং চার্জ এবং ইন্স্যুরেন্স প্রিমিয়াম (প্রযোজ্য
                কর সহ) দিতে হবে। </li>
              <li>ঋণগ্রহিতার একাধিক এমএফআই এ (স্বা-ধন অধীনস্থ) সংস্থা থেকে ঋণ থাকলে আরোহণ তাঁকে ঋণ প্রদান করবে না।
              </li>
              <li>নিয়মের উল্লঙ্ঘন করে দেওয়া ঋণের রিকভারি, যত ক্ষণ না বর্তমান ঋণ সম্পূর্ণভাবে পরিশোধ করা হচ্ছে তত ক্ষণ
                পর্যন্ত বন্ধ রাখা হবে। </li>
              <li>ঋণের আবেদন পত্র গ্রাহককে ফেরত দেওয়া হবে না কারণ এটি সংস্থার সম্পত্তি। </li>
              <li>ঋণ কার্ডে উল্লেখিত কিস্তি বাদে, নগদ লেনদেনের জন্য আরোহণ নগদ রসিদ/স্বীকৃতি প্রদান করে।</li>
              <li>ঋণ সম্পর্কিত যে কোনও বিবাদের ক্ষেত্রে, তা বর্তমানে হোক বা এর পর, কলকাতার আদালতে এটি বিচার করা হবে। এর
                ফলে, যে কোনও সক্ষম অধিকারক্ষেত্রের অন্যান্য আদালতে ব্যবস্থা নেওয়ার আরোহণের অধিকার সীমিত নয়।</li>
            </ol>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-01">আরোহণ ঋণগ্রহিতাকে সুনিশ্চিত করছে যে,</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>

        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;"> 
            <ol>
              <li value="1"> ঋণগ্রহিতার তথ্যের গোপনীয়তাকে মর্যাদা দেওয়া হবে। কিন্তু ক্রেডিট ব্যুরো, বীমা প্রদানকারী, দেশের যে কোনও আইনি এনফোর্সমেন্ট এজেন্সি দ্বারা তথ্য জমা করার নির্দেশ আরোহণ পালন করবে।</li>
              <li>অতীতের ক্রেডিট ইতিহাস জানার জন্য গ্রাহকদের তথ্য ক্রেডিট ব্যুরোকে জানানো হবে।</li>
              <li>গ্রাহককে বীমা পরিষেবা প্রদান করার জন্য, বীমা প্রদানকারী বা থার্ড পার্টি প্রদানকারীকে গ্রাহকের তথ্য জানানো হবে</li>
              <li>রেটিং এবং সার্টিফিকিশন এজেন্সি ইত্যাদিকে তথ্য জানানোর সময়, আরোহণ সুনিশ্চিত করবে য়ে এই তথ্যগুলি ''শুধুমাত্র জানার জন্য'' প্রদান করা হবে এবং গ্রাহকের তথ্যের গোপনীয়তাও সুনিশ্চিত করবে। </li>
              <li>কর্মীদের অনুচিত ব্যবহার নিবারণ করা এবং সময়মতো অভিযোগের প্রতিবিধান করার জন্য আরোহণ দায়িত্বশীল থাকবে। </li>
              <li>আরবিআই দ্বারা প্রস্তাবিত পরিচ্ছন্ন এবং স্পষ্ট ঋণ দেওয়ার প্রক্রিয়া প্রতি আরোহণ অঙ্গীকারবদ্ধ।</li>
              <li>এই ঋণ আরোহণ বা কোনও তৃতীয় পক্ষ দ্বারা প্রস্তাবিত অন্য কোনও প্রোডাক্ট বা পরিষেবার সাথে যুক্ত নয়। </li>
              <li>সুদের হার এবং অন্যান্য শুল্কের পরিবর্তন ঘোষিত তারিখ থেকে শুধুমাত্র পরবর্তী ঋণের ক্ষেত্রে প্রযোজ্য হবে
                এবং পূর্ববর্তী ঋণের ক্ষেত্রে প্রযোজ্য হবে না।</li>
              <li>ঋণ আবেদন পত্রে ঋণগ্রহিতা দ্বারা নির্বাচিত একটি কিস্তির মেয়াদের (সাপ্তাহিক/পাক্ষিক/মাসিক, যেমন হবে)
                সমান সমযের জন্য ঋণ পরিশোধ নিষিদ্ধ থাকবে। </li>
              <li>ঋণের আবেদনপত্রের জন্য কোম্পানি রসিদের মাধ্যমে স্বীকৃতি জ্ঞাপন করবে।</li>
              <li>ক্যাশলেস ডিসবার্সমেন্টের ক্ষেত্রে, এই চুক্তিটি বৈধ বলে বিবেচিত হবে, যদি গ্রাহকের ব্যাঙ্ক অ্যাকাউন্টে
                ঋণের অর্থ ট্রান্সফার করা হয়ে থাকে বা তাকে চেক প্রদান করা হয়ে থাকে। </li>
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
                <p style="padding-bottom:5px;margin-bottom:5px;"><strong>ঋণগ্রহিতার স্বাক্ষর :</strong></p>
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
                        <p style="text-align: center">আরোহণ ফিনান্সিয়াল সার্ভিসেস প্রাইভেট লিমিটেডের পক্ষে</p>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td height="12">&nbsp;</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="center">                     
                        <p style="text-align: center">(স্বাক্ষর)</p>
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
                        <p style="text-align: center">(অনুমোদিত স্বাক্ষরকারীর নাম)</p>
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
                    <td style="width:55%;">&nbsp;</td> 
                    <td align="right" colspan="2" style="font-size: 6pt; width:25%">
                      <p>আরবিআই রেজিস্ট্রেশন নং: B.05.02932</p>
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
          <td colspan="3" align="center"><h3 class="heading-01">ক্রস সেল লোনের জন্য গ্রাহকের ঘোষণা </h3></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" colspan="3" style="font-size: 6pt">
            <p>প্রাথমিক লোন নেওয়ার সময়, আমি উপযোগী জিনিসগুলির তালিকা দেখেছি। সেই অনুযায়ী
              আমি......................................প্রোডাক্ট বেছে নিয়েছি এবং আরোহণকে এটির ব্যবস্থা করার জন্য অনুরোধ
              করেছি।
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">
          .......................................................................... (গ্রাহকদের সাক্ষর)
          </td>
          <td colspan=""></td>
        </tr>

      </table>

    </article>

  </section>

</body>

</html>