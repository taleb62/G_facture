<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

// Récupérer les informations de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id']; // Supposons que l'ID de l'utilisateur soit stocké dans la session
// Vous devez remplacer cette partie avec vos propres méthodes de récupération des données utilisateur depuis la base de données
// Vous devez également remplacer les valeurs par défaut des champs du formulaire par les valeurs réelles de l'utilisateur
$user_info = array(
    'firstname' => 'William',
    'lastname' => 'Castillo',
    'email' => 'william@example.com',
    'phone' => '+1452 876 5432',
    'username' => 'username',
    'password' => 'password'
);

// Traitement de la mise à jour des informations de l'utilisateur s'il y a soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mettre à jour les données de l'utilisateur dans la base de données
    // Vous devez remplacer cette partie avec vos propres méthodes de mise à jour des données utilisateur dans la base de données
    // Assurez-vous de valider et de sécuriser les données avant de les insérer dans la base de données
    $user_info['firstname'] = $_POST['firstname'];
    $user_info['lastname'] = $_POST['lastname'];
    $user_info['email'] = $_POST['email'];
    $user_info['phone'] = $_POST['phone'];
    $user_info['username'] = $_POST['username'];
    $user_info['password'] = $_POST['password'];
    // Après avoir mis à jour les informations, vous pouvez rediriger l'utilisateur vers la page de profil pour afficher les changements effectués
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Mettez ici vos balises meta, titre, feuilles de style, etc. -->
  <title>Dreams Pos admin template</title>
</head>

<body>
  <div class="main-wrapper">
    <?php include "includes/header.php"; ?>
    <?php include "includes/sidebar.php"; ?>

    <div class="page-wrapper">
      <div class="content">
        <div class="page-header">
          <div class="page-title">
            <h4>Profile</h4>
            <h6>User Profile</h6>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" placeholder="William" value="<?php echo $user_info['firstname']; ?>">
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" placeholder="Castillo" value="<?php echo $user_info['lastname']; ?>">
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="william@example.com" value="<?php echo $user_info['email']; ?>">
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="+1452 876 5432" value="<?php echo $user_info['phone']; ?>">
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="username" placeholder="username" value="<?php echo $user_info['username']; ?>">
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password" value="<?php echo $user_info['password']; ?>">
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-submit me-2">Save</button>
                  <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Inclure les liens vers les fichiers JavaScript nécessaires -->

</body>

</html>
