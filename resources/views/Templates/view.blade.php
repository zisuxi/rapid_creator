@extends('layouts.app')
@section('title', 'Image Processing')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="modal fade" id="template_add" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content rounded">
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="fas fa-times fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <form id="form_submit" class="row g-3 needs-validation form" novalidate>
                                <div class="mb-13 text-center">
                                    <h1 class="mb-3">Add Template</h1>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Title</span>
                                    </label>
                                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                                    <input type="hidden" id="module_name" value="Template">
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Template Title" name="template_title" required />
                                    <strong class="text-danger" id="template_title"></strong>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Picture</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-125px h-125px" id="template_add_image"
                                                style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="fas fa-pencil-alt fs-7"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                <input type="file" name="template_picture" accept=".png, .jpg, .jpeg" />
                                            </label>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <strong class="text-danger" id="template_picture"></strong>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">
                                        Cancel
                                    </button>
                                    <button type="submit" id="insert" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Save Template >
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="template_update" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content rounded">
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="fas fa-times fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <form id="form_update" class="row g-3 needs-validation form" novalidate>
                                <div class="mb-13 text-center">
                                    <h1 class="mb-3">Add Template</h1>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Title</span>
                                    </label>
                                    <input type="hidden" id="id" value="{{ url('/template') }}">
                                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                                    <input type="hidden" id="module_name" value="Template">
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Template Title" name="template_title" required />
                                    <strong class="text-danger" id="template_title"></strong>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Template Picture</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-color:black;background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="fas fa-pencil-alt fs-7"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                <input type="file" name="template_picture"
                                                    accept=".png, .jpg, .jpeg" />
                                            </label>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <strong class="text-danger" id="template_picture"></strong>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">
                                        Cancel
                                    </button>
                                    <button type="submit" id="insert" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Edit Template >
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Templates
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
                                Manage Templates </li>
                        </ul>
                    </div>
                    {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#template_add">
                            + Create Template
                        </a>
                    </div> --}}
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <input type="hidden" id="get_url_view" value="{{ url('/gettingData') }}">
                    <input type="hidden" id="get_url" value="{{ url('/template') }}">
                    <input type="hidden" id="module_name" value="Template">
                    <input type="hidden" id="image_base_url" value="{{ url('uploads') }}">
                    <div class="row" id="getting_data_templates">

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
