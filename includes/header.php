<?php
/**
 * includes/header.php
 * Common <head> and opening <body>.
 *
 * Variables a page may set BEFORE including this file:
 *   $basePath         '' for index.php, '../' for files inside /pages
 *   $pageTitle        full <title> text
 *   $metaDescription  meta description text
 *   $activePage       key from $navItems (home, history, ...)
 */

declare(strict_types=1);

$basePath        = $basePath ?? '';
$activePage      = $activePage ?? '';
$pageTitle       = $pageTitle ?? 'শান্তিপুরের রাস | Santipur Rash – Tradition Meets Devotion';
$metaDescription = $metaDescription
    ?? 'শান্তিপুরের রাস মহোৎসব – ঐতিহ্য, সংস্কৃতি ও ভক্তির তথ্যভিত্তিক ওয়েবসাইট। Santipur Rash festival information website.';

/** Escape output for safe HTML display (XSS protection). */
if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

/**ami add korechi extra : i should die then */

/**
 * Shows assets/images/<file> if it exists, otherwise a labelled placeholder.
 * Uses dirname(__DIR__) = project root, so it works from any page depth.
 */
if (!function_exists('imageOrPlaceholder')) {
    function imageOrPlaceholder(string $basePath, string $file, string $alt, string $hint): string
    {
        if (is_file(dirname(__DIR__) . '/assets/images/' . $file)) {
            return '<img src="' . e($basePath . 'assets/images/' . $file) . '" alt="' . e($alt) . '" loading="lazy">';
        }
        return '<div class="img-placeholder" role="img" aria-label="' . e($alt) . '"><span><strong>Image placeholder</strong>'
            . e($hint) . '<br><small>Add file: assets/images/' . e($file) . '</small></span></div>';
    }
}

/**
 * Shows assets/videos/<file> in a player if it exists, otherwise a placeholder.
 * To embed YouTube instead, replace the call with an <iframe> inside .video-box.
 */
if (!function_exists('videoOrPlaceholder')) {
    function videoOrPlaceholder(string $basePath, string $file, string $hint): string
    {
        if (is_file(dirname(__DIR__) . '/assets/videos/' . $file)) {
            return '<div class="video-box"><video controls preload="metadata" src="'
                . e($basePath . 'assets/videos/' . $file) . '">Your browser does not support video playback.</video></div>';
        }
        return '<div class="video-box"><div class="img-placeholder" role="img" aria-label="Video placeholder"><span><strong>Video placeholder</strong>'
            . e($hint) . '<br><small>Add file: assets/videos/' . e($file) . '</small></span></div></div>';
    }
}


/**ei porzonto shit of code is done by nalla coder */



/**
 * Single source of truth for navigation.
 * key => [English label, Bengali label, path relative to project root]
 */
$navItems = [
    'home'           => ['Home',               'হোম',                 'index.php'],
    'history'        => ['History',            'ইতিহাস',              'pages/history.php'],
    'attractions'    => ['Special Attractions','রাসের বিশেষত্ব',       'pages/special-attractions.php'],
    'bigraha'        => ['Bigraha Houses',     'বিগ্রহ বাড়ি',         'pages/bigraha-houses.php'],
    'pandals'        => ['Theme Pandals',      'থিম প্যান্ডেল',        'pages/theme-pandals.php'],
    'administration' => ['Administration',     'প্রশাসনিক মতামত',      'pages/administration.php'],
    'route'          => ['Route Map',          'রুটম্যাপ',             'pages/route-map.php'],
    'emergency'      => ['Emergency Services', 'জরুরি পরিষেবা',        'pages/emergency.php'],
    'feedback'       => ['Feedback',           'মতামত',               'pages/feedback.php'],
    'directory'      => ['Festival Directory', 'উৎসব ডিরেক্টরি',       'pages/directory.php'],
];
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($metaDescription) ?>">
    <meta name="theme-color" content="#0b1f4d">

    <!-- Lets CSS know JavaScript is available (menu collapses only when JS works) -->
    <script>document.documentElement.classList.add('js');</script>

    <!-- Fonts (optional; system fonts are used as fallback if offline) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Noto+Serif+Bengali:wght@500;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,500;1,600&display=swap">

    <link rel="stylesheet" href="<?= e($basePath) ?>css/style.css">
</head>
<body>
<a class="skip-link" href="#main-content">Skip to main content</a>