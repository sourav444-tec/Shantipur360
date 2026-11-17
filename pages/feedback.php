<?php
/**
 * pages/feedback.php – Visitor feedback form (stores into MySQL).
 * Processing happens BEFORE any HTML output so redirects work.
 */

declare(strict_types=1);

session_start();

require __DIR__ . '/../includes/db.php';

$basePath        = '../';
$activePage      = 'feedback';
$pageTitle       = 'মতামত | Visitor Feedback – Santipur Rash';
$metaDescription = 'শান্তিপুরের রাস সম্পর্কে আপনার মতামত ও পরামর্শ জানান। Share your feedback about Santipur Rash.';

/* Allowed categories: stored value => label shown to visitor */
$categories = [
    'general'      => 'সাধারণ মতামত / General feedback',
    'organisation' => 'আয়োজন / Organisation',
    'cleanliness'  => 'পরিচ্ছন্নতা / Cleanliness',
    'safety'       => 'নিরাপত্তা / Safety',
    'crowd'        => 'ভিড় নিয়ন্ত্রণ / Crowd management',
    'suggestion'   => 'পরামর্শ / Suggestion',
    'other'        => 'অন্যান্য / Other',
];

$old     = ['visitor_name' => '', 'email' => '', 'phone' => '', 'category' => '', 'rating' => '', 'message' => ''];
$errors  = [];
$success = false;
$systemError = false;

