<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Loan Agreement cum Loan Sanction Individual Hindi </title>

  <style>

    body, page {
    font-family: "hindi", sans-serif;
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
        margin:0;
      }
      .heading-02{
        font-weight:bold;
        font-size:8pt;
        margin:0;
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
            <h2 class="heading-01">ऋण मंजूरी पत्र एवं ऋण करार</h2>
          </td>

        </tr>
        <!--header end-->


        <!--address box-->
        <tr>
          <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td colspan="3" align="center"><h3 class="heading-01">ऋण मंजूरी पत्र</h3></td>
              </tr>
              <tr>

                <td>आपके ऋण आवेदन द्वारा अनुरोध के अनुसार, हम आरोहण निम्नलिखित
                  ..............................................के लिए ऋण की स्वीकृति प्रदान करते है</td>
              </tr>
            </table>
          </td>
        </tr>
        <!--address box end-->

        <!--content part-->
        <tr>
          <td colspan="3"  style="padding-bottom:10px;">
            <table width="100%" cellspacing="0" cellpadding="4" style="border: 1px solid #dddddd">
              <thead>
                <tr>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">क्र.सं.</th>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">नाम</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ऋण की राशि (रु.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">ऋण प्रॉसेसिंग फी + जीएसटी
                    (रु)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">किस्त की राशि</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">बीमा राशि</th>

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
            <td colspan="3" style="padding-bottom:5px;"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom:0px; border-top:1px solid #000; width:100%; margin-top:0px;"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom:5px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="center" style="padding-bottom:3px;">
            <h3 class="heading-02">सेंटर के द्वारा संयुक्त उत्तरदायित्व की पुष्टि का सहमतिपत्र</h3>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p style="font-size:6.6pt; line-height:8pt;">
              यह समझौता पत्र आरोहण फाइनैंसियल सर्विसेस प्रा. लि., (यहाँ आरोहण के रूप में संदर्भित) कम्पनीज़ एक्ट, 1956 के
              अधीन पंजीकृत एक नॉन-बैंकिंग फाइनैंस कम्पनी, जिसका पंजीकृत कार्यालय 4थी मंज़िल, पीटीआई बिल्डिंग, डीपी-9,
              सेक्टर-5, सॉल्ट लेक, कोलकाता - 700091 में स्थित है एवं उपरोक्त के बीच .............{!! (($detailVal->dt_disbursement_date != '')?date('d', strtotime($detailVal->dt_disbursement_date)):'') !!}............
              (दिनांक).......{!! (($detailVal->dt_disbursement_date != '')?date('F', strtotime($detailVal->dt_disbursement_date)):'') !!}........(माह), ......{!! (($detailVal->dt_disbursement_date != '')?date('Y', strtotime($detailVal->dt_disbursement_date)):'') !!}......को किया गया है। ‘ऋणकर्ता’ के रूप में संदर्भित। 
              </p>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p style="font-size:6.6pt; line-height:8pt;">
              एतत द्वारा
              ऋणकर्त्ता अपने द्वारा लिए गए ऋण जिसका ब्याज दर..........{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}.........% है एवं जो ह्रासमान शेष पर ब्याज कि गणना
              विधी से...........{{$detailVal->s_loan_tenure}}..........साताहिक/पाक्षिक/मासिक किस्त समयानुसार चुकाने का वचन देता/देती हैं। सभी मासिक
              किस्त प्रत्येक माह के .........{{getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month}}{{ ((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '1')?'st':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '2')?'nd':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '3')?'rd':'th')))}}.........सप्ताह के...........{{config('constants.MASTER_WEEK_DAYS')[getCenterDetailsFronCode($detailVal->s_center_code)->i_day_of_the_week]}}...........(दिन) को देय है एवं जिसकी प्रथम
              किस्त का भुगतान.................(तारीख) को देय है। विस्तृत भुगतान तालिका एवं ऋण से संबंधित नियम एवं
              शर्तें, प्रत्येक ऋणकर्ता को प्रदान की गई ऋण भुगतान पुस्तिका में उल्लेखित है।
            </p>
          </td>
        </tr>
        <tr>
        <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">ऋणकर्ता सुनिश्चित करते हैं कि:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 6.6pt; padding-bottom:5px;line-height:8pt;">
            <ol style="line-height:8pt;margin-top:5px;">
              <li>आरोहण के पास बकाया पेमेंट संबंधित किसी भी भुगतान में असफल होने पर, यह सेंटर कथित व्यक्ति का निषेध करेगा एवं/या उनके पास से बकाया राशि वसूल करने में आरोहण की साहयता करेगा।</li>
              <li>एतद्वारा सुनिश्चित किया जाता है कि ग्रुप के किसी भी सदस्य के ऋण के भुगतान में असफल होने के कारण ग्रुप उत्पन्न देयधन की ज़िम्मेदारी लेंगे।</li>
              <li>सुनिश्चित करते हैं कि सेंटर का कोई भी व्यक्ति ऋण के भुगतान में असफल होने पर ऋणकर्ता भविष्य में आरोहण से किसी भी प्रकार के ऋण के लिए अयोग्य हो जाएंगे।</li>
              <li>एवं ऋणकर्ता वचन देता है कि ऋणकर्ता ऋण आवेदन पत्र में उल्लेखित कार्य के लिए यह ऋण अपने लिए ले रहा है एवं वादा करता है कि आरोहण से प्राप्त ऋण की राशि किसी और को नहीं सौंपेगा एवं दुरुपयोग नहीं करेगा।</li>
              <li>ऋणकर्ता आरोहण के किसी अन्य जेएलजी के सदस्य नहीं हो सकते हैं।</li>

            </ol>
          </td>
        </tr>
        <tr>
        <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">दोनों पार्टी यह स्वीकृत करती है कि:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 6.6pt; padding-bottom:5px;line-height:8pt;">
            <ol style="line-height:10px;margin-top:5px;">
              <li value="1">ऋण मिलने की तारीख से ब्याज चार्ज किया गया जाएगा एवं दैनिक आधार बर ब्याज एकत्रित होगा।</li>
              <li>{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_lpf'] !!}% प्रॉसेसिंग फी एवं लागू कर व प्रति वर्ष प्रति हजार रुपये पर {!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!} रुपये का बीमा प्रीमियम एवं लागू कर ग्राहक को भुगतान करना होगा।</li>
              <li>ऋणकर्ता(गण) के द्वारा समय से पहले ऋण का भुगतान करने पर कोई भी जुर्माना नहीं लिया जाएगा।</li>
              <li>इस ऋण को देने के लिए आरोहण द्वारा कोई भी आनुशंगिक/सिक्योरिटी डिपॉजिट/मार्जिन राशि नहीं लिया गया है।</li>
              <li>ऋणकर्ता द्वारा इस ऋण से संबंधित सभी हस्ताक्षरित दस्तावेज इस करार का अभिन्न अंग हैं।</li>
              <li>विलम्बित भुगतान के लिए कोई भी जुर्माना नहीं है, ऋणकर्ता को विलम्ब के कारण एकत्रित अतिरिक्त ब्याज का भुगतान करना होगा।</li>
              <li>यदि सदस्य भुगतान में असफल होता है तो आरोहण ऐसे असफल भुगतान की सूचना क्रेडिट ब्यूरो को देगा जिसके परिणामस्वरूप ऋणकर्ता ऐसे अन्य संस्थाओं से भी ऋण प्राप्त करने में असमर्थ रहेगा।</li>
              <li>आरोहण के पास 30 दिन पहले सूचित कर ऋण की शर्तें बदलने का अधिकार सुरक्षित है।</li>
              <li>ऋण के मूल्य के रूप में ग्राहक को केवल गैर वापसी योग्य ब्याज, ऋण प्रॉसेसिंग चार्ज एवं इन्श्योरेंस प्रीमिय (लागू कर सहित) देना होगा। </li>
              <li>आरोहण ऋणकर्ता को एमएफआईएन या स्व-धन के अधीन एक से अधिक एनबीएफसी-एमएफआई से ऋण नहीं प्रदान करेगा।</li>
              <li>नियमों का उल्लंघन करते हुए दिए गए ऋणों की वसूली,जब तक सभी वर्तमान ऋणों का सम्पूर्ण रूप से भुगतान नहीं किया जाता है तब तक अस्थगित की जाएगी।</li>
              <li>ऋण का आवेदन पत्र ग्राहक को वापस नहीं किया जाएगा क्योंकि यह संस्था की सम्पत्ति है।</li>
              <li>ऋण कार्ड में उल्लेखित ऋण किस्त के अलावा, नकद लेनदेन के लिए आरोहण नकद रसीद/स्वीकृति प्रदान करता है।</li>
              <li>ऋण से संबंधित किसी भी विवाद के क्षेत्र में चाहे वह वर्तमान में हो या इसके बाद, कोलाकाता के न्यायालय में इसका विचार किया जाएगा। इसके कारण, किसी सक्षम अधिकार क्षेत्र के अन्य न्यायालय में कार्यवाही करने का आरोहण का अधिकार सीमित नहीं रहेगा।</li>
            </ol>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">आरोहण ऋणकर्ता को आश्वस्त करता है कि :</h3>
          </td>
        </tr>
        
        <tr>
          <td colspan="3" style="font-size: 6.6pt; padding-bottom:5px; line-height:8pt;">
            <ol style="line-height:8pt;margin-top:5px;">
              <li value="1"> ऋणकर्ताओं की सूचनाओं की गोपनीयता को सम्मान दिया जाएगा। लेकिन, क्रेडिट ब्यूरो, बीमा प्रदानकारी एवं देश के किसी भी विधिक प्रवर्तन एजेंसी द्वारा तथ्य जमा करने का निर्देश आरोहण पालन करेगी।</li>
              <li>पूर्व का क्रेडिट इतिहास सूचित करने के लिए ग्राहकों की जानकारी क्रेडिट ब्यूरो को दी जाएगी।</li>
              <li>ग्राहकों को बीमा सेवा प्रदान करने के लिए बीमा प्रदानकारी या तृतीय पक्ष प्रदानकारियों को ग्राहक की जानकारी दी जाएगी।</li>
              <li>रेटिंग एवं सर्टिफिकेशन एजेंसी आदि को जानकारी प्रदान करते समय, आरोहण सुनिश्चित करेगी कि यह तथ्य ‘‘केवल जानकारी के लिए’’ प्रदान किया जाएगा एवं ग्राहकों की जानकारी की गोपनीयता सुनिश्चित करेगी। </li>
              <li>अपने कर्मियों के अनुचित आचरण एवं समय पर शिकायतों के समाधान की ज़िम्मेदारी कम्पनी पर लागू होगी।</li>
              <li>आरबीआई द्वारा प्रस्तावित पारदर्शी एवं स्वच्छ ऋण देने की प्रकि‘या के  प्रति आरोहण वचनबद्ध है।</li>
              <li>यह ऋण आरोहण या किसी तृतीय पक्ष द्वारा प्रस्तावित अन्य किसी प्रोडक्ट या सेवा के साथ जुड़ा हुआ नहीं है।</li>
              <li>ब्याज दर एवं चार्ज में बदलाव केवल अगली तारीख से लागू होगा न कि पिछली तारीख से।</li>
              <li>ऋण आवेदन पत्र में ऋणकर्ता द्वारा निर्वाचित एक किस्त की अवधि के समान समय (साप्ताहिक/पाक्षिक/मासिक, जैसा होगा)  के लिए ऋण भुगतान पर प्रतिबंध होगा।</li>
              <li>ऋण आवेदन के लिए कम्पनी ने रसीद की स्वीकृति प्रदान की है।</li>
              <li>यह समझौता पत्र ग्राहक के बैंक अकाउंट में ऋण की राशी जमा होने पर अथवा ग्राहक को चेक प्रदान करने पर ही लागू होगी।</li>
            </ol>
          </td>
        </tr>

      
        <tr>
          <td colspan="3">
            <table width="100%" colspacing="0" cellpadding="0">
            <tr>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td >
                <p style="padding-bottom:3px;"><strong>ऋणकर्ता के हस्ताक्षर :</strong></p>
                  <table  width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td width="60%">
                        <div style="margin-bottom: 20px;">1.	_________________________________________</div>                    
                      </td>
                      <td></td>
                      <td width="40%" align="center">
                        <p style="text-align: center">आरोहण फाइनैंसियल सर्विसेस प्राइवेट लिमिटेड के लिए</p>
                      </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                      <td height="20"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                      <td align="center">
                        <p style="text-align: center">(हस्ताक्षर)</p>
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
                        <p style="text-align: center">(अधिकृत हस्ताक्षरकर्ता का नाम)</p>
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
                      <p>आरबीआई रजिस्ट्रेशन नंबर: B.05.02932</p>
                    </td>
                    <td align="left" style="font-size: 6pt; width:30%;padding-left:30px;">
                      <p>CIN: U74140WB1991PLC053189</p>
                    </td>
                </tr>
            </table>
            </td>
        </tr>

        <tr>
          <td >&nbsp;</td>
        </tr>

        <!--footer part end-->

        <tr>
          <td colspan="3" align="center"><strong> क्रॉस सेल लोन के लिए ग्राहक की घोषणा <strong></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td align="left" colspan="3" style="font-size: 6pt">
            <p>प्राथमिक लोन लेते समय, मैंने उपयोगी सामगि‘यों की सूची को देख लिया है। इसके अनुसार मैंने ...........................................उत्पाद चुन लिया है एवं आरोहण को इसका इंतज़ाम करने क लिए आवेदन भी किया है।
            </p>
          </td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">
          ..........................................................................(ग्राहक के हस्ताक्षर)
          </td>
          <td colspan="1"></td>
        </tr>

      </table>

    </article>

  </section>

</body>

</html>