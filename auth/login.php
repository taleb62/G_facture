
<!DOCTYPE html>
k
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
    <link rel="stylesheet" href="style.css">
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="login.php" method="post" >
        <h3>Login 
          
        </h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <button type="submit">Log In</button>
      
        <?php if(isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
<?php
session_start();

require_once "../conn.php"; // Assurez-vous que ce chemin est correct

$error = '';  // Variable pour stocker le message d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier l'authentification
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $_SESSION['user_id'] = 1;  // ID statique pour la session
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        header("Location: ../index.php");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

