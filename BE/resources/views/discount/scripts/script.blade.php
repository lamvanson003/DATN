<script>
    $(document).ready(function() {
    $('#discount_type').on('change', function() {
        var discountType = $(this).val();

        if (discountType == 2) {
            $('#discount_money').removeClass('d-none'); 
            $('#discount_percent').addClass('d-none'); 
            $('#percent_value').val('');
        } else {
            $('#discount_money').addClass('d-none'); 
            $('#discount_percent').removeClass('d-none');
            $('#discount_value').val('');
        }
    });

    $('#discount_type').trigger('change');
});

</script>
