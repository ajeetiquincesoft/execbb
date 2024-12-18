<!-- Navbar & Hero Start -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">
                <img src="Group 220.png" alt="Logo" style="height: 50px;">
            </a> -->
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ asset('assets/images/main_logo.png') }}" alt="Logo" class="logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="buyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Buy a Business
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="buyDropdown">
                        <li><a class="dropdown-item" href="{{route('ebb.buyers')}}">Buyers</a></li>
                        <li><a class="dropdown-item" href="{{route('register.ebb.buyer')}}">Register with EBB</a></li>
                        <li><a class="dropdown-item" href="{{route('buyer.tools')}}">Tools</a></li>
                        <li><a class="dropdown-item" href="#">Resources</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sellDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sell a Business
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="sellDropdown">
                        <li><a class="dropdown-item" href="{{route('seller')}}">Sellers</a></li>
                        <li><a class="dropdown-item" href="#">Consultation</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="#">Business Planning</a></li>
                        <li><a class="dropdown-item" href="#">Legal Assistance</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="agentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Business Agent
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="agentDropdown">
                        <li><a class="dropdown-item" href="#">Agent Directory</a></li>
                        <li><a class="dropdown-item" href="#">Join Us</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <!-- <div>
                    <a href="#" class=" me-2">Sign In</a>
                    <a href="#" class="">join</a>
                </div> -->
            <div class="custom-links">
                <a href="{{route('login')}}" class="me-2">Sign In</a>
                <a href="{{route('register.ebb.buyer')}}">Join</a>
            </div>

        </div>
    </div>
</nav>
</div>
<!-- Navbar & Hero End -->