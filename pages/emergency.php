<?php
declare(strict_types=1);
$basePath='../';$activePage='emergency';$pageTitle='জরুরি পরিষেবা | Emergency Services – Santipur Rash';$metaDescription='শান্তিপুর রাস উৎসবের জরুরি হেল্পলাইন ও সহায়তা।';
require __DIR__.'/../includes/db.php';$services=[];
try{$q=getDatabaseConnection()->prepare("SELECT * FROM festival_places WHERE is_published=1 AND category='helpline' ORDER BY name");$q->execute();$services=$q->fetchAll();}catch(Throwable $e){error_log($e->getMessage());}
require __DIR__.'/../includes/header.php';require __DIR__.'/../includes/navbar.php';
?>
<section class="page-hero"><div class="container"><p class="breadcrumb"><a href="../index.php">Home</a> › Emergency Services</p><h1>জরুরি পরিষেবা</h1><p lang="en">Emergency Helplines</p></div></section>
<section class="section"><div class="container"><p class="alert alert--error" role="note"><strong>জীবনঘাতী জরুরি অবস্থায় অবিলম্বে সরকারি জরুরি পরিষেবার সঙ্গে যোগাযোগ করুন।</strong><br>In a life-threatening emergency, contact official emergency services immediately.</p>
<?php if(!$services):?><p class="placeholder-note">প্রশাসন কর্তৃক যাচাইকৃত হেল্পলাইন নম্বর যোগ করা হলে এখানে দেখা যাবে।</p><?php endif;?>
<div class="grid grid--3"><?php foreach($services as $service):?><article class="info-card"><div class="info-card__icon">🆘</div><h2><?=e($service['name'])?></h2><p><?=nl2br(e($service['description']??''))?></p><?php if($service['address']):?><p>📍 <?=e($service['address'])?></p><?php endif;?><?php if($service['phone']):?><a class="tel-link" href="tel:<?=e(preg_replace('/[^0-9+]/','',$service['phone']))?>">📞 <?=e($service['phone'])?></a><?php endif;?></article><?php endforeach;?></div>
<p class="text-center mt-2"><a class="btn btn--navy" href="route-map.php">View Route Map →</a> <a class="btn btn--maroon" href="directory.php">Full Festival Directory →</a></p></div></section>
<?php require __DIR__.'/../includes/footer.php'; ?>
