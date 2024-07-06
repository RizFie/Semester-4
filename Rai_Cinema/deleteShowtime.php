<?php
include ('dbconn.php');
session_start();
// Check if user is admin
if ($_SESSION['privilege'] != "EMPLOYEE") {
    die("<script>alert('UNAUTHORIZED USER'); window.location.href='registerLogin.php';</script>");
    exit();
}

$movieName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_POST['movieId'];
    $showtimeToDelete = $_POST['showtimeToDelete'];

    $sql = "DELETE FROM seat WHERE idMovie = ? AND reserveTime = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param('ss', $movieId, $showtimeToDelete);

    if ($stmt->execute()) {
        echo "<script>alert('Showtime deleted successfully.'); window.location.href='showTime.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='showTime.php';</script>";
    }

    $stmt->close();
    $dbconn->close();
} else {
    if (isset($_GET['id'])) {
        $movieId = $_GET['id'];
    } else {
        die("Movie ID not provided.");
    }

    // Fetch all showtimes for the movie and ensure they are unique
    $sql = "SELECT DISTINCT reserveTime FROM seat WHERE idMovie = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param('s', $movieId);
    $stmt->execute();
    $result = $stmt->get_result();
    $showtimes = [];

    while ($row = $result->fetch_assoc()) {
        $showtimes[] = $row['reserveTime'];
    }
    $stmt->close();

    // Fetch the movie name
    $sql = "SELECT movie_name FROM movie WHERE idmovie = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param('s', $movieId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $movieName = $row['movie_name'];
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Showtime</title>
    <link rel="stylesheet" href="deleteShowtime.css">
</head>
<body>
    <div class="container">
        <h2>Delete <?php echo htmlspecialchars($movieName); ?> Showtime</h2>
        <form method="POST" action="deleteShowtime.php">
            <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
            <label for="showtimeToDelete">Select Showtime to Delete:</label>
            <select id="showtimeToDelete" name="showtimeToDelete" required>
                <?php foreach ($showtimes as $showtime): ?>
                    <option value="<?php echo $showtime; ?>"><?php echo $showtime; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Delete Showtime</button>
        </form>
        <button onclick="window.history.back()">Back</button>
    </div>
</body>
</html>
