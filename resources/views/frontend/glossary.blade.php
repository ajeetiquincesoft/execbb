@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Glossary of Terms</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Glossary of Terms</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <div align="center" bis_skin_checked="1" style="margin-bottom:20px;">
                        <a href="{{ url('glossary?flag=a') }}">A</a>
                        <a href="{{ url('glossary?flag=b') }}">B</a>
                        <a href="{{ url('glossary?flag=c') }}">C</a>
                        <a href="{{ url('glossary?flag=d') }}">D</a>
                        <a href="{{ url('glossary?flag=e') }}">E</a>
                        <a href="{{ url('glossary?flag=f') }}">F</a>
                        <a href="{{ url('glossary?flag=g') }}">G</a>
                        <a href="{{ url('glossary?flag=i') }}">I</a>
                        <a href="{{ url('glossary?flag=l') }}">L</a>
                        <a href="{{ url('glossary?flag=n') }}">N</a>
                        <a href="{{ url('glossary?flag=p') }}">P</a>
                        <a href="{{ url('glossary?flag=q') }}">Q</a>
                        <a href="{{ url('glossary?flag=r') }}">R</a>
                        <a href="{{ url('glossary?flag=s') }}">S</a>
                        <a href="{{ url('glossary?flag=u') }}">U</a>
                        <a href="{{ url('glossary?flag=v') }}">V</a>
                        <a href="{{ url('glossary?flag=w') }}">W</a>
                    </div>
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
                        <tbody>
                            @foreach($glossaryTerms as $term => $definition)
                            <tr>
                                <td width="162" align="left" valign="top"><a name="{{ $term }}">{{ ucfirst($term) }}</a></td>
                                <td width="246" align="left" valign="top">{{ $definition }}<br>&nbsp;</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Become a Broker</h5>
                            <ul class="list-unstyled tips-list-join">
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> High Commissions
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Be Your Own Boss
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Set Your Own Hours
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Remotely access our Buyers & Sellers Database
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Obtain a Steady Supply of Buyer Leads
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Receive Full Training & Support Programs
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Benefit from a State-of-the-Art Facility & Technology
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Work on the Deals that Make Sense To You
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Secure Financing Through EBB</h5>
                            <p>Get the right terms and rate, work with our <a href="{{route('financing')}}" class="sellorgive" >mortgage specialists</a>.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                            <p>Become an <a href="{{route('preferred.buyers.program')}}" class="sellorgive" >EBB Preferred Buyer</a> and benefit from our full services.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>Our strength is our brokers. Learn how you can <a href="{{route('join.ebb')}}" style="color: #7F2149; text-decoration: underline;" >become part of our all-star team</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

    .content-box {
        background-color: #FFFFFF;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .main-heading {
        font-size: 20px;
        font-weight: bold;
        font-family: Urbanist;
        margin-bottom: 20px;
        color: #000;
        border-bottom: 1px solid #B3B3B3;
        padding-bottom: 30px;
        margin-left: 10px;
        margin-right: 10px;
    }

    .sub-heading {
        font-size: 18px;
        font-weight: bold;
        color: #000;
    }

    .sub-title {
        margin-bottom: 40px;
        font-family: 'Mulish';
        color: #5D5D5D;
    }

    .section-heading {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        font-family: 'Urbanist';
    }

    .side-panel {
        height: 590px;
        width: 390px;
        margin-top: 40px;
        margin-left: -80px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        border: 16px solid #F8F8F8;
    }

    .side-panel a {
        color: #7F2149;
    }

    .side-panel a:hover {
        text-decoration: underline;
    }

    .adove-logo {
        margin-top: 25px;
        display: block;
        max-width: 100%;
    }

    .ab_ebb p {
        font-size: 14px;
        color: #5D5D5D;
        line-height: 22px;
    }

    .Content-text {
        margin-right: 80px;
        font-family: 'Mulish', sans-serif;
        color: #5D5D5D;
    }

    .about_EBB {
        text-align: center;
    }

    .boxes-button-section {
        background: #FFFFFF;
        padding: 12px;
        margin-bottom: 12px;
        margin-top: 12px;
    }

    .EBB-team-title h5 {
        font-weight: bold;
        color: #806132;
        font-family: Mulish;
    }

    .EBB-team-title {
        padding-top: 16px;
        padding-left: 16px;
    }
    .EBB-team-title ul li {
    margin: 20px 0px;
    font-family: 'Mulish';
    font-size: 14px;
}
.text-purple {
    color: #7F2149;
    margin-right: 10px;
}
</style>
@endsection