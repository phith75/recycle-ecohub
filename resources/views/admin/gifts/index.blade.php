@extends('admin.layouts.app')

@section('contentadmin')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quà /</span> Danh sách <a href="{{ route('gifts.create') }}" class="btn btn-success">Thêm mới</a></h4>
        <div class="card">
            <h5 class="card-header">Danh sách quà</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Điểm cần</th>
                            <th>Số lượng</th>
                            <th>Nội dung</th>
                            <th>Ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($gifts as $gift)
                        <tr class="table-default">
                            <td><strong>{{ $gift->id }}</strong></td>
                            <td>{{ $gift->name }}</td>
                            <td>{{ $gift->point }}</td>
                            <td>{{ $gift->quantity }}</td>
                            <td>{{ $gift->content }}</td>
                            <td>
                                @if ($gift->image)
                                <img src="{{ asset($gift->image) }}" alt="Gift Image" style="max-width: 100px;">
                                @else
                                <span>Không có ảnh</span>
                                @endif
                            </td>
                            <td>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('gifts.edit', $gift->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Sửa
                                        </a>
                                        <form action="{{ route('gifts.destroy', $gift->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
