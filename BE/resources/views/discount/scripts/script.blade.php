<script>
    $(document).ready(function() {
    $('#discount_type').on('change', function() {
        var discountType = $(this).val();

        if (discountType == 2) { 
            $('#discount_money').removeClass('d-none'); 
            $('#discount_money input').prop('disabled', false); 
            $('#discount_percent').addClass('d-none'); 
            $('#discount_percent input').prop('disabled', true); 
            $('#percent_value').val('');
        }  else { 
            $('#discount_money').addClass('d-none'); 
            $('#discount_money input').prop('disabled', true); 
            $('#discount_percent').removeClass('d-none');
            $('#discount_percent input').prop('disabled', false); 
            $('#discount_value').val('');
        }
    });

    $('#discount_type').trigger('change');
});

</script>
