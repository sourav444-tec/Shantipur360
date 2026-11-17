<?php
declare(strict_types=1);
$basePath='../';$activePage='directory';$pageTitle='উৎসব ডিরেক্টরি | Santipur360';$metaDescription='প্যান্ডেল, বিগ্রহ বাড়ি, পরিবহন ও হেল্পলাইন তথ্য।';
require __DIR__.'/../includes/db.php';$items=[];
try{$items=getDatabaseConnection()->query("SELECT * FROM festival_places WHERE is_published=1 ORDER BY FIELD(category,'pandal','bigraha','transport','helpline','other'),name")->fetchAll();}catch(Throwable $e){error_log($e->getMessage());}
require __DIR__.'/../includes/header.php';require __DIR__.'/../includes/navbar.php';
$labels=['pandal'=>'পূজা ও প্যান্ডেল','bigraha'=>'বিগ্রহ বাড়ি','transport'=>'পরিবহন','helpline'=>'হেল্পলাইন','other'=>'অন্যান্য'];
?>
<section class="page-hero"><div class="container"><p class="breadcrumb"><a href="../index.php">Home</a> › Directory</p><h1>রাস উৎসব ডিরেক্টরি</h1><p>প্যান্ডেল, বিগ্রহ বাড়ি, পরিবহন ও জরুরি সহায়তা</p></div></section>
<section class="section"><div class="container"><?php if(!$items):?><p class="placeholder-note">তথ্য যোগ করা হলে এখানে দেখা যাবে।</p><?php endif;?>
<?php foreach($labels as $cat=>$label):$group=array_filter($items,fn($x)=>$x['category']===$cat);if(!$group)continue;?>
<h2><?=e($label)?></h2><div class="grid grid--3"><?php foreach($group as $item):?><article class="info-card"><?php if($item['image']):?><img src="../<?=e($item['image'])?>" alt="<?=e($item['name'])?>" loading="lazy"><?php endif;?><h3><?=e($item['name'])?></h3><p><?=nl2br(e($item['description']??''))?></p><?php if($item['address']):?><p>📍 <?=e($item['address'])?></p><?php endif;?><?php if($item['phone']):?><a href="tel:<?=e(preg_replace('/[^0-9+]/','',$item['phone']))?>">☎ <?=e($item['phone'])?></a><?php endif;?><p><a href="route-map.php">View map pin →</a></p></article><?php endforeach;?></div><?php endforeach;?>
</div></section><?php require __DIR__.'/../includes/footer.php'; ?>
