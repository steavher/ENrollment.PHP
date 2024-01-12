<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phs_enrollment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if LRN and schedule parameters are present
if (isset($_POST['lrn']) && isset($_POST['schedule'])) {
    $lrn = $_POST['lrn'];
    $schedule = $_POST['schedule'];

    // Fetch student gender using the LRN from the database
    $genderSql = "SELECT gender FROM names WHERE lrn = $lrn";
    $genderResult = $conn->query($genderSql);

    if ($genderResult && $genderRow = $genderResult->fetch_assoc()) {
        $gender = $genderRow['gender'];

        // Count the number of students already assigned to the class for the given gender
        $studentCountSql = "SELECT COUNT(*) AS student_count FROM class_list WHERE gender = '$gender'";
        $studentCountResult = $conn->query($studentCountSql);

        if ($studentCountResult && $studentCountRow = $studentCountResult->fetch_assoc()) {
            $studentCount = $studentCountRow['student_count'];

            // Check if the limit has been reached
            if ($studentCount < 40) {
                // Insert the student into the class list
                $insertStudentSql = "INSERT INTO class_list (lrn, gender, schedule) VALUES ($lrn, '$gender', '$schedule')";
                $conn->query($insertStudentSql);

                echo 'Student added to the class list successfully!';
            } else {
                echo 'Class limit reached for this gender.';
            }
        } else {
            echo 'Error counting students: ' . $conn->error;
        }
    } else {
        echo 'Student gender not found.';
    }
} else {
    echo 'LRN or schedule parameters not set.';
}

// Close db conn
$conn->close();
?>
