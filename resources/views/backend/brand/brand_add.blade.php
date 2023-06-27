@extends('admin.admin_dashboard')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Brand </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Brand
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"></div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="brand_name" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Image </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="brand_image" class="form-control" id="image"
                                                onchange="showPreview(event)" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img class="img-thumbnail" id="file-ip-1-preview"
                                                src="{{ url('upload/no_image.jpg') }}" alt="Admin"
                                                style="width:100px; height: 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-sm btn-primary px-4" value="Save Changes" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");

                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
