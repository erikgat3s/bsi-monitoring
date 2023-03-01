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
    $year = $_POST['tahun'];
    $query = "SELECT nama, SUM(realisasi_cair) + SUM(total_topup) AS actual, target_jabatan * 12 as target_jabatan 
              FROM tb_harian 
              JOIN marketing ON tb_harian.nama = marketing.nama_marketing 
              WHERE YEAR(tanggal) = $year 
              GROUP BY nama 
              ORDER BY actual DESC";
} else {
    // Default query (current month)
    $query = "SELECT nama, SUM(realisasi_cair) AS actual, target_jabatan * 12 as target_jabatan 
              FROM tb_harian 
              JOIN marketing ON tb_harian.nama = marketing.nama_marketing 
              WHERE YEAR(tanggal) = YEAR(CURRENT_DATE()) 
              GROUP BY nama 
              ORDER BY actual ASC";
}

// Execute query
$result = mysqli_query($conn, $query);

// Build arrays for highcharts
$categories = array();
$actual = array();
$target = array();
while ($row = mysqli_fetch_array($result)) {
    array_push($categories, $row['nama']);
    array_push($actual, intval($row['actual']));
    array_push($target, intval($row['target_jabatan'])*12);
}

// Close database connection
mysqli_close($conn);
?>

<!-- Javascript for rendering highcharts chart -->
<script type="text/javascript">
Highcharts.chart('container-year-marketing', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Total Cair (Actual) vs Target Marketing'
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

