@extends('master.master')

@section('title')
    Update Suplier Info
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-5">
            @if($massage = Session::get('massage'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $massage }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Update Suplier Info</h4>
                    <hr/>
                    <form action="{{ route('suplier-info-update', ['id' => $suplier->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Company Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="company_name" class="form-control" id="horizontal-firstname-input" value="{{ $suplier->company_name }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-person-input" class="col-sm-3 col-form-label">Person Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="person_name" class="form-control" id="horizontal-person-input" value="{{ $suplier->person_name }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-person-input" class="col-sm-3 col-form-label">Suplier Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="code" class="form-control" id="horizontal-person-input" value="{{ $suplier->code }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-person-input" class="col-sm-3 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="mobile" class="form-control" id="horizontal-person-input" value="{{ $suplier->mobile }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-person-input" class="col-sm-3 col-form-label">Company E-mail</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" id="horizontal-person-input" value="{{ $suplier->email }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="horizontal-logo-input">Company Logo</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="logo" class="form-control" id="horizontal-logo-input"/>
                                        <img src="{{asset($suplier->logo)}}" alt="" height="80" width="100"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-person-input" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control" placeholder="Person or Company Address">{{ $suplier->address }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-account-input" class="col-sm-3 col-form-label">Account Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="account_number" class="form-control" id="horizontal-account-input" value="{{ $suplier->account_number }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label">Public Status</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" {{ $suplier->status == 1 ? 'checked' : '' }} type="radio" name="status" id="inlineRadio1" value="1">
                                            <label class="form-check-label">Publish</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="status" {{ $suplier->status == 0 ? 'checked' : '' }} type="radio" value="0">
                                            <label class="form-check-label">Unpublished</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary btn-block">Update Suplier Info</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Suplier Info Here</h4>
                    <hr/>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead class="text-center">
                        <tr>
                            <th>SL NO</th>
                            <th>Company Name</th>
                            <th>Person Name</th>
                            <th>code</th>
                            <th>Mobile Number</th>
                            <th>Company Logo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($supliers as $suplier)
                            <tr>
                                <td>{{ $suplier->id }}</td>
                                <td>{{ $suplier->company_name }}</td>
                                <td>{{ $suplier->person_name }}</td>
                                <td>{{ $suplier->code }}</td>
                                <td>{{ $suplier->mobile }}</td>
                                <td>
                                    <img src="{{ asset($suplier->logo) }}" alt="" class="img-thumbnail" height="80" width="80"/>
                                </td>
                                <td>
                                    <button class="{{$suplier->status == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm'}}">{{$suplier->status == 1 ? 'Publish' : 'Unpublished'}}</button>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('update-suplier-status', ['id' => $suplier->id]) }}" class="btn {{ $suplier->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                        <i class="{{ $suplier->status == 1 ? 'fas fa-arrow-alt-circle-up' : 'fas fa-arrow-alt-circle-down' }}"></i>
                                    </a>
                                    <a href="{{ route('edit-suplier-info', ['id' => $suplier->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteCategory').submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form action="{{ route('delete-category', ['id' => $suplier->id]) }}" method="POST" id="deleteCategory">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
