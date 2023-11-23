<?php
include_once("../db.php"); // Include the Database class file
include_once("../student.php"); // Include the Student class file
include_once("../student_details.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student data by ID from the database
    $db = new Database();

    $student = new Student($db);
    $studentData = $student->read($id); // Implement the read method in the Student class

    $studentdetails = new StudentDetails($db);
    $studentDetails = $studentdetails->read($id); // Implement the read method in the StudentDetails class

    if ($studentData && $studentDetails) {
        // The student data is retrieved, and you can pre-fill the edit form with this data.
    } else {
        echo "Student not found.";
    }
} else {
    echo "Student ID not provided.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id' => $_POST['id'],
        'student_number' => $_POST['student_number'],
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'last_name' => $_POST['last_name'],
        'gender' => $_POST['gender'],
        'birthday' => $_POST['birthday'],
        'student_id' => $_POST['student_id'],
        'contact_number' => $_POST['contact_number'],
        'street' => $_POST['street'],
        'zip_code' => $_POST['zip_code'],
        'town_city' => $_POST['town_city'],
        'province' => $_POST['province'],

    ];

    $db = new Database();
    $student = new Student($db);
    $studentdetails = new StudentDetails($db);

    // Call the edit method to update the student data
    if ($student && $studentdetails->update($id, $data)) {
        echo "Record updated successfully.";
    } else {
        echo "Failed to update the record.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Edit Student</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2>Edit Student Information</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $studentData['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $studentDetails['id']; ?>">
        
        <label for="student_number">Student Number:</label>
        <input type="text" name="student_number" id="student_number" value="<?php echo $studentData['student_number']; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $studentData['first_name']; ?>">
        
        <label for="middle_name">Middle Name:</label>
        <input type="text" name= "middle_name" id="middle_name" value="<?php echo $studentData['middle_name']; ?>">
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $studentData['last_name']; ?>">
        
        <label for="gender">Gender:</label>
        <input type="text" name="gender" id="gender" value="<?php echo $studentData['gender']; ?>">
        
        <label for="birthday">Birthdate:</label>
        <input type="text" name="birthday" id="birthday" value="<?php echo $studentData['birthday']; ?>">

        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" id="student_id" value="<?php echo ($studentDetails !== false) ? $studentDetails['student_id'] : ''; ?>">

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" id="contact_number" value="<?php echo ($studentDetails !== false) ? $studentDetails['contact_number'] : ''; ?>">

        <label for="street">Street:</label>
        <input type="text" name="street" id="street" value="<?php echo ($studentDetails !== false) ? $studentDetails['street'] : ''; ?>">

        <label for="zip_code">Zip Code:</label>
        <input type="text" name="zip_code" id="zip_code" value="<?php echo ($studentDetails !== false) ? $studentDetails['zip_code'] : ''; ?>">

        <label for="town_city">Town City:</label>
        <input type="text" name="town_city" id="town_city" value="<?php echo ($studentDetails !== false) ? $studentDetails['town_city'] : ''; ?>">

        <label for="province">Province:</label>
        <input type="text" name="province" id="province" value="<?php echo ($studentDetails !== false) ? $studentDetails['province'] : ''; ?>">

                <input type="submit" value="Update">
    </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
