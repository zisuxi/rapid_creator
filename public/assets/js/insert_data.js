function InsertData(element, end_point_url, module_name, button_text) {
    (function () {
        "use strict";
        var forms = document.querySelectorAll(".needs-validation");
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener(
                "submit",
                function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                        });
                        var formData = new FormData(form_insert);
                        const button = element;
                        button.innerHTML = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                        button.setAttribute("disabled", "disabled");
                        if (end_point_url.includes("csv")) {
                            var progressBar = $('.progress-bar');
                            var percentageText = $('#percentage');
                            progressBar.animate({ width: "100%" }, {
                                duration: 1000,
                                progress: function (animation, progress) {
                                    var percentageValue = Math.round(progress * 100) + "%";
                                    percentageText.text(percentageValue);
                                },
                                complete: function () {
                                    $.ajax({
                                        url: end_point_url,
                                        method: "POST",
                                        contentType: false,
                                        processData: false,
                                        data: formData,
                                        dataType: "json",
                                        success: function (response) {
                                            if (response.module == "csv" && response.message == 200) {
                                                var progressBar = $('.progress-bar');
                                                var percentageText = $('#percentage');
                                                progressBar.animate({ width: "0%" }, {
                                                    duration: 1000,
                                                    progress: function (animation, progress) {
                                                        var percentageValue = Math.round(progress * 0) + "%";
                                                        percentageText.text(percentageValue);
                                                    },
                                                    complete: function () {
                                                        // console.log("CSV upload code block");
                                                    }
                                                });
                                                $(".text-danger").text("");
                                                Swal.fire({
                                                    toast: true,
                                                    icon: "success",
                                                    title: "CSV File Uploaded Successfully..!",
                                                    animation: false,
                                                    position: "top-right",
                                                    showConfirmButton: false,
                                                    timer: 3000,
                                                    timerProgressBar: true,
                                                });
                                                $("form").trigger("reset");
                                                button.removeAttribute("disabled");
                                                button.innerHTML = button_text + " " + module_name + " >";
                                            } else {
                                                var progressBar = $('.progress-bar');
                                                var percentageText = $('#percentage');
                                                progressBar.animate({ width: "0%" }, {
                                                    duration: 100,
                                                    progress: function (animation, progress) {
                                                        var percentageValue = Math.round(progress * 0) + "%";
                                                        percentageText.text(percentageValue);
                                                    },
                                                    complete: function () {
                                                    }
                                                });
                                                $(".text-danger").text("");
                                                Swal.fire({
                                                    toast: true,
                                                    icon: "error",
                                                    title: "CSV File Not Uploaded Successfully..!",
                                                    animation: false,
                                                    position: "top-right",
                                                    showConfirmButton: false,
                                                    timer: 3000,
                                                    timerProgressBar: true,
                                                });
                                                $("form").trigger("reset");
                                                button.removeAttribute("disabled");
                                                button.innerHTML = button_text + " " + module_name + " >";
                                            }
                                            $("form").trigger("reset");
                                            form.classList.remove("was-validated");
                                        },
                                        error: function (error) {
                                            var progressBar = $('.progress-bar');
                                            var percentageText = $('#percentage');
                                            progressBar.animate({ width: "0%" }, {
                                                duration: 100,
                                                progress: function (animation, progress) {
                                                    var percentageValue = Math.round(progress * 0) + "%";
                                                    percentageText.text(percentageValue);
                                                },
                                                complete: function () {
                                                }
                                            });
                                            button.removeAttribute("disabled");
                                            button.innerHTML = button_text + " " + module_name + " >";
                                            var error = error.responseJSON;
                                            $.each(error.errors, function (index, value) {
                                                $("#" + index).html(value);
                                            });
                                        },
                                    });
                                }
                            });
                        } else {
                            $.ajax({
                                url: end_point_url,
                                method: "POST",
                                contentType: false,
                                processData: false,
                                data: formData,
                                dataType: "json",
                                success: function (response) {
                                    if (response.module == "template" && response.message == 200) {
                                        $(".text-danger").text("");
                                        $("#template_add_image").css('background-color', "black");
                                        $("#template_add_image").css('background-image', "url('../assets/media/svg/avatars/blank.svg')");
                                        Swal.fire({
                                            toast: true,
                                            icon: "success",
                                            title: "New " + module_name + " Added Successfully..!",
                                            animation: false,
                                            position: "top-right",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                        });
                                        $("form").trigger("reset");
                                        button.removeAttribute("disabled");
                                        button.innerHTML = button_text + " " + module_name + " >";
                                        $("#template_add").modal("hide");
                                        gettingData();
                                    } else {
                                        $("form").trigger("reset");
                                        form.classList.remove("was-validated");
                                        button.removeAttribute("disabled");
                                        button.innerHTML = button_text + " " + module_name + " >";
                                        Swal.fire({
                                            toast: true,
                                            icon: "error",
                                            title: module_name + " Not Added Successfully..!",
                                            animation: false,
                                            position: "top-right",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                        });
                                    }
                                    $("form").trigger("reset");
                                    form.classList.remove("was-validated");
                                },
                                error: function (error) {
                                    button.removeAttribute("disabled");
                                    button.innerHTML = button_text + " " + module_name + " >";
                                    var error = error.responseJSON;
                                    $.each(error.errors, function (index, value) {
                                        $("#" + index).html(value);
                                    });
                                },
                            });
                        }
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
}