param(
    [string]$DockerComposeUrl = $env:DOCKER_COMPOSE_URL
)

# Uso: .\run.ps1 -DockerComposeUrl "https://.../docker-compose.yml"

if (-not (Test-Path docker-compose.yml)) {
    if (-not $DockerComposeUrl) {
        Write-Error "docker-compose.yml não encontrado e nenhuma URL foi fornecida (parâmetro -DockerComposeUrl ou variável de ambiente DOCKER_COMPOSE_URL)."
        exit 1
    }
    Write-Output "Baixando docker-compose.yml de $DockerComposeUrl"
    Invoke-WebRequest -Uri $DockerComposeUrl -OutFile docker-compose.yml -UseBasicParsing
}

if (Test-Path .env.example -and -not (Test-Path .env)) {
    Copy-Item .env.example .env
    Write-Output "Arquivo .env criado a partir de .env.example"
}

# Subir containers
docker compose up -d --build
