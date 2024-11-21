<script>
    $(document).ready(function () {
        // Hàm khởi tạo để ẩn các phần tử liên quan
        function initNotificationForm() {
            $('#notification-option-select').hide();
            $('#notification-customer-select').hide();
        }

        initNotificationForm(); // Ẩn ngay khi tải trang

        // Khi thay đổi giá trị của đối tượng
        $('.notification-type').change(function () {
            const selectedValue = $(this).val(); // Lấy giá trị hiện tại
            initNotificationForm(); // Reset lại trạng thái

            if (selectedValue == {{ \App\Enums\Notification\NotificationTypes::Customer }}) {
                $('#notification-option-select').show(); // Hiển thị loại thông báo
            }
        });

        $('.notification-option-select-value').change(function () {
            const selectedOption = $(this).val(); // Lấy giá trị hiện tại
            $('#notification-customer-select').hide(); // Reset trạng thái khách hàng

            if (selectedOption == {{ \App\Enums\Notification\NotificationOption::One }} &&
                $('.notification-type').val() == {{ \App\Enums\Notification\NotificationTypes::Customer }}) {
                $('#notification-customer-select').show(); // Hiển thị danh sách khách hàng
            }
        });


        // Khởi tạo select2 cho khách hàng
        $('#user_id').select2({
            ajax: {
                url: '{{ route("admin.search.select.customer") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log('Từ khóa tìm kiếm:', params.term); // Log từ khóa tìm kiếm

                    // Trả về tất cả khách hàng khi không có từ khóa tìm kiếm
                    return {
                        q: params.term || '', // Truyền từ khóa tìm kiếm nếu có, nếu không thì lấy tất cả
                    };
                },
                processResults: function (data) {
                    console.log('Dữ liệu trả về:', data); // Log dữ liệu trả về từ server

                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text,  // Hiển thị tên và số điện thoại
                        })),
                    };
                },
            },
            placeholder: '{{ __("Chọn khách hàng") }}',
            allowClear: true,
            multiple: true,
            minimumInputLength: 1, // Tìm kiếm khi ít nhất 1 ký tự
        });


    });
</script>
