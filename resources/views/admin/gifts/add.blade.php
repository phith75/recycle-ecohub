@extends('admin.layouts.app')

@section('contentadmin')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Thêm mới</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Thêm quà mới</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('gifts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="name">Tên:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Nhập tên quà" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="point">Số điểm cần:</label>
                                    <input type="number" class="form-control" name="point" id="point"
                                        placeholder="Nhập điểm" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="quantity">Số lượng quà:</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity"
                                        placeholder="Nhập số lượng quà" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Nội dung:</label>
                                    <textarea class="form-control" name="content" id="content" rows="4" placeholder="Nhập nội dung quà" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="image">Ảnh:</label>
                                    <input type="file" class="form-control" name="image" id="image" required>
                                </div>

                                <button type="submit" class="btn btn-success">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
