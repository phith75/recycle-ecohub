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
                      
                    </div>
                    <div class="card-body">
                        <form action="{{ route('type_trash.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" class="form-control" name="name" id="basic-default-fullname"
                                    placeholder="Trashhh" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Cân nặng</label>
                                <input type="number" class="form-control" name="weight" id="basic-default-company"
                                    placeholder="100"  aria-describedby="basic-addon13" />
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
