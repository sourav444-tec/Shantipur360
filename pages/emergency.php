<?php
/**
 * pages/emergency.php – Emergency services.
 *
 * IMPORTANT: Never enter a number that has not been verified by the
 * administration. Leave 'number' as '' to show the placeholder.
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'emergency';
$pageTitle       = 'জরুরি পরিষেবা | Emergency Services – Santipur Rash';
$metaDescription = 'শান্তিপুরের রাস উৎসবের জরুরি পরিষেবা – পুলিশ, দমকল, অ্যাম্বুলেন্স, হাসপাতাল ও প্রাথমিক চিকিৎসা।';

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/* icon, Bengali title, English title, verified phone number ('' until supplied) */
$services = [
    ['🛡️', 'পুলিশ',            'Police',              ''],
    ['🚒', 'অগ্নিনির্বাপণ',     'Fire Services',       ''],
    ['🚑', 'অ্যাম্বুলেন্স',      'Ambulance',           ''],
    ['🏥', 'হাসপাতাল',         'Hospitals',           ''],
    ['➕', 'প্রাথমিক চিকিৎসা',   'First Aid',           ''],
    ['🔎', 'হারানো ও প্রাপ্তি',   'Lost and Found',      ''],
    ['🆘', 'জরুরি সহায়তা',      'Emergency Assistance', ''],
];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Emergency Services</p>
        <h1>জরুরি পরিষেবা</h1>
        <p lang="en">Emergency Services</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <p class="alert alert--error" role="note">
            <strong>জীবনঘাতী জরুরি অবস্থায় অবিলম্বে সরকারি জরুরি পরিষেবার সঙ্গে যোগাযোগ করুন।</strong><br>
            <span lang="en">In a life-threatening emergency, contact the official emergency services immediately.</span>
        </p>

        <p class="placeholder-note">
            <strong>Editorial note:</strong> Phone numbers, addresses and locations below are placeholders.
            Publish only details verified by the local administration.
        </p>

        <div class="grid grid--3">
            <?php foreach ($services as [$icon, $titleBn, $titleEn, $number]): ?>
                <?php $telDigits = preg_replace('/[^0-9+]/', '', $number); ?>
                <article class="info-card">
                    <div class="info-card__icon" aria-hidden="true"><?= e($icon) ?></div>
                    <h2><?= e($titleBn) ?></h2>
                    <p class="info-card__en" lang="en"><?= e($titleEn) ?></p>

                    <ul class="info-list">
                        <li><strong>ফোন / Phone:</strong>
                            <?= $number !== '' ? e($number) : '<em>[verified number to be added]</em>' ?></li>
                        <li><strong>ঠিকানা / Location:</strong> <em>[verified address to be added]</em></li>
                        <li><strong>সময় / Availability:</strong> <em>[to be added]</em></li>
                    </ul>

                    <?php if ($telDigits !== ''): ?>
                        <a class="tel-link" href="tel:<?= e($telDigits) ?>">
                            <span aria-hidden="true">📞</span> Call <?= e($titleEn) ?>
                        </a>
                    <?php else: ?>
                        <span class="tel-link" aria-disabled="true">
                            <span aria-hidden="true">📞</span> Number to be added
                        </span>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="text-center mt-2">
            <a class="btn btn--navy" href="route-map.php">View Route Map <span aria-hidden="true">→</span></a>
            <a class="btn btn--maroon" href="feedback.php">Share Feedback <span aria-hidden="true">→</span></a>
        </p>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>