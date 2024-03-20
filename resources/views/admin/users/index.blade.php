   <!-- Contextual Classes -->
   @extends('admin.layouts.app')

   @section('contentadmin')
   <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loại rác /</span> Danh sách <a href="{{ route('users.create') }}" class="btn btn-success">Thêm mới</a></h4>
   <div class="card">
    <h5 class="card-header">Danh sách User</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Thùng rác</th>
            <th>Số điện thoại</th>
            <th>email</th>
            <th>Điểm</th>
            <th>Ngày sinh</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($users as $trash) 
          <tr class="table-default">
            <td><i class="bi bi-trash" style="font-size: 1.25em; color: rgb(33, 189, 33);"></i> <strong>{{ $trash->id }}</strong></td>
            <td>{{ $trash->name }}</td>
              <td>  
                {{ $trash->trash_name }} 
              </td>
              <td>  
                {{ $trash->phone }} 
              </td>
              <td>  
                {{ $trash->email }} 
              </td>
              <td>  
                {{ $trash->point }} 
              </td>
              <td>  
                {{ $trash->date_of_birth }} 
              </td>
              <td>  
                {{ $trash->role == 1 ? "Người dùng" : "Nhân viên"}} 
              </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('users.edit', $trash) }}"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <form action="{{ route('users.destroy', $trash) }}" method="POST">
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

<!-- Content wrapper -->

  <!--/ Contextual Classes -->
  @endsection