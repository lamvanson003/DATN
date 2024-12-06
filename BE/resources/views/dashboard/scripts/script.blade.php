<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        function formaction() {
            if ($(".check-item:checked").length > 0) {
                $("#form-action").show();
                $("#viewAll").hide();
            } else {
                $("#form-action").hide();
                $("#viewAll").show();
            }
        }

        formaction();

        $(".check-item").change(function() {
            formaction();
        });

        $("#basic-addon2").click(function (e) {
    e.preventDefault();

    let selectedIds = $(".check-item:checked")
        .map(function () {
            return $(this).val();
        })
        .get();

    if (selectedIds.length === 0) {
        alert("Vui lòng chọn ít nhất một đơn hàng.");
        return;
    }

    if (!confirm("Bạn có chắc chắn muốn cập nhật các đơn hàng đã chọn?")) {
        return; // Nếu người dùng chọn "Cancel", dừng thực hiện
    }

    const routeUrl = $(this).data("route");

    $.ajax({
        url: routeUrl,
        type: "POST",
        data: {
            ids: selectedIds,
            status: $("select[name='status']").val(),
            _token: $("meta[name='csrf-token']").attr("content"), // Sử dụng meta tag để lấy token
        },
        beforeSend: function () {
            $("body").append('<div class="loading-overlay">Vui lòng chờ...</div>');
        },
        success: function (response) {
            Swal.fire({
                title: "Thành công!",
                text: response.message || "Cập nhật thành công!",
                icon: "success",
            }).then(() => location.reload());
        },
        error: function (xhr) {
            const errorMessage =
                xhr.responseJSON && xhr.responseJSON.error
                    ? xhr.responseJSON.error
                    : "Đã có lỗi xảy ra!";
            alert(errorMessage);
        },
        complete: function () {
        $(".loading-overlay").remove();
    },
    });
});

    });
</script>
