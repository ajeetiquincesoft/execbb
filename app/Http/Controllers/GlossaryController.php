<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlossaryController extends Controller
{
    public function index(Request $request)
    {
        $flag = $request->query('flag', 'a'); // Retrieve the flag from the query string
        $glossaryTerms = $this->getGlossaryTermsByFlag($flag); // Call method to filter terms based on the flag
        return view('frontend.glossary', compact('glossaryTerms'));
    }
    private function getGlossaryTermsByFlag($flag)
    {
        // Sample glossary data
        $glossary = [
            'acknowledge' => 'A declaration by someone that something is true.',
            'affidavit' => 'A sworn statement; written oath such as acknowledgment.',
            'affirmation' => 'A solemn declaration; a non-religious oath.',
            'agency' => 'The legal relationship between a principal and his agent.',
            'agent' => 'A person (natural), corporation, society, association or partnership.',
            'amortization' => 'Act of liquidating an indebtedness by equal and periodic payments.',
            'base year' => 'The Company\'s current fiscal year. Since complete financial statements are not available for the current year, sales and income are projected based on the expectations of management. A double base year is used when the Company is within a few months of the end of its fiscal year, or has completed its fiscal year but does not yet have financial statements for that year.',
            'book value' => 'The value at which an asset is carried on a company\'s balance sheet. See Recase Book Value.',
            'bill of sale' => 'A written instrument which is the evidence of transfer of one person\'s right in personal property to another.',
            'capital expenditures' => 'Investments of cash for improvements to remain competitive in a business.',
            'capitalized items' => 'Have an economic life of one year or more and the cost is moved to the balance sheet, and then these costs can be written down by depreciation or amortization over time.',
            'cash flow' => 'The excess of sources of cash over uses of cash.',
            'cash flow statement' => 'An Analysis of all the changes that effect the cash account during an accounting period. These changes may be shown as either sources or uses of cash.',
            'closing costs' => 'Costs to transfer business from seller to buyer at conveyance of business.',
            'closing statement' => 'A written accounting of funds to seller and buyer at passing of papers.',
            'clp (certified lender program)' => 'This process is for the more sophisticated and experienced lenders who have graduated beyond GP status. Typically, the lender now submits a complete package to the SBA and as a CLP Lender they are guaranteed a 3-day turnaround from the SBA.',
            'collateral' => 'A security, such as a mortgage, given to protect debt.',
            'co-mingling' => 'The mixing of funds held for the benefit of others with the brokers personal or business funds.
            ',
            'commission' => 'Money or other valuable consideration given to broker by principal for services rendered. Typically, the amount is by agreement.',
            'conditional sales contract' => 'A contract in which owner retains title until buyer has met all terms and conditions; a familiar device in land sales; also called land contract or installment contract. Buyer acquires equitable title until final payment; after delivery of deed, buyer has legal title.',
            'confidentiality agreement' => 'A pact that forbids buyers, sellers, and their agents in a given business deal from disclosing information about the transaction to others.',
            'consideration' => 'Something of value exchanged between parties of a contract; money, services, goods or promises.',
            'contract' => 'A legal instrument between two parties to do or not to do something; in reality, it must be in writing to be enforceable. <b>Counter Offer</b>: typically voids first offer and creates new offer.',
            'corporate buyers' => 'Sometimes called strategic buyers, these are companies that can derive operational benefits from owning a business. This can occur because of potentially higher revenues from a combination, potentially lower expenses by joining together, or a mixture of the two. Because of these perceived synergies, premium prices are often paid by strategic buyers.',
            'covenant' => 'A promise in an agreement or contract agreeing to performance or nonperformance of certain acts, or requiring or preventing certain acts or uses.',
            'deal structure' => 'The form by which the purchase of a business is accomplished. It could include cash, notes, stock, consulting agreements, earnout provisions, and covenants not to compete. The sale could take the form of an Asset Sale or a Stock Sale. See those definitions.',
            'disclosure' => 'A written explanation to be signed by a prospective buyer or seller, explaining to the client the role that the broker plays in the transaction. The purpose of disclosure is to explain whether the broker represents the buyer or seller or is a dual agent (representing both) or a subagent (an agent of the seller\'s broker). This allows the customer to understand to which party the broker owes loyalty.',
            'deficiency judgment' => 'Court award to lender if sale at public auction does not equal mortgage debt.',
            'depreciation' => 'Decrease in value for various reasons.',
            'due diligence' => 'Due diligence is often performed on the acquirer as well as the target.',
            'earnest money' => 'Deposit or binder given with Agreement to Buy.',
            'earning multiple' => 'Divide the returns on investment expectations of a buyer into 100. This multiple will change from business by classification to individual businesses. <a href="http://tajfutas.medvekoma.net/varadinum/car.html">Replica Cartier Watches</a>.',
            'earnout' => 'The portion of the purchase price that is contingent on future performance. It is payable to the sellers only when certain predefined levels of sales or income are achieved in the years after acquisition. <a href="http://www.dpsscreenprint.com/BackDoor/brei.html">Breitling Replica</a>',
            'ebitda' => 'Earnings Before Interest, Taxes, Depreciation & Amortization. <a href="https://www.betaniafauske.no/app15/omg.asp">OMEGA Replica</a>',
            'equity' => 'Value or interest an owner of realty has above any debt on property; difference between value and mortgage debt.',
            'escrow' => 'The holding of something of value by a person (escrowee or escrow agent) for the benefit of other parties.',
            'exclusive right to sell' => 'An employment agreement and contract giving the broker the right to receive a commission if the property or business is sold by anyone including the seller during the term of the agreement.',
            'expense' => 'Anything that a company buys that has an economic life of less than one year. It shows up immediately on the income statement.',
            'fair market value' => 'The price at which a business passes from a willing seller to a willing buyer. It is assumed that both buyer and seller are rational and have a reasonable knowledge of relevant facts.',
            'fiduciary' => 'A position of trust (e.g. broker to principal).',
            'finders fee' => 'Fee to broker for arranging loan for client; can also mean fee to broker for locating a property for client.',
            'fixed interest rate' => 'An interest rate which does not fluctuate with general market conditions.',
            'free cash flow' => 'Cash available for distribution after taxes but before the effects of financing. Calculated as net income plus depreciation less expenditures required for working capital and capital items adjusted to remove effects of financing.',
            'going concern value' => 'The gross value of a company as an operating business. This value may exceed or be at a discount from the liquidating value.',
            'goodwill' => 'The amount by which the price paid for a company exceeds the company\'s estimated net worth at market value of the underlying assets and liabilities.',
            'gross lease' => 'Owner receives rent and pays out expenses such as in apartment leasing; Net Lease: owner receives rent and tenant also pays out expenses normally paid by owner such as taxes, etc.',
            'industry buyer' => 'Typically a sale to an industry buyer is deeply discounted. Industry buyers will typically pay the liquidation value, book value or adjusted book value.',
            'investor buyers' => 'Also referred to as a financial buyer, these individuals are concerned with the return they can earn from the acquisition rather than the business in which the seller operates. They are usually more flexible with providing management incentives, including partial ownership.',
            'lease' => 'Contract between lessor (landlord) and lessee (tenant) for exclusive possession of realty for specified period under specific terms after which property reverts to lessor.',
            'leaseback' => 'The purchase of improved property and the leasing of it back to seller; creates capital and favored tax treatment for seller.',
            'leasehold' => 'The interest which a lessee has in realty.',
            'letter of intent' => 'A document agreement between a buyer and a seller used in connection with the acquisition of a company. The letter of intent describes the basic terms and conditions of the transaction between the buyer and the seller, including price, due diligence periods, exclusivity or no-shops, and the basic conditions to closing the deal. Customarily presented before a definitive purchase agreement is entered into, the letter of intent provides a road map for the parties involved in the transaction.',
            'lien' => 'A debt; a claim against property for payment of some debt.',
            'liquidating value' => 'The value of a company based on the market value of its assets, net of liabilities.',
            'lis pendens' => 'Notice filed in a registry of deeds warning all persons that title to certain property is in litigation.',
            'listing' => 'A written engagement (contract) between a principal and an agent authorizing the agent to perform services for the principal involving the principal\'s property (business). Generally the services provided by the agent involve the proposed sale of the principals property or business. Also, the property or business listed by the agent is called a Listing.',
            'net cash flow' => 'Cash available for distribution after taxes and after the effects of financing. Calculated as net income plus depreciation less expenditures required for working capital and capital items.',
            'plp' => 'This is the top designation and enables the respective lenders to approve their own loans with no additional underwriting by the SBA. Typically, this designation means that the lender has sufficient experience and track history to adhere to SBA standards and make quality loans.',
            'present value' => 'The value today of a future payment, or stream of payments, discounted at some appropriate compound interest (discount) rates.',
            'procuring cause' => 'A legal term that means the cause resulting in accomplishing a goal. Used in real estate [or business brokerage] to determine whether a broker is entitled to a commission.',
            'pro forma statements' => 'Are used to illustrate the likely expectation of a series of events in a set period of time, ie: if we have completed 10 months of a calendar year, and if we need to do the Evaluation based on the completed year.',
            'pro forma balance sheets' => 'In privately held companies, there are often redundant assets under utilized assets that need to be removed from the company prior to the sale of the business. A ProForma Balance Sheet is used to illustrate the likely balance sheet of the company, at the time of sale.',
            'projected statements' => 'Hypothetical statements. Financial statements as they would appear if some event, such as increased sales or production, were to occur.',
            'qualified buyer' => 'EBB screens prospects to ensure they are qualified to buy the business for which they have expressed interest. This screening uncovers the buyer’s objectives, their financial status and experience with purchasing a business.',
            'recasting' => 'Financial recasting eliminates from the historical financial presentation, items such as excessive and discretionary expenses and nonrecurring revenues and expenses, since they reflect the financing decision of the current owner and may not represent financing preferences of a new owner. Recasting provides an economic view of the company, and allows meaningful comparisons with other investment opportunities.',
            'recast book value' => 'The value of a balance sheet item (asset, liability, or equity) after recasting adjustments have been made.',
            'representation' => 'A statement or condition made that something is true or accurate.',
            'return on investment (roi)' => 'The rate of return at which the sum of the discounted future cash flows for the five pro forma years plus the discounted residual value equals the initial cash outlay.',
            'seller\'s discretionary cash flow to owner (sdc)' => 'Total compensation and benefits accruing to the owner of a business. Typically calculated by adding earnings before tax, interest, depreciation, amortization and all provable & verifiable expenses incurred for the benefit of the owner by the business.',
            'share sale' => 'A form of acquisition whereby all or a portion of the shares in a corporation is sold to the purchaser.',
            'stipulation' => 'To make a special demand for something as a condition of an agreement.',
            'uniform franchise offering circular' => 'The UFOC Guidelines were prepared and adopted by the North American Securities Administrators Association ("NASAA") and its predecessor, the Midwest Securities Commissioners Association. They are intended to facilitate compliance with disclosure requirements under state franchise investment laws.',
            'variable interest rate' => 'An interest rate that moves at a pre-defined level above or below an index rate. A commonly used index is the bank prime rate.',
            'warranty' => 'An expressed or implied statement that a situation or thing is as it appears to be or is represented to be.',
            'working capital' => 'The excess of current assets over current liabilities.',
        ];

        // Filter terms based on the flag (i.e., the first letter of the glossary term)
        if ($flag) {
            return array_filter($glossary, function ($key) use ($flag) {
                return strtoupper($key[0]) === strtoupper($flag);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $glossary;
    }
}
