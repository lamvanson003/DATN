<!-- Fonts and icons -->
<script src="{{ asset('/admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
  WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
    custom: {
      families: [
        "Font Awesome 5 Solid",
        "Font Awesome 5 Regular",
        "Font Awesome 5 Brands",
        "simple-line-icons",
      ],
      urls: ["/admin/assets/css/fonts.min.css"],
    },
    active: function () {
      sessionStorage.fonts = true;
    },
  });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('/admin/assets/css/kaiadmin.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/admin/assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/admin/assets/css/admin.css') }}" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('/admin/assets/css/demo.css') }}" />

 <!-- Thêm CSS cho Select2 -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
