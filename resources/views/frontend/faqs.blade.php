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
<section class="main-section faqs" style="background-color: #F8F8F8;">
    <div class="container py-5 container-padding" style="background-color: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
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
                                    <p class="faq_answer">We maintain a database of active strategic and financial buyers. We also have a strong marketing program that includes Internet marketing, direct mail, telemarketing, newspaper ads and Web site promotions.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</section>
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

    .main-section {
        background-color: #fff;
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
    margin-bottom: 20px; /* Adjust the value as needed */
}
</style>
@endsection