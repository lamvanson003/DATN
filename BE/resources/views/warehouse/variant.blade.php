@extends('layout_admin')
@section('title', 'Quản lý kho ')
@section('content_admin')

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">CloudLab</h3>
                </div>
                {{-- <div class="ms-md-auto py-2 py-md-0">
          <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
          <a href="#" class="btn btn-primary btn-round">Add Customer</a>
        </div> --}}
            </div>
            <div class="row">
                @foreach ($variant as $item)
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center position-relative">
                                    <div class="col-icon">
                                        <div class="icon-big text-center bubble-shadow-small">
                                            <img src="{{ $item->images }}" alt=""
                                                style="max-width: 50px; object-fit: contain">
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">{{ $item->product->name }}</p>
                                            <h4 class="card-title">{{ $item->storage }}</h4>
                                            <h4 class="card-category">Số lượng: {{ $item->instock }}</h4>
                                        </div>
                                    </div>
                                    <div class="position-absolute text-end bottom-0">
                                        <a
                                            href="{{ route('admin.product.product_item.edit', [$item->product->id, $item->id]) }}">Xem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll(".card-category");
            elements.forEach(element => {
                const originalText = element.textContent.trim();
                if (originalText.length > 17) {
                    element.textContent = originalText.substring(0, 17) + "...";
                }
            });
        });
    </script>
@endsection
