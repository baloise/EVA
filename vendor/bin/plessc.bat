@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../marcusschwarz/lesserphp/plessc
php "%BIN_TARGET%" %*
