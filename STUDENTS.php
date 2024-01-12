<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phs_enrollment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentsPerPage = 5;

// limit 5 per table
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $studentsPerPage;

// Fetch student data from the db with LRN search condition
$lrnSearch = isset($_GET['lrn_search']) ? $_GET['lrn_search'] : '';
$sql = "SELECT * FROM names WHERE lrn LIKE '%$lrnSearch%' LIMIT $studentsPerPage OFFSET $offset";
$result = $conn->query($sql);

// Fetch student data count with LRN search condition
$sqlCount = "SELECT COUNT(*) AS total FROM names WHERE lrn LIKE '%$lrnSearch%'";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$totalStudents = $rowCount['total'];

// Process action if LRN and action parameters are present in the URL
// Process action if LRN and action parameters are present in the URL
if (isset($_GET['lrn']) && isset($_GET['action'])) {
    $lrn = $_GET['lrn'];
    $action = $_GET['action'];

    if ($action === 'approve') {

        $note = isset($_GET['note']) ? $_GET['note'] : '';

        $updateSql = "UPDATE names SET status = 'Approved', Message = '$note' WHERE lrn = $lrn";
        $conn->query($updateSql);
    } elseif ($action === 'delete') {
        // Check if the 'note' parameter is present in the URL
        $note = isset($_GET['note']) ? $_GET['note'] : '';
    
        // Example: Update the status to 'Declined' and store the note in 'Message'
        $updateSql = "UPDATE names SET status = 'Declined', Message = '$note' WHERE lrn = $lrn";
        $conn->query($updateSql);
    }

    // Redirect back to the same page with the current page and LRN search information
    $redirectUrl = "{$_SERVER['PHP_SELF']}?page=$current_page";
    if (!empty($lrnSearch)) {
        $redirectUrl .= "&lrn_search=$lrnSearch";
    }
    header("Location: $redirectUrl");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STUDENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        table {
            
            margin-top: 5%;
            margin-left: 18%;
            width: 15rem;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: solid 2px;
        }
        table th,
        table td {
            text-align: center; 
        }
    

        th, td {
            border: solid 2px #000000;
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4fa2ed;
            color: white;
        }

        tr:hover {
            background-color: #999da0;
        }

        .app-button,
        .del-button, .send-email-button {
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 2px 4px;
            cursor: pointer;
        }

        .app-button {
            background-color: #4fa2ed;
            color: #fff;
            border: none;
        }

        .del-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
        }

        .send-email-button {
            background-color: #4fa2ed;
            color: #fff;
            border: none;
        }


            span {
                color: #fff;
            }
        /* Add some styling to the action links */
        .action-links a {
            color: #ffffff;
            margin-right: 10px;
            text-decoration: none;
        }

        .action-links a:hover {
            text-decoration: underline;
        }
    nav {
            justify-content: space-between;
            background-color: #4fa2ed;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            padding: 15px 2rem 12px;
            border: solid .5px;
            border-color: #000000;
        }
        nav ul {
            align-items: center;
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav ul li a {
            text-decoration: none;
            font-family: sans-serif;
            color: #000000;
            font-weight: 600;
            padding: 8px 0;
            transition: all;
            transition-duration: 300ms;
            border-bottom: 2px solid rgba(255, 68, 0, 0);
        }
        nav div img {
            width: 300PX;
            border-radius: none;
        }

        nav ul li a:hover {
            color: #ffffff;
            border-bottom: 2px solid #ffffff;
        }
        input[type=text] {
        float: right;
        padding: 6px;
        border: none;
        margin-top: 8px;
        margin-right: 16px;
        font-size: 17px;
        }
        
        .approved {
        color: #008000;
        }
        .declined {
            color: #ff0000;
        }
        
        .success-message {
        background-color: #d4edda;
        color: #155724; 
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #c3e6cb; 
        border-radius: 5px; 
    }

    .error-message {
        background-color: #f8d7da; 
        color: #721c24; 
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #f5c6cb; 
        border-radius: 5px; 
    }

    .prev-page, .next-page {
            margin-top: 2px;
            background-color: #4fa2ed;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
    }
    .prev-page, .next-page span{
            color: #fff;
    }
    .export-approved, .export-declined, .emails-btn {
            position: fixed;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            
    }
    .export-approved {
        left: 18%;
        top: 90%;
        background-color: #00AB41;
        color: #fff;
        border: none;
    }
    .export-declined {
        left: 36%;
        top: 90%;
        background-color: #ff0000;
        color: #fff;
        border: none;
    }
    .emails-btn {
        left: 60%;
        top: 90%;
        background-color: #4fa2ed;
        color: #fff;
        border: none;
    }

    .pages {
        margin-left: 18%;
    }
    .search-container {
        float: right;
        margin-right: 16px; /* Adjust the right margin as needed */
        margin-top: 20px;
    }

    .search-container button {
        padding: 5px 20px;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        transform: translateX(-20px);
        transform: translateY(5px);
    }

</style>
</head>
<body>
    

<div class="wrapper">
        <?php include('sidebar.php');  ?>
    </div>
    </div>

    <div id="messages">
    <?php
    // Display success message
    if (isset($_SESSION['success_message'])) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '" . $_SESSION['success_message'] . "',
                    showConfirmButton: false,
                    timer: 2000
                });
              </script>";
        unset($_SESSION['success_message']);
    }

    // Display error message
    if (isset($_SESSION['error_message'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '" . $_SESSION['error_message'] . "'
                });
              </script>";
        unset($_SESSION['error_message']);
    }
    ?>
    </div>

    <div class="search-container">
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="lrn_search" placeholder="Search by LRN" value="<?php echo $lrnSearch; ?>">
        <button class="SRCH" type="submit">Search</button>
    </form>
