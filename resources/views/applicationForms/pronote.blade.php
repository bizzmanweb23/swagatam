<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Arohan Financial Services Limited LOS - Pronote</title>


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
          <td colspan="1" align="left" width="50%">
            <img src="{{env('DASHBOARD_RESOURCE_URL').'/'.getCompanyDetails(1)->s_logo}}" alt="logo"style="width:150px;">
          </td>
          <td colspan="2" align="left" width="50%">
            <h2>Pronote</h2>
          </td>
        </tr>
        <!--header end-->


        <!--date palce start-->
        <tr>
          <td colspan="4">
            <table width="100%" colspacing="0" cellpadding="0">
              <tr width="100%;">
                <td colspan="3">
                  @php ($loanAmtApplied = (($detailVal->d_sanctioned_loan_amount != '')?$detailVal->d_sanctioned_loan_amount:$detailVal->s_loan_amount)) 
                  <strong>Rs. {!! number_format($loanAmtApplied, 2, '.', ',') !!}</strong>
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td colspan="0" align="right">
                  <table width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        
                        <p>Place: {!! $detailVal->s_branch_name !!}</p>
                      </td>
                    </tr>
                    

                    <tr>
                      <td>
                        <p style="float: left">Date: {!! (($detailVal->dt_disbursement_date != '')?date('d/m/Y', strtotime($detailVal->dt_disbursement_date)):'') !!}</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            </table>
          </td>
        </tr>
        <!--date place end-->

        <!--content part-->

        <tr>
          <td>&nbsp;</td>  
        </tr>
        <!--text start-->
       
        <tr>
          <td colspan="3" align="left">On demand I <strong>{!! $detailVal->s_cb_customer_salutation !!} {!! $detailVal->s_cb_customer_name !!}</strong> promise to pay <strong>Arohan Financial
              Services Limited.,</strong> a sum of <strong>Rs. {!! number_format($loanAmtApplied, 2, '.', ',') !!}</strong> with interest @<strong> {!! json_decode(str_replace('\"', '"', $detailVal->s_product_details), true)['d_interest_rate'] !!}%</strong>
            per annum on account of consideration as specified below :- </td>
        </tr>
        <tr>
          <td colspan="3" class="gapping-02"></td>
        </tr>
        <tr>
          <td colspan="3">Loan of <strong>Rs. {!! number_format($loanAmtApplied, 2, '.', ',') !!}</strong> received by me from <strong> Arohan Financial Services
              Ltd.,</strong> by cash on <strong> {!! (($detailVal->dt_disbursement_date != '')?date('d/m/Y', strtotime($detailVal->dt_disbursement_date)):'') !!}</strong> (Date of receipt of Loan).
            </strong>

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>  
        </tr>
        <tr>
          <td>&nbsp;</td>  
        </tr>
        <tr>
          <td>&nbsp;</td>  
        </tr>
        
        <tr>
          <td colspan="3">
            <table width="100%" colspacing="0" cellpadding="0">
              <tr>
                <td colspan="1">
                  <table width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td>Loan No.</td>
                      <td><input style="border-top:0; border-right: 0; border-left: 0; border-bottom: 1px solid #222; padding-bottom: 3px;" name="branchname" type="text" value="{{$detailVal->s_loan_id}}"></td>
                    </tr>
                  </table>                 
                  
                </td>
                <td colspan="1">

                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td colspan="2">
                  <table width="100%" colspacing="0" cellpadding="0">
                    <tr>
                      <td align="right" style="width: 100%; text-align: center;  border: 1px solid #222222; background: transparent;  height: 25px;">
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="gapping-02"></td>
                    </tr>
                    <tr>
                      <td align="right">
                        <p>Signature Of Borrower</p>
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
          <td align="right" colspan="3" style="font-size: 6pt;">
            RBI Certificate No. B.05.02932
          </td>
        </tr>
        <tr>
          <td align="right" colspan="3" style="font-size: 6pt;">
            CIN No. U74140WB1991PLC053189
          </td>
        </tr>


        <!--footer part end-->
      </table>

    </article>

  </section>

</body>

</html>