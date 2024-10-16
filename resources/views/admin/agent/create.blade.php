@extends('admin.layout.master')
@section('content')
@if(Session::has('success_message'))
        <div class="alert alert-success alert-block" id="alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ Session::get('success_message') }}</strong>
        </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="page-title mb-3">Agent Register</h5>

                        <form action="{{ route('register.agent') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="agentId">Agent Id</label>
                                        <input type="text" placeholder="" id="agent_id" class="form-control" name="agent_id"
                                        required>
                                        @if ($errors->has('agent_id'))
                                        <span class="text-danger">{{ $errors->first('agent_id') }}</span>
                                        @endif
                                     </div>
                                </div>
                                <div class="col-md-4">
                                     <div class="form-group mb-3">
                                        <label for="firstName">First name</label>
                                        <input type="text" placeholder="" id="first_name" class="form-control"
                                            name="first_name" required>
                                        @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                     <div class="form-group mb-3">
                                        <label for="lastName">Last name</label>
                                        <input type="text" placeholder="" id="last_name" class="form-control"
                                            name="last_name" required>
                                        @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="agentAddress">Address</label>
                                        <input type="text" placeholder="" id="address" class="form-control"
                                            name="address">
                                        @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="agentCity">City</label>
                                        <input type="text" placeholder="" id="city" class="form-control"
                                            name="city" >
                                        @if ($errors->has('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="agentState">State</label>
                                        <select name="state" id="state"  class="form-control">
                                            <option value="AB">AB</option>
AB                                          <option value="AB">AB</option>
                                            <option value="AB">AB</option>
                                            <option value="AB">AB</option>
                                            <option value="AB">AB</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="agentDob">Date of birth</label>
                                        <input type="text" placeholder="" id="dob" class="form-control"
                                            name="dob" required>
                                        @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="agentHomephone">Home phone</label>
                                        <input type="text" placeholder="" id="home_phone" class="form-control"
                                            name="home_phone" required>
                                        @if ($errors->has('home_phone'))
                                        <span class="text-danger">{{ $errors->first('home_phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                        <label for="agentFax">Fax</label>
                                        <input type="text" placeholder="Fax" id="fax" class="form-control"
                                            name="fax">
                                        @if ($errors->has('fax'))
                                        <span class="text-danger">{{ $errors->first('fax') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group mb-3">
                                        <label for="agentEmail">Email</label>
                                        <input type="text" placeholder="Email" id="email" class="form-control"
                                            name="email" required>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group mb-3">
                                        <label for="agentComment">Comment</label>
                                        <input type="text" placeholder="Comment" id="comment" class="form-control"
                                            name="comment">
                                        @if ($errors->has('comment'))
                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                <div class="form-check form-group">
                                    <input class="form-check-input" type="checkbox" value="0" id="agentSpouse" name="spouse" onclick="changeSpouseValue()">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Spouse
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                <label for="agentSSnumber">SS Number</label>
                                        <input type="text" placeholder="" id="ss_number" class="form-control"
                                            name="ss_number">
                                        @if ($errors->has('ss_number'))
                                        <span class="text-danger">{{ $errors->first('ss_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group mb-3">
                                        <label for="agentCellular">Cellular</label>
                                        <input type="text" placeholder="" id="cellular" class="form-control"
                                            name="cellular">
                                        @if ($errors->has('cellular'))
                                        <span class="text-danger">{{ $errors->first('cellular') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group mb-3">
                                        <label for="agentPager">Pager</label>
                                        <input type="text" placeholder="" id="pager" class="form-control"
                                            name="pager">
                                        @if ($errors->has('pager'))
                                        <span class="text-danger">{{ $errors->first('pager') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="agentHiredate">Hire date</label>
                                        <input type="text" placeholder="" id="hire_date" class="form-control"
                                            name="hire_date">
                                        @if ($errors->has('hire_date'))
                                        <span class="text-danger">{{ $errors->first('hire_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="agentTerminateddate">Terminated</label>
                                        <input type="text" placeholder="" id="terminate_date" class="form-control"
                                            name="terminate_date">
                                        @if ($errors->has('terminate_date'))
                                        <span class="text-danger">{{ $errors->first('terminate_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                             </div>
                            <div class="col-md-12">
                                <div class="d-grid mx-auto agentSignup">
                                    <button type="submit" class="btn agentBtn">Sign up</button>
                                </div>
                            </div>
                        </form>

                    </div>
            </div>
@endsection
