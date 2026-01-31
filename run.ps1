param(
    [string]$DockerComposeUrl = $env:DOCKER_COMPOSE_URL,
    [switch]$Force
)

# Uso: .\run.ps1 -DockerComposeUrl "https://.../docker-compose.yml"

function Is-PlaceholderUrl($url) {
    if (-not $url) { return $false }
    $placeholders = @('seu-usuario','seu-repo','<usuario>','<repo>','your-username','example')
    foreach ($p in $placeholders) { if ($url -like "*$p*") { return $true } }
    return $false
}

if (-not (Test-Path docker-compose.yml)) {
    if (-not $DockerComposeUrl) {
        Write-Error "docker-compose.yml não encontrado e nenhuma URL foi fornecida (parâmetro -DockerComposeUrl ou variável de ambiente DOCKER_COMPOSE_URL)."
        Write-Error "Pré-requisitos: Docker e Docker Compose. Instale em: https://www.docker.com/get-started"
        exit 1
    }

    if (Is-PlaceholderUrl $DockerComposeUrl) {
        Write-Error "A URL fornecida parece conter placeholders. Substitua '<usuario>/<repo>' pela URL real do seu repositório."
        Write-Error "Exemplo de formato: https://raw.githubusercontent.com/usuario/repo/master/docker-compose.yml"
        exit 1
    }

    Write-Output "Baixando docker-compose.yml de $DockerComposeUrl"
    try {
        Invoke-WebRequest -Uri $DockerComposeUrl -OutFile docker-compose.yml -UseBasicParsing -ErrorAction Stop
    } catch {
        Write-Error "Falha ao baixar docker-compose.yml: $_"
        exit 1
    }
}

if (Test-Path .env.example -and -not (Test-Path .env)) {
    Copy-Item .env.example .env
    Write-Output "Arquivo .env criado a partir de .env.example"
}

# Verifica pré-requisitos locais: Docker e Compose
function Show-Install-Links {
    Write-Output "Instalação do Docker: https://www.docker.com/get-started"
    Write-Output "Instalação do Docker Compose: https://docs.docker.com/compose/install/"
}

try {
    if (-not (Get-Command docker -ErrorAction SilentlyContinue)) {
        Write-Error "Docker não encontrado.";
        Show-Install-Links
        exit 1
    }
} catch {
    Write-Error "Erro ao verificar Docker: $_"; Show-Install-Links; exit 1
}

try {
    # tenta docker compose (v2) ou docker-compose (legacy)
    if ((docker compose version) -ne $null) {
        $null = docker compose version 2>$null
    } elseif (-not (Get-Command docker-compose -ErrorAction SilentlyContinue)) {
        Write-Error "Docker Compose não encontrado."; Show-Install-Links; exit 1
    }
} catch {
    Write-Error "Docker Compose não disponível ou erro ao verificar: $_"; Show-Install-Links; exit 1
}

# Subir containers (usa plugin v2 quando disponível)
try {
    if (Get-Command docker -ErrorAction SilentlyContinue) {
        docker compose up -d --build
    } else {
        docker-compose up -d --build
    }
} catch {
    Write-Error "Falha ao subir os containers: $_"; exit 1
}
