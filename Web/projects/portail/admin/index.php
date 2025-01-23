
<?php

// print_r($_SERVER);

// if (!function_exists('getallheaders')) {
//   function getallheaders() {
//       $headers = array();
//       foreach ($_SERVER as $name => $value) {
//           if (substr($name, 0, 5) == 'HTTP_') {
//               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
//           }
//       }
//       return $headers;
//   }
// }

// Récupérer les en-têtes envoyés par OAuth2 Proxy
// $headers = getallheaders();

// // Extraire les claims de Keycloak depuis les en-têtes
// $user = isset($headers['X-Auth-Request-User']) ? $headers['X-Auth-Request-User'] : 'Inconnu';
// $email = isset($headers['X-Auth-Request-Email']) ? $headers['X-Auth-Request-Email'] : 'Inconnu';
// $preferredUsername = isset($headers['X-Auth-Request-Preferred-Username']) ? $headers['X-Auth-Request-Preferred-Username'] : 'Inconnu';
// $roles = isset($headers['X-Auth-Request-Roles']) ? $headers['X-Auth-Request-Roles'] : 'Aucun';

// // Afficher les informations des claims
// echo '<h1>Informations Keycloak</h1>';
// echo '<p><strong>Utilisateur :</strong> ' . htmlspecialchars($user, ENT_QUOTES, 'UTF-8') . '</p>';
// echo '<p><strong>Email :</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>';
// echo '<p><strong>Nom d\'utilisateur préféré :</strong> ' . htmlspecialchars($preferredUsername, ENT_QUOTES, 'UTF-8') . '</p>';
// echo '<p><strong>Rôles :</strong> ' . htmlspecialchars($roles, ENT_QUOTES, 'UTF-8') . '</p>';

?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portail des services</title>
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

        <?php
            $keycloakRealm = "portail-sib";
            $logoutRedirectUri = "http://portail.tld";

            // URL de déconnexion Keycloak
            $logoutUrl = "http://keycloak.portail.tld/realms/" . $keycloakRealm . "/protocol/openid-connect/logout?redirect_uri=" . urlencode($logoutRedirectUri);

            // Vérifiez si l'utilisateur est connecté via HTTP_X_AUTH_REQUEST_EMAIL
            if (isset($_SERVER['HTTP_X_AUTH_REQUEST_EMAIL'])) {
                echo '<p>
                        <a href="' . $logoutUrl . '" style="padding:10px;margin:10px" class="btn btn-danger">Se déconnecter</a>
                    </p>';
            }
        ?>
        <p class="lead">Vous êtes connecté <?php 
       
         if (isset($_SERVER['HTTP_X_AUTH_REQUEST_EMAIL'])) {
           
             echo htmlspecialchars($_SERVER['HTTP_X_AUTH_REQUEST_EMAIL']);
         } 
        ?>
        </p>
        <a href="/admin/alpha" style="padding:10px;margin:10px" class="btn btn-primary">Aller au projet 1 (espace sécurisé)</a>
        <a href="/admin/beta" style="padding:10px;margin:10px" class="btn btn-primary">Aller au projet 2 (espace sécurisé)</a>
     
      </div>
      <div class="card-footer text-muted text-center">
        © 2024 Portail des services
      </div>
    </div>
  </div>
  <!-- Inclure Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
