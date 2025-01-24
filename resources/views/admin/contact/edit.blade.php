@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4 font-fm mb-5">
        <form action="{{ route('edit.contact.form.process', $contact->ContactID) }}" method="POST" id="contact">
            @csrf
            @method('PUT')
            <div>
                <h1>Contact</h1>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="type">Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type">
                            <option value="" selected>Select Type</option>
                            @foreach($contact_types as $contact_type)
                            <option value="{{$contact_type->Type}}" {{ ($contact->Type == $contact_type->Type  ) ? 'selected' : '' }}>{{$contact_type->Description}}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="first_name" value="{{$contact->FName}}">
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="company">Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="company" name="company" value="{{$contact->CompanyName}}">
                        @error('company')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="addlContact">Addl. Contact <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="addlContact" name="addlContact" value="{{$contact->AddRep}}">
                        @error('addlContact')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$contact->Address1}}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{$contact->City}}">
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">State <span class="text-danger">*</span></label>
                        <select id="State" class="form-select" name="contact_state">
                            <option value="" selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{ $contact->State == $value->State ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('contact_state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">Zip <span class="text-danger">*</span></label>
                        <input type="text" id="zip" class="form-control" placeholder="Zip" name="zip" value="{{$contact->Zip}}">
                        @error('zip')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$contact->Phone}}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="fax">Fax <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fax" name="fax" value="{{$contact->Fax}}">
                        @error('fax')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="pager">Pager <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pager" name="pager" value="{{$contact->Pager}}">
                        @error('pager')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$contact->Email}}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="comments">Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3">{{$contact->Comments}}</textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>

                    <button class="btn-primary" type="submit" id="nextBtn">Update</button>
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
    $(document).ready(function() {
        // Custom method for regex validation
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value);
        }, "Please check your input.");
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
                    required: true,
                    regex: /^[a-zA-Z\s]+$/
                },
                contact_state: {
                    required: true
                },
                zip: {
                    required: true
                },
                phone: {
                    required: true,
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/
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
                    required: 'Phone number is required.',
                    regex: 'Must be a valid phone number.'
                },
                email: {
                    required: "Please enter an email address.",
                    email: "Please enter a valid email address."
                },
                city: {
                    regex: 'City can only contain letters and spaces.'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#contact input').on('keyup change', function() {
            $(this).valid();
        });
    });
</script>
@endsection