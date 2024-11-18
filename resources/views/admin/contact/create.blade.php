
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4 font-fm mb-5">
                <form action="{{ route('contact.form.process') }}" method="POST" id="contact">
                @csrf
                    <div>
                        <h1>Contacts</h1>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="type">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="" selected>Select Status</option>
                                    @foreach($contact_types as $contact_type)
                                    <option value="{{$contact_type->Type}}" {{ (old('type') == $contact_type->Type  ) ? 'selected' : '' }}>{{$contact_type->Description}}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="first_name" value="{{old('first_name')}}">
                                @error('first_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="company">Company</label>
                                <input type="text" class="form-control" id="company" name="company" value="{{old('company')}}">
                                @error('company')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="addlContact">Addl. Contact</label>
                                <input type="text" class="form-control" id="addlContact" name="addlContact" value="{{old('addlContact')}}">
                                @error('addlContact')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip" class="form-label">City</label>
                                <div class="row">
                                    <div class="col-md-5 mb-2">
                                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{old('city')}}">
                                        @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                    <div class="col-md-3 mb-2 p-0">
                                        <select id="State" class="form-select" name="contact_state">
                                            <option value="" selected="">Select state</option>
                                            @foreach($states as $key=>$value)
                                            <option value="{{$value->State}}" {{ (old('contact_state') == $value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                                            @endforeach
                                        </select>
                                            @error('contact_state')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" id="zip" class="form-control" placeholder="Zip" name="zip" value="{{old('zip')}}">
                                        @error('zip')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" value="{{old('fax')}}">
                                @error('fax')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="pager">Pager</label>
                                <input type="text" class="form-control" id="pager" name="pager" value="{{old('pager')}}">
                                @error('pager')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="comments">Comments</label>
                                <textarea class="form-control" id="comments" name="comments" rows="3">{{old('comments')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <button class="btn-primary" type="reset" id="prevBtn" onclick="resetForm()">Reset</button>
                            <button class="btn-primary" type="submit" id="nextBtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function resetForm() {
    document.getElementById("contact").reset();
    }
           $(document).ready(function () {
                // Define custom phone validation
                $.validator.addMethod("phone", function(value, element) {
                // Regex for phone validation (international and local formats)
                var phoneRegex = /^(\+?\d{1,3}[- ]?)?(\(?\d{1,4}\)?[- ]?)?[\d- ]{6,10}$/;
                return this.optional(element) || phoneRegex.test(value);
                }, "Please enter a valid phone number.");
                $('#contact').validate({
                    rules: {
                        type: {
                            required: true
                        },
                        first_name: {
                            required: true
                        },
                        company: {
                            required: true
                        },
                        addlContact: {
                            required: true
                        },
                        address: {
                            required: true
                        },
                        city: {
                            required: true
                        },
                        contact_state: {
                            required: true
                        },
                        zip: {
                            required: true
                        },
                        phone: {
                            required: true,
                            phone: true 
                        },
                        fax: {
                            required: true
                        },
                        pager: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        }
                        
                    },
                    messages: {
                        phone: {
                            required: "Please enter a phone number.",
                            pattern: "Please enter a valid phone number." 
                        },
                        email: {
                            required: "Please enter an email address.",
                            email: "Please enter a valid email address." 
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
</script>
@endsection