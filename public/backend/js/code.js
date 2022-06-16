// Delete
$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
        });
    });
});

// Confirm Order
$(function () {
    $(document).on("click", "#confirm", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure to Confirm?",
            text: "Once Confirm, You will not be able to pending again",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Confirme!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Confirme", "Confirm Changes", "success");
            }
        });
    });
});

// Processing Order
$(function () {
    $(document).on("click", "#processing", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure to Processing?",
            text: "Once Processing, You will not be able to confirm again",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Processing!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Processing", "processing Changes", "success");
            }
        });
    });
});

// Picked Order
$(function () {
    $(document).on("click", "#picked", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure to Picked?",
            text: "Once Picked, You will not be able to Processing again",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Picked!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Picked", "Picked Changes", "success");
            }
        });
    });
});

// Shipped Order
$(function () {
    $(document).on("click", "#shipped", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure to Shipped?",
            text: "Once Shipped, You will not be able to Picked again",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Shipped!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Shipped", "Shipped Changes", "success");
            }
        });
    });
});

// Delivered Order
$(function () {
    $(document).on("click", "#delivered", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure to Delivered?",
            text: "Once Delivered, You will not be able to Shipped again",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delivered!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Delivered", "Delivered Changes", "success");
            }
        });
    });
});

// Cancel Order
$(function () {
    $(document).on("click", "#cancel", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure to Cancel?",
            text: "Once Cancel, You will not be able to Delivered again",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Cancel!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Cancel", "Delivered Changes", "success");
            }
        });
    });
});
