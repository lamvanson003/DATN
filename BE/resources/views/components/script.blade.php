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
                value = new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ';
                $(this).val(value);
            }
         });

        $('#formatPrice').on('input', function() {
            let value = $(this).val();
            value = value.replace(/\D/g, '');
            value = new Intl.NumberFormat('vi-VN').format(value);
            $(this).val(value);
        });
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
    });

</script>
