<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        Offer #{{ $offer->OfferID }} - Print
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #eeeeee;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        .print-wrapper {
            max-width: 900px;
            margin: 25px auto;
        }

        .print-actions {
            text-align: right;
            margin-bottom: 15px;
        }

        .print-actions button {
            border: 0;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            margin-left: 5px;
        }

        .btn-print {
            background: #222;
            color: #fff;
        }

        .btn-close {
            background: #777;
            color: #fff;
        }

        .offer-paper {
            background: #fff;
            padding: 35px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .12);
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .offer-header {
            border-bottom: 3px solid #c99a24;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company-title {
            font-size: 25px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
        }

        .document-title {
            font-size: 17px;
            color: #777;
        }

        .offer-number {
            text-align: right;
            font-size: 14px;
        }

        .offer-number strong {
            font-size: 18px;
            color: #b18212;
        }

        .printed-date {
            margin-top: 5px;
            color: #888;
            font-size: 11px;
        }

        /*
        |--------------------------------------------------------------------------
        | Section
        |--------------------------------------------------------------------------
        */

        .section {
            margin-bottom: 25px;
            page-break-inside: auto;
        }

        .section-title {
            background: #f4f4f4;
            border-left: 5px solid #c99a24;
            padding: 10px 12px;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #333;
        }

        .sub-title {
            font-size: 14px;
            font-weight: 700;
            color: #555;
            border-bottom: 1px solid #ddd;
            padding-bottom: 6px;
            margin: 18px 0 10px;
        }

        /*
        |--------------------------------------------------------------------------
        | Information Grid
        |--------------------------------------------------------------------------
        */

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-top: 1px solid #ddd;
            border-left: 1px solid #ddd;
        }

        .info-item {
            display: grid;
            grid-template-columns: 42% 58%;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            min-height: 35px;
        }

        .info-label {
            background: #fafafa;
            padding: 8px;
            font-weight: 600;
        }

        .info-value {
            padding: 8px;
            word-break: break-word;
        }

        /*
        |--------------------------------------------------------------------------
        | Full Width
        |--------------------------------------------------------------------------
        */

        .full-width {
            grid-column: 1 / -1;
        }

        /*
        |--------------------------------------------------------------------------
        | Three Column Offer Tables
        |--------------------------------------------------------------------------
        */

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .comparison-table th,
        .comparison-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .comparison-table th {
            background: #f4f4f4;
            font-weight: 700;
        }

        .comparison-table .label-column {
            width: 34%;
            font-weight: 600;
            background: #fafafa;
        }

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-accepted {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-closed {
            background: #cfe2ff;
            color: #084298;
        }

        .status-dead {
            background: #f8d7da;
            color: #842029;
        }

        /*
        |--------------------------------------------------------------------------
        | Checkbox / Yes No
        |--------------------------------------------------------------------------
        */

        .yes {
            color: #198754;
            font-weight: 700;
        }

        .no {
            color: #dc3545;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | Comments
        |--------------------------------------------------------------------------
        */

        .text-box {
            border: 1px solid #ddd;
            padding: 12px;
            min-height: 70px;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /*
        |--------------------------------------------------------------------------
        | Footer
        |--------------------------------------------------------------------------
        */

        .print-footer {
            margin-top: 35px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            color: #888;
            font-size: 10px;
            text-align: center;
        }

        /*
        |--------------------------------------------------------------------------
        | Print
        |--------------------------------------------------------------------------
        */

        @media print {

            body {
                background: #fff;
                font-size: 11px;
            }

            .print-wrapper {
                width: 100%;
                max-width: none;
                margin: 0;
            }

            .print-actions {
                display: none !important;
            }

            .offer-paper {
                box-shadow: none;
                padding: 0;
            }

            .section {
                break-inside: auto;
            }

            .section-title {
                break-after: avoid;
            }

            .info-item {
                break-inside: avoid;
            }

            .comparison-table {
                break-inside: auto;
            }

            .comparison-table tr {
                break-inside: avoid;
            }

            @page {
                size: Letter;
                margin: 0.45in;
            }

            a {
                color: inherit;
                text-decoration: none;
            }
        }
    </style>

</head>

<body>

    <div class="print-wrapper">

        {{-- ========================================================= --}}
        {{-- PRINT BUTTONS --}}
        {{-- ========================================================= --}}

        <div class="print-actions">

            <button type="button" class="btn-print" onclick="window.print()">
                🖨 Print Offer
            </button>

            <button type="button" class="btn-close" onclick="window.close()">
                Close
            </button>

        </div>


        <div class="offer-paper">


            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="offer-header">

                <div class="header-top">

                    <div>

                        <div class="company-title">
                            {{ $listing->CorpName ?? ($listing->DBA ?? 'Business Offer') }}
                        </div>

                        <div class="document-title">
                            OFFER RECORD
                        </div>

                    </div>

                    <div class="offer-number">

                        Offer ID<br>

                        <strong>
                            #{{ $offer->OfferID }}
                        </strong>

                        <div class="printed-date">
                            Printed:
                            {{ now()->format('m/d/Y h:i A') }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- GENERAL INFORMATION --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    General Information
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Offer ID
                        </div>

                        <div class="info-value">
                            {{ $offer->OfferID }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Status
                        </div>

                        <div class="info-value">

                            @php
                                $statusClass = match ($offer->Status) {
                                    'Accepted' => 'status-accepted',
                                    'Closed' => 'status-closed',
                                    'Dead' => 'status-dead',
                                    default => 'status-pending',
                                };
                            @endphp

                            <span class="status {{ $statusClass }}">
                                {{ $offer->Status ?: '-' }}
                            </span>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Company
                        </div>

                        <div class="info-value">
                            {{ $listing->CorpName ?? ($listing->DBA ?? '-') }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Buyer
                        </div>

                        <div class="info-value">

                            @if ($buyer)
                                {{ trim(($buyer->FName ?? '') . ' ' . ($buyer->LName ?? '')) }}
                            @else
                                -
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Listing Agent
                        </div>

                        <div class="info-value">

                            @if ($listingAgent)
                                {{ trim(($listingAgent->FName ?? '') . ' ' . ($listingAgent->LName ?? '')) }}
                            @else
                                -
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Selling Agent
                        </div>

                        <div class="info-value">

                            @if ($sellingAgent)
                                {{ trim(($sellingAgent->FName ?? '') . ' ' . ($sellingAgent->LName ?? '')) }}
                            @else
                                -
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Date of Offer
                        </div>

                        <div class="info-value">
                            {{ $offer->DateOfOffer ?: '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Exp. Date
                        </div>

                        <div class="info-value">
                            {{ $offer->ExpDate ?: '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Acceptance Date
                        </div>

                        <div class="info-value">
                            {{ $offer->AccDate ?: '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Close Date
                        </div>

                        <div class="info-value">
                            {{ $offer->ClosingDate ?: '-' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FINANCIAL INFORMATION --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Financial Information
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Purchase Price
                        </div>

                        <div class="info-value">
                            {{ $offer->PurchasePrice !== null ? '$' . number_format((float) $offer->PurchasePrice, 2) : '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Down Payment
                        </div>

                        <div class="info-value">
                            {{ $offer->DownPaymnt !== null ? '$' . number_format((float) $offer->DownPaymnt, 2) : '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Commission
                        </div>

                        <div class="info-value">
                            {{ $offer->Commission !== null ? '$' . number_format((float) $offer->Commission, 2) : '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Commission %
                        </div>

                        <div class="info-value">
                            {{ $offer->CommissionPct !== null ? $offer->CommissionPct . '%' : '-' }}
                        </div>

                    </div>


                    <div class="info-item full-width">

                        <div class="info-label">
                            Balance Due
                        </div>

                        <div class="info-value">
                            {{ $offer->BalanceDue !== null ? '$' . number_format((float) $offer->BalanceDue, 2) : '-' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- OFFER / COUNTER / ACCEPTED --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Offer / Counter Offer / Accepted Offer
                </div>


                <table class="comparison-table">

                    <thead>

                        <tr>

                            <th class="label-column">
                                Field
                            </th>

                            <th>
                                Offer
                            </th>

                            <th>
                                Counter Offer
                            </th>

                            <th>
                                Accepted Offer
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td class="label-column">Price</td>

                            <td>{{ $offer->OfferPrice ?? '-' }}</td>

                            <td>{{ $offer->COfferPrice ?? '-' }}</td>

                            <td>{{ $offer->AccPrice ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Deposit</td>

                            <td>{{ $offer->OffDeposit ?? '-' }}</td>

                            <td>{{ $offer->COffDeposit ?? '-' }}</td>

                            <td>{{ $offer->AccDeposit ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Additional Deposit</td>

                            <td>{{ $offer->OffAddlDep ?? '-' }}</td>

                            <td>{{ $offer->COffAddlDep ?? '-' }}</td>

                            <td>{{ $offer->AccAddlDep ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Down Pay Bal.</td>

                            <td>{{ $offer->OffBalDownPay ?? '-' }}</td>

                            <td>{{ $offer->COffBalDownPay ?? '-' }}</td>

                            <td>{{ $offer->AccBalDownPay ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Down Pay Bal. 2</td>

                            <td>{{ $offer->OffDownPay ?? '-' }}</td>

                            <td>{{ $offer->COffDownPay ?? '-' }}</td>

                            <td>{{ $offer->AccDownPay ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Total Down Pay Bal.</td>

                            <td>
                                {{ ($offer->OffBalDownPay ?? 0) + ($offer->OffDownPay ?? 0) ?: '-' }}
                            </td>

                            <td>
                                {{ ($offer->COffBalDownPay ?? 0) + ($offer->COffDownPay ?? 0) ?: '-' }}
                            </td>

                            <td>
                                {{ ($offer->AccBalDownPay ?? 0) + ($offer->AccDownPay ?? 0) ?: '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label-column">Assumption</td>

                            <td>{{ $offer->OffAssump ?? '-' }}</td>

                            <td>{{ $offer->COffAssump ?? '-' }}</td>

                            <td>{{ $offer->AccAssump ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Additional Assumption</td>

                            <td>{{ $offer->OffAssump2 ?? '-' }}</td>

                            <td>{{ $offer->COffAssump2 ?? '-' }}</td>

                            <td>{{ $offer->AccAssump2 ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Balance Due</td>

                            <td>{{ $offer->OffBalDue ?? '-' }}</td>

                            <td>{{ $offer->COffBalDue ?? '-' }}</td>

                            <td>{{ $offer->AccBalDue ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Per Month</td>

                            <td>{{ $offer->OffPerMonth ?? '-' }}</td>

                            <td>{{ $offer->COffPerMonth ?? '-' }}</td>

                            <td>{{ $offer->AccPerMonth ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Interest</td>

                            <td>{{ $offer->OffInterest ?? '-' }}</td>

                            <td>{{ $offer->COffInterest ?? '-' }}</td>

                            <td>{{ $offer->AccInt ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Additional Terms</td>

                            <td>{{ $offer->OffAddTerms ?? '-' }}</td>

                            <td>{{ $offer->COffAddTerms ?? '-' }}</td>

                            <td>{{ $offer->AccAddTerm ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Inventory</td>

                            <td>{{ $offer->OffInvInc ?? '-' }}</td>

                            <td>{{ $offer->COffInvInc ?? '-' }}</td>

                            <td>{{ $offer->AccInvInc ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-column">Max. Inventory</td>

                            <td>{{ $offer->OffMaxInv ?? '-' }}</td>

                            <td>{{ $offer->COffMaxInv ?? '-' }}</td>

                            <td>{{ $offer->AccMaxInv ?? '-' }}</td>
                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- ========================================================= --}}
            {{-- ESCROW --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Escrow Information
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Real Estate Transaction
                        </div>

                        <div class="info-value">

                            @if ($offer->RealEstateTrans)
                                <span class="yes">Yes</span>
                            @else
                                <span class="no">No</span>
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Deposit Check
                        </div>

                        <div class="info-value">
                            {{ $offer->DepositCheckNumber ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Bank
                        </div>

                        <div class="info-value">
                            {{ $offer->BankDraw ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Date Deposited
                        </div>

                        <div class="info-value">
                            {{ $offer->DateDeposited ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Name on Check
                        </div>

                        <div class="info-value">
                            {{ $offer->NameOnCheck ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Check on Hold
                        </div>

                        <div class="info-value">

                            @if ($offer->CheckOnHold)
                                <span class="yes">Yes</span>
                            @else
                                <span class="no">No</span>
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Bounced
                        </div>

                        <div class="info-value">

                            @if ($offer->Bounced)
                                <span class="yes">Yes</span>
                            @else
                                <span class="no">No</span>
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Bounce Reason
                        </div>

                        <div class="info-value">
                            {{ $offer->BounceReason ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Amount
                        </div>

                        <div class="info-value">
                            {{ $offer->CheckAmt ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Date Returned
                        </div>

                        <div class="info-value">
                            {{ $offer->CheckReturned ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Return Check
                        </div>

                        <div class="info-value">
                            {{ $offer->CheckEBBReturnNumber ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Check Returned To
                        </div>

                        <div class="info-value">
                            {{ $offer->CheckReturnedTo ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Relationship
                        </div>

                        <div class="info-value">
                            {{ $offer->ReturneeRelationship ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ESCROW ATTORNEY --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Escrow Attorney
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Escrow Attorney
                        </div>

                        <div class="info-value">

                            @if ($offer->escrow_attorney)
                                <span class="yes">Yes</span>
                            @else
                                <span class="no">No</span>
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Attorney
                        </div>

                        <div class="info-value">

                            @if ($escrowAttorney)
                                {{ trim(($escrowAttorney->FName ?? '') . ' ' . ($escrowAttorney->LName ?? '')) }}
                            @else
                                -
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Address
                        </div>

                        <div class="info-value">
                            {{ $offer->ReturneeAddress ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            City
                        </div>

                        <div class="info-value">
                            {{ $offer->ReturneeCity ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            State
                        </div>

                        <div class="info-value">
                            {{ $offer->ReturneeState ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Zip
                        </div>

                        <div class="info-value">
                            {{ $offer->ReturneeZip ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Phone
                        </div>

                        <div class="info-value">
                            {{ $offer->ReturneePhone ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- CONTACTS --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Contacts
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Buyer Attorney
                        </div>

                        <div class="info-value">
                            {{ $offer->BuyerAttorney ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Seller Attorney
                        </div>

                        <div class="info-value">
                            {{ $offer->SellerAttorney ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Buyer Accountant
                        </div>

                        <div class="info-value">
                            {{ $offer->BuyerAccountant ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Seller Accountant
                        </div>

                        <div class="info-value">
                            {{ $offer->SellerAccountant ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Landlord
                        </div>

                        <div class="info-value">
                            {{ $offer->Landlord ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Referral
                        </div>

                        <div class="info-value">
                            {{ $offer->Referral ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Referral Fee Paid
                        </div>

                        <div class="info-value">
                            {{ $offer->ReferralFeePaid ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Scheduled Closed Date
                        </div>

                        <div class="info-value">
                            {{ $offer->SchedCloseDate ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Scheduled Close Time
                        </div>

                        <div class="info-value">
                            {{ $offer->SchedCloseTime ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Attorney Letters
                        </div>

                        <div class="info-value">
                            {{ $offer->AttorneyLetters ?? '-' }}
                        </div>

                    </div>


                    <div class="info-item full-width">

                        <div class="info-label">
                            Closing Anticipation Letters Sent
                        </div>

                        <div class="info-value">
                            {{ $offer->AnticipationLetters ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- PROPERTY --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Property
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Real Estate Included
                        </div>

                        <div class="info-value">

                            @if ($offer->RealEstateInc)
                                <span class="yes">Yes</span>
                            @else
                                <span class="no">No</span>
                            @endif

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Option to Buy
                        </div>

                        <div class="info-value">

                            @if ($offer->OpToBuy)
                                <span class="yes">Yes</span>
                            @else
                                <span class="no">No</span>
                            @endif

                        </div>

                    </div>

                </div>


                {{-- Real Estate --}}

                <div class="sub-title">
                    Real Estate
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Price
                        </div>

                        <div class="info-value">
                            {{ $offer->REPrice ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Terms
                        </div>

                        <div class="info-value">
                            {{ $offer->RETerms ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Down Payment
                        </div>

                        <div class="info-value">
                            {{ $offer->REDownPay ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Balance
                        </div>

                        <div class="info-value">
                            {{ $offer->REBal ?? '-' }}
                        </div>

                    </div>

                </div>


                {{-- Option to Buy --}}

                <div class="sub-title">
                    Option to Buy
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Price
                        </div>

                        <div class="info-value">
                            {{ $offer->OpPrice ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Terms
                        </div>

                        <div class="info-value">
                            {{ $offer->OpTerms ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Down Payment
                        </div>

                        <div class="info-value">
                            {{ $offer->OpDownPay ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Balance
                        </div>

                        <div class="info-value">
                            {{ $offer->OpBal ?? '-' }}
                        </div>

                    </div>

                </div>


                {{-- Lease --}}

                <div class="sub-title">
                    Lease Terms
                </div>

                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Lease Terms
                        </div>

                        <div class="info-value">
                            {{ $offer->LeaseTerm ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Option Years
                        </div>

                        <div class="info-value">
                            {{ $offer->LeaseNoYears ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Doi Month
                        </div>

                        <div class="info-value">
                            {{ $offer->LeaseDolMonth ?? '-' }}
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-label">
                            Options
                        </div>

                        <div class="info-value">
                            {{ $offer->LeaseOptions ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- COMMENTS --}}
            {{-- ========================================================= --}}

            <div class="section">

                <div class="section-title">
                    Comments & Contingencies
                </div>


                <div class="sub-title">
                    Contingencies
                </div>

                <div class="text-box">
                    {{ $offer->Contingencies ?: '-' }}
                </div>


                <div class="sub-title">
                    Comments
                </div>

                <div class="text-box">
                    {{ $offer->Comments ?: '-' }}
                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FOOTER --}}
            {{-- ========================================================= --}}

            <div class="print-footer">

                Offer #{{ $offer->OfferID }}

                &nbsp; | &nbsp;

                Generated on {{ now()->format('m/d/Y h:i A') }}

            </div>


        </div>

    </div>


    <script>
        /*
         * Automatically open browser print preview.
         *
         * Small timeout allows the complete page to render
         * before the browser opens the print dialog.
         */

        window.addEventListener('load', function() {

            setTimeout(function() {

                window.print();

            }, 500);

        });
    </script>

</body>

</html>
