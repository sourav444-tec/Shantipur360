<?php
/**
 * includes/footer.php
 * Closes <main>, renders the footer, loads JS, closes the document.
 * Requires header.php ($navItems, $basePath, e()).
 */

$basePath = $basePath ?? '';
?>
</main>

<footer class="site-footer">
    <div class="skyline" aria-hidden="true"></div>
    <div class="container footer-grid">
        <section aria-labelledby="footer-about">
            <h2 id="footer-about" class="footer-title">শান্তিপুরের রাস</h2>
            <p class="footer-tagline" lang="en">Tradition Meets Devotion</p>
            <p>ঐতিহ্য • সংস্কৃতি • ভক্তি</p>
            <p class="footer-note">এক শহরের ঐতিহ্যমণ্ডিত রাস মহোৎসব।</p>
        </section>

        <nav aria-labelledby="footer-links">
            <h2 id="footer-links" class="footer-title">Quick Links</h2>
            <ul class="footer-list">
                <?php foreach ($navItems as [$labelEn, $labelBn, $path]): ?>
                    <li><a href="<?= e($basePath . $path) ?>"><?= e($labelEn) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <section aria-labelledby="footer-info">
            <h2 id="footer-info" class="footer-title">Important Information</h2>
            <ul class="footer-list">
                <li>Location: Santipur, Nadia, West Bengal</li>
                <li>Contact email: <em>[to be added]</em></li>
                <li>Helpline: <em>[to be added – verified number only]</em></li>
                <li><a href="<?= e($basePath) ?>pages/emergency.php">Emergency information</a></li>
                <li><a href="<?= e($basePath) ?>pages/feedback.php">Share your feedback</a></li>
            </ul>
        </section>

        <section aria-labelledby="footer-social">
            <h2 id="footer-social" class="footer-title">Follow Us</h2>
            <ul class="social-list" aria-label="Social media (placeholders)">
                <li><a href="#" aria-label="Facebook (link to be added)">f</a></li>
                <li><a href="#" aria-label="YouTube (link to be added)">▶</a></li>
                <li><a href="#" aria-label="Instagram (link to be added)">◎</a></li>
            </ul>
            <p class="footer-note">Social media links will be added later.</p>
        </section>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom__inner">
            <p>&copy; <?= e(date('Y')) ?> Santipur Rash &nbsp;|&nbsp; Designed by Royal Tech</p>
            <p class="footer-motto" lang="en">Let’s keep the tradition alive…</p>
        </div>
    </div>
</footer>

<script src="<?= e($basePath) ?>js/script.js" defer></script>
</body>
</html>