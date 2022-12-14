<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Balic DoGH</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,500i,700" rel="stylesheet">
    
    <!-- <link rel="stylesheet" href="css/style.css">
    <link rel = "stylesheet" type = "text/css" media ="print" href = "print.css"> -->
    
    <style>
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
        padding: 0;
        margin:0;
        -webkit-font-smoothing: antialiased;
        width: 100%;
        }
        h2{
        font-size:9pt;
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
        }    
    </style>
    </head>
    <body class="A4" style="width: 18cm; margin:0 auto; font-family: 'Roboto', sans-serif; font-size: 8pt; line-height: 10px; color: #000;">
            <section class="sheet padding-10mm">
             <!-- Write HTML just like a web page -->
             <article>
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
            <tr>
                <td colspan="2" style="height: 10px; width: 100%;"></td>
            </tr>
            <tr>
                <td style="padding-left:5px; margin-top: 0; margin-bottom: 0;padding-bottom: 0; padding-top: 0;">
                    <img src="{{asset('public/images/logoDOGH.jpg')}}" alt="logo" class="brand">
                </td>
                <td align="right" style="padding-bottom: 0; padding-top: 0;">
                    <h3 style="padding: 0; margin: 0; font-size: 9pt;">Bajaj Allianz Life Insurance Co. Ltd.</h3>
                    <p style="margin: 0; padding: 0; font-size: 6pt;">Bajaj Allianz House, Airport Road, Yerawada, Pune - 411006.</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 10px; width: 100%;"></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#006cb5" style="-webkit-print-color-adjust: exact;font-weight: bold; color: #fff; padding: 2px;">Enrollment/Declaration of Good Health/Authorisation Form</td>
            </tr>
            <tr>
                <td valign="middle" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="width:230px;">
                        <tr>
                            <td style="width:90px;"><strong style="margin:0; margin-right: 5px; line-height: 18px;width: 110px;">Master Policy No.:</strong></td>
                            @php ($policyStrSplt = str_split('Q0339610803'))
                            @for($i = 0; $i < 10; $i++)
                                @if($i == 0)
                                    <td style="margin:0; text-align: center; line-height: 11px; width:12px; height: 15px; border: 1px solid #000;">{{$policyStrSplt[$i]}}</td>
                                @else
                                    <td style="margin:0; text-align: center; line-height: 11px; width:12px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;">{{$policyStrSplt[$i]}}</td>
                                @endif
                            @endfor
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
            <tr >
                <td colspan="2" valign="middle" style="padding: 3px;padding-top: 0;">
                    <table cellpadding="0" cellspacing="0" style="width:675px">
                        <tr>
                            <td style="width:140px;"><strong style="margin-right: 5px; line-height: 18px;width: 100px;">Master Policy Holder Name: </strong></td>
                            @for($i = 0; $i < 42; $i++)
                                @php ($splttedStrng = str_split('AROHAN FINANCIAL SERVICES LIMITED'))
                                @if(array_key_exists($i, $splttedStrng))
                                    @if($i == 0)
                                        <td style=" margin:0; text-align: center; line-height: 11px; width:12px; height: 15px; border:1px solid #000;">{{$splttedStrng[$i]}}</td>
                                    @else
                                        <td style=" margin:0; text-align: center; line-height: 11px; width:12px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;">{{$splttedStrng[$i]}}</td>
                                    @endif
                                @else
                                   <td style=" margin:0; text-align: center; line-height: 11px; width:12px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;"></td> 
                                @endif
                            @endfor
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid #006cb5; padding: 3px; padding-top: 0 !important;"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 0;">
                <table cellpadding="0" cellspacing="2" style="width:675px">
                    <tr>
                        <td style="width:60px;"><strong style="margin-right: 1px; line-height: 12px;font-size: 6pt; font-wight:bold;">Channel Name: </strong></td>
                        <td style="width:58px;font-size:6pt;">
                            <input type="checkbox" id="RuralBanks" name="RuralBanks" value="RuralBanks" style="width: 12px; height: 12px; border: 1px solid #000;"> Rural Banks                                
                        </td>
                        <td style="width:30px; font-size:6pt;">
                        <span tyle="width: 12px; height: 12px; border: 1px solid #000;">
                            <img src="{{asset('public/images/check.png')}}" alt="logo" style="width: 8px; height:8px;border: 1px solid #000;" >
                        </span>
                         MFI
                        </td>
                        <td style="width:82px; font-size:6pt;">
                            <input type="checkbox" id="RuralBanks" name="CorporateAgents" value="CorporateAgents" style="width: 12px; height: 12px; border: 1px solid #000;"> Corporate Agents
                        </td>
                        <td style="width:85px; font-size:6pt;">
                            <input type="checkbox" id="CorporateDivision" name="CorporateDivision" value="CorporateDivision" style="width: 12px; height: 12px; border: 1px solid #000;"> Corporate Division
                        </td>
                        <td style="width:42px; font-size:6pt;">
                            <input type="checkbox" id="NBPSU" name="NBPSU" value="NBPSU" style="width: 12px; height: 12px; border: 1px solid #000;">NBPSU
                        </td>
                        <td style="width:88px; font-size:6pt;">
                            <input type="checkbox" id="CooperativeBanks" name="CooperativeBanks" value="CooperativeBanks" style="width: 12px; height: 12px; border: 1px solid #000;"> Co-operative Banks
                        </td>
                        <td style="width:70px; font-size:6pt;">
                            <input type="checkbox" id="BrokerNBFC" name="BrokerNBFC" value="BrokerNBFC" style="width: 12px; height: 12px; border: 1px solid #000;"> Broker NBFC
                        </td>
                        <td style="width:55px; font-size:6pt;">
                            <input type="checkbox" id="WebSales" name="WebSales" value="WebSales" style="width: 12px; height: 12px; border: 1px solid #000;"> Web Sales
                        </td>
                        <td style="width:29px; font-size:6pt;">
                            <input type="checkbox" id="BFL" name="BFL" value="BFL" style="width: 12px; height: 12px; border: 1px solid #000;"> BFL
                        </td>
                        <td style="width:45px; font-size:6pt;">
                            <input type="checkbox" id="Others" name="Others" value="Others" style="width: 12px; height: 12px; border: 1px solid #000;"> Others
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:2px 0;">
                    <table cellpadding="0" cellspacing="4" style="width:100%;">
                        <tr>
                            <td valign="middle" style="width:100px;line-height: 15px;font-size: 6pt; font-wight:bold;"><strong >Full Name of Member:</strong></td>
                            <td style="padding-left:4px;padding-right:4px; width:280px; text-align: left; line-height: 15px; height: 15px; border: 1px solid #000; font-size: 6pt;">{{$detailVal->s_cb_customer_salutation}} {{$detailVal->s_cb_customer_name}}</td>
                            <td style="width:10px;"></td>
                            <td valign="middle" style="width:125px;"><strong style="line-height: 15px;font-size: 6pt; font-wight:bold;">Son/Daughter/Spouse of:</strong></td>
                            <td style="padding-left:4px;padding-right:4px; width:240px; text-align: left; line-height: 15px; height: 15px; border: 1px solid #000; font-size: 6pt;">{{($detailVal->s_cb_father_name != '')?$detailVal->s_cb_father_salutation.' '.$detailVal->s_cb_father_name:$detailVal->s_cb_spouse_salutation.' '.$detailVal->s_cb_spouse_name}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:3px;"></td>
                        </tr>
                        <tr>
                            <td valign="middle" style="width:100px;line-height: 15px;font-size: 6pt; font-wight:bold;"><strong >Full Name of Joint Life</strong></td>
                            <td style="padding-left:4px;padding-right:4px; width:280px; text-align: left; line-height: 15px; height: 15px; border: 1px solid #000; font-size: 6pt;">NA</td>
                            <td style="width:10px;"></td>
                            <td valign="middle" style="width:125px;line-height: 15px;font-size: 6pt; font-wight:bold;"><strong>Son/Daughter/Spouse of:</strong></td>
                            <td style="padding-left:4px;padding-right:4px; width:240px; text-align: left; line-height: 15px; height: 15px; border: 1px solid #000; font-size: 6pt;">NA</td>
                        </tr>
                    </table>
                </td>
            </tr>
          
          
            <tr>
                <td colspan="2" valign="middle" style="font-size: 6pt; padding: 3px 0;">
                    (if Applicable):
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px 0 ">
                    <table cellpadding="0" cellspacing="4" style="width:100%;">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="width:190px;">
                                    <tr>
                                        <td style="line-height: 18px;width: 70px;"><strong style="font-size:6pt; font-weight:bold;">Date of Birth:<strong></td>
                                        @php ($dobSplt = str_split(date('dmY',strtotime($detailVal->dt_cb_dob))))
                                        @for($i = 0; $i < 8; $i++)
                                            @if($i == 0)
                                                <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border: 1px solid #000;">{{$dobSplt[$i]}}</td>
                                            @else
                                                <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;">{{$dobSplt[$i]}}</td>
                                            @endif
                                        @endfor
                                    </tr>
                                </table>
                            </td>
                            <td style="width:50px">&nbsp;</td>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="width:132px;">
                                    <tr>
                                        <td style="line-height: 18px;width:20px;font-size:6pt; font-weight:bold;"><strong>Gender:<strong></td>
                                        <td style="width:2px;">&nbsp;</td>
                                        <td style="text-align: center; line-height: 16px; width: 50px; height: 16px; border: 1px solid #000;color:#b2b3b3;font-size:6pt; font-weight:bold;font-family: Arial, Helvetica, sans-serif;"> {!! ($detailVal->s_pi_customer_gender == 'Male')?'<img src="'.asset('public/images/male-check.png').'" alt="logo" style="width: 20px;" >':'Male' !!} </td>
                                        <td style="width:2px;">&nbsp;</td>
                                        <td style="text-align: center; line-height: 16px; width: 56px; height: 16px; border: 1px solid #000;color:#b2b3b3;font-size:6pt; font-weight:bold;font-family: Arial, Helvetica, sans-serif;"> {!! ($detailVal->s_pi_customer_gender == 'Female')?'<img src="'.asset('public/images/female-check.png').'" alt="logo" style="width:25px;" >':'Female' !!}  </td>
                                    </tr>
                                </table>
                            </td>
                            <td align="right">
                                <table width="100%" cellpadding="0" cellspacing="0" style="width:250px;">
                                    <tr>
                                        <td style="line-height: 18px;width: 55px;padding-right:5px;"><strong style="font-size:6pt; font-weight:bold;">Aadhaar Card No:<strong></td>

                                        @php ($strSplt = ($detailVal->i_cb_kyc_type2_id != '' && $detailVal->i_cb_kyc_type2_id == '3')?str_split($detailVal->s_cb_kyc2):[])
                                        @for($i = 0; $i < 12; $i++)
                                            @if(array_key_exists($i, $strSplt))
                                                @if($i == 0)
                                                    <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000;">{{$strSplt[$i]}}</td>
                                                @else
                                                    <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;">{{$strSplt[$i]}}</td>
                                                @endif
                                            @else
                                                <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000;"></td>
                                            @endif
                                        @endfor
                                        
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding:2px;"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="width:190px;">
                                    <tr>
                                        <td style="line-height: 18px;width: 65px;"><strong style="font-size:6pt; font-weight:bold;">Date of Birth:<strong></td>
                                        <td style="line-height: 16px; width: 125px; height: 16px; border: 1px solid #000;text-align: center;"> NA  </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:50px">&nbsp;</td>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="width:140px;">
                                    <tr>
                                        <td style="line-height: 18px;width:39px;font-size:6pt; font-weight:bold;"><strong>Gender:<strong></td>
                                        <td style="text-align: center;line-height: 16px; width: 50px; height: 16px; border: 1px solid #000;"> NA</td>
                                        <td style="width:2px;">&nbsp;</td>
                                        <td style="text-align: center; line-height: 16px; width: 58px; height: 16px; border: 1px solid #000;"> NA</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" >
                                    <tr>
                                        <td style="line-height: 18px;width: 75px;padding-right:5px;font-size:6pt; font-weight:bold;text-align: right;"><strong>Aadhaar Card No:<strong></td>
                                        <td  style=" line-height: 16px; width: 193px; height: 16px; border: 1px solid #000;text-align: center;"> NA </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 6pt;">(JL, if applicable)</td>
                            <td style="width:28px">&nbsp;</td>
                            <td style="font-size: 6pt;">(JL, if applicable)</td>
                            <td style="font-size: 6pt; padding-left:20px;">(JL, if applicable)</td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            <tr>
                <td colspan="2" style="padding:3px 0 5px 0;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">                        
                        <tr>
                            <td style="line-height: 18px;width: 46px;"><strong style="font-size:6pt; font-weight:bold;">Address:<strong></td>
                            <td valign="middle" style="padding: 2px; border-bottom: 1px solid #000;font-size:6pt;">
                                {!! $detailVal->s_cb_permanent_address.', '.$detailVal->s_cb_district.', '.$detailVal->s_cb_state.', '.$detailVal->i_cb_pincode !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px 0;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">                        
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width:200px">
                                    <tr>
                                        <td style="line-height: 18px;width: 30px;"><strong style="font-size:6pt; font-weight:bold;">Mobile no:</strong></td>
                                        @php ($strSplt = ($detailVal->s_customer_mobile_no != '')?str_split($detailVal->s_customer_mobile_no):[])
                                        @for($i = 0; $i < 10; $i++)
                                            @if(array_key_exists($i, $strSplt))
                                                @if($i == 0)
                                                    <td style="color: #000;text-align: center;line-height: 16px;width:15px; height:15px;border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000; float:left;">{{$strSplt[$i]}}</td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px;width:15px; height:15px; border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{$strSplt[$i]}}</td>
                                                @endif
                                            @else
                                                <td style="color: #000; text-align: center; line-height: 16px;width:15px; height:15px; border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;"></td>
                                            @endif
                                        @endfor
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;width:200px">
                                    <tr>
                                        <td style="line-height: 18px;width: 30px;"><strong style="font-size:6pt; font-weight:bold;">Mobile no:</strong></td>
                                        @php ($strSplt = [])
                                        @for($i = 0; $i < 10; $i++)
                                            @if(array_key_exists($i, $strSplt))
                                                @if($i == 0)
                                                    <td style="color: #000;text-align: center;line-height: 16px;width:15px; height:15px;border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000; float:left;">{{$strSplt[$i]}}</td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px;width:15px; height:15px; border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{$strSplt[$i]}}</td>
                                                @endif
                                            @else
                                                @if($i == 0)
                                                    <td style="color: #000;text-align: center;line-height: 16px;width:15px; height:15px;border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000; float:left;"></td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px;width:15px; height:15px; border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;"></td>
                                                @endif
                                            @endif
                                        @endfor
                                    </tr>
                                </table>
                            </td>
                            <td align="right">
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;width:250px">
                                    <tr>
                                        <td style="line-height: 18px;width: 60px;padding-right:5px;"><strong style="font-size:6pt; font-weight:bold;">PAN (If available):</strong></td>
                                        @php ($strSplt = ($detailVal->i_cb_kyc_type2_id != '' && $detailVal->i_cb_kyc_type2_id == '4')?str_split($detailVal->s_cb_kyc2):[])
                                        @for($i = 0; $i < 10; $i++)
                                            @if(array_key_exists($i, $strSplt))
                                                @if($i == 0)
                                                    <td style="color: #000;text-align: center;line-height: 16px;width:15px; height:15px;border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000; float:left;">{{$strSplt[$i]}}</td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px;width:15px; height:15px; border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{$strSplt[$i]}}</td>
                                                @endif
                                            @else
                                                @if($i == 0)
                                                    <td style="color: #000;text-align: center;line-height: 16px;width:15px; height:15px;border-top: 1px solid #000;border-right: 1px solid #000; border-bottom: 1px solid #000; border-left:1px solid #000; float:left;"></td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px;width:15px; height:15px; border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;"></td>
                                                @endif
                                            @endif
                                        @endfor
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#006cb5" style="-webkit-print-color-adjust: exact;font-weight: bold;color: #fff;padding: 2px 0;">Nominee Details (Under Section 39 of Insurance Act 1938)</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 3px;padding-bottom:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                        <tr>
                            <td width="25%" style="padding: 1px; border: 1px solid #000;font-size:6pt;"><strong>Name</strong></td>
                            <td align="left" style="padding: 1px;border: 1px solid #000;font-size:6pt;">{{$detailVal->s_borrower_salutation}} {{$detailVal->s_borrower_name}}</td>
                            <td align="left" style="padding: 1px;border: 1px solid #000; "></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px; border: 1px solid #000;font-size:6pt;"><strong>Date of Birth</strong></td>
                            <td style="padding: 1px; border: 1px solid #000;font-size:6pt;"  align="left">{{date('d/m/Y', strtotime($detailVal->dt_borrower_dob))}}</td>
                            <td style="padding: 1px; border: 1px solid #000;"  align="left"></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px; border: 1px solid #000;font-size:6pt;"><strong>Relationship to Member</strong></td>
                            <td style="padding: 1px; border: 1px solid #000;font-size:6pt;"  align="left">{{ $detailVal->s_borrower_relationship }}</td>
                            <td style="padding: 1px; border: 1px solid #000;"  align="left"></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px; border: 1px solid #000;font-size:6pt;"><strong>% Share of Nomination*</strong></td>
                            <td style="padding: 1px; border: 1px solid #000;font-size:6pt;"  align="left">100%</td>
                            <td style="padding: 1px; border: 1px solid #000;"  align="left"></td>
                        </tr>                        
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 6pt;padding-left: 15px;padding:2px 2px 2px 15px;">*for additional nominees, provide details in separate sheet</td>
            </tr>
            <tr>
                <td colspan="2" valign="middle" style="padding:1px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                        <tr>
                            <td style="line-height: 18px;width: 60px;padding-right:5px;">
                                <strong style="font-size:6pt; font-weight:bold;">Appointee Name: (If nominee is Minor)</strong>
                            </td>
                            <td style="text-align: left; line-height: 15px; width:580px; padding-left:5px; height: 15px; border: 1px solid #000; color: #000;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:3px;padding-bottom:8px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:100px;">
                                    <tr>
                                        <td style="line-height: 18px;width: 75px;"><strong style="font-size:6pt; font-weight:bold;">Appointee’s DOB:<strong></td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border: 1px solid #000; color: #bfbdbd;">D</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">D</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">M</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">M</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">Y</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">Y</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">Y</td>
                                        <td style="margin:0; text-align: center; line-height: 11px; width:15px; height: 15px; border-top:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000; color: #bfbdbd;">Y</td>                                        
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:100px;">
                                    <tr>
                                        <td style="line-height: 18px;width: 110px; padding-left:5px;"><strong style="font-size:6pt; font-weight:bold;">Relationship with Member:<strong></td>
                                        <td style="text-align: left; line-height: 12px; width:130px; padding-left: 1%; height: 12px; border-bottom: 1px solid #000; color: #000;"></td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:100px;">
                                    <tr>
                                        <td style="line-height: 18px;width: 110px;"><strong style="font-size:6pt; font-weight:bold;">Relationship with Nominee:<strong></td>
                                        <td style="text-align: left; line-height: 12px; width:140px; padding-left: 1%; height: 12px; border-bottom: 1px solid #000; color: #000;"></td>
                                    </tr>
                                </table>                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid #006cb5;padding: 3px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table cellpadding="0" cellspacing="0" style="width:100px;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:460px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 48px;"><strong style="font-size:6pt; font-weight:bold;">Sum Assured:<strong></td>
                                        <td style="line-height: 15px; width: 280px; padding-left: 5px; height: 15px; border: 1px solid #000;color: #000;">{{ number_format($detailVal->s_loan_amount, 2, '.', ',') }}</td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:460px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 70px;padding-left:5px;"><strong style="font-size:6pt; font-weight:bold;">Purpose of Loan:<strong></td>
                                        <td style="line-height: 15px; width: 290px; padding-left: 5px; height: 15px; border: 1px solid #000;color: #000;">{{ $detailVal->s_main_loan_purpose }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table cellpadding="0" cellspacing="0" style="width:150px;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:430px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 75px;"><strong style="font-size:6pt; font-weight:bold;">Loan Account no:<strong></td>
                                        <td style="line-height: 15px; width: 260px; padding-left: 5px; height: 15px; border: 1px solid #000;color: #000;">{{$detailVal->s_loan_id}}</td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:460px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 80px;padding-left:5px;"><strong style="font-size:6pt; font-weight:bold;">MPH Branch Name:<strong></td>
                                        <td style="line-height: 15px; width: 300px; padding-left: 5px; height: 15px; border: 1px solid #000;color: #000;">{!! $detailVal->s_branch_name !!} ({{$detailVal->s_branch_code}})</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" style="width:150px">
                                    <tr>
                                        <td style="line-height: 15px;width:55px;"><strong style="margin-right: 5px; line-height: 15px; font-size: 6pt;">Cover Type:</strong></td>
                                        <td style="text-align: center; line-height: 15px;width: 38px; height: 16px; margin-right: 5px; border: 1px solid #000; color: #000; font-size: 6pt;"><img src="{{asset('public/images/lavel.png')}}" alt="lavel" style="width:20px;"></td>
                                        <td style="width:3px;"></td>
                                        <td style="text-align: center; line-height: 15px; width: 50px; height: 16px; border: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Reducing</td>
                                    </tr>
                                </table>                                
                            </td>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" style="width:300px">
                                    <tr>
                                        <td style="line-height: 15px;width:105px; padding-left:15px; font-size: 6pt;"><strong>Rate of Interest: </strong><span style="font-size: 6pt; line-height: 9px;">(For Reducing Cover)</span></td>
                                        <td style="text-align: center; line-height: 15px; width: 98px; height: 15px; border-bottom: 1px solid #000; color: #000; font-size: 6pt;">NA</td>
                                    </tr>
                                </table> 
                            </td>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" style="width:300px">
                                    <tr>
                                        <td style="line-height: 15px;width:100px;padding-left:15px; font-size: 6pt;"><strong>Additional Benefit/Rider/Variant (If any): </strong></td>
                                        <td style="text-align: center; line-height: 15px; width: 90px; height: 15px; border-bottom: 1px solid #000; color: #000; font-size: 6pt;">NA</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:430px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 70px;"><strong style="font-size:6pt; font-weight:bold;">Premium paying Term:<strong></td>
                                        <td style="line-height: 15px; width: 270px; text-align: center; padding-left: 5px; height: 15px; border: 1px solid #000;color: #000;">Single</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table cellpadding="0" cellspacing="0" style="width:430px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 50px;padding-left:5px;"><strong style="font-size:6pt; font-weight:bold;">Cover Term:<strong></td>
                                        <td style="line-height: 15px; width: 290px; text-align: center; padding-left: 5px; height: 15px; border: 1px solid #000;color: #000;">No</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:4px 0;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;width:290px;">
                                    <tr>
                                        <td style="line-height: 15px;width: 90px;"><strong style="float: left; margin-right: 5px; line-height: 18px; font-size: 6pt;">Premium Frequency:</strong></td>
                                        <td style="text-align: center; line-height: 15px; height: 15px; width:40px; padding-left: 3px; padding-right: 3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; color: #bfbdbd; border-left: 1px solid #000;font-size: 6pt;"><img src="{{asset('public/images/Single.png')}}" alt="lavel" style="width:25px;"></td>
                                        <td style="text-align: center; line-height: 15px; height: 15px; width:40px; padding-left: 3px; padding-right: 3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Yearly</td>
                                        <td style="text-align: center; line-height: 15px; height: 15px; width:40px; padding-left: 3px; padding-right: 3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Half-Yearly</td>
                                        <td style="text-align: center; line-height: 15px; height: 15px; width:40px; padding-left: 3px; padding-right: 3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Quarterly</td>
                                        <td style="text-align: center; line-height: 15px; height: 15px; width:40px; padding-left: 3px; padding-right: 3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Monthly</td>
                                    </tr>
                                </table>
                            </td>
                            
                            <td align="left">
                                <table cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                    <tr>
                                        <td style="line-height: 15px;width:90px;"><strong style="line-height: 15px; font-size: 6pt;">Moratorium period:</strong></td>
                                        <td style="text-align: center; line-height: 15px; width: 100px; height: 15px; border: 1px solid #000; color: #000; font-size: 6pt;">NA</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:50px;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#006cb5" style="-webkit-print-color-adjust: exact;font-weight: bold;color: #fff;padding: 2px;">DECLARATION</td>
            </tr>
            
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 12px; padding:5px 0;">
                    I declare that I am of good health and I do not have any physical defect, deformity or disability. I further declare that I do not have any history of, have never suffered from, am not currently suffering from any ailment or disease, nor have I received, nor am I currently receiving, any treatment for any ailment or disease.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height:12px; padding:5px;">
                    I hereby provide my consent in accordance with Aadhaar Act, 2016, and regulations made there under to the Company for (a) collecting, storing and usage (b) validating / authenticating
                        and (c) updating my Aadhaar number.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center; width: 150px; padding: 3px; line-height: 10px; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Signature/Thumb impression <br> of the Member
                            </td>
                            <td style="width:10px;"></td>
                            <td style="text-align: center; width: 150px; padding: 3px; line-height: 10px; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; color: #bfbdbd; font-size: 6pt;"><img src="{{asset('public/images/SignatureThumbImpression.png')}}" alt="SignatureThumbImpression" style="width:110px;"></td>
                            <td style="width:10px;"></td>
                            <td style="text-align: center; width: 150px; padding: 3px; line-height: 10px; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; color: #bfbdbd; font-size: 6pt;"><br>Signature of Witness</td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#006cb5" style="-webkit-print-color-adjust: exact;font-weight: bold;color: #fff; padding: 2px;">AUTHORISATION FOR SETTLEMENT OF CLAIM AMOUNT IN FAVOUR OF MASTER POLICY HOLDER WHO IS A REGULATED ENTITY</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 12px; padding:5px;">
                    In the event of any eventuality giving rise to a claim under the group insurance scheme, the claim proceeds should be utilized to liquidate the outstanding loan availed by me. I authorize
                    MPH to receive the outstanding loan amount of the claim proceeds, from BALIC, which is authorized to make payment directly to and in the name of the MPH to the extent of outstanding
                    loan amount left, if any, may be paid by BALIC to me or my nominee/beneficiary, as the case may be. BALIC shall be discharged to the extent of amount paid to the MPH towards outstanding
                    loan amount. It shall be solely my responsibility to bring to the notice of BALIC, in the event I intend to make a change in my declaration as made herein above. This declaration is applicable
                    when the MPH is a regulated entity or as specified by IRDAI from time to time.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0"  style="border-collapse: collapse;">
                        <tr>
                            <td  style="text-align: center; width: 150px; padding: 3px; line-height: 10px; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; color: #bfbdbd; font-size: 6pt;">Signature/Thumb impression <br>of the Member</td>
                            <td style="width:10px;"></td>
                            <td style="text-align: center; width: 150px; padding: 3px; line-height: 10px; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; color: #bfbdbd; font-size: 6pt;"><img src="{{asset('public/images/SignatureThumbImpression.png')}}" alt="SignatureThumbImpression" style="width:110px;"></td>
                            <td style="width:10px;"></td>
                            <td style="text-align: center; width: 150px; padding: 3px; line-height: 10px; border-left: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; color: #bfbdbd; font-size: 6pt;"><br>Signature of Witness</td> 
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">                        
                        <tr>
                            <td style="line-height: 18px;width: 80px;"><strong style="font-size:6pt; font-weight:bold;">Name & Address:<strong></td>
                            <td valign="middle" style="padding: 1px; border-bottom: 1px solid #000;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">                        
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width:318px;">                        
                                    <tr>
                                        <td style="line-height: 15px;width: 30px;"><strong style="font-size:6pt; font-weight:bold;">Place:<strong></td>
                                        @php ($strSplt = [])
                                        @for($i = 0; $i < 24; $i++)
                                            @if(array_key_exists($i, $strSplt))
                                                @if($i == 0)
                                                    <td style="color: #000; text-align: center; line-height: 16px; width: 12px; height: 15px;border-left: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">{{$strSplt[$i]}}</td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px; width: 12px; height: 15px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">{{$strSplt[$i]}}</td>
                                                @endif
                                            @else
                                                @if($i == 0)
                                                    <td style="color: #000; text-align: center; line-height: 16px; width: 12px; height: 15px;border-left: 1px solid #000; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;"></td>
                                                @else
                                                    <td style="color: #000; text-align: center; line-height: 16px; width: 12px; height: 15px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;"></td>
                                                @endif
                                            @endif
                                        @endfor
                                    </tr>
                                </table>
                            </td>
                            <td style="width:260px;">

                            </td>
                            <td>
                                 <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width:120px;">                        
                                    <tr>
                                        <td style="line-height: 15px;width: 30px;"><strong style="font-size:6pt; font-weight:bold;">Date:<strong></td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000;border-left: 1px solid #000; border-right: 1px solid #000;border-bottom: 1px solid #000;">D</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">D</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">M</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">M</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">Y</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">Y</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">Y</td>
                                        <td style="color: #bfbdbd; text-align: center; line-height: 16px; width: 0.3cm; height: 0.4cm; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;">Y</td>
                                    </tr>
                                </table>
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#006cb5" style="-webkit-print-color-adjust: exact;font-weight: bold;color: #fff;padding: 2px;">VERNACULAR DECLARATION</td>
            </tr>            
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 9px; padding:3px;">
                    If signature of Proposer is in other than English Language.
                </td>
            </tr>            
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 12px; padding:5px;">
                    “ I hereby declare that I have fully explained the above questions to the proposer and I have truthfully recorded the answers given by the proposer.”
                </td>
            </tr>            
            <!-- <tr>
                <td colspan="2" valign="middle" style="padding:3px;font-size: 6pt; line-height: 12px;">
                        Name of the Declaring:____________________________________Signature:__________________________________Address of the Declarant:________________________________________________
                </td>
            </tr> -->
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 9px; padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="4" style="border-collapse: collapse;">
                        <tr>
                            <td style="width:80px;font-size:6pt;">Name of the Declaring:</td>
                            <td style="border-bottom:1px dotted #000; font-size:6pt;width:100px; color:#bfbdbd; width:210px;"></td>
                            <td style="width:35px;font-size:6pt;">Signature:</td>
                            <td style="border-bottom:1px dotted #000; font-size:5.5pt;width:150px; color:#666; text-align:center;"></td>
                            <td style="width:90px;font-size:6pt;">Address of the Declarant:</td>
                            <td style="border-bottom:1px dotted #000; font-size:6pt;width:215px; color:#bfbdbd;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 9px; padding:3px;">
                        In case the Proposer is illiterate, his/her thumb impression should be attested by a person of standing whose identity can easily be established, but unconnected with the insurer and this declaration should be
                        made by him. “I hereby declare that I have fully explained the above questions and contents of the proposal form to the proposer in _________________language, and that the proposer has affixed the thumb
                        impression above after fully understanding the contents thereof.”
                </td>
            </tr>

            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 9px; padding:3px;">
                    <table width="100%" cellpadding="0" cellspacing="4" style="border-collapse: collapse;">
                        <tr>
                            <td style="width:80px;font-size:6pt;">Name of the Declaring:</td>
                            <td style="border-bottom:1px dotted #000; font-size:6pt;width:100px; color:#bfbdbd; width:210px;"></td>
                            <td style="width:35px;font-size:6pt;">Signature:</td>
                            <td style="border-bottom:1px dotted #000; font-size:5.5pt;width:150px; color:#666; text-align:center;">CSR's Signature</td>
                            <td style="width:90px;font-size:6pt;">Address of the Declarant:</td>
                            <td style="border-bottom:1px dotted #000; font-size:6pt;width:215px; color:#bfbdbd;"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:5px 0 3px 0;"></td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid #000; padding:5px 0 3px 0;"></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 12px; padding:5px;">
                        “I certify that the contents of the form and documents have been fully explained to me by (Name, Designation, and occupation) Mr. / Mrs.:______________________________ and I have understood the
                        significance of the proposed contract. &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Signature or thumb impression of the person whose life is proposed to be assured :
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:5px 0 3px 0;"></td>
            </tr>            
            <tr>
                <td colspan="2" style="padding:3px 0;">
                    <table cellpadding="0" cellspacing="0"  style="border-collapse: collapse;">
                        <tr>
                            <td style="width:350px; border-right: 1px solid #000; font-size: 6pt; padding-right:5px;"> 
                                Vernacular declaration__________________________________________________________
                                <br>
                                ____________________________________________________________________________
                            </td>
                            <td style="width:390px; padding-left:5px;">
                                <table cellpadding="0" cellspacing="0"  style="border-collapse: collapse;">
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" style="width:250px;">
                                                <tr>
                                                    <td colspan="4" style="font-size: 6pt; line-height: 9px;">Customer’s Preferred Language</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; line-height: 15px; width:12px; height: 12px; border: 1px solid #000;"></td>
                                                    <td style="padding-right: 2px; padding-left: 1px; line-height: 12px; font-size: 6pt;">English</td>
                                                    <td style="text-align: center; line-height: 15px; width:12px; height: 12px; border: 1px solid #000;"></td>
                                                    <td style="padding-right: 2px; padding-left: 1px; line-height: 12px; font-size: 6pt;"> Other Language _________________</td> 
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" >
                                                <tr>
                                                    <td style="width: 170px;text-align: center; padding: 3px; line-height: 10px; border-left: 1px solid #000;  border-bottom: 1px solid #000; border-right:  1px solid #000; color: #bfbdbd; font-size: 6pt;">Signature or thumb impression</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 6pt; line-height: 9px;" align="right"><!-- 26_6_2018 --></t padding:3px;d>
            </tr>
            </table>
        </article>
    </section>
    </body>
</html>