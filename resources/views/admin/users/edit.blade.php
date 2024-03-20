@extends('admin.layouts.app')

@section('contentadmin')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Sửa</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sửa thông tin người dùng</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" class="form-control" name="name"  value="{{ $user->name }}" id="basic-default-fullname"
                                    placeholder="Nguyễn Văn A" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone"  value="{{ $user->phone }}" id="basic-default-company"
                                    placeholder="09127127232"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">email</label>
                                <input type="email" class="form-control" name="email"  value="{{ $user->email }}" id="basic-default-company"
                                    placeholder="eco@gmail.com"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">date_of_birth</label>
                                <input type="date" class="form-control" name="date_of_birth" value="{{ $user->date_of_birth }}"  id="basic-default-company"
                                    placeholder="100"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">point</label>
                                <input type="number" class="form-control" name="point" value="{{ $user->point }}"  id="basic-default-company"
                                    placeholder="100"  aria-describedby="basic-addon13" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">role</label>
                                <select id="defaultSelect" name="role" class="form-select">
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Nhân viên</option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Người dùng</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Thùng rác</label>
                                    <select id="defaultSelect" name="id_trash" class="form-select">
                                        @foreach ( $trashs as $trash )
                                        <option value="{{$trash->id}}">{{$trash->name}}</option>
                                        @endforeach
                                      </select>
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
