<?php
/**
 * index.php – Homepage of Santipur Rash.
 * Root-level page, so $basePath is an empty string.
 */

declare(strict_types=1);

$basePath        = '';
$activePage      = 'home';
$pageTitle       = 'শান্তিপুরের রাস | Santipur Rash – Tradition Meets Devotion';
$metaDescription = 'শান্তিপুরের রাস মহোৎসব – ঐতিহ্য, সংস্কৃতি ও ভক্তি। ইতিহাস, বিশেষত্ব, বিগ্রহ বাড়ি, থিম প্যান্ডেল, রুটম্যাপ ও জরুরি পরিষেবার তথ্য।';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/navbar.php';

/**
 * Shows an image if the file exists in assets/images/, otherwise a clearly
 * labelled placeholder telling you which file to add.
 */
if (!function_exists('imageOrPlaceholder')) {
    function imageOrPlaceholder(string $basePath, string $file, string $alt, string $hint): string
    {
        $diskPath = __DIR__ . '/assets/images/' . $file;
        if (is_file($diskPath)) {
            return '<img src="' . e($basePath . 'assets/images/' . $file) . '" alt="' . e($alt) . '" loading="lazy">';
        }
        return '<div class="img-placeholder" role="img" aria-label="' . e($alt) . '"><span><strong>Image placeholder</strong>'
            . e($hint) . '<br><small>Add file: assets/images/' . e($file) . '</small></span></div>';
    }
}

/* Quick-access cards: icon, Bengali label, English label, page path */
$quickCards = [
    ['📖', 'রাসযাত্রার ইতিহাস',   'History of Rash Yatra',                          'pages/history.php'],
    ['⭐', 'রাসের বিশেষত্ব',       'Special Attractions (Ray Raja, Fanush, Kunjabhang)', 'pages/special-attractions.php'],
    ['🛕', 'বিগ্রহ বাড়ির ইতিহাস ও অবস্থান', 'Bigraha Houses (with Video)',            'pages/bigraha-houses.php'],
    ['🏮', 'থিম প্যান্ডেল ও পূজা',  'Theme Pandals & Puja',                           'pages/theme-pandals.php'],
    ['👥', 'প্রশাসনিক মতামত',     'Administrative Messages',                        'pages/administration.php'],
    ['📍', 'রুটম্যাপ',            'Route Map',                                      'pages/route-map.php'],
    ['🚑', 'জরুরি পরিষেবা',       'Emergency Services',                             'pages/emergency.php'],
    ['💬', 'মতামত',              'Feedback',                                       'pages/feedback.php'],
];

/* Festival highlights strip: bengali caption, image file, placeholder hint */
$highlights = [
    ['ঐতিহাসিক আলো',        'highlight-heritage.jpg', 'Heritage temple / house lit up at night'],
    ['ফানুসের মেলা',         'highlight-fanush.jpg',   'Fanush (lanterns) in the night sky'],
    ['থিম প্যান্ডেলের সৌন্দর্য', 'highlight-pandal.jpg',   'Theme pandal decoration'],
    ['ভক্তদের ঢল',           'highlight-crowd.jpg',    'Devotees gathering during the festival'],
];

/* Three special attractions (names only – facts to be added after verification) */
$attractions = [
    ['রায় রাজার ইতিহাস', 'History of Ray Raja', 'attraction-ray-raja.jpg'],
    ['ফানুস',              'Fanush',               'attraction-fanush.jpg'],
    ['কুঞ্জভঙ্গ',           'Kunjabhang',           'attraction-kunjabhang.jpg'],
];

/* Administrative roles (names/messages must be supplied by the administration) */
$officials = [
    ['সাংসদ',                'Member of Parliament (MP)'],
    ['বিধায়ক',               'Member of Legislative Assembly (MLA)'],
    ['জেলা শাসক',            'District Magistrate (DM)'],
    ['ভারপ্রাপ্ত আধিকারিক',   'Officer-in-Charge (OC)'],
    ['মহকুমা শাসক',          'Sub-Divisional Officer (SDO)'],
];
?>

<!-- ============ HERO ============ -->
<section class="hero" aria-labelledby="hero-title">
    <div class="container hero__inner">
        <div class="hero__text">
            <h1 id="hero-title" class="hero__title-bn">শান্তিপুরের রাস</h1>
            <p class="hero__title-en" lang="en">Tradition Meets Devotion</p>
            <p class="hero__divider" aria-hidden="true">◄ ❀ ►</p>
            <p class="hero__tag-bn">ঐতিহ্য • সংস্কৃতি • ভক্তি</p>
            <p class="hero__desc">এক শহরের ঐতিহ্যমণ্ডিত রাস মহোৎসব</p>
            <a class="btn btn--gold" href="pages/history.php">Explore the Heritage <span aria-hidden="true">→</span></a>
        </div>

        <div class="hero__media">
            <?= imageOrPlaceholder(
                $basePath,
                'hero-festival.png',
                'Festival hero illustration',
                'Place the main festival artwork or photograph here (transparent PNG works best).'
            ) ?>
        </div>
    </div>
