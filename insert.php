<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'specialization' => $_POST['specialization'],
        'experience' => $_POST['experience'],
        'hospital' => $_POST['hospital'],
        'phone_number' => $_POST['phone_number']
    ];

    $insertResponse = insertApplicant($pdo, $data);
    $_SESSION['message'] = $insertResponse['message'];
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Insert New Applicant</h1>
    <form action="insert.php" method="POST">
        <p>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>
        </p>
        <p>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="specialization">Specialization:</label>
            <input type="text" name="specialization" required>
        </p>
        <p>
            <label for="experience">Experience (years):</label>
            <input type="number" name="experience" required>
        </p>
        <p>
            <label for="hospital">Hospital:</label>
            <input type="text" name="hospital" required>
        </p>
        <p>
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" required>
        </p>
        <button type="submit">Add Applicant</button>
    </form>
</body>
</html>
