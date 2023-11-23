<?php
$servername = "localhost";
$username = "root";
$password = "renz";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include('templates/header.html'); ?>
    <?php include('includes/navbar.php'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="header">
                            <h4 class="title">The Count of Students Born in the Ranges 1990-1999 and 2000-2010</h4>
                            <p class="category">Count of Students</p>
                        </div>
                        <div class="content">
                            <canvas id="chartGender"></canvas>
                            <?php
                                $query = "SELECT
                                CASE
                                    WHEN YEAR(s.birthday) BETWEEN 1990 AND 1999 THEN '1990-1999'
                                    WHEN YEAR(s.birthday) BETWEEN 2000 AND 2010 THEN '2000-2010'
                                    ELSE 'Other'
                                END AS birth_year_range,
                                COUNT(s.id) AS num_students
                                FROM
                                    studentS s
                                WHERE
                                    YEAR(s.birthday) BETWEEN 1990 AND 2010
                                GROUP BY
                                    birth_year_range;";

                                $result = mysqli_query($conn, $query);

                                if(mysqli_num_rows($result) > 0){
                                    $gender = array();

                                    while ($row = mysqli_fetch_array($result)){
                                        $gender[] = $row['num_students'];
                                    }

                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                } else {
                                    echo "No records matching your query were found.";
                                }
                                ?>

                                <script>
                                    const allGender = <?php echo json_encode($gender); ?>;
                                    const dataGender = {
                                        labels: ['2000 to 2010', '1990 to 1999'], // Add labels for each gender
                                        datasets: [{
                                            label: 'Total Orders',
                                            data: allGender,
                                            backgroundColor: [
                                                'rgba(255, 0, 0, 0.7)',
                                                'rgba(0, 128, 255, 0.7)',
                                            ],
                                            borderColor: [
                                                'rgba(255, 0, 0, 1)',
                                                'rgba(0, 128, 255, 1)',
                                            ],
                                            hoverOffset: 10,
                                            borderWidth: 1
                                        }]
                                    };

                                    const configGender = {
                                        type: 'doughnut',
                                        data: dataGender,
                                        options: {
                                        aspectRatio: 2.5, // Adjust this value to control the size of the chart
                                        },
                                    };

                                    const chartGender = new Chart(document.getElementById('chartGender'), configGender);
                                </script>
                            <hr>
                            <div class="stats">
                                <i class="fa fa-history"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('templates/footer.html'); ?>
</body>
</html>
