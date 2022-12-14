<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Arohan Financial Services Limited - Loan Sanction Letter and Loan Agreement</title>

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
            <td align="left">
              <img src="{{env('DASHBOARD_RESOURCE_URL').'/'.getCompanyDetails(1)->s_logo}}" alt="logo" style="width:120px;">
            </td>
            <td align="left" colspan="2">
              <h2 class="heading-01">Loan Sanction Letter and Loan Agreement</h2>
            </td>

          </tr>
          <!--header end-->


          <!--address box-->
          <tr>
            <td colspan="3">
              <table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td colspan="3" align="center"><h3 class="heading-01">Loan Sanction Letter</h3></td>
              </tr>
                <tr>
                  <td> As requested by you vide your loan application we Arohan, hereby approve the below loan to following customers.</td>
                </tr>
              </table>
            </td>
          </tr>
          <!--address box end-->

          <!--content part-->
          <tr>
            <td colspan="3">
              <table width="100%" cellspacing="0" cellpadding="4" style="border: 1px solid #dddddd">
                <thead>
                  <tr>
                    <th colspan="4" rowspan="0" align="left" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd; width:5%;">SI.No.</th>
                    <th colspan="4" rowspan="0" align="left" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd; width:40%;">Name</th>
                    <th colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">Loan Amount (Rs.)</th>
                    <th colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">Loan Processing Fees + GST (Rs.) </th>
                    <th colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; border-right: 1px solid #dddddd">Installment Amount </th>
                    <th colspan="4" rowspan="0" align="right" style="border-bottom: 1px solid #dddddd; ">Insurance Premium </th>
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
            <td colspan="3" style="padding-bottom:6px;"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom:0px; border-top:1px solid #000; width:100%; margin-top:0px;"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding-bottom:6px;"></td>
          </tr>
        <tr>
          <td colspan="3" align="center" style="padding-bottom:3px;">
            <h3 class="heading-02">Agreement Affirming the Joint Liability of the Group</h3>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:8px;"></td>
          </tr>
          <tr>
            <td colspan="3" align="left" style="padding-bottom:3px; font-size:6pt; line-height:8pt;">
              <p>
              This Loan agreement made on {!! (($detailVal->dt_disbursement_date != '')?date('d', strtotime($detailVal->dt_disbursement_date)):'') !!} day of {!! (($detailVal->dt_disbursement_date != '')?date('F', strtotime($detailVal->dt_disbursement_date)):'') !!} (month), {!! (($detailVal->dt_disbursement_date != '')?date('Y', strtotime($detailVal->dt_disbursement_date)):'') !!} , between, Arohan
              Financial Services Ltd. (hereinafter referred to as Arohan), a Non-Banking Finance Company registered under
              the Companies Act,1956, having its registered office at, PTI Building, 4th Floor, DP-9, Sector-V, Salt lake,
              Kolkata-700091  and above mentioned customers. Collectively referred to as ‘Borrowers’. 
            </p>
          </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:3px;"></td>
          </tr>
        <tr>
            <td colspan="3" align="left" style="padding-bottom:3px; font-size:6pt; line-height:8pt;">
              <p>              
               Borrowers promise to repay the loans taken by them at {!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}% rate of interest calculated on a diminishing balance in {{$detailVal->s_loan_tenure}}
              Weekly/fortnightly/Monthly installments in a timely manner. Every installment is due on {{config('constants.MASTER_WEEK_DAYS')[getCenterDetailsFronCode($detailVal->s_center_code)->i_day_of_the_week]}} (day) of
              the {{getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month}}{{ ((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '1')?'st':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '2')?'nd':((getCenterDetailsFronCode($detailVal->s_center_code)->i_week_of_the_month == '3')?'rd':'th')))}} week of the month; with the first scheduled date of repayment on ______________ (date). The detailed
              repayment schedule and all relevant terms and conditions of the loan are mentioned in the Loan Repayment
              Book which each borrower acknowledges having received.. 
              </p>
              </td>
          </tr>
          <tr>
          <td colspan="3"> &nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">The borrowers of the group, confirms that:</h3>
          </td>
        </tr>
          <tr>
            <td colspan="3" style="padding-bottom:3px">
              <ol style="font-size:6.8pt">
                <li>The members of the JLG group have been selected by the members themselves and not under the influence of Arohan.</li>
                <li>Should a case of default arise with respect to the payments due to Arohan, the group, would assist and co-operate with Arohan to prevent and /or recover overdue amount from the said person(s)</li>
                <li>Undertake to make good the liability that arises on account of any default committed by any group member.</li>
                <li>Any case of default within the group, can result in all members of the group being ineligible for future loans from Arohan.</li>
                <li>Undertake to make good the liability that arises on account of any default committed by any center member.</li>
                <li>Accept that, any case of default within the center, can result in the borrowers being ineligible for future loans from Arohan</li>
                <li>And the borrowers undertake that each member is taking the loan for himself/herself to use for the purpose stated in the loan application form, and promises not to either handover or misutilize the loan amount taken from Arohan.</li>
                <li>The borrower cannot be a member of more than one JLG with Arohan.</li>
              </ol>
            </td>
          </tr>
          <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">It is also accepted by both parties that:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
          <tr>
            <td colspan="3" style="padding-bottom:3px" >
              <ol style="font-size:6.8pt">
                <li value="1">Interest will be charged from the date of loan disbursement and interest will be accrued on
                  a daily basis. </li>
                <li>Non-refundable loan processing fee of {!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_lpf'] !!}% plus the applicable tax and insurance premium of
                  Rs. <span style="border-bottom: 1px dotted #000;">{!! number_format($detailVal->d_ins_fee, 2, '.', ',') !!}</span> per thousand per annum is payable by the customer. </li>
                <li>No penalty will be charged if the Borrower(s) chooses to foreclose their loan. </li>
                <li>Arohan does not take any type of asset as collateral/security deposit/margin money against any loan
                </li>
                <li>All the documents signed by the Borrower in relation to this loan are an integral part of this
                  agreement</li>
                <li>There is no penalty on delayed payments, however borrowers will have to pay the extra interest accrued
                  due to the delay. </li>
                <li>In case of any default by the member, Arohan will report the said default to the Credit Bureaus, which
                  may result in inability of the borrower to borrow from similar institutions. </li>
                <li>Arohan holds the right to alter terms of loan with prior intimation of 30days. </li>
                <li>Only non-refundable interest, loan processing charge and the insurance premium (including taxes as
                  applicable) is payable by the customer(s) as the pricing of the loan. </li>
                <li>Arohan will not lend to borrower with loan from more than one NBFC-MFI, under MFIN or Sa-Dhan. </li>
                <li>Recovery of loan given in violation of the regulations will be deferred till all existing loans are
                  fully repaid. </li>
                <li>Loan application will not be returned to the customer as it is the property of the organization. </li>
                <li>Except for the loan installment as mentioned in the loan card, Arohan issues cash receipt
                  /acknowledgment for cash transactions. </li>
                <li>In case of any dispute with regards to this loan whether during the subsistence to thereafter, the
                  court at Kolkata shall have exclusive Jurisdiction. This shall not however limit the rights of the
                  Arohan to file/take proceedings any other court of competent jurisdiction. </li>
              </ol>
            </td>
          </tr>

          <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 7pt; padding-bottom:5px;">
            <h3 class="heading-02">Arohan assures the borrower that:</h3>
          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
          <tr>
            <td colspan="3" >
              <ol style="font-size:6.8pt">
                <li value="1"> The privacy of borrower data shall be respected. However, Arohan will share customer
                  information with credit bureaus, insurance provider and other agencies as required by law. </li>
                <li>Customer information will be shared with credit bureaus to get past credit history. </li>
                <li>To provide insurance service to customer, customer information will be shared with insurance provider
                  or Third party providers.</li>
                <li>While sharing information with the Ratings and certification agencies, etc. Arohan will ensure that
                  the information is shared only on a “need to know basis” and also ensure that the privacy of customer
                  data is secured. </li>
                <li>The Company will be accountable for preventing inappropriate staff behaviour and for timely grievance
                  redressal. </li>
                <li>Arohan is committed to fair and transparent lending practices, as prescribed by the RBI. </li>
                <li>Loan is not linked with any other products or services, offered by Arohan or any third party. </li>
                <li>Arohan holds the right to alter terms of loan with prior intimation of 30days. </li>
                <li>Changes in interest rates and charges will be effected only prospectively and not retrospectively.
                </li>
                <li>There will be a Moratorium for the loan repayment equivalent to the period of one instalment
                  (Weekly/fortnightly/Monthly as the case may be) selected by the borrower in the loan application form.
                </li>
                <li>The Company has provided acknowledgment of receipt of the loan application.</li>
                <li> In case of Cashless disbursement, this Agreement is valid subject to transfer of fund to customer’s
                  bank account or issuance of cheque to customer. </li>
              </ol>
            </td>
          </tr>
          <tr>
          <td colspan="3">&nbsp;</td>
        </tr>

        <tr>
          <td colspan="4">
            <table width="100%" colspacing="0" cellpadding="0">
              <tr>
                <td >
                <p style="padding-bottom:3px;"><strong>Signature of Borrower:</strong></p>
                  <table  width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td width="40%">
                        <div style="margin-bottom: 20px;">1.  _________________________________________</div>                    
                      </td>
                      <td width="60%" align="center">
                        <p style="text-align: center">For Arohan Financial Services Ltd.</p>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td width="40%">                      
                        <div style="margin-bottom: 20px;">2.  _________________________________________</div>
                      </td>
                      <td width="60%" align="center">
                        <p style="text-align: center">(Signature)</p>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td>                        
                        <div style="margin-bottom: 20px;">3.  _________________________________________</div>
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
                        <p style="text-align: center">(Name of Authorised Signatory)</p>
                      </td>
                    </tr>
                    <tr>
                      <td height="12"></td>
                    </tr>
                    <tr>
                      <td>                        
                        <div style="margin-bottom: 20px;">5.  _________________________________________</div>
                      </td>
                    </tr>
                  </table>
                </td>

                <!-- <td  width="50%">
                  <table width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td >
                        
                      </td>
                    </tr>
                  </table>
                </td> -->
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
                        <p>RBI Registration No.: B.05.02932</p>
                      </td>
                      <td align="left" style="font-size: 6pt; width:30%;padding-left:30px;">
                        <p>CIN: U74140WB1991PLC053189</p>
                      </td>
                  </tr>
              </table>
              </td>
          </tr>

          <tr>
            <td style="padding-bottom:3px"></td>
          </tr>

          <!--footer part end-->

          <tr>
            <td colspan="3" align="center" style="padding-bottom:10px"><strong>Customer Declaration for Cross Sell Loan </strong></td>
          </tr>
          
          </tr>
          <tr>
            <td align="left" colspan="3" style="font-size: 6pt;">
              <p>While availing primary loan, I have seen the list of useful items. Accordingly, I have opted
                for……………………………………………………. product and have requested the Arohan official to arrange it.
              </p>
            </td>
          </tr>
          
          <tr>
            <td colspan="3" style="padding-top:10px; font-size:6pt;">
              <input name="branchname" type="text"
                style="width: 40%;  border: 0; background: transparent; height: 9px; border-bottom: 1px solid #222222;">
              (Name of Authorised Signatory)
            </td>
            
          </tr>

        </table>

      </article>

    </section>

</body>

</html>