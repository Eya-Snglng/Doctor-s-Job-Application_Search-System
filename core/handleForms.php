<?php
session_start();
require_once 'dbConfig.php';
require_once 'models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insertUserBtn'])) {
        $result = insertApplicant($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], 
            $_POST['specialization'], $_POST['experience'], $_POST['hospital'], $_POST['phone_number']);
        $_SESSION['message'] = $result ? "Applicant successfully added." : "Failed to add applicant.";
    } elseif (isset($_POST['editUserBtn'])) {
        $id = $_GET['id'] ?? null;
        $result = editApplicant($pdo, $id, $_POST['first_name'], $_POST['last_name'], $_POST['email'], 
            $_POST['specialization'], $_POST['experience'], $_POST['hospital'], $_POST['phone_number']);
        $_SESSION['message'] = $result ? "Applicant successfully updated." : "Failed to update applicant.";
    }

    header("Location: ../index.php");
    exit();
}

?>
