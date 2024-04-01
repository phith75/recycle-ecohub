@extends('layouts.app')

@section('content')
    <!-- Nội dung cụ thể của trang Home -->
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>
        <div class="container">
            <div class=" align-items-center py-lg-8 py-6" id="content-chart">
                <div class=" text-center text-lg-start">
                    <h1 class="text-white text-center fs-5 fs-xl-6">Quản lý rác thải sinh hoạt 1 cách khoa học về dễ dàng hơn
                    </h1>
                    <p class="text-white text-center py-lg-3 py-2">TIỆN ÍCH VỀ THIẾT KẾ
                        CHỨC NĂNG HIỆN ĐẠI
                        ĐẢM BẢO VỆ SINH SẠCH SẼ VÀ KHỬ MÙI HIỆU QUẢ
                        NÂNG CAO Ý THỨC VỀ BẢO VỆ MÔI TRƯỜNG
                        .</p>
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xl-6 col-sm-6 col-md-6 text-center">
                            <?php
                            $total = 0;
                            $able = 0;
                            ?>
                            @foreach ($trasheType as $type)
                                <?php
                                $total += $type->weight;
                                $able += $type->weightable;
                                ?>
                                <div class="chart<?= $type->id ?>" id="chart<?= $type->id ?>"></div>
                                <div class=" text-center">
                                    <h3 class="text-white">Tổng sức chứa:
                                        {{ $type->weight = isset($trash) ? $type->weight : 0 }} kg</h2>
                                </div>
                                <div class=" text-center">
                                    <h4 class="text-white">Khả dụng:
                                        {{ $weightable = isset($trash) ? $type->weight - $type->weightable : 0 }} Kg</h3>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-6 col-xl-6 col-sm-6 col-md-6 text-center ">
                            <div class="chart" id="chart"></div>
                            <div class=" text-center">
                                <h2 class="text-white">Tổng sức chứa: {{ $total = isset($trash) ? $total : 0 }} kg</h2>
                            </div>
                            <div class=" text-center">
                                <h3 class="text-white">Khả dụng:
                                    {{ $chat = isset($trash) ? $total - $able : 0 }} Kg</h3>
                            </div>
                        </div>
                    </div>

                    <form action="">
                        <div class=" align-items-center py-lg-8 py-6">
                            <input style="background: #ffffff; border:none"
                                class="mt-2 nav-link btn btn-light text-black m-auto w-75 h-50 w-lg-75" aria-current="page"
                                id="trash-weight" placeholder="Số cân nặng rác" type="number">
                            <select style="background: #ffffff; border:none"
                                class="mt-2 nav-link btn btn-light text-black m-auto w-75 h-50 w-lg-75" aria-current="page"
                                id="trash-type">
                                <option value="" selected disabled>Chọn loại rác</option>
                                @foreach ($trasheType as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>


                            <button class="mt-2 nav-link btn text-white m-auto w-75 h-50 w-lg-75" aria-current="page"
                                id="generate"><i class="fas fa-qrcode"></i> Quét mã</button>
                            <div class="text-center-qr" id="qr-container">
                                <div class="body-qr">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    {{-- </div> --}}

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    
    <!-- <section> close ============================-->
    <!-- ============================================-->



    <script>
        // Enable pusher logging - don't include this in production
        var options = {
            series: [{{ $check = isset($trash) ? intval(($able / $total) * 100) : 0 }}],
            chart: {
                height: 500,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    },
                    dataLabels: {
                        name: {
                            fontSize: '26px',
                            color: '#65e4a3' // Đặt màu cho name ở đây
                        },
                        value: {
                            fontSize: '24px',
                            color: '#65e4a3' // Đặt màu cho value ở đây
                        }
                    }
                }
            },
            labels: ['{{ $test1 = isset($trash) ? $trash->name : 0 }} '],
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        const generate = document.getElementById('generate');
        const trashWeightInput = document.getElementById('trash-weight');
        const trashTypeSelect = document.getElementById('trash-type');
        const qrcodebox = document.querySelector('.body-qr');

        generate.addEventListener('click', (e) => {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của form
            const selectedValue = trashTypeSelect.value;
            const enteredWeight = parseFloat(trashWeightInput.value); // Chuyển đổi giá trị nhập vào thành số

            if (selectedValue && enteredWeight && enteredWeight <= parseFloat('{{ $weightable }}')) {
                generateQRCode(selectedValue, enteredWeight);
                const errorSpan = document.querySelector('.validation-error');
                errorSpan.style.display = 'none';
            } else {
                const errorSpan = document.createElement('span');
                const existingErrorSpans = document.querySelectorAll('.validation-error');
                existingErrorSpans.forEach(span => span.remove());
                errorSpan.classList.add('validation-error');
                if (!selectedValue) {
                    errorSpan.innerHTML = 'Vui lòng chọn loại rác!';
                } else if (!enteredWeight) {
                    errorSpan.innerHTML = 'Vui lòng nhập số cân nặng!';
                } else {
                    errorSpan.innerHTML = 'Số cân nặng vượt quá khả dụng của loại rác!';
                }
                errorSpan.style.color = '#ff0000';
                trashWeightInput.before(errorSpan);
            }
        });
    </script>
    <?php
    // Giả sử $trashTypes là mảng các đối tượng bạn muốn lặp qua
    foreach ($trasheType as $type) {
        $weightable = isset($type->weightable) ? intval($type->weightable) : 0;
        $weight = isset($type->weight) ? intval($type->weight) : 1; // Phòng trường hợp weight = 0
        $percentage = $weight !== 0 ? intval(($weightable / $weight) * 100) : 0;
        $typeName = isset($type->name) ? $type->name : 'Unknown';
        echo "<script>
                        var options = {
                            series: [" .
            $percentage .
            "],
                            chart: {
                                height: 250,
                                type: 'radialBar',
                                id: 'chart" .
            $type->id .
            "'
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%',
                                    },
                                    dataLabels: {
                                        name: {
                                            fontSize: '16px',
                                            color: '#65e4a3'
                                        },
                                        value: {
                                            fontSize: '12px',
                                            color: '#65e4a3'
                                        }
                                    }
                                }
                            },
                            labels: ['" .
            $typeName .
            "'],
                        };
                        var chart = new ApexCharts(document.querySelector('#chart" .
            $type->id .
            "'), options);
                        chart.render();
                    </script>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>

        var pusher = new Pusher('89545c20a433e8235c10', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('scanner');
        channel.bind('userData', function(data) {
            // Dữ liệu nhận được từ Pusher
            let userName = data.userName;
            Swal.fire({
                title: "Cám ơn !",
                text: "Bạn " + data.userName + " iu dấu",
                imageUrl: "https://i.pinimg.com/736x/25/bb/40/25bb40c38539fbfbd6e0fb7d69f3e1d6.jpg",
                imageWidth: 300,
                imageAlt: "Ảnh cám ơn",
                showCancelButton: false,
                confirmButtonColor: "#65E4A3",
                confirmButtonText: "Ok",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();

                }
            });

            // Thực hiện xử lý với dữ liệu nhận được ở đây
        });

        // function generateQRCode(trashType,enteredWeight) {
        //     qrcodebox.innerHTML = "";

        //     new QRCode(qrcodebox, {
        //         text: `${enteredWeight}+${trashType}+{{ $able }}`, // Ghép loại rác vào mã QR
        //         height: 300,
        //         width: 300,
        //         colorLight: "#fff",
        //         colorDark: "#000",
        //     });
        //     document.getElementById('qr-container').style.display = "flex"; // Hiện container QR
        // }
        function generateQRCode(trashType, enteredWeight) {
            // Tạo một div bao bọc cho mã QR và đặt nền màu trắng
            let qrContainer = document.createElement("div");
            qrContainer.style.backgroundColor = "#ffffff"; // Màu nền trắng
            qrContainer.style.width = "300px"; // Chiều rộng của mã QR
            qrContainer.style.height = "300px"; // Chiều cao của mã QR
            qrContainer.style.display = "flex";
            qrContainer.style.flexDirection = "column"; // Xếp theo chiều dọc
            qrContainer.style.justifyContent = "center";
            qrContainer.style.alignItems = "center";
            qrContainer.style.borderRadius = "10px"; // Độ cong của góc
            qrcodebox.innerHTML = ""; // Xóa nội dung của qrcodebox trước khi thêm vào

            // Tạo đối tượng dữ liệu JSON
            let data = {
                weight: enteredWeight,
                trashType: trashType,
                able: <?= $able ?>,
                id_trash: <?= $trash->id ?>,
                name: "<?= $trash->name ?>"
            };
            let jsonData = JSON.stringify(data);

            // Mã hóa chuỗi JSON thành base64
            let encodedData = btoa(unescape(encodeURIComponent(jsonData)));

            // Tạo mã QR và thêm vào qrContainer
            new QRCode(qrContainer, {
                text: encodedData, // Chuyển đổi dữ liệu thành chuỗi và ghép vào mã QR
                width: 250, // Chiều rộng của mã QR bên trong div bao bọc
                height: 250, // Chiều cao của mã QR bên trong div bao bọc
                colorLight: "#ffffff", // Màu nền trắng
                colorDark: "#000000",
                correctLevel: QRCode.CorrectLevel.H // Mức độ sửa lỗi H
            });
            // Tạo một div chứa văn bản "Vui lòng quét mã"
            let messageDiv = document.createElement("div");
            messageDiv.textContent = "Vui lòng quét mã";
            messageDiv.style.textAlign = "center";
            messageDiv.style.marginTop = "10px"; // Khoảng cách với mã QR


            qrContainer.appendChild(messageDiv);

            // Thêm qrContainer vào qrcodebox
            qrcodebox.appendChild(qrContainer);

            document.getElementById('qr-container').style.display = "flex"; // Hiện container QR
        }
    </script>
@endsection
