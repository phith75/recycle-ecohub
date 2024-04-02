@extends('admin.layouts.app')

@section('contentadmin')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Thêm mới</h4>

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
          </div>
          <div class="card-body">
            <form action="{{ route('trash.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Name</label>
                <input type="text" class="form-control" name="name" id="basic-default-fullname" placeholder="Trashhh" />
              </div>
              
              <div class="mb-3">
                <label class="form-label" for="basic-default-title">Chi tiết địa chỉ</label>
                <input type="text" class="form-control" name="title" id="basic-default-title" placeholder="Title for location" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="location-map">Location</label>
                <div id="location-map" style="height: 300px;"></div>
                <input type="hidden" name="location" id="location" value="">
              </div>

              <div class="mb-3">
                <label class="form-label">Loại rác</label><br>
                @foreach($typeTrashes as $typeTrash)
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="type_trashes[]" value="{{ $typeTrash->id }}" id="typeTrash{{ $typeTrash->id }}">
                    <label class="form-check-label" for="typeTrash{{ $typeTrash->id }}">{{ $typeTrash->name }}</label>
                  </div>
                @endforeach
              </div>

              <button type="submit" class="btn btn-success">Add</button>
            </form>
          </div>
        </div>
      </div>    
    </div>
  </div>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  
  <script>
    var map = L.map('location-map').setView([21.027778, 105.834160], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
      if (marker) {
        map.removeLayer(marker);
      }
      marker = L.marker(e.latlng).addTo(map);
      // Update hidden input field with latitude and longitude
      document.getElementById('location').value = btoa(`${e.latlng.lat},${e.latlng.lng}`);
    });
  </script>
@endsection
