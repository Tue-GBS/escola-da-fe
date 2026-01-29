#!/usr/bin/env bash
set -euo pipefail

# Uso: DOCKER_COMPOSE_URL=https://exemplo/raw/docker-compose.yml ./install.sh

if [ ! -f docker-compose.yml ]; then
  if [ -z "${DOCKER_COMPOSE_URL:-}" ]; then
    echo "Arquivo docker-compose.yml não encontrado e DOCKER_COMPOSE_URL não definido. Saindo."
    exit 1
  fi
  echo "Baixando docker-compose.yml de $DOCKER_COMPOSE_URL"
  if command -v curl >/dev/null 2>&1; then
    curl -fsSL "$DOCKER_COMPOSE_URL" -o docker-compose.yml
  else
    wget -qO docker-compose.yml "$DOCKER_COMPOSE_URL"
  fi
fi

if [ -f .env.example ] && [ ! -f .env ]; then
  cp .env.example .env
  echo "Arquivo .env criado a partir de .env.example"
fi

# Subir containers
docker compose up -d --build
