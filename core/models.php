<?php
function getAllApplicants($pdo) {
    try {
        $query = $pdo->query("SELECT * FROM job_applicants ORDER BY date_applied DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return [
            'message' => 'Applicants retrieved successfully from database.',
            'statusCode' => 200,
            'querySet' => $result
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to retrieve applicants: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function searchApplicants($pdo, $search) {
    try {
        $sql = "SELECT * FROM job_applicants WHERE 
                first_name LIKE :search OR 
                last_name LIKE :search OR 
                email LIKE :search OR 
                specialization LIKE :search OR 
                hospital LIKE :search OR 
                phone_number LIKE :search";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':search' => '%' . $search . '%']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [
            'message' => 'Search results retrieved successfully.',
            'statusCode' => 200,
            'querySet' => $result
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Search failed: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function insertApplicant($pdo, $data) {
    try {
        $sql = "INSERT INTO job_applicants (first_name, last_name, email, specialization, experience, hospital, phone_number) 
                VALUES (:first_name, :last_name, :email, :specialization, :experience, :hospital, :phone_number)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        return [
            'message' => 'Applicant inserted successfully.',
            'statusCode' => 200
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to insert applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function getApplicantByID($pdo, $id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM job_applicants WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'message' => $result ? 'Applicant retrieved successfully.' : 'Applicant not found.',
            'statusCode' => $result ? 200 : 400,
            'querySet' => $result
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to retrieve applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function updateApplicant($pdo, $data, $id) {
    try {
        $sql = "UPDATE job_applicants SET 
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email, 
                specialization = :specialization, 
                experience = :experience, 
                hospital = :hospital, 
                phone_number = :phone_number 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_merge($data, ['id' => $id]));
        return [
            'message' => 'Applicant updated successfully.',
            'statusCode' => 200
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to update applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function deleteApplicant($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM job_applicants WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return [
            'message' => 'Applicant deleted successfully.',
            'statusCode' => 200
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to delete applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}
?>