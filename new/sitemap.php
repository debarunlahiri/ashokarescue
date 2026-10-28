<?php
/** Installation-aware public sitemap. */
require_once __DIR__ . "/includes/config.php";
header("Content-Type: application/xml; charset=utf-8");
$paths = [
    "",
    "/about",
    "/contact",
    "/faqs",
    "/services/",
    "/privacy",
    "/terms",
];
foreach (glob(__DIR__ . "/services/*.php") as $file) {
    if (basename($file) !== "index.php") {
        $paths[] = "/services/" . basename($file, ".php");
    }
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach ($paths as $path) {
    echo "<url><loc>" .
        htmlspecialchars(SITE_URL . $path, ENT_XML1, "UTF-8") .
        "</loc></url>";
}
echo "</urlset>";
