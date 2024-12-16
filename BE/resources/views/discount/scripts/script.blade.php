<script>
    $(document).ready(function () {
        
        $('#discount_type').on('change', function () {
            var discountType = $(this).val(); 

            if (discountType == 2) { 
                $('#discount_money').removeClass('d-none'); 
                $('#discount_percent').addClass('d-none'); 
                $('#discount_percent_value').val(''); 
            } else { 
                $('#discount_money').addClass('d-none'); 
                $('#discount_percent').removeClass('d-none'); 
                $('#discount_money_value').val(''); 
            }
        });

        
        $('form').on('submit', function () {
            var discountType = $('#discount_type').val(); 
            var discountValue = discountType == 2
                ? $('#discount_money_value').val() 
                : $('#discount_percent_value').val(); 

            $('#discount_value_hidden').val(discountValue); 
        });

        
        $('#discount_type').trigger('change');
    });
</script>
