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
            <h2 class="heading-01">?????? ?????????????????? ???????????? ????????? ?????? ????????????</h2>
          </td>

        </tr>
        <!--header end-->


        <!--address box-->
        <tr>
          <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td colspan="3" align="center"><h3 class="heading-01">?????? ?????????????????? ????????????</h3></td>
              </tr>
              <tr>

                <td>???????????? ?????? ??????????????? ?????????????????? ?????????????????? ?????? ??????????????????, ?????? ??????????????? ??????????????????????????????
                  ..............................................?????? ????????? ?????? ?????? ???????????????????????? ?????????????????? ???????????? ??????</td>
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
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">?????????.??????.</th>
                  <th colspan="4" rowspan="0" align="left"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">?????????</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">?????? ?????? ???????????? (??????.)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">?????? ?????????????????????????????? ?????? + ??????????????????
                    (??????)</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">??????????????? ?????? ????????????</th>
                  <th colspan="4" rowspan="0" align="right"
                    style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">???????????? ????????????</th>

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
            <h3 class="heading-02">??????????????? ?????? ?????????????????? ????????????????????? ???????????????????????????????????? ?????? ?????????????????? ?????? ???????????????????????????</h3>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p style="font-size:6.6pt; line-height:8pt;">
              ?????? ?????????????????? ???????????? ??????????????? ?????????????????????????????? ???????????????????????? ????????????. ??????., (???????????? ??????????????? ?????? ????????? ????????? ????????????????????????) ????????????????????? ????????????, 1956 ??????
              ???????????? ????????????????????? ?????? ?????????-????????????????????? ????????????????????? ??????????????????, ??????????????? ????????????????????? ???????????????????????? 4?????? ???????????????, ?????????????????? ????????????????????????, ????????????-9,
              ??????????????????-5, ??????????????? ?????????, ????????????????????? - 700091 ????????? ??????????????? ?????? ????????? ????????????????????? ?????? ????????? .............{!! (($detailVal->dt_disbursement_date != '')?date('d', strtotime($detailVal->dt_disbursement_date)):'') !!}............
              (??????????????????).......{!! (($detailVal->dt_disbursement_date != '')?date('F', strtotime($detailVal->dt_disbursement_date)):'') !!}........(?????????), ......{!! (($detailVal->dt_disbursement_date != '')?date('Y', strtotime($detailVal->dt_disbursement_date)):'') !!}......?????? ???????????? ????????? ????????? ??????????????????????????? ?????? ????????? ????????? ??????????????????????????? 
              </p>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="left" style="padding-bottom:5px;">
            <p style="font-size:6.6pt; line-height:8pt;">
              ????????? ??????????????????
              ??????????????????????????? ???????????? ?????????????????? ????????? ?????? ?????? ??????????????? ??????????????? ??????..........{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}.........% ?????? ????????? ?????? ???????????????????????? ????????? ?????? ??????????????? ?????? ????????????
              ???????????? ??????...........{{$detailVal->s_loan_tenure}}..........?????????????????????/?????????????????????/??????????????? ??????????????? ??????????????????????????? ?????????????????? ?????? ????????? ????????????/???????????? ???????????? ????????? ???????????????
              ??????????????? ???????????????????????? ????????? ?????? .........{{getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month}}{{ ((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '1')?'st':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '2')?'nd':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '3')?'rd':'th')))}}.........?????????????????? ??????...........{{config('constants.MASTER_WEEK_DAYS')[getCenterDetailsFronCode($detailVal->s_center_code)->i_day_of_the_week]}}...........(?????????) ?????? ????????? ?????? ????????? ??????????????? ???????????????
              ??????????????? ?????? ??????????????????.................(???????????????) ?????? ????????? ????????? ????????????????????? ?????????????????? ?????????????????? ????????? ?????? ?????? ????????????????????? ???????????? ?????????
              ??????????????????, ???????????????????????? ????????????????????? ?????? ?????????????????? ?????? ?????? ?????? ?????????????????? ???????????????????????? ????????? ???????????????????????? ?????????
            </p>
          </td>
        </tr>
        <tr>
        <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">????????????????????? ??????????????????????????? ???????????? ????????? ??????:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 6.6pt; padding-bottom:5px;line-height:8pt;">
            <ol style="line-height:8pt;margin-top:5px;">
              <li>??????????????? ?????? ????????? ??????????????? ?????????????????? ????????????????????? ???????????? ?????? ?????????????????? ????????? ???????????? ???????????? ??????, ?????? ??????????????? ???????????? ????????????????????? ?????? ??????????????? ??????????????? ?????????/?????? ???????????? ????????? ?????? ??????????????? ???????????? ???????????? ???????????? ????????? ??????????????? ?????? ?????????????????? ??????????????????</li>
              <li>???????????????????????? ??????????????????????????? ???????????? ???????????? ?????? ?????? ??????????????? ?????? ???????????? ?????? ??????????????? ?????? ?????? ?????? ?????????????????? ????????? ???????????? ???????????? ?????? ???????????? ??????????????? ????????????????????? ??????????????? ?????? ?????????????????????????????? ??????????????????</li>
              <li>??????????????????????????? ???????????? ????????? ?????? ??????????????? ?????? ????????? ?????? ????????????????????? ?????? ?????? ?????????????????? ????????? ???????????? ???????????? ?????? ????????????????????? ?????????????????? ????????? ??????????????? ?????? ???????????? ?????? ?????????????????? ?????? ?????? ?????? ????????? ?????????????????? ?????? ?????????????????????</li>
              <li>????????? ????????????????????? ????????? ???????????? ?????? ?????? ????????????????????? ?????? ??????????????? ???????????? ????????? ???????????????????????? ??????????????? ?????? ????????? ?????? ?????? ???????????? ????????? ?????? ????????? ?????? ????????? ???????????? ???????????? ?????? ?????? ??????????????? ?????? ????????????????????? ?????? ?????? ???????????? ???????????? ?????? ?????? ???????????? ????????????????????? ????????? ???????????????????????? ???????????? ??????????????????</li>
              <li>????????????????????? ??????????????? ?????? ???????????? ???????????? ?????????????????? ?????? ??????????????? ???????????? ?????? ???????????? ????????????</li>

            </ol>
          </td>
        </tr>
        <tr>
        <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">??????????????? ?????????????????? ?????? ????????????????????? ???????????? ?????? ??????:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 6.6pt; padding-bottom:5px;line-height:8pt;">
            <ol style="line-height:10px;margin-top:5px;">
              <li value="1">?????? ??????????????? ?????? ??????????????? ?????? ??????????????? ??????????????? ???????????? ????????? ??????????????? ????????? ??????????????? ???????????? ?????? ??????????????? ????????????????????? ???????????????</li>
              <li>{!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_lpf'] !!}% ?????????????????????????????? ?????? ????????? ???????????? ?????? ??? ??????????????? ???????????? ??????????????? ???????????? ??????????????? ?????? {!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!} ??????????????? ?????? ???????????? ???????????????????????? ????????? ???????????? ?????? ?????????????????? ?????? ?????????????????? ???????????? ???????????????</li>
              <li>?????????????????????(??????) ?????? ?????????????????? ????????? ?????? ???????????? ?????? ?????? ?????????????????? ???????????? ?????? ????????? ?????? ???????????????????????? ???????????? ???????????? ??????????????????</li>
              <li>?????? ?????? ?????? ???????????? ?????? ????????? ??????????????? ?????????????????? ????????? ?????? ????????????????????????/?????????????????????????????? ?????????????????????/????????????????????? ???????????? ???????????? ???????????? ????????? ?????????</li>
              <li>????????????????????? ?????????????????? ?????? ?????? ?????? ????????????????????? ????????? ????????????????????????????????? ???????????????????????? ?????? ???????????? ?????? ?????????????????? ????????? ????????????</li>
              <li>???????????????????????? ?????????????????? ?????? ????????? ????????? ?????? ???????????????????????? ???????????? ??????, ????????????????????? ?????? ?????????????????? ?????? ???????????? ????????????????????? ???????????????????????? ??????????????? ?????? ?????????????????? ???????????? ???????????????</li>
              <li>????????? ??????????????? ?????????????????? ????????? ???????????? ???????????? ?????? ?????? ??????????????? ????????? ???????????? ?????????????????? ?????? ??????????????? ????????????????????? ?????????????????? ?????? ???????????? ??????????????? ???????????????????????????????????? ????????????????????? ????????? ???????????? ???????????????????????? ?????? ?????? ?????? ????????????????????? ???????????? ????????? ?????????????????? ??????????????????</li>
              <li>??????????????? ?????? ????????? 30 ????????? ???????????? ??????????????? ?????? ?????? ?????? ?????????????????? ??????????????? ?????? ?????????????????? ???????????????????????? ?????????</li>
              <li>?????? ?????? ??????????????? ?????? ????????? ????????? ?????????????????? ?????? ???????????? ????????? ??????????????? ??????????????? ???????????????, ?????? ?????????????????????????????? ??????????????? ????????? ????????????????????????????????? ????????????????????? (???????????? ?????? ????????????) ???????????? ??????????????? </li>
              <li>??????????????? ????????????????????? ?????? ???????????????????????? ?????? ?????????-?????? ?????? ???????????? ?????? ?????? ???????????? ????????????????????????-?????????????????? ?????? ?????? ???????????? ?????????????????? ??????????????????</li>
              <li>?????????????????? ?????? ????????????????????? ???????????? ????????? ????????? ?????? ???????????? ?????? ???????????????,?????? ?????? ????????? ????????????????????? ???????????? ?????? ???????????????????????? ????????? ?????? ?????????????????? ???????????? ???????????? ???????????? ?????? ?????? ?????? ????????????????????? ?????? ??????????????????</li>
              <li>?????? ?????? ??????????????? ???????????? ?????????????????? ?????? ???????????? ???????????? ???????????? ??????????????? ????????????????????? ?????? ?????????????????? ?????? ???????????????????????? ?????????</li>
              <li>?????? ??????????????? ????????? ???????????????????????? ?????? ??????????????? ?????? ???????????????, ????????? ?????????????????? ?????? ????????? ??????????????? ????????? ????????????/???????????????????????? ?????????????????? ???????????? ?????????</li>
              <li>?????? ?????? ????????????????????? ???????????? ?????? ??????????????? ?????? ????????????????????? ????????? ???????????? ?????? ????????????????????? ????????? ?????? ?????? ???????????? ?????????, ???????????????????????? ?????? ???????????????????????? ????????? ???????????? ??????????????? ???????????? ?????????????????? ???????????? ????????????, ???????????? ??????????????? ?????????????????? ????????????????????? ?????? ???????????? ???????????????????????? ????????? ??????????????????????????? ???????????? ?????? ??????????????? ?????? ?????????????????? ??????????????? ???????????? ??????????????????</li>
            </ol>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">??????????????? ????????????????????? ?????? ????????????????????? ???????????? ?????? ?????? :</h3>
          </td>
        </tr>
        
        <tr>
          <td colspan="3" style="font-size: 6.6pt; padding-bottom:5px; line-height:8pt;">
            <ol style="line-height:8pt;margin-top:5px;">
              <li value="1"> ??????????????????????????? ?????? ????????????????????? ?????? ???????????????????????? ?????? ?????????????????? ???????????? ?????????????????? ???????????????, ????????????????????? ??????????????????, ???????????? ?????????????????????????????? ????????? ????????? ?????? ???????????? ?????? ??????????????? ???????????????????????? ?????????????????? ?????????????????? ???????????? ????????? ???????????? ?????? ????????????????????? ??????????????? ???????????? ??????????????????</li>
              <li>??????????????? ?????? ????????????????????? ?????????????????? ??????????????? ???????????? ?????? ????????? ???????????????????????? ?????? ????????????????????? ????????????????????? ?????????????????? ?????? ?????? ??????????????????</li>
              <li>???????????????????????? ?????? ???????????? ???????????? ?????????????????? ???????????? ?????? ????????? ???????????? ?????????????????????????????? ?????? ??????????????? ???????????? ??????????????????????????????????????? ?????? ?????????????????? ?????? ????????????????????? ?????? ??????????????????</li>
              <li>?????????????????? ????????? ????????????????????????????????? ?????????????????? ????????? ?????? ????????????????????? ?????????????????? ???????????? ?????????, ??????????????? ??????????????????????????? ??????????????? ?????? ?????? ???????????? ?????????????????? ????????????????????? ?????? ??????????????? ?????????????????? ???????????? ??????????????? ????????? ???????????????????????? ?????? ????????????????????? ?????? ???????????????????????? ??????????????????????????? ?????????????????? </li>
              <li>???????????? ???????????????????????? ?????? ?????????????????? ???????????? ????????? ????????? ?????? ???????????????????????? ?????? ?????????????????? ?????? ?????????????????????????????? ?????????????????? ?????? ???????????? ???????????????</li>
              <li>?????????????????? ?????????????????? ?????????????????????????????? ???????????????????????? ????????? ?????????????????? ?????? ???????????? ?????? ???????????????????????? ??????  ??????????????? ??????????????? ????????????????????? ?????????</li>
              <li>?????? ?????? ??????????????? ?????? ???????????? ??????????????? ???????????? ?????????????????? ?????????????????????????????? ???????????? ???????????? ???????????????????????? ?????? ???????????? ?????? ????????? ???????????? ????????? ???????????? ?????????</li>
              <li>??????????????? ?????? ????????? ??????????????? ????????? ??????????????? ???????????? ???????????? ??????????????? ?????? ???????????? ???????????? ??? ?????? ??????????????? ??????????????? ?????????</li>
              <li>?????? ??????????????? ???????????? ????????? ????????????????????? ?????????????????? ??????????????????????????? ?????? ??????????????? ?????? ???????????? ?????? ???????????? ????????? (???????????????????????????/?????????????????????/???????????????, ???????????? ????????????)  ?????? ????????? ?????? ?????????????????? ?????? ???????????????????????? ???????????????</li>
              <li>?????? ??????????????? ?????? ????????? ?????????????????? ?????? ???????????? ?????? ???????????????????????? ?????????????????? ?????? ?????????</li>
              <li>?????? ?????????????????? ???????????? ?????????????????? ?????? ???????????? ?????????????????? ????????? ?????? ?????? ???????????? ????????? ???????????? ?????? ???????????? ?????????????????? ?????? ????????? ?????????????????? ???????????? ?????? ?????? ???????????? ???????????????</li>
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
                <p style="padding-bottom:3px;"><strong>????????????????????? ?????? ??????????????????????????? :</strong></p>
                  <table  width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td width="60%">
                        <div style="margin-bottom: 20px;">1.	_________________________________________</div>                    
                      </td>
                      <td></td>
                      <td width="40%" align="center">
                        <p style="text-align: center">??????????????? ?????????????????????????????? ???????????????????????? ???????????????????????? ????????????????????? ?????? ?????????</p>
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
                        <p style="text-align: center">(???????????????????????????)</p>
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
                        <p style="text-align: center">(?????????????????? ?????????????????????????????????????????? ?????? ?????????)</p>
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
                      <p>?????????????????? ????????????????????????????????? ????????????: B.05.02932</p>
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
          <td colspan="3" align="center"><strong> ??????????????? ????????? ????????? ?????? ????????? ?????????????????? ?????? ??????????????? <strong></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td align="left" colspan="3" style="font-size: 6pt">
            <p>???????????????????????? ????????? ???????????? ?????????, ??????????????? ?????????????????? ??????????????????????????? ?????? ???????????? ?????? ????????? ???????????? ????????? ???????????? ?????????????????? ??????????????? ...........................................?????????????????? ????????? ???????????? ?????? ????????? ??????????????? ?????? ???????????? ?????????????????? ???????????? ??? ????????? ??????????????? ?????? ???????????? ?????????
            </p>
          </td>
        </tr>
        <tr>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">
          ..........................................................................(?????????????????? ?????? ???????????????????????????)
          </td>
          <td colspan="1"></td>
        </tr>

      </table>

    </article>

  </section>

</body>

</html>