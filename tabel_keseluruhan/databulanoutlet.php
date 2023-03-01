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

// Filter by month
if (isset($_POST['submit'])) {
    $bulan = $_POST['bulan'];
    $query = "SELECT outlet.nama_outlet, SUM(realisasi_cair) + SUM(total_topup) AS actual, marketing.target_outlet 
    FROM outlet
    LEFT JOIN marketing ON marketing.nama_outlet = outlet.nama_outlet
    LEFT JOIN tb_harian ON tb_harian.nama = marketing.nama_marketing AND MONTH(tb_harian.tanggal) = '$bulan'
    GROUP BY outlet.nama_outlet 
    ORDER BY actual DESC";
} else {
    // Default query (current month)
    $query = "SELECT outlet.nama_outlet, 
    COALESCE(SUM(tb_harian.realisasi_cair), 0) + COALESCE(SUM(tb_harian.total_topup), 0) AS actual, 
    marketing.target_outlet 
    FROM outlet 
    LEFT JOIN marketing ON marketing.nama_outlet = outlet.nama_outlet 
    LEFT JOIN tb_harian ON tb_harian.nama = marketing.nama_marketing 
                 AND MONTH(tb_harian.tanggal) = MONTH(CURRENT_DATE()) 
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
    array_push($target, intval($row['target_outlet']));
}

// Close database connection
mysqli_close($conn);
?>

<!-- Javascript for rendering highcharts chart -->
<script type="text/javascript">
    Highcharts.chart('container-outlet', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Total Cair (Actual) vs Target'
        },
        subtitle: {
            text: 'by Month'
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

<script type="text/javascript">
    Highcharts.chart('container-outlet', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Cair (Actual) vs Target by Outlet'
        },
        subtitle: {
            text: 'by Month'
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