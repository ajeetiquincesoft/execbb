@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
            <div class="row card">
                <div class="list-header">

                    <div class="container-fluid py-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <h4 class="mb-0">Listings</h4>
                            </div>
                            <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                                <a href="add-list-form.html">
                                <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                    <i class="fas fa-plus mr-1"></i> Add Listings
                                </button>
                            </a>
                            </div>
                            <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                                <div class="input-group" style="max-width: 300px;">
                                    <input type="text" class="form-control" placeholder="Search Here...">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-data">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Listing ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm " title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm " title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>132292100WP5</td>
                                    <td>Saeed Shaikh</td>
                                    <td>Rising Sun Preschool</td>
                                    <td>175 Newark Avenue</td>
                                    <td>Jersey City</td>
                                    <td>201-966-7886</td>
                                    <td>info@risingsun.com</td>
                                    <td>
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endsection