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
                <label class="form-label" for="location-title">Tiêu đề</label>
                <input type="text" class="form-control" name="title" id="location-title" value="{{ $trash->title }}" placeholder="Tiêu đề cho vị trí" /> </div>

              <div class="mb-3">
                <label class="form-label" for="location-map">Vị trí</label>
                <div id="location-map" style="height: 300px;"></div>
                <input type="hidden" name="location" id="location" value="{{ $trash->location }}"> </div>
              <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

<script>
   var latitude = <?php echo json_encode($latitude); ?>;
  var longitude = <?php echo json_encode($longitude); ?>;
 
  var map = L.map('location-map').setView([latitude[0], longitude[0]], 12);  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  var marker;

  // Assuming you already have the click event listener and marker logic set up

  map.on('click', function(e) {
    if (marker) {
      map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);
    // Update hidden input field with title and latitude and longitude
    document.getElementById('location').value = btoa(`${e.latlng.lat},${e.latlng.lng}`);
  });
</script>

@endsection
