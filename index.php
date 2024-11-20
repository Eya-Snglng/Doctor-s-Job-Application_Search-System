<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_GET['searchBtn'])) {
    $searchResult = searchApplicants($pdo, $_GET['searchInput']);
    $applicants = $searchResult['querySet'] ?? [];
    $message = $searchResult['message'];
    $searchSuccessMessage = !empty($applicants) ? "Search completed successfully! Found " . count($applicants) . " result(s)." : "No applicants found matching your search.";
} else {
    $allApplicants = getAllApplicants($pdo);
    $applicants = $allApplicants['querySet'] ?? [];
    $message = $allApplicants['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors' Job Applications</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            Doctor Job Applicants Management System
        </header>
        
        <!-- Display Success or Error Message -->
        <?php if (!empty($message)) { echo "<p class='message success'>$message</p>"; } ?>
        <?php if (!empty($searchSuccessMessage)) { echo "<p class='message success'>$searchSuccessMessage</p>"; } ?>

        <h1>Job Applicants</h1>

        <form action="index.php" method="GET">
            <input type="text" name="searchInput" placeholder="Search for applicants">
            <input type="submit" name="searchBtn" value="Search">
        </form>

        <p><a class="clear-search" href="index.php">Clear Search</a></p>
        <p><a href="insert.php">Insert New Applicant</a></p>

        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Specialization</th>
                    <th>Experience</th>
                    <th>Hospital</th>
                    <th>Phone Number</th>
                    <th>Date Applied</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($applicants)) {
                    foreach ($applicants as $applicant) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($applicant['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['specialization']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['experience']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['hospital']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['date_applied']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $applicant['id']; ?>">Edit</a>
                                <a href="delete.php?id=<?php echo $applicant['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo '<tr><td colspan="9">No applicants found.</td></tr>';
                } ?>
            </tbody>
        </table>

        <footer>
            Doctor Job Applicants Management System - 2024
        </footer>
    </div>
</body>
</html>