# Keycloak, Traefik, OAuth2 et Web PHP

<p align="center">
    <img src="https://github.com/Rbtsv2/poc-traefik-keycloak-oauth2-web-php/blob/master/poc.png?raw=true" width="500" alt="Keycloak OAuth2 Traefik">
</p>


## Description

Ce projet est une preuve de concept (POC) permettant d'utiliser Traefik comme reverse proxy, Keycloak comme fournisseur d'authentification, et OAuth2 Proxy pour sécuriser l'accès à plusieurs services web PHP.

Le projet est organisé en trois parties :
- **Keycloak_Traefik** : Contient les configurations pour Keycloak et Traefik.
- **OAuth2** : Contient la configuration du proxy OAuth2.
- **Web** : Contient les projets web en PHP avec leurs configurations respectives de Nginx.

---

## Prérequis

- Docker et Docker Compose installés.
- Un éditeur de texte (VSCode, Nano, Vim, etc.).
- Configuration du fichier `hosts` local pour mapper les domaines requis :

```plaintext
127.0.0.1 auth.portail.tld
127.0.0.1 keycloak.portail.tld
127.0.0.1 portail.tld
127.0.0.1 traefik.tld
```

---

## Arborescence du projet

```
POC_TRAEFIK/
├── Keycloak_Traefik/
│   ├── traefik_dynamic.yml          # Configuration dynamique pour Traefik
│   ├── docker-compose.yml           # Configuration Docker pour Keycloak et Traefik
│   ├── Makefile                     # Fichier pour simplifier les commandes Docker
│   └── config/
│       └── keycloak/
│           └── realm-export.json    # Fichier d'import pour Keycloak
│
├── OAuth2/
│   ├── docker-compose.yml           # Configuration Docker pour OAuth2 Proxy
│   ├── Makefile                     # Fichier pour simplifier les commandes Docker
│   └── config/
│       └── oauth2.env               # Configuration environnementale pour OAuth2 Proxy
│
├── Web/
│   ├── docker-compose.yml           # Configuration Docker pour les projets Web
│   ├── Makefile                     # Fichier pour simplifier les commandes Docker
│   ├── php-alpha/                   # Projet PHP Alpha
│   ├── php-beta/                    # Projet PHP Beta
│   ├── php-portail/                 # Projet PHP Portail
│   ├── alpha/                       # Projet Alpha (HTML, CSS, JS)
│   ├── beta/                        # Projet Beta (HTML, CSS, JS)
│   └── portail/                     # Projet Portail (HTML, CSS, JS)
└── README.md                        # Documentation du projet
```

---

## Démarrage des services

1. **Lancer les projets Web**
   - Accédez au dossier `Web` :
     ```bash
     cd Web
     ```
   - Démarrez les services :
     ```bash
     make all
     ```

2. **Lancer Keycloak et Traefik**
   - Accédez au dossier `Keycloak_Traefik` :
     ```bash
     cd ../Keycloak_Traefik
     ```
   - Démarrez les services :
     ```bash
     make all
     ```

3. **Lancer OAuth2 Proxy**
   - Accédez au dossier `OAuth2` :
     ```bash
     cd ../OAuth2
     ```
   - Démarrez les services :
     ```bash
     make all
     ```

---

## Configuration Keycloak

**Étape 1 : : Création manuelle de la configuration Keycloak**

1. **Créer un Realm** :
   - Nom : `portail-sib`.
2. **Créer un Client** :
   - Nom : `traefik`.
   - **Activer** :
     - Client authentication.
     - Standard flow.
     - Direct access grants.
   - **Configurez les URL suivantes** :
     - Root URL : `http://portail.tld`
     - Redirect URIs : `http://auth.portail.tld/oauth2/callback`
     - Post Logout Redirect URIs : `http://portail.tld`
     - Web Origins : `http://portail.tld`
3. **Récupérer le Client Secret** :
   - Aller dans l'onglet "Credentials".
   - Copier le `Client Secret`.
   - Ouvrir le fichier `OAuth2/docker-compose.yml`.
   - Remplacer la valeur du paramètre `OAUTH2_PROXY_CLIENT_SECRET` par le `Client Secret` copié.

3. **Créer un utilisateur de test** :
   - Aller dans le menu vertical de gauche "Users".
   - Aller dans l'onglet 'Details'.
    - Email verified : On.
    - Username : user@gmail.com.
    - Email : user@gmail.com.
    - Create
   - Aller dans l'onglet 'Credentials'.
    - Set Password
    - Password : 1234
    - Temporary : Off 
    - Save

4. **Récupérer le Client Secret** :
   - Aller dans l'onglet "Credentials".
   - Copier le `Client Secret`.
   - Ouvrir le fichier `OAuth2/docker-compose.yml`.
   - Remplacer la valeur du paramètre `OAUTH2_PROXY_CLIENT_SECRET` par le `Client Secret` copié.

5. **Redémarrer OAuth2 Proxy** :
   ```bash
   cd OAuth2
   make all
   ```

---

## URL d'accès aux services

| Service                 | URL                                      |
|-------------------------|------------------------------------------|
| **Keycloak**           | [http://keycloak.portail.tld:8080](http://keycloak.portail.tld:8080) |
| **Traefik Dashboard**  | [http://traefik.tld/dashboard](http://traefik.tld/dashboard)         |
| **Portail**            | [http://portail.tld](http://portail.tld)                            |
| **Beta**               | [http://beta.local](http://beta.local)                              |
| **Alpha**              | [http://alpha.local](http://alpha.local)                           |

---


## Notes supplémentaires
- Les étapes de configuration Keycloak peuvent être enrichies par des images pour une meilleure compréhension.
- En cas de problème, vérifier les logs des services :
  ```bash
  docker logs -f <nom_du_conteneur>
  ```
