# Variables
DOCKER_COMPOSE = docker-compose
TRAFFIC_LOGS = docker logs traefik
KEYCLOAK_LOGS = docker logs keycloak

# Default target
all: purge up

# Lancer les conteneurs keycloak et traefik
up:
	$(DOCKER_COMPOSE) up -d keycloak traefik

# Arrêter les conteneurs keycloak et traefik
down:
	$(DOCKER_COMPOSE) stop keycloak traefik
	$(DOCKER_COMPOSE) rm -f keycloak traefik

# Redémarrer les conteneurs keycloak et traefik
restart:
	$(DOCKER_COMPOSE) stop keycloak traefik
	$(DOCKER_COMPOSE) rm -f keycloak traefik
	$(DOCKER_COMPOSE) up -d keycloak traefik

# Afficher les logs de Traefik
logs-traefik:
	$(TRAFFIC_LOGS)

# Afficher les logs de Keycloak
logs-keycloak:
	$(KEYCLOAK_LOGS)

# Tester la résolution DNS pour un domaine spécifique
dns-test:
	@read -p "Entrez le domaine à tester : " domain; \
	nslookup $$domain

# Vérifier la configuration Traefik
check-traefik:
	cat traefik_dynamic.yml

# Accéder au shell du conteneur Keycloak
keycloak-shell:
	docker exec -it keycloak /bin/bash

# Afficher les conteneurs actifs
status:
	docker ps

# Vérifier les versions de Docker et Docker Compose
check-versions:
	@echo "Docker version:"; docker --version
	@echo "Docker Compose version:"; docker-compose --version

# Supprimer les volumes inutilisés
clean-volumes:
	docker volume prune -f

# Nettoyer les conteneurs arrêtés
clean-containers:
	docker container prune -f

# Nettoyer les réseaux inutilisés
clean-networks:
	docker network prune -f

# Nettoyer les images inutilisées
clean-images:
	docker image prune -af

# Nettoyer tout
clean-all:
	docker system prune -af --volumes

# Supprimer tout pour keycloak et traefik
purge:
	@echo "Stopping keycloak and traefik..."
	docker stop keycloak traefik || true
	@echo "Removing keycloak and traefik containers..."
	docker rm -f keycloak traefik || true
	@echo "Removing unused volumes and networks..."
	docker volume prune -f
	docker network prune -f
	@echo "keycloak and traefik environment has been fully purged."
