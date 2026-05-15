if (-not (Test-Path ".env") -and (Test-Path ".env.example")) {
    Copy-Item ".env.example" ".env"
}

docker compose up -d --build

Write-Host ""
Write-Host "Escola da Fe rodando em http://localhost:8080"
