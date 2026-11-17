<?php
/**
 * pages/route-map.php – Festival route map and visitor movement information.
 *
 * To show a real map: set $mapEmbedUrl to the "src" address from an embed
 * code (e.g. Google Maps > Share > Embed a map). Leave '' for the placeholder.
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'route';
$pageTitle       = 'রুটম্যাপ | Festival Route Map – Santipur Rash';
$metaDescription = 'শান্তিপুরের রাস উৎসবের রুটম্যাপ, প্রবেশ ও প্রস্থান পথ, পার্কিং ও ভিড় নিয়ন্ত্রণের তথ্য।';

$mapEmbedUrl = '';   // e.g. 'https://www.google.com/maps/embed?pb=...'

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/* Only allow secure http(s) embed addresses */
$mapIsValid = $mapEmbedUrl !== '' && preg_match('#^https://#i', $mapEmbedUrl) === 1;

/* icon, Bengali title, English title, placeholder text */
$infoBlocks = [
    ['🛣️', 'উৎসবের রুট',            'Festival Route',        '[রুটের বিবরণ – সরকারি ও আয়োজক কমিটির যাচাইকৃত তথ্য যোগ করুন]'],
    ['📍', 'গুরুত্বপূর্ণ স্থান',     'Important Locations',   '[গুরুত্বপূর্ণ স্থানের তালিকা – যাচাইয়ের পর যোগ করুন]'],
    ['🚪', 'প্রবেশ ও প্রস্থান পথ',   'Entry & Exit Points',   '[প্রবেশ ও প্রস্থান পথের তথ্য – যাচাইয়ের পর যোগ করুন]'],
    ['🅿️', 'পার্কিং',               'Parking Information',   '[পার্কিং এলাকার তথ্য – যাচাইয়ের পর যোগ করুন]'],
    ['👥', 'ভিড় নিয়ন্ত্রণ',         'Crowd Management',      '[ভিড় নিয়ন্ত্রণ ও যান চলাচলের নির্দেশিকা – প্রশাসনের কাছ থেকে নিন]'],
];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Route Map</p>
        <h1>রুটম্যাপ</h1>
        <p lang="en">Festival Route Map</p>
    </div>
</section>

<section class="section" aria-labelledby="map-heading">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="map-heading">উৎসব এলাকার মানচিত্র</h2>
            <p class="section-title__en" lang="en">Festival Area Map</p>
        </div>

        <div class="map-box">
            <?php if ($mapIsValid): ?>
                <iframe src="<?= e($mapEmbedUrl) ?>" title="Santipur Rash route map" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            <?php else: ?>
                <div class="img-placeholder" role="img" aria-label="Map placeholder">
                    <span>
                        <strong>Map placeholder</strong>
                        Set <code>$mapEmbedUrl</code> at the top of <code>pages/route-map.php</code>
                        to display an embedded map.
                    </span>
                </div>
            <?php endif; ?>
        </div>
        <p class="field-hint text-center">Route, parking and entry/exit details must be confirmed with the local administration before publishing.</p>
    </div>
</section>

<section class="section section--alt" aria-labelledby="route-info-heading">
    <div class="container">
        <div class="section-title">
            <h2 id="route-info-heading">যাতায়াত ও নির্দেশিকা</h2>
            <p class="section-title__en" lang="en">Travel &amp; Visitor Guidance</p>
        </div>

        <div class="grid grid--3">
            <?php foreach ($infoBlocks as [$icon, $titleBn, $titleEn, $placeholder]): ?>
                <article class="info-card">
                    <div class="info-card__icon" aria-hidden="true"><?= e($icon) ?></div>
                    <h3><?= e($titleBn) ?></h3>
                    <p class="info-card__en" lang="en"><?= e($titleEn) ?></p>
                    <p class="placeholder-note"><?= e($placeholder) ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="text-center mt-2">
            <a class="btn btn--maroon" href="emergency.php">Emergency Services <span aria-hidden="true">→</span></a>
        </p>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>