@extends('master.master')

@section('title')
    Manage Sub Category
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
                    <h4 class="card-title mb-4">Create New Sub Category</h4>
                    <hr/>
                    <form action="{{ route('subCategory-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <select name="category_id" id="" class="form-control">
                                    <option value="" disabled selected>-----Selected-----</option>
                                    @foreach($categoris as $categori)
                                        <option value="{{ $categori->id }}">{{ $categori->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Sub Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="horizontal-firstname-input" placeholder="Category Name"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Sub Category Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="horizontal-email-input" placeholder="Category Description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Sub Category Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" id="horizontal-password-input"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Public Status</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label">Publish</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="status" type="radio" value="0">
                                    <label class="form-check-label">Unpublished</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Create New Sub Category</button>
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

                    <h4 class="card-title">All Category Info Here</h4>
                    <hr/>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead class="text-center">
                        <tr>
                            <th>SL NO</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($subCategorys as $subCategory)
                            <tr>
                                <td>{{ $subCategory->id }}</td>
                                <td>{{ $subCategory->category->name }}</td>
                                <td>{{ $subCategory->name }}</td>
                                <td>{!! $subCategory->description !!}</td>
                                <td>
                                    <img src="{{ isset($subCategory->image) ? asset($subCategory->image) : asset('all/dummy.jpg') }}" alt="" class="img-thumbnail" height="80" width="80"/>
                                </td>
                                <td>
                                    <button class="{{$subCategory->status == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm'}}">{{$subCategory->status == 1 ? 'Publish' : 'Unpublished'}}</button>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('update-subCategory-status', ['id' => $subCategory->id]) }}" class="btn {{ $subCategory->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                        <i class="{{ $subCategory->status == 1 ? 'fas fa-arrow-alt-circle-up' : 'fas fa-arrow-alt-circle-down' }}"></i>
                                    </a>
                                    <a href="{{ route('edit-subCategory', ['id' => $subCategory->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteSubCategory{{ $subCategory->id }}').submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form action="{{ route('delete-subCategory', ['id' => $subCategory->id]) }}" method="POST" id="deleteSubCategory{{ $subCategory->id }}">
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
