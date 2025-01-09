 <!-- FOOTER -->

 <!-- Newsletter Section -->
 <div class="container-fluid-footer">
     <div class="container form-sec" style="z-index: 999;">
         <div class="row newsletter">
             <div class="col-lg-4">
                 <div class="our_subscribe">
                     <h4>Subscribe</h4>
                     <h4>to our Newsletter</h4>
                 </div>
             </div>
             <div class="col-lg-8">
                 @if ($errors->any())
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     @foreach ($errors->all() as $error)
                     <strong>Error!</strong>{{ $error }}
                     @endforeach
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 @endif
                 <form action="{{route('newsletter.subscribe')}}" method="post" class="subscribe-form">
                     @csrf
                     <input type="email" name="email" id="email" class="form-control" placeholder="Your Email Address">
                     <button type="submit">Subscribe Now</button>
                     <div class="newserror"></div>
                 </form>
             </div>
         </div>
     </div>
 </div>



 <!-- Footer Section -->
 <footer class="footer">
     <div class="container main-sec">
         <div class="row">
             <!-- Logo & Address -->
             <div class="col-12 col-md-6 col-lg-4 mb-4 mb-md-0">
                 <img src="{{ asset('assets/images/footer_logo_220.png') }}" alt="Logo" class="footer-logo">
                 <p>2583 Morris Avenue Union,<br>New Jersey 07083</p>
                 <p>T: 908.851.9040 | F: 908.851.9066</p>
             </div>

             <!-- Sellers Section -->
             <div class="col-12 col-md-6 col-lg-2 mb-4 mb-md-0">
                 <h4>Sellers</h4>
                 <ul class="list-unstyled">
                     <!-- <li><a href="#">Selling a Business</a></li> -->
                     <li><a href="{{route('seller.register.with.ebb')}}">Register with EBB</a></li>
                     <li><a href="{{route('seller.tools')}}">Tools</a></li>
                     <li><a href="{{route('seller.resource')}}">Resources</a></li>
                 </ul>
             </div>

             <!-- Buyers Section -->
             <div class="col-12 col-md-6 col-lg-2 mb-4 mb-md-0">
                 <h4>Buyers</h4>
                 <ul class="list-unstyled">
                     <li><a href="{{route('register.ebb.buyer')}}">Register with EBB</a></li>
                     <li><a href="{{route('preferred.buyers.program')}}">Proffered Buyers Program</a></li>
                     <li><a href="{{route('buyer.tools')}}">Tools</a></li>
                     <li><a href="{{route('buyer.resource')}}">Resources</a></li>
                 </ul>
             </div>

             <!-- About EBB Section -->
             <div class="col-12 col-md-6 col-lg-2 mb-4 mb-md-0">
                 <h4>About EBB</h4>
                 <ul class="list-unstyled">
                     <li><a href="{{route('company')}}">Company</a></li>
                     <li><a href="{{route('management')}}">Management</a></li>
                     <li><a href="{{route('why.ebb')}}">Why EBB</a></li>
                     <li><a href="{{route('success.stories')}}">Success Stories</a></li>
                     <li><a href="{{route('all.brokers')}}">Broker Profiles</a></li>
                     <li><a href="{{route('join.ebb')}}">Join EBB</a></li>
                     <li><a href="{{route('strategic.alliances')}}">Strategic Alliance</a></li>
                     <li><a href="{{route('faqs')}}">FAQs</a></li>
                     <li><a href="{{route('terms.of.use')}}">Teams of Use</a></li>
                     <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                 </ul>
             </div>

             <!-- Quick Links Section -->
             <div class="col-12 col-md-6 col-lg-2 mb-4 mb-md-0">
                 <h4>Quick Links</h4>
                 <ul class="list-unstyled">
                     <!-- <li><a href="#">Resources</a></li> -->
                     <li><a href="{{route('faqs')}}">FAQs</a></li>
                     <!--  <li><a href="#">Blog/News</a></li> -->
                 </ul>
             </div>
         </div>
         <hr class="footer-line">
         <div class="row g-4 align-items-center">
             <div class="col-md-12 text-center mb-md-0">
                 <span class="text-white copyrights">Copyrights {{ date('Y') }} Executive Business Brokers. All Rights Reserved.</span>
             </div>
         </div>

     </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
         $(document).ready(function() {
             var form = $('.subscribe-form');
             form.validate({
                 rules: {
                     email: {
                         required: true,
                         email: true
                     }

                 },
                 messages: {},
                 errorPlacement: function(error, element) {
                     // Place the error messages directly under the respective fields
                     if (element.attr("name") == "email") {
                         error.appendTo(element.closest(".subscribe-form").find(".newserror"));
                         // Put the error after the email field
                     } else {
                         error.insertAfter(element); // Default placement for other fields
                     }
                 },
                 submitHandler: function(form) {
                     /* form.submit(); */
                     var email = $('#email').val();
                     Swal.fire({
                         title: 'Processing...',
                         text: 'Please wait while we process your subscription.',
                         showConfirmButton: false,
                         allowOutsideClick: false, // Prevent closing the alert while the AJAX is running
                         didOpen: () => {
                             Swal.showLoading(); // Show the default loading spinner
                         }
                     });
                     $.ajax({
                         url: "{{ route('newsletter.subscribe') }}", // Make sure to update the route
                         type: 'POST',
                         data: {
                             _token: "{{ csrf_token() }}", // CSRF token
                             email: email
                         },
                         success: function(response) {
                             if (response.success) {
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'Subscribed!',
                                     text: response.message,
                                 });
                                 $('#email').val(''); // Clear the email input field after success
                             } else {
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'Error',
                                     text: response.message,
                                 });
                             }
                         },
                         error: function(xhr) {
                             // Handle validation errors from the server
                             if (xhr.responseJSON && xhr.responseJSON.errors) {
                                 var errorMessages = '';

                                 // Loop through errors and display them
                                 $.each(xhr.responseJSON.errors, function(key, value) {
                                     errorMessages += value[0] + '<br>'; // Concatenate error messages
                                 });

                                 Swal.fire({
                                     icon: 'error',
                                     title: 'Errors',
                                     html: errorMessages,
                                     showConfirmButton: true,
                                     confirmButtonText: 'Try Again',
                                     customClass: {
                                         confirmButton: 'custom-confirm-btn' // Use your custom class here
                                     }
                                 });

                             } else {
                                 // Show a generic error if AJAX fails due to other issues
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'Something went wrong',
                                     text: 'Please try again later.',
                                 });
                             }
                         }
                     });
                 }
             });
         });
     </script>
     <style>
         /* Add this CSS to style the SweetAlert confirm button */
         .swal2-styled.swal2-confirm {
             background-color: #7F2149 !important;

         }

         .custom-confirm-btn:hover {
             background-color: #7F2149;
             /* Darker Red on Hover */
         }
     </style>
 </footer>