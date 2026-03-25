@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">Sellers </a></li>
                    <li class="breadcrumb-item active"><a href="#">Preparing For The Sale</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Preparing For The Sale</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">

                        <p>Selling a business can be a complex process, but with careful planning and execution, you can
                            maximize your chances of a successful sale. Here are the steps involved in selling a business:
                        </p>

                        <h3 class="section-heading">Step 1: Prepare Your Business for Sale:</h3>
                        <p>a. Evaluate your financials: Review your financial statements, balance sheets, and tax returns.
                            Ensure your records are accurate and up to date.</p>
                        <p>b. Organize legal and contractual documents: Gather important documents such as business
                            licenses, leases, contracts, and any intellectual property rights.</p>
                        <p>c. Conduct a business valuation: Determine the market value of your business by assessing its
                            assets, earnings, and market trends. Consider hiring a professional appraiser if necessary. </p>
                        <p>d. Enhance your business's appeal: Make your business more attractive to potential buyers by
                            addressing any operational or financial weaknesses and highlighting its strengths.</p>
                        <h3 class="section-heading">Step 2: Assemble a Team of Experts:</h3>
                        <p>a. Hire a business broker or advisor: Consider working with a professional who specializes in
                            business sales. They can help you navigate the process, find potential buyers, and negotiate
                            deals.</p>
                        <p>b. Consult with a lawyer and accountant: Seek advice from professionals experienced in business
                            transactions. They can provide legal and financial guidance throughout the sale process.</p>
                        <h3 class="section-heading">Step 3: Identify Potential Buyers:</h3>
                        <p>a. Determine your target market: Define the ideal buyer profile for your business. Consider
                            factors such as industry experience, financial capability, and compatibility with your
                            business's values. </p>
                        <p>b. Network and advertise: Utilize your personal and professional networks, industry associations,
                            and online platforms to find potential buyers. Confidentially market your business while
                            protecting sensitive information.</p>
                        <h3 class="section-heading">Step 4: Confidentiality and Non-Disclosure Agreements:</h3>
                        <p>a. Prioritize confidentiality: Maintain strict confidentiality during the sales process to avoid
                            disruptions to your business and protect sensitive information. </p>
                        <p>b. Require non-disclosure agreements (NDAs): Request potential buyers to sign NDAs before sharing
                            detailed business information. NDAs legally bind them to maintain confidentiality.</p>
                        <h3 class="section-heading">Step 5: Negotiate and Structure the Deal:</h3>
                        <p>a. Screen potential buyers: Evaluate interested parties based on their financial capability,
                            compatibility, and seriousness. Request proof of funds or financing arrangements.</p>
                        <p>b. Initiate discussions: Engage in negotiations with qualified buyers. Consider structuring the
                            deal based on factors such as price, payment terms, and potential contingencies. </p>
                        <p>c. Seek professional guidance: Work closely with your team of experts to navigate negotiations,
                            including legal and financial aspects. Aim for a fair and mutually beneficial agreement. </p>
                        <h3 class="section-heading">Step 6: Due Diligence: </h3>
                        <p>a. Allow access to information: Grant the buyer access to relevant business records, contracts,
                            financial statements, and
                            other requested information for their due diligence. </p>
                        <p>b. Address concerns: Respond to buyer inquiries and provide additional information as needed.
                            Address any concerns or contingencies that arise during the due diligence process.</p>
                        <h3 class="section-heading">Step 7: Finalize the Sale: </h3>
                        <p>a. Draft a purchase agreement: Work with your lawyer to prepare a legally binding purchase
                            agreement that outlines the terms and conditions of the sale.</p>
                        <p>b. Seek professional review: Have your lawyer and accountant review the purchase agreement to
                            ensure all legal and financial aspects are appropriately addressed. </p>
                        <p>c. Closing the deal: Once both parties are satisfied with the terms, sign the purchase agreement
                            and complete the necessary paperwork. Transfer ownership, assets, and liabilities as outlined in
                            the agreement. </p>
                        <p>Remember, the process of selling a business can vary depending on the complexity of your business
                            and industry. Seeking professional advice and support throughout the process is crucial to
                            ensure a successful sale.</p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Tips For Selling Your Business</h5>
                                <p>
                                <ul>
                                    <li>Put the Books in Order</li>
                                    <li>Determine the Value of the Business</li>
                                    <li>Continue to Manage the Business While Selling It</li>
                                    <li>Negotiate Effectively by Calling in an Expert</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Ask the Experts to Sell Your Business</h5>
                                <p>EBB can <a href="{{ route('services') }}"
                                        style="color: #7F2149; text-decoration: underline;">guide you through the
                                        process</a> from business valuations to locating buyers.</p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5><a href="{{ route('twelvepoints') }}" style="color: #806132;">EBB's 12 point process</a>
                                </h5>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Determining Fair Market Value</h5>
                                <p>Don't know how to set a price? Contact EBB for a <a href="{{ route('contact.us') }}"
                                        style="color: #7F2149; text-decoration: underline;">FREE valuation</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .sub-heading {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }

        .sub-title {
            margin-bottom: 40px;
            font-family: 'Mulish';
            color: #5D5D5D;
        }

        .section-heading {
            font-size: 20px;
            font-weight: bold;
            color: #000;
            font-family: 'Urbanist';
        }

        .side-panel {
            height: 590px;
            width: 390px;
            margin-top: 40px;
            margin-left: -80px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 16px solid #F8F8F8;
        }

        .side-panel a {
            color: #7F2149;
        }

        .side-panel a:hover {
            text-decoration: underline;
        }

        .adove-logo {
            margin-top: 25px;
            display: block;
            max-width: 100%;
        }

        .ab_ebb p {
            font-size: 14px;
            color: #5D5D5D;
            line-height: 22px;
        }

        .Content-text {
            margin-right: 80px;
            font-family: 'Mulish', sans-serif;
            color: #5D5D5D;
        }

        .about_EBB {
            text-align: center;
        }

        .boxes-button-section {
            background: #FFFFFF;
            padding: 12px;
            margin-bottom: 12px;
            margin-top: 12px;
        }

        .EBB-team-title h5 {
            font-weight: bold;
            color: #806132;
            font-family: Mulish;
        }

        .EBB-team-title {
            padding-top: 16px;
            padding-left: 16px;
        }
    </style>
@endsection
