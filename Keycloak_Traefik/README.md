# Projet POC Traefik avec Keycloak, OAuth2 et Web

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

**Étape 1 : Importer le fichier de configuration**
- Accédez à l'interface Keycloak :
  [http://keycloak.portail.tld:8080](http://keycloak.portail.tld:8080).
- Connectez-vous avec les identifiants administrateurs définis dans `docker-compose.yml`.
- Importez le fichier `realm-export.json` situé dans `Keycloak_Traefik/config/keycloak/`.

**Étape 2 : Configurer les clients**
- Créez un client nommé `traefik`.
- Configurez les URL suivantes :
  - **Root URL** : `http://portail.tld`
  - **Redirect URIs** : `http://auth.portail.tld/oauth2/callback`
  - **Post Logout Redirect URIs** : `http://portail.tld`
  - **Web Origins** : `http://portail.tld`

**Étape 3 : Configurer les rôles et utilisateurs**
- Créez des rôles et affectez-les aux utilisateurs selon vos besoins.

**Étape 4 : Configurer les scripts (optionnel)**
- Activez la fonctionnalité `scripts` dans Keycloak si vous souhaitez ajouter des mappers personnalisés.

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

## Configuration des fichiers `hosts`

Ajoutez les lignes suivantes dans votre fichier `hosts` local :

```plaintext
127.0.0.1 auth.portail.tld
127.0.0.1 keycloak.portail.tld
127.0.0.1 portail.tld
127.0.0.1 traefik.tld
```

---

## Commandes utiles

- **Démarrer les services** :
  ```bash
  make all
  ```

- **Arrêter les services** :
  ```bash
  make down
  ```

- **Vérifier les logs** :
  ```bash
  docker logs -f <nom_du_service>
  ```

---

## Problèmes connus

1. **Erreur 404 après authentification OAuth2**
   - Assurez-vous que les upstreams sont correctement configurés dans `OAuth2/config/oauth2.env`.

2. **Problème d'import Keycloak**
   - Vérifiez que le fichier `realm-export.json` est correctement monté dans le conteneur.

---

## Contribution

N'hésitez pas à soumettre des issues ou des pull requests pour améliorer ce projet.
