@extends('admin.layout.master')
@section('content')
    <div class="container-fluid content bg-light">
        <div class="hotsheet-content">
            <h1>Executive Business Brokers</h1>
            <p class="sub-heading">Hot Sheet Offers</p>
            <span class="mb-2">As of: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</span>
        </div>
        <div class="hotsheet-toolbar no-print">
            <button type="button" class="print-btn" onclick="printHotSheet()">
                <i class="fas fa-print"></i>
                Print Hot Sheet
            </button>
        </div>
        <table class="hotsheet-table">
            <thead>
                <tr>
                    <th>Date of Offer</th>
                    <th>No Show</th>
                    <th>Business Name</th>
                    <th>ID #</th>
                    <th>L.Agent</th>
                    <th>S.agent</th>
                    <th>Buyer Name/ID</th>
                    <th>Price</th>
                    <th>Down Pay</th>
                    <th>Accepted</th>
                    <th>Under Contract</th>
                    <th>Check Deposited</th>
                    <th>Offer #</th>
                    <th>Closing Date</th>
                    <th>Closing Place</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <td>{{ $offer->DateOfOffer }}</td>
                        <td>
                            @if ($offer->Status == 'Accepted')
                                ✓
                            @endif
                        </td>
                        <td>{{ $offer->SellerCorpName }}</td>
                        <td>{{ $offer->AgentUserRegisterId }}</td>
                        <td>{{ $offer->ListingAgent }}</td>
                        <td>{{ $offer->SellingAgent }}</td>
                        <td>{{ $offer->BuyerFName }} {{ $offer->BuyerLName }} {{ $offer->BuyerID }}</td>
                        <td>{{ $offer->PurchasePrice }}</td>
                        <td>{{ $offer->DownPaymnt }}</td>
                        <td>{{ $offer->Status == 'Accepted' ? 'Yes' : '' }}</td>
                        <td>No</td>
                        <td>{{ $offer->DepositCheckNumber }}</td>
                        <td>{{ $offer->OfferID }}</td>
                        <td>{{ $offer->SchedCloseDate }}</td>
                        <td>{{ $offer->SchedClosePlace }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div p-8="">
        <p>&nbsp;</p>
    </div>
    <style>
        .hotsheet-table {
            border-collapse: collapse;
            width: 100%;
        }

        .hotsheet-table th,
        .hotsheet-table td {
            border: 1px solid black;
            text-align: center;
            font-size: 12px !important;
        }

        .hotsheet-table th {
            background-color: #f2f2f2;
        }

        .hotsheet-content h3 {
            font-weight: bold;
        }

        .hotsheet-content span {
            text-align: center;
            display: block;
        }

        /* Print Button */
        .hotsheet-toolbar {
            display: flex;
            justify-content: flex-end;
            margin: 10px 0 15px;
        }

        .print-btn {
            background: #7a1235;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #5d0d29;
        }

        .print-btn i {
            margin-right: 6px;
        }


        /* =========================
                       PRINT
                    ========================= */

        @media print {

            @page {
                size: landscape;
                margin: 8mm;
            }

            /* Hide entire page first */
            body * {
                visibility: hidden;
            }

            /* Show only Hot Sheet content */
            .content,
            .content * {
                visibility: visible;
            }

            /* Put Hot Sheet at the top of the printed page */
            .content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
            }

            /* Hide print button */
            .no-print {
                display: none !important;
            }

            /* Heading */
            .hotsheet-content {
                text-align: center;
                margin-bottom: 10px;
            }

            .hotsheet-content h1 {
                font-size: 20px !important;
                margin: 0 0 3px !important;
            }

            .hotsheet-content .sub-heading {
                font-size: 14px !important;
                margin: 0 0 3px !important;
            }

            .hotsheet-content span {
                font-size: 10px !important;
            }

            /* Table */
            .hotsheet-table {
                width: 100% !important;
                border-collapse: collapse !important;
                table-layout: fixed;
            }

            .hotsheet-table thead {
                display: table-header-group;
            }

            .hotsheet-table tr {
                page-break-inside: avoid;
            }

            .hotsheet-table th,
            .hotsheet-table td {
                border: 1px solid #000 !important;
                padding: 3px 2px !important;
                font-size: 7.5px !important;
                color: #000 !important;
                text-align: center !important;
                line-height: 1.15;
            }

            .hotsheet-table th {
                font-weight: bold;
                background: #eee !important;
            }

        }
    </style>
    <script>
        function printHotSheet() {
            window.print();
        }
    </script>
@endsection
