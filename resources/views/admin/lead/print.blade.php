<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lead #{{ $lead->LeadID }} - Print</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            padding: 0;
            background: #eee;
            color: #333;
            font: 13px Arial, Helvetica, sans-serif
        }

        .print-wrapper {
            max-width: 900px;
            margin: 25px auto
        }

        .print-actions {
            text-align: right;
            margin-bottom: 15px
        }

        .print-actions button {
            border: 0;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            margin-left: 5px
        }

        .btn-print {
            background: #222;
            color: #fff
        }

        .btn-close {
            background: #777;
            color: #fff
        }

        .lead-paper {
            background: #fff;
            padding: 35px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .12)
        }

        .lead-header {
            border-bottom: 3px solid #c99a24;
            padding-bottom: 18px;
            margin-bottom: 25px
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px
        }

        .company-title {
            font-size: 25px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
            overflow-wrap: anywhere
        }

        .document-title {
            font-size: 17px;
            color: #777
        }

        .lead-number {
            text-align: right;
            font-size: 14px
        }

        .lead-number strong {
            font-size: 18px;
            color: #b18212
        }

        .printed-date {
            margin-top: 5px;
            color: #888;
            font-size: 11px
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: auto
        }

        .section-title {
            background: #f4f4f4;
            border-left: 5px solid #c99a24;
            padding: 10px 12px;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #333
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-top: 1px solid #ddd;
            border-left: 1px solid #ddd
        }

        .info-item {
            display: grid;
            grid-template-columns: 42% 58%;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            min-height: 35px;
            min-width: 0
        }

        .info-label {
            background: #fafafa;
            padding: 8px;
            font-weight: 600
        }

        .info-value {
            padding: 8px;
            word-break: break-word;
            overflow-wrap: anywhere;
            white-space: pre-wrap
        }

        .full-width {
            grid-column: 1/-1
        }

        .text-box {
            border: 1px solid #ddd;
            padding: 12px;
            min-height: 55px;
            white-space: pre-wrap;
            word-break: break-word;
            overflow-wrap: anywhere
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
            background: #fff3cd;
            color: #856404
        }

        .print-footer {
            margin-top: 35px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            color: #888;
            font-size: 10px;
            text-align: center
        }

        @media print {
            body {
                background: #fff;
                font-size: 11px
            }

            .print-wrapper {
                width: 100%;
                max-width: none;
                margin: 0
            }

            .print-actions {
                display: none !important
            }

            .lead-paper {
                box-shadow: none;
                padding: 0
            }

            .section {
                break-inside: auto
            }

            .section-title {
                break-after: avoid;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact
            }

            .info-item {
                break-inside: avoid
            }

            .info-label {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact
            }

            @page {
                size: Letter;
                margin: .45in
            }

            a {
                color: inherit;
                text-decoration: none
            }
        }
    </style>
</head>

