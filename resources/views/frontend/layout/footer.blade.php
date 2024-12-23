 <!-- FOOTER -->

 <!-- Newsletter Section -->
 <div class="container-fluid-footer">
     <div class="container form-sec" style="z-index: 999;">
         <div class="row newsletter">
             <div class="col-lg-4">
                 <h4>Subscribe</h4>
                 <h4>to our Newsletter</h4>
             </div>
             <div class="col-lg-8">
                 <form action="#" method="post" class="">
                     <input type="email" placeholder="Your Email Address" required>
                     <button type="submit">Subscribe Now</button>
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
             <div class="col-md-6 col-lg-6 col-xl-4">
                 <img src="{{ asset('assets/images/footer_logo.png') }}" alt="Logo" class="footer-logo">
                 <p>2583 Morris Avenue Union,<br>New Jersey 07083</p>
                 <p>T: 908.851.9040 | F: 908.851.9066</p>
             </div>

             <!-- Sellers Section -->
             <div class="col-md-6 col-lg-6 col-xl-2">
                 <h4>Sellers</h4>
                 <ul class="list-unstyled">
                     <li><a href="#">Selling a Business</a></li>
                     <li><a href="{{route('seller.register.with.ebb')}}">Register with EBB</a></li>
                     <li><a href="{{route('seller.tools')}}">Tools</a></li>
                     <li><a href="#">Resources</a></li>
                 </ul>
             </div>

             <!-- Buyers Section -->
             <div class="col-md-6 col-lg-6 col-xl-2">
                 <h4>Buyers</h4>
                 <ul class="list-unstyled">
                     <li><a href="{{route('register.ebb.buyer')}}">Register with EBB</a></li>
                     <li><a href="#">Proffered Buyers Program</a></li>
                     <li><a href="{{route('buyer.tools')}}">Tools</a></li>
                     <li><a href="#">Resources</a></li>
                 </ul>
             </div>

             <!-- About EBB Section -->
             <div class="col-md-6 col-lg-6 col-xl-2">
                 <h4>About EBB</h4>
                 <ul class="list-unstyled">
                     <li><a href="{{route('about.us')}}">Company</a></li>
                     <li><a href="#">Management</a></li>
                     <li><a href="#">Why EBB</a></li>
                     <li><a href="#">Success Stories</a></li>
                     <li><a href="#">Broker Profiles</a></li>
                     <li><a href="#">Join EBB</a></li>
                     <li><a href="#">Strategic Alliance</a></li>
                     <li><a href="{{route('faqs')}}">FAQs</a></li>
                     <li><a href="{{route('terms.of.use')}}">Teams of Use</a></li>
                     <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                 </ul>
             </div>

             <!-- Quick Links Section -->
             <div class="col-md-6 col-lg-6 col-xl-2">
                 <h4>Quick Links</h4>
                 <ul class="list-unstyled">
                     <li><a href="#">Resources</a></li>
                     <li><a href="{{route('faqs')}}">FAQs</a></li>
                     <li><a href="#">Blog/News</a></li>
                 </ul>
             </div>
         </div>
         <hr class="footer-line">
         <div class="row g-4 align-items-center">
             <div class="col-md-12 text-center mb-md-0">
                 <span class="text-white copyrights">Copyrights 2025 Executive Business Brokers. All Rights Reserved.</span>
             </div>
         </div>

     </div>
 </footer>