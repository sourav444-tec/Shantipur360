<?php
/**
 * pages/bigraha-houses.php – Bigraha house history and locations.
 * Add real houses by editing the $houses array (one row per house).
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'bigraha';
$pageTitle       = 'বিগ্রহ বাড়িগুলির ইতিহাস ও অবস্থান | Bigraha Houses – Santipur Rash';
$metaDescription = 'শান্তিপুরের বিগ্রহ বাড়িগুলির ইতিহাস, গুরুত্ব ও অবস্থান। History and locations of Bigraha houses.';

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/*
 * Each house: name (bn), name (en), history, address, image file, video file.
 * Leave the bracketed placeholder text until verified details are available.
 */
$houses = [
    ['[বিগ্রহ বাড়ির নাম ১]', '[House name 1]', '[ইতিহাস – যাচাইয়ের পর যোগ করুন]', '[ঠিকানা – যাচাইয়ের পর যোগ করুন]', 'bigraha-1.jpg', 'bigraha-1.mp4'],
    ['[বিগ্রহ বাড়ির নাম ২]', '[House name 2]', '[ইতিহাস – যাচাইয়ের পর যোগ করুন]', '[ঠিকানা – যাচাইয়ের পর যোগ করুন]', 'bigraha-2.jpg', 'bigraha-2.mp4'],
    ['[বিগ্রহ বাড়ির নাম ৩]', '[House name 3]', '[ইতিহাস – যাচাইয়ের পর যোগ করুন]', '[ঠিকানা – যাচাইয়ের পর যোগ করুন]', 'bigraha-3.jpg', 'bigraha-3.mp4'],
];

$galleryFiles = ['bigraha-gallery-1.jpg', 'bigraha-gallery-2.jpg', 'bigraha-gallery-3.jpg', 'bigraha-gallery-4.jpg'];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Bigraha Houses</p>
        <h1>বিগ্রহ বাড়িগুলির ইতিহাস ও অবস্থান</h1>
        <p lang="en">History &amp; Locations of Bigraha Houses</p>
    </div>
</section>

<section class="section">
    <div class="container prose">
        <h2>বিগ্রহ বাড়ির পরিচিতি <span lang="en">– Overview</span></h2>
        <p class="placeholder-note">
            [বিগ্রহ বাড়ি কী, এর ইতিহাস এবং সাংস্কৃতিক ও ধর্মীয় গুরুত্ব – যাচাইকৃত তথ্য যোগ করুন।]<br>
            <span lang="en">[What Bigraha houses are, their history and cultural/religious importance – to be added after verification.]</span>
        </p>
    </div>
</section>

<section class="section section--alt" aria-labelledby="houses-heading">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="houses-heading">বিগ্রহ বাড়িসমূহ</h2>
            <p class="section-title__en" lang="en">The Bigraha Houses</p>
        </div>

        <div class="grid grid--2">
            <?php foreach ($houses as $index => [$nameBn, $nameEn, $history, $address, $imageFile, $videoFile]): ?>
                <article class="card" id="house-<?= $index + 1 ?>">
                    <div class="card__media">
                        <?= imageOrPlaceholder($basePath, $imageFile, $nameEn, 'Photograph of ' . $nameEn . '.') ?>
                    </div>
                    <div class="card__body">
                        <h3 class="card__title"><?= e($nameBn) ?></h3>
                        <p class="card__subtitle" lang="en"><?= e($nameEn) ?></p>

                        <p><strong>ইতিহাস:</strong> <?= e($history) ?></p>
                        <p><strong>অবস্থান / Location:</strong> <?= e($address) ?></p>

                        <?= videoOrPlaceholder($basePath, $videoFile, 'Video of ' . $nameEn . '.') ?>

                        <div class="map-box map-box--small mt-1">
                            <div class="img-placeholder" role="img" aria-label="Map placeholder for <?= e($nameEn) ?>">
                                <span><strong>Map placeholder</strong>Paste an embedded map &lt;iframe&gt; here once the address is verified.</span>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="bigraha-gallery">
    <div class="container">
        <div class="section-title">
            <h2 id="bigraha-gallery">চিত্র প্রদর্শনী</h2>
            <p class="section-title__en" lang="en">Image Gallery</p>
        </div>
        <div class="gallery">
            <?php foreach ($galleryFiles as $n => $file): ?>
                <figure class="gallery__item">
                    <?= imageOrPlaceholder($basePath, $file, 'Bigraha house gallery image ' . ($n + 1), 'Gallery photograph ' . ($n + 1) . '.') ?>
                    <figcaption>[Caption to be added]</figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>