<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<style>
    table {
        margin-top: 15%;
        margin-left: 45%;
    }
    nav {
            justify-content: space-between;
            background-color: #4fa2ed;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            padding: 5px 2rem 12px;
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
        
</style>
<nav>
		<div class="logo">
			<img src="IMAGES/PREV.png">
		</div>
				<ul>

					<li> <input type="text" placeholder="Search" > </li>

				</ul>
	</nav>
<div class="wrapper">
        <?php include('sidebar.php');  ?>
        <div class="main_content">
            <div class="header">Welcome!! Have a nice day.</div>
           
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<table>
    <tr>
        <th>Student Name</th>
        <th>Student Roll</th>
        <th>Actions</th>
    </tr>
    <tr>
        <td>John Doe</td>
        <td>123456</td>
        <td>
            <a href="STUDENTS.php?action=approve&id=1">Approve</a> |
            <a href="STUDENTS.php?action=delete&id=1">Delete</a>
        </td>
    </tr>
    <!-- Repeat the above row for each student -->
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

