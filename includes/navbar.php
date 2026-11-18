<?php
/**
 * includes/navbar.php
 * Top info bar + site header + primary navigation.
 * Requires header.php to have been included first ($navItems, $basePath, $activePage, e()).
 */

$basePath   = $basePath ?? '';
$activePage = $activePage ?? '';
?>
<div class="topbar">
    <div class="container topbar__inner">
        <p class="topbar__location"><span aria-hidden="true">📍</span> Santipur, Nadia, West Bengal</p>
        <p class="topbar__tagline" lang="en">Tradition Meets Devotion</p>
        <ul class="social-list" aria-label="Social media (placeholders)">
            <li><a href="#" aria-label="Facebook (link to be added)">f</a></li>
            <li><a href="#" aria-label="YouTube (link to be added)">▶</a></li>
            <li><a href="#" aria-label="Instagram (link to be added)">◎</a></li>
        </ul>
    </div>
</div>

<header class="site-header">
    <div class="container site-header__inner">
        <a class="brand" href="<?= e($basePath) ?>index.php" aria-label="Santipur Rash – Home">
            <img class="brand__logo"
                 src="<?= e($basePath) ?>assets/images/20261108_021926.png"
                 alt="Santipur Rash logo">
            <span class="brand__text">
                <span class="brand__bn">শান্তিপুরের রাস</span>
                <span class="brand__en">Santipur Rash</span>
            </span>
        </a>

        <button class="nav-toggle" type="button"
                aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation menu">
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
        </button>

        <nav id="primary-nav" class="primary-nav" aria-label="Main navigation">
            <ul class="primary-nav__list">
                <?php foreach ($navItems as $key => [$labelEn, $labelBn, $path]): ?>
                    <li>
                        <a href="<?= e($basePath . $path) ?>"
                           title="<?= e($labelBn) ?>"
                           class="primary-nav__link<?= $activePage === $key ? ' is-active' : '' ?>"
                           <?= $activePage === $key ? 'aria-current="page"' : '' ?>>
                            <?= e($labelEn) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <a class="admin-login-link" href="<?= e($basePath) ?>admin/index.php">Admin Login</a>
    </div>
    <div class="border-ornament" aria-hidden="true"></div>
</header>

<main id="main-content" tabindex="-1">