$(document).ready(function () {
    // Templates JS
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $(
                        '<select class="form-control"><option value=""></option></select>'
                    )
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    // Add Row
    $("#add-row").DataTable({
        pageLength: 5,
    });

    var action =
        '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function () {
        $("#add-row")
            .dataTable()
            .fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action,
            ]);
        $("#addRowModal").modal("hide");
    });

    // Customize JS
    // Log out - for elements with class .logout
    $(".logout").click(function (e) {
        e.preventDefault();
        const formLogout = this.parentElement;
        swal({
            title: "Apakah Anda yakin?",
            text: "Tindakan ini akan mengakhiri sesi login Anda!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Ya, logout!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willLogout) => {
            if (willLogout) {
                formLogout.submit();
            }
        });
    });
    
    // Log out - for sidebar logout button with ID #logout-btn
    $("#logout-btn").click(function (e) {
        e.preventDefault();
        const logoutForm = document.getElementById('logout-form');
        
        swal({
            title: "Apakah Anda yakin?",
            text: "Tindakan ini akan mengakhiri sesi login Anda!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Ya, logout!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willLogout) => {
            if (willLogout) {
                logoutForm.submit();
            }
        });
    });

    // flash-data
    let flashData = $(".flash-data");
    if (flashData.data("message")) {
        var content = {
            title: "Success",
            message: flashData.data("message"),
            icon: `fa fa-bell`,
        };

        $.notify(content, {
            type: "success",
            placement: {
                from: "top",
                align: "center",
            },
            time: 1000,
            delay: 0,
        });
    }

    // Preview Image
    $("#image").change(function () {
        const file = this.files[0];
        console.log(file);
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                console.log(event.target.result);
                $("#imgPreview").attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Delete Post in Table
    $(".delete-post").click(function (e) {
        e.preventDefault();
        const formDel = this.parentElement;
        swal({
            title: "Are you sure?",
            text: "The post will deleted permanently!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                formDel.submit();
            }
        });
    });

    // Delete Gallery in Table
    $(".delete-gallery").click(function (e) {
        e.preventDefault();
        const formDel = this.parentElement;
        swal({
            title: "Are you sure?",
            text: "The gallery will deleted permanently!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                formDel.submit();
            }
        });
    });

    // Delete Product in Table
    $(".delete-product").click(function (e) {
        e.preventDefault();
        const formDel = this.parentElement;
        swal({
            title: "Are you sure?",
            text: "The product will deleted permanently!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                formDel.submit();
            }
        });
    });

    // Delete Post Category in Table
    $(".delete-post-category").click(function (e) {
        e.preventDefault();
        const formDel = this.parentElement;
        swal({
            title: "Are you sure?",
            text: "The posts with this category will become uncategorized!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                formDel.submit();
            }
        });
    });

    // Delete Gallery Category in Table
    $(".delete-gallery-category").click(function (e) {
        e.preventDefault();
        const formDel = this.parentElement;
        swal({
            title: "Are you sure?",
            text: "The galleries with this category will become uncategorized!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                formDel.submit();
            }
        });
    });

    // Delete Data image
    $(".delete-image").click(function (e) {
        e.preventDefault();
        const href = this.href;
        swal({
            title: "Are you sure?",
            text: "The image will be permanently deleted!",
            type: "warning",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-primary",
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                document.location.href = href;
            }
        });
    });

    // WYSIWYG Froala editor
    new FroalaEditor("textarea#froala-editor", {
        // height: 400,
    });
});
