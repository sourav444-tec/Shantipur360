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
    ['ray-raja',    'রায় রাজার ইতিহাস', 'History of Ray Raja', 'rash-03.jpg',    'ray-raja.mp4'],
    ['fanush',      'ফানুস',              'Fanush',               'rash-04.jpg',      'fanush.mp4'],
    ['kunjabhang',  'কুঞ্জভঙ্গ',           'Kunjabhang',           'attraction-kunjabhang.jpg',  'kunjabhang.mp4'],
];

/* Description text keyed by attraction id. Missing ids keep the placeholder. */
$descriptions = [
    'ray-raja' => 'শান্তিপুরের রাসের সুচনা লগ্নে রাই রাজা বা রাধিকা রাজার প্রচলন ছিলো না। কোন এক সময় নবদ্বীপের শাক্ত রাস কে জনপ্রিয় করার জন্য নদীয়ার রাজ পরিবার শান্তিপুরে আগত ভক্তদের উপর তীর্থ কর অরোক করে। কথিত আছে রাসে আগত দর্শনার্থীদের তীর্থোকর ব্যায় ভার গ্রহণ করে খাঁ চৌধুরী পরিবার। তৎকালীন গোস্বামী বর্গ শান্তিপুরের ভাঙারাসে বৈচিত্র্য আনবার উদ্দেশ্য শ্রীমদ্ভগবদ্গীতা অনুসরন কোরে শ্রী কৃষ্ণ রাস অঙ্গন ছেড়ে যাওয়ার পর রাসের রাজা হোয়েছিলেন রাধা রানী। সেই ধারনাকে মাথাই রেখে কুমারী বালিকা শ্রী বিগ্রহের সমানে রাধিকা রূপে নগর পরিক্রমার উদ্দেশ্য রৌনা হোন। সেই সভায় আতা বুনিয়াদি গোস্বামী পরিবার উপস্থিত না থাকায় তাঁদের রায় রাজা বের হয় না। পরবর্তিতে রাসে আরো বৃহত্তর হয়েছে, মাঝে বিগ্রহ বাড়ির অনুকরণ করে বারোয়ারিরাও ভাঙারাসে রায় রাজা বার করতো,কিন্ত বর্তমানে তা আর হয় না। বিগ্রহ বাড়ির সংখ্যা বেড়েছে নতুন করে সংযোজিত হয়েছে, তারাও অন্যান্য বিগ্রহ বাড়িকে অনুসরন করে রায় রাজার প্রথাকে বহন করে চলেছে।',

    'fanush' => 'শান্তিপুরের রাসযাত্রার ইতিহাসে বেলোয়ারি ফানুস এক অনন্য ঐতিহ্যের নাম। ইউরোপীয় কাচশিল্পের ছোঁয়ায় তৈরি রঙিন কাচের এই ফানুসগুলি কয়েক শতাব্দী ধরে শান্তিপুরের প্রাচীন বিগ্রহ বাড়িগুলির রাস উৎসবকে আলোকিত করে আসছে। ফানুসের ভিতরে প্রজ্বলিত মোমবাতির স্নিগ্ধ আলোয় সেজে ওঠে ঠাকুরদালান ও রাসমঞ্চ। আধুনিক বৈদ্যুতিক আলোর যুগেও কিছু প্রাচীন পরিবারে যত্নসহকারে সংরক্ষিত এই ফানুসগুলি আজও অতীতের আভিজাত্য, শিল্পকলা ও ঐতিহ্যের সাক্ষ্য বহন করে চলেছে।

এ শুধু আলোকসজ্জা নয়, এ শান্তিপুরের ইতিহাসের এক জীবন্ত আলোকচিত্র।',

    'kunjabhang' => 'ভাঙারাসের নগর পরিক্রমা শেষে যুগল বিগ্রহের নিশি যাপনের পর রাস যাত্রার অন্তিম পর্যায় হিসেবে রাস কুঞ্জ ভঙ্গের সময় আগত হয়। বৈষ্ণবীয় পদকর্তারা ভাঙা রাসের নিশি কে "সুখো নিশি" বলে উল্লেখ করেছে। বিরহোরসে ভরা কুঞ্জ ভঙ্গ শান্তিপুর এ যুগল এর মিলন উৎসব রূপ এ প্রতিওমান হোই। বড় গোস্বামী গৃহে বিসেস কীর্তন, "যুগল ভোজো যুগল পুজো যুগল প্রেমানন্দে ভাসো/রাধারমণ ই মোরা যুগল বিনা বুঝি না"। এই গান এর মধ্যে দিয়েই বিরহ উৎসব কে শান্তিপুরবাসি মিলনের পরম উৎসব করে তুলেছেন।',
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

        <!-- <p class="placeholder-note">
            <strong>Editorial note:</strong> Descriptions below are placeholders. Add only verified information.
        </p> -->

        <?php foreach ($attractions as [$id, $titleBn, $titleEn, $imageFile, $videoFile]): ?>
            <article class="feature-block" id="<?= e($id) ?>" aria-labelledby="<?= e($id) ?>-title">
                <div>
                    <span class="badge" lang="en">Special Attraction</span>
                    <h2 id="<?= e($id) ?>-title"><?= e($titleBn) ?></h2>
                    <p class="section-title__en" lang="en" style="text-align:left;"><?= e($titleEn) ?></p>

                    <h3>বিবরণ <span lang="en">– Description</span></h3>
                    <?php if (isset($descriptions[$id])): ?>
                        <p><?= nl2br(e($descriptions[$id])) ?></p>
                    <?php else: ?>
                        <p class="placeholder-note">[<?= e($titleBn) ?> সম্পর্কে যাচাইকৃত বিবরণ এখানে যোগ করুন।]</p>
                    <?php endif; ?>

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