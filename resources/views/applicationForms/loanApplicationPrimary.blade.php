<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Arohan Financial Services Limited - Customer Information and Loan Application Form </title>

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
      font-size: 6pt;
      color: #000000;
      -webkit-text-size-adjust: none;
      -ms-text-size-adjust: none;
      margin: 0;
      padding: 8mm;
      padding-top:10mm;
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
                          <h2>Arohan Financial Services Limited <br> Customer Information and Loan Application Form</h2>
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
                                        style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; border-top: 1px solid #222222; width:19%; height:12px;">
                                        Branch Name</th>
                                      <td
                                        style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; border-top: 1px solid #222222; width:33%; ">
                                        {!! $detailVal->s_branch_name !!} ({!! $detailVal->s_branch_code !!})
                                      </td>
                                      <th
                                        style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; border-top: 1px solid #222222;width:18%;">
                                        Mobile ID
                                        </th>
                                      <td
                                        style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; border-top: 1px solid #222222;">
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
                                      <th
                                        style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; border-top: 1px solid #222222; width:19%; height:12px;">
                                        Center Name</th>
                                      <td
                                        style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; border-top: 1px solid #222222; width:33%; ">
                                        {!! $detailVal->s_center_name !!}
                                      </td>
                                      <th
                                        style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; border-top: 1px solid #222222;width:18%;">
                                        FIS ID
                                        </th>
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
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%;height:12px;">Date of Reg.</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 33%; ">
                                        {!! date('d-m-Y', strtotime($detailVal->dt_created_at)) !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 18%;">
                                        Mobile No.
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
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%; height:12px;">Customer Name</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 51%; ">
                                        {!! $detailVal->s_cb_customer_salutation !!} {!! $detailVal->s_cb_customer_name !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:5%;">Age</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width:6%;">
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
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%;height:12px;">Name of Father </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 33%; ">
                                        {!! (($detailVal->s_cb_father_name != '')?$detailVal->s_cb_father_salutation.' '.$detailVal->s_cb_father_name:'') !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 18%;">
                                        Religion
                                      </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;">
                                        {!! $detailVal->s_religion !!}
                                        </td>

                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%;height:12px;">Name Of Spouse</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 33%; ">
                                        {!! (($detailVal->s_cb_spouse_name != '')?$detailVal->s_cb_spouse_salutation.' '.$detailVal->s_cb_spouse_name:'') !!}
                                        </td>
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 18%;">
                                        Marital Status
                                      </th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;">
                                        {!! $detailVal->s_customer_marital_status !!}
                                        </td>

                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" cellspacing="0" cellpadding="5">
                                    <tr align="left" width="100%">
                                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 19%;height:12px;">Customer Address</th>
                                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;">
                                        {!! $detailVal->s_cb_permanent_address.', '.$detailVal->s_cb_district.', '.$detailVal->s_cb_state.', '.$detailVal->i_cb_pincode !!}
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </thead>

                          </table>
                        </td>

                        <td colspan="1" rowspan="0" style="border: 1px solid #222222; border-left:0; border-right:0; text-align: center;">
                          <b>Recent Joint Photograph</b>
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
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15.1%;height:12px;">Type of Area
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 15%; ">
                        {!! $detailVal->s_land_type !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">Type of House</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width:15%;">
                        {!! $detailVal->s_type_of_house !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">Residing Since</th>
                      <td style=" border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">
                        {!! $detailVal->i_house_stay_duration !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222;">Years</th>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15.1%;height:12px;">Residential Land
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 15%;  ">
                        {!! $detailVal->s_land_measurement !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 15%;">In Sq.ft.</th>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 15%;">Agriculture Land</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 15%;">
                      </td>
                      <th style="border-bottom: 1px solid #222222; ">Bigha/Kattha/Kotha</th></tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 10%;height:12px;">KYC 1
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 15%;  ">
                        {!! $detailVal->s_cb_kyc_type1 !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 7.5%;">Number</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 17%;">
                        {!! $detailVal->s_cb_kyc1 !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 10%;height:12px;">KYC 2
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 15%;  ">
                        {!! $detailVal->s_cb_kyc_type2 !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 7.5%;">Number</th>
                      <td style="border-bottom: 1px solid #222222; width: 17%;">
                        {!! $detailVal->s_cb_kyc2 !!}
                      </td>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;height:12px;">Co-Borrower
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 30%;  ">
                        {!! $detailVal->s_borrower_salutation.' '.$detailVal->s_borrower_name !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 10%;">Relationship </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 15%;">
                        {!! $detailVal->s_borrower_relationship !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 5%;">Age </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 10%; ">
                        {!! $detailVal->i_borrower_age !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 5%;">Gender </th>
                      <td style="border-right: 0; border-bottom: 1px solid #222222;">
                      {!! $detailVal->s_borrower_gender !!}
                      </td>
                      
                    </tr>
                  </table>
                </td>
              </tr>

              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%;height:12px;">Members Above 18
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 5%;  ">
                        {!! $detailVal->i_members_above_18 !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;; width: 20%;">Members Less than 18</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 5%;">
                        {!! $detailVal->i_members_less_than_18 !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 5%;">Male</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 5%; ">
                        {!! $detailVal->i_male_count !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 5%;">Female </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222; width: 5%;">
                        {!! $detailVal->i_female_count !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%;">Total Earning Members</th>
                      <td style="border-right: 0; border-bottom: 1px solid #222222;">
                        {!! $detailVal->i_earning_members !!}
                      </td>
                      
                    </tr>
                  </table>
                </td>
              </tr>
              
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="4">
                    <tr align="center">
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; text-align:center; width:17%;height:12px;">Loan Source</th>
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
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;height:12px;">
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
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 50%;height:12px;text-align:center;">Monthly Income Analysis
                      </th>
                      <th style="border-bottom: 1px solid #222222; width: 50%;height:12px;text-align:center;">Monthly Expenses Analysis
                      </th>
                      
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Business Revenue
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_busines_one_income, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Food
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_food, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Other Revenue
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_other_income, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Fuel/Electricity
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_fuel_electricity, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Business Expenses
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_total_business_expense, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Education
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_education, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Net Household Income
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%;  text-align:right;">
                        {!! number_format($detailVal->d_net_income, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Rent
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_rent, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">EMI Payment
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%;  text-align:right;">
                        {!! number_format($detailVal->d_existing_emi, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Medical
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%;  text-align:right;">
                        {!! number_format($detailVal->d_medical, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Surplus
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_surplus, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Others
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_other_expense, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Proposed Loan EMI
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_proposed_loan_emi, 2, '.', ',') !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Total Household Expenditure
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; text-align:right;">
                        {!! number_format($detailVal->d_food+$detailVal->d_fuel_electricity+$detailVal->d_education+$detailVal->d_rent+$detailVal->d_medical+$detailVal->d_other_expense, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;height:12px;">Main Loan Purpose
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 20%; ">
                        {!! $detailVal->s_main_loan_purpose !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">Sub Purpose
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 20%; ">
                        {!! $detailVal->s_sub_loan_purpose !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">Loan Amount Applied
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 15%; text-align:right;">
                        {!! number_format($detailVal->s_loan_amount, 2, '.', ',') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;height:12px;">Loan to be used by 1
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 25%; ">
                        {!! $detailVal->d_loan_amount_by1 !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 25%;">Loan to be used by 2
                      </th>
                      <td style="border-bottom: 1px solid #222222;width: 25%; ">
                        {!! $detailVal->d_loan_amount_by2 !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 12%;height:12px;">Bank Name
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 20%; ">
                        {!! $detailVal->s_bank_name !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">Branch name
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 20%; ">
                        {!! $detailVal->s_branch_detail !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 18%;">Account Holder Name
                      </th>
                      <td style="border-bottom: 1px solid #222222;">
                        {!! $detailVal->s_account_holder_name !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                        
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 12%;height:12px;">Account Type
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 20%; ">
                        {!! $detailVal->s_account_type !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 15%;">Account Number
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 1px solid #222222;width: 20%; ">
                        {!! $detailVal->i_account_number !!}
                      </td>
                      <th style="border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 18%;">IFSC Code
                      </th>
                      <td style="border-bottom: 1px solid #222222;">
                        {!! $detailVal->s_ifsc_code !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5">
                    <tr align="left">
                      <th style="border-bottom: 2px solid #222222; border-right: 1px solid #222222; width: 20%;height:12px;">Sanctioned Amount In figure
                      </th>
                      <td style="border-right: 1px solid #222222; border-bottom: 2px solid #222222;width: 12%; text-align:right;">
                        {!! (($detailVal->d_sanctioned_loan_amount != '')?number_format($detailVal->d_sanctioned_loan_amount, 2, '.', ','):'') !!}
                      </td>
                      <th style="border-bottom: 2px solid #222222; border-right: 1px solid #222222; width: 10%;">In Word</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 2px solid #222222; width: 45%;">
                      {!! (($detailVal->d_sanctioned_loan_amount != '')?getIndianCurrencyInWord($detailVal->d_sanctioned_loan_amount).' Only':'') !!}
                          
                          </td>
                      <th style="border-bottom: 2px solid #222222; border-right: 1px solid #222222; width: 5%;">EMI</th>
                      <td style="border-right: 0; border-bottom: 2px solid #222222; text-align:right;">
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
                  <td colspan="3" style="font-size: 6pt; padding: 4px;"><strong>Declaration:</strong>  I hereby declare that the above contents have been explained to me in my native language & the information furnished by me is true & to the best of my knowledge. I understand and accept that Arohan at any given period of time has the right to sell, mortgage, securitise, assign and dispose off the short term/long term loan / any other credit facility given to me, to any other Financial Institution,Bank & or any other agencies without further reference to me. I am taking the loan for myself to use for the above mentioned purpose, and not to either handover or mis-utilize the loan amount.

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
                <td colspan="3" style="font-size: 6pt; padding: 4px; padding-top: 10px; padding-bottom: 10px; width: 100%;">I {{$detailVal->s_borrower_salutation}} {{$detailVal->s_borrower_name}}, do hereby authorise {{$detailVal->s_cb_customer_salutation}} {{$detailVal->s_cb_customer_name}}  to sign all the loan documents and other loan related documents on my behalf and I further agree that as and when disbursed, I shall be equally responsible to repay the loan jointly and severally, as per the terms and condition of the loan agreement.
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
                  <table width="100%" cellspacing="0" cellpadding="4">
                    <tr align="center">
                      <th style="border-top: 2px solid #222222; border-bottom: 1px solid #222222; border-right: 1px solid #222222; text-align:center; width:20%;height:12px;">Neighbour's Name</th>
                      <th style="border-top: 2px solid #222222; border-bottom: 1px solid #222222; border-right: 1px solid #222222; width:20%; text-align: center;">Occupation</th>
                      <th style="border-top: 2px solid #222222; border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%;">Remarks</th>
                      <th style="border-top: 2px solid #222222; border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%; ">Location
                      </th>
                      <th style="border-top: 2px solid #222222; border-bottom: 1px solid #222222; border-right: 1px solid #222222; width: 20%; ">Phone Number
                      </th>
                    </tr>
                    @for($i = 0; $i <= 1; $i++)
                      <tr align="center">
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222;height:12px;">
                          {!! ((array_key_exists($i, $arrnFdback))?(($arrnFdback[$i]->s_name != '')?$arrnFdback[$i]->s_name:''):'') !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; text-align: left; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $arrnFdback))?(($arrnFdback[$i]->s_occupation != '')?$arrnFdback[$i]->s_occupation:''):'') !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $arrnFdback))?(($arrnFdback[$i]->s_remarks != '')?$arrnFdback[$i]->s_remarks:''):'') !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 1px solid #222222">
                          {!! ((array_key_exists($i, $arrnFdback))?(($arrnFdback[$i]->s_location != '')?$arrnFdback[$i]->s_location:''):'') !!}
                        </td>
                        <td style="border-bottom: 1px solid #222222; border-right: 0">
                          {!! ((array_key_exists($i, $arrnFdback))?(($arrnFdback[$i]->s_phone_no != '')?$arrnFdback[$i]->s_phone_no:''):'') !!}
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
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 15%;height:12px;">CSR Name </th>
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
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 15%;height:12px;">Document Verified by</th>
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 5%;height:12px;">Name</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 22%; "></td>
                      <th style="border-bottom:0; border-right: 1px solid #222222; width: 5%;">Code</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 10%;"></td>
                      <th style="border-bottom:0; border-right: 1px solid #222222; width: 5%;">Date</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 10%;"></td>
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 8%;">Signature</th>
                      <td style="border-right: 0; border-bottom: 0 ">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5" style="border-top: 1px solid #222222">
                    <tr align="left">
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 15%;height:12px;">Cross Verification Date</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 10%; ">{!! (($detailVal->dt_cross_verification != '')?date('d-m-Y', strtotime($detailVal->dt_created_at)):'') !!}</td>
                      <th style="border-bottom:0; border-right: 1px solid #222222; width: 5%;">Name</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 22%;">{!! $branchHeadData->branchHeadName !!}</td>
                      <th style="border-bottom:0; border-right: 1px solid #222222; width: 5%;">Code</th>
                      <td style="border-right: 1px solid #222222; border-bottom: 0; width: 10%;">{!! $branchHeadData->branchHeadCode !!}</td>
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 8%;">Signature</th>
                      <td style="border-right: 0; border-bottom: 0 ">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <table width="100%" cellspacing="0" cellpadding="5" style="border-top: 1px solid #222222">
                    <tr align="left">
                      <th style="border-bottom: 0; border-right: 1px solid #222222; width: 15%;height:12px;">Branch Head Name</th>
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



      </table>

    </article>

  </section>

</body>

</html>