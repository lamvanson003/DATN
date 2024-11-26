@inject('orderService', 'App\Services\OrderService')

<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{ route('admin.dashboard.index') }}" class="logo">
          <div class="d-flex align-items-center gap-3">
            <img
            src="{{ asset('admin/assets/img/kaiadmin/logo.png') }}"
            alt="navbar brand"
            class="navbar-brand"
            width="50"
            height="auto"
          />
            <span style="color: #ffffff ; font-size: 20px">CloudLab</span>
          </div>
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item active">
            <a href="{{ route('admin.dashboard.index') }}" class="collapsed">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Chức năng</h4>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#notification">
              <i class="fas fa-bell"></i>
              <p>Thông báo</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="notification">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.notification.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm thông báo</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.notification.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS thông báo</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.notification.type',['type' => \App\Enums\Notification\NotificationType::ORDER]) }}">
                    <i class="fas fa-building"></i>
                    <span>DS thông báo Đơn hàng</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.notification.type',['type' => \App\Enums\Notification\NotificationType::VOUCHER]) }}">
                    <i class="fas fa-tags"></i>
                    <span>DS thông báo Khuyến mãi</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#sale">
              <i class="fas fa-bolt"></i>
              <p>Flash Sale</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="sale">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.flashSale.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm Flash Sale</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.flashSale.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS Flash Sale</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#slider">
              <i class="fas fa-sliders-h"></i>
              <p>Slider</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="slider">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.slider.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm Slider</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.slider.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS Slider</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#discount">
              <i class="fas fa-tags"></i>
              <p>Mã giảm giá</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="discount">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.discount.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm mã giảm giá</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.discount.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS mã giảm giá đang hoạt động</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.discount.inactive') }}">
                    <i class="fas fa-list"></i>
                    <span>DS mã giảm giá ngừng hoạt động</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#order">
              <i class="fas fa-truck"></i>
              <p>Đơn hàng</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="order">
              <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('admin.order.index') }}">
                        <i class="fas fa-list"></i>
                        <span>Tất cả đơn hàng</span>
                        <span class="badge badge-success">
                          {{ $orderService->countAll() }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.order.status',['status' => \App\Enums\Order\OrderStatus::Pending]) }}">
                        <i class="fas fa-hourglass-start"></i>
                        <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::Pending) }}</span>
                        <span class="badge badge-success">
                          {{ $orderService->countPending() }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.order.status', ['status' => \App\Enums\Order\OrderStatus::Confirm]) }}">
                      <i class="fas fa-check"></i>
                      <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::Confirm) }}</span>
                      <span class="badge badge-success">
                        {{ $orderService->countConfirm() }}
                      </span>
                    </a>
                </li>
                <li>
                  <a href="{{ route('admin.order.status', ['status' => \App\Enums\Order\OrderStatus::Awaiting]) }}">
                      <i class="fas fa-box"></i>
                      <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::Awaiting) }}</span>
                      <span class="badge badge-success">
                        {{ $orderService->countAwaiting() }}
                      </span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('admin.order.status', ['status' => \App\Enums\Order\OrderStatus::InTransit]) }}">
                      <i class="fas fa-truck"></i>
                      <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::InTransit) }}</span>
                      <span class="badge badge-success">
                        {{ $orderService->countInTransit() }}
                      </span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('admin.order.status', ['status' => \App\Enums\Order\OrderStatus::Delivered]) }}">
                      <i class="fas fa-box-open"></i>
                      <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::Delivered) }}</span>
                      <span class="badge badge-success">
                        {{ $orderService->countDelivered() }}
                      </span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('admin.order.status', ['status' => \App\Enums\Order\OrderStatus::Canceled]) }}">
                      <i class="fas fa-times"></i>
                      <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::Canceled) }}</span>
                      <span class="badge badge-success">
                        {{ $orderService->countCanceled() }}
                      </span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('admin.order.status', ['status' => \App\Enums\Order\OrderStatus::Returned]) }}">
                      <i class="fas fa-undo-alt"></i>
                      <span>{{ \App\Enums\Order\OrderStatus::getDescription(\App\Enums\Order\OrderStatus::Returned) }}</span>
                      <span class="badge badge-success">
                        {{ $orderService->countReturned() }}
                      </span>
                  </a>
              </li>
            </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#comment">
              <i class="fas fa-book-open"></i>
              <p>Bình luận</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="comment">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.comment.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm bình luận</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.comment.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS bình luận</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#category">
              <i class="fas fa-bars"></i>
              <p>Danh mục</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="category">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.category.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm danh mục</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.category.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS danh mục</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#brand">
              <i class="fas fa-code-branch"></i>
              <p>Thương hiệu</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="brand">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.brand.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm thương hiệu</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.brand.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS thương hiệu</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#product">
              <i class="fas fa-cube"></i>
              <p>Sản phẩm</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="product">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.product.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm sản phẩm</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.product.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS sản phẩm</span>
                  </a>
                </li>
                @php
                    $brands = \App\Models\Brand::all();
                @endphp
                @foreach ($brands as $item)
                  <li>
                    <a href="{{ route('admin.product.getProductByBrand',$item->id) }}">
                      <i class="fas fa-list"></i>
                      <span>{{ $item->name }}</span>
                    </a>
                  </li>
                @endforeach
                
              </ul>
            </div>
          </li>
          {{-- <li class="nav-item">
            <a data-bs-toggle="collapse" href="#comment">
              <i class="fas fa-comment"></i>
              <p>Bình luận</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="comment">
              <ul class="nav nav-collapse">
                <li>
                  <a href="#thembinhluan">
                    <i class="fas fa-plus"></i>
                    <span>Thêm Bình luận</span>
                  </a>
                </li>
                <li>
                  <a href="#dsbinhluan">
                    <i class="fas fa-list"></i>
                    <span>DS Bình luận</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> --}}
          {{-- <li class="nav-item">
            <a data-bs-toggle="collapse" href="#tables">
              <i class="fas fa-table"></i>
              <p>Tables</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav nav-collapse">
                <li>
                  <a href="tables/tables.html">
                    <span class="sub-item">Basic Table</span>
                  </a>
                </li>
                <li>
                  <a href="tables/datatables.html">
                    <span class="sub-item">Datatables</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> --}}
          {{-- <li class="nav-item">
            <a data-bs-toggle="collapse" href="#subribe">
              <i class="far fas fa-envelope"></i>
              <p>Email khách hàng</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="subribe">
              <ul class="nav nav-collapse">
                <li>
                  <a href="#dsthememail">
                    <i class="fas fa-plus"></i>
                    <span>Thêm email</span>
                  </a>
                </li>
                <li>
                  <a href="#dsemail">
                    <i class="fas fa-list"></i>
                    <span>DS email</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> --}}
         
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#post_cate">
              <i class="fas fa-list-alt"></i>
              <p>Danh Mục Bài Viết</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="post_cate">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.post_category.create') }}">
                    <i class="fas fa-plus"></i>
                    <span >Thêm danh mục</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.post_category.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS danh mục</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#post">
              <i class="fas fa-pen-square"></i>
              <p>Bài Viết</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="post">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.post.create') }}">
                    <i class="fas fa-plus"></i>
                    <span >Thêm bài viết</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.post.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS bài viết</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#customer">
              <i class="fas fa-user-friends"></i>
              <p>Khách hàng</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="customer">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.user.create') }}">
                    <i class="fas fa-plus"></i>
                    <span >Thêm khách hàng</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.user.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS khách hàng</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#admin">
              <i class="fas fa-user-shield"></i>
              <p>Admin</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="admin">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ route('admin.admin.create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Thêm admin</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.admin.index') }}">
                    <i class="fas fa-list"></i>
                    <span>DS admin</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          {{-- <li class="nav-item">
            <a data-bs-toggle="collapse" href="#charts">
              <i class="far fa-chart-bar"></i>
              <p>Charts</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav nav-collapse">
                <li>
                  <a href="charts/charts.html">
                    <span class="sub-item">Chart Js</span>
                  </a>
                </li>
                <li>
                  <a href="charts/sparkline.html">
                    <span class="sub-item">Sparkline</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> --}}
          
          {{-- <li class="nav-item">
            <a href="widgets.html">
              <i class="fas fa-desktop"></i>
              <p>Widgets</p>
              <span class="badge badge-success">4</span>
            </a>
          </li> --}}
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu">
              <i class="fas fa-bars"></i>
              <p>Menu Levels</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu">
              <ul class="nav nav-collapse">
                <li>
                  <a data-bs-toggle="collapse" href="#subnav1">
                    <span class="sub-item">Level 1</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="subnav1">
                    <ul class="nav nav-collapse subnav">
                      <li>
                        <a href="#">
                          <span class="sub-item">Level 2</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <span class="sub-item">Level 2</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" href="#subnav2">
                    <span class="sub-item">Level 1</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="subnav2">
                    <ul class="nav nav-collapse subnav">
                      <li>
                        <a href="#">
                          <span class="sub-item">Level 2</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a href="#">
                    <span class="sub-item">Level 1</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>