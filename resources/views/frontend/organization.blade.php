@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Buyers</a></li>
                <li class="breadcrumb-item"><a href="#">Tool</a></li>
                <li class="breadcrumb-item active"><a href="#"> Business Organizations</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading"> Business Organizations</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-12 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Types of Business Organizations</h3>
                    <p>This information came from the <a href="https://www.nj.gov/Business.shtml" style="color: #7F2149; text-decoration: underline;" >State of New Jersey’s Web site.</a> Check with your accountant, lawyer or small business advisor for the most current information or changes to the tax law for this type of business organization.</p>

                    <p>There are three most commonly used business organizations: Sole Proprietorship, Partnership and Corporation. Here are the advantages and disadvantages of each.</p>
                    <div class="business_table">
                        <table style="width:100%">
                            <tr>
                                <th></th>
                                <th>Advantages</th>
                                <th>Disadvantages</th>
                            </tr>
                            <tr>
                                <td  style="vertical-align: top; padding-left: 10px;">
                                    <p><a href="{{route('proprietor')}}" style="color: #7F2149; text-decoration: underline;" >Sole Proprietorship</a></p>
                                </td>
                                <td>
                                    <p>- Low start-up costs</p>
                                    <p>- Greatest freedom from regulation</p>
                                    <p>- Direct control by owner</p>
                                    <p>- Minimum working capital requirements</p>
                                    <p>- Tax advantage to small owner</p>
                                    <p>- All profits to owner</p>

                                </td>
                                <td>
                                    <p>- Unlimited personal liability</p>
                                    <p>- Lack of continuity</p>
                                    <p>- More difficult to raise capital</p>
                                </td>
                            </tr>
                            <tr>
                                <td  style="vertical-align: top; padding-left: 10px;">
                                    <p><a href="{{route('partnership')}}" style="color: #7F2149; text-decoration: underline;" >Partnership</a></p>
                                </td>
                                <td>
                                    <p>- Ease of formation</p>
                                    <p>- Low start-up costs</p>
                                    <p>- Additional sources of venture capital</p>
                                    <p>- Broader management</p>
                                    <p>- Limited outside regulationr</p>
                                </td>
                                <td>
                                    <p>- Unlimited personal liability</p>
                                    <p>- Lack of continuity</p>
                                    <p>- Divided authority</p>
                                    <p>- Difficulty in raising additional capital</p>
                                    <p>- Hard to find suitable partners</p>
                                </td>
                            </tr>
                            <tr>
                                <td  style="vertical-align: top; padding-left: 10px;">
                                    <p><a href="{{route('corp')}}" style="color: #7F2149; text-decoration: underline;" >Corporation</a></p>
                                </td>
                                <td>
                                    <p>- Limited liability</p>
                                    <p>- Specialized management</p>
                                    <p>- Ownership is transferable</p>
                                    <p>- Continuous existence</p>
                                    <p>- Legal entity</p>
                                    <p>- Easier to raise capital</p>
                                    <p>- Unity of action account having centralized authority in board of directors</p>
                                </td>
                                <td>
                                    <p>- Closely regulated</p>
                                    <p>- Most expensive to organize</p>
                                    <p>- Charter restrictions</p>
                                    <p>- Extensive record-keeping necessary</p>
                                    <p>- Double taxation, except when organized as an "S Corporation"</p>
                                    <p>- Difficult to liquidate investment</p>
                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    .business_table th{
        width: 10%;
    }

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


    .section-heading {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        font-family: 'Urbanist';
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
</style>
@endsection