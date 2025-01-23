# Variables
DOCKER_COMPOSE = docker-compose

# Default target
all: purge up

# Lancer uniquement les conteneurs beta, alpha, et php-alpha
up:
	$(DOCKER_COMPOSE) up -d beta alpha php-alpha php-beta php-portail portail

# Arrêter uniquement les conteneurs beta, alpha, et php-alpha
down:
	$(DOCKER_COMPOSE) stop beta alpha php-alpha php-beta php-portail portail
	$(DOCKER_COMPOSE) rm -f beta alpha php-alpha php-beta php-portail portail

# Redémarrer uniquement les conteneurs beta, alpha, et php-alpha
restart:
	$(DOCKER_COMPOSE) stop beta alpha php-alpha php-beta php-portail portail
	$(DOCKER_COMPOSE) rm -f beta alpha php-alpha php-beta php-portail portail
	$(DOCKER_COMPOSE) up -d beta alpha php-alpha php-beta php-portail portail



# Nettoyer les volumes inutilisés
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

# Supprimer tout pour beta, alpha, et php-alpha
purge:
	@echo "Stopping containers..."
	docker stop beta alpha php-alpha portail php-beta php-portail || true
	@echo "Removing containers..."
	docker rm -f beta alpha php-alpha php-beta php-portail portail || true
	@echo "Removing unused volumes and networks..."
	docker volume prune -f
	docker network prune -f
	@echo "Environment for beta, alpha, portail, and php-alpha has been fully purged."
