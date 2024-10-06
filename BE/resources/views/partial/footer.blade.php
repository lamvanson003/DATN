<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
      <nav class="pull-left">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="http://www.themekita.com">
              ThemeKita
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> Help </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> Licenses </a>
          </li>
        </ul>
      </nav>
      <div class="copyright">
        2024, made with <i class="fa fa-heart heart text-danger"></i> by
        <a href="http://www.themekita.com">ThemeKita</a>
      </div>
      <div>
        Distributed by
        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
      </div>
    </div>
  </footer>
</div>

<!-- Custom template | don't include it in your project! -->
<div class="custom-template">
  <div class="title">Settings</div>
  <div class="custom-content">
    <div class="switcher">
      <div class="switch-block">
        <h4>Logo Header</h4>
        <div class="btnSwitch">
          <button
            type="button"
            class="selected changeLogoHeaderColor"
            data-color="dark"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="blue"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="purple"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="light-blue"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="green"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="orange"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="red"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="white"
          ></button>
          <br />
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="dark2"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="blue2"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="purple2"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="light-blue2"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="green2"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="orange2"
          ></button>
          <button
            type="button"
            class="changeLogoHeaderColor"
            data-color="red2"
          ></button>
        </div>
      </div>
      <div class="switch-block">
        <h4>Navbar Header</h4>
        <div class="btnSwitch">
          <button
            type="button"
            class="changeTopBarColor"
            data-color="dark"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="blue"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="purple"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="light-blue"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="green"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="orange"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="red"
          ></button>
          <button
            type="button"
            class="selected changeTopBarColor"
            data-color="white"
          ></button>
          <br />
          <button
            type="button"
            class="changeTopBarColor"
            data-color="dark2"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="blue2"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="purple2"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="light-blue2"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="green2"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="orange2"
          ></button>
          <button
            type="button"
            class="changeTopBarColor"
            data-color="red2"
          ></button>
        </div>
      </div>
      <div class="switch-block">
        <h4>Sidebar</h4>
        <div class="btnSwitch">
          <button
            type="button"
            class="changeSideBarColor"
            data-color="white"
          ></button>
          <button
            type="button"
            class="selected changeSideBarColor"
            data-color="dark"
          ></button>
          <button
            type="button"
            class="changeSideBarColor"
            data-color="dark2"
          ></button>
        </div>
      </div>
    </div>
  </div>
  <div class="custom-toggle">
    <i class="icon-settings"></i>
  </div>
</div>
<!-- End Custom template -->
</div>
<script>
  const navItems = document.querySelectorAll('.nav-item');
  navItems.forEach(item => {
    item.addEventListener('click', function () {
    
      navItems.forEach(nav => nav.classList.remove('active'));   
      this.classList.add('active');
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var successNotification = document.querySelector('.alert-success');
    var errorNotification = document.querySelector('.alert-danger');

    if (successNotification) {
        showToast(successNotification, '.jq-toast-loader', 2600); 
    }

    if (errorNotification) {
        showToast(errorNotification, '.jq-toast-loader', 2600); 
    }
  });

  function showToast(notification, loaderSelector, duration) {
    const loader = notification.querySelector(loaderSelector);

    if (loader) { // Kiểm tra nếu loader tồn tại
        notification.style.display = 'block';
        loader.style.width = '0%';
        
        setTimeout(() => {
            loader.style.width = '100%';
        }, 10); 
        
        setTimeout(() => {
            notification.style.display = 'none'; 
        }, duration); 
    } else {
        console.warn('Loader element not found for selector: ', loaderSelector);
    }
  }
</script>

<!--   Show Image   -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
      function loadFile(event) {
          const imagePreview = document.getElementById('imagePreview');
          const file = event.target.files[0];
          
          if (file) {
              imagePreview.src = URL.createObjectURL(file);
              document.getElementById('imageUrl').value = 'path/to/uploaded/image.jpg';                                    
          } else {
              imagePreview.src = "asset('/images/default-image.png')";
              document.getElementById('imageUrl').value = " ";                                    
          }
      }

      document.querySelector('.image-container').addEventListener('click', function() {
          document.getElementById('fileInput').click();
      });

      document.getElementById('fileInput').addEventListener('change', loadFile);
  });
</script>  


<!--   Core JS Files   -->
<script src="{{ asset('/admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('/admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>
<!-- Kaiadmin JS -->
<script src="{{ asset('/admin/assets/js/kaiadmin.min.js') }}"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset("/admin/assets/js/setting-demo2.js") }}"></script>
<script>
  $(document).ready(function () {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
      pageLength: 5,
      initComplete: function () {
        this.api()
          .columns()
          .every(function () {
            var column = this;
            var select = $(
              '<select class="form-select"><option value=""></option></select>'
            )
              .appendTo($(column.footer()).empty())
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function () {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>

</script>
</body>
</html>
