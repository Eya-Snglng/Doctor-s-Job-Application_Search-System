<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $applicantData = getApplicantByID($pdo, $id);

    if ($applicantData['statusCode'] === 200) {
        $applicant = $applicantData['querySet'];
    } else {
        $_SESSION['message'] = $applicantData['message'];
        header('Location: index.php');
        exit();
    }
}

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
    $id = $_POST['id'];

    $updateResponse = updateApplicant($pdo, $data, $id);
    $_SESSION['message'] = $updateResponse['message'];
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Applicant</h1>
    <?php if (!empty($_SESSION['message'])) { echo "<p class='message'>{$_SESSION['message']}</p>"; unset($_SESSION['message']); } ?>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $applicant['id']; ?>">
        <p>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo $applicant['first_name']; ?>" required>
        </p>
        <p>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $applicant['last_name']; ?>" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $applicant['email']; ?>" required>
        </p>
        <p>
            <label for="specialization">Specialization:</label>
            <input type="text" name="specialization" value="<?php echo $applicant['specialization']; ?>" required>
        </p>
        <p>
            <label for="experience">Experience (years):</label>
            <input type="number" name="experience" value="<?php echo $applicant['experience']; ?>" required>
        </p>
        <p>
            <label for="hospital">Hospital:</label>
            <input type="text" name="hospital" value="<?php echo $applicant['hospital']; ?>" required>
        </p>
        <p>
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" value="<?php echo $applicant['phone_number']; ?>" required>
        </p>
        <button type="submit">Update Applicant</button>
    </form>
</body>
</html>
