@extends('admin.layouts.app')

@section('contentadmin')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Thùng rác /</span> Danh sách <a href="{{ route('trash.create') }}" class="btn btn-success">Thêm mới</a></h4>
    <div class="card">
      <h5 class="card-header">Danh sách thùng rác</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Title</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($trashs as $trash)
            <tr class="table-default">
              <td><i class="bi bi-trash" style="font-size: 1.25em; color: rgb(33, 189, 33);"></i> <strong>{{ $trash->id }}</strong></td>
              <td>{{ $trash->name }}</td> 
              <td>{{ $trash->title }}</td>

               <td><span class="badge bg-label-{{ $trash->status == 0 ? 'success' : 'danger' }} me-1">{{ $trash->status == 0 ? 'Active' : 'Disable' }}</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('trash.edit', $trash) }}"
                      ><i class="bx bx-edit-alt me-1"></i> Edit</a
                    >
                    <form action="{{ route('trash.destroy', $trash) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="dropdown-item" 
                        ><i class="bx bx-trash me-1"></i> Delete</button
                      >
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

  @endsection
