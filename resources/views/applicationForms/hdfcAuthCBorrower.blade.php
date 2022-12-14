<!DOCTYPE html>
<html lang='en_us'>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hdfc authantication</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,500i,700" rel="stylesheet">
    <style>
            
    </style>

    
    </head>
    <body class="A4" style="width: 18cm; margin:0 auto; font-family: 'Roboto', sans-serif; font-size: 8pt; line-height: 10px; color: #000;">
        <section class="sheet padding-10mm">
            <!-- Write HTML just like a web page -->
            <article>
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td colspan="2" style="height: 45px; width: 100%;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <a href="#"><img src="{{env('DASHBOARD_RESOURCE_URL').'/'.getCompanyDetails(1)->s_logo}}" width="130"></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="text-decoration: underline; font-size: 10pt; font-weight: 400; padding:3px 0;">Customer’s Authorization </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right" style="padding:3px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 150px;">
                                <tr>
                                    <td style="font-size: 8pt;">Date:</td>
                                    <td style="width: 100%; border-bottom: 1px solid #000;">
                                        {{($detailVal->dt_disbursement_date  != '')?date('d/m/Y', strtotime($detailVal->dt_disbursement_date )):''}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 14pt;font-size: 8pt;">
                            To,<br>
                            HDFC Life Insurance Company Limited<br>
                            13th Floor, Lodha Excelus, Apollo Mills Compound, N.M Joshi Marg,<br>
                            Mahalaxmi, Mumbai 400 011, Maharashtra 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5px; height: 5px;"></td>
                    </tr>

                    <tr>
                        <td colspan="2" style="padding:0; line-height: 10pt;font-size: 8pt;">
                            Through, 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 10pt;font-size: 8pt;">
                            Arohan Financial Services Limited 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 3px;height:5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 10pt;font-size: 8pt;">
                            Dear Sir/Madam, 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 3px;height:5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 10pt;font-size: 8pt;">
                            <strong>Subject:</strong> Declaration for settlement of claim amount under Group insurance scheme in favour of Arohan Financial Services Limited for Loan Account No. <span style="border-bottom: 1px dashed #666; width:250px;line-height: 12pt;font-size: 8pt; height: 15pt;display: inline-block;" >{{($detailVal->s_loan_id == '')?'':$detailVal->s_loan_id.'S'}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 3px;height: 5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 15pt;font-size: 8pt;">
                            This is to inform you that I <span style="border-bottom: 1px dashed #666; width:300px;line-height: 10pt;font-size: 8pt; height: 15pt;display: inline-block;" >{{$detailVal->s_borrower_salutation}} {{$detailVal->s_borrower_name}}</span> S/O,D/O, W/O
                            <span style="border-bottom: 1px dashed #666; width:410px;line-height: 10pt;font-size: 8pt; height: 15pt;display: inline-block;" >{{$detailVal->s_borrower_father_or_husband_salutation.' '.$detailVal->s_borrower_father_or_husband_name}}</span> have availed a loan from Arohan Financial
                            Services Limited hereinafter referred to as MPH, and to secure the loan amount, in the event of an unforeseen
                            eventuality I have opted to enroll under the Group Insurance Scheme administered by MPH. I intend that in the
                            event of any eventuality with me, which gives rise to a claim, I authorize HDFC Life Insurance Company Limited
                            (HDFC Life) to make claim payment to the extent of outstanding loan balance amount to MPH. Balance of claim
                            amount left, if any, may be paid by HDFC Life to my nominee/beneficiary as the case may be.<br><br>
                            HDFC Life shall, in the event of any claim arising out of my membership under the group insurance scheme
                            administered by MPH, be discharged to the extent of amount paid to the MPH towards outstanding loan balance
                            amount for the loan availed by me.<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 15pt;font-size: 8pt;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td style="border: 1px solid #dddddd; font-size: 7pt; text-align: left; width: 80%; padding: 6px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="width:20px;" valign="top">1.</td>
                                                <td>Have you any of your immediate family members travelled outside India in the last 45 days or do you plan to travel outside India during the next 6 months?</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20px;" valign="top">2.</td>
                                                <td>Have you/any of your immediate family members been tested positive for COVID-19 or are awaiting results of such a test or been advised to be underquarantine due to COVID-19*?</td>
                                            </tr>
                                            <tr>
                                                <td style="width:20px;" valign="top">3.</td>
                                                <td>Are you/any of your immediate family members, currently suffering from or in the last 2 months, have suffered from fever, persistent cough, sore throat, breathing difficulties, gastro-intestinal symptoms (Vomiting/diarrhea)?</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">
                                        <table>
                                            <tr>
                                                <td style="padding-right: 10px;"><input type="checkbox" name="name1" /> Yes</td>
                                                <td style="padding-right: 10px;"> / </td>
                                                <td><input type="checkbox" name="name1" /> No</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 15pt;font-size: 8pt;">
                            <br>
                            I declare the following person to be my nominee (Details of Nominee to be mentioned below). 
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td valign="middle" style="padding:2px 0; line-height: 16pt;font-size: 8pt;">Nominee’s Name: </td>
                                    <td valign="middle" style="border:1px solid #000;height:8px; width: 210px; padding-left: 5px;">
                                        {{$detailVal->s_cb_customer_salutation}} {{$detailVal->s_cb_customer_name}}
                                    </td>
                                    <td valign="middle" style="width: 15px;"></td>
                                    <td valign="middle" align="right" style="padding:2px 5px 2px 0; line-height: 16pt;font-size: 8pt;">Relationship:</td><td valign="middle" align="left" style="border:1px solid #000;height:8px; width: 140px; padding-left: 5px;">
                                        <?php
                                        if($detailVal->i_borrower_relationship_id == '1' || $detailVal->i_borrower_relationship_id == '2'){
                                            if($detailVal->s_borrower_gender == 'Male'){
                                                $detailVal->i_borrower_relationship_id = 5;
                                            }else{
                                                $detailVal->i_borrower_relationship_id = 6;
                                            }
                                        }else if($detailVal->i_borrower_relationship_id == '3' || $detailVal->i_borrower_relationship_id == '4'){
                                            if($detailVal->s_borrower_gender == 'Male'){
                                                $detailVal->i_borrower_relationship_id = 3;
                                            }else{
                                                $detailVal->i_borrower_relationship_id = 4;
                                            }
                                        }else if($detailVal->i_borrower_relationship_id == '5' || $detailVal->i_borrower_relationship_id == '6'){
                                            if($detailVal->s_borrower_gender == 'Male'){
                                                $detailVal->i_borrower_relationship_id = 1;
                                            }else{
                                                $detailVal->i_borrower_relationship_id = 2;
                                            }
                                        }
                                        ?>
                                        @if($detailVal->i_borrower_relationship_id != '')
                                          {{getNomineeRelationshipId($detailVal->i_borrower_relationship_id)[$detailVal->i_borrower_relationship_id]}}
                                        @endif
                                    </td>
                                    <td valign="middle" style="width: 15px;"></td>
                                    <td valign="middle" style="padding:2px 0; line-height: 16pt;font-size: 8pt;">DOB:</td>
                                    <td valign="middle" style="border:1px solid #000;height:8px; width: 70px; padding-left: 5px;">
                                        {{date('d/m/Y', strtotime($detailVal->dt_cb_dob))}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td valign="middle" style="padding:2px 0; line-height: 16pt;font-size: 8pt; width: 104px;">Appointee’s Name: </td>
                                    <td valign="middle" style="border:1px solid #000;height:8px; width: 210px; padding-left: 5px;"></td>
                                    <td valign="middle" style="width: 11px;"></td>
                                    <td valign="middle" align="right" style="padding:2px 5px 2px 0px; line-height: 16pt;font-size: 8pt;">Relationship*:</td>
                                    <td valign="middle" align="left" style="border:1px solid #000;height:8px; width: 140px; padding-left: 5px;"></td>
                                    <td valign="middle" style="width: 15px;"></td>
                                    <td valign="middle" style="border:padding:2px 0; line-height: 16pt;font-size: 8pt;">DOB:</td>
                                    <td valign="middle" style="border:1px solid #000;height:8px; width: 70px; padding-left: 5px;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 10px 3px 3px 0px; height: 5px; ">
							<div style="font-style: italic; font-size: 7pt;">(Appointee details to be filled in case Nominee is minor/ *Relationship with Nominee)</div>
						</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 3px;height: 5px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding:3px 0; line-height: 12pt;font-size: 8pt;">
                            Thanking You,<br>
                            Yours truly, 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 3px;height:15px;"></td>
                    </tr>
                    <tr>
                        <td  style="padding:3px 0; line-height: 12pt;font-size: 8pt;">(Customer’s Signature) </td>
                        <td  style="padding:3px 15px 3px 0; line-height: 12pt;font-size: 8pt; text-align: right;">(Witness’s Signature)</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 3px;height:2px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td  style="padding:3px 0; line-height: 12pt;font-size: 8pt;">Customer Name: <span style="border-bottom: 1px solid #000; width:150px;line-height: 10pt;font-size: 8pt; height: 15pt;display: inline-block;" >{{$detailVal->s_borrower_salutation}} {{$detailVal->s_borrower_name}}</span></td>
                                    <td></td>
                                    <td align="right" style="padding:3px 0; line-height: 12pt;font-size: 8pt;">Witness Name: <span style="border-bottom: 1px solid #000; width:150px;line-height: 10pt;font-size: 8pt; height: 15pt;display: inline-block;" >{!! $detailVal->s_collected_user_name !!}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:3px 0; line-height: 12pt;font-size: 8pt;">Branch Name: <span style="border-bottom: 1px solid #000; width:150px;line-height: 10pt;font-size: 8pt; height: 15pt;display: inline-block;" >{{$detailVal->s_branch_name}}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:3px 0; line-height: 12pt;font-size: 8pt;">Center/Bazaar: <span style="border-bottom: 1px solid #000; width:150px;line-height: 10pt;font-size: 8pt; height: 15pt;display: inline-block;" >{!! ($detailVal->s_center_name == '')?'&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;':$detailVal->s_center_name !!}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>


        </article>
    </section>
    </body>
</html>