<!DOCTYPE html>

<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

    <!-- Include the header -->
    <?php include('templates/header.html'); ?>
    <?php include('includes/navbar.php'); ?>


    <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="header">
                        <h4 class="title">Top 10 Highest birth years</h4>
                        <p class="category">Student Birth Years</p>
                    </div>
                    <div class="content">
                        <canvas id="myChartTopProvinces"></canvas>
                        <?php
$servername = "localhost";
$username = "root";
$password = "renz";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL Query to count the top 10 provinces with the most students
$querylowProvinces = "
SELECT
    CONCAT(s.last_name, ' ', s.first_name) AS full_name,
    s.birthday
FROM
    students s
WHERE
    s.gender = 1 
ORDER BY
    s.birthday DESC
LIMIT 10;
";

$resultlowProvinces = mysqli_query($conn, $querylowProvinces);

if (mysqli_num_rows($resultlowProvinces) > 0) {
    $province_count_data = array();
    $label_chart_data = array();

    while ($row = mysqli_fetch_array($resultlowProvinces)) {
        $province_count_data[] = $row['full_name'];
        $label_chart_data[] = $row['birthday'];
    }

    mysqli_free_result($resultlowProvinces);
    mysqli_close($conn);
} else {
    echo "No records matching your query were found.";
}
?>
                        <script>
                            const province_count_data = <?php echo json_encode($province_count_data); ?>;
                            const label_chart_data = <?php echo json_encode($label_chart_data); ?>;
                            const datalowProvinces = {
                                labels: label_chart_data,
                                datasets: [{
                                    label: 'Student Count',
                                    data: province_count_data,
                                    backgroundColor: [
                                        'rgba(255, 69, 96, 0.7)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 69, 96, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            const configlowProvinces = {
                                type: 'bar',
                                data: datalowProvinces,
                                options: {
                                    aspectRatio: 2.5,
                                }
                            };

                            const myChartlowProvinces = new Chart(document.getElementById('myChartTopProvinces'), configlowProvinces);
                        </script>
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Include the footer -->
    <?php include('templates/footer.html'); ?>
</body>
</html>