<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ENROLLMENT PROCESS</title>
    <style>
        *{
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            align-items: center;
            display: flex;
            justify-content: center;
            background-image: url("../IMAGES/PSHS.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            overflow-y: auto;
        }

        form {
            width: 500px;
            border: 5px solid #ccc;
            padding: 30px;
            background: #fff;
            border-radius: 30px;
            border-color: #4fa2ed;
            background: rgba(225, 225, 225, 0.8);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            backdrop-filter: blur(5px);
        }

        form div img {
            width: 80px;
            align-items: center;
            display: flex;
            border: 3px solid;
            border-color: #4fa2ed;
            border-radius: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        .reg-cont input,textarea,select {
            background: rgba(225, 225, 225, 0.5);
            display: block;
            width: 95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 10px;
        }

        .hidden {
            display: none;
        }

        .reg-cont button {
            background-color: #4fa2ed;
            display: block;
            width: 95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 12px;
        }

        .new button {
            background-color: #4fa2ed;
            display: block;
            width: 50%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 12px;

        }

        .requirementsSection .new {
            margin-top: 20px;
        }

        @media(max-width: 767px){
            .footer-col{
                width: 50%;
                margin-bottom: 30px;
            }
            }
            @media(max-width: 574px){
            .footer-col{
                width: 100%;
            }
        }
    </style>
</head>
<body>

    
    <form action="process_registration.php" method="POST" enctype="multipart/form-data" id="registrationForm">

        <div class="reg-cont">
            <img src="../IMAGES/LOGO.png">
            <h2>Welcome to the Enrollment Process</h2>
            <p>Follow the steps below to enroll in our program:</p>

            <h2>Registration Form:</h2>
            <label for="First_name">First Name:</label>
            <input type="text" id="first_name" placeholder="First Name" name="first_name" required><br>
            <label for="Middle_name">Middle Name:</label>
            <input type="text" id="middle_name" placeholder="Middle Name" name="middle_name"><br>
            <label for="Last_name">Last Name:</label>
            <input type="text" id="last_name" placeholder="Last Name" name="last_name" required><br>
            <label for="Age">Age:</label>
            <input type="number" id="age" placeholder="Age" name="age" required><br>
            <label for="Parents">Parents Name / Guardians Name:</label>
            <input type="text" id="guardian" placeholder="Parent/Guardian Name" name="Parents/Guardian" required> <br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" required><br>

            <label for="course">Select Course:</label>
            <select id="course" name="course" required>
                <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                <option value="HUMSS">HUMMS (Humanities and Social Sciences)</option>
                
            </select><br>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required><br>

            <button id="nextButton" type="button">Next</button>
        </div>
    </form>
    <div id="requirementsSection" class="hidden">
        <form class="new">
            <h2>Requirements:</h2>
            <ul>
                <li>Original Report Card (Form 138)</li>
                <li>Permanent Record (Form 137)</li>
                <li>Certificate of Good Moral</li>
                <li>NSO Birth Certificate (Photocopy)</li>
            </ul>

            <label for="file_upload">Upload Documents:</label>
            <input type="file" id="file_upload" name="file_upload" multiple><br>

            <button id="SUBMIT" type="submit">Submit</button>

            <ol id="stepsList" class="hidden">
                <li>Complete the online application form.</li>
                <li>Upload your documents, including transcripts and ID.</li>
                <li>Wait for confirmation of enrollment via email.</li>
            </ol>
        </form>
    </div>
    

    <script>
        const registrationForm = document.getElementById("registrationForm");
        const nextButton = document.getElementById("nextButton");
        const requirementsSection = document.getElementById("requirementsSection");
        const stepsList = document.getElementById("stepsList");

        nextButton.addEventListener("click", function () {
            registrationForm.style.display = "none";
            requirementsSection.style.display = "block";
            stepsList.style.display = "block";
        });
    </script>
</body>
</html>
