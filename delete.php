<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Applicants</title>
    <link rel="stylesheet" href="styles.css">
</head>

<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // If the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $deleteResponse = deleteApplicant($pdo, $id);
        $_SESSION['message'] = $deleteResponse['message'];
        header('Location: index.php');
        exit();
    }

    // Confirmation prompt
    echo '<h1>Are you sure you want to delete this applicant?</h1>';
    echo '<a href="index.php">Back</a> | <a href="delete.php?id=' . $id . '&confirm=yes">Confirm</a>';
    exit();
}
?>
