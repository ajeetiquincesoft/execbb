<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prob Matches Report - Buyer {{ $buyer->BuyerID }}</title>

    <style>
        :root {
            --brand: #5e0f2f;
            --brand-dark: #42091f;
            --brand-light: #f8edf2;
            --text: #253047;
            --muted: #718096;
            --border: #e5e7eb;
            --background: #f5f6fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: var(--background);
            color: var(--text);
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 13px;
        }

        .report-container {
            max-width: 1600px;
            margin: auto;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0, 0, 0, .06);
        }

        .brand-header {
            background: var(--brand);
            color: #fff;
            padding: 24px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .brand-name {
            font-size: 23px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: #f0dce5;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .report-badge {
            border: 1px solid rgba(255, 255, 255, .4);
            border-radius: 6px;
            padding: 10px 14px;
            text-align: right;
            line-height: 1.8;
            font-size: 12px;
        }

        .report-content {
            padding: 28px 30px;
        }

        .report-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .report-heading h1 {
            margin: 0 0 8px;
            font-size: 26px;
        }

        .report-description {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .print-btn {
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .print-btn:hover {
            background: var(--brand-dark);
        }

        .buyer-panel {
            background: #fcf9fb;
            border: 1px solid #ead9e1;
            border-left: 4px solid var(--brand);
            border-radius: 7px;
            padding: 18px 20px;
            margin-bottom: 24px;
        }

        .section-label {
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .buyer-name {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 14px;
            overflow-wrap: anywhere;
        }

        .buyer-details {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 32px;
        }

        .detail-item {
            color: var(--muted);
            line-height: 1.6;
        }

        .detail-item strong {
            color: var(--text);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .summary-card {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 18px;
            background: #fff;
            min-width: 0;
        }

        .summary-label {
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 10px;
        }

        .summary-value {
            color: var(--brand);
            font-size: 27px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .summary-note {
            color: var(--muted);
            font-size: 11px;
            margin-top: 6px;
        }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 14px;
        }

        .table-heading h2 {
            margin: 0;
            font-size: 17px;
        }

        .record-count {
            color: var(--brand);
            background: var(--brand-light);
            border-radius: 20px;
            padding: 7px 12px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        thead {
            display: table-header-group;
        }

        thead th {
            background: #f3edf1;
            color: var(--brand);
            padding: 13px 10px;
            border-bottom: 2px solid #dfc8d3;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--border);
            color: #465166;
            vertical-align: top;
            overflow-wrap: anywhere;
        }

        tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        .id-cell,
        .listing-cell {
            color: var(--brand);
            font-weight: 600;
        }

        .number-cell {
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .empty-state {
            text-align: center;
            padding: 35px 15px;
            color: var(--muted);
        }

        .report-footer {
            border-top: 1px solid var(--border);
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: var(--muted);
            font-size: 11px;
        }

        .report-footer strong {
            color: var(--brand);
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .brand-header,
            .report-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .report-content {
                padding: 18px 14px;
            }

            .report-badge {
                text-align: left;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .report-footer {
                flex-direction: column;
                padding: 15px;
            }
        }

        @media print {
            @page {
                size: landscape;
                margin: 10mm;
            }

            body {
                margin: 0;
                padding: 0;
                background: #fff;
                font-size: 10px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .report-container {
                max-width: none;
                border: none;
                border-radius: 0;
                box-shadow: none;
                overflow: visible;
            }

            .brand-header {
                padding: 14px 18px;
            }

            .brand-name {
                font-size: 18px;
            }

            .report-content {
                padding: 18px 0;
            }

            .report-heading {
                margin-bottom: 15px;
            }

            .report-heading h1 {
                font-size: 20px;
            }

            .buyer-panel {
                padding: 12px 15px;
                margin-bottom: 15px;
            }

            .buyer-name {
                font-size: 15px;
                margin-bottom: 8px;
            }

            .summary-grid {
                gap: 10px;
                margin-bottom: 18px;
            }

            .summary-card {
                padding: 12px;
                break-inside: avoid;
            }

            .summary-value {
                font-size: 20px;
            }

            .print-btn,
            .no-print {
                display: none !important;
            }

            .table-wrapper {
                overflow: visible;
            }

            thead th {
                padding: 8px 6px;
                font-size: 8px;
            }

            tbody td {
                padding: 7px 6px;
                font-size: 9px;
            }

            tbody tr {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .report-footer {
                padding: 12px 0;
            }
        }
    </style>
</head>

<body>
    @php
        $totalMatches = $probMatchs->count();
        $buyerName = trim(($buyer->FName ?? '') . ' ' . ($buyer->LName ?? '')) ?: 'N/A';
        $uniqueListings = $probMatchs->pluck('ListingId')->filter()->unique()->count();
    @endphp

    <div class="report-container">

        <header class="brand-header">
            <div>
                <div class="brand-name">Executive Business Brokers</div>
                <div class="brand-subtitle">Business Brokerage &amp; Advisory</div>
            </div>

            <div class="report-badge">
                <strong>BUYER PROB MATCH REPORT</strong><br>
                Buyer #{{ $buyer->BuyerID }}<br>
                Generated {{ now()->format('M d, Y') }}
            </div>
        </header>

        <main class="report-content">

            <div class="report-heading">
                <div>
                    <h1>Prob Matches Report</h1>
                    <p class="report-description">
                        Complete probability match results for the selected buyer.
                    </p>
                </div>

                <button type="button" class="print-btn no-print" onclick="window.print()">
                    Print / Save PDF
                </button>
            </div>

            <section class="buyer-panel">
                <div class="section-label">Selected Buyer</div>

                <div class="buyer-name">{{ $buyerName }}</div>

                <div class="buyer-details">
                    <div class="detail-item">
                        <strong>Buyer ID:</strong>
                        {{ $buyer->BuyerID }}
                    </div>

                    <div class="detail-item">
                        <strong>Report Date:</strong>
                        {{ now()->format('M d, Y h:i A') }}
                    </div>

                    <div class="detail-item">
                        <strong>Report Type:</strong>
                        All probability matches for this buyer
                    </div>
                </div>
            </section>

            <section class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Total Matches</div>
                    <div class="summary-value">
                        {{ number_format($totalMatches) }}
                    </div>
                    <div class="summary-note">Records for this buyer</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Unique Listings</div>
                    <div class="summary-value">
                        {{ number_format($uniqueListings) }}
                    </div>
                    <div class="summary-note">Distinct listings matched</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Buyer Reference</div>
                    <div class="summary-value">
                        #{{ $buyer->BuyerID }}
                    </div>
                    <div class="summary-note">Selected buyer record</div>
                </div>
            </section>

            <section>
                <div class="table-heading">
                    <h2>Probability Match Details</h2>

                    <span class="record-count">
                        {{ number_format($totalMatches) }} Records
                    </span>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Listing ID</th>
                                <th>Business</th>
                                <th>BusInt</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Down Pay</th>
                                <th>Vol</th>
                                <th>Profit</th>
                                <th>Overall</th>
                                <th>Date Range</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($probMatchs as $probMatch)
                                <tr>
                                    <td class="id-cell">
                                        {{ $probMatch->id }}
                                    </td>

                                    <td class="listing-cell">
                                        {{ $probMatch->ListingID ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $probMatch->listing_dba ?: $probMatch->listing_corpname ?? 'N/A' }}
                                    </td>

                                    <td class="number-cell">
                                        {{ $probMatch->BusInt ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $probMatch->Location ?? 'N/A' }}
                                    </td>

                                    <td class="number-cell">
                                        {{ $probMatch->Price ?? 'N/A' }}
                                    </td>

                                    <td class="number-cell">
                                        {{ $probMatch->DownPay ?? 'N/A' }}
                                    </td>

                                    <td class="number-cell">
                                        {{ $probMatch->Vol ?? 'N/A' }}
                                    </td>

                                    <td class="number-cell">
                                        {{ $probMatch->Profit ?? 'N/A' }}
                                    </td>

                                    <td class="number-cell">
                                        {{ $probMatch->Overall ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $probMatch->DateRank ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="empty-state">
                                        No Prob Matches found for this buyer.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

        </main>

        <footer class="report-footer">
            <div>
                <strong>Executive Business Brokers</strong>
                &mdash; Internal Business Report
            </div>

            <div>
                Buyer #{{ $buyer->BuyerID }}
                &nbsp;|&nbsp;
                {{ number_format($totalMatches) }} matches
            </div>
        </footer>

    </div>
</body>

</html>
