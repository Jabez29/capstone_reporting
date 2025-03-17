<?php
session_start();
include '../includes/config.php';

$first_name = trim($_POST['first_name'] ?? '');
$middle_name = trim($_POST['middle_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$student_number = trim($_POST['student_number'] ?? '');
$graduation_year = trim($_POST['graduation_year'] ?? '');

$sql = "SELECT * FROM graduates 
        WHERE student_number = ? 
        AND last_name = ? 
        AND first_name = ? 
        AND middle_name = ? 
        AND graduation_year = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$student_number, $last_name, $first_name, $middle_name, $graduation_year]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
        $_SESSION['alumni_data'] = $result;
        $_SESSION['student_number'] = $student_number; // Store student number
        $_SESSION['graduate_id'] = $result['id']; // Store graduate_id
    
        echo "<script>
                alert('Verification successful! Please proceed to the Graduate Tracer Survey.');
                window.location.href = '../geninfo.php';
              </script>";
    } else {
        echo "<script>
                alert('Verification failed. Graduate not found.');
                window.location.href='../index.php';
              </script>";
    }
?>