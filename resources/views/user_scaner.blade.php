@extends('layouts.app')
@section('content')

<script></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

<style>
  
  .result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  #reader{
    margin: auto;
    width: 350px;
    height: 350px;
  }
  .row{
    display:flex;
  }
</style>

<section>
  <div class="container p-auto">
  <div class="my-5">
    <div width="450" height="450" id="reader"></div>
  </div>
  
  </div>
</section>


<script type="text/javascript">
function onScanSuccess(qrCodeMessage) {
    
    const url = window.location.origin + '/qr-code/' + qrCodeMessage;
    window.location.assign(url);
}

function onScanError(errorMessage) {
  //handle scan error
}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

</script>

  @endsection