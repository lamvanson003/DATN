<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Hàm validate form
    const validateForm = (form) => {
        let isValid = true;
        const requiredFields = form.querySelectorAll('.required'); // Tìm tất cả các input có class "required"

        // Duyệt qua tất cả các trường có class "required"
        requiredFields.forEach(function (input) {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
                // Thêm thông báo lỗi nếu chưa có
                if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('text-danger')) {
                    input.insertAdjacentHTML('afterend', `<span class="text-danger">Trường này không được bỏ trống.</span>`);
                }
            } else {
                input.classList.remove('is-invalid');
                // Xóa thông báo lỗi nếu có
                if (input.nextElementSibling && input.nextElementSibling.classList.contains('text-danger')) {
                    input.nextElementSibling.remove();
                }
            }
        });

        return isValid; // Trả về kết quả
    };

    // Lắng nghe sự kiện input để ẩn thông báo lỗi khi người dùng bắt đầu nhập
    const attachInputListeners = (form) => {
        const requiredFields = form.querySelectorAll('.required');
        requiredFields.forEach(function (input) {
            input.addEventListener('input', function () {
                if (input.value.trim()) {
                    input.classList.remove('is-invalid');
                    // Xóa thông báo lỗi nếu có
                    if (input.nextElementSibling && input.nextElementSibling.classList.contains('text-danger')) {
                        input.nextElementSibling.remove();
                    }
                }
            });
        });
    };

    // Lắng nghe sự kiện submit cho tất cả các form trong trang
    const forms = document.querySelectorAll('form');
    forms.forEach((form) => {
        attachInputListeners(form); // Gắn sự kiện lắng nghe input
        form.addEventListener('submit', function (e) {
            if (!validateForm(form)) {
                e.preventDefault(); // Ngừng submit nếu form không hợp lệ
            }
        });
    });
});

</script>