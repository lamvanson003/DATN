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
            url: '{{ route("admin.search.select.customer") }}', // API lấy khách hàng
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term || '', // Từ khóa tìm kiếm, nếu rỗng thì lấy tất cả
                    show_all: !params.term, // Gửi `show_all: true` nếu không có từ khóa
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.id,
                        text: item.text, // Hiển thị tên khách hàng
                    })),
                };
            },
        },
        placeholder: '{{ __("Chọn khách hàng") }}',
        allowClear: true,
        multiple: true,
        minimumInputLength: 0, // Hiển thị khi không nhập gì
        theme: 'bootstrap-5',
        width: '100%',
    });
});

</script>