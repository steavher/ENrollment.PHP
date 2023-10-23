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
            height: 100vw;
            align-items: center;
            display: flex;
            justify-content: center;
            background-image: url(FINAL.png);
            background-repeat: no-repeat;
            background-size: cover;
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
            <h1>Welcome to the Enrollment Process</h1>
            <p>Follow the steps below to enroll in our program:</p>

            <h2>Registration Form:</h2>
            
            <input type="text" id="first_name" placeholder="First Name" name="first_name" required><br>

            <input type="text" id="middle_name" placeholder="Middle Name" name="middle_name"><br>

            <input type="text" id="last_name" placeholder="Last Name" name="last_name" required><br>

            <input type="number" id="age" placeholder="Age" name="age" required><br>

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
                <option value="TVL">TVL (Technical-Vocational-Livelihood)</option>
                <option value="GAS">GAS (General Academic Strand)</option>
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
                <li>High school diploma or equivalent</li>
                <li>Valid government-issued ID</li>
                <li>Payment method for the enrollment fee</li>
                <li>Original Report Card (Form 138)</li>
                <li>Permanent Record (Form 137)</li>
                <li>Certificate of Good Moral</li>
                <li>2 pcs. 1x1 Colored ID picture</li>
                <li>NSO Birth Certificate (Photocopy)</li>
            </ul>

            <label for="file_upload">Upload Documents:</label>
            <input type="file" id="file_upload" name="file_upload" multiple><br>

            <input type="submit" value="Submit">

            <ol id="stepsList" class="hidden">
                <li>Complete the online application form.</li>
                <li>Upload your documents, including transcripts and ID.</li>
                <li>Pay the enrollment fee.</li>
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
