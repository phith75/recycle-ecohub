@extends('admin.layouts.app')

@section('contentadmin')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Sửa</h4>

            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Sửa thông tin quà</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('gifts.update', $gift->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label" for="name">Tên:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $gift->name }}" placeholder="Nhập tên quà" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="point">Điểm:</labels>
                                    <input type="text" class="form-control" name="point" id="point"
                                        value="{{ $gift->point }}" placeholder="Nhập tên quà" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="quantity">Số lượng:</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                        value="{{ $gift->quantity }}" placeholder="Nhập tên quà" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="content">Nội dung:</label>
                                    <textarea class="form-control" name="content" id="content" rows="4" placeholder="Nhập nội dung quà" required>{{ $gift->content }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="image">Ảnh:</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @if ($gift->image)
                                        <img src="{{ asset($gift->image) }}" alt="Gift Image"
                                            style="max-width: 200px; margin-top: 10px;">
                                    @else
                                        <p>Chưa có ảnh</p>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
