<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fact sheet</title>
    <style>
        body {
            font-family: Arial
        }

        table {
            width: 100%;
        }
    </style>
</head>

<body>
    <table border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolorlight="#FFFFFF"
        bordercolordark="#FFFFFF">
        <tbody>
            <tr>
                <td style="text-align: left;" valign="top" style="font-size: 18pt">
                    <p>Executive Business Brokers</p>
                </td>
                @php
                    $previousDate = \Carbon\Carbon::today()->subDay();
                @endphp
                <td valign="top" style="font-size: 18pt">
                    <p style="text-align: right; font-size: 10pt;">
                        Fact sheet&nbsp;
                        <i>as of:&nbsp;{{ $previousDate->format('m-d-Y') }}</i>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; font-size: 8pt; font-weight: bold">
                    Mergers&amp; Acquisitions / Business Valuations / Commercial Financing / Investment Property
                    /Consulting</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;" style="font-size: 8pt" width="572" height="142">
                    <table border="0" cellspacing="0" cellpadding="0" height="50" bordercolor="#FFFFFF"
                        bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF">
                        <tbody>
                            <tr>
                                <td style="font-size: 8pt"><b>ID#:</b></td>
                                <td colspan="3" style=" font-size: 8pt">&nbsp;{{ $listingData->ListingID }}</td>
                                <td style="font-size: 8pt"></td>
                                <td style="font-size: 8pt"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt">Name of Business:</td>
                                <td colspan="3" style=" font-size: 12pt"><b>&nbsp;{{ $listingData->DBA }}</b></td>
                                <td style="font-size: 8pt; text-align: right;"></td>
                                <td style="font-size: 8pt" height="34" rowspan="5"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt">Address 1:</td>
                                <td colspan="3" style=" font-size: 8pt">&nbsp;{{ $listingData->Address1 }}.</td>
                                <td style="font-size: 8pt"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt">Address 2:</td>
                                <td colspan="3" style=" font-size: 8pt">&nbsp;</td>
                                <td style="font-size: 8pt"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt"><b>City:</b></td>
                                <td style="font-size: 8pt">&nbsp;{{ $listingData->City }}</td>
                                <td style="font-size: 8pt"><b>State:</b></td>
                                <td style="font-size: 8pt">&nbsp;{{ strtoupper($listingData->State) }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt"><b>Zip:</b></td>
                                <td style="font-size: 8pt">&nbsp;{{ $listingData->Zip }}</td>
                                <td style="font-size: 8pt"><b>County:</b></td>
                                <td style="font-size: 8pt">&nbsp;{{ $listingData->County }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; width: 50%;" bordercolor="#111111" bordercolorlight="#111111"
                    bordercolordark="#111111">
                    <span style="font-weight: bold;">&nbsp;Business Profile</span>
                </td>
                <td style="text-align: center; width: 50%;" bordercolor="#111111" bordercolorlight="#111111"
                    bordercolordark="#111111">
                    <span style="font-family: Arial; font-weight: bold;">&nbsp;Income and Expense</span>
                </td>

            </tr>
            <tr>
                <td valign="top" style="width: 50%;">
                    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111"
                        id="AutoNumber1">
                        <tbody>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">Business Category:&nbsp; </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ $categories[$listingData->BusCategory] ?? 'N/A' }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Business Type: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ $subCategories[$listingData->SubCat] ?? 'N/A' }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Purchase Price: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ '$' . number_format((float) $listingData->PurPrice, 2) }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Down Payment:&nbsp;&nbsp; </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ '$' . number_format((float) $listingData->DownPay, 2) }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Balance: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ '$' . number_format((float) $listingData->Balance, 2) ?? 0 }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Interest Rate: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->Interest ?? 0 }} %</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Annual Sales: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ '$' . number_format((float) $listingData->AnnualSales, 2) }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Years Established: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->YrsEstablished }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Years Present Owner: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->YrsPresentOwner }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Store/Building&nbsp; Size: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber2">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 8pt; width:50%;" valign="bottom">
                                                    <u>{{ $listingData->BldgSize }}</u>
                                                </td>
                                                <td style="font-size: 8pt; width:25%;" valign="bottom">
                                                    Seats</td>
                                                <td style="font-size: 8pt; width:25%; text-align: center;"
                                                    valign="bottom">
                                                    <u>{{ $listingData->Seats ?? 0 }}</u>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Employees:&nbsp; </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber3">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 8pt" valign="bottom">
                                                    FT</td>
                                                <td style="font-size: 8pt" valign="bottom"
                                                    style="text-align: center;"><u>{{ $listingData->FTEmp ?? 0 }}</u>
                                                </td>
                                                <td style="font-size: 8pt" valign="bottom">
                                                    PT</td>
                                                <td style="font-size: 8pt" valign="bottom"
                                                    style="text-align: center;"><u>{{ $listingData->PTEmp ?? 0 }}</u>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Annual Payroll: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->AnnPayroll ?? 0 }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Business Hours: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ $listingData->BizHours ?? 'Mon.- Fri. 8:00 a.m. - 5:00 p.m.' }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Product Mix: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->Product }}</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Lease Terms:&nbsp;&nbsp; </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ $listingData->LeaseTerms . ' year' }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Lease Options:&nbsp;&nbsp; </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ $listingData->LeaseOpt . ' year' }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Real Estate: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber3">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 8pt" valign="bottom">
                                                    Included?</td>
                                                <td style="font-size: 8pt" valign="bottom"
                                                    style="text-align: center;">
                                                    <u>{{ $listingData->RealEstate ? 'Yes' : 'No' }}</u>
                                                </td>
                                                <td style="font-size: 8pt" valign="bottom">
                                                    Option to Buy?</td>
                                                <td style="font-size: 8pt" valign="bottom"
                                                    style="text-align: center;">
                                                    <u>{{ $listingData->ToBuy ? 'Yes' : 'No' }}</u>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Real Estate Asking Price: </td>
                                <td style="font-size: 8pt" valign="middle">
                                    <u>{{ $listingData->REAskingPrice ?? 0 }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Inventory Included: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->InvInPrice ?? 0 }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Inventory Not Included: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->InvNot ?? 0 }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    Additional Terms: </td>
                                <td style="font-size: 8pt" valign="middle"><u>{{ $listingData->AddTerm }}</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    <b>Highlights:</b>
                                </td>
                                <td style="font-size: 8pt" valign="middle"><u></u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle" colspan="2" height="47">
                                    {!! $listingData->Highlights !!} **PLEASE SEE ATTACHED**</td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt" valign="middle">
                                    <b>Listing Agent:</b>
                                </td>
                                <td style="font-size: 8pt" valign="middle"><b><u>{{ $fname }}
                                            {{ $lname }}</u></b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="width: 50%;">
                    <div class="income-expence" style="margin-bottom: 10px;">
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse"
                            bordercolor="#111111">
                            <tbody>
                                <tr>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <p style="text-align: left;">&nbsp;Annual Sales:</p>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->AnnualSales, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <p style="text-align: left;">&nbsp;Cost Of Goods</p>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                </tr>

                                <tr>
                                    <td style=" font-size: 8pt">
                                        {{ optional($listingData)->COG1Label ?? 'N/A' }}:
                                    </td>
                                    @php
                                        $value = $listingData->COG1 ?? 0;
                                        $percentageCOG1 =
                                            $annualSaleAmount > 0 ? ($value / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->COG1, 2) ?? 0 }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageCOG1, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td style=" font-size: 8pt">
                                        {{ optional($listingData)->COG2Label ?? 'N/A' }}:
                                    </td>
                                    @php
                                        $value = $listingData->COG2 ?? 0;
                                        $percentageCOG2 =
                                            $annualSaleAmount > 0 ? ($value / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->COG2, 2) ?? 0 }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageCOG2, 2) }}%</u>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="font-size: 8pt">
                                        {{ optional($listingData)->COG3Label ?? 'N/A' }}:
                                    </td>
                                    @php
                                        $value = $listingData->COG3 ?? 0;
                                        $percentageCOG3 =
                                            $annualSaleAmount > 0 ? ($value / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->COG3, 2) ?? 0 }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageCOG3, 2) }}%</u>
                                    </td>
                                </tr>

                                <tr>
                                    @php
                                        $totalCost =
                                            ($listingData->COG1 ?? 0) +
                                            ($listingData->COG2 ?? 0) +
                                            ($listingData->COG3 ?? 0);

                                        $percentageTotalCost =
                                            $annualSaleAmount > 0 ? ($totalCost / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: left;"><b>Total Cost of Sales:</b></td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $totalCost, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageTotalCost, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $totalGOP = ($listingData->AnnualSales ?? 0) - ($totalCost ?? 0);

                                        $percentageGrossOperatingProfit =
                                            $annualSaleAmount > 0 ? ($totalGOP / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: left;"><b>Gross
                                            Operating Profit:</b></td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $totalGOP, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageGrossOperatingProfit, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 8pt; text-align: right;" valign="bottom" colspan="2">
                                        <p style="text-align: left;">&nbsp;Operating Expenses:</p>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                </tr>
                                <tr>
                                    @php
                                        $annRent = $listingData->AnnRent ?? 0;
                                        $percentageAnnRent =
                                            $annualSaleAmount > 0 ? ($annRent / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: left;">Annual Rent:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->AnnRent, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageAnnRent, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $commonAreaMaint = $listingData->CommonAreaMaint ?? 0;
                                        $percentageCommonAreaMaint =
                                            $annualSaleAmount > 0 ? ($commonAreaMaint / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: left;">
                                        Common Area Maint.:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->CommonAreaMaint, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageCommonAreaMaint, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $realEstateTax = $listingData->RealEstateTax ?? 0;
                                        $percentageRealEstateTax =
                                            $annualSaleAmount > 0 ? ($realEstateTax / $annualSaleAmount) * 100 : 0;
                                    @endphp
                                    <td style="font-size: 8pt; text-align: left;">Real
                                        Estate Tax:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->RealEstateTax, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageRealEstateTax, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $annPayroll = $listingData->AnnPayroll ?? 0;
                                        $percentageAnnPayroll =
                                            $annualSaleAmount > 0 ? ($annPayroll / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Annual
                                        Payroll:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->AnnPayroll, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageAnnPayroll, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $payrollTax = $listingData->PayrollTax ?? 0;
                                        $percentagePayrollTax =
                                            $annualSaleAmount > 0 ? ($payrollTax / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Payroll
                                        Tax:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->PayrollTax, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentagePayrollTax, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $licFee = $listingData->LicFee ?? 0;
                                        $percentageLicFee =
                                            $annualSaleAmount > 0 ? ($licFee / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">License
                                        Fee:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ '$' . number_format((float) $listingData->LicFee, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>&nbsp;{{ number_format((float) $percentageLicFee, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $advertising = $listingData->Advertising ?? 0;
                                        $percentageAdvertising =
                                            $annualSaleAmount > 0 ? ($advertising / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Advertising:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Advertising, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageAdvertising, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $telephone = $listingData->Telephone ?? 0;
                                        $percentageTelephone =
                                            $annualSaleAmount > 0 ? ($telephone / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Telephone:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Telephone, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageTelephone, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $utilities = $listingData->Utilities ?? 0;
                                        $percentageUtilities =
                                            $annualSaleAmount > 0 ? ($utilities / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Utilities, Gas / Electric:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Utilities, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageUtilities, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $insurance = $listingData->Insurance ?? 0;
                                        $percentageInsurance =
                                            $annualSaleAmount > 0 ? ($insurance / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Insurance:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Insurance, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageInsurance, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $acctLeg = $listingData->AcctLeg ?? 0;
                                        $percentageAcctLeg =
                                            $annualSaleAmount > 0 ? ($acctLeg / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Accounting / Legal:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->AcctLeg, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageAcctLeg, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $maintenance = $listingData->Maintenance ?? 0;
                                        $percentageMaintenance =
                                            $annualSaleAmount > 0 ? ($maintenance / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Maintenance:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Maintenance, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageMaintenance, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $trash = $listingData->Trash ?? 0;
                                        $percentageTrash =
                                            $annualSaleAmount > 0 ? ($trash / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Trash:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Trash, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageTrash, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $other = $listingData->Other ?? 0;
                                        $percentageOther =
                                            $annualSaleAmount > 0 ? ($other / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;">Other:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->Other, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageOther, 2) }}%</u>
                                    </td>
                                </tr>
                                @if ($listingData->Opt1Label)
                                    <tr>
                                        @php
                                            $Opt1 = $listingData->Opt1 ?? 0;
                                            $percentageOpt1 =
                                                $annualSaleAmount > 0 ? ($Opt1 / $annualSaleAmount) * 100 : 0;
                                        @endphp

                                        <td style="font-size: 8pt; text-align: left;">{{ $listingData->Opt1Label }}:
                                        </td>
                                        <td style="font-size: 8pt; text-align: right;">
                                            <u>{{ '$' . number_format((float) $listingData->Opt1, 2) }}</u>
                                        </td>
                                        <td style="font-size: 8pt; text-align: right;">
                                            <u>{{ number_format((float) $percentageOpt1, 2) }}%</u>
                                        </td>
                                    </tr>
                                @endif
                                @if ($listingData->Opt2Label)
                                    <tr>
                                        @php
                                            $Opt2 = $listingData->Opt2 ?? 0;
                                            $percentageOpt2 =
                                                $annualSaleAmount > 0 ? ($Opt2 / $annualSaleAmount) * 100 : 0;
                                        @endphp

                                        <td style="font-size: 8pt; text-align: left;">{{ $listingData->Opt2Label }}:
                                        </td>
                                        <td style="font-size: 8pt; text-align: right;">
                                            <u>{{ '$' . number_format((float) $listingData->Opt2, 2) }}</u>
                                        </td>
                                        <td style="font-size: 8pt; text-align: right;">
                                            <u>{{ number_format((float) $percentageOpt2, 2) }}%</u>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    @php
                                        $totalOperatingExpenses =
                                            ($listingData->AnnRent ?? 0) +
                                            ($listingData->CommonAreaMaint ?? 0) +
                                            ($listingData->RealEstateTax ?? 0) +
                                            ($listingData->AnnPayroll ?? 0) +
                                            ($listingData->PayrollTax ?? 0) +
                                            ($listingData->LicFee ?? 0) +
                                            ($listingData->Advertising ?? 0) +
                                            ($listingData->Telephone ?? 0) +
                                            ($listingData->Utilities ?? 0) +
                                            ($listingData->Insurance ?? 0) +
                                            ($listingData->AcctLeg ?? 0) +
                                            ($listingData->Maintenance ?? 0) +
                                            ($listingData->Trash ?? 0) +
                                            ($listingData->Other ?? 0) +
                                            ($listingData->Opt1 ?? 0) +
                                            ($listingData->Opt2 ?? 0);

                                        $totalOperatingPercentage =
                                            $annualSaleAmount > 0
                                                ? ($totalOperatingExpenses / $annualSaleAmount) * 100
                                                : 0;
                                    @endphp

                                    <td style="font-size: 8pt; text-align: left;"><b>
                                            Total Operating Exp.:</b></td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $totalOperatingExpenses, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $totalOperatingPercentage, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 8pt; text-align: right;" colspan="2">
                                        <p style="text-align: left;">&nbsp;Recapitulation:</p>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                </tr>
                                <tr>

                                    <td style="font-size: 8pt">Annual
                                        Sales</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $listingData->AnnualSales, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;"></td>
                                </tr>
                                <tr>

                                    <td style="font-size: 8pt">Cost
                                        Of Sales:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $totalCost, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageTotalCost, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>

                                    <td style=" font-size: 8pt">Operating Expenses:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $totalOperatingExpenses, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $totalOperatingPercentage, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $totalOperatingProfit =
                                            ($listingData->AnnualSales ?? 0) - ($totalCost + $totalOperatingExpenses);
                                        $totalOperatingProfitPercentage =
                                            $annualSaleAmount > 0
                                                ? ($totalOperatingProfit / $annualSaleAmount) * 100
                                                : 0;
                                    @endphp

                                    <td style="font-size: 8pt">Operating Profit:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $totalOperatingProfit, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $totalOperatingProfitPercentage, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $OtherInc = $listingData->OtherInc ?? 0;
                                        $percentageOtherInc =
                                            $annualSaleAmount > 0 ? ($OtherInc / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt">Other Income:</td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $OtherInc, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageOtherInc, 2) }}%</u>
                                    </td>
                                </tr>
                                <tr style="margin-botton: 10px;">
                                    @php
                                        $adjCashFlow = ($listingData->OtherInc ?? 0) + $totalOperatingProfit;
                                        $percentageAdjCashFlow =
                                            $annualSaleAmount > 0 ? ($adjCashFlow / $annualSaleAmount) * 100 : 0;
                                    @endphp

                                    <td style="font-size: 8pt"><b>Total Adj. Cash Flow:</b></td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ '$' . number_format((float) $adjCashFlow, 2) }}</u>
                                    </td>
                                    <td style="font-size: 8pt; text-align: right;">
                                        <u>{{ number_format((float) $percentageAdjCashFlow, 2) }}%</u>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>


            <tr>
                <td colspan="2" style="text-align: center;" style="font-size: 8pt">
                    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse"
                        bordercolor="#111111">
                        <tbody>
                            <tr>
                                <td width="100%" style="font-size: 8pt; font-weight: bold">Footnotes and Legend: ()
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" style="font-size: 8pt">
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
                                <td style="text-align: center; font-size: 8pt">
                                    2583 Morris Ave Union, NJ 07083 Phone: (908)851-9040 Fax: (908)851-9066 Email:
                                    sales@execbb.com</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 8pt; font-weight: bold">
                                    Website:&nbsp;https://www.execbb.com</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 8pt">*All information is from sources deemed
                                    reliable and is submitted subject to errors, omissions, change of price, rental,
                                    prior sale and withdrawal notice.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