</section>

<!-- ============ QUICK-ACCESS CARDS ============ -->
<section class="quick-nav" aria-label="Quick access to website sections">
    <div class="container">
        <ul class="quick-nav__grid">
            <?php foreach ($quickCards as [$icon, $labelBn, $labelEn, $path]): ?>
                <li>
                    <a class="quick-card" href="<?= e($basePath . $path) ?>">
                        <span class="quick-card__icon" aria-hidden="true"><?= e($icon) ?></span>
                        <span class="quick-card__bn"><?= e($labelBn) ?></span>
                        <span class="quick-card__en" lang="en"><?= e($labelEn) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- ============ INTRODUCTION ============ -->
<section class="section" aria-labelledby="intro-title">
    <div class="container split">
        <div class="split__media">
            <?= imageOrPlaceholder(
                $basePath,
                'intro-temple.jpg',
                'Illuminated temple during Santipur Rash',
                'Photograph of an illuminated temple or heritage building in Santipur.'
            ) ?>
        </div>

        <div class="split__text">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="intro-title">শান্তিপুরের রাস মহোৎসবে স্বাগতম</h2>
            <p class="section-title__en" lang="en">Welcome to Santipur Rash</p>
            <p>
                শান্তিপুরের রাস উৎসব শুধু একটি ধর্মীয় অনুষ্ঠান নয়, এটি এই শহরের সংস্কৃতি, ঐতিহ্য এবং
                ভক্তির এক মিলনমেলা। এই ওয়েবসাইটে রাসযাত্রার ইতিহাস, বিশেষত্ব, বিগ্রহ বাড়ি, থিম প্যান্ডেল,
                রুটম্যাপ ও জরুরি পরিষেবার তথ্য এক জায়গায় পাওয়া যাবে।
            </p>
            <p class="placeholder-note">
                <strong>Editable content:</strong> Replace this paragraph with the verified introduction
                supplied by the organising committee.
            </p>
            <a class="btn btn--maroon" href="pages/history.php">আরও জানুন <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>

<!-- ============ FESTIVAL HIGHLIGHTS ============ -->
<section class="section section--alt" aria-labelledby="highlights-title">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀ ❀ ❀</span>
            <h2 id="highlights-title">উৎসবের প্রধান আকর্ষণ</h2>
            <p class="section-title__en" lang="en">Festival Highlights</p>
        </div>

        <div class="highlights" role="list" tabindex="0" aria-label="Festival highlights – scroll horizontally">
            <?php foreach ($highlights as [$captionBn, $file, $hint]): ?>
                <figure class="highlight" role="listitem" style="margin:0;">
                    <div class="highlight__media">
                        <?= imageOrPlaceholder($basePath, $file, $captionBn, $hint) ?>
                    </div>
                    <figcaption class="highlight__caption"><?= e($captionBn) ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>

        <h3 class="text-center mt-2">রাসের বিশেষত্ব <span lang="en">– Special Attractions</span></h3>
        <div class="grid grid--3 mt-1">
            <?php foreach ($attractions as [$titleBn, $titleEn, $file]): ?>
                <article class="card">
                    <div class="card__media">
                        <?= imageOrPlaceholder($basePath, $file, $titleEn, 'Photograph or illustration for ' . $titleEn . '.') ?>
                    </div>
                    <div class="card__body">
                        <h4 class="card__title"><?= e($titleBn) ?></h4>
                        <p class="card__subtitle" lang="en"><?= e($titleEn) ?></p>
                        <p>বিস্তারিত তথ্য যাচাইয়ের পর এখানে যোগ করা হবে।</p>
                        <div class="card__footer">
                            <a class="btn btn--outline btn--small" href="pages/special-attractions.php">Read more <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ BIGRAHA HOUSES PREVIEW ============ -->
<section class="section" aria-labelledby="bigraha-title">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="bigraha-title">বিগ্রহ বাড়ির ইতিহাস ও অবস্থান</h2>
            <p class="section-title__en" lang="en">Bigraha (Idol) Houses</p>
            <p>প্রতিটি বিগ্রহ বাড়ির ইতিহাস, ছবি, ভিডিও ও অবস্থান আলাদা পাতায় দেখা যাবে।</p>
        </div>

        <div class="grid grid--3">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <article class="card">
                    <div class="card__media">
                        <?= imageOrPlaceholder($basePath, 'bigraha-' . $i . '.jpg', 'Bigraha house ' . $i, 'Photograph of Bigraha house ' . $i . '.') ?>
                    </div>
                    <div class="card__body">
                        <h3 class="card__title">[বিগ্রহ বাড়ির নাম <?= $i ?>]</h3>
                        <p class="card__subtitle" lang="en">[Name of Bigraha house <?= $i ?> – to be added]</p>
                        <p>ইতিহাস ও ঠিকানা যাচাইয়ের পর যোগ করা হবে।</p>
                    </div>
                </article>
            <?php endfor; ?>
        </div>

        <p class="text-center mt-2">
            <a class="btn btn--navy" href="pages/bigraha-houses.php">সব বিগ্রহ বাড়ি দেখুন <span aria-hidden="true">→</span></a>
        </p>
    </div>
