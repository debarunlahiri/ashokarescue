<?php
$journalArticles = [
    [
        "title" => "Understanding the Air Ambulance Costs in India",
        "slug" => "understanding-the-air-ambulance-costs-in-india",
        "image" => "hero-bg.jpg",
        "summary" =>
            "Explore the factors that shape an air ambulance quotation.",
    ],
    [
        "title" => "A Message from Dr. Ashok, Director at Ashoka Rescue",
        "slug" => "a-message-from-dr-ashok-director-at-ashoka-rescue",
        "image" => "wh-choose-us.jpg",
        "summary" =>
            "An introduction to the company’s approach to medical transportation.",
    ],
    [
        "title" => "Steps for Medevac Using a Commercial Stretcher",
        "slug" => "steps-for-medevac-using-a-commercial-stretcher",
        "image" => "businessclass-about-img.jpg",
        "summary" =>
            "Read about the coordination involved in a commercial stretcher transfer.",
    ],
]; ?>
<section class="journal-section" aria-labelledby="journal-title"><div class="container">
    <div class="journal-heading"><div><p class="flight-eyebrow">FROM OUR JOURNAL</p><h2 id="journal-title">Understanding the journey.</h2></div><a class="flight-text-link" href="<?php echo BLOG_URL; ?>">Visit the blog <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
    <div class="journal-grid"><?php foreach (
        $journalArticles
        as $article
    ): ?><article>
        <img src="<?php echo IMG_PATH .
            $article[
                "image"
            ]; ?>" alt="" width="600" height="380" loading="lazy">
        <h3><a href="<?php echo BLOG_URL .
            "/" .
            $article["slug"] .
            "/"; ?>"><?php echo htmlspecialchars($article["title"]); ?></a></h3>
        <p><?php echo htmlspecialchars($article["summary"]); ?></p>
        <a class="flight-text-link" href="<?php echo BLOG_URL .
            "/" .
            $article["slug"] .
            "/"; ?>">Read article <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    </article><?php endforeach; ?></div>
</div></section>
