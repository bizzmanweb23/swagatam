<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Arohan Financial Services Limited - Tatkal Loan Application Form </title>

  <!-- Load paper.css for happy printing -->

  

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page {
      size: A4
    }

    html {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
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

    /* .gapping-01 {
      height: 5px;
      width: 100%;
    }

    .gapping-02 {
      height: 10px;
      width: 100%;
    } */

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
  <section class="sheet">

    <!-- Write HTML just like a web page -->
    <article>
      <table width="100%" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
            <table width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #222222;">
              <!--header-->
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr width="100%">
                        <td style="padding-left: 10px" align="left" width="35%">
                          <img src="{{env('DASHBOARD_RESOURCE_URL').'/'.getCompanyDetails(1)->s_logo}}" alt="logo" style="width:150px;">
                        </td>
                        <td align="left" width="65%">
                          <h2>Arohan Financial Services Limited <br> Tatkal Loan Application Form</h2>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <!--header end-->


              <!--content part-->
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="0">
                    <thead>

                      <tr>
                        <td colspan="2" width="80%">
                          <table width="100%" cellspacing="0" cellpadding="0">
                            <thead>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th
                                        style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; border-top: 1px solid #222222; width:19%; height:25px;">
                                        Branch Name</th>
                                      <td
                                        style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; border-top: 1px solid #222222; width:33%; ">
                                        {!! $detailVal->s_branch_name !!} ({!! $detailVal->s_branch_code !!})
                                      </td>
                                      <th
                                        style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; border-top: 1px solid #222222;width:18%;">
                                        Customer FIS ID</th>
                                      <td
                                        style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; border-top: 1px solid #222222;">
                                        {!! $detailVal->s_customer_profile_id !!}
                                      </td>
                                    </tr>

                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 22%; height:25px;">
                                        Center/Bazaar Name</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 23%; ">
                                       {!! $detailVal->s_center_name !!}
                                       </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:11%;">
                                        Center ID
                                      </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width:10%;">
                                        {!! $detailVal->s_center_code !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:11%;">
                                        Mobile ID
                                      </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;">
                                        {!! $detailVal->s_customer_id !!}
                                       </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%;height:25px;">Date of Application</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 33%; ">
                                        {!! date('d-m-Y', strtotime($detailVal->dt_created_at)) !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 14%;">
                                        Contact No.
                                      </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;">
                                        {!! $detailVal->s_customer_mobile_no !!}
                                        </td>

                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%; height:25px;">Name of Customer</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 44%; ">
                                        {!! $detailVal->s_cb_customer_salutation !!} {!! $detailVal->s_cb_customer_name !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:6%;">Age</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width:8%;">
                                        {!! $detailVal->i_cb_age !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:6%;"> Gender </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;">
                                      {!! $detailVal->s_pi_customer_gender !!}
                                      </td>

                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 16%;height:25px;">Loan Product Name</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width:18%; ">
                                        {!! $detailVal->s_product_name !!}</td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:18%;">
                                        Loan Amount Applied</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 18%;">
                                        {!! number_format($detailVal->s_loan_amount, 2, '.', ',') !!}
                                       </td>
                                     </tr>
                                  </table>
                                </td>
                              </tr>

                            </thead>

                          </table>
                        </td>

                        <td colspan="1" rowspan="0" style="border: 1px solid #222222; border-left:0; border-right:0; text-align: center;">
                          <b>Recent Photograph</b>
                        </td>
                      </tr>
                    </thead>


                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left" width="100%">
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%;height:25px;">
                        Primary Loan Amount
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 40%; ">
                        {!! number_format($custAddtnlData['Disbursed Amount'], 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:26%;">Primary Loan Disbursement Date</th>
                      <td style="border-right: 0; border-bottom: 1px solid #222222;">
                        {!! (($custAddtnlData['Date Of Disbursement'] == '' || $custAddtnlData['Date Of Disbursement'] == '0000-00-00')?'':date('d-m-Y', strtotime($custAddtnlData['Date Of Disbursement']))) !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left" width="100%">
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 23%;height:25px;">No of Active Loan from Arohan
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 13%; ">
                        {{$custAddtnlData['No Of Active Loans']}}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">No of Attendance in Last 6 Center/Bazaar Repayment</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width:10%;">
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%;">Primary Loan EMI Paid</th>
                      <td style=" border-bottom: 1px solid #222222; ">
                        {!! number_format($custAddtnlData['EMI'], 2, '.', ',') !!}
                      </td>
                      
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 9%;height:25px;">Co-Borrower Name
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 16%;  ">
                        {!! $detailVal->s_borrower_salutation.' '.$detailVal->s_borrower_name !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 7%;">Relationship </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 7%;">
                        {!! $detailVal->s_borrower_relationship !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 3%;">Age </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 3%; ">
                        {!! $detailVal->i_borrower_age !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 3%;">Gender </th>
                      <td style="border-right: 0; border-bottom: 1px solid #222222; width: 4%;">
                      {!! $detailVal->s_borrower_gender !!}
                      </td>
                      
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="4">
                    <tr align="center">
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; text-align:center; width:17%;height:30px;">
                      Loan Source
                      </th>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:15%; text-align: center;">Name</th>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 18%;">Borrowed Amount</th>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 16%; ">Monthly Repayment
                      </th>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%; ">Loan Outstanding
                      </th>
                      <th style="border-bottom: 1px solid #222222; border-right: 0; width: 16%;">Repayment Track</th>
                    </tr>
                    <?php
                      if($detailVal->s_cb_mfi_loan_details != ''){
                        $json = str_replace('\"', '"', $detailVal->s_cb_mfi_loan_details);
                        $mfiLoanDetails = json_decode($json, true);
                      }else{
                        $mfiLoanDetails = [];
                      }

                      $mfiList = DB::table('master_bank_mfi')->select('s_name_in_cics')->where([['i_is_active', 1], ['s_type', 'MFI'], ['s_name_in_cics', '!=', '']])->get()->toArray(); 

                      $mfiList = array_map(function ($value) {
                          return (array)$value;
                      }, $mfiList);

                      array_unshift($mfiList , 'AROHAN');
                    ?>
                    @for($i = 0; $i <= 3; $i++)
                      <tr align="center">
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;height:30px;">
                          {!! ((array_key_exists($i, $mfiLoanDetails)?(($mfiLoanDetails[$i]['orgName'] != '')?(in_array(strtoupper(str_replace(' (BANK)', '', str_replace(' (MFI)', '', $mfiLoanDetails[$i]['orgName']))),$mfiList)?'MFI':'Bank'):''):'')) !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; text-align: left; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $mfiLoanDetails)?(($mfiLoanDetails[$i]['orgName'] != '')?str_replace(' (BANK)', '', str_replace(' (MFI)', '', $mfiLoanDetails[$i]['orgName'])):''):'')) !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $mfiLoanDetails)?(($mfiLoanDetails[$i]['orgName'] != '')?$mfiLoanDetails[$i]['disbursementAmount']:''):'')) !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $mfiLoanDetails)?(($mfiLoanDetails[$i]['orgName'] != '')?$mfiLoanDetails[$i]['repayAmnt']:''):'')) !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $mfiLoanDetails)?(($mfiLoanDetails[$i]['orgName'] != '')?$mfiLoanDetails[$i]['loanBalance']:''):'')) !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 0">
                          {!! ((array_key_exists($i, $mfiLoanDetails)?(($mfiLoanDetails[$i]['orgName'] != '')?(($mfiLoanDetails[$i]['overdueAmt'] == '0.00')?'Regular':'Irregular'):''):'')) !!}
                        </td>
                      </tr>
                    @endfor
                  </table>

                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 17%;height:25px;">Sanctioned Amount
                      </th>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 8%;">In Figure</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 12%; ">
                        {!! number_format($detailVal->d_sanctioned_loan_amount, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 8%;">In Word</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 32%;">
                      {!! getIndianCurrencyInWord($detailVal->d_sanctioned_loan_amount) !!} Only
                          
                          </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 10%;">Monthly EMI</th>
                      <td style="border-right: 0; border-bottom: 1px solid #222222; width:9%; ">
                        {!! number_format($detailVal->d_emi, 2, '.', ',') !!}
                      </td>

                    </tr>
                  </table>
                </td>
              </tr>
              <!--From design end-->
              <!--text start-->


              <tr>
                <td colspan="3" class="gapping-02"></td>
              </tr>
                <tr>
                  <td colspan="3" style="font-size: 6pt; padding: 4px;"><strong>Declaration:</strong> I hereby declare that the above contents have been explained to me in my native language & the information furnished by me is true & to the best of my knowledge. I understand and accept that Arohan at any given period of time has the right to sell, mortgage, securitise, assign and dispose off the short term/long term loan / any other credit facility given to me, to any other Financial Institution,Bank & or any other agencies without further reference to me. I am taking the loan for myself to use for the above mentioned purpose, and not to either handover or mis-utilize the loan amount.
                  </td>
                </tr>
              <tr>
                <td colspan="1" style="font-size: 6pt; padding: 4px; padding-bottom: 10px; width: 50%;">
                </td>
                <td colspan="2">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr>
                      <th style="border: 1px solid #222222; border-right: 0; width: 43%;height:30px;">Signature of Customer
                      </th>
                      <td style=" border: 1px solid #222222; border-right: 0 ">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="font-size: 6pt; padding: 4px; padding-top: 10px; padding-bottom: 10px; width: 100%;">I {{$detailVal->s_borrower_salutation}} {{$detailVal->s_borrower_name}}, do hereby authorise {{$detailVal->s_cb_customer_salutation}} {{$detailVal->s_cb_customer_name}} to sign all the loan documents and other loan related documents on my behalf and I further agree that as and when disbursed, I shall be equally responsible to repay the loan jointly and severally, as per the terms and condition of the loan agreement.
                </td>
              </tr>
              <tr>
                <td colspan="1" style="font-size: 6pt; padding: 4px; padding-bottom: 0; width: 50%;">
                </td>
                <td colspan="2">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr>
                      <th style="border: 1px solid #222222; border-bottom: 0; border-right: 0; width: 43%;height:30px;">Signature of Co-Borrower
                      </th>
                      <td style="border: 1px solid #222222; border-bottom: 0; border-right: 0 ">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5" style="border-top: 1px solid #222222">
                    <tr align="left">
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 17%;height:25px;">CSR Name </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0;  width: 25%;">
                        {!! $detailVal->s_collected_user_name !!}
                      </td>
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 13%;">CSR Code</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 9%;">
                        {!! $detailVal->s_collected_user_code !!}
                      </td>
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 13%;"> CSR Signature</th>
                      <td style="border-right: 0; border-bottom: 0; ">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5" style="border-top: 1px solid #222222">
                    <tr align="left">
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 17%;height:25px;">Branch Head Name</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 21%; ">
                        {!! $branchHeadData->branchHeadName !!}
                      </td>
                      <th style="border-bottom:0; border-right: 1px solid #222222; width: 17%;">Branch Head Code</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 8%;">
                        {!! $branchHeadData->branchHeadCode !!}
                      </td>
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 19%;"> Branch Head Signature</th>
                      <td style="border-right: 0; border-bottom: 0 ">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        
        <tr>
          <td colspan="3">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right" colspan="2" style="font-size: 7pt;">
                  <p><b>RBI Registration Number : B.05.02932</b></p>
                </td>
                <td align="right" colspan="1" style="font-size: 7pt;">
                  <p><b>CIN : U74140WB1991PLC053189</b></p>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td colspan="3">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
              <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="left" colspan="3" style="font-size: 6pt;">
                  <p><b>Regd office:</b> Arohan Financial Services Limited. PTI Building, 4th Floor, DP Block, DP-9, Sector V, Salt Lake, Kolkata -700091, West Bengal. <b>Customer Care:</b> Toll Free number: 18001032375 | <b>Email:</b> customercare@arohan.in</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>



      </table>

    </article>

  </section>

</body>

</html>