</div>
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <div class="div"></div>
        <table id="example" class="table table-striped table-bordered" style="width:80%"> 
    <tr>
        <th>LRN</th>
        <th>Student Name</th>
        <th>Age</th>
        <th>Grade Level</th>
        <th>Academic Track</th>
        <th>Uploaded File</th>
        <th>Status</th>
        <th>Actions</th>
        
    </tr>
    <?php
        // Include the necessary PHPMailer files
        require 'vendor/autoload.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    

        // for loop to limit the display to 5 rows
        for ($i = 0; $i < $studentsPerPage && ($row = $result->fetch_assoc()); $i++) {
            echo "<tr>";
            echo "<td>" . $row['lrn'] . "</td>";
            echo "<td>" . $row['fname'] ." ". $row['mname']." ". $row['lname']. "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['year_level'] . "</td>";
            echo "<td>" . $row['strand'] . "</td>";

            echo "<td>";
                $fileLrn = $row['lrn'];
                $sqlFile = "SELECT file_name FROM uploaded_files WHERE lrn = '$fileLrn'";
                $resultFile = $conn->query($sqlFile);

                    if ($resultFile->num_rows > 0) {
                        $fileRow = $resultFile->fetch_assoc();
                        echo "<a class='file-link' href='#' data-file='" . $fileRow['file_name'] . "'>View FILE</a>";
                    } else {
                        echo "No file uploaded";
                    }

            echo "</td>";
            
            echo "<td class='" . strtolower($row['status']) . "'>" . $row['status'] . "</td>";

                // Check if the status is 'approved'
                if ($row['status'] == 'Approved') {
                    // Display 'Send Email' button with SweetAlert confirmation and input prompt
                    echo "<td><a class='send-email-button' href='javascript:void(0);' onclick='sendEmail(" . $row['lrn'] . ")'><span>Send Email</span></a></td>";
                } else {
                    // Display 'Approve' and 'Decline' buttons
                    echo "<td>
                        <a class='app-button' href='javascript:void(0);' onclick='confirmAction(\"approve\", " . $row['lrn'] . ")'><span>Approve</span></a> |
                        <a class='del-button' href='javascript:void(0);' onclick='confirmAction(\"delete\", " . $row['lrn'] . ")'><span>Decline</span></a>
                    </td>";
                }

            echo "</tr>";
        }
    ?>

