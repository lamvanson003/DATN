<script>
    $(document).ready(function() {

        function initNotificationForm() {
            $('#notification-option-select').hide();
            $('#notification-customer-select').hide();
        }

        initNotificationForm();


        $('.notification-type').change(function() {
            const selectedValue = $(this).val();
            initNotificationForm();

            if (selectedValue == {{ \App\Enums\Notification\NotificationTypes::Customer }}) {
                $('#notification-option-select').show();
            }
        });

        $('.notification-option-select-value').change(function() {
            const selectedOption = $(this).val();
            $('#notification-customer-select').hide();

            if (selectedOption == {{ \App\Enums\Notification\NotificationOption::One }} &&
                $('.notification-type').val() ==
                {{ \App\Enums\Notification\NotificationTypes::Customer }}) {
                $('#notification-customer-select').show();
            }
        });


        $('#user_id').select2({
            ajax: {
                url: '{{ route('admin.search.select.customer') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term || '',
                        show_all: !params.term,
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text,
                        })),
                    };
                },
            },
            placeholder: '{{ __('Chọn khách hàng') }}',
            allowClear: true,
            multiple: true,
            minimumInputLength: 0,
            theme: 'bootstrap-5',
            width: '100%',
        });
    });
</script>
