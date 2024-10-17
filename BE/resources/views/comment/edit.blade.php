@extends('layout_admin')
@section('title', 'Chỉnh sửa bình luận')
@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">CloudLab</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.comment.index') }}">Bình luận</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Chỉnh sửa</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.comment.update', $comment->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Chỉnh sửa bình luận</h3>
                            </div>
                            <div class="row card-body">
                                <!-- Nội dung bình luận -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Nội dung bình luận<span style="color: red">*</span>:</label>
                                        <textarea required class="form-control" name="content" rows="4" placeholder="Nội dung bình luận">{{ $comment->content }}</textarea>
                                    </div>
                                </div>
                                <!-- Đánh giá -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đánh giá<span style="color: red">*</span>:</label>
                                        <select name="rating" class="form-select" required>
                                            <option value="">Chọn đánh giá</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ $i == $comment->rating ? 'selected' : '' }}>
                                                    {{ $i }} ⭐
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <!-- Trạng thái -->
                                <div class="col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <label class="control-label">Trạng thái<span style="color: red">*</span>:</label>
                                    <select class="form-select" name="status">
                                        @foreach ($statuses as $key => $value)
                                            <option value="{{ $key }}" {{ $key == $comment->status ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 gap-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Sửa">
                                    Sửa
                                </button>
                                <button type="button" class="btn btn-danger p-1-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $comment->id }}" title="Xóa">
                                    Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal xác nhận xóa -->
<div class="modal fade" id="deleteModal{{ $comment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel{{ $comment->id }}">Thông báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa bình luận này?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.comment.delete', $comment->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
@endsection
