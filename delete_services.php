<?php
session_start();
require 'db_connection.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}


if (isset($_GET['service_id'])) {
    $services_id = intval($_GET['service_id']);
    
    
    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param('i', $services_id);

        if ($stmt->execute()) {
          
            $_SESSION['message'] = "Service deleted successfully!";
            header('Location: admin_services.php');
        } else {
            
            $_SESSION['message'] = "Error deleting service: " . $stmt->error;
            header('Location: admin_services.php');
        }

        $stmt->close();
    } else {
        
        $_SESSION['message'] = "Error preparing statement: " . $conn->error;
        header('Location: admin_services.php');
    }
} else {
    
    $_SESSION['message'] = "Service ID is not set.";
    header('Location: admin_services.php');
}
?>
