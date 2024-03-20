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
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" class="form-control" name="name" id="basic-default-fullname"
                                    placeholder="Nguyễn Văn A" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="basic-default-company"
                                    placeholder="09127127232"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">email</label>
                                <input type="email" class="form-control" name="email" id="basic-default-company"
                                    placeholder="eco@gmail.com"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">date_of_birth</label>
                                <input type="date" class="form-control" name="date_of_birth" id="basic-default-company"
                                    placeholder="100"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">point</label>
                                <input type="number" class="form-control" name="point" id="basic-default-company"
                                    placeholder="100"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">password</label>
                                <input type="password" class="form-control" name="password" id="basic-default-company"
                                    placeholder="password"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">role</label>
                                <select id="defaultSelect" name="role" class="form-select">
                                    <option value="0">Nhân viên</option>
                                    <option value="1">Người dùng</option>
                                  </select>
                            </div>
                          <div class="mb-3">
                             <label for="defaultSelect" class="form-label">Thùng rác phụ trách</label>
                            <select id="defaultSelect" name="id_trash" class="form-select">
                                @foreach ( $trashs as $trash )
                                <option value="{{$trash->id}}">{{$trash->name}}</option>
                                @endforeach
                              </select>
                          </div>
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
