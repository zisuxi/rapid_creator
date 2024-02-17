
var imageBaseUrl = document.getElementById("image_base_url").value;
var get_url = document.getElementById("get_url").value;
var module_name = document.getElementById("module_name").value;
function gettingData() {
    var currentURL = window.location.href;
    if (currentURL.includes("template")) {
        var view_data_url = document.getElementById("get_url_view").value;
        $.ajax({
            url: view_data_url,
            method: "GET",
            success: function (response) {
                $("#getting_data_templates").empty();
                if (response.data.length > 0) {
                    $.each(response.data, function (key, value) {
                        var badge = "";
                        var status = "In-Active";
                        var checked = "";
                        if (value.template_status == 1) {
                            checked = "checked";
                            status = "Active";
                            badge = `<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
                            </div>`;
                        }
                        $("#getting_data_templates").append(`
                        <div class="col-md-4 col-xxl-4 mt-2">
                            <div class="card template_status">
                                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                <form><input type="hidden" id="get_url" value="${get_url}"><input type="hidden" id="module_name" value="${module_name}"></form>
                                    <div class="symbol symbol-200px mb-5 bg-dark">
                                        <img src="${imageBaseUrl}/${value.template_picture}" alt="image" style="border: 10px double lightgray;">
                                        ${badge}
                                    </div>
                                    <label class="form-check form-switch form-check-custom form-check-solid"><input class="form-check-input" onchange="statusChange(this, '${value.id}')" type="checkbox" ${checked} style="width: 28px;height: 15px;">
                                    <span class="form-check-label fw-semibold text-muted" id="template_status_${value.id}">${status}</span></label>
                                    <h4><span class="badge badge-secondary text-capitalize mt-3">${value.template_title}</span></h4>
                                    <div class="btn-group mt-2" role="group" aria-label="First group">
                                    <a href="view-template" type="button" class="btn btn-primary  btn-icon" title="View Template Design"><i class="fas fa-eye"></i></a>
                                    <button type="button" class="btn btn-success btn-icon" title="Edit Template"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon" title="Delete Template"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-info btn-icon" title="Download Template Design"><i class="fas fa-download"></i></button>
                                </div>
                                </div>
                            </div>
                        </div>
                    `);
                    });
                } else {
                    $("#getting_data_templates").append(`
                    <div class="col-md-12 col-xxl-12 mt-2">
                        <div class="card">
                            <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                <marquee behavior="scroll" direction="right" class="fs-4 text-danger fw-bold mb-0 text-capitalize text-center">No Record Found !!</marquee>
                            </div>
                        </div>
                    </div>
                `);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }
}
gettingData();
