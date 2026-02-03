# MySQL Recovery Script for XAMPP
# This script fixes the common "MySQL shutdown unexpectedly" error

Write-Host "=== MySQL Recovery Script ===" -ForegroundColor Cyan
Write-Host ""

# Stop any running MySQL processes
Write-Host "Step 1: Stopping MySQL processes..." -ForegroundColor Yellow
Get-Process mysqld -ErrorAction SilentlyContinue | Stop-Process -Force
Start-Sleep -Seconds 2

# Backup corrupted InnoDB log files
$dataDir = "C:\xampp\mysql\data"
$backupDir = "C:\xampp\mysql\data\backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"

Write-Host "Step 2: Backing up InnoDB log files..." -ForegroundColor Yellow
if (-not (Test-Path $backupDir)) {
    New-Item -ItemType Directory -Path $backupDir | Out-Null
}

$filesToBackup = @("ib_logfile0", "ib_logfile1", "ibdata1")
foreach ($file in $filesToBackup) {
    $filePath = Join-Path $dataDir $file
    if (Test-Path $filePath) {
        Copy-Item $filePath -Destination $backupDir -Force
        Write-Host "  Backed up: $file" -ForegroundColor Green
    }
}

# Remove corrupted log files (keep ibdata1)
Write-Host "Step 3: Removing corrupted log files..." -ForegroundColor Yellow
$logFiles = @("ib_logfile0", "ib_logfile1")
foreach ($file in $logFiles) {
    $filePath = Join-Path $dataDir $file
    if (Test-Path $filePath) {
        Remove-Item $filePath -Force
        Write-Host "  Removed: $file" -ForegroundColor Green
    }
}

Write-Host ""
Write-Host "=== Recovery Complete ===" -ForegroundColor Green
Write-Host "Backup created at: $backupDir" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Open XAMPP Control Panel"
Write-Host "2. Click 'Start' next to MySQL"
Write-Host "3. MySQL should now start successfully"
Write-Host ""
