

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portail des services web</title>
  <!-- Inclure Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
    <div class="card shadow-lg" style="max-width: 500px;">
      <div class="card-header bg-success text-white text-center">
        <h1>Portail des services</h1>
      </div>
      <div class="card-body text-center">
        <p class="lead">Bienvenue sur le portail des services web</p>
        <?php
          // Vérifiez si l'utilisateur est connecté via l'en-tête HTTP_X_AUTH_REQUEST_EMAIL
          if (isset($_SERVER['HTTP_X_AUTH_REQUEST_EMAIL'])) {
              // L'utilisateur est connecté
              $userEmail = htmlspecialchars($_SERVER['HTTP_X_AUTH_REQUEST_EMAIL']);
              echo '<p class="lead">Vous êtes connecté en tant que ' . $userEmail . '</p>';
              echo '<p><a href="/admin/index.php" style="padding:10px;margin:10px" class="btn btn-success">Accéder au service</a></p>';
          } else {
              // L'utilisateur n'est pas connecté
              echo '<p class="lead">Vous n\'êtes pas connecté.</p>';
              echo '<p><a href="/admin/index.php" style="padding:10px;margin:10px" class="btn btn-primary">Se connecter</a></p>';
          }
        ?>
      </div>
      <div class="card-footer text-muted text-center">
        © 2025 Portail des services
      </div>
    </div>
  </div>
  <!-- Inclure Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
