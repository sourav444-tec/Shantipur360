<?php
/**
 * pages/theme-pandals.php – Theme pandals and puja information.
 * Add real pandals by editing the $pandals array (one row per pandal).
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'pandals';
$pageTitle       = 'উল্লেখযোগ্য থিমপ্যান্ডেল ও পূজা | Theme Pandals – Santipur Rash';
$metaDescription = 'শান্তিপুরের রাসের উল্লেখযোগ্য থিমপ্যান্ডেল, পূজা ও সাজসজ্জা। Theme pandals and puja information.';

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/* name (bn), name (en), theme description, location, image file */
$pandals = [
    ['[থিম প্যান্ডেলের নাম ১]', '[Pandal name 1]', '[থিমের বিবরণ – যাচাইয়ের পর যোগ করুন]', '[অবস্থান – যাচাইয়ের পর যোগ করুন]', 'pandal-1.jpg'],
    ['[থিম প্যান্ডেলের নাম ২]', '[Pandal name 2]', '[থিমের বিবরণ – যাচাইয়ের পর যোগ করুন]', '[অবস্থান – যাচাইয়ের পর যোগ করুন]', 'pandal-2.jpg'],
    ['[থিম প্যান্ডেলের নাম ৩]', '[Pandal name 3]', '[থিমের বিবরণ – যাচাইয়ের পর যোগ করুন]', '[অবস্থান – যাচাইয়ের পর যোগ করুন]', 'pandal-3.jpg'],
    ['[থিম প্যান্ডেলের নাম ৪]', '[Pandal name 4]', '[থিমের বিবরণ – যাচাইয়ের পর যোগ করুন]', '[অবস্থান – যাচাইয়ের পর যোগ করুন]', 'pandal-4.jpg'],
];

$galleryFiles = ['pandal-gallery-1.jpg', 'pandal-gallery-2.jpg', 'pandal-gallery-3.jpg', 'pandal-gallery-4.jpg'];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Theme Pandals</p>
        <h1>উল্লেখযোগ্য থিমপ্যান্ডেল ও পূজা</h1>
        <p lang="en">Notable Theme Pandals &amp; Puja</p>
    </div>
</section>

<section class="section">
    <div class="container prose">
        <p class="placeholder-note">
            <strong>Editorial note:</strong> All pandal names, themes and locations below are placeholders.
            Add only information confirmed by the organising committees.
        </p>

        <h2>পূজা সম্পর্কিত তথ্য <span lang="en">– Puja Information</span></h2>
        <p class="placeholder-note">
            [পূজার সময়সূচি, রীতিনীতি ও গুরুত্বপূর্ণ তথ্য – যাচাইকৃত তথ্য যোগ করুন।]<br>
            <span lang="en">[Puja schedule, rituals and important details – to be added after verification.]</span>
        </p>

        <h2>উৎসবের সাজসজ্জা <span lang="en">– Festival Decorations</span></h2>
        <p class="placeholder-note">
            [আলোকসজ্জা, প্রবেশদ্বার ও অন্যান্য সাজসজ্জার বিবরণ – যাচাইয়ের পর যোগ করুন।]<br>
            <span lang="en">[Lighting, entrance gates and other decorations – to be added after verification.]</span>
        </p>
    </div>
</section>

<section class="section section--alt" aria-labelledby="pandals-heading">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="pandals-heading">থিম প্যান্ডেলসমূহ</h2>
            <p class="section-title__en" lang="en">Featured Theme Pandals</p>
        </div>

        <div class="grid grid--2">
            <?php foreach ($pandals as $index => [$nameBn, $nameEn, $theme, $location, $imageFile]): ?>
                <article class="card" id="pandal-<?= $index + 1 ?>">
                    <div class="card__media">
                        <?= imageOrPlaceholder($basePath, $imageFile, $nameEn, 'Photograph of ' . $nameEn . '.') ?>
                    </div>
                    <div class="card__body">
                        <h3 class="card__title"><?= e($nameBn) ?></h3>
                        <p class="card__subtitle" lang="en"><?= e($nameEn) ?></p>
                        <p><strong>থিম / Theme:</strong> <?= e($theme) ?></p>
                        <p><strong>অবস্থান / Location:</strong> <?= e($location) ?></p>
                        <div class="card__footer">
                            <a class="btn btn--outline btn--small" href="route-map.php">View on route map <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="pandal-gallery">
    <div class="container">
        <div class="section-title">
            <h2 id="pandal-gallery">চিত্র প্রদর্শনী</h2>
            <p class="section-title__en" lang="en">Image Gallery</p>
        </div>
        <div class="gallery">
            <?php foreach ($galleryFiles as $n => $file): ?>
                <figure class="gallery__item">
                    <?= imageOrPlaceholder($basePath, $file, 'Theme pandal gallery image ' . ($n + 1), 'Gallery photograph ' . ($n + 1) . '.') ?>
                    <figcaption>[Caption to be added]</figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>