<?php

namespace App\PDFReports;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuyerElectronicSignature
{
    public function generate(Request $request)
    {
        $html = '';
        $buyer = DB::table('buyers')
            ->where('BuyerID', $request->buyer_id)
            ->first();
    $html .='<style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            margin: 30px;
            color: #000;
        }
        h2 {
            font-size: 14px;
            margin-bottom: 5px;
            text-align: left;
        }
        p {
            margin: 5px 0;
            text-align: justify;
        }
        .agreement {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .checkbox {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .checkbox p {
            margin: 0;
        }
        .highlight {
            font-weight: bold;
        }
        .signature {
            margin-top: 20px;
        }
    </style>
   <h2>EXECUTIVE BUSINESS BROKERS</h2>
    <h2>CONFIDENTIALITY NON-DISCLOSURE AND SHOWING AGREEMENT</h2>

    <div class="agreement">
        <p>
            BY REGISTERING AS A BUYER I WILL NOT CONTACT SELLER, EMPLOYEES, LANDLORD OR VENDORS 
            WITHOUT AUTHORIZATION FROM SELLER OR BROKER. I/we the undersigned and prospective 
            Purchaser(s) hereby acknowledge receipt of confidential information about the business(es) 
            and/or real property described and about to be shown to me by EXECUTIVE BUSINESS BROKERS, INC. 
            ("EBB") on the date shown below. Purchaser(s) agree not to conduct full drive-bys or 
            inspection of the business or speak to any employees of the business except exclusively 
            through EBB and their authorized sales agent(s). I/we acknowledge to be the agency first 
            providing such information to us.
        </p>
        <p>
            It is further agreed that should I/we enter into an agreement to purchase any property 
            or inventory related to the business(es) that I/we will use EBB as the broker of record. 
            I/we further agree to keep in strict confidence all information now and hereafter furnished 
            to me/us with respect to the above described businesses and that I/we will not disclose any 
            such information to any other person except my counsel, accountant, banker, or financial 
            advisor. Purchaser acknowledges responsibility for all losses and damages incurred by "EBB". 
            Prospective Purchaser hereby indemnify and unconditionally hold harmless EBB executives 
            from any liability resulting from disclosure by this Agreement which may be given to me/us 
            at a later date in respect to one or more businesses. This Agreement shall remain in force 
            with respect to new and additional information, or additional businesses hereafter added to 
            this Agreement.
        </p>
        <p>
            I/we hereby agree to retain in strict confidence all information provided regarding the 
            business(es) and/or real property listed above.
        </p>
        <p>
            PURCHASER/BUYER BEWARE: Executive Business Brokers ("EBB") has not audited the books or 
            records of this business or verified any other facts or representation made by Seller 
            which may be contained in any of the information sessions. Furthermore "EBB" does not 
            warrant the accuracy or completeness of any of the records and/or information relating to 
            the financial condition of the Seller as herein provided.
        </p>
        <p>
            Executive Business Brokers Fact Sheets, marketing materials and discussions with Seller 
            are hereby agreed to hold Harmless Executive Business Brokers from any fee’s, claims or 
            litigation which may arise from this transaction including but not limited to reasonable 
            attorney’s fees incurred. Purchaser/Buyer agrees and is required to conduct his/her own 
            due diligence to validate and determine independently the representations including but 
            not limited to Sales, Business costs, lease agreements, financial projections, competition, 
            new developments which may affect business conditions, and loss of equipment, goodwill, 
            permits, etc.
        </p>
        <p>
            Purchaser hereby acknowledges that Executive Business Brokers represents the Seller. 
            RECEIPT OF A COPY OF THIS ACKNOWLEDGEMENT AND AGREEMENT IS HEREBY ACKNOWLEDGED.
        </p>
    </div>

    <div class="checkbox">
        <p>✔ I have read and agree with the terms of the above Confidentiality Non-Disclosure and Showing Agreement.</p>
    </div>

    <div class="signature">
        <p class="highlight">
            By typing your FULL NAME in the field below, you are signing this document as it relates 
            to the information in the above Buyer Registration and Confidentiality Non-Disclosure 
            and Showing Agreement:
        </p>';
        if($buyer){
        $html .='<p><strong>Your Full Name:</strong> '. $buyer->FName .' '.$buyer->LName.'</p>
        <p><strong>Signed electronically on:</strong> '. (!empty($buyer->BDate) && strtotime($buyer->BDate) ? date('d/m/Y', strtotime($buyer->BDate)) : '') . '</p>';
        }else{
             $html .='<p>NO ELECTRONIC SIGNATURE FOR THIS BUYER </p>';
        }
        $html .='<p>The above named individual agreed to the above terms on the date indicated via electronic signature.</p>
    </div>';
     $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output();
    }
}
