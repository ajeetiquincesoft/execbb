@extends('admin.layout.master')
@section('content')
<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
    <div class="next-back-page d-flex justify-content-between">
        @if ($previous)
            <a href="{{ route('show.referral', $previous->RefID) }}"><button><i class="fa fa-chevron-left"></i>Back</button></a>
        @endif

        @if ($next)
            <a href="{{ route('show.referral', $next->RefID) }}"><button>Next <i class="fa fa-chevron-right"></i></button></a>
        @endif
        
        
    </div>
</div>
<div class="container-fluid content bg-light">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="profile-info">
                <div class="text-end">
                  <a href="{{route('edit.referral',$referral->RefID)}}"><i  class="fa fa-edit edit-icon"></i></a>
                </div>
                <div class="text-center">
                <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview" width="100">
                  <h5>{{$referral->RefCompany }}</h5>
                  <h6>Contact ID: {{$referral->RefID}}</h6>
                </div>
                <div class="table-responsive">
                  <div>
                    <h6>General Info</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/company.png') }}" alt=""><span class="ml-2 fw-600">Ref Company</span></td>
                        <td class="text-end">{{ $referral->RefCompany }}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/company.png') }}" alt=""><span class="ml-2 fw-600">Broke of Rec</span></td>
                        <td class="text-end">{{ $referral->BrokOfRec }}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Agent Name</span></td>
                        <td class="text-end">{{$referral->AgentName}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                        <td class="text-end">{{$referral->Address1}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">City</span></td>
                        <td class="text-end">{{$referral->City}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                        <td class="text-end">{{$referral->Phone}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span class="ml-2 fw-600">Fax</span></td>
                        <td class="text-end">{{$referral->Fax}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Ref Fee</span></td>
                        <td class="text-end">{{$referral->RefFee}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Flat Fee</span></td>
                        <td class="text-end">{{$referral->FlatFee}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Ref Amt Paid</span></td>
                        <td class="text-end">{{$referral->RefAmt}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Ref Type</span></td>
                        <td class="text-end">{{$referral->RefType}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Ref Source</span></td>
                        <td class="text-end">{{$referral->RefSource}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Referral Status</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Status</span></td>
                        <td class="text-end"></td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Person Referred</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Name</span></td>
                        <td class="text-end">{{$referral->ReferredName}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                        <td class="text-end">{{$referral->ReferredAdd1}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">City</span></td>
                        <td class="text-end">{{$referral->ReferredCity}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                        <td class="text-end">{{$referral->ReferredPhone}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Ref Interest</span></td>
                        <td class="text-end">{{$referral->ReferredInterest}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/press_owner.png') }}" alt=""><span class="ml-2 fw-600">Ref DBA</span></td>
                        <td class="text-end">{{$referral->ReferredDBA}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <h5>Activities</h5>
            </div>
            <div class="card-body scrollable-activity">
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        function previewImage(event) {
        const preview = document.getElementById('avatar-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                $('.avatar_img_upload').show();
            }
            reader.readAsDataURL(file);
        }
       }
      
      </script>
@endsection

