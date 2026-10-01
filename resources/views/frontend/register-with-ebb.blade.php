@extends('frontend.layout.master')

@section('content')

    <div class="container py-7">
        <div class="content-box-ebb">
            <div class="row g-5">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <div class="text-black" style="width: 100%;">
                        <div class="d-flex pb-1">
                            <h5 class="fw-normal mb-2 m-0 client_login">Register with EBB</h5>
                        </div>
                        <p class="m-0 mb-3 an_account" style="color: #5D5D5D;">Already have an account? <a
                                href="{{ route('login') }}" class="buyer_program">Sign in here</a></p>
                    </div>
                </div>
                @if (Session::has('error'))
                    <div class="ebb-error-alert" id="alert-danger">
                        <div class="ebb-error-icon">
                            <i class="fa fa-exclamation"></i>
                        </div>

                        <div class="ebb-error-content">
                            <div class="ebb-error-title">Registration Notice</div>
                            <div class="ebb-error-message">
                                {{ Session::get('error') }}
                            </div>
                        </div>

                        <button type="button" class="ebb-error-close" id="ebb-error-close" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                @endif
                <div class="col-lg-7 mt-0 column-divider">
                    <div class="RegisterWithEbb mb-2">
                        <form method="POST" action="{{ route('store.register.with.ebb', request()->query()) }}"
                            id="registerEbb">
                            @csrf
                            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                            <input type="hidden" name="action_type" id="action_type">
                            <input type="hidden" name="step" id="currentStep" value="{{ session('step', 1) }}">

                            <div class="ebb-step-progress" aria-label="Registration progress">
                                @php
                                    $currentStep = (int) session('step', 1);
                                @endphp

                                <div class="ebb-step-item {{ $currentStep >= 1 ? 'active' : '' }}">
                                    <span class="ebb-step-number">1</span>
                                    <span class="ebb-step-label">
                                        <strong>Agreement</strong>
                                        <small>Personal information</small>
                                    </span>
                                </div>

                                <span class="ebb-step-line" aria-hidden="true"></span>

                                <div class="ebb-step-item {{ $currentStep >= 2 ? 'active' : '' }}">
                                    <span class="ebb-step-number">2</span>
                                    <span class="ebb-step-label">
                                        <strong>Contact</strong>
                                        <small>Contact details</small>
                                    </span>
                                </div>

                                <span class="ebb-step-line" aria-hidden="true"></span>

                                <div class="ebb-step-item {{ $currentStep >= 3 ? 'active' : '' }}">
                                    <span class="ebb-step-number">3</span>
                                    <span class="ebb-step-label">
                                        <strong>Profile</strong>
                                        <small>Buyer preferences</small>
                                    </span>
                                </div>
                            </div>

                            @if (session('step', 1) == 1)
                                <div class="form-multi-tab">
                                    <div class="agreement-container">
                                        <h5 class="fw-bold mb-2 m-0">Confidentiality & Non-Circumvention Agreement</h5>

                                        <p class="nda_para">Seller requires purchaser to supply a confidentiality agreement
                                            prior to disclosing any information regarding their business. In consideration
                                            of Executive Business Brokers (hereafter the "Broker") providing the undersigned
                                            with information of businesses available for sale, I understand and agree to the
                                            following:</p>

                                        <p class="nda_para">1. That any information provided on any business to me by Broker
                                            may be sensitive and confidential, and that its disclosure to others may be
                                            damaging to the described businesses and their owners.</p>

                                        <p class="nda_para">2. Not to disclose any information regarding any business
                                            introduced to me by the Broker, to any other person who has not also signed and
                                            dated this Agreement. Information that is deemed confidential shall include the
                                            fact that any such business is for sale, plus any other data provided through
                                            the Broker.</p>

                                        <p class="nda_para">3. Not to contact the respective business owner, employees,
                                            suppliers, landlord, competitors, or customers except through the Broker.</p>

                                        <p class="nda_para">4. Any information provided to me by the Broker with respect to
                                            any business was obtained by the seller or other sources and was not verified in
                                            any way. I understand and agree that the Broker relied on the seller or such
                                            other sources for the accuracy of said information, has no knowledge of the
                                            accuracy of said information, and makes no warranty, expressed or implied, as to
                                            the accuracy of such information. Understanding that limitation, prior to
                                            entering into an agreement to purchase any business, I shall make such
                                            independent verification as I deem necessary, of said information. I further
                                            agree that the Broker shall not be held liable for any errors, omissions, or
                                            misrepresentations in passing on any information that it has received in good
                                            faith from any business owners and/or other selling clients, and that it is my
                                            responsibility to verify all information. I further agree to indemnify and hold
                                            Broker and its employees, agents, and representatives harmless from and against
                                            any claims for damages resulting from any errors, omissions, or
                                            misrepresentations of the seller or other sources of information regarding any
                                            business.</p>

                                        <p class="nda_para">5. That should I enter into an agreement to purchase a business
                                            that was introduced to me by the Broker, I grant to seller the right to obtain,
                                            through standard reporting agencies, financial and credit information concerning
                                            myself or the affiliates I represent and understand that this information will
                                            be held confidential by the seller and Broker and will only be used for the
                                            seller extending credit to me.</p>

                                        <p class="nda_para">6. That all correspondence, inquiries, offers to purchase and
                                            negotiations relating to the purchase or lease of any business presented to me
                                            or affiliates will be conducted exclusively through Broker. I acknowledge that
                                            the Broker has supplied me with a valuable service and if I purchase any
                                            business which was supplied by Broker with an attempt to exclude Broker, or
                                            interfere with the Broker's contractual right to a commission from the sale of a
                                            business, or if I receive any interest in the assets of the business in any
                                            shape, manner, or form, regardless of the name, legal capacity, or form of the
                                            transferee of the assets or title to the business, without the broker being
                                            paid, I shall be personally liable to the Broker for a commission equal to up to
                                            ten percent (10%) of the total contract price or a minimum of $15,000, whichever
                                            is greater (including non-cash consideration, if any) plus reasonable attorney's
                                            fees and costs of suit.</p>

                                        <p class="nda_para">7. I will not enter into any negotiations for the purchase of
                                            any businesses to which the Broker has introduced me without Broker. For a
                                            period of one year after we cease to use Broker's services, I will also not
                                            enter into any negotiations for the purchase of any businesses to which Broker
                                            or any agents of the Broker has introduced to me.</p>

                                        <p class="nda_para">8. That if I decline to pursue the acquisition of any
                                            business/assets/properties Broker has for sale, for whatever reason, I will
                                            return all original documents received by Broker and I shall remain bound by the
                                            terms of this confidentiality agreement and furthermore, I will not discuss any
                                            information received by Broker with any outside parties.</p>

                                        <p class="nda_para">9. In the event, I violate any of the terms of this Agreement,
                                            the Broker shall be entitled to recover reasonable attorney's fees and cost of
                                            suit.</p>

                                        <p class="nda_para">10. This Agreement shall be interpreted and enforced under the
                                            laws of the State of New Jersey. The parties hereby consent to jurisdiction in
                                            the State of New Jersey and agree that the sole and exclusive forum for
                                            litigating any issue arising out of this Agreement shall be the Superior Court
                                            of the State of New Jersey. In the event the suit is instituted with regard to
                                            any issue arising out of this Agreement, the parties agree to a non-jury trial.
                                        </p>

                                        <p class="fw-bold">ALL OF THE INFORMATION MUST BE COMPLETED IN ORDER TO OBTAIN
                                            INFORMATION ON BUSINESS (ES).</p>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="full_name" name="full_name"
                                                    class="form-control form-control-lg" placeholder="Full Name"
                                                    value="{{ session('buyerData.full_name') ?? old('full_name') }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="nda_business_interest"
                                                    name="nda_business_interest" class="form-control form-control-lg"
                                                    placeholder="Business Interest"
                                                    value="{{ session('buyerData.nda_business_interest') ?? old('nda_business_interest') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-12">
                                            <div class="mb-3">
                                                <input type="text" id="home_address" name="home_address"
                                                    class="form-control form-control-lg" placeholder="Home Address Zip"
                                                    value="{{ session('buyerData.home_address') ?? old('home_address') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="nda_cell_phone" name="nda_cell_phone"
                                                    class="form-control form-control-lg" placeholder="Cell Phone"
                                                    value="{{ session('buyerData.nda_cell_phone') ?? old('nda_cell_phone') }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="email" id="nda_email" name="nda_email"
                                                    class="form-control form-control-lg" placeholder="E-Mail"
                                                    value="{{ session('buyerData.nda_email') ?? old('nda_email') }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="signature-section-title">
                                        <strong>Electronic Signature</strong>
                                        <span>Please select one of the options below.</span>
                                    </div>

                                    <div class="signature-options">
                                        <label>
                                            <input type="radio" name="signature_type_option" value="draw"
                                                {{ old('signature_type', session('buyerData.signature_type', 'draw')) == 'draw' ? 'checked' : '' }}>
                                            Draw Signature
                                        </label>

                                        <label>
                                            <input type="radio" name="signature_type_option" value="type"
                                                {{ old('signature_type', session('buyerData.signature_type')) == 'type' ? 'checked' : '' }}>
                                            Type Signature
                                        </label>
                                    </div>

                                    <input type="hidden" name="signature_type" id="signature_type"
                                        value="{{ old('signature_type', session('buyerData.signature_type', 'draw')) }}">

                                    <input type="hidden" name="signature" id="signature"
                                        value="{{ session('buyerData.signature') ?? old('signature') }}">

                                    <div id="draw-signature-section">
                                        <div class="mb-3 below">
                                            <canvas id="signature-pad" class="signature-pad"
                                                style="border:1px solid #B3B3B3;" width="525" height="200"></canvas>


                                            <div class="signature-actions">

                                                <button type="button" id="clear-btn"
                                                    class="signature-btn signature-btn-clear">
                                                    <i class="fas fa-eraser"></i>
                                                    Clear
                                                </button>

                                                <button type="button" id="set-btn"
                                                    class="signature-btn signature-btn-set">
                                                    <i class="fas fa-check"></i>
                                                    Use Signature
                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                    <div id="typed-signature-section" style="display:none;">
                                        <input type="text" name="typed_signature" id="typed_signature"
                                            class="form-control form-control-lg"
                                            placeholder="Type your full name as your signature"
                                            value="{{ old('typed_signature', session('buyerData.typed_signature')) }}">
                                    </div>
                                </div>
                            @endif
                            @if (session('step', 1) == 2)
                                <div class="form-multi-tab">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="first_name" name="first_name"
                                                    class="form-control form-control-lg" placeholder="First Name"
                                                    value="{{ session('buyerData.first_name') ?? old('first_name') }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="last_name" name="last_name"
                                                    class="form-control form-control-lg" placeholder="Last Name"
                                                    value="{{ session('buyerData.last_name') ?? old('last_name') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg" id="agent" name="agent"
                                                    {{ $uniqueAgID ? 'disabled' : '' }}>
                                                    <option value="" selected>Select Agent</option>
                                                    @foreach ($agents as $key => $agent)
                                                        <option value="{{ $agent->AgentID }}"
                                                            {{ old('agent') == $agent->AgentID ||
                                                            session('buyerData.agent') == $agent->AgentID ||
                                                            $uniqueAgID == $agent->AgentID
                                                                ? 'selected'
                                                                : '' }}>
                                                            {{ $agent->FName }}
                                                            {{ $agent->LName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('agent')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            @if (request()->query('agent_id'))
                                                <input type="hidden" name="agent" value="{{ $uniqueAgID }}">
                                            @endif
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <input type="text" id="mailling_address" name="address"
                                            class="form-control form-control-lg" placeholder="Mailing Address"
                                            value="{{ session('buyerData.home_address') ?? old('home_address') }}" />
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="cityTown" name="city"
                                                    class="form-control form-control-lg" placeholder="City/Town"
                                                    value="{{ session('buyerData.city') ?? old('city') }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg" id="state" name="state">
                                                    <option value="" selected="">Select state</option>
                                                    @foreach ($states as $key => $value)
                                                        <option value="{{ $value->State }}"
                                                            {{ old('state') == $value->State || session('buyerData.state') == $value->State ? 'selected' : '' }}>
                                                            {{ $value->StateName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg" id="county" name="county">
                                                    <option value="" selected="">Select county</option>
                                                    @foreach ($counties as $key => $country)
                                                        <option value="{{ $country->County }}"
                                                            {{ old('county') == $country->County || session('buyerData.county') == $country->County ? 'selected' : '' }}>
                                                            {{ $country->County }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" id="zip" name="zip"
                                                    class="form-control form-control-lg" placeholder="Zip Code"
                                                    value="{{ session('buyerData.zip') ?? old('zip') }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12 col-md-12">
                                            <div class="mb-3">
                                                <input type="email" id="email" name="email"
                                                    class="form-control form-control-lg" placeholder="Email Address"
                                                    value="{{ session('buyerData.nda_email') ?? old('nda_email') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="valid_email">You must enter a valid email address to activate your
                                            account.</p>
                                        <p class="mb-4"><a href="#" class="sellorgive">We will never sell or give
                                                your email address away.</a></p>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg" id="callWhen" name="callWhen">
                                            <option selected disabled>Best Time to Contact</option>
                                            <option value="9:00 am - 11:00 pm"
                                                {{ old('callWhen') == '9:00 am - 11:00 pm' || session('buyerData.callWhen') == '9:00 am - 11:00 pm' ? 'selected' : '' }}>
                                                9:00 am - 11:00 pm</option>
                                            <option value="11:00 am - 2:00 pm"
                                                {{ old('callWhen') == '11:00 am - 2:00 pm' || session('buyerData.callWhen') == '11:00 am - 2:00 pm' ? 'selected' : '' }}>
                                                11:00 am - 2:00 pm</option>
                                            <option value="2:00 pm - 5:00 pm"
                                                {{ old('callWhen') == '2:00 pm - 5:00 pm' || session('buyerData.callWhen') == '2:00 pm - 5:00 pm' ? 'selected' : '' }}>
                                                2:00 pm - 5:00 pm</option>
                                            <option value="After 5:00 pm"
                                                {{ old('callWhen') == 'After 5:00 pm' || session('buyerData.callWhen') == 'After 5:00 pm' ? 'selected' : '' }}>
                                                After 5:00 pm</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if (session('step', 1) == 3)
                                <div class="form-multi-tab">
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-12 mb-3 interest_business">
                                            <div class="form-group">
                                                <label class="form-label" for="motivation">I am a buyer interested in this
                                                    type of business:</label>
                                                <div class="d-flex justify-content-between">
                                                    <div class="custom-radio">
                                                        <input type="radio" id="business_interest1"
                                                            name="business_interest" value="existing business"
                                                            {{ old('business_interest', session('buyerData.TypeBus')) == 'existing business' ? 'checked' : '' }}>
                                                        <label class="form-label" for="business_interest1">Existing
                                                            Business:</label>
                                                    </div>
                                                    <div class="custom-radio">

                                                        <input type="radio" id="business_interest2"
                                                            name="business_interest" value="a startup business"
                                                            {{ old('business_interest', session('buyerData.TypeBus')) == 'a startup business' ? 'checked' : '' }}>
                                                        <label class="form-label"
                                                            for="business_interest2">Start-up:</label>
                                                    </div>
                                                    <div class="custom-radio">

                                                        <input type="radio" id="business_interest3"
                                                            name="business_interest" value="a franchise"
                                                            {{ old('business_interest', session('buyerData.TypeBus')) == 'a franchise' ? 'checked' : '' }}>
                                                        <label class="form-label"
                                                            for="business_interest3">Franchise:</label>
                                                    </div>
                                                    <div class="custom-radio">

                                                        <input type="radio" id="business_interest4"
                                                            name="business_interest" value="a merger or aquisition">
                                                        <label class="form-label" for="business_interest4">Mergers and
                                                            Acquisitions:</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-8 mb-3 interest">
                                            <div class="form-group">
                                                <label class="form-label" for="readyToBuy">When will you be ready to
                                                    buy?</label>
                                                <div class="d-flex justify-content-between">
                                                    <div class="custom-radio">
                                                        <input type="radio" id="readyToBuy1" name="Interest"
                                                            value="1"
                                                            {{ old('Interest', session('buyerData.Interest')) == 1 ? 'checked' : '' }}>
                                                        <label class="form-label" for="readyToBuy1">Now:</label>
                                                    </div>
                                                    <div class="custom-radio">

                                                        <input type="radio" id="readyToBuy2" name="Interest"
                                                            value="2"
                                                            {{ old('Interest', session('buyerData.Interest')) == 2 ? 'checked' : '' }}>
                                                        <label class="form-label" for="readyToBuy2">Within 6
                                                            months:</label>
                                                    </div>
                                                    <div class="custom-radio">

                                                        <input type="radio" id="readyToBuy3" name="Interest"
                                                            value="3"
                                                            {{ old('Interest', session('buyerData.Interest')) == 3 ? 'checked' : '' }}>
                                                        <label class="form-label" for="readyToBuy3">Within a year:</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busCategory1" class="form-select form-select-lg"
                                                name="bus_category1">
                                                <option value="" selected="">Select Bus. Category</option>
                                                @foreach ($categoryData as $key => $data)
                                                    <option value="{{ $data->CategoryID }}"
                                                        {{ old('bus_category1', session('buyerData.BusCategory1')) == $data->CategoryID ? 'selected' : '' }}>
                                                        {{ $data->BusinessCategory }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bus_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busType1" class="form-select form-select-lg" name="bus_type1"
                                                disabled>
                                                <option value="" selected>Select Bus.Type</option>
                                                @foreach ($sub_categories as $key => $bus_type)
                                                    <option value="{{ $bus_type->SubCatID }}"
                                                        {{ old('bus_type1', session('buyerData.BusType1')) == $bus_type->SubCatID ? 'selected' : '' }}>
                                                        {{ $bus_type->SubCategory }}</option>
                                                @endforeach
                                            </select>
                                            @error('bus_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busCategory2" class="form-select form-select-lg"
                                                name="bus_category2">
                                                <option value="" selected="">Select Bus. Category</option>
                                                @foreach ($categoryData as $key => $data)
                                                    <option value="{{ $data->CategoryID }}"
                                                        {{ old('bus_category2', session('buyerData.BusCategory2')) == $data->CategoryID ? 'selected' : '' }}>
                                                        {{ $data->BusinessCategory }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bus_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busType2" class="form-select form-select-lg" name="bus_type2"
                                                disabled>
                                                <option value="" selected>Select Bus.Type</option>
                                                @foreach ($sub_categories as $key => $bus_type)
                                                    <option value="{{ $bus_type->SubCatID }}"
                                                        {{ old('bus_type2', session('buyerData.BusType2')) == $bus_type->SubCatID ? 'selected' : '' }}>
                                                        {{ $bus_type->SubCategory }}</option>
                                                @endforeach
                                            </select>
                                            @error('bus_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-6 mb-3">

                                            <select id="busCategory3" class="form-select form-select-lg"
                                                name="bus_category3">
                                                <option value="" selected="">Select Bus. Category</option>
                                                @foreach ($categoryData as $key => $data)
                                                    <option value="{{ $data->CategoryID }}"
                                                        {{ old('bus_category3', session('buyerData.BusCategory3')) == $data->CategoryID ? 'selected' : '' }}>
                                                        {{ $data->BusinessCategory }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bus_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busType3" class="form-select form-select-lg" name="bus_type3"
                                                disabled>
                                                <option value="" selected>Select Bus.Type</option>
                                                @foreach ($sub_categories as $key => $bus_type)
                                                    <option value="{{ $bus_type->SubCatID }}"
                                                        {{ old('bus_type3', session('buyerData.BusType3')) == $bus_type->SubCatID ? 'selected' : '' }}>
                                                        {{ $bus_type->SubCategory }}</option>
                                                @endforeach
                                            </select>
                                            @error('bus_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busCategory4" class="form-select form-select-lg"
                                                name="bus_category4">
                                                <option value="" selected="">Select Bus. Category</option>
                                                @foreach ($categoryData as $key => $data)
                                                    <option value="{{ $data->CategoryID }}"
                                                        {{ old('bus_category4', session('buyerData.BusCategory4')) == $data->CategoryID ? 'selected' : '' }}>
                                                        {{ $data->BusinessCategory }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bus_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <select id="busType4" class="form-select form-select-lg" name="bus_type4"
                                                disabled>
                                                <option value="" selected>Select Bus.Type</option>
                                                @foreach ($sub_categories as $key => $bus_type)
                                                    <option value="{{ $bus_type->SubCatID }}"
                                                        {{ old('bus_type4', session('buyerData.BusType4')) == $bus_type->SubCatID ? 'selected' : '' }}>
                                                        {{ $bus_type->SubCategory }}</option>
                                                @endforeach
                                            </select>
                                            @error('bus_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-12 mb-3">
                                            <input type="text" class="form-control form-control-lg"
                                                id="desiredLocation" name="desiredLocation"
                                                placeholder="Preferred City/Town"
                                                value="{{ session('buyerData.BusLocation') ?? old('desiredLocation') }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-6 mb-3">
                                            <select class="form-select form-select-lg" id="desiredCounty1"
                                                name="desiredCounty1">
                                                <option value="">Select County 1</option>
                                                @foreach ($counties as $key => $country)
                                                    <option value="{{ $country->County }}"
                                                        {{ old('desiredCounty1', session('buyerData.BusCounty1')) == $country->County ? 'selected' : '' }}>
                                                        {{ $country->County }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6  mb-3">
                                            <select class="form-select form-select-lg" id="desiredCounty2"
                                                name="desiredCounty2">
                                                <option value="">Select County 2</option>
                                                @foreach ($counties as $key => $country)
                                                    <option value="{{ $country->County }}"
                                                        {{ old('desiredCounty2', session('buyerData.BusCounty2')) == $country->County ? 'selected' : '' }}>
                                                        {{ $country->County }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <select class="form-select form-select-lg" id="desiredCounty3"
                                                name="desiredCounty3">
                                                <option value="">Select County 3</option>
                                                @foreach ($counties as $key => $country)
                                                    <option value="{{ $country->County }}"
                                                        {{ old('desiredCounty3', session('buyerData.BusCounty3')) == $country->County ? 'selected' : '' }}>
                                                        {{ $country->County }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <select class="form-select form-select-lg" id="desiredCounty4"
                                                name="desiredCounty4">
                                                <option value="">Select County 4</option>
                                                @foreach ($counties as $key => $country)
                                                    <option value="{{ $country->County }}"
                                                        {{ old('desiredCounty4', session('buyerData.BusCounty4')) == $country->County ? 'selected' : '' }}>
                                                        {{ $country->County }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <h6 class="form-sec mb-3">Financial Information</h6>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg" id="netWorth"
                                                name="netWorth"
                                                value="{{ session('buyerData.NetWorth') ?? old('netWorth') }}"
                                                placeholder="Net Worth">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg" id="cashAvailable"
                                                name="cashAvailable"
                                                value="{{ session('buyerData.CashAvailable') ?? old('cashAvailable') }}"
                                                placeholder="Cash Available for Down Payment">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <h6 class="form-sec mb-3">Investment Price Range</h6>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg"
                                                id="priceRangeMinimum" name="priceRangeMinimum"
                                                value="{{ session('buyerData.PPMin') ?? old('priceRangeMinimum') }}"
                                                placeholder="Minimum">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg"
                                                id="priceRangeMaximum" name="priceRangeMaximum"
                                                value="{{ session('buyerData.PPMax') ?? old('priceRangeMaximum') }}"
                                                placeholder="Maximum">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <h6 class="form-sec mb-3">Sales Volume</h6>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg"
                                                id="salesVolumeMinimum" name="salesVolumeMinimum"
                                                value="{{ session('buyerData.VolMin') ?? old('salesVolumeMinimum') }}"
                                                placeholder="Minimum">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg"
                                                id="salesVolumeMaximum" name="salesVolumeMaximum"
                                                value="{{ session('buyerData.VolMax') ?? old('salesVolumeMaximum') }}"
                                                placeholder="Maximum">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <h6 class="form-sec mb-3">Amount of Net Income Required</h6>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg"
                                                id="netIncomeMinimum" name="netIncomeMinimum"
                                                value="{{ session('buyerData.NetProfMin') ?? old('netIncomeMinimum') }}"
                                                placeholder="Minimum">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="number" class="form-control form-control-lg"
                                                id="netIncomeMaximum" name="netIncomeMaximum"
                                                value="{{ session('buyerData.NetProfMax') ?? old('netIncomeMaximum') }}"
                                                placeholder="Maximum">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label" for="comments">Comments</label>
                                            <textarea class="form-control form-control-lg" id="comments" name="comments" rows="5">{{ session('buyerData.Comments') ?? old('comments') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="pt-1 mt-1 d-flex justify-content-center align-items-center"
                                style="overflow:auto; flex-direction: row; gap: 10px;">

                                @if (session('step', 1) > 1)
                                    <button type="button" name="previous" class="btn bg-5a102a text-white btn-block"
                                        id="prevBtn" style="height: 50px; width: 35%;">Previous</button>
                                @endif


                                <button type="submit" name="next" class="btn bg-5a102a text-white btn-block"
                                    id="nextBtn" style="height: 50px; width: 35%;">
                                    <span class="btn-text">{{ session('step', 1) < 3 ? 'Next' : 'Submit' }}</span>
                                    <span class="btn-loading d-none">Submitting...</span>
                                </button>

                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-lg-5 mt-0 register_ebb">

                    <p class="mb-4 notice">EBB's listings are available free to everyone who uses our site. To view the
                        detailed information, which is confidential in nature, we will ask you to sign a confidentiality
                        agreement when you register.</p>

                </div>
            </div>
        </div>
    </div>
    <style>
        /* =========================================================
                       EBB REGISTRATION - BASE LAYOUT
                       ========================================================= */

        .content-box-ebb {
            background: #ffffff;
            padding: 30px;
            margin-top: 20px;
            border: 1px solid #e8ebef;
            border-radius: 12px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, 0.08);
        }

        .RegisterWithEbb {
            width: 100%;
        }

        .column-divider {
            border-right: 1px solid #e5e7eb;
            padding-right: 35px;
        }

        .register_ebb {
            padding-left: 35px;
        }

        .register_ebb .notice {
            color: #5d6570;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        /* =========================================================
                       PAGE HEADING
                       ========================================================= */

        .client_login {
            color: #252b33;
            font-size: 24px;
            font-weight: 600 !important;
        }

        .an_account {
            color: #6b7280 !important;
            font-size: 13px;
        }

        .buyer_program {
            color: #8f1d4d;
            text-decoration: none;
            font-weight: 500;
        }

        .buyer_program:hover {
            color: #74163e;
            text-decoration: underline;
        }

        /* =========================================================
                       STEP PROGRESS
                       ========================================================= */

        .ebb-step-progress {
            display: flex;
            align-items: center;
            width: 100%;
            margin: 0 0 28px;
            padding: 16px 18px;
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .ebb-step-item {
            display: flex;
            align-items: center;
            gap: 9px;
            flex: 0 0 auto;
            opacity: 0.45;
        }

        .ebb-step-item.active {
            opacity: 1;
        }

        .ebb-step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 50%;
            background: #f1f3f5;
            border: 1px solid #d7dce2;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
        }

        .ebb-step-item.active .ebb-step-number {
            background: #8f1d4d;
            border-color: #8f1d4d;
            color: #ffffff;
        }

        .ebb-step-label {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }

        .ebb-step-label strong {
            color: #252b33;
            font-size: 12px;
            font-weight: 600;
        }

        .ebb-step-label small {
            margin-top: 2px;
            color: #8a919c;
            font-size: 10px;
        }

        .ebb-step-line {
            height: 1px;
            flex: 1 1 auto;
            min-width: 25px;
            margin: 0 14px;
            background: #dfe3e8;
        }

        /* =========================================================
                       AGREEMENT
                       ========================================================= */

        .agreement-container {
            padding: 22px 24px;
            margin-bottom: 24px;
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #8f1d4d;
            border-radius: 9px;
        }

        .agreement-container h5 {
            color: #252b33;
            font-size: 17px;
            line-height: 1.4;
        }

        p.nda_para {
            margin-bottom: 13px;
            color: #555d68;
            font-size: 14px;
            line-height: 1.7;
        }

        .agreement-container .fw-bold {
            color: #5a102a;
            font-size: 13px;
            line-height: 1.5;
        }

        /* =========================================================
                       FORM FIELDS
                       ========================================================= */

        #registerEbb .form-control,
        #registerEbb .form-select,
        #registerEbb textarea {
            min-height: 50px;
            border: 1px solid #222222;
            border-radius: 7px;
            background-color: #ffffff;
            color: #222222;
            box-shadow: none;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        #registerEbb .form-control::placeholder {
            color: #777777 !important;
            opacity: 1;
        }

        #registerEbb .form-control:focus,
        #registerEbb .form-select:focus,
        #registerEbb textarea:focus {
            background-color: #ffffff !important;
            border-color: #8b1e4d !important;
            color: #222222 !important;
            box-shadow: 0 0 0 3px rgba(139, 30, 77, 0.10) !important;
            outline: none !important;
        }

        #registerEbb .form-control:hover,
        #registerEbb .form-select:hover,
        #registerEbb textarea:hover {
            border-color: #999999 !important;
        }

        #registerEbb input[type="text"],
        #registerEbb input[type="email"],
        #registerEbb input[type="tel"],
        #registerEbb input[type="number"] {
            background-color: #ffffff !important;
            color: #222222 !important;
        }

        #registerEbb select,
        #registerEbb .form-select {
            color: #333333 !important;
            cursor: pointer;
        }

        #registerEbb select option,
        #registerEbb .form-select option {
            color: #333333;
            background: #ffffff;
        }

        #registerEbb select option[value=""],
        #registerEbb .form-select option[value=""] {
            color: #8a919c;
        }

        #registerEbb input:disabled,
        #registerEbb select:disabled,
        #registerEbb textarea:disabled {
            background-color: #eeeeee !important;
            color: #777777 !important;
            border-color: #cccccc !important;
            opacity: 0.7 !important;
            cursor: not-allowed;
        }

        .form-sec {
            position: relative;
            margin: 12px 0 18px;
            padding-bottom: 9px;
            color: #252b33;
            font-size: 15px;
            font-weight: 600;
            border-bottom: 1px solid #e8ebef;
        }

        .form-sec::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 55px;
            height: 2px;
            background: #8f1d4d;
        }

        .valid_email {
            margin-bottom: 5px;
            color: #5f6874;
            font-size: 12px;
        }

        .sellorgive {
            color: #8f1d4d;
            font-size: 12px;
            text-decoration: none;
        }

        .sellorgive:hover {
            text-decoration: underline;
        }

        /* =========================================================
                       RADIO / QUESTION SECTIONS
                       ========================================================= */

        .interest_business,
        .interest {
            padding: 18px;
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
        }

        .interest_business .form-label,
        .interest .form-label {
            color: #3f4650;
            font-size: 13px;
        }

        .custom-radio {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* =========================================================
                       SIGNATURE
                       ========================================================= */

        #signature-pad {
            display: block;
            width: 525px !important;
            height: 200px !important;
            background: #ffffff;
            border: 1px solid #cfd5dc !important;
            border-radius: 6px;
            cursor: crosshair;
            pointer-events: auto;
        }

        .signature-section-title {
            margin: 8px 0 12px;
        }

        .signature-section-title strong {
            display: block;
            color: #252b33;
            font-size: 15px;
            font-weight: 600;
        }

        .signature-section-title span {
            display: block;
            margin-top: 3px;
            color: #8a919c;
            font-size: 12px;
        }

        .signature-options {
            display: flex;
            gap: 12px;
            margin: 10px 0 16px;
        }

        .signature-options label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 150px;
            padding: 11px 15px;
            border: 1px solid #dfe3e8;
            border-radius: 7px;
            background: #ffffff;
            color: #4b5563;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s ease;
        }

        .signature-options label:hover {
            border-color: #9ca3af;
            background: #fafafa;
        }

        .signature-options input[type="radio"] {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #8f1d4d;
            cursor: pointer;
        }

        #draw-signature-section,
        #typed-signature-section {
            padding: 16px;
            background: #fafafa;
            border: 1px solid #e1e5ea;
            border-radius: 9px;
        }

        #draw-signature-section .below {
            width: 100%;
            margin: 0;
        }

        .signature-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            padding: 12px 17px 0;
        }

        .signature-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 82px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s ease;
        }

        .signature-btn i {
            margin-right: 5px;
        }

        .signature-btn-clear {
            background: #ffffff;
            color: #4b5563;
        }

        .signature-btn-clear:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .signature-btn-set {
            background: #1f2937;
            border-color: #1f2937;
            color: #ffffff;
        }

        .signature-btn-set:hover {
            background: #111827;
            border-color: #111827;
        }

        #typed_signature {
            background: #ffffff;
        }

        /* =========================================================
                       NAVIGATION
                       ========================================================= */

        #registerEbb .form-navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            overflow: auto;
        }

        #registerEbb #prevBtn,
        #registerEbb #nextBtn {
            height: 50px !important;
            width: 35% !important;
            border-radius: 5px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: none !important;
            transition: all .2s ease;
        }

        #registerEbb #prevBtn {
            background: #ffffff !important;
            color: #5a102a !important;
            border: 1px solid #d8dce2 !important;
        }

        #registerEbb #prevBtn:hover {
            background: #f8f8f8 !important;
            border-color: #5a102a !important;
            transform: translateY(-1px);
        }

        #registerEbb #nextBtn {
            background: #8f1d4d !important;
            color: #ffffff !important;
            border: 1px solid #8f1d4d !important;
        }

        #registerEbb #nextBtn:hover {
            background: #74163e !important;
            border-color: #74163e !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(143, 29, 77, .15) !important;
        }

        #registerEbb #nextBtn:active,
        #registerEbb #prevBtn:active {
            transform: translateY(0);
        }

        #registerEbb #nextBtn:focus,
        #registerEbb #prevBtn:focus {
            outline: none !important;
        }

        /* =========================================================
                       VALIDATION / ERROR
                       ========================================================= */

        #registerEbb label.error {
            display: block;
            margin-top: 5px;
            color: #dc3545;
            font-size: 12px;
        }

        #registerEbb .form-control.error,
        #registerEbb .form-select.error {
            border-color: #dc3545 !important;
        }

        .ebb-error-alert {
            display: flex;
            align-items: center;
            width: 100%;
            margin: 0 0 18px;
            padding: 13px 16px;
            box-sizing: border-box;
            border: 1px solid #f3b4b4;
            border-radius: 9px;
            background: #fff7f7;
            color: #7f1d1d;
            box-shadow: 0 3px 12px rgba(127, 29, 29, .06);
            position: relative;
            animation: ebbErrorIn .25s ease-out;
        }

        .ebb-error-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            margin-right: 12px;
            border-radius: 50%;
            background: #fee2e2;
            color: #dc2626;
            font-size: 14px;
        }

        .ebb-error-content {
            min-width: 0;
            padding-right: 30px;
        }

        .ebb-error-title {
            margin-bottom: 2px;
            color: #991b1b;
            font-size: 12px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .ebb-error-message {
            color: #7f1d1d;
            font-size: 13px;
            line-height: 1.5;
            font-weight: 500;
        }

        .ebb-error-close {
            position: absolute;
            top: 50%;
            right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            padding: 0;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: #991b1b;
            font-size: 13px;
            cursor: pointer;
            transform: translateY(-50%);
            transition: all .2s ease;
        }

        .ebb-error-close:hover {
            background: #fee2e2;
            color: #7f1d1d;
        }

        @keyframes ebbErrorIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================================
                       RESPONSIVE FORM LAYOUT
                       Signature canvas intentionally remains fixed at 525 x 200.
                       ========================================================= */

        @media (max-width: 991.98px) {
            .column-divider {
                border-right: 0;
                padding-right: 15px;
            }

            .register_ebb {
                padding-left: 15px;
            }

            .ebb-step-label small {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .content-box-ebb {
                padding: 18px;
            }

            .ebb-step-progress {
                padding: 12px;
            }

            .ebb-step-label strong {
                font-size: 10px;
            }

            .ebb-step-line {
                min-width: 12px;
                margin: 0 7px;
            }

            .ebb-step-number {
                width: 30px;
                height: 30px;
                flex-basis: 30px;
                font-size: 11px;
            }

            .signature-options {
                flex-direction: column;
            }

            .signature-options label {
                width: 100%;
            }

            /* Keep signature pad fixed as requested. */
            #signature-pad {
                width: 525px !important;
                height: 200px !important;
            }

            #registerEbb .form-navigation {
                gap: 8px;
            }

            #registerEbb #prevBtn,
            #registerEbb #nextBtn {
                width: 35% !important;
                min-width: 120px;
            }

            .ebb-error-alert {
                align-items: flex-start;
                padding: 12px 14px;
            }

            .ebb-error-icon {
                width: 30px;
                height: 30px;
                flex-basis: 30px;
                margin-right: 10px;
            }

            .ebb-error-title {
                font-size: 11px;
            }

            .ebb-error-message {
                font-size: 12px;
            }

            .ebb-error-close {
                right: 8px;
            }
        }
    </style>

    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeButton = document.getElementById('ebb-error-close');
            const errorAlert = document.getElementById('alert-danger');

            if (closeButton && errorAlert) {
                closeButton.addEventListener('click', function() {
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transform = 'translateY(-5px)';

                    setTimeout(function() {
                        errorAlert.remove();
                    }, 200);
                });
            }
        });
        $(document).on('change', 'input[name="signature_type_option"]', function() {
            const type = $(this).val();

            $('#signature_type').val(type);

            // Switching signature type always starts with a fresh signature.
            $('#signature').val('');
            $('#typed_signature').val('');

            // Reuse the existing Clear button so the current SignaturePad
            // implementation remains unchanged.
            $('#clear-btn').trigger('click');

            if (type === 'type') {
                $('#draw-signature-section').hide();
                $('#typed-signature-section').show();
            } else {
                $('#draw-signature-section').show();
                $('#typed-signature-section').hide();
            }
        });

        $(document).on('input', '#typed_signature', function() {
            if ($('#signature_type').val() === 'type') {
                $('#signature').val($(this).val().trim());
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("regex", function(value, element, regexpr) {
                return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
            }, "Invalid phone number format.");

            $.validator.addMethod("validEmail", function(value, element) {
                if (this.optional(element)) {
                    return true;
                }

                value = $.trim(value);

                if (value.length > 254) {
                    return false;
                }

                if (/\s/.test(value)) {
                    return false;
                }

                if (value.indexOf('..') !== -1) {
                    return false;
                }

                var emailRegex =
                    /^[A-Za-z0-9.!#$%&'*+/=?^_`{|}~-]+@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?)+$/;

            if (!emailRegex.test(value)) {
                return false;
            }

            var parts = value.split('@');

            if (parts.length !== 2) {
                return false;
            }

            var localPart = parts[0];
            var domain = parts[1];

            if (localPart.length > 64) {
                return false;
            }

            if (domain.length > 253) {
                return false;
            }

            if (domain.indexOf('.') === -1) {
                return false;
            }

            if (domain.startsWith('.') || domain.endsWith('.')) {
                return false;
            }

            if (localPart.startsWith('.') || localPart.endsWith('.')) {
                return false;
            }

            return true;
        }, "Please enter a valid email address.");

        /*  $.validator.addMethod("canvasNotEmpty", function(value, element) {
             var canvas = document.getElementById('signature-pad');
             var context = canvas.getContext('2d');
             var canvasData = context.getImageData(0, 0, canvas.width, canvas.height);
             var isCanvasEmpty = true;

             // Check if there is any non-transparent pixel on the canvas
             for (var i = 0; i < canvasData.data.length; i += 4) {
                 if (canvasData.data[i + 3] !== 0) { // alpha channel not zero (pixel not transparent)
                     isCanvasEmpty = false;
                     break;
                 }
             }

             return !isCanvasEmpty; // Returns true if canvas is not empty
         }, "Please provide your signature."); */

        $.validator.addMethod("canvasNotEmpty", function(value, element) {

            if ($('#signature_type').val() === 'type') {
                return $('#typed_signature').val().trim().length > 0;
            }

            var canvas = document.getElementById('signature-pad');

            if (!canvas) {
                return false;
            }

            var context = canvas.getContext('2d');

            var canvasData = context.getImageData(
                0,
                0,
                canvas.width,
                canvas.height
            );

            for (var i = 0; i < canvasData.data.length; i += 4) {

                if (canvasData.data[i + 3] !== 0) {
                    return true;
                }
            }

            return false;

        }, "Please provide your signature.");
        var form = $('#registerEbb');
        form.validate({
            rules: {
                full_name: {
                    required: true
                },
                nda_business_interest: {
                    required: true
                },
                home_address: {
                    required: true
                },
                nda_cell_phone: {
                    required: true,
                    regex: /^\d{10}$/
                },
                nda_email: {
                    required: true,
                    validEmail: true
                },
                email: {
                    required: true,
                    validEmail: true
                },
                first_name: {
                    required: true
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                zip: {
                    required: true,
                    minlength: 5, // Minimum length for US ZIP code
                    maxlength: 10 // Maximum length for 9-digit ZIP code
                },
                county: {
                    required: true
                },
                bus_category1: {
                    required: true
                },
                bus_type1: {
                    required: true
                },
                desiredLocation: {
                    required: true
                },
                desiredCounty1: {
                    required: true
                },
                cashAvailable: {
                    required: true
                },
                priceRangeMinimum: {
                    required: true
                },
                priceRangeMaximum: {
                    required: true
                },
                netIncomeMinimum: {
                    required: true
                },
                signature_type: {
                    required: true
                },

                typed_signature: {
                    required: function() {
                        return $('#signature_type').val() === 'type';
                    },
                    minlength: 2
                },
                signature: {
                    canvasNotEmpty: true
                }

            },
            ignore: ":disabled",
            messages: {
                home_phone: {
                    required: 'Phone number is required.',
                    regex: 'Must be a valid phone number.'
                },
                business_phone: {
                    regex: 'Must be a valid phone number.'
                },
                nda_email: {
                    required: 'Please enter your email address.',
                    validEmail: 'Please enter a valid email address.'
                },

                email: {
                    required: 'Please enter your email address.',
                    validEmail: 'Please enter a valid email address.'
                },

                typed_signature: {
                    required: '',
                    minlength: 'Please enter at least 2 characters.'
                },
                signature: {
                    required: 'Please provide your signature.'
                }
            },
            errorPlacement: function(error, element) {
                // Place the error messages directly under the respective fields
                if (element.attr("name") == "business_interest") {
                    error.appendTo(element.closest(
                        ".interest_business")); // Put the error after the field
                } else if (element.attr("name") == "Interest") {
                    error.appendTo(element.closest(".interest")); // Put the error after the field
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            submitHandler: function(form, event) {

                let currentStep = $('#currentStep').val();
                let clickedBtn = $(document.activeElement).attr('name');

                console.log("Step:", currentStep);
                console.log("Clicked:", clickedBtn);


                if (clickedBtn === 'previous') {
                    HTMLFormElement.prototype.submit.call(form);
                    return false;
                }


                if (currentStep == 1 && clickedBtn === 'next') {

                    grecaptcha.ready(function() {
                        grecaptcha.execute(
                            "{{ config('services.recaptcha.site_key') }}", {
                                action: 'step1'
                            }).then(function(token) {

                            $('#recaptcha_token').val(token);
                            $('#action_type').val('next'); // track action

                            HTMLFormElement.prototype.submit.call(form);
                        });
                    });

                    return false;
                }
                if (currentStep == 3 && clickedBtn === 'next') {

                    let $btn = $('button[name="next"]');

                    // Prevent double click
                    if ($btn.hasClass('processing')) {
                        return false;
                    }

                    // Add processing state
                    $btn.addClass('processing');
                    $btn.prop('disabled', true);

                    // Change button UI
                    $btn.html(
                        `
                                                                                                                                                                                                                                            <span class="spinner-border spinner-border-sm"></span>
                                                                                                                                                                                                                                            Processing...
                                                                                                                                                                                                                                        `
                        );

                        // Optional: disable all buttons
                        $('button').prop('disabled', true);

                        // Submit form
                        HTMLFormElement.prototype.submit.call(form);

                        return false;
                    }

                    HTMLFormElement.prototype.submit.call(form);
                }
            });
            $('#prevBtn').on('click', function(e) {
                e.preventDefault();

                if ($('#action_type').length === 0) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'action_type',
                        name: 'action_type',
                        value: 'previous'
                    }).appendTo(form);
                } else {
                    $('#action_type').val('previous');
                }

                HTMLFormElement.prototype.submit.call(form[0]);
            });
            // Handle the Set button click
            $('#set-btn').on('click', function(event) {
                if ($('#signature').valid()) {
                    // If form is valid, submit it
                    //$('#registerEbb').submit();
                } else {
                    // Prevent submission if canvas is empty
                    event.preventDefault();
                }
            });
            const today = new Date().toISOString().split('T')[0];

            const dateField = document.getElementById('nda_form_date');

            if (dateField) {
                dateField.value = today;
                dateField.max = today;
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#busCategory1').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace(
                            '__ID__', id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#busType1').empty(); // Clear existing options
                            document.getElementById('busType1').disabled = false;
                            $('#busType1').append(
                                '<option value="">Select an option</option>'
                            ); // Add default option
                            $.each(data, function(key, value) {
                                $('#busType1').append('<option value="' + value
                                    .SubCatID + '">' + value.SubCategory +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#second-dropdown').empty().append('<option value="">Select an option</option>');
                }
            });
            $('#busCategory2').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace(
                            '__ID__', id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#busType2').empty(); // Clear existing options
                            document.getElementById('busType2').disabled = false;
                            $('#busType2').append(
                                '<option value="">Select an option</option>'
                            ); // Add default option
                            $.each(data, function(key, value) {
                                $('#busType2').append('<option value="' + value
                                    .SubCatID + '">' + value.SubCategory +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#second-dropdown').empty().append('<option value="">Select an option</option>');
                }
            });
            $('#busCategory3').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace(
                            '__ID__', id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#busType3').empty(); // Clear existing options
                            document.getElementById('busType3').disabled = false;
                            $('#busType3').append(
                                '<option value="">Select an option</option>'
                            ); // Add default option
                            $.each(data, function(key, value) {
                                $('#busType3').append('<option value="' + value
                                    .SubCatID + '">' + value.SubCategory +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#second-dropdown').empty().append('<option value="">Select an option</option>');
                }
            });
            $('#busCategory4').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace(
                            '__ID__', id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#busType4').empty(); // Clear existing options
                            document.getElementById('busType4').disabled = false;
                            $('#busType4').append(
                                '<option value="">Select an option</option>'
                            ); // Add default option
                            $.each(data, function(key, value) {
                                $('#busType4').append('<option value="' + value
                                    .SubCatID + '">' + value.SubCategory +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#second-dropdown').empty().append('<option value="">Select an option</option>');
                }
            });
        });
    </script>

    <script type="module">
        import SignaturePad from 'https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.min.js';

        document.addEventListener("DOMContentLoaded", function() {

            const canvas = document.getElementById("signature-pad");
            const signatureData = document.getElementById("signature");

            if (!canvas || !signatureData) {
                return;
            }

            const signaturePad = new SignaturePad(canvas);

            const clearButton = document.getElementById("clear-btn");
            const setButton = document.getElementById("set-btn");
            if (clearButton) {

                clearButton.addEventListener("click", function() {

                    signaturePad.clear();

                    signatureData.value = '';

                });
            }
            if (setButton) {

                setButton.addEventListener("click", function(event) {

                    event.preventDefault();

                    if (!signaturePad.isEmpty()) {

                        const signatureValue = signaturePad.toDataURL();

                        document.getElementById("signature").value = signatureValue;

                        document.getElementById("signature_type").value = 'draw';

                    }

                });
            }
            const savedSignature = signatureData.value;

            if (
                savedSignature &&
                savedSignature.startsWith('data:image')
            ) {

                const img = new Image();

                img.onload = function() {

                    const ctx = canvas.getContext('2d');

                    ctx.clearRect(
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );

                    ctx.drawImage(
                        img,
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );
                };

                img.src = savedSignature;
            }
            const currentSignatureType =
                document.getElementById('signature_type').value;

            if (currentSignatureType === 'type') {

                $('#draw-signature-section').hide();
                $('#typed-signature-section').show();

            } else {

                $('#draw-signature-section').show();
                $('#typed-signature-section').hide();

            }
            $('#registerEbb').on('click', '#nextBtn', function() {

                if ($('#signature_type').val() === 'draw') {

                    if (!signaturePad.isEmpty()) {

                        $('#signature').val(
                            signaturePad.toDataURL()
                        );
                    }

                } else {

                    $('#signature').val(
                        $('#typed_signature').val().trim()
                    );
                }

            });

        });
    </script>

@endsection
