<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Business Listing #{{ $listing->ListingID }} |
        Executive Business Brokers
    </title>

    <style>
        :root {
            --primary: #7F2149;
            --gold: #806132;
            --light: #f8f3f5;
            --text: #252525;
            --border: #dddddd;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            background: #eceef1;
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }

        /* Print actions */

        .print-toolbar {
            max-width: 850px;
            margin: 0 auto 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .print-btn {
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 11px 24px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .close-btn {
            background: #ffffff;
            color: #333333;
            border: 1px solid #cccccc;
            padding: 11px 24px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        /* Main document */

        .print-document {
            max-width: 850px;
            margin: 0 auto;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* Company header */

        .document-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--gold);
            margin-bottom: 20px;
        }

        .company-name {
            color: var(--primary);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin: 0;
        }

        .document-subtitle {
            color: var(--gold);
            font-size: 11px;
            letter-spacing: 2px;
            font-weight: 600;
            margin-top: 5px;
            text-transform: uppercase;
        }

        .listing-reference {
            text-align: right;
            padding-left: 15px;
            flex-shrink: 0;
        }

        .listing-reference small {
            display: block;
            color: #777777;
            font-size: 11px;
            text-transform: uppercase;
        }

        .listing-reference strong {
            font-size: 19px;
            color: var(--primary);
        }

        /* Listing heading */

        .listing-heading {
            margin-bottom: 15px;
        }

        .listing-heading h1 {
            color: var(--primary);
            font-size: 27px;
            margin: 0 0 4px;
            line-height: 1.3;
        }

        .listing-location {
            color: var(--gold);
            font-size: 14px;
            font-weight: 600;
            margin: 0;
        }

        .listing-category {
            color: #666666;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Listing image */

        .listing-image {
            width: 100%;
            height: 260px;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f8f8;
            border: 1px solid #e5e5e5;
        }

        .listing-image img {
            display: block;
            width: 100%;
            height: 100%;
            max-height: none;
            object-fit: cover;
            object-position: center;
        }

        /* Financial highlights */

        .financial-highlights {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .highlight-card {
            background: var(--light);
            border-top: 3px solid var(--primary);
            padding: 14px 10px;
            text-align: center;
        }

        .highlight-card span {
            display: block;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: #666666;
        }

        .highlight-card strong {
            display: block;
            color: var(--primary);
            font-size: 23px;
            line-height: 1.3;
            margin-top: 5px;
            overflow-wrap: anywhere;
        }

        /* Information sections */

        .information-section {
            margin-bottom: 17px;
        }

        .section-title {
            margin: 0;
            padding: 9px 12px;
            background: var(--primary);
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .overview-content {
            padding: 13px;
            border: 1px solid var(--border);
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        /* Details table */

        .details-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .details-table td {
            padding: 8px 12px;
            border: 1px solid var(--border);
            vertical-align: top;
            overflow-wrap: anywhere;
        }

        .details-table td:first-child {
            width: 48%;
            color: #555555;
            font-weight: 500;
        }

        .details-table td:last-child {
            text-align: right;
            color: #222222;
            font-weight: 600;
        }

        .details-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        /* Document footer */

        .document-footer {
            border-top: 2px solid var(--gold);
            margin-top: 20px;
            padding-top: 12px;
            text-align: center;
        }

        .footer-company {
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
        }

        .footer-information {
            color: #777777;
            font-size: 10px;
            margin-top: 5px;
        }

        .disclaimer {
            font-size: 10px;
            color: #777777;
            line-height: 1.5;
            margin-top: 8px;
        }

        /* Mobile preview */

        @media screen and (max-width: 600px) {

            body {
                padding: 10px;
            }

            .print-document {
                padding: 15px;
            }

            .company-name {
                font-size: 17px;
            }

            .listing-heading h1 {
                font-size: 22px;
            }

            .financial-highlights {
                gap: 5px;
            }

            .highlight-card {
                padding: 10px 5px;
            }

            .highlight-card strong {
                font-size: 15px;
            }
        }

        /* Print page configuration */

        @page {
            size: Letter portrait;
            margin: 12mm;
        }

        @media print {

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            html,
            body {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                font-size: 11px;
            }

            .print-toolbar {
                display: none !important;
            }

            .print-document {
                width: 100%;
                max-width: none;
                padding: 0;
                margin: 0;
                box-shadow: none;
            }

            .document-header {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .listing-image {
                height: 220px;
                margin-bottom: 15px;
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .listing-image img {
                width: 100%;
                height: 100%;
                max-height: none;
                object-fit: cover;
                object-position: center;
            }

            .financial-highlights {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .section-title {
                break-after: avoid;
                page-break-after: avoid;
            }

            .details-table tr {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .document-footer {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .company-name {
                font-size: 20px;
            }

            .listing-heading h1 {
                font-size: 24px;
            }

            .highlight-card strong {
                font-size: 20px;
            }

            .details-table td {
                padding: 6px 10px;
            }

            .information-section {
                margin-bottom: 12px;
            }

        }
    </style>

</head>

<body>

    @php

        // Currency formatting.
        $money = function ($value) {
            return is_numeric($value) ? '$' . number_format((float) $value, 0) : 'N/A';
        };

        // Display missing text values.
        $displayValue = function ($value) {
            return $value === null || trim((string) $value) === '' ? 'N/A' : $value;
        };

        // Cost of goods.
        $totalCost = (float) ($listing->COG1 ?? 0) + (float) ($listing->COG2 ?? 0) + (float) ($listing->COG3 ?? 0);

        // Operating expenses.
        $totalOperatingExpenses =
            (float) ($listing->AnnRent ?? 0) +
            (float) ($listing->CommonAreaMaint ?? 0) +
            (float) ($listing->RealEstateTax ?? 0) +
            (float) ($listing->AnnPayroll ?? 0) +
            (float) ($listing->PayrollTax ?? 0) +
            (float) ($listing->LicFee ?? 0) +
            (float) ($listing->Advertising ?? 0) +
            (float) ($listing->Telephone ?? 0) +
            (float) ($listing->Utilities ?? 0) +
            (float) ($listing->Insurance ?? 0) +
            (float) ($listing->AcctLeg ?? 0) +
            (float) ($listing->Maintenance ?? 0) +
            (float) ($listing->Trash ?? 0) +
            (float) ($listing->Other ?? 0) +
            (float) ($listing->Opt1 ?? 0) +
            (float) ($listing->Opt2 ?? 0);

        // Calculate operating profit.
        $totalOperatingProfit = (float) ($listing->AnnualSales ?? 0) - ($totalCost + $totalOperatingExpenses);

        // Calculate cash flow.
        $cashFlow = (float) ($listing->OtherInc ?? 0) + $totalOperatingProfit;

        // Listing image.
        $imageUrl = !empty($listing->imagepath)
            ? asset('assets/uploads/images/' . $listing->imagepath)
            : asset('assets/images/business_image.jpg');
        // Convert HTML overview into safe printable text.
        $overview = html_entity_decode((string) ($listing->Highlights ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $overview = preg_replace('~\x3Cbr\s*/?\x3E|\x3C/(?:p|div|li|h[1-6])\x3E~i', "\n", $overview);

        $overview = trim(strip_tags($overview));

        // Business information.
        $businessInfo = [
            'Building Size' => $displayValue($listing->BldgSize),

            'Parking' => $displayValue($listing->Parking),

            'License Required' => $displayValue($listing->LicenseReq),

            'Base Monthly Rent' => $money($listing->BaseMonthRent),

            'Hours of Operation' => $displayValue($listing->HoursOfOp),
        ];

        // Pricing information.
        $pricingInfo = [
            'Listing Type' => !empty($listing->ListType) ? getListingTypeName($listing->ListType) : 'N/A',

            'List Price' => $money($listing->ListPrice),

            'Purchase Price' => $money($listing->PurPrice),

            'Down Payment' => $money($listing->DownPay),
        ];

        // Financial information.
        $financialInfo = [
            'Annual Sales' => $money($listing->AnnualSales),

            'Gross Profit' => $money($listing->GrossProfit),

            'Total Expenses' => $money($listing->TotalExpenses),

            'Operating Profit' => $money($totalOperatingProfit),

            'Annual Net Profit' => $money($listing->AnnualNetProfit),
        ];
    @endphp

    <!-- Print actions -->
    <div class="print-toolbar">

        <button type="button" class="close-btn"
            onclick="window.location.href='{{ route('view.business.listing', $listing->ListingID) }}'">

            Back to Listing

        </button>

        <button type="button" class="print-btn" onclick="window.print()">

            Print / Save as PDF

        </button>

    </div>

    <!-- Printable document -->
    <main class="print-document">

        <!-- Company header -->
        <header class="document-header">

            <div>

                <h2 class="company-name">
                    Executive Business Brokers
                </h2>

                <div class="document-subtitle">
                    Business Listing Factsheet
                </div>

            </div>

            <div class="listing-reference">

                <small>Listing ID</small>

                <strong>
                    #{{ $listing->ListingID }}
                </strong>

            </div>

        </header>

        <!-- Listing title -->
        <div class="listing-heading">

            <h1>
                {{ $displayValue($listing->BusType) }}
            </h1>

            <p class="listing-location">
                {{ $displayValue($listing->County) }}
            </p>

            @if (!empty($subCatName))
                <div class="listing-category">

                    Business Category: {{ $subCatName }}

                </div>
            @endif

        </div>

        <!-- Business image -->
        <div class="listing-image">

            <img src="{{ $imageUrl }}" alt="{{ $listing->BusType }}"
                onerror="this.onerror=null;this.src='{{ asset('assets/images/business_image.jpg') }}';">

        </div>

        <!-- Financial highlights -->
        <div class="financial-highlights">

            <div class="highlight-card">

                <span>Asking Price</span>

                <strong>
                    {{ $money($listing->ListPrice) }}
                </strong>

            </div>

            <div class="highlight-card">

                <span>Cash Flow</span>

                <strong>
                    {{ $money($cashFlow) }}
                </strong>

            </div>

            <div class="highlight-card">

                <span>Annual Sales</span>

                <strong>
                    {{ $money($listing->AnnualSales) }}
                </strong>

            </div>

        </div>

        <!-- Business overview -->
        <section class="information-section">

            <h3 class="section-title">
                Business Overview
            </h3>

            <div class="overview-content">{{ $overview !== '' ? $overview : 'No business overview is available.' }}
            </div>

        </section>

        <!-- Business information -->
        <section class="information-section">

            <h3 class="section-title">
                Business Information
            </h3>

            <table class="details-table">

                <tbody>

                    @foreach ($businessInfo as $label => $value)
                        <tr>

                            <td>{{ $label }}</td>

                            <td>{{ $value }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </section>

        <!-- Pricing information -->
        <section class="information-section">

            <h3 class="section-title">
                Pricing Information
            </h3>

            <table class="details-table">

                <tbody>

                    @foreach ($pricingInfo as $label => $value)
                        <tr>

                            <td>{{ $label }}</td>

                            <td>{{ $value }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </section>

        <!-- Financial information -->
        <section class="information-section">

            <h3 class="section-title">
                Financial Information
            </h3>

            <table class="details-table">

                <tbody>

                    @foreach ($financialInfo as $label => $value)
                        <tr>

                            <td>{{ $label }}</td>

                            <td>{{ $value }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </section>

        <!-- Document footer -->
        <footer class="document-footer">

            <div class="footer-company">

                Executive Business Brokers

            </div>

            <div class="footer-information">

                Business Listing #{{ $listing->ListingID }}

                &nbsp; | &nbsp;

                Generated on {{ now()->format('F d, Y') }}

            </div>

            <div class="disclaimer">

                Confidential Business Information.
                Listing information is subject to verification.

            </div>

        </footer>

    </main>

</body>

</html>
