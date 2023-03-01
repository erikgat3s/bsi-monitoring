<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "bsimonitoring";

// Create database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $tahun = $_POST['tahun'];
    $query = "SELECT outlet.nama_outlet, SUM(realisasi_cair) + SUM(total_topup) AS actual, marketing.target_outlet 
    FROM outlet
    LEFT JOIN marketing ON marketing.nama_outlet = outlet.nama_outlet
    LEFT JOIN tb_harian ON tb_harian.nama = marketing.nama_marketing AND YEAR(tb_harian.tanggal) = $tahun
    GROUP BY outlet.nama_outlet 
    ORDER BY actual DESC";
} else {
    // Default query (current year)
    $query = "SELECT outlet.nama_outlet, 
    COALESCE(SUM(tb_harian.realisasi_cair), 0) + COALESCE(SUM(tb_harian.total_topup), 0) AS actual, 
    marketing.target_outlet 
    FROM outlet 
    LEFT JOIN marketing ON marketing.nama_outlet = outlet.nama_outlet 
    LEFT JOIN tb_harian ON tb_harian.nama = marketing.nama_marketing 
                 AND MONTH(tb_harian.tanggal) = MONTH(CURRENT_DATE()) 
                 AND YEAR(tb_harian.tanggal) = YEAR(CURRENT_DATE()) 
    GROUP BY outlet.nama_outlet 
    ORDER BY actual DESC";
}

// Execute query
$result = mysqli_query($conn, $query);

// Build arrays for highcharts
$categories = array();
$actual = array();
$target = array();
while ($row = mysqli_fetch_array($result)) {
    array_push($categories, $row['nama_outlet']);
    array_push($actual, intval($row['actual']));
    array_push($target, intval($row['target_outlet'])*12);
}

// Close database connection
mysqli_close($conn);
?>

<!-- Javascript for rendering highcharts chart -->
<script type="text/javascript">
    // Set the active tab based on whether the form has been submitted
    
    Highcharts.chart('container-year', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Cair (Actual) vs Target by Outlet'
        },
        subtitle: {
            text: 'by Year'
        },
        xAxis: {
            categories: <?php echo json_encode($categories); ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount (Rp.)'
            },
            labels: {
                formatter: function() {
                    return 'Rp. ' + Highcharts.numberFormat(this.value, 0, '.', ',');
                }
            }
        },
        series: [{
            name: 'Actual',
            data: <?php echo json_encode($actual); ?>,
            color: '#4caf50'
        }, {
            name: 'Target',
            data: <?php echo json_encode($target); ?>,
            color: '#f44336'
        }]
    });
</script>