<body>
    <div class="print-wrapper">
        <div class="print-actions">
            <button type="button" class="btn-print" onclick="window.print()">🖨 Print Lead</button>
            <button type="button" class="btn-close" onclick="window.close()">Close</button>
        </div>
        <main class="lead-paper">
            <header class="lead-header">
                <div class="header-top">
                    <div>
                        <div class="company-title">
                            @if (($lead->listing_display_name ?? 'Not Assigned') !== 'Not Assigned')
                                {{ $lead->listing_display_name }}@else{{ $lead->BusName ?: 'Lead Record' }}
                            @endif
                        </div>
                        <div class="document-title">LEAD RECORD</div>
                    </div>
                    <div class="lead-number">Lead ID<br><strong>#{{ $lead->LeadID }}</strong>
                        <div class="printed-date">Printed: {{ now()->format('m/d/Y h:i A') }}</div>
                    </div>
                </div>
            </header>

            <section class="section">
                <div class="section-title">General Information</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Lead ID</div>
                        <div class="info-value">{{ $lead->LeadID }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Status</div>
                        <div class="info-value"><span
                                class="status">{{ $lead->status_name ?: $lead->Status ?? '-' }}</span></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Category</div>
                        <div class="info-value">{{ $lead->category_name ?: $lead->Category ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Subcategory</div>
                        <div class="info-value">{{ $lead->SubCategory ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Lead Date</div>
                        <div class="info-value">{{ $lead->LDate ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Source</div>
                        <div class="info-value">{{ $lead->Source ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Entered By</div>
                        <div class="info-value">{{ $lead->EnteredBy ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Assigned Agent</div>
                        <div class="info-value">{{ $lead->agent_display_name ?? 'Unassigned' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Listing ID</div>
                        <div class="info-value">{{ $lead->ListingID ?: 'Not Assigned' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Listing DBA</div>
                        <div class="info-value">{{ $lead->listing_display_name ?? 'Not Assigned' }}</div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-title">Seller / Contact Information</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">First Name</div>
                        <div class="info-value">{{ $lead->SellerFName ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Last Name</div>
                        <div class="info-value">{{ $lead->SellerLName ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Home Phone</div>
                        <div class="info-value">{{ $lead->HomePhone ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Cell Phone</div>
                        <div class="info-value">{{ $lead->CellPhone ?: '-' }}</div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-title">Business Information</div>
                <div class="info-grid">
                    <div class="info-item full-width">
                        <div class="info-label">Business Name</div>
                        <div class="info-value">{{ $lead->BusName ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $lead->Address ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">City</div>
                        <div class="info-value">{{ $lead->City ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">State</div>
                        <div class="info-value">{{ $lead->State ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">ZIP</div>
                        <div class="info-value">{{ $lead->Zip ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">County</div>
                        <div class="info-value">{{ $lead->County ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Asking Price</div>
                        <div class="info-value">
                            {{ $lead->Price !== null ? '$' . number_format((float) $lead->Price, 2) : '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Down Payment</div>
                        <div class="info-value">
                            {{ $lead->DownPay !== null ? '$' . number_format((float) $lead->DownPay, 2) : '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Annual Sales</div>
                        <div class="info-value">
                            {{ $lead->AnnSales !== null ? '$' . number_format((float) $lead->AnnSales, 2) : '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Years in Business</div>
                        <div class="info-value">{{ $lead->YearsInBus ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Present Owner</div>
                        <div class="info-value">{{ $lead->PresentOwner ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Facility Size</div>
                        <div class="info-value">{{ $lead->SizeOfFacility ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Real Estate Included</div>
                        <div class="info-value">
                            {{ $lead->RealEstateInc === null ? '-' : ((int) $lead->RealEstateInc === 1 ? 'Yes' : 'No') }}
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Real Estate Asking Price</div>
                        <div class="info-value">
                            {{ $lead->REAsking !== null ? '$' . number_format((float) $lead->REAsking, 2) : '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">FSBO</div>
                        <div class="info-value">
                            {{ $lead->FSBO === null ? '-' : ((int) $lead->FSBO === 1 ? 'Yes' : 'No') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Listed</div>
                        <div class="info-value">
                            {{ $lead->Listed === null ? '-' : ((int) $lead->Listed === 1 ? 'Yes' : 'No') }}</div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-title">Appointment & Advertisement</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Appointment Date</div>
                        <div class="info-value">{{ $lead->AppointmentDate ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Appointment Time</div>
                        <div class="info-value">{{ $lead->AppointmentTime ?: '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Advertisement Date</div>
                        <div class="info-value">{{ $lead->AdDate ?: '-' }}</div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-title">Advertisement Copy</div>
                <div class="text-box">{{ $lead->AdCopy ?: '-' }}</div>
            </section>
            <footer class="print-footer">Confidential Business Brokerage Information | Lead #{{ $lead->LeadID }}
            </footer>
        </main>
    </div>
</body>

</html>
