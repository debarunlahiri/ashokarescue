<?php
require_once __DIR__ . "/includes/config.php";
header("Content-Type: text/plain; charset=utf-8");
$basePath = rtrim(parse_url(SITE_URL, PHP_URL_PATH) ?: "", "/");
echo "User-agent: *\nAllow: /\n";
foreach (
    ["admin", "api", "includes", "resources", "docs", "node_modules"]
    as $directory
) {
    echo "Disallow: " . $basePath . "/" . $directory . "/\n";
}
echo "Sitemap: " . SITE_URL . "/sitemap.xml\n";
