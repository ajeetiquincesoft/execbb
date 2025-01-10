@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Faqs</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Main Section -->

<div class="container my-7 container-padding faqs">
    <div class="content-box">
        <!-- Heading and Description -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">FAQ’s</h1>
        </div>
        <hr class="pursuit_hr mb-5">
        <div class="text-center mb-5 general_qus">
            <h1 class="fw-bold">General Questions about selling and EBB</h1>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="container">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    Do I need to consult a business broker?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="faq_answer">Selling a business is complex. If you don’t have any experience you probably should consider working with an Agency that has qualified buyers and experience working with businesses in many industries. They will be able to accurately value your business. That agency will also be considerably more experienced in negotiating. All these factors can save you a lot of time, effort and money in the long run. At Executive Business Brokers, we typically represent hundreds of small to mid-size businesses in retail, wholesale, distribution, manufacturing & service related industries with prices ranging from $100K to $5M+.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Will I need to help with the sale?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="faq_answer">Yes, but you will have help. Selling a business is complex. There are many players involved, such as bankers, accountants, lawyers and landlords. A business broker will be able to assist you with determining value, locating potential buyers, conducting productive negotiations, structuring the purchase and coordinating the closing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    What is the definition of a "small to mid-size" businesses?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="faq_answer">There are many definitions of the small to mid-size businesses. For our purposes, we define it as companies with values between $100K and $5M.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Why do businesses fail after they are purchased?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="faq_answer">The main reason a business fails after purchase is because of the buyer. Buyers may underestimate the amount of cash needed to operate the business. A business can also fail if the buyer neglects to implement a successful business plan or if the buyer has poor management skills.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container">
                    <div class="accordion" id="accordionExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    How does the broker get paid?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <p class="faq_answer">Executive Business Brokers gets paid only when a business deal closes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    Why is confidentiality important?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <p class="faq_answer">Confidentiality is most important to the seller. Selling a business could be bad for business. Competitors may try to use it to lure away customers who may decide they don’t want to do business with a business that is up for sale. Additionally, employees may fear for their jobs if they feel their future is uncertain.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    How does EBB find buyers?
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb-5 general_qus">
            <h1 class="fw-bold">Buying Process</h1>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="container">
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    What are the key motivators for people going into business for themselves?
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">Money is not always at the top of a buyers list of reasons for going into business for themselves. More likely, they have lost their job, are extremely dissatisfied with their job or are entering into retirement. Their reasons for purchasing a business could include: 1) independence/be own boss, 2) flexibility, 3) capitalize on a skill set and, 4) to make money.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    Is it better to buy an existing business or to start one?
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">There are more benefits to buying a business than to starting one, especially since most new businesses fail within 5 years. An existing business has three things that are the most challenging for new businesses to achieve: a customer base, established credit/financial history and employees. This provides an immediate cash flow, which could improve your ability to obtain acquisition financing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    How much cash do I need to purchase a business?
                                </button>
                            </h2>
                            <div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">One of the ways in which you can purchase a business is through deferred payment in which a portion of the total is paid in installments/over time in the form of a seller notes or based on the performance of the business. The other way to purchase a business is through a third party/lender where you may be required to put down 1/3 to 1/2 of the purchase price in cash.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                    What is due diligence?
                                </button>
                            </h2>
                            <div id="collapse11" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">Due diligence is an important step that involves close examination of public and proprietary information related to the assets and liabilities of the business being purchased. It covers background, finance, human resources, tax and legal matters. EBB has a <a href="#" class="sellorgive">due diligence check list</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    What should I look for when buying a business?
                                </button>
                            </h2>
                            <div id="collapse12" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">There are so many aspects of a business that require close examination before determining whether it is right for you. First you should identify your reasons for owning a business, the type of business you would be most comfortable running, the amount you have available to invest and the type of income you will need to take home. Other areas you should look at when examining a business include: 1) what is the annual increase in sales, 2) what are the debts, credits and inventory, 3) will the seller help transition the business, and 4) what does the future hold for the business?</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                    When should I consult an attorney/accountant?
                                </button>
                            </h2>
                            <div id="collapse13" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">The advice of attorneys and accountants is important once you have selected a business and you think your terms will be accepted by the seller. Both parties can help protect you. The attorney will create and prepare all legal documents for the transaction and an accountant will advise you on tax issues and be able to review the financial data of the business.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                    Where can I obtain financing?
                                </button>
                            </h2>
                            <div id="collapse14" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">Your ability to obtain financing will depend upon the strength of the business you are purchasing. This includes the asset base, operating history, collateral availability and projected cash flow. There are several types of third party lending including commercial lending, asset-based lenders and seller financing. With seller financing, the seller takes back a promissory note for part of the value of the company. We recommend you consult with an <a href="#" class="sellorgive">SBA</a> specialist or one of our <a href="#" class="sellorgive">financing experts</a> to help you decide the best course of action for you.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                    What are some significant warning signs I should look for during due diligence?
                                </button>
                            </h2>
                            <div id="collapse15" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <p class="faq_answer">Some red flags include: seller withholds, misleads or provides limited access to information or employees, seller is vague about why they are selling or proposes an unrealistic timetable, or seller is not willing to provide you a commitment after the sale.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb-5 general_qus">
            <h1 class="fw-bold">Selling Process</h1>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="container">
                    <div class="accordion" id="accordionExample3">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                    How long does it take to sell a company?
                                </button>
                            </h2>
                            <div id="collapse16" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">We have sold companies in as short a time frame as 1 month and others have taken as long as a year. Most closings take place between six and twelve months from the date we begin our work. Generally, the reasonableness of the price, terms and conditions will dictate the time required.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                    What are your fees?
                                </button>
                            </h2>
                            <div id="collapse17" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">Compensation is earned only when a closing occurs. Our fees are competitive within the industry. They are a percentage of the transaction price and depend on the size and difficulty of the project.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                                    How do we start this process?
                                </button>
                            </h2>
                            <div id="collapse18" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">The initial step is to hold a totally confidential, no-obligation assessment meeting. The purpose of this meeting is to determine whether to proceed to the next step. Meetings can be held at your business or our office or some other place of confidentiality you might prefer. In addition to learning about your business, we want to completely understand the personal and business objectives of our prospective clients. We also explain the sale or acquisition process and our role in it.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                                    How much of management’s time will be needed in the process?
                                </button>
                            </h2>
                            <div id="collapse19" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">Management will be involved initially to help us gather the information we need about the business. This usually takes 2-4 hours. During the sales process, we will limit the how much time we need from management, as they should continue to run the business. Once we have located a buyer, management will need to be involved. Even then, we will attempt to limit our interaction with them, only providing them with progress reports or following up with pertinent information.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                                    What other advisors are needed?
                                </button>
                            </h2>
                            <div id="collapse20" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">As business brokers we are limited in the advice we can provide to you. To address legal and financial issues (including taxes and financial books), we recommend that you hire attorneys and accountants that specialize in small business acquisitions. Depending upon the type of business that you are purchasing you may require other types of professionals.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                    Who sets the asking price?
                                </button>
                            </h2>
                            <div id="collapse21" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">To appropriately value your business, EBB will evaluate your business looking at factors such as the last 3 years of sales and profits, lease agreements and balance sheet.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                                    How do you value a business?
                                </button>
                            </h2>
                            <div id="collapse22" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">Valuing a business is not an exact science and is very subjective. We use a multiple of the <a href="" class="sellorgive">seller’s discretionary cash</a> (SDC) plus the fixed assets to determine a business’ worth in the marketplace.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                    Should it be a stock or asset sale?
                                </button>
                            </h2>
                            <div id="collapse23" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="faq_answer">To avoid assuming unknown liabilities of the selling corporation, most buyers acquire the businesses assets vs. the stock of the corporation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .breadcrumb-container {
        background-color: #F8F8F8;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #333333;
    }

    .breadcrumb-item.active {
        color: #333333;
    }

    .text-gold {
        color: #333333;
    }

    .fw-bold {
        font-weight: 700;
    }



    .text-muted {
        color: #7F8C8D;
    }

    .icon {
        font-size: 1.2em;
    }

    .list-unstyled li {
        margin-bottom: 10px;
    }

    .img-fluid {
        max-width: 100%;
        height: 289px;
        ;
        border-radius: 8px;
    }

    .breadcrumb {
        background: transparent;
    }

    .faqs_sec h3 {
        padding: 20px 0;
        font-size: 25px;
    }

    .faqs h1 {
        font-size: 25px;
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23806132' class='bi bi-plus' viewBox='0 0 16 16'%3E%3Cpath d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/%3E%3C/svg%3E");
        transition: all 0.5s;
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23806132' class='bi bi-dash' viewBox='0 0 16 16'%3E%3Cpath d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z'/%3E%3C/svg%3E");
    }

    .accordion-button::after {
        transition: all 0.5s;
    }

    .general_qus h1 {
        color: #806132;
    }

    .faqs button.accordion-button.collapsed {
        font-family: 'Gilroy';
        color: #333333;
        font-size: 18px;
    }

    .faqs .accordion-button:not(.collapsed) {
        color: #333333;
        background-color: #ffffff;
        box-shadow: none;
        font-size: 18px;
        font-family: 'Gilroy';
    }

    p.faq_answer {
        font-family: 'Gilroy';
        color: #5D5D5D;
        font-weight: 400;
        line-height: 26px;
    }

    /* Remove hover styles */
    .accordion-button:hover {
        background-color: transparent;
        border-color: transparent;
        box-shadow: none;
    }

    /* Remove active styles */
    .accordion-button:active {
        background-color: transparent;
        border-color: transparent;
        box-shadow: none;
    }


    .accordion-button:focus {
        box-shadow: none;
        outline: none;
    }

    .accordion-item {
        margin-bottom: 20px;
        border: 1px solid #D5D5D5 !important;
        border-radius: 0 !important;
    }

    .content-box {
        background-color: #FFFFFF;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection