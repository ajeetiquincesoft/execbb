@extends('frontend.layout.master')

@section('content')
<!-- Register with ebb Start -->
<div class="container py-7 container-padding">
    <div class="content-box-ebb">
        <div class="row g-5">
            <div class="col-md-12 d-flex align-items-center justify-content-center">
                <div class="text-black" style="width: 100%;">
                    <div class="d-flex pb-1">
                        <h5 class="fw-normal mb-2 m-0 client_login">Register with EBB</h5>
                    </div>
                    <p class="m-0 mb-3 an_account" style="color: #5D5D5D;">Already have an account? <a href="{{route('login')}}" class="buyer_program">Sign in here</a></p>
                </div>
            </div>
            @if(Session::has('error'))
            <div class="alert alert-danger alert-block" id="alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('error') }}</strong>
            </div>
            @endif
            <div class="col-lg-7 mt-0 column-divider">
                <div class="RegisterWithEbb mb-2">
                    <form method="POST" action="{{ route('store.register.with.ebb', request()->query()) }}" id="registerEbb">
                        @csrf
                        <input type="hidden" name="step" value="{{ session('step', 1) }}">
                        @if (session('step', 1) == 1)
                        <div class="form-multi-tab">
                            <div class="agreement-container">
                                <h5 class="fw-bold mb-2 m-0">Confidentiality & Non-Circumvention Agreement</h5>

                                <p class="nda_para">Seller requires purchaser to supply a confidentiality agreement prior to disclosing any information regarding their business. In consideration of Executive Business Brokers (hereafter the "Broker") providing the undersigned with information of businesses available for sale, I understand and agree to the following:</p>

                                <p class="nda_para">1. That any information provided on any business to me by Broker may be sensitive and confidential, and that its disclosure to others may be damaging to the described businesses and their owners.</p>

                                <p class="nda_para">2. Not to disclose any information regarding any business introduced to me by the Broker, to any other person who has not also signed and dated this Agreement. Information that is deemed confidential shall include the fact that any such business is for sale, plus any other data provided through the Broker.</p>

                                <p class="nda_para">3. Not to contact the respective business owner, employees, suppliers, landlord, competitors, or customers except through the Broker.</p>

                                <p class="nda_para">4. Any information provided to me by the Broker with respect to any business was obtained by the seller or other sources and was not verified in any way. I understand and agree that the Broker relied on the seller or such other sources for the accuracy of said information, has no knowledge of the accuracy of said information, and makes no warranty, expressed or implied, as to the accuracy of such information. Understanding that limitation, prior to entering into an agreement to purchase any business, I shall make such independent verification as I deem necessary, of said information. I further agree that the Broker shall not be held liable for any errors, omissions, or misrepresentations in passing on any information that it has received in good faith from any business owners and/or other selling clients, and that it is my responsibility to verify all information. I further agree to indemnify and hold Broker and its employees, agents, and representatives harmless from and against any claims for damages resulting from any errors, omissions, or misrepresentations of the seller or other sources of information regarding any business.</p>

                                <p class="nda_para">5. That should I enter into an agreement to purchase a business that was introduced to me by the Broker, I grant to seller the right to obtain, through standard reporting agencies, financial and credit information concerning myself or the affiliates I represent and understand that this information will be held confidential by the seller and Broker and will only be used for the seller extending credit to me.</p>

                                <p class="nda_para">6. That all correspondence, inquiries, offers to purchase and negotiations relating to the purchase or lease of any business presented to me or affiliates will be conducted exclusively through Broker. I acknowledge that the Broker has supplied me with a valuable service and if I purchase any business which was supplied by Broker with an attempt to exclude Broker, or interfere with the Broker's contractual right to a commission from the sale of a business, or if I receive any interest in the assets of the business in any shape, manner, or form, regardless of the name, legal capacity, or form of the transferee of the assets or title to the business, without the broker being paid, I shall be personally liable to the Broker for a commission equal to up to ten percent (10%) of the total contract price or a minimum of $15,000, whichever is greater (including non-cash consideration, if any) plus reasonable attorney's fees and costs of suit.</p>

                                <p class="nda_para">7. I will not enter into any negotiations for the purchase of any businesses to which the Broker has introduced me without Broker. For a period of one year after we cease to use Broker's services, I will also not enter into any negotiations for the purchase of any businesses to which Broker or any agents of the Broker has introduced to me.</p>

                                <p class="nda_para">8. That if I decline to pursue the acquisition of any business/assets/properties Broker has for sale, for whatever reason, I will return all original documents received by Broker and I shall remain bound by the terms of this confidentiality agreement and furthermore, I will not discuss any information received by Broker with any outside parties.</p>

                                <p class="nda_para">9. In the event, I violate any of the terms of this Agreement, the Broker shall be entitled to recover reasonable attorney's fees and cost of suit.</p>

                                <p class="nda_para">10. This Agreement shall be interpreted and enforced under the laws of the State of New Jersey. The parties hereby consent to jurisdiction in the State of New Jersey and agree that the sole and exclusive forum for litigating any issue arising out of this Agreement shall be the Superior Court of the State of New Jersey. In the event the suit is instituted with regard to any issue arising out of this Agreement, the parties agree to a non-jury trial.</p>

                                <p class="fw-bold">ALL OF THE INFORMATION MUST BE COMPLETED IN ORDER TO OBTAIN INFORMATION ON BUSINESS (ES).</p>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="full_name" name="full_name" class="form-control form-control-lg" placeholder="Full Name" value="{{ session('buyerData.full_name') ?? old('full_name')}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="nda_business_interest" name="nda_business_interest" class="form-control form-control-lg" placeholder="Business Interest" value="{{ session('buyerData.nda_business_interest') ?? old('nda_business_interest')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-12">
                                    <div class="mb-3">
                                        <input type="text" id="home_address" name="home_address" class="form-control form-control-lg" placeholder="Home Address Zip" value="{{ session('buyerData.home_address') ?? old('home_address')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="nda_home_phone" name="nda_home_phone" class="form-control form-control-lg" placeholder="Home Phone" value="{{ session('buyerData.nda_home_phone') ?? old('nda_home_phone')}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="nda_cell_phone" name="nda_cell_phone" class="form-control form-control-lg" placeholder="Cell Phone" value="{{ session('buyerData.nda_cell_phone') ?? old('nda_cell_phone')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="email" id="nda_email" name="nda_email" class="form-control form-control-lg" placeholder="E-Mail" value="{{ session('buyerData.nda_email') ?? old('nda_email')}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="date" id="nda_form_date" name="nda_form_date" class="form-control form-control-lg" placeholder="Date" value="{{ session('buyerData.nda_form_date') ?? old('nda_form_date')}}" max="{{ \Carbon\Carbon::now()->toDateString() }}" />
                                    </div>
                                </div>

                            </div>
                            <p>Signature</p>
                            <div class="row g-3">
                                <div class="col-12 col-md-12">
                                    <div class="mb-3 below">
                                        <canvas id="signature-pad" class="signature-pad" style="border:1px solid #B3B3B3;" width="525" height="200"></canvas>
                                        <input type="hidden" name="signature" id="signature" value="{{ session('buyerData.signature') ?? old('signature')}}">
                                        <div id="clear-btn" class="sign_btn">x</div>
                                        <div id="set-btn" class="sign_btn">✓</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif
                        @if (session('step', 1) == 2)
                        <div class="form-multi-tab">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="first_name" name="first_name" class="form-control form-control-lg" placeholder="First Name" value="{{ session('buyerData.first_name') ?? old('first_name')}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="last_name" name="last_name" class="form-control form-control-lg" placeholder="Last Name" value="{{ session('buyerData.last_name') ?? old('last_name')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">

                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg" id="agent" name="agent" {{ $uniqueAgID ? 'disabled' : '' }}>
                                            <option value="" selected>Select Agent</option>
                                            @foreach($agents as $key => $agent)
                                            <option value="{{$agent->agent_info->AgentID}}"
                                                {{ 
                    (old('agent') == $agent->agent_info->AgentID || 
                    session('buyerData.agent') == $agent->agent_info->AgentID ||
                    $uniqueAgID == $agent->agent_info->AgentID) ? 'selected' : '' 
                }}>
                                                {{$agent->agent_info->FName}} {{$agent->agent_info->LName}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('agent')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        </select>
                                    </div>
                                    @if(request()->query('agent_id'))
                                    <input type="hidden" name="agent" value="{{ $uniqueAgID }}">
                                    @endif
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="date" id="BDate" name="BDate" class="form-control form-control-lg" placeholder="BDate" value="{{ session('buyerData.BDate') ?? old('BDate')}}" max="{{ \Carbon\Carbon::now()->toDateString() }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" id="mailling_address" name="address" class="form-control form-control-lg" placeholder="Mailing Address" value="{{ session('buyerData.address') ?? old('address')}}" />
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="cityTown" name="city" class="form-control form-control-lg" placeholder="City/Town" value="{{ session('buyerData.city') ?? old('city')}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg" id="state" name="state">
                                            <option value="" selected="">Select state</option>
                                            @foreach($states as $key=>$value)
                                            <option value="{{$value->State}}" {{ (old('state') == $value->State || session('buyerData.state') == $value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
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
                                            <option value="" selected="">Select country</option>
                                            @foreach($counties as $key=>$country)
                                            <option value="{{$country->County}}" {{ (old('county') == $country->County || session('buyerData.county') == $country->County) ? 'selected' : '' }}>{{$country->County}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="zip" name="zip" class="form-control form-control-lg" placeholder="Zip Code" value="{{ session('buyerData.zip') ?? old('zip')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="home_phone" name="home_phone" class="form-control form-control-lg" placeholder="Home Phone" value="{{ session('buyerData.home_phone') ?? old('home_phone')}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" id="business_phone" name="business_phone" class="form-control form-control-lg" placeholder="Business Phone" value="{{ session('buyerData.business_phone') ?? old('business_phone')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-12">
                                    <div class="mb-3">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address" value="{{ session('buyerData.email') ?? old('email')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="valid_email">You must enter a valid email address to activate your account.</p>
                                <p class="mb-4"><a href="#" class="sellorgive">We will never sell or give your email address away.</a></p>
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-select-lg" id="callWhen" name="callWhen">
                                    <option selected disabled>Best Time to Contact</option>
                                    <option value="9:00 am - 11:00 pm" {{ (old('callWhen') == '9:00 am - 11:00 pm' || session('buyerData.callWhen') == '9:00 am - 11:00 pm') ? 'selected' : '' }}>9:00 am - 11:00 pm</option>
                                    <option value="11:00 am - 2:00 pm" {{ (old('callWhen') == '11:00 am - 2:00 pm' || session('buyerData.callWhen') == '11:00 am - 2:00 pm') ? 'selected' : '' }}>11:00 am - 2:00 pm</option>
                                    <option value="2:00 pm - 5:00 pm" {{ (old('callWhen') == '2:00 pm - 5:00 pm' || session('buyerData.callWhen') == '2:00 pm - 5:00 pm') ? 'selected' : '' }}>2:00 pm - 5:00 pm</option>
                                    <option value="After 5:00 pm" {{ (old('callWhen') == 'After 5:00 pm' || session('buyerData.callWhen') == 'After 5:00 pm') ? 'selected' : '' }}>After 5:00 pm</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        @if (session('step', 1) == 3)
                        <div class="form-multi-tab">
                            <div class="row mb-2">
                                <div class="col-12 col-md-12 mb-3 interest_business">
                                    <div class="form-group">
                                        <label class="form-label" for="motivation">I am a buyer interested in this type of business:</label>
                                        <div class="d-flex justify-content-between">
                                            <div class="custom-radio">
                                                <input type="radio" id="business_interest1" name="business_interest" value="existing business">
                                                <label class="form-label" for="business_interest1">Existing Business:</label>
                                            </div>
                                            <div class="custom-radio">

                                                <input type="radio" id="business_interest2" name="business_interest" value="a startup business">
                                                <label class="form-label" for="business_interest2">Start-up:</label>
                                            </div>
                                            <div class="custom-radio">

                                                <input type="radio" id="business_interest3" name="business_interest" value="a franchise">
                                                <label class="form-label" for="business_interest3">Franchise:</label>
                                            </div>
                                            <div class="custom-radio">

                                                <input type="radio" id="business_interest4" name="business_interest" value="a merger or aquisition">
                                                <label class="form-label" for="business_interest4">Mergers and Acquisitions:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-8 mb-3 interest">
                                    <div class="form-group">
                                        <label class="form-label" for="readyToBuy">When will you be ready to buy?</label>
                                        <div class="d-flex justify-content-between">
                                            <div class="custom-radio">
                                                <input type="radio" id="readyToBuy1" name="Interest" value="1">
                                                <label class="form-label" for="readyToBuy1">Now:</label>
                                            </div>
                                            <div class="custom-radio">

                                                <input type="radio" id="readyToBuy2" name="Interest" value="2">
                                                <label class="form-label" for="readyToBuy2">Within 6 months:</label>
                                            </div>
                                            <div class="custom-radio">

                                                <input type="radio" id="readyToBuy3" name="Interest" value="3">
                                                <label class="form-label" for="readyToBuy3">Within a year:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busCategory1" class="form-select form-select-lg" name="bus_category1">
                                        <option value="" selected="">Select Bus. Category</option>
                                        @foreach($categoryData as $key=>$data)
                                        <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_category')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busType1" class="form-select form-select-lg" name="bus_type1">
                                        <option value="" selected>Select Bus.Type</option>
                                        @foreach($sub_categories as $key=>$bus_type)
                                        <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busCategory2" class="form-select form-select-lg" name="bus_category2">
                                        <option value="" selected="">Select Bus. Category</option>
                                        @foreach($categoryData as $key=>$data)
                                        <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_category')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busType2" class="form-select form-select-lg" name="bus_type2">
                                        <option value="" selected>Select Bus.Type</option>
                                        @foreach($sub_categories as $key=>$bus_type)
                                        <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-6 mb-3">

                                    <select id="busCategory3" class="form-select form-select-lg" name="bus_category3">
                                        <option value="" selected="">Select Bus. Category</option>
                                        @foreach($categoryData as $key=>$data)
                                        <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_category')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busType3" class="form-select form-select-lg" name="bus_type3">
                                        <option value="" selected>Select Bus.Type</option>
                                        @foreach($sub_categories as $key=>$bus_type)
                                        <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busCategory4" class="form-select form-select-lg" name="bus_category4">
                                        <option value="" selected="">Select Bus. Category</option>
                                        @foreach($categoryData as $key=>$data)
                                        <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_category')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <select id="busType4" class="form-select form-select-lg" name="bus_type4">
                                        <option value="" selected>Select Bus.Type</option>
                                        @foreach($sub_categories as $key=>$bus_type)
                                        <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                        @endforeach
                                    </select>
                                    @error('bus_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-12 mb-3">
                                    <input type="text" class="form-control form-control-lg" id="desiredLocation" name="desiredLocation" placeholder="Preferred City/Town" value="" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6 mb-3">
                                    <select class="form-select form-select-lg" id="desiredCounty1" name="desiredCounty1">
                                        <option value="">Select County 1</option>
                                        @foreach($counties as $key=>$country)
                                        <option value="{{$country->County}}">{{$country->County}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6  mb-3">
                                    <select class="form-select form-select-lg" id="desiredCounty2" name="desiredCounty2">
                                        <option value="">Select County 2</option>
                                        @foreach($counties as $key=>$country)
                                        <option value="{{$country->County}}">{{$country->County}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-sm-6 mb-3">
                                    <select class="form-select form-select-lg" id="desiredCounty3" name="desiredCounty3">
                                        <option value="">Select County 3</option>
                                        @foreach($counties as $key=>$country)
                                        <option value="{{$country->County}}">{{$country->County}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <select class="form-select form-select-lg" id="desiredCounty4" name="desiredCounty4">
                                        <option value="">Select County 4</option>
                                        @foreach($counties as $key=>$country)
                                        <option value="{{$country->County}}">{{$country->County}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h6 class="form-sec mb-3">Financial Information</h6>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="netWorth" name="netWorth" value="" placeholder="Net Worth">
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="cashAvailable" name="cashAvailable" value="" placeholder="Cash Available for Down Payment">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h6 class="form-sec mb-3">Investment Price Range</h6>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="priceRangeMinimum" name="priceRangeMinimum" value="" placeholder="Minimum">
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="priceRangeMaximum" name="priceRangeMaximum" value="" placeholder="Maximum">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h6 class="form-sec mb-3">Sales Volume</h6>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="salesVolumeMinimum" name="salesVolumeMinimum" value=""
                                        placeholder="Minimum">
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="salesVolumeMaximum" name="salesVolumeMaximum" value="" placeholder="Maximum">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h6 class="form-sec mb-3">Amount of Net Income Required</h6>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="netIncomeMinimum" name="netIncomeMinimum" value="" placeholder="Minimum">
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-lg" id="netIncomeMaximum" name="netIncomeMaximum" value="" placeholder="Maximum">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-12 mb-3">
                                    <label class="form-label" for="comments">Comments</label>
                                    <textarea class="form-control form-control-lg" id="comments" name="comments" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="pt-1 mt-1 d-flex justify-content-center align-items-center" style="overflow:auto; flex-direction: row; gap: 10px;">
                            <!-- Previous button -->
                            @if (session('step', 1) > 1)
                            <button type="submit" name="previous" class="btn bg-5a102a text-white btn-block" id="prevBtn" style="height: 50px; width: 35%;">Previous</button>
                            @endif

                            <!-- Next button or Submit -->
                            <button type="submit" name="next" class="btn bg-5a102a text-white btn-block" id="nextBtn" style="height: 50px; width: 35%;">
                                {{ session('step', 1) < 3 ? 'Next' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <div class="col-lg-5 mt-0 register_ebb">
                <p class="mb-4 notice">Notice: To register, you must use Internet Explorer. Please set this site to compatibility mode.</p>
                <p class="mb-4">EBB's listings are available free to everyone who uses our site. To view the detailed information, which is confidential in nature, we will ask you to sign a confidentiality agreement when you register.</p>
                <p class="mb-4">For buyers who are aggressively looking to find a business, we recommend that you sign up for our <a href="{{route('preferred.buyers.program')}}" class="buyer_program">Preferred Buyer Program.</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Register with ebb End -->
<style>
#signature-pad {
    pointer-events: auto;
}
    .content-box-ebb {
        background-color: #FFFFFF;
        padding: 30px;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus::placeholder,
    .form-control:not(:placeholder-shown)::placeholder {
        font-size: 12px;
        transform: translateY(-10px);
        color: #007bff;
    }

    p.nda_para {
        font-size: 12px;
    }

    div#clear-btn {
    border: none;
    outline: none;
    position: absolute;
    right: 20px;
    top: 16px;
    background: transparent;
    padding: 0;
    cursor: pointer;
    }
    div#set-btn {
    border: none;
    outline: none;
    position: absolute;
    right: 16px;
    top: 40px;
    background: transparent;
    padding: 0;
    cursor: pointer;
    }
    .below {
    position: relative;
    margin-bottom: 15px;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
        }, "Invalid phone number format.");
        $.validator.addMethod("canvasNotEmpty", function(value, element) {
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
                nda_home_phone: {
                    required: true,
                    regex: /^\d{10}$/
                },
                nda_cell_phone: {
                    required: true,
                    regex: /^\d{10}$/
                },
                nda_email: {
                    required: true,
                    email: true
                },
                nda_form_date: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                agent: {
                    required: true
                },
                BDate: {
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
                home_phone: {
                    required: true,
                    regex: /^\d{10}$/
                },
                business_phone: {
                    regex: /^\d{10}$/
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
                signature: {
                    required: 'Please provide your signature.'
                }
            },
            errorPlacement: function(error, element) {
                // Place the error messages directly under the respective fields
                if (element.attr("name") == "business_interest") {
                    error.appendTo(element.closest(".interest_business")); // Put the error after the field
                } else if (element.attr("name") == "Interest") {
                    error.appendTo(element.closest(".interest")); // Put the error after the field
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            submitHandler: function(form) {
                form.submit(); // Proceed with form submission if valid
            }
        });
        $('#nextBtn').on('click', function(event) {
            if (form.valid()) {
                form.submit();
            } else {
                event.preventDefault();
            }
        });

        // Handle the Previous button click event
        $('#prevBtn').on('click', function(event) {
            form.unbind('submit');
            form.submit();
        });
        // Handle the Set button click
        $('#set-btn').on('click', function(event) {
            if ($('#registerEbb').valid()) {
                // If form is valid, submit it
                //$('#registerEbb').submit();
            } else {
                // Prevent submission if canvas is empty
                event.preventDefault();
            }
        });
        const today = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
        document.getElementById('nda_form_date').value = today;
        document.getElementById('nda_form_date').max = today;
    });
</script>

<script>
    $(document).ready(function() {
        $('#busCategory1').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType1').empty(); // Clear existing options
                        $('#busType1').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType1').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
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
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType2').empty(); // Clear existing options
                        $('#busType2').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType2').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
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
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType3').empty(); // Clear existing options
                        $('#busType3').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType3').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
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
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType4').empty(); // Clear existing options
                        $('#busType4').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType4').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
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
    // Ensure that the DOM is fully loaded before executing the script
    document.addEventListener("DOMContentLoaded", function() {
        // Get the canvas element and initialize the SignaturePad
        const canvas = document.getElementById("signature-pad");
        const signaturePad = new SignaturePad(canvas);
        const signatureData = document.getElementById("signature");

        // Clear the signature when the clear button is clicked
        document.getElementById("clear-btn").addEventListener("click", function() {
            signaturePad.clear();
            signatureData.value = '';
        });
        document.getElementById("set-btn").addEventListener("click", function(event) {
             event.preventDefault();
             if (!signaturePad.isEmpty()) {
             const signatureData = signaturePad.toDataURL();
             document.getElementById("signature").value = signatureData;
             }
         });
        const img = new Image();
        const imgUrl = $('#signature').val();
        img.src = imgUrl;
        // Once the image has loaded, draw it on the canvas
        img.onload = function() {
            const canvas = document.getElementById('signature-pad');
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        };

    });
</script>

@endsection