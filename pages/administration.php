<?php
/**
 * pages/administration.php – Administrative messages.
 * Fill in the arrays below ONLY with details supplied by the officials' offices.
 * Leave 'name', 'message' and 'profile' empty ('') to show the placeholder.
 */

declare(strict_types=1);

$basePath        = '../';
$activePage      = 'administration';
$pageTitle       = 'প্রশাসনিক মতামত | Administrative Messages – Santipur Rash';
$metaDescription = 'শান্তিপুরের রাস উপলক্ষে সাংসদ, বিধায়ক, জেলা শাসক, ভারপ্রাপ্ত আধিকারিক ও মহকুমা শাসকের বার্তা।';

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';

/* id, Bengali designation, English designation, photo file, name, message, profile/signature */
$officials = [
    ['mp',  'সাংসদ',                'Member of Parliament (MP)',            'official-mp.jpg',  '', '', ''],
    ['mla', 'বিধায়ক',               'Member of Legislative Assembly (MLA)', 'official-mla.jpg', '', '', ''],
    ['dm',  'জেলা শাসক',            'District Magistrate (DM)',             'official-dm.jpg',  '', '', ''],
    ['oc',  'ভারপ্রাপ্ত আধিকারিক',   'Officer-in-Charge (OC)',               'official-oc.jpg',  '', '', ''],
    ['sdo', 'মহকুমা শাসক',          'Sub-Divisional Officer (SDO)',         'official-sdo.jpg', '', '', ''],
];
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Administration</p>
        <h1>প্রশাসনিক মতামত</h1>
        <p lang="en">Administrative Messages</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <p class="placeholder-note">
            <strong>Editorial note:</strong> Names, photographs and messages must be supplied or approved by
            the respective offices. Do not publish any quotation that has not been officially provided.
        </p>

        <p class="text-center">
            <?php foreach ($officials as [$id, $roleBn]): ?>
                <a class="btn btn--outline btn--small" href="#<?= e($id) ?>"><?= e($roleBn) ?></a>
            <?php endforeach; ?>
        </p>

        <?php foreach ($officials as [$id, $roleBn, $roleEn, $photoFile, $name, $message, $profile]): ?>
            <article class="person" id="<?= e($id) ?>" aria-labelledby="<?= e($id) ?>-title">
                <div class="person__photo">
                    <?= imageOrPlaceholder($basePath, $photoFile, $name !== '' ? $name : $roleEn, 'Official photograph of the ' . $roleEn . '.') ?>
                </div>

                <div>
                    <h2 id="<?= e($id) ?>-title"><?= e($roleBn) ?></h2>
                    <p class="person__role" lang="en"><?= e($roleEn) ?></p>

                    <p><strong>নাম / Name:</strong>
                        <?php if ($name !== ''): ?>
                            <?= e($name) ?>
                        <?php else: ?>
                            <em>[Name to be supplied by the official's office]</em>
                        <?php endif; ?>
                    </p>

                    <?php if ($message !== ''): ?>
                        <blockquote class="person__message"><?= nl2br(e($message)) ?></blockquote>
                    <?php else: ?>
                        <p class="placeholder-note">
                            [আনুষ্ঠানিক বার্তা – সংশ্লিষ্ট দপ্তর থেকে পাওয়ার পর এখানে যোগ করুন।]<br>
                            <span lang="en">[Official message – to be added once supplied by the office.]</span>
                        </p>
                    <?php endif; ?>

                    <p class="person__signature">
                        <?php if ($profile !== ''): ?>
                            <?= e($profile) ?>
                        <?php else: ?>
                            <em>[Optional: signature image or short profile details]</em>
                        <?php endif; ?>
                    </p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>