<script>
    $(document).ready(function() {
        $('.formatPrice').on('input', function () {
            let value = $(this).val();
            value = value.replace(/\D/g, ''); 
            if (value !== "") {
                value = new Intl.NumberFormat('vi-VN').format(value) + " VNĐ"; 
            }
            $(this).val(value);
        });

        $('.formatPrice').each(function () {
            let value = $(this).val();
            if (value !== '') {
                value = value.replace(/\D/g, ''); 
                value = new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ'; 
                $(this).val(value);
            }
         });

        $('#submitButton').on('click', function (e) {
            let isChecked = false;

            $('input[type="checkbox"]').each(function () {
                if ($(this).prop('checked')) {
                    isChecked = true;
                }
            });

            if (!isChecked) {
                e.preventDefault();
                alert("Vui lòng chọn ít nhất một sản phẩm để FlashSale.");
                return;
            }

            $('.formatPrice').each(function () {
                let value = $(this).val();
                value = value.replace(/[^\d]/g, ''); 
                $(this).val(value); 
            });

            $('input[name^="discount_price"], input[name^="quantity_limit"]').each(function () {
                let variantId = $(this).attr('name').match(/\d+/);
                if (variantId && !$(`input[value="${variantId}"]`).prop('checked')) {
                    $(this).val('');
                }
            });
        });
    });
</script>
