<?php $homeQuestions =
    json_decode(file_get_contents(__DIR__ . "/faq-schema.json"), true)[
        "mainEntity"
    ] ?? []; ?>
<section class="home-faq"><div class="container faq-layout">
    <div><p class="flight-eyebrow">HERE TO HELP</p><h2>Clarity, when<br><em>you need it.</em></h2><p>Practical answers for patients and families.</p><a class="flight-text-link" href="<?php echo SITE_URL; ?>/faqs">Browse all FAQs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
    <div><?php foreach (
        array_slice($homeQuestions, 0, 3)
        as $question
    ): ?><details><summary><?php echo htmlspecialchars(
    $question["name"],
); ?></summary><p><?php echo htmlspecialchars(
    $question["acceptedAnswer"]["text"],
); ?></p></details><?php endforeach; ?></div>
</div></section>
