<meta charset="utf-8" />
<title>{{ __('ibex | ') }} @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset("/assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-37564768-1');
</script>
<script>
    if (window.top != window.self) {
        window.top.location.replace(window.self.location.href);
    }
</script>
<style>
    #container {
        position: absolute;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        word-wrap: normal;
        border: 1px dashed white;
        background-color: transparent;
        color: black;
        font-weight: bold;
        font-size: 30px;
        /* padding: 10px; */
        cursor: move;
    }

    .ui-resizable-handle {
        color: white;
    }


    #input {
        text-align: center;
        word-wrap: normal;
        background-color: transparent;
        color: white;
        font-weight: bold;
        font-size: 30px;
        /* padding: 10px; */
        border: none;
        outline: none;
        font-family: 'Roboto', sans-serif;
        font-weight: bold
    }

    #image {
        /* margin-top: 10px; */
    }

    .italic-text {
        font-style: italic;
    }

    .bold-text {
        font-weight: bold;
    }

    .underline-text {
        text-decoration: underline;
    }

    .line-through-text {
        text-decoration: line-through;
    }

    .uppercase-text {
        text-transform: uppercase;
    }

    .lowercase-text {
        text-transform: lowercase;
    }

    .capitalize-text {
        text-transform: capitalize;
    }

    .letter-spacing-text {
        letter-spacing: 2px;
    }

    .word-spacing-text {
        word-spacing: 5px;
    }

    .text-shadow-effect {
        text-shadow: 2px 2px 4px #000000;
    }

    .small-caps-text {
        font-variant: small-caps;
    }
</style>
<style>
    .swal2-title {
        font-size: 18px !important;
    }

    .swal2-icon {
        font-size: 18px !important;
    }
</style>
<style>
    .file-uploader-wrapper {
        width: 100%;
        height: 100%;
        background: #fff;
        border-radius: 5px;
        padding: 30px;
        box-shadow: 7px 7px 12px rgba(0, 0, 0, 0.05);
    }

    .file-uploader-wrapper header {
        color: #2d3250;
        padding-top: 100px;
        font-size: 27px;
        font-weight: 600;
        text-align: center;
    }

    .file-uploader-wrapper form {
        height: 167px;
        display: flex;
        cursor: pointer;
        margin: 30px 0;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 5px;
        border: 2px dashed #2d3250;
    }

    .file-uploader-wrapper form :where(i, p) {
        color: #2d3250;
    }

    .file-uploader-wrapper form i {
        font-size: 50px;
    }

    .file-uploader-wrapper form p {
        margin-top: 15px;
        font-size: 16px;
    }

    .file-uploader-wrapper .progress-row {
        margin-bottom: 10px;
        background: #E9F0FF;
        list-style: none;
        padding: 15px 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .file-uploader-wrapper .progress-row i {
        color: #2d3250;
        font-size: 30px;
    }

    .file-uploader-wrapper .progress-row .details span {
        font-size: 14px;
    }

    .file-uploader-wrapper .progress-content {
        width: 100%;
        margin-left: 15px;
    }

    .file-uploader-wrapper .progress-content .details {
        display: flex;
        align-items: center;
        margin-bottom: 7px;
        justify-content: space-between;
    }

    .file-uploader-wrapper .progress-content .progress-bar {
        height: 6px;
        width: 100%;
        margin-bottom: 4px;
        background: #fff;
        border-radius: 30px;
    }

    .file-uploader-wrapper .progress-content .progress-bar .progress {
        height: 100%;
        width: 0%;
        background: #2d3250;
        border-radius: inherit;
    }

    .file-uploader-wrapper .uploaded-files-area {
        max-height: 232px;
        overflow-y: scroll;
    }

    .file-uploader-wrapper .uploaded-files-area.onprogress {
        max-height: 150px;
    }

    .file-uploader-wrapper .uploaded-files-area::-webkit-scrollbar {
        width: 0px;
    }

    .file-uploader-wrapper .uploaded-files-area .uploaded-row .content {
        display: flex;
        align-items: center;
    }

    .file-uploader-wrapper .uploaded-files-area .uploaded-row .details {
        display: flex;
        margin-left: 15px;
        flex-direction: column;
    }

    .file-uploader-wrapper .uploaded-files-area .uploaded-row .details .size {
        color: #404040;
        font-size: 11px;
    }

    .file-uploader-wrapper .uploaded-files-area i.fa-check {
        font-size: 16px;
    }

    .file-uploader-wrapper .apply-image-btn {
        margin-top: 20px;
        background-color: #2d3250;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .file-uploader-wrapper .apply-image-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .file-uploader-wrapper .apply-image-btn.loading {
        pointer-events: none;
    }

    .file-uploader-wrapper .image-preview-container {
        margin-top: 20px;
        text-align: center;
    }

    .file-uploader-wrapper .image-preview-container img {
        max-width: 100%;
        max-height: 300px;
    }
</style>