/* CSRF token (one per session, rotated after a successful save) */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* One-time success flag set by the redirect below */
if (!empty($_SESSION['feedback_saved'])) {
    $success = true;
    unset($_SESSION['feedback_saved']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedToken = (string) ($_POST['csrf_token'] ?? '');

    if (!hash_equals($_SESSION['csrf_token'], $postedToken)) {
        $errors['form'] = 'Your session has expired. Please try again. (আপনার সেশনের মেয়াদ শেষ হয়েছে, আবার চেষ্টা করুন।)';
    }

    /* Collect and trim input */
    foreach ($old as $field => $unused) {
        $old[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    /* Honeypot: bots fill the hidden "website" field. Pretend success, save nothing. */
    if (trim((string) ($_POST['website'] ?? '')) !== '') {
        $_SESSION['feedback_saved'] = true;
        header('Location: feedback.php');
        exit;
    }

    /* Validation */
    $nameLength = mb_strlen($old['visitor_name'], 'UTF-8');
    if ($nameLength < 2 || $nameLength > 100) {
        $errors['visitor_name'] = 'Name must be 2–100 characters. (নাম ২–১০০ অক্ষরের হতে হবে।)';
    }

    if ($old['email'] === '' || mb_strlen($old['email'], 'UTF-8') > 150 || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address. (সঠিক ইমেইল দিন।)';
    }

    if ($old['phone'] !== '' && !preg_match('/^[0-9+\-\s()]{7,20}$/', $old['phone'])) {
        $errors['phone'] = 'Phone may contain digits, spaces, +, - and brackets (7–20 characters).';
    }

    if (!array_key_exists($old['category'], $categories)) {
        $errors['category'] = 'Please choose a category. (একটি বিভাগ বেছে নিন।)';
    }

    $ratingValue = filter_var($old['rating'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]]);
    if ($ratingValue === false) {
        $errors['rating'] = 'Please select a rating from 1 to 5. (১ থেকে ৫ রেটিং দিন।)';
    }

    $messageLength = mb_strlen($old['message'], 'UTF-8');
    if ($messageLength < 10 || $messageLength > 2000) {
        $errors['message'] = 'Message must be 10–2000 characters. (বার্তা ১০–২০০০ অক্ষরের হতে হবে।)';
    }

    /* Save */
    if (!$errors) {
        try {
            $pdo  = getDatabaseConnection();
            $stmt = $pdo->prepare(
                'INSERT INTO feedback (visitor_name, email, phone, category, rating, message)
                 VALUES (:visitor_name, :email, :phone, :category, :rating, :message)'
            );
            $stmt->execute([
                ':visitor_name' => $old['visitor_name'],
                ':email'        => $old['email'],
                ':phone'        => $old['phone'] === '' ? null : $old['phone'],
                ':category'     => $old['category'],
                ':rating'       => $ratingValue,
                ':message'      => $old['message'],
            ]);

            $_SESSION['csrf_token']     = bin2hex(random_bytes(32)); // rotate
            $_SESSION['feedback_saved'] = true;
            header('Location: feedback.php');
            exit;
        } catch (Throwable $exception) {
            error_log('[Santipur Rash] Feedback save failed: ' . $exception->getMessage());
            $systemError = true;
        }
    }
}

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/navbar.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="breadcrumb"><a href="../index.php">Home</a> › Feedback</p>
        <h1>মতামত</h1>
        <p lang="en">Visitor Feedback</p>
    </div>
</section>

<section class="section" aria-labelledby="feedback-heading">
    <div class="container">
        <div class="section-title">
            <span class="section-title__ornament" aria-hidden="true">❀</span>
            <h2 id="feedback-heading">আপনার মতামত জানান</h2>
            <p class="section-title__en" lang="en">Share Your Feedback</p>
            <p>উৎসব সম্পর্কে আপনার অভিজ্ঞতা ও পরামর্শ আমাদের জন্য মূল্যবান।</p>
        </div>

        <div class="form-card">
            <?php if ($success): ?>
                <div class="alert alert--success" role="status">
                    ধন্যবাদ! আপনার মতামত সফলভাবে জমা হয়েছে।<br>
                    <span lang="en">Thank you! Your feedback has been submitted successfully.</span>
                </div>
            <?php endif; ?>

            <?php if ($systemError): ?>
                <div class="alert alert--error" role="alert">
                    Sorry, we could not save your feedback right now. Please try again later.
                    (দুঃখিত, এখন মতামত সংরক্ষণ করা যায়নি। পরে আবার চেষ্টা করুন।)
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="alert alert--error" role="alert">
                    <strong>Please correct the following:</strong>
                    <ul>
                        <?php foreach ($errors as $message): ?>
                            <li><?= e($message) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="feedback.php" data-validate>
                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

                <!-- Honeypot: leave empty. Hidden from people, visible to bots. -->
                <div class="honeypot" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="visitor_name">Name / নাম <span class="required" aria-hidden="true">*</span></label>
                        <input class="form-control" type="text" id="visitor_name" name="visitor_name"
                               value="<?= e($old['visitor_name']) ?>" maxlength="100" required autocomplete="name"
                               <?= isset($errors['visitor_name']) ? 'aria-invalid="true"' : '' ?>>
                        <span class="field-error"><?= e($errors['visitor_name'] ?? '') ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email / ইমেইল <span class="required" aria-hidden="true">*</span></label>
                        <input class="form-control" type="email" id="email" name="email"
                               value="<?= e($old['email']) ?>" maxlength="150" required autocomplete="email"
                               <?= isset($errors['email']) ? 'aria-invalid="true"' : '' ?>>
                        <span class="field-error"><?= e($errors['email'] ?? '') ?></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone (optional) / ফোন</label>
                        <input class="form-control" type="tel" id="phone" name="phone"
                               value="<?= e($old['phone']) ?>" maxlength="20" autocomplete="tel"
                               <?= isset($errors['phone']) ? 'aria-invalid="true"' : '' ?>>
                        <span class="field-error"><?= e($errors['phone'] ?? '') ?></span>
                    </div>

                    <div class="form-group">
                        <label for="category">Category / বিভাগ <span class="required" aria-hidden="true">*</span></label>
                        <select class="form-control" id="category" name="category" required
                                <?= isset($errors['category']) ? 'aria-invalid="true"' : '' ?>>
                            <option value="">— Select / বেছে নিন —</option>
                            <?php foreach ($categories as $value => $label): ?>
                                <option value="<?= e($value) ?>"<?= $old['category'] === $value ? ' selected' : '' ?>><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="field-error"><?= e($errors['category'] ?? '') ?></span>
                    </div>
                </div>

                <fieldset class="rating">
                    <legend>Rating / রেটিং <span class="required" aria-hidden="true">*</span></legend>
                    <div class="rating__stars">
                        <?php for ($star = 5; $star >= 1; $star--): ?>
                            <input type="radio" id="rating-<?= $star ?>" name="rating" value="<?= $star ?>" required
                                   <?= $old['rating'] === (string) $star ? 'checked' : '' ?>>
                            <label for="rating-<?= $star ?>" title="<?= $star ?> / 5"><span aria-hidden="true">★</span><span class="sr-only"><?= $star ?> out of 5</span></label>
                        <?php endfor; ?>
                    </div>
                    <span class="rating__text" aria-live="polite"></span>
                    <span class="field-error"><?= e($errors['rating'] ?? '') ?></span>
                </fieldset>

                <div class="form-group">
                    <label for="message">Your feedback / আপনার মতামত <span class="required" aria-hidden="true">*</span></label>
                    <textarea class="form-control" id="message" name="message" maxlength="2000" required
                              <?= isset($errors['message']) ? 'aria-invalid="true"' : '' ?>><?= e($old['message']) ?></textarea>
                    <div class="char-count" aria-hidden="true"></div>
                    <span class="field-error"><?= e($errors['message'] ?? '') ?></span>
                </div>

                <button type="submit" class="btn btn--maroon">Submit Feedback / জমা দিন <span aria-hidden="true">→</span></button>
                <p class="field-hint">Fields marked * are required. Your details are used only to review feedback.</p>
            </form>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>