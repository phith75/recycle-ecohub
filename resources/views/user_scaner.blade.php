@extends('layouts.app')
@section('content')
    <script></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

    <style>
        .result {
            background-color: green;
            color: #fff;
            padding: 20px;
        }

        #reader {
    max-width: 350px;
    width: 100%;
    height: auto;
    margin:auto;
    padding: 5px;
}
        .row {
            display: flex;
        }
    </style>
    <section>
        <div class="container">
            <div class=" align-items-center py-lg-8 py-6" id="content-chart">
                <div class=" text-center text-lg-start">
                    <h1 class="text-white text-center fs-5 fs-xl-6">Quản lý rác thải sinh hoạt 1 cách khoa học về dễ dàng hơn
                    </h1>
                    <p class="text-white text-center py-lg-3 py-2">TIỆN ÍCH VỀ THIẾT KẾ
                        CHỨC NĂNG HIỆN ĐẠI
                        ĐẢM BẢO VỆ SINH SẠCH SẼ VÀ KHỬ MÙI HIỆU QUẢ
                        NÂNG CAO Ý THỨC VỀ BẢO VỆ MÔI TRƯỜNG</p>
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
                </div>
            </div>
        </div>
        </div>
        <div id="qr-reader" class="mt-4 flex justify-center items-center">
            <h1 class="text-white text-center">Quét mã thùng rác</h1>
            <div id="reader" class="text-center text-white flex justify-center items-center"></div>
        </div>
        </div>
        <div class="container mt-5 pt-5 ">
            <div class="row mt-5" id="gift-content">
                <h1 class="text-white text-center">Danh sách đổi quà</h1>
                @foreach ($gifts as $gift)
                    <div class="col-md-4 mb-4">
                        <div class="card border-light text-white">
                            <img src="{{ asset($gift->image) }}" class="card-img-top" alt="{{ $gift->name }}">
                            <div class="card-body">
                                <h3 class="card-title text-white">{{ $gift->name }}</h3>
                                <p class="card-text">Điểm cần: {{ $gift->point }}</p>
                                <p class="card-text text-white">số lượng: {{ $gift->quantity }}</p>
                                <button type="submit" class="btn btn-success"
                                    onclick="alertConfirm({{ $gift->id }},'{{ $gift->name }}',{{ $gift->point }},{{ $user->point }})">Đổi
                                    quà</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script type="text/javascript">
        const scanButton = document.getElementById("scan-button");
        const readerElement = document.getElementById("reader");

        let html5QrcodeScanner;
        html5QrcodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            },
            disableFlip: true,
            continuous: false,
            aggressiveDetection: true,
        });
        html5QrcodeScanner.render(onScanSuccess, onScanError);

        function onScanSuccess(qrCodeMessage) {
            // 1. Dừng quét ngay lập tức:

            // 2. Xác thực nội dung mã QR (tùy chọn):
            //   - Thực hiện logic xác thực (ví dụ: độ dài, định dạng) tại đây
            //   - Nếu xác thực không thành công, xử lý lỗi một cách phù hợp
            //     (ví dụ: hiển thị thông báo lỗi, tiếp tục quét)

            // 3. Tải trang đích:
            const url = window.location.origin + '/qr-code/' + qrCodeMessage;
            const decodedData =  decodeURIComponent(escape(atob(qrCodeMessage)));
            const data = JSON.parse(decodedData);
            html5QrcodeScanner.pause(); // Tạm dừng quét để tránh quét nhiều lần
            if (data.id_trash == {{ $trash->id }}) {
                Swal.fire({
                    title: "Quét thành công!",
                    text: "Làm tốt lắm",
                    imageUrl: "https://mcdn.coolmate.me/image/March2023/meme-meo-cute-hai-huoc-1297_599.jpg",       
                    imageWidth: 300,
                    imageAlt: "Ảnh chúc mừng",
                    showCancelButton: false,
                    confirmButtonColor: "#65E4A3",
                    confirmButtonText: "Ok",

                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.assign(url);
                    }
                });
            } else {
                Swal.fire({
                    title: "Thất bại!",
                    text: "Bạn đã chọn sai thùng rác, vui lòng đăng xuất sau đó chọn đúng thùng rác " + data.name,
                    imageUrl: "https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExOWd6Y3dlcnQ3eDdseWRyNzJ4NGR3dzFwaWY1cGthNTZrbThlaGRtbyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/GRk3GLfzduq1NtfGt5/giphy-downsized-large.gif",
                    imageWidth: 300,
                    imageAlt: "Ảnh buồn",
                    showCancelButton: true,
                    confirmButtonColor: "purple",
                    confirmButtonText: "Đăng xuất",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.assign('/logout');
                    }
                });
            }

        }

        function onScanError(errorMessage) {
            // Xử lý lỗi quét (ví dụ: từ chối truy cập camera)

        }
    </script>

    <script>
        // Enable pusher logging - don't include this in production
        var options = {
            series: [{{ $check = isset($trash) ? intval(($able / $total) * 100) : 0 }}],
            chart: {
                height: 400,
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

        function alertConfirm(id, name, point, userPoint) {
            Swal.fire({
                    title: 'Bạn muốn dùng ' + point + ' đổi lấy ' + name + ' ?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    imageWidth: 300,

                    imageUrl: "https://content.imageresizer.com/images/memes/Cat-think-meme-6.jpg",
                    cancelButtonColor: 'primary',
                    confirmButtonText: 'Đổi',
                    cancelButtonText: 'Hủy',
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        if (point > userPoint) {
                            Swal.fire({
                                title: 'Ôi khum :<',
                                text: 'Bạn khum đủ điểm để đổi món quà này rùi, cố tích đủ điểm nha',
                                imageWidth: 300,
                                imageUrl: "https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExaHhxOXFtOHQxZXcxZzljOTUycGM5d3YyaGJyOWw0OGMweDMybmE2NyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/kqRb2OuD8OskE/giphy.gif",
                                confirmButtonText: 'Ok :<',
                                confirmButtonColor: 'purple',
                            })
                        } else {
                            Swal.fire({
                                title: "Đổi thành công!",
                                text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể",
                                imageUrl: "https://mcdn.coolmate.me/image/March2023/meme-meo-cute-hai-huoc-1297_599.jpg",
                                imageWidth: 300,
                                imageAlt: "Ảnh chúc mừng",
                                showCancelButton: false,
                                confirmButtonColor: "#65E4A3",
                                confirmButtonText: "Ok",

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: `/gifts/exchange/${id}`,
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                'content') // Gửi token CSRF
                                        },
                                        success: function(response) {
                                            // Xử lý phản hồi thành công
                                            location.reload();
                                            // Hiển thị thông báo, chuyển hướng trang, v.v.
                                        },
                                        error: function(error) {
                                            // Xử lý lỗi
                                            console.error('Lỗi đổi quà:', error);
                                            // Hiển thị thông báo lỗi cho người dùng
                                        }
                                    });
                                }
                            });
                        }
                    } else {

                    }
                })
        }
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
                                  height: 220,
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
    <script>
        var pusher = new Pusher('89545c20a433e8235c10', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('scanner');
        channel.bind('userData', function(data) {
            // Dữ liệu nhận được từ Pusher
            let userName = data.userName;
            // Thực hiện xử lý với dữ liệu nhận được ở đây
        });
    </script>
@endsection
