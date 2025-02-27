@extends('frontend.layout.buyer-master')
@section('content')
<div class="dashboard-content">
    <h2>Welcome, {{ Auth::user()->name }}!</h2>
    <p>This is your dashboard where you can manage your orders, wishlist, and profile.</p>

    <!-- Example Dashboard Cards -->
    <div class="row">
        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-heart"></i> Favourites Listings</h5>
                    <p class="card-text">{{$favourites}} Favourites Listings</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-search"></i> Save Search</h5>
                    <p class="card-text">{{$saveSearch}} Search</p>
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

    a {
        text-decoration: none;
    }
</style>
@endsection