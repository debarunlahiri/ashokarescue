<?php
/**
 * 404 — Route not found (Ashoka Rescue)
 *
 * Served by Apache via .htaccess:
 *     ErrorDocument 404 /404.php            (production, site at domain root)
 *     ErrorDocument 404 /ashokarescue/404.php (local, site in a subfolder)
 *
 * Sends a real 404 status, reuses the shared header/footer, and keeps all
 * links working whether the site runs at the domain root or in a subfolder.
 */
http_response_code(404);

$pageTitle       = '404 — Route Not Found | Ashoka Rescue';
$pageDescription = 'The page you requested could not be found. Ashoka Rescue dispatch remains fully operational — re-route to home, services, or the emergency desk.';

// App root: '' on production, '/ashokarescue' on a local subfolder install.
// (Under ErrorDocument, SCRIPT_NAME is this file, so dirname() is reliable.)
$appRoot = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
if ($appRoot === '/' || $appRoot === '\\') { $appRoot = ''; }

$requestedUri = htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/', ENT_QUOTES, 'UTF-8');

$homeUrl     = $appRoot . '/';
$servicesUrl = $appRoot . '/services/';
$aboutUrl    = $appRoot . '/about.php';
$faqsUrl     = $appRoot . '/faqs.php';
$contactUrl  = $appRoot . '/contact.php';

include __DIR__ . '/includes/header.php';
?>
<style>
/* ---- 404: self-contained so it renders even on deep missing URLs ---- */
.e404{background:#0a1424;color:#e9eff7}
.e404-hero{position:relative;overflow:hidden;padding:96px 0 84px;
    background-image:radial-gradient(rgba(148,184,220,.10) 1px,transparent 1.5px);
    background-size:24px 24px}
.e404-hero::after{content:"";position:absolute;inset:0;pointer-events:none;
    background:linear-gradient(180deg,rgba(10,20,36,.55),rgba(10,20,36,0) 40%,rgba(10,20,36,0) 60%,rgba(10,20,36,.7))}
.e404-hero .container{position:relative;z-index:1}
.e404-kicker{font-family:ui-monospace,'Cascadia Mono','JetBrains Mono',Menlo,Consolas,monospace;
    text-transform:uppercase;letter-spacing:.24em;font-size:12px;color:#8fa3bd;
    display:flex;align-items:center;gap:14px;margin:0 0 26px}
.e404-kicker::before{content:"";width:38px;height:2px;background:#e63946;flex:0 0 auto}
.e404-code{font-family:ui-monospace,'Cascadia Mono','JetBrains Mono',Menlo,Consolas,monospace;
    font-weight:700;font-size:clamp(110px,20vw,220px);line-height:.95;margin:0 0 10px;
    color:transparent;-webkit-text-stroke:1.5px rgba(125,211,252,.4)}
.e404-hero .banner-title{color:#fff;margin:0 0 18px}
.e404-hero .banner-title span{color:#22d3ee}
.e404-copy{max-width:640px;color:#aebdd2;font-size:17px;line-height:1.7;margin:0 0 26px}
.e404-readout{display:inline-flex;align-items:center;gap:14px;flex-wrap:wrap;
    background:rgba(255,255,255,.04);border:1px solid rgba(148,184,220,.22);
    border-radius:10px;padding:12px 18px;margin:0 0 34px;max-width:100%}
.e404-readout>span{font-family:ui-monospace,'Cascadia Mono','JetBrains Mono',Menlo,Consolas,monospace;
    text-transform:uppercase;letter-spacing:.2em;font-size:11px;color:#8fa3bd}
.e404-readout code{font-family:ui-monospace,'Cascadia Mono','JetBrains Mono',Menlo,Consolas,monospace;
    font-size:14px;color:#f87171;word-break:break-all}
.e404-actions{display:flex;gap:14px;flex-wrap:wrap;margin:0 0 40px}
.btn-e404{display:inline-flex;align-items:center;gap:10px;text-decoration:none;
    font-weight:600;font-size:15px;padding:14px 28px;border-radius:10px;
    border:1px solid rgba(148,184,220,.35);color:#e9eff7;background:rgba(255,255,255,.03);
    transition:transform .18s ease,box-shadow .18s ease,background .18s ease}
.btn-e404:hover{transform:translateY(-2px);background:rgba(255,255,255,.07);color:#fff}
.btn-e404-primary{background:linear-gradient(135deg,#e63946,#b91c1c);border-color:#e63946;color:#fff;
    box-shadow:0 10px 28px rgba(230,57,70,.35)}
.btn-e404-primary:hover{background:linear-gradient(135deg,#f04a56,#c81e2b);color:#fff}
.e404-reroute{border-top:1px solid rgba(148,184,220,.18);padding-top:26px}
.e404-reroute p{font-family:ui-monospace,'Cascadia Mono','JetBrains Mono',Menlo,Consolas,monospace;
    text-transform:uppercase;letter-spacing:.2em;font-size:11px;color:#8fa3bd;margin:0 0 14px}
.e404-reroute ul{list-style:none;margin:0;padding:0;display:flex;gap:8px 28px;flex-wrap:wrap}
.e404-reroute a{color:#cdd9e8;text-decoration:none;font-size:15px;display:inline-flex;align-items:center;gap:8px}
.e404-reroute a::before{content:"›";color:#e63946;font-weight:700}
.e404-reroute a:hover{color:#22d3ee}
@media (max-width:767px){.e404-hero{padding:72px 0 60px}.btn-e404{width:100%;justify-content:center}}
</style>

<main class="e404">
    <section class="e404-hero">
        <div class="container">
            <p class="e404-kicker">Signal lost</p>
            <div class="e404-code" aria-hidden="true">404</div>
            <h1 class="banner-title">This route is <span>off the map.</span></h1>
            <p class="e404-copy">The coordinate you requested does not resolve to any active
            service corridor. Nothing is down on our end — dispatch, fleet and the
            emergency desk remain fully operational.</p>
            <p class="e404-readout"><span>Requested coordinate</span><code><?= $requestedUri ?></code></p>
            <div class="e404-actions">
                <a class="btn-e404 btn-e404-primary" href="<?= $homeUrl ?>">Return to home base</a>
                <a class="btn-e404" href="<?= $servicesUrl ?>">View service briefs</a>
                <a class="btn-e404" href="<?= $contactUrl ?>">Emergency desk</a>
            </div>
            <nav class="e404-reroute" aria-label="Popular destinations">
                <p>Re-route</p>
                <ul>
                    <li><a href="<?= $homeUrl ?>">Home</a></li>
                    <li><a href="<?= $servicesUrl ?>">Our services</a></li>
                    <li><a href="<?= $aboutUrl ?>">About us</a></li>
                    <li><a href="<?= $faqsUrl ?>">FAQs</a></li>
                    <li><a href="<?= $contactUrl ?>">Contact</a></li>
                </ul>
            </nav>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
