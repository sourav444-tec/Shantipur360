<?php
/**
 * pages/special-attractions.php – Ray Raja, Fanush, Kunjabhang.
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'attractions';
$pageTitle       = 'রাসের বিশেষত্ব | Special Attractions – Santipur Rash';
$metaDescription = 'রায় রাজার ইতিহাস, ফানুস ও কুঞ্জভঙ্গ – শান্তিপুরের রাসের বিশেষ আকর্ষণ। Special attractions of Santipur Rash.';

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/* id, Bengali title, English title, image file, video file */
$attractions = [
    ['ray-raja',    'রায় রাজার ইতিহাস', 'History of Ray Raja', 'attraction-ray-raja.jpg',    'ray-raja.mp4'],
    ['fanush',      'ফানুস',              'Fanush',               'attraction-fanush.jpg',      'fanush.mp4'],
    ['kunjabhang',  'কুঞ্জভঙ্গ',           'Kunjabhang',           'attraction-kunjabhang.jpg',  'kunjabhang.mp4'],
];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Special Attractions</p>
        <h1>রাসের বিশেষত্ব</h1>
        <p lang="en">Special Attractions</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <p class="text-center">
            <?php foreach ($attractions as [$id, $titleBn, $titleEn]): ?>
                <a class="btn btn--outline btn--small" href="#<?= e($id) ?>"><?= e($titleBn) ?></a>
            <?php endforeach; ?>
        </p>

        <p class="placeholder-note">
            <strong>Editorial note:</strong> Descriptions below are placeholders. Add only verified information.
        </p>

        <?php foreach ($attractions as [$id, $titleBn, $titleEn, $imageFile, $videoFile]): ?>
            <article class="feature-block" id="<?= e($id) ?>" aria-labelledby="<?= e($id) ?>-title">
                <div>
                    <span class="badge" lang="en">Special Attraction</span>
                    <h2 id="<?= e($id) ?>-title"><?= e($titleBn) ?></h2>
                    <p class="section-title__en" lang="en" style="text-align:left;"><?= e($titleEn) ?></p>

                    <h3>বিবরণ <span lang="en">– Description</span></h3>
                    <p class="placeholder-note">[<?= e($titleBn) ?> সম্পর্কে যাচাইকৃত বিবরণ এখানে যোগ করুন।]</p>

                    <h3>সাংস্কৃতিক তাৎপর্য <span lang="en">– Cultural Significance</span></h3>
                    <p class="placeholder-note">[সাংস্কৃতিক ও ধর্মীয় তাৎপর্য – যাচাইয়ের পর যোগ করুন।]</p>
                </div>

                <div>
                    <div class="card__media" style="border-radius:14px; overflow:hidden; margin-bottom:1rem;">
                        <?= imageOrPlaceholder($basePath, $imageFile, $titleEn, 'Photograph or illustration for ' . $titleEn . '.') ?>
                    </div>
                    <?= videoOrPlaceholder($basePath, $videoFile, 'Optional video about ' . $titleEn . '.') ?>
                </div>
            </article>
        <?php endforeach; ?>

        <p class="text-center">
            <a class="btn btn--navy" href="bigraha-houses.php">Next: Bigraha Houses <span aria-hidden="true">→</span></a>
        </p>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>