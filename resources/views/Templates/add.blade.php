@extends('layouts.app')
@section('title', 'Image Processing')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Image
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard.dashboard') }}" class="text-muted text-hover-primary">
                                    Home </a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Processing </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl">
                    <div class="row d-flex">
                        <div class="col-lg-6 col-xl-6 col-md-6 mx-auto" id="image_upload" style="display: block">
                            <div class="file-uploader-wrapper">
                                <header>Design Upload</header>
                                <form id="form_upload_file">
                                    <input class="file-input" type="file" name="file" hidden>
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="fw-bold">Browse File to Upload</p>
                                </form>
                                <section class="progress-area"></section>
                                <section class="uploaded-files-area"></section>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6" style="display: none" id="image_processing">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title mb-0">Text Implementation</div>
                                </div>
                                <div class="card-body">
                                    <form id="form_submit" data-parsley-validate="">
                                        <div class="">
                                            <div class="row mt-5">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 mb-2" style="font-weight:bold">Apply Text</label>
                                                    <input type="text" class="form-control" id="csv_text"
                                                        placeholder="Apply Text into the Image" required=""
                                                        type="text" />
                                                </div>
                                                <div class="fv-row mb-7" style="display: none">
                                                    <label for="fs-6 fw-semibold mb-2">Choose CSV File</label>
                                                    <br>
                                                    <select class="form-control" id="gettingCSV">
                                                        <option value="" selected disabled>--Choose CSV File--
                                                        </option>
                                                        @foreach ($csv_files as $csv_file)
                                                            @php
                                                                $explode_name = explode('.csv', $csv_file);
                                                            @endphp
                                                            <option value="{{ $csv_file }}">{{ $explode_name[0] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7" style="display: none" id="csv_names">
                                                    <label for="fs-6 fw-semibold mb-2">Choose Title</label>
                                                    <br>
                                                    <select class="form-control" id="getting_names">
                                                        <option value="" selected disabled>--Choose Title--</option>
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label for="fs-6 mb-2" style="font-weight: bold">Choose Font
                                                        Family</label>
                                                    <br>
                                                    <br>
                                                    <select class="form-control" id="applyFont">
                                                        <option value="" selected disabled>--Choose Font Family--
                                                        </option>
                                                        @foreach ($fontFamilies as $family)
                                                            <option value="{{ htmlspecialchars($family) }}">
                                                                {{ Str::ucfirst(htmlspecialchars($family)) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label for="fs-6 mb-2" style="font-weight: bold">Add Variants to
                                                        Fonts</label>
                                                    <br>
                                                    <br>
                                                    <select id="selectFontVariants" class="form-control" disabled>
                                                        <option value="" selected disabled>--Select Font Family
                                                            First--</option>
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label for="fs-6 mb-2" style="font-weight: bold">Choose Text
                                                        Color</label>
                                                    <br>
                                                    <img style="min-width:16px;min-height:16px;box-sizing:unset;box-shadow:none;background:unset;padding:0 6px 0 0;cursor:pointer;"
                                                        src="chrome-extension://ohcpnigalekghcmgcdcenkpelffpdolg/img/icon16.png"
                                                        title="Select with ColorPick Eyedropper - See advanced option: &quot;Add ColorPick Eyedropper near input[type=color] fields on websites&quot;"
                                                        class="colorpick-eyedropper-input-trigger">
                                                    <input class="form-control" type="color" value="#ffffff"
                                                        id="example-color-input" colorpick-eyedropper-active="true"
                                                        style="height: 45px">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label for="fs-6 mb-2" style="font-weight: bold">Text
                                                        Alignment</label>
                                                    <br>
                                                    <br>
                                                    <div class="btn-group mr-2" role="group" aria-label="..."
                                                        style="background-color:#2d3250;width:50%">
                                                        <button type="button" id="applyAlignment" value="baseline"
                                                            style="background-color:#2d3250" title="Align Left"
                                                            class="btn btn-outline-secondary btn-icon"><i
                                                                class="text-white fas fa-align-left"></i></button>
                                                        <button type="button" id="applyAlignment" value="center"
                                                            style="background-color:#2d3250" title="Align Center"
                                                            class="btn btn-outline-secondary btn-icon"><i
                                                                class="text-white fas fa-align-center"></i></button>
                                                        <button type="button" id="applyAlignment" value="end"
                                                            style="background-color:#2d3250" title="Align Right"
                                                            class="btn btn-outline-secondary btn-icon"><i
                                                                class="text-white fas fa-align-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer p-3 text-center bg-light" id="for_view_template"
                                    style="display: none">
                                    <a href="{{ url('/view_template') }}" target="__blank" class="btn"
                                        style="background-color:#2D3250;color:white">
                                        <span class="indicator-label">
                                            View Creating Template
                                        </span>
                                        <i class="fas fa-eye text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6" id="getting_preview">
                            <div class="card custom-card bg-dark">
                                <div class="card-body pt-9 pb-0" style="background-color: #2d3250">
                                    <div id="capture_preview" class="bg-dark">
                                        <div id="container" class="ui-widget-content">
                                            <div id="input">Text Here</div>
                                        </div>
                                        <img src="{{ asset('/images/gallery.png') }}" alt="Image not found"
                                            style="width:440px;height:385px;background-color:#B6BBC4" id="image">
                                    </div>
                                    <br><br>
                                </div>
                                <div class="card-footer p-3 text-center" id="preview_image"
                                    style="display: none;background-color: #2d3250;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;">
                                    <button type="submit" class="btn" id="preview"
                                        style="background-color:white;">
                                        <span class="indicator-label">
                                            Generate Template
                                        </span>
                                        <i class="fas fa-arrow-right text-dark"></i>
                                    </button>
                                </div>
                                <div class="card-footer p-3 text-center" id="edit_image"
                                    style="display: none;background-color: #2d3250;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;">
                                    <button type="submit" class="btn" id="edit"
                                        style="background-color:white;">
                                        <span class="indicator-label">
                                            Edit Template
                                        </span>
                                        <i class="fas fa-edit text-dark"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="previewImageContainer" class="bg-dark"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_footer" class="app-footer ">
                <div class="app-container  container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
                    <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2024©</span>
                        <a href="https://keenthemes.com/" target="_blank"
                            class="text-gray-800 text-hover-primary">Keenthemes</a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item"><a href="https://keenthemes.com/" target="_blank"
                                class="menu-link px-2">About</a>
                        </li>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#container").on("resize", function(event, ui) {
                var srcTag = $("#image").attr("src");
                if (srcTag.includes("gallery.png")) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Please upload a design before making changes!',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    $("#container").resizable("disable");
                    $("#container").draggable("disable");
                } else {
                    $("#container").resizable("enable");
                    $("#container").draggable("enable");
                }
            });
            $("#container").on("drag", function(event, ui) {
                var srcTag = $("#image").attr("src");
                if (srcTag.includes("gallery.png")) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Please upload a design before making changes!',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    $("#container").resizable("disable");
                    $("#container").draggable("disable");
                } else {
                    $("#container").resizable("enable");
                    $("#container").draggable("enable");
                }
            });
        });
    </script>
    <script>
        const MAX_WIDTH = $('#container').width();
        const MAX_HEIGHT = $('#container').height();
        const MAX_FONT_SIZE = 50;
        const MIN_FONT_SIZE = 12;
        const LEFT_OFFSET = 28.875;

        function onChange(e) {
            const el = e.target;
            const container = $('#container');
            const maxWidth = container.width();
            let fontSize = MAX_FONT_SIZE;
            el.style.fontSize = fontSize + 'px';
            while (fontSize > MIN_FONT_SIZE && el.scrollWidth > maxWidth) {
                fontSize--;
                el.style.fontSize = fontSize + 'px';
            }
        }

        function onLoad() {
            const container = $("#container");
            const input = $("#input");

            container.resizable({
                aspectRatio: false,
                handles: "se",
                resize: function(event, ui) {
                    onChange({
                        target: input[0]
                    });
                }
            }).draggable();

            let isDragging = false;

            container.mousedown(function() {
                isDragging = false;
            }).mousemove(function() {
                isDragging = true;
            }).mouseup(function(event) {
                if (isDragging) {
                    isDragging = false;
                    event.stopPropagation();
                    return;
                }
            });

            input.focus(function() {
                container.resizable("enable");
                container.draggable("enable");
            });

            input.blur(function() {
                container.resizable("enable");
                container.draggable("enable");
            });

            const image = $("#image");
            const imageRect = image[0].getBoundingClientRect();
            const initialLeft = (imageRect.width - MAX_WIDTH) / 2 + LEFT_OFFSET;
            const initialTop = (imageRect.height - MAX_HEIGHT) / 2;

            container.css({
                left: initialLeft + 'px',
                top: initialTop + 'px',
                width: MAX_WIDTH + 'px',
                height: MAX_HEIGHT + 'px',
            });

            input.css({
                fontSize: MAX_FONT_SIZE + 'px',
            });

            input.on('input', onChange);
            input.focus();
            onChange({
                target: input[0]
            });
        }

        window.addEventListener('load', onLoad);

        $(document).ready(function() {
            $(document).on("input", "#csv_text", function(event) {
                event.preventDefault();
                var csvText = $("#csv_text").val().replace(/(\r\n|\n|\r)/g, "");
                $("#input").html(csvText);
                $("#input").trigger("input");
            });

            $(document).on("change", "#applyFont", function(stop) {
                stop.preventDefault();
                var selectedFont = $(this).val();
                const fontLink = document.querySelector('link[href^="https://fonts.googleapis.com/css"]');
                if (fontLink) {
                    fontLink.href = `https://fonts.googleapis.com/css?family=${selectedFont}`;
                } else {
                    console.log('Font link element not found');
                }
                $("#input").css("font-family", selectedFont + ", sans-serif");
                $('#input').trigger("input");
                $.ajax({
                    url: '/getting_font_effect/' + selectedFont,
                    method: 'GET',
                    dataType: "JSON",
                    success: function(response) {
                        if (response.message == 200) {
                            $("#selectFontVariants").empty();
                            $("#selectFontVariants").prop("disabled", false);
                            $("#selectFontVariants").append(
                                "<option value='' selected disabled>--Select Font Variants--</option>"
                            );
                            var variants = [].concat.apply([], response.variants);
                            $.each(variants, function(key, value) {
                                $("#selectFontVariants").append("<option value='" +
                                    value +
                                    "' style='text-transform:capitalize' selected>" +
                                    value +
                                    "</option>");
                            });
                        } else {
                            toastr.error(
                                'Sorry! Your request to retrieve data', 'Error', {
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "progressBar": true,
                                    "enableHtml": true
                                });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching CSV data:', error);
                    }
                });
            });


            $(document).on("change", "#gettingCSV", function(stop) {
                stop.preventDefault();
                var selectedCSV = $(this).val();
                $.ajax({
                    url: '/getting_csv_data/' + selectedCSV,
                    method: 'GET',
                    success: function(response) {
                        if (response.message == 200) {
                            $("#csv_names")
                                .css({
                                    opacity: 0,
                                })
                                .slideDown("slow")
                                .animate({
                                    opacity: 1,
                                });
                            $("#csv_names").prop("required", true);
                            $("#getting_names").empty();
                            $("#getting_names").append(
                                "<option value='' selected disabled>--Select Name--</option>"
                            );
                            $.each(response.data, function(key, value) {
                                $("#getting_names").append("<option value='" + value +
                                    "'>" +
                                    value +
                                    "</option>");
                            });
                        } else {
                            toastr.error(
                                'Sorry! Your request to retrieve data from the <strong>' +
                                selectedCSV +
                                '</strong> file has failed.', 'Error', {
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "progressBar": true,
                                    "enableHtml": true
                                });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching CSV data:', error);
                    }
                });
            });

            $(document).on("change", "#getting_names", function(stop) {
                stop.preventDefault();
                var selectName = $(this).val();
                var gettingText = selectName.replace(/(\r\n|\n|\r)/g, "");
                $("#input").html(gettingText);
                $("#csv_text").val(gettingText);
                $('#input').trigger('input');
            });

            $(document).on("change", "#selectFontVariants", function(stop) {
                stop.preventDefault();
                var effect = $(this).val();
                $("#input").removeClass().addClass('box ' + effect + '-text');
                $('#input').trigger('input');
            });
            $(document).on("click", "#applyAlignment", function(stop) {
                stop.preventDefault();
                var align = $(this).val();
                $("#input").css("align-self", align);
                $('#input').trigger('input');
            });
            $(document).on("change", "#example-color-input", function(stop) {
                stop.preventDefault();
                var color = $(this).val();
                $("#input").css("color", color);
                $('#input').trigger('input');
            });

        });

        $(document).ready(function() {
            $(document).on("click", "#preview", function(stop) {
                stop.preventDefault();
                const button = $(this);
                button.html(
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..."
                );
                button.prop("disabled", true);
                createTemplate();
            });

            $(document).on("click", "#edit", function(stop) {
                stop.preventDefault();
                const button = $(this);
                button.html(
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..."
                );
                button.prop("disabled", true);
                setTimeout(function() {
                    button.html(
                        "<span class='indicator-label'>Edit Template</span> <i class='fas fa-edit text-white'></i>"
                    );
                    button.prop("disabled", false);
                    editImage();
                }, 1000);
            });
        });

        function createTemplate() {
            var containerDiv = $("#getting_preview #container");
            containerDiv.draggable("destroy").resizable("destroy");
            containerDiv.css({
                border: "none",
                userSelect: "none",
                MozUserSelect: "none",
                WebkitUserSelect: "none",
                msUserSelect: "none",
                touchAction: "none",
                cursor: "auto",
            });
            disableForm();
            captureScreenshot();
        }

        function captureScreenshot() {
            var csvValue = $("#gettingCSV").val();
            var textValue = $("#csv_text").val();
            var button = $("#preview");
            button.html(
                "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-white'></i>"
            );
            button.prop("disabled", false);
            $("#preview_image").css("display", "none");
            $("#edit_image").css("display", "block");
            if (textValue.trim() === "") {
                toastr.error('Please enter the text template title.', 'Error', {
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "progressBar": true,
                    "enableHtml": true
                });
                return;
            }
            var dataArray = [];
            if (csvValue === null && textValue !== null) {
                dataArray.push(textValue);
                processScreenshotData(dataArray);
            } else {
                var selectedCSV = csvValue;
                $.ajax({
                    url: '/getting_csv_data/' + selectedCSV,
                    method: 'GET',
                    success: function(response) {
                        if (response.message == 200) {
                            $.each(response.data, function(key, value) {
                                if (value !== undefined && Object.keys(value).length !== 0) {
                                    $.each(value, function(key, value2) {
                                        dataArray.push(value2);
                                    })
                                }
                            });
                            processScreenshotData(dataArray);
                        } else {
                            toastr.error(
                                'Sorry! Your request to retrieve data from the <strong>' +
                                selectedCSV +
                                '</strong> file has failed.', 'Error', {
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "progressBar": true,
                                    "enableHtml": true
                                });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching CSV data:', error);
                        toastr.error('Error fetching CSV data. Please try again later.', 'Error', {
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "progressBar": true,
                            "enableHtml": true
                        });
                    }
                });
            }
        }

        function processScreenshotData(dataArray) {
            if (dataArray.length === 0) {
                toastr.error('No data to process.', 'Error', {
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "progressBar": true,
                    "enableHtml": true
                });
                return;
            }

            var screenshotData = [];
            for (const text of dataArray) {
                const position = calculatePosition(text);
                screenshotData.push({
                    text: text,
                    positionX: position.x,
                    positionY: position.y,
                    imagePath: $('#image').attr('src'),
                    fontSize: position.fontSize,
                });
            }

            sendAjaxRequest(screenshotData);
        }

        function calculatePosition(text) {
            const container = $('#container');
            const input = $('#input');
            const image = $('#image');
            if (!container.length || !input.length || !image.length) {
                console.error("One or more elements not found.");
                return null;
            }
            input.text(text);
            const fontSize = parseInt(input.css('font-size'));
            if (isNaN(fontSize)) {
                console.error("Error: Unable to get font size.");
                return null;
            }
            let percentageValue = 0.3;
            if (fontSize < 20 && fontSize > 12) {
                percentageValue = 0.5;
            }
            let percentage = fontSize * percentageValue;
            input.css('line-height', fontSize - percentage + 'px');
            const containerRect = container[0].getBoundingClientRect();
            const inputRect = input[0].getBoundingClientRect();
            const imageRect = image[0].getBoundingClientRect();
            if (!containerRect || !inputRect || !imageRect) {
                console.error("Error: Unable to get element dimensions.");
                return null;
            }
            const scaleWidth = imageRect.width / image[0].naturalWidth;
            const scaleHeight = imageRect.height / image[0].naturalHeight;
            const containerPositionX = (inputRect.left - imageRect.left) / scaleWidth;
            const containerPositionY = (inputRect.top - imageRect.top) / scaleHeight;
            const scaleInputHeight = input.height();
            const originalInputHeight = scaleInputHeight * 10;
            const adjustedPositionX = containerPositionX;
            const adjustedPositionY = containerPositionY + originalInputHeight;

            input.css('line-height', fontSize + 'px');

            return {
                x: adjustedPositionX,
                y: adjustedPositionY,
                fontSize: fontSize,
                originalInputHeight: originalInputHeight,
            };
        }




        function sendAjaxRequest(dataArray) {
            var csv_file = $("#gettingCSV").val();
            var textColor = $("#example-color-input").val();
            var fontFamily = $("#applyFont").val();
            var textEffect = $("#selectFontVariants").val();
            var image_path = $("#image").attr("src");
            if (csv_file === null) {
                var csv_file_name = "";
            } else {
                var csv_file_name = csv_file + ".csv";
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/apply-text-position',
                method: 'POST',
                data: {
                    screenshotData: dataArray,
                    csv_file: csv_file_name,
                    text_color: textColor,
                    textEffect: textEffect,
                    image_path: image_path,
                    font_family: fontFamily,
                },
                success: function(response) {
                    if (response.message === 200) {
                        var button = $("#preview");
                        button.html(
                            "<span class='indicator-label'>Generate Template</span> <i class='fas fa-arrow-right text-white'></i>"
                        );
                        button.prop("disabled", false);
                        $("#preview_image").css("display", "none");
                        $("#edit_image").css("display", "block");
                        toastr.success('Thanks For Creating The Template', 'Success', {
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "progressBar": true,
                            "enableHtml": true
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    toastr.error('Error processing screenshot data. Please try again later.', 'Error', {
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "progressBar": true,
                        "enableHtml": true
                    });
                }
            });
        }

        function editImage() {
            $("#preview_image").css("display", "block");
            $("#edit_image").css("display", "none");

            var containerDiv = $("#getting_preview #container");

            const container = $("#container");
            const input = $("#input");

            container.resizable({
                aspectRatio: false,
                handles: "se",
                resize: function(event, ui) {
                    onChange({
                        target: input[0]
                    });
                }
            }).draggable();

            let isDragging = false;

            container.mousedown(function() {
                isDragging = false;
            }).mousemove(function() {
                isDragging = true;
            }).mouseup(function(event) {
                if (isDragging) {
                    isDragging = false;
                    event.stopPropagation();
                    return;
                }
            });

            input.focus(function() {
                container.resizable("enable");
                container.draggable("enable");
            });

            input.blur(function() {
                container.resizable("enable");
                container.draggable("enable");
            });

            containerDiv.css({
                border: "",
                userSelect: "",
                MozUserSelect: "",
                WebkitUserSelect: "",
                msUserSelect: "",
                touchAction: "",
                cursor: "move",
            });
            enableForm();
        }

        function disableForm() {
            var form = document.getElementById("form_submit");
            var elements = form.elements;

            for (var i = 0; i < elements.length; i++) {
                elements[i].disabled = true;
            }
        }

        function enableForm() {
            var form = document.getElementById("form_submit");
            var elements = form.elements;

            for (var i = 0; i < elements.length; i++) {
                elements[i].disabled = false;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            const $fileInput = $('.file-input');
            const $progressArea = $('.progress-area');
            const $uploadedFilesArea = $('.uploaded-files-area');
            const $uploadedImage = $('#uploaded-image');

            $('#form_upload_file').click(function(event) {
                if (event.target !== $('.file-input')[0]) {
                    $('.file-input').click();
                }
            });


            $fileInput.change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    const fileName = file.name.length >= 12 ? file.name.substring(0, 13) + "... ." + file
                        .name.split('.')[1] : file.name;
                    simulateProgressBar(fileName);
                }
            });

            function simulateProgressBar(name) {
                let progress = 0;

                const interval = setInterval(function() {
                    progress += 10;
                    if (progress <= 100) {
                        updateProgressBar(name, progress);
                    } else {
                        clearInterval(interval);
                        displayUploadedFile(name);
                    }
                }, 500);
            }

            function updateProgressBar(name, progress) {
                $progressArea.html(`
                <li class="progress-row">
                    <i class="fas fa-file-alt"></i>
                    <div class="progress-content">
                        <div class="details">
                            <span class="file-name">${name} • Uploading</span>
                            <span class="percent">${progress}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ${progress}%"></div>
                        </div>
                    </div>
                </li>`);
            }

            function displayUploadedFile(name) {
                $progressArea.html("");
                let uploadedHTML = `
                <li class="progress-row">
                    <i class="fas fa-file-alt"></i>
                    <div class="progress-content">
                        <div class="details">
                            <span class="file-name">${name} • Uploaded</span>
                        </div>
                    </div>
                    <i class="fas fa-check"></i>
                </li>`;
                $uploadedFilesArea.prepend(uploadedHTML);
                applyImageProcessing();
            }

            function applyImageProcessing() {
                const file = $fileInput[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $("#image_processing").css("display", "block");
                        $("#image_upload").css("display", "none");
                        $("#preview_image").css({
                            "display": "block",
                            "background-color": "#2d3250",
                            "border-bottom-right-radius": "8px",
                            "border-bottom-left-radius": "8px"
                        });
                        $("#image").css('background-color', 'black');
                        $("#image").attr('src', event.target.result);
                        $("#container").resizable("enable");
                        $("#container").draggable("enable");
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: 'Thanks Now You Can Make Changes According to Your Requirements!',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
@endsection
