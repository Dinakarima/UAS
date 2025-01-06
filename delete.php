<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate the ID to ensure it's an integer
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        header("Location: index.php?message=ID tidak valid");
        exit();
    }

    // Prepare the statement to delete data from the inventaris table
    $stmt = $conn->prepare("DELETE FROM inventaris WHERE id = ?");
    
    // Bind the parameter (i for integer)
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to index with success message
        header("Location: index.php?message=Data berhasil dihapus");
    } else {
        // Redirect with an error message if deletion fails
        header("Location: index.php?message=Gagal menghapus data");
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect with an error message if no ID is provided
    header("Location: index.php?message=ID tidak ditemukan");
    exit();
}
?>