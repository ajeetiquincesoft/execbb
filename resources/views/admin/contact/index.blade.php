@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">Contacts</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.contact')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Contacts.png') }}"> Add Contact
                            </button></a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('all.contact') }}">
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
                            <th scope="col">Name</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @forelse($contacts as $index =>$contact)
                        <tr>
                            <td>{{ $index + 1 + ($contacts->currentPage() - 1) * $contacts->perPage() }}</td>
                            <td>{{ $contact->FName}}</td>
                            <td>{{ $contact->CompanyName}}</td>
                            <td>{{ $contact->Phone}}</td>
                            <td>{{ $contact->Email}}</td>
                            <td>{{ $contact_type[$contact->Type] ?? 'N/A' }}</td>

                            <td class="list-btn">
                                <a href="{{route('show.contact',$contact->ContactID)}}">
                                    <button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{route('edit.contact.form',$contact->ContactID)}}">
                                    <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form action="{{route('contact.destroy',$contact->ContactID)}}" method="post" class="contact_delete" id="delete-contact-{{ $contact->ContactID  }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="contactDelete('{{ $contact->ContactID}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!-- <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No contact found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection