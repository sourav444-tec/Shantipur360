<?php
/**
 * pages/history.php – History of Rash Yatra.
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'history';
$pageTitle       = 'রাসযাত্রার ইতিহাস | History of Rash Yatra – Santipur Rash';
$metaDescription = 'রাসযাত্রার ইতিহাস, সাংস্কৃতিক ও ধর্মীয় গুরুত্ব এবং ঐতিহ্যবাহী রীতিনীতি। History of Rash Yatra.';

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/* Gallery slots: file name => caption (add real files to assets/images/) */
$photos = [
    'history-1.jpg' => 'Historical photograph 1 – [caption and source to be added]',
    'history-2.jpg' => 'Historical photograph 2 – [caption and source to be added]',
    'history-3.jpg' => 'Historical photograph 3 – [caption and source to be added]',
    'history-4.jpg' => 'Historical photograph 4 – [caption and source to be added]',
];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › History</p>
        <h1>রাসযাত্রার ইতিহাস</h1>
        <p lang="en">History of Rash Yatra</p>
    </div>
</section>

<section class="section">
    <div class="container prose">

        <p class="placeholder-note">
            <strong>Editorial note:</strong> The text below is general background only. Every place-specific
            fact about Santipur must be added from verified sources (local historians, committees, records).
            Replace each highlighted placeholder before publishing.
        </p>

        <h2>রাসযাত্রার পরিচিতি <span lang="en">– Introduction</span></h2>
        <p>
            রাসযাত্রা বৈষ্ণব ঐতিহ্যের একটি উৎসব, যা শ্রীকৃষ্ণ ও শ্রীরাধার রাসলীলার স্মরণে পালিত হয়।
            বাংলায় এটি সাধারণত কার্তিক মাসের পূর্ণিমার সময়ের কাছাকাছি উদযাপিত হয়।
        </p>
        <p lang="en">
            Rash Yatra is a Vaishnava festival associated with the Raas Lila of Krishna and Radha, observed in
            Bengal around the full moon of the month of Kartik.
        </p>

        <h2>ঐতিহাসিক পটভূমি <span lang="en">– Historical Background</span></h2>
        <p class="placeholder-note">
            [শান্তিপুরে রাসযাত্রার সূচনা, প্রাচীন নথি ও ঐতিহাসিক তথ্য – যাচাইকৃত তথ্য ও সূত্র সহ এখানে যোগ করুন।]<br>
            <span lang="en">[Origins of Rash Yatra in Santipur, with dates and sources – to be added after verification.]</span>
        </p>

        <h2>সাংস্কৃতিক গুরুত্ব <span lang="en">– Cultural Importance</span></h2>
        <p class="placeholder-note">
            [শহরের সংস্কৃতি, শিল্প, কারুশিল্প ও সামাজিক জীবনে রাসের প্রভাব – যাচাইকৃত তথ্য যোগ করুন।]<br>
            <span lang="en">[Cultural impact on the town, crafts, arts and community life – to be added.]</span>
        </p>

        <h2>ধর্মীয় তাৎপর্য <span lang="en">– Religious Significance</span></h2>
        <p>
            ভক্তদের কাছে রাস উৎসব শ্রীকৃষ্ণ ও শ্রীরাধার প্রতি ভক্তি ও আধ্যাত্মিক আনন্দের প্রতীক।
        </p>
        <p class="placeholder-note">
            [স্থানীয় বৈষ্ণব ঐতিহ্য ও ধর্মীয় রীতির বিস্তারিত বিবরণ – যাচাইয়ের পর যোগ করুন।]
        </p>

        <h2>ঐতিহ্যবাহী রীতিনীতি <span lang="en">– Traditional Practices</span></h2>
        <p class="placeholder-note">
            [পূজা, শোভাযাত্রা, বিগ্রহ দর্শন ও অন্যান্য স্থানীয় রীতির তালিকা – যাচাইকৃত তথ্য যোগ করুন।]<br>
            <span lang="en">[Rituals, processions and local customs – to be listed after verification.]</span>
        </p>
    </div>
</section>

<section class="section section--alt" aria-labelledby="history-gallery">
    <div class="container">
        <div class="section-title">
            <h2 id="history-gallery">ঐতিহাসিক আলোকচিত্র</h2>
            <p class="section-title__en" lang="en">Historical Photographs</p>
        </div>
        <div class="gallery">
            <?php foreach ($photos as $file => $caption): ?>
                <figure class="gallery__item">
                    <?= imageOrPlaceholder($basePath, $file, $caption, 'Historical photograph.') ?>
                    <figcaption><?= e($caption) ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>