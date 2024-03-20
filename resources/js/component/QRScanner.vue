<template>
  <div class="card">
    <barcode height="50px">Show this if the rendering fails.</barcode>
    <span style="padding:20px">
      <h5>Scan barcode to add product</h5>
      <div>
        <StreamBarcodeReader @decode="onDecode" @loaded="onLoaded"></StreamBarcodeReader>
      </div>
    </span>
  </div>
</template>

<script>
import { StreamBarcodeReader } from "vue-barcode-reader";

export default {
  components: {
    StreamBarcodeReader
  },
  methods: {
    onDecode(a) {
      console.log(a);
      if (this.id) clearTimeout(this.id);
      this.id = setTimeout(() => {
        axios.get('api/qr-code/' + a)
          .then(response => {
            Swal.fire({
              icon: response.data.status == 1 ? 'success' : 'error',
              text: response.data.message,
              showConfirmButton: true,
              timer: 2000
            });
            if (response.data.status == 1) this.$store.dispatch('getCartProduct');
          }).catch(error => {
            console.log(error.response.data);
          });
      }, 2000);
    },
    onLoaded(result) {
      console.log(result);
    }
  }
}
</script>
