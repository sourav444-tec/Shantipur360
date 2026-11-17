<?php
declare(strict_types=1);
$basePath='../';$activePage='route';$pageTitle='রুটম্যাপ | Festival Map – Santipur360';
$metaDescription='শান্তিপুর রাস উৎসবের প্যান্ডেল, বিগ্রহ বাড়ি, পরিবহন ও জরুরি পরিষেবার মানচিত্র।';
require __DIR__.'/../includes/db.php';
$places=[];
try{$places=getDatabaseConnection()->query("SELECT id,name,category,description,address,phone,latitude,longitude FROM festival_places WHERE is_published=1 ORDER BY category,name")->fetchAll();}catch(Throwable $e){error_log('[Santipur360] Map data unavailable: '.$e->getMessage());}
require __DIR__.'/../includes/header.php';require __DIR__.'/../includes/navbar.php';
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<style>
.map-layout{display:grid;grid-template-columns:minmax(0,1fr) 300px;gap:18px;align-items:start}.festival-map{height: min(72vh,760px);min-height:420px;width:100%;border-radius:14px;z-index:1}.map-panel{background:#fff;border:1px solid #e5dfd4;border-radius:12px;padding:16px}.map-list{max-height:65vh;overflow:auto}.map-place{padding:10px 0;border-bottom:1px solid #eee}.map-place button{background:none;border:0;color:#17345f;text-align:left;padding:0;cursor:pointer;font:inherit;font-weight:700}.map-fullscreen{position:absolute;right:14px;top:14px;z-index:500;background:#fff;border:1px solid #aaa;border-radius:6px;padding:9px 12px;cursor:pointer;box-shadow:0 1px 5px #0003}.map-wrap{position:relative}.map-wrap:fullscreen{background:#fff;padding:12px;display:flex;flex-direction:column}.map-wrap:fullscreen #festival-map{height:calc(100vh - 70px);max-height:none}.map-wrap:fullscreen .map-fullscreen{top:20px;right:20px}@media(max-width:800px){.map-layout{grid-template-columns:1fr}.festival-map{height:62vh;min-height:380px}.map-list{max-height:260px}}
</style>
<section class="page-hero"><div class="container"><p class="breadcrumb"><a href="../index.php">Home</a> › Route Map</p><h1>উৎসব এলাকার মানচিত্র</h1><p lang="en">Festival Map & Directory</p></div></section>
<section class="section"><div class="container"><div class="section-title"><h2>প্যান্ডেল, বিগ্রহ বাড়ি ও জরুরি পরিষেবা</h2><p class="section-title__en">Explore places pinned by the administrator</p></div>
<div class="map-layout"><div class="map-wrap" id="map-wrap"><button class="map-fullscreen" type="button" id="map-fullscreen">⛶ Full screen</button><div id="festival-map" class="festival-map" role="application" aria-label="Interactive map of Santipur festival places"></div></div>
<aside class="map-panel"><h3>স্থানসমূহ / Places</h3><p class="field-hint">Select a place to focus its map pin.</p><div class="map-list" id="map-list"><?php if(!$places):?><p>এখনও কোনো স্থান যোগ করা হয়নি। Admin dashboard থেকে latitude ও longitude দিয়ে স্থান যোগ করুন।</p><?php else:foreach($places as $place):?><div class="map-place"><button type="button" data-place-id="<?=e((string)$place['id'])?>"><?=e($place['name'])?></button><div><?=e(ucwords(str_replace('_',' ',$place['category'])))?><?php if($place['phone']):?> · <a href="tel:<?=e(preg_replace('/[^0-9+]/','',$place['phone']))?>"><?=e($place['phone'])?></a><?php endif;?></div></div><?php endforeach;endif;?></div><p><a class="btn btn--maroon" href="emergency.php">Emergency services →</a></p></aside></div>
</div></section>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function(){
 const places=<?=json_encode(array_map(static fn($r)=>['id'=>(int)$r['id'],'name'=>$r['name'],'category'=>$r['category'],'description'=>$r['description'],'address'=>$r['address'],'phone'=>$r['phone'],'lat'=>(float)$r['latitude'],'lng'=>(float)$r['longitude']],$places),JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_QUOT)?>;
 const map=L.map('festival-map',{scrollWheelZoom:true}).setView([23.25,88.43],14);
 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19,attribution:'&copy; OpenStreetMap contributors'}).addTo(map);
 const markers={};
 places.forEach(p=>{const marker=L.marker([p.lat,p.lng]).addTo(map);let html='<strong>'+escapeHtml(p.name)+'</strong><br>'+escapeHtml(p.category);
 if(p.address)html+='<br>'+escapeHtml(p.address);if(p.description)html+='<p>'+escapeHtml(p.description)+'</p>';if(p.phone)html+='<a href="tel:'+encodeURIComponent(p.phone)+'">'+escapeHtml(p.phone)+'</a>';marker.bindPopup(html);markers[p.id]=marker;});
 if(places.length===1)map.setView([places[0].lat,places[0].lng],16);else if(places.length>1)map.fitBounds(L.featureGroup(Object.values(markers)).getBounds().pad(.15));
 document.querySelectorAll('[data-place-id]').forEach(b=>b.addEventListener('click',()=>{const m=markers[b.dataset.placeId];if(m){map.setView(m.getLatLng(),17);m.openPopup();}}));
 function escapeHtml(v){return String(v??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[c]));}
 const wrap=document.getElementById('map-wrap'),btn=document.getElementById('map-fullscreen');
 btn.addEventListener('click',async()=>{try{if(!document.fullscreenElement){await wrap.requestFullscreen();btn.textContent='✕ Exit full screen';}else{await document.exitFullscreen();}}catch(e){btn.textContent='Full screen unavailable';}setTimeout(()=>map.invalidateSize(),200);});
 document.addEventListener('fullscreenchange',()=>{btn.textContent=document.fullscreenElement?'✕ Exit full screen':'⛶ Full screen';setTimeout(()=>map.invalidateSize(),200);});
 window.addEventListener('resize',()=>map.invalidateSize());
})();
</script>
<?php require __DIR__.'/../includes/footer.php'; ?>
