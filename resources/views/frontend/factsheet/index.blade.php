<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fact sheet</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>

<body>
    <table width="411" border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" height="926" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF">
        <tbody>
            <tr>
                <td align="left" valign="top" style="font-family: Arial; font-size: 18pt" width="363" height="32">
                    <p>Executive Business Brokers</p>
                </td>
                @php
                $previousDate = \Carbon\Carbon::today()->subDay();
                @endphp
                <td valign="top" style="font-family: Arial; font-size: 18pt" width="254" height="32">
                    <p align="right"> Fact sheet&nbsp; <i>
                            <font size="2">as
                                of:&nbsp;{{ $previousDate->format('m-d-Y') }}</font>
                        </i>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-family: Arial; font-size: 8pt; font-weight: bold" width="572" height="22">
                    Mergers
                    &amp; Acquisitions / Business Valuations / Commercial Financing / Investment
                    Property /Consulting</td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-family: Arial; font-size: 10pt" width="572" height="142">
                    <table border="0" width="698" cellspacing="0" cellpadding="0" height="50" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF">
                        <tbody>
                            <tr>
                                <td width="108" style="font-family: Arial; font-size: 10pt" height="16"><b>ID#:</b></td>
                                <td width="206" colspan="3" style="font-family: Arial; font-size: 10pt" height="16">&nbsp;{{$listingData->ListingID}}</td>
                                <td width="38" style="font-family: Arial; font-size: 10pt" height="16"></td>
                                <td width="320" style="font-family: Arial; font-size: 10pt" height="16"></td>
                            </tr>
                            <tr>
                                <td width="108" style="font-family: Arial; font-size: 10pt" height="15">Name of Business:</td>
                                <td width="206" colspan="3" style="font-family: Arial; font-size: 12pt" height="15"><b>&nbsp;{{$listingData->SellerCorpName}}.</b></td>
                                <td width="36" style="font-family: Arial; font-size: 10pt" align="right" height="15"></td>
                                <td width="318" style="font-family: Arial; font-size: 10pt" height="34" rowspan="5"></td>
                            </tr>
                            <tr>
                                <td width="108" style="font-family: Arial; font-size: 10pt" height="19">Address 1:</td>
                                <td width="206" colspan="3" style="font-family: Arial; font-size: 10pt" height="19">&nbsp;{{$listingData->Address1}}.</td>
                                <td width="36" style="font-family: Arial; font-size: 10pt" height="19"></td>
                            </tr>
                            <tr>
                                <td width="108" style="font-family: Arial; font-size: 10pt" height="9">Address 2:</td>
                                <td width="206" colspan="3" style="font-family: Arial; font-size: 10pt" height="9">&nbsp;</td>
                                <td width="36" style="font-family: Arial; font-size: 10pt" height="9"></td>
                            </tr>
                            <tr>
                                <td width="108" style="font-family: Arial; font-size: 10pt" height="3"><b>City:</b></td>
                                <td width="103" style="font-family: Arial; font-size: 10pt" height="3">&nbsp;{{$listingData->City}}</td>
                                <td width="71" style="font-family: Arial; font-size: 10pt" height="3"><b>State:</b></td>
                                <td width="66" style="font-family: Arial; font-size: 10pt" height="3">&nbsp;{{ strtoupper($listingData->State) }}</td>
                            </tr>
                            <tr>
                                <td width="108" style="font-family: Arial; font-size: 10pt" height="1"><b>Zip:</b></td>
                                <td width="103" style="font-family: Arial; font-size: 10pt" height="1">&nbsp;{{$listingData->Zip}}</td>
                                <td width="71" style="font-family: Arial; font-size: 10pt" height="1"><b>County:</b></td>
                                <td width="66" style="font-family: Arial; font-size: 10pt" height="1">&nbsp;{{$listingData->County}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="21" width="363" align="center" bordercolor="#111111" bordercolorlight="#111111" bordercolordark="#111111">
                    <font face="Arial"><b>&nbsp;Business
                            Profile</b></font>
                </td>
                <td height="21" width="314" align="center" bordercolor="#111111" bordercolorlight="#111111" bordercolordark="#111111">
                    <font face="Arial"><b>Income
                            and Expense</b></font>
                </td>

            </tr>


            <tr>
                <td valign="top" width="363" height="571">
                    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="406" id="AutoNumber1" height="429">
                        <tbody>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="20">Business Category:&nbsp; </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="20"><u>{{ $categories[$listingData->BusCategory] ?? 'N/A' }}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="17">
                                    Business Type: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="17"><u>{{ $subCategories[$listingData->SubCat] ?? 'N/A' }}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="16">
                                    Purchase Price: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="16"><u>{{ '$' . number_format($listingData->PurPrice, 2) }}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="17">
                                    Down Payment:&nbsp;&nbsp; </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="17"><u>{{ '$' . number_format($listingData->DownPay, 2) }}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="12">
                                    Balance: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="12"><u>{{ '$' . number_format($listingData->Balance, 2) ?? 0 }}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="14">
                                    Interest Rate: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="14"><u>{{ $listingData->Interest ?? 0}} %</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="17">
                                    Annual Sales: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="17"><u>{{ '$' . number_format($listingData->AnnualSales, 2) }}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="20">
                                    Years Established: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="20"><u>{{ $listingData->YrsEstablished}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="21">
                                    Years Present Owner: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="21"><u>{{ $listingData->YrsPresentOwner}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="22">
                                    Store/Building&nbsp; Size: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="22">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="245" id="AutoNumber2">
                                        <tbody>
                                            <tr>
                                                <td width="120" style="font-family: Arial; font-size: 10pt" valign="bottom"><u>{{ $listingData->BldgSize}}</u></td>
                                                <td width="44" style="font-family: Arial; font-size: 10pt;" valign="bottom">
                                                    Seats</td>
                                                <td width="81" style="font-family: Arial; font-size: 10pt" valign="bottom"><u>{{ $listingData->Seats ?? 0}}</u></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="19">
                                    Employees:&nbsp; </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="19">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="245" id="AutoNumber3" height="11">
                                        <tbody>
                                            <tr>
                                                <td width="61" style="font-family: Arial; font-size: 10pt" valign="bottom" height="11">
                                                    FT</td>
                                                <td width="61" style="font-family: Arial; font-size: 10pt" valign="bottom" align="center" height="11"><u>{{ $listingData->FTEmp ?? 0}}</u></td>
                                                <td width="61" style="font-family: Arial; font-size: 10pt" valign="bottom" height="11">
                                                    PT</td>
                                                <td width="62" style="font-family: Arial; font-size: 10pt" valign="bottom" align="center" height="11"><u>{{ $listingData->PTEmp ?? 0}}</u></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="17">
                                    Annual Payroll: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="17"><u>{{ $listingData->AnnPayroll ?? 0}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="15">
                                    Business Hours: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="15"><u>Mon.- Fri. 8:00 a.m. - 5:00 p.m.</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="9">
                                    Product Mix: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="9"><u>{{ $listingData->Product}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="9">
                                    Lease Terms:&nbsp;&nbsp; </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="9"><u>{{ $listingData->LeaseTerms . ' year'}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="10">
                                    Lease Options:&nbsp;&nbsp; </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="10"><u>{{ $listingData->LeaseOpt . ' year'}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="1">
                                    Real Estate: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="1">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="245" id="AutoNumber3" height="4">
                                        <tbody>
                                            <tr>
                                                <td width="61" style="font-family: Arial; font-size: 10pt" valign="bottom" height="4">
                                                    Included?</td>
                                                <td width="37" style="font-family: Arial; font-size: 10pt" valign="bottom" align="center" height="4"><u>{{ $listingData->RealEstate ? 'Yes' : 'No'}}</u></td>
                                                <td width="107" style="font-family: Arial; font-size: 10pt" valign="bottom" height="4">
                                                    Option to Buy?</td>
                                                <td width="40" style="font-family: Arial; font-size: 10pt" valign="bottom" align="center" height="4"><u>{{ $listingData->ToBuy ? 'Yes' : 'No'}}</u></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="11">
                                    Real Estate Asking Price: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="11"><u>{{$listingData->REAskingPrice ?? 0}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="10">
                                    Inventory Included: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="10"><u>{{$listingData->InvInPrice ?? 0}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="10">
                                    Inventory Not Included: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="10"><u>{{$listingData->InvNot ?? 0}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="14">
                                    Additional Terms: </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="14"><u>{{$listingData->AddTerm}}</u></td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="9">
                                    <b>Highlights:</b>
                                </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="9"><u></u></td>
                            </tr>
                            <tr>
                                <td width="351" style="font-family: Arial; font-size: 10pt" valign="middle" colspan="2" height="47">{!! $listingData->Highlights !!} **PLEASE SEE ATTACHED**</td>
                            </tr>
                            <tr>
                                <td width="196" style="font-family: Arial; font-size: 10pt" valign="middle" height="16">
                                    <b>Listing Agent:</b>
                                </td>
                                <td width="246" style="font-family: Arial; font-size: 10pt" valign="middle" height="16"><b><u>Nat Adornetto</u></b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="235" height="571">
                    <table width="334" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111" height="534">
                        <tbody>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="164" align="right" height="18" colspan="2">
                                    <p align="left">&nbsp;Annual Sales:</p>
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="18"><u>&nbsp;{{ '$' . number_format($listingData->AnnualSales, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="18"></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="164" align="right" height="16" colspan="2">
                                    <p align="left">&nbsp;Cost Of Goods</p>
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"></td>
                            </tr>
                        
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="11" height="16">
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="148" height="16">
                                {{ optional($listingData)->COG1Label ?? 'N/A' }}:
                                </td>
                                @php
                                    $value = $listingData->COG1;
                                    $percentageCOG1 = ($value / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{'$' . number_format( $listingData->COG1, 2) ?? 0}}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageCOG1, 2) }}%</u></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="11" height="16">
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="148" height="16">
                                {{ optional($listingData)->COG2Label ?? 'N/A' }}:
                                </td>
                                @php
                                    $value = $listingData->COG2;
                                    $percentageCOG2 = ($value / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{'$' . number_format($listingData->COG2, 2) ?? 0}}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageCOG2, 2) }}%</u></td>
                            </tr>
                            
                           
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="11" height="16">
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="148" height="16">
                                {{ optional($listingData)->COG3Label ?? 'N/A' }}:
                                </td>
                                @php
                                    $value = $listingData->COG3;
                                    $percentageCOG3 = ($value / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{'$' .(number_format($listingData->COG3, 2)) ?? 0}}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageCOG3, 2) }}%</u></td>
                            </tr>
                           
                            <tr>
                                 @php
                                    $totalCost = $listingData->COG1 + $listingData->COG2 + $listingData->COG3;
                                    $percentageTotalCost = ($totalCost / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="164" align="left" height="16" colspan="2"><b>&nbsp;Total Cost of Sales:</b></td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($totalCost, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageTotalCost, 2) }}%</u></td>
                            </tr>
                            <tr>
                                @php
                                    $totalGOP = $listingData->AnnualSales - $totalCost;
                                    $percentageGrossOperatingProfit = ($totalGOP / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="164" align="left" height="16" colspan="2"><b>&nbsp;Gross
                                        Operating Profit:</b></td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($totalGOP, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageGrossOperatingProfit, 2) }}%</u></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="164" align="right" height="25" valign="bottom" colspan="2">
                                    <p align="left">&nbsp;Operating Expenses:</p>
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="25"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="25"></td>
                            </tr>
                            <tr>
                                @php
                                    $annRent = $listingData->AnnRent;
                                    $percentageAnnRent = ($annRent / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Annual Rent:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($listingData->AnnRent, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageAnnRent, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $commonAreaMaint = $listingData->CommonAreaMaint;
                                    $percentageCommonAreaMaint = ($commonAreaMaint / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">
                                    Common Area Maint.:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($listingData->CommonAreaMaint, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageCommonAreaMaint, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $realEstateTax = $listingData->RealEstateTax;
                                    $percentageRealEstateTax = ($realEstateTax / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Real
                                    Estate Tax:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($listingData->RealEstateTax, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageRealEstateTax, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $annPayroll = $listingData->AnnPayroll;
                                    $percentageAnnPayroll = ($annPayroll / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Annual
                                    Payroll:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($listingData->AnnPayroll, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageAnnPayroll, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $payrollTax = $listingData->PayrollTax;
                                    $percentagePayrollTax = ($payrollTax / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Payroll
                                    Tax:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($listingData->PayrollTax, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentagePayrollTax, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $licFee = $listingData->LicFee;
                                    $percentageLicFee = ($licFee / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">License
                                    Fee:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>&nbsp;{{ '$' . number_format($listingData->LicFee, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>&nbsp;{{ number_format($percentageLicFee, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $advertising = $listingData->Advertising;
                                    $percentageAdvertising = ($advertising / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Advertising:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Advertising, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageAdvertising, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $telephone = $listingData->Telephone;
                                    $percentageTelephone = ($telephone / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Telephone:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Telephone, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageTelephone, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $utilities = $listingData->Utilities;
                                    $percentageUtilities = ($utilities / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Utilities, Gas / Electric:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Utilities, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageUtilities, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $insurance = $listingData->Insurance;
                                    $percentageInsurance = ($insurance / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Insurance:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Insurance, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageInsurance, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $acctLeg = $listingData->AcctLeg;
                                    $percentageAcctLeg = ($acctLeg / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Accounting / Legal:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->AcctLeg, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageAcctLeg, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $maintenance = $listingData->Maintenance;
                                    $percentageMaintenance = ($maintenance / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Maintenance:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Maintenance, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageMaintenance, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $trash = $listingData->Trash;
                                    $percentageTrash = ($trash / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Trash:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Trash, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageTrash, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $other = $listingData->Other;
                                    $percentageOther = ($other / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">Other:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Other, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageOther, 2) }}%</u></td>
                            </tr>
                            @if($listingData->Opt1Label)
                            <tr>
                            @php
                                    $Opt1 = $listingData->Opt1;
                                    $percentageOpt1 = ($Opt1 / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">{{$listingData->Opt1Label}}:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Opt1, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageOpt1, 2) }}%</u></td>
                            </tr>
                            @endif
                            @if($listingData->Opt2Label)
                            <tr>
                            @php
                                    $Opt2 = $listingData->Opt2;
                                    $percentageOpt2 = ($Opt2 / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" align="left" height="16">{{$listingData->Opt2Label}}:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->Opt2, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($percentageOpt2, 2) }}%</u></td>
                            </tr>
                            @endif
                            <tr>
                            @php
                                    $totalOperatingExpenses = $listingData->AnnRent + $listingData->CommonAreaMaint + $listingData->RealEstateTax + $listingData->AnnPayroll + $listingData->PayrollTax + $listingData->LicFee + $listingData->Advertising + $listingData->Telephone + $listingData->Utilities + $listingData->Insurance + $listingData->AcctLeg + $listingData->Maintenance + $listingData->Trash + $listingData->Other + $listingData->Opt1 + $listingData->Opt2;

                                    $totalOperatingPercentage = ($totalOperatingExpenses / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" align="right" height="16" 152"="" width="11"></td>
                                <td style="font-family: Arial; font-size: 10pt" align="left" height="16" 152"="" width="153"><b>
                                        Total Operating Exp.:</b></td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($totalOperatingExpenses, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{ number_format($totalOperatingPercentage, 2) }}%</u></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="164" align="right" height="24" colspan="2">
                                    <p align="left">&nbsp;Recapitulation:</p>
                                </td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="24"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="24"></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" height="16">Annual
                                    Sales</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($listingData->AnnualSales, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" height="16">Cost
                                    Of Sales:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($totalCost, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{number_format($percentageTotalCost, 2) }}%</u></td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" height="16">Operating Expenses:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($totalOperatingExpenses, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{number_format($totalOperatingPercentage, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $totalOperatingProfit = $listingData->AnnualSales - ($totalCost + $totalOperatingExpenses);
                                    $totalOperatingProfitPercentage = ($totalOperatingProfit / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" height="16">Operating Profit:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($totalOperatingProfit, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{number_format($totalOperatingProfitPercentage, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $OtherInc = $listingData->OtherInc;
                                    $percentageOtherInc = ($OtherInc / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="11" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="153" height="16">Other Income:</td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($OtherInc, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{number_format($percentageOtherInc, 2) }}%</u></td>
                            </tr>
                            <tr>
                            @php
                                    $adjCashFlow = $listingData->OtherInc + $totalOperatingProfit;
                                    $percentageAdjCashFlow = ($adjCashFlow / $annualSaleAmount) * 100;
                                @endphp
                                <td style="font-family: Arial; font-size: 10pt" width="13" align="right" height="16"></td>
                                <td style="font-family: Arial; font-size: 10pt" width="137" height="16"><b>Total
                                        Adj.
                                        Cash Flow:</b></td>
                                <td style="font-family: Arial; font-size: 10pt" width="94" align="right" height="16"><u>{{ '$' . number_format($adjCashFlow, 2) }}</u></td>
                                <td style="font-family: Arial; font-size: 10pt" width="70" align="right" height="16"><u>{{number_format($percentageAdjCashFlow, 2) }}%</u></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-family: Arial; font-size: 10pt" width="572" height="133">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
                        <tbody>
                            <tr>
                                <td width="100%" style="font-family: Arial; font-size: 10pt; font-weight: bold" height="16">Footnotes and Legend: ()</td>
                            </tr>
                            <tr>
                                <td width="100%" style="font-family: Arial; font-size: 8pt" height="23">
                                    <p class="MsoNormal">
                                        <span style="font-size:8.5pt;font-family:Verdana;color:black">
                                            Adjusted Cash Flow - A calculation showing the cash flow
                                            generated by the Business for the most recent fiscal or
                                            calendar year, unless otherwise indicated, by adding back to
                                            the net profit those costs that are discretionary to the
                                            Seller, INCLUDING the owner's salary and benefits, or in an
                                            absentee-run business, the Manager's salary and benefits,
                                            non-cash benefits such as depreciation (in most situations)
                                            and amortization, and certain non-recurring or unusual
                                            expenses such as Seller Perks. BUYERS BEWARE Broker has not
                                            audited the books and records and accordingly does not warrant
                                            the accuracy or correctness of information. Purchaser must
                                            conduct his / her own investigation to determine the accuracy
                                            of all business and financial information presented herein.<br>
                                            &nbsp;</span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" align="center" style="font-family: Arial; font-size: 8pt" height="1">
                                    2583 Morris Ave Union, NJ 07083 Phone: (908)851-9040 Fax: (908)851-9066 Email: sales@execbb.com</td>
                            </tr>
                            <tr>
                                <td width="100%" align="center" style="font-family: Arial; font-size: 8pt; font-weight: bold" height="16">
                                    Website:&nbsp;https://www.execbb.com</td>
                            </tr>
                            <tr>
                                <td width="100%" align="center" style="font-family: Arial; font-size: 8pt" height="16">*All information is from sources deemed reliable and is submitted subject to errors, omissions, change of price, rental, prior sale and withdrawal notice.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>