</section>

<!-- ============ THEME PANDALS & PUJA PREVIEW ============ -->
<section class="section section--navy" aria-labelledby="pandal-title">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀ ❀ ❀</span>
            <h2 id="pandal-title">উল্লেখযোগ্য থিমপ্যান্ডেল ও পূজা</h2>
            <p class="section-title__en" lang="en">Featured Theme Pandals &amp; Puja</p>
        </div>

        <div class="grid grid--3">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <article class="card">
                    <div class="card__media">
                        <?= imageOrPlaceholder($basePath, 'pandal-' . $i . '.jpg', 'Theme pandal ' . $i, 'Photograph of theme pandal ' . $i . '.') ?>
                    </div>
                    <div class="card__body">
                        <h3 class="card__title">[থিম প্যান্ডেলের নাম <?= $i ?>]</h3>
                        <p class="card__subtitle" lang="en">[Pandal name <?= $i ?> – to be added]</p>
                        <p>থিম ও অবস্থানের তথ্য যাচাইয়ের পর যোগ করা হবে।</p>
                    </div>
                </article>
            <?php endfor; ?>
        </div>

        <p class="text-center mt-2">
            <a class="btn btn--gold" href="pages/theme-pandals.php">সব থিম প্যান্ডেল দেখুন <span aria-hidden="true">→</span></a>
        </p>
    </div>
</section>

<!-- ============ ADMINISTRATIVE MESSAGES PREVIEW ============ -->
<section class="section" aria-labelledby="admin-title">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="admin-title">প্রশাসনিক মতামত</h2>
            <p class="section-title__en" lang="en">Administrative Messages</p>
            <p>উৎসব উপলক্ষে প্রশাসনিক আধিকারিকদের বার্তা।</p>
        </div>

        <div class="grid grid--3">
            <?php foreach ($officials as [$roleBn, $roleEn]): ?>
                <article class="info-card">
                    <h3><?= e($roleBn) ?></h3>
                    <p class="info-card__en" lang="en"><?= e($roleEn) ?></p>
                    <p class="placeholder-note">Name, photograph and official message to be supplied by the administration.</p>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="text-center mt-2">
            <a class="btn btn--maroon" href="pages/administration.php">সব বার্তা পড়ুন <span aria-hidden="true">→</span></a>
        </p>
    </div>
</section>

<!-- ============ ROUTE MAP / EMERGENCY / FEEDBACK PREVIEWS ============ -->
<section class="section section--alt" aria-label="Route map, emergency services and feedback">
    <div class="container grid preview-grid">

        <!-- Route map -->
        <article class="preview">
            <div class="preview__head">
                <h3>📍 রুটম্যাপ</h3>
                <p lang="en">Explore Santipur Rash Locations</p>
            </div>
            <div class="preview__body">
                <div class="map-box map-box--small">
                    <div class="img-placeholder" role="img" aria-label="Map placeholder">
                        <span><strong>Map placeholder</strong>Embedded map will appear here (see pages/route-map.php).</span>
                    </div>
                </div>
                <a class="btn btn--navy btn--small" href="pages/route-map.php">View Map <span aria-hidden="true">→</span></a>
            </div>
        </article>

        <!-- Emergency -->
        <article class="preview">
            <div class="preview__head preview__head--maroon">
                <h3>🚑 জরুরি পরিষেবা</h3>
                <p lang="en">Emergency Services</p>
            </div>
            <div class="preview__body">
                <ul class="preview__list">
                    <li>🛡️ পুলিশ – <em>[verified number to be added]</em></li>
                    <li>➕ হাসপাতাল – <em>[verified number to be added]</em></li>
                    <li>🚑 অ্যাম্বুলেন্স – <em>[verified number to be added]</em></li>
                    <li>🚒 অগ্নিনির্বাপণ – <em>[verified number to be added]</em></li>
                </ul>
                <a class="btn btn--navy btn--small" href="pages/emergency.php">More Contacts <span aria-hidden="true">→</span></a>
            </div>
        </article>

        <!-- Feedback -->
        <article class="preview">
            <div class="preview__head">
                <h3>✉️ আপনার মতামত জানান</h3>
                <p lang="en">Share Your Feedback</p>
            </div>
            <div class="preview__body">
                <p>আপনার পরামর্শ আমাদের জন্য মূল্যবান।</p>
                <a class="btn btn--maroon" href="pages/feedback.php">Feedback Form <span aria-hidden="true">→</span></a>
            </div>
        </article>

    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>