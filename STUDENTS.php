
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>

<style>
    table {
       
        margin-top: 10%;
        margin-left: 18%;
        width: 80%;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border: solid 2px;
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

        .app-button {
            background-color: #4fa2ed;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;

            15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px
            
            2px;
            cursor: pointer;
            
        }
        .del-button {
            background-color: #ff0000;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            
            15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px
            
            2px;
            cursor: pointer;

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

        
</style>
<nav>
		<div class="logo">
        <a href="admin_dashboard.php" ><img src="IMAGES/LOGOS.png"></a>
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
        <div class="div"></div>
<table id="example" class="table table-striped table-bordered" style="width:80%"> 
    <tr>
        <th>Student Roll</th>
        <th>Student Name</th>
        <th>Age</th>
        <th>Email</th>
        <th>Academic Track</th>
        <th>Actions</th>
        
    </tr>
    <tr>
        <td>123456</td>
        <td>John Doe</td>
        <td></td>
        <td>
            <td>
        <td>
            <button class = "app-button" id="approve-button"><a href="#"><span>Approve</span></a></button> |
            <button class = "del-button" id="delete-button"><a href="#"><span>Delete</span></a></button>
        </td>
    </tr>
    <!-- Repeat the above row for each student -->
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const approveButton = document.getElementById('approve-button');
    const deleteButton = document.getElementById('delete-button');

    approveButton.addEventListener('click', () => {
      Swal.fire({
        title: 'Student Approved!',
        text: 'The Student was successfully approved.',
        icon: 'success',
        confirmButtonText: 'Close',
      });
    });

    deleteButton.addEventListener('click', () => {
      Swal.fire({
        title: 'Are you sure you want to delete this Student?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Student Deleted!',
            text: 'The Student was successfully deleted.',
            icon: 'success',
            confirmButtonText: 'Close',
          });
        }
      });
    });

  </script>

