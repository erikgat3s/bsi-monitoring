<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION["nip"])) {
  header("Location: /grafik/login/login.php");
  exit();
}

//melakukan koneksi ke database
// host = localhost, user = root, password = '', database = latihan
$koneksi        = mysqli_connect("localhost", "root", "", "bsimonitoring");

//ambil data mahasiswa dimana jenis kelamin adalah laki-laki
$nama       = mysqli_query($koneksi, "SELECT * FROM tb_harian");

//ambil data mahasiswa dimana jenis kelamin adalah perempuan
$pencairan      = mysqli_query($koneksi, "SELECT realisasi_cair FROM tb_harian WHERE tanggal='2023-02-18'");
    while($row = mysqli_fetch_array($pencairan))

                        


$pencairan2      = mysqli_query($koneksi, "SELECT realisasi_cair FROM tb_harian WHERE nip='555'");
    while($row = mysqli_fetch_array($pencairan2))

                        $realisasi2[] = $row['realisasi_cair'];
                        
                        $total_cair = array_sum($realisasi2);     
                        
                        $pencairan3      = mysqli_query($koneksi, "SELECT realisasi_cair FROM tb_harian WHERE nip='000'");
    while($row = mysqli_fetch_array($pencairan3))

                        $realisasi3[] = $row['realisasi_cair'];
                        
                        $total_cair = array_sum($realisasi3); 
?>
<html>
    <head>
        <title>Belajar Chart</title>

        <!-- import library chart menggunakan cdn -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <canvas id="myChart" ></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                // tipe chart
                type: 'bar',
                data: {

                    //karena hanya menggunakan 2 batang
                    //maka buat dua lebel, yaitu lebel laki-laki dan perempuan
                    labels: ['test 2', 'Ari Baltimores', 'Abang Jago'],

                    //dataset adalah data yang akan ditampilkan
                    datasets: [{
                            label: 'Data Grafik',

                            //karena hanya menggunakan 2 batang/bar
                            //maka 2 sql yang dibutuhkan
                            //hitung jumlah mahasiswa laki-laki dan jumlah mahasiswa perempuan
                            data: [
                                
                                <?php echo mysqli_num_rows($pencairan);?>,
                                <?php echo array_sum($realisasi2);?>,
                                <?php echo array_sum($realisasi3);?>,
                            ],

                            //atur background barchartnya
                            //karena cuma dua, maka 2 saja yang diatur
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)'
                            ],

                            //atur border barchartnya
                            //karena cuma dua, maka 2 saja yang diatur
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 2
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
    </body>
</html>