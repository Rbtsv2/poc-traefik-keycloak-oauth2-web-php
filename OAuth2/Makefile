# Variables
DOCKER_COMPOSE = docker-compose
OAUTH2_LOGS = docker logs oauth2-proxy

# Default target
all: purge up

# Lancer uniquement le conteneur oauth2-proxy
up:
	$(DOCKER_COMPOSE) up -d oauth2-proxy

# Arrêter uniquement le conteneur oauth2-proxy
down:
	$(DOCKER_COMPOSE) stop oauth2-proxy
	$(DOCKER_COMPOSE) rm -f oauth2-proxy

# Redémarrer uniquement le conteneur oauth2-proxy
restart:
	$(DOCKER_COMPOSE) stop oauth2-proxy
	$(DOCKER_COMPOSE) rm -f oauth2-proxy
	$(DOCKER_COMPOSE) up -d oauth2-proxy

# Afficher les logs de oauth2-proxy
logs:
	$(OAUTH2_LOGS)

# Accéder au shell du conteneur oauth2-proxy
shell:
	docker exec -it oauth2-proxy /bin/sh

# Afficher les conteneurs actifs
status:
	docker ps | grep oauth2-proxy

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

# Supprimer tout pour oauth2-proxy
purge:
	@echo "Stopping oauth2-proxy..."
	docker stop oauth2-proxy || true
	@echo "Removing oauth2-proxy container..."
	docker rm -f oauth2-proxy || true
	@echo "Removing oauth2-proxy image..."
	docker rmi -f $(docker images | grep oauth2-proxy | awk '{print $3}') || true
	@echo "Removing unused volumes and networks..."
	docker volume prune -f
	docker network prune -f
	@echo "oauth2-proxy environment has been fully purged."
