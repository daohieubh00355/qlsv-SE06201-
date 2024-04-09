<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "qlsv";

// Create a connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add Student
    if (isset($_POST["add_student"])) {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $birthday = $_POST["birthday"];

        $query = "INSERT INTO students (fullname, email, phone, address, birthday) VALUES ('$fullname', '$email', '$phone', '$address', '$birthday')";

        if (mysqli_query($conn, $query)) {
            echo "Sinh viên đã được thêm thành công.";
        } else {
            echo "Lỗi: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    // Edit Student
    if (isset($_POST["edit_student"])) {
        $id = $_POST["id"];
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $birthday = $_POST["birthday"];

        $query = "UPDATE students SET fullname='$fullname', email='$email', phone='$phone', address='$address', birthday='$birthday' WHERE id=$id";

        if (mysqli_query($conn, $query)) {
            echo "Thông tin sinh viên đã được cập nhật thành công.";
        } else {
            echo "Lỗi: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    // Delete Student
    if (isset($_POST["delete_student"])) {
        $id = $_POST["id"];

        $query = "DELETE FROM students WHERE id=$id";

        if (mysqli_query($conn, $query)) {
            echo "Sinh viên đã được xóa thành công.";
        } else {
            echo "Lỗi: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Execute the SELECT query
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch all rows as an associative array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Table Styles */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        /* th {
            background-color: darkorchid;
            color: #333;
        } */
        /* tr:nth-child(even) {
            background-color: blue;
        } */
        /* tr.rainbow-row {
            animation: rainbow 5s infinite;
        } */
        /* tr:hover {
            background-color: red;
        } */

        /* Heading Style
        h2 {
            color: #333;
            background-color: blue;
            padding: 10px;
            margin-bottom: 20px;
        } */

        /* Rainbow Animation */
        @keyframes rainbow {
            0% { background-color: red; }
            14% { background-color: orange; }
            28% { background-color: yellow; }
            42% { background-color: green; }
            57% { background-color: blue; }
            71% { background-color: indigo; }
            85% { background-color: violet; }
            100% { background-color: red; }
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
             background-color: darkorchid;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            margin: 8px 0;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"]:last-of-type {
             background-color: #f44336;
        }

        button[type="submit"]:last-of-type:hover {
          background-color: #d32f2f;
        } */

    </style>
</head>
<body>

<h2>Students</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Fullname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Birthday</th>
    </tr>
    <?php foreach ($rows as $row) { ?>
        <tr class="student-row">
            <td class="student-info" onclick="fillForm('<?php echo $row['id']; ?>', '<?php echo $row['fullname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['birthday']; ?>')"><?php echo $row['id']; ?></td>
            <td class="student-info" onclick="fillForm('<?php echo $row['id']; ?>', '<?php echo $row['fullname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['birthday']; ?>')"><?php echo $row['fullname']; ?></td>
            <td class="student-info" onclick="fillForm('<?php echo $row['id']; ?>', '<?php echo $row['fullname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['birthday']; ?>')"><?php echo $row['email']; ?></td>
            <td class="student-info" onclick="fillForm('<?php echo $row['id']; ?>', '<?php echo $row['fullname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['birthday']; ?>')"><?php echo $row['phone']; ?></td>
            <td class="student-info" onclick="fillForm('<?php echo $row['id']; ?>', '<?php echo $row['fullname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['birthday']; ?>')"><?php echo $row['address']; ?></td>
            <td class="student-info" onclick="fillForm('<?php echo $row['id']; ?>', '<?php echo $row['fullname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['birthday']; ?>')"><?php echo $row['birthday']; ?></td>
        </tr>
    <?php } ?>
</table>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="id" id="id">
    <input type="text" name="fullname" id="fullname" placeholder="Fullname">
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="text" name="phone" id="phone" placeholder="Phone">
    <input type="text" name="address" id="address" placeholder="Address">
    <input type="date" name="birthday" id="birthday">
    <button type="submit" name="add_student">Thêm sinh viên</button>
    <button type="submit" name="edit_student">Sửa sinh viên</button>
    <button type="submit" name="delete_student">Xóa sinh viên</button>
</form>

<script>
    function fillForm(id, fullname, email, phone, address, birthday) {
        document.getElementById('id').value = id;
        document.getElementById('fullname').value = fullname;
        document.getElementById('email').value = email;
        document.getElementById('phone').value = phone;
        document.getElementById('address').value = address;
        document.getElementById('birthday').value = birthday;
    }
</script>
<button class="logout-button" onclick="logout()">Logout</button>
<script>
    function logout() {
        window.location.href = "signin_page.php";
    }
</script>

</body>
</html>
