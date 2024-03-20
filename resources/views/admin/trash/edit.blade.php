@extends('admin.layouts.app')

@section('contentadmin')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Sửa</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sửa thông tin rác</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('trash.update', $trash->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Tên</label>
                                <input type="text" class="form-control" name="name" id="basic-default-fullname" value="{{ $trash->name }}" placeholder="Tên rác" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Vị trí</label>
                                <input type="text" class="form-control" name="location" id="basic-default-company" value="{{ $trash->location }}" placeholder="Vị trí" />
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
