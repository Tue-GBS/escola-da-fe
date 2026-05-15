#!/usr/bin/env sh
set -eu

if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  cp .env.example .env
fi

docker compose up -d --build

printf '\nEscola da Fe rodando em http://localhost:8080\n'
