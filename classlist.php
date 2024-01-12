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

require 'vendor/autoload.php';
// Include the necessary PhpSpreadsheet classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_GET['export_abm'])) {
    exportClassList('ABM');
} elseif (isset($_GET['export_stem'])) {
    exportClassList('STEM');
} elseif (isset($_GET['export_humss'])) {
    exportClassList('HUMSS');
}

function exportClassList($academicTrack) {
    global $conn;

    $sql = "SELECT names.*, student_info.gender
        FROM names
        INNER JOIN student_info ON names.lrn = student_info.lrn
        WHERE names.strand = '$academicTrack' AND names.Status = 'Approved'
        ORDER BY student_info.gender, names.lrn";

    $result = $conn->query($sql);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'LRN');
    $sheet->setCellValue('B1', 'Student Name');
    $sheet->setCellValue('C1', 'Age');
    $sheet->setCellValue('D1', 'Gender'); // Added column for gender
    $sheet->setCellValue('E1', 'LRN'); // Added column for female LRN
    $sheet->setCellValue('F1', 'Student Name'); // Added column for female name
    $sheet->setCellValue('G1', 'Age'); // Added column for female age
    $sheet->setCellValue('H1', 'Gender'); // Added column for female gender

    $sheet->getStyle('A')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

    $row = 2;
    $maleCount = 0;
    $femaleCount = 0;

    while ($row_data = $result->fetch_assoc()) {
        // Separate male and female into different columns
        if ($row_data['gender'] == 'male') {
            $sheet->setCellValueExplicit('A' . $row, $row_data['lrn'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('B' . $row, $row_data['fname'] . ' ' . $row_data['mname'] . ' ' . $row_data['lname']);
            $sheet->setCellValue('C' . $row, $row_data['age']);
            $sheet->setCellValue('D' . $row, $row_data['gender']);
            $maleCount++;
        } elseif ($row_data['gender'] == 'female') {
            $sheet->setCellValueExplicit('E' . $row, $row_data['lrn'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $row_data['fname'] . ' ' . $row_data['mname'] . ' ' . $row_data['lname']);
            $sheet->setCellValue('G' . $row, $row_data['age']);
            $sheet->setCellValue('H' . $row, $row_data['gender']);
            $femaleCount++;
        }

        // Check if the maximum count is reached for each gender
        if ($maleCount + $femaleCount >= 40) {
            break;
        }

        $row++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $academicTrack . '_Class_List.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLASS LISTS</title>
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

        button {
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 2px 4px;
            cursor: pointer;
        }

        .abm-exp {
            background-color: #00ccaa;
            color: #fff;
        }

        .stem-exp {
            background-color: green; 
            color: #fff;
        }
        .humss-exp {
            background-color: yellow; 
            color: #000;
        }
    </style>
</head>
<body>

<div class="wrapper">
        <?php include('sidebar.php');  ?>
    </div>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:80%"> 
        <tr>
            <th>ABM CLASS LIST</th>
            <th>STEM CLASS LIST</th>
            <th>HUMSS CLASS LIST</th>
        </tr>

        <tr>
        <td><button class="abm-exp" onclick="location.href='classlist.php?export_abm'">Export ABM Class List</button></td>
        <td><button class="stem-exp" onclick="location.href='classlist.php?export_stem'">Export STEM Class List</button></td>
        <td><button class="humss-exp" onclick="location.href='classlist.php?export_humss'">Export HUMSS Class List</button></td>
        </tr>
    </table>


</body>
</html>
