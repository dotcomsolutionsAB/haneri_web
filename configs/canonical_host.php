<?php
/**
 * Force public site to https://www.haneri.com (single origin for localStorage / cookies).
 * Skips CLI, localhost, and non-haneri hosts (e.g. api.haneri.com is untouched).
 */
if (PHP_SAPI === 'cli') {
    return;
}

$hostRaw = $_SERVER['HTTP_HOST'] ?? '';
$host    = strtolower(preg_replace('/:\d+$/', '', $hostRaw));

if ($host === '' || $host === 'localhost' || strpos($host, '127.0.0.1') === 0) {
    return;
}

$isApex = ($host === 'haneri.com');
$isWww  = ($host === 'www.haneri.com');

if (!$isApex && !$isWww) {
    return;
}

$https = false;
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    $https = true;
}
if (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443) {
    $https = true;
}
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string) $_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
    $https = true;
}

$uri = $_SERVER['REQUEST_URI'] ?? '/';

if ($isApex || !$https) {
    header('Location: https://www.haneri.com' . $uri, true, 301);
    exit;
}