</table>

<div class="pages">
        <?php if ($current_page > 1): ?>
            <button class="prev-page"><a href="?page=<?php echo $current_page - 1; ?>"><span>Previous</span></a></button>
        <?php endif; ?>

        <?php
        // Check if there are more pages
        $nextPage = $current_page + 1;
        $lastPage = ceil($totalStudents / $studentsPerPage);

        if ($nextPage <= $lastPage): ?>
            <button class="next-page"><a href="?page=<?php echo $nextPage; ?>"><span>Next</span></a></button>
        <?php endif; ?>
</div>

<button class="export-approved" id="export-approved-btn"><span>Export Approved Students</span></button>
<button class="export-declined" id="export-declined-btn"><span>Export Declined Students</span></button>
<!-- <button class="emails-btn" id="emails-btn"><a href="emails.php"><span>SEND EMAIL TO STUDENT</span></button></a> -->

</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        function confirmAction(action, lrn) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, proceed with the action
                    window.location.href = `?page=<?php echo $current_page; ?>&lrn=${lrn}&action=${action}`;
                }
            });
        }
    </script>
<script>
$(document).ready(function() {
    $("#export-approved-btn").click(function() {
        window.location.href = "export_approved.php";
    });

    $("#export-declined-btn").click(function() {
        window.location.href = "export_declined.php";
    });
});
</script>
<script>
function confirmAction(action, lrn) {
    if (action === 'delete') {
        Swal.fire({
            title: 'Enter note for declining:',
            input: 'text',
            inputLabel: 'Note',
            inputPlaceholder: 'Enter your note here...',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Decline',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const note = result.value.trim();
                if (note !== "") {
                    window.location.href = `?page=<?php echo $current_page; ?>&lrn=${lrn}&action=${action}&note=${note}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Note is required',
                        text: 'Please enter a note before declining.'
                    });
                }
            }
        });
    } else if (action === 'approve') {
        // Code for approving a student
        Swal.fire({
            title: 'Enter note for approval:',
            input: 'text',
            inputLabel: 'Note',
            inputPlaceholder: 'Enter your note here...',
            showCancelButton: true,
            confirmButtonColor: '#4fa2ed',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Approve',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const note = result.value.trim();
                if (note !== "") {
                    window.location.href = `?page=<?php echo $current_page; ?>&lrn=${lrn}&action=${action}&note=${note}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Note is required',
                        text: 'Please enter a note before approving.'
                    });
                }
            }
        });
    }
}
</script>
<script>
    function sendEmail(lrn) {
        console.log('LRN:', lrn);
        Swal.fire({
            title: "Schedule Meeting",
            text: "Enter the schedule for face-to-face meeting:",
            input: "datetime-local",
            showCancelButton: true,
            confirmButtonText: "Send Email",
            preConfirm: (value) => {
                if (!value) {
                    Swal.showValidationMessage("Please enter a valid schedule");
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Schedule:', result.value);

                // Call a PHP script to handle sending emails using PHPMailer
                sendEmailPHP(lrn, result.value);
            }
        });
    }

    function sendEmailPHP(lrn, schedule) {
        // AJAX call to a PHP script that sends the email using PHPMailer
        $.ajax({
            type: "POST",
            url: "send_email.php",
            data: {
                lrn: lrn,
                schedule: schedule,
            },
            success: function (response) {
                Swal.fire("Email Sent!", "An email has been sent to the student.", "success");
            },
            error: function (error) {
                Swal.fire("Error", "Failed to send email. Please try again later.", "error");
            },
        });
    }
</script>
<script>
    // Function to open the PDF in a new tab
    function openPDF(file) {
        window.open(file, '_blank');
    }

    // Attach a click event to all elements with the 'file-link' class
    document.querySelectorAll('.file-link').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            var fileName = this.getAttribute('data-file');
            var pdfPath = 'http://localhost/III%20-%20BINS/FINALIZED/PHS%20FILES/' + fileName;

            openPDF(pdfPath);
        });
    });
</script>
