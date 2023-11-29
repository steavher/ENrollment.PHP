<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<style>
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
        span {
            color: #fff;
            bottom: 10px;
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
        table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
        border: 1px solid black;
        padding: 5px;
        }

        th {
        background-color: #ccc;
        }
        
</style>
</head>
<body>
    
<nav>
		<div class="logo">
        <a href="admin_dashboard.php" ><img src="../IMAGES/LOGOS.png"></a>
		</div>
				<ul>

					<li> <input type="text" placeholder="Search" > </li>

				</ul>
	</nav>
<div class="wrapper">
        <?php include('sidebar.php'); // Include the sidebar content ?>
        <div class="main_content">
            <div class="header">Welcome!! Have a nice day.</div>
            <!-- Rest of your content goes here -->
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:65%"> 
            
        </table>
        <!-- <?php

// // Connect to the database.
// $db = new PDO('mysql:host=localhost;dbname=my_database', 'root', '');

// // Get all of the users from the database.
// $users = $db->query('SELECT * FROM accounts');

// // Start the HTML table.
// echo '<table>';

// // Create the table header row.
// echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>';

// // Loop through all of the users and add them to the table.
// foreach ($users as $user) {
//     echo '<tr>';
//     echo '<td>' . $user['id'] . '</td>';
//     echo '<td>' . $user['name'] . '</td>';
//     echo '<td>' . $user['email'] . '</td>';
//     echo '<td>' . $user['role'] . '</td>';
//     echo '</tr>';
// }

// Close the HTML table.
// echo '</table>';

?> -->
    </div>

</body>
</html>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
