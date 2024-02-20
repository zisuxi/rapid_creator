@extends('layouts.app')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Csv
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ url('/dashbaord') }}" class="text-muted text-hover-primary">
                                    Home </a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Upload Fonts </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 mx-auto">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1"> Upload Fonts</h4>
                                </div>
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form id="form_insert"  class="row g-3 needs-validation" novalidate>
                                           @csrf
                                            <div class="col-md-12">
                                                <label class="form-label">Font Name *</label>
                                                <input type="text" name="font_name" class="form-control" id="file"
                                                    oninput="NameValidation(this)" required placeholder="Enter Font Name" />
                                                <strong class="text-danger" id="font_name"></strong>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Upload Font</label>
                                                <input type="file" name="font_file" class="form-control" id="file"
                                                    oninput="FileValidation(this)" required
                                                    title="Please Select the File First" />
                                                <strong class="text-danger" id="font_file"></strong>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                        role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                        aria-valuemax="100" style="width:0%"></div>
                                                </div>
                                                <strong class="badge text-dark d-flex justify-content-end"
                                                    id="percentage"></strong>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ url('/fonts') }}" type="submit" id="button_move"
                                                    class="btn rounded-pill btn-light text-dark waves-effect waves-light">
                                                    < Go back</a>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button
                                                    class="btn rounded-pill btn-primary waves-effect waves-light fontSubmit"
                                                    type="submit"
                                                    onclick="InsertData(this,'{{ url('/csv') }}','CSV','Upload')">Upload
                                                    Font >
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_footer" class="app-footer">
                <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2024&copy;</span>
                        <a href="https://keenthemes.com/" target="_blank"
                            class="text-gray-800 text-hover-primary">Keenthemes</a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item"><a href="https://keenthemes.com/" target="_blank"
                                class="menu-link px-2">About</a></li>
                        <li class="menu-item"><a href="https://devs.keenthemes.com/" target="_blank"
                                class="menu-link px-2">Support</a></li>
                        <li class="menu-item"><a href="https://1.envato.market/EA4JP" target="_blank"
                                class="menu-link px-2">Purchase</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function FileValidation(input) {
            var fileInput = input;
            var filePath = fileInput.value;
            var allowedExtensions = /(\.zip|\.rar|\.ttf)$/i;

            if (!allowedExtensions.exec(filePath)) {
                document.getElementById('font_file').innerHTML =
                    'Invalid file type. Please upload a file with .zip, .rar, or .ttf File.';
                fileInput.value = '';
                return false;
            } else {
                document.getElementById('font_file').innerHTML = '';
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            $(document).on("click", ".fontSubmit", function() {
                var formData = new FormData(form_insert);
                $.ajax({
                    url: "/fonts",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success:function(res) {
                        alert(res);
                    }
                })
            })
        })
    </script>
@endsection
