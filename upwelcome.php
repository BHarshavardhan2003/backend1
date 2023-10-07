<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $cgpa = isset($_POST['rollno']) ? $_POST['rollno'] : '';
    $select_your_branch = isset($_POST['branch']) ? $_POST['branch'] : '';
    $preference_1 = isset($_POST['preference1']) ? $_POST['preference1'] : '';
    $preference_2 = isset($_POST['preference2']) ? $_POST['preference2'] : '';
    $preference_3 = isset($_POST['preference3']) ? $_POST['preference3'] : '';

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sahil";

    
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if (!$conn) {
        die("Sorry, we failed to connect: " . mysqli_connect_error());
    } else {
        
        $sql = "INSERT INTO `students` (`name`, `cgpa`, `branch`, `preference_1`,`preference_2`,`preference_3`) 
                VALUES ('$name', '$cgpa', '$select_your_branch','$preference_1','$preference_2', '$preference_3')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your entry has been submitted successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> We are facing some technical issue, and your entry was not submitted successfully! We regret the inconvenience caused!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DEPARTMENT PREFERENCE FORM</title>
    <style>
       
        body {
            background: linear-gradient(#141e30, #243b55);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

       
        .container {
            background-color: #141e30;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

       
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        h1 {
            margin-top: 0; 
            font-size: 24px; 
            text-align: center; 
            color: #fff;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
        }

       
        input[type="text"],
        input[type="number"],
        select {
            padding: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

       
        select {
            width: 100%;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
    <script>
        function updateOptions() {
            var branch = document.getElementById("branch").value;
            var optionsDiv = document.getElementById("optionsDiv");
            optionsDiv.innerHTML = '';

           
            var options = {
                "comp": ["Option 1", "Option 2", "Option 3"],
                "extc": ["Option 4", "Option 5", "Option 6"],
                "mech": ["Option 7", "Option 8", "Option 9"],
                "it": ["Option 10", "Option 11", "Option 12"]
            };

            for (var i = 1; i <= 3; i++) {
                var label = document.createElement("label");
                label.textContent = "Preference " + i + ": ";

                var select = document.createElement("select");
                select.name = "preference" + i;

                for (var j = 0; j < options[branch].length; j++) {
                    var option = document.createElement("option");
                    option.value = options[branch][j];
                    option.textContent = options[branch][j];
                    select.appendChild(option);
                }

                optionsDiv.appendChild(label);
                optionsDiv.appendChild(select);
                optionsDiv.appendChild(document.createElement("br"));
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>DEPARTMENT LEVEL PREFERENCE FORM</h1>
        <form action="" method="POST"> 
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="rollno">CGPA:</label> 
            <input type="number" id="rollno" name="rollno" required min="1" max="999">
            
            <label for="branch">Select your branch:</label>
            <select id="branch" name="branch" onchange="updateOptions()">
                <option value="selects">SELECT</option>
                <option value="comp">Computer</option>
                <option value="extc">Electronics and Telecommunication</option>
                <option value="mech">Mechanical</option>
                <option value="it">Info Technology</option>
            </select>

            <div id="optionsDiv">
                <!-- Options will be dynamically generated here based on the branch selection -->
            </div>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
