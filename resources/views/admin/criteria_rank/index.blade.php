@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">CriteriaRank</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.criteriarank')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                            <img class="create_img" src="{{ url('assets/images/Showings.png') }}"> Add CriteriaRank
                            </button></a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 ml-auto" id="login_activity_search">
                        <form method="GET" action="{{ route('criteriarank') }}">
                            <div class="input-group" style="max-width: 300px;">
                                <input type="text" id="search" name="query" class="form-control" placeholder="Search Here..." value="{{ request('query') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">
                                        <i class="fas fa-search"></i> 
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-data">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">BusInt</th>
                            <th scope="col">Location</th>
                            <th scope="col">Price</th>
                            <th scope="col">Down Pay</th>
                            <th scope="col">Vol</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @foreach($criterias as $index=>$criteria)
                        <tr>
                            <td>{{ $index + 1 + ($criterias->currentPage() - 1) * $criterias->perPage() }}</td>
                            <td>{{ $criteria->BusInt }}</td>
                            <td>{{ $criteria->Location }}</td>
                            <td>{{ $criteria->Price }}</td>
                            <td>{{ $criteria->DownPay }}</td>
                            <td>{{ $criteria->Vol }}</td>
                            <td>{{ $criteria->Profit }}</td>
                            <td class="list-btn">
                            <a href="{{route('edit.criteriarank',$criteria->id)}}">
                                <button class="btn btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button></a>
                            <form action="{{route('criteriarank.destroy',$criteria->id)}}" method="post" class="criteria_delete" id="delete-criteria-{{ $criteria->id  }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="criteriaDelete('{{ $criteria->id}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!-- <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $criterias->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection