<?php
require __DIR__.'/_bootstrap.php';
$pdo=getDatabaseConnection(); $count=(int)$pdo->query('SELECT COUNT(*) FROM admins')->fetchColumn();
$error='';$notice='';
if(isset($_GET['logout'])){session_destroy();header('Location: index.php');exit;}
if($_SERVER['REQUEST_METHOD']==='POST'){
 try{
  csrf_check();$action=$_POST['action']??'';
  if($action==='setup' && $count===0){
   $u=trim((string)($_POST['username']??''));$pw=(string)($_POST['password']??'');
   if(!preg_match('/^[a-zA-Z0-9_.-]{4,80}$/',$u)||strlen($pw)<12)throw new RuntimeException('Use a 4+ character username and password with at least 12 characters.');
   $q=$pdo->prepare('INSERT INTO admins(username,password_hash) VALUES(?,?)');$q->execute([$u,password_hash($pw,PASSWORD_DEFAULT)]);
   $_SESSION['admin_id']=$pdo->lastInsertId();$_SESSION['admin_username']=$u;header('Location: index.php');exit;
  }
  if($action==='login'){
   $q=$pdo->prepare('SELECT * FROM admins WHERE username=?');$q->execute([trim((string)$_POST['username'])]);$a=$q->fetch();
   if(!$a||!password_verify((string)$_POST['password'],$a['password_hash']))throw new RuntimeException('Incorrect username or password.');
   session_regenerate_id(true);$_SESSION['admin_id']=$a['id'];$_SESSION['admin_username']=$a['username'];header('Location: index.php');exit;
  }
  require_admin();
  if($action==='save_place'){
   $id=(int)($_POST['id']??0);$name=trim((string)$_POST['name']);$cat=(string)$_POST['category'];
   $lat=filter_var($_POST['latitude'],FILTER_VALIDATE_FLOAT);$lng=filter_var($_POST['longitude'],FILTER_VALIDATE_FLOAT);
   if($name===''||!in_array($cat,['pandal','bigraha','transport','helpline','other'],true)||$lat===false||$lng===false||$lat < -90||$lat>90||$lng < -180||$lng>180)throw new RuntimeException('Please enter a name, valid category and valid latitude/longitude.');
   $img=save_image('photo');
   $vals=[$name,$cat,trim((string)$_POST['description']),trim((string)$_POST['address']),trim((string)$_POST['phone']),$lat,$lng];
   if($id){$q=$pdo->prepare('SELECT image FROM festival_places WHERE id=?');$q->execute([$id]);$old=$q->fetchColumn();$image=$img?:$old;
    $q=$pdo->prepare('UPDATE festival_places SET name=?,category=?,description=?,address=?,phone=?,latitude=?,longitude=?,image=?,is_published=? WHERE id=?');$q->execute([...$vals,$image,isset($_POST['is_published'])?1:0,$id]);if($img)remove_image($old?:null);
   }else{$q=$pdo->prepare('INSERT INTO festival_places(name,category,description,address,phone,latitude,longitude,image,is_published) VALUES(?,?,?,?,?,?,?,?,?)');$q->execute([...$vals,$img,isset($_POST['is_published'])?1:0]);}
   $notice='Directory item saved.';
  }elseif($action==='delete_place'){
   $q=$pdo->prepare('SELECT image FROM festival_places WHERE id=?');$q->execute([(int)$_POST['id']]);$old=$q->fetchColumn();$pdo->prepare('DELETE FROM festival_places WHERE id=?')->execute([(int)$_POST['id']]);remove_image($old?:null);$notice='Place deleted.';
  }elseif($action==='add_gallery'){
   $img=save_image('photo');if(!$img)throw new RuntimeException('Choose a photo first.');$q=$pdo->prepare('INSERT INTO gallery(title,caption,image) VALUES(?,?,?)');$q->execute([trim((string)$_POST['title'])?:'Festival photo',trim((string)$_POST['caption']),$img]);$notice='Photo uploaded.';
  }elseif($action==='delete_gallery'){
   $q=$pdo->prepare('SELECT image FROM gallery WHERE id=?');$q->execute([(int)$_POST['id']]);$old=$q->fetchColumn();$pdo->prepare('DELETE FROM gallery WHERE id=?')->execute([(int)$_POST['id']]);remove_image($old?:null);$notice='Photo deleted.';
  }elseif($action==='delete_feedback'){
   $pdo->prepare('DELETE FROM feedback WHERE id=?')->execute([(int)$_POST['id']]);$notice='Feedback deleted.';
  }
 }catch(Throwable $e){$error=$e instanceof PDOException?'Database error. Check the SQL import and connection settings.':$e->getMessage();}
}
function page_head($title){echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.ae($title).'</title><link rel="stylesheet" href="admin.css"></head><body>';}
if($count===0){page_head('Create first admin');?><main class="auth"><h1>First-time admin setup</h1><p>Create the first administrator account. This setup form is disabled after account creation.</p><?php if($error):?><p class="error"><?=ae($error)?></p><?php endif;?><form method="post"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="setup"><label>Username<input name="username" required minlength="4"></label><label>Password (12+ characters)<input type="password" name="password" required minlength="12"></label><button>Create admin account</button></form></main></body></html><?php exit;}
if(empty($_SESSION['admin_id'])){page_head('Admin login');?><main class="auth"><h1>Santipur360 Admin</h1><p>Login to manage places, photos and visitor feedback.</p><?php if($error):?><p class="error"><?=ae($error)?></p><?php endif;?><form method="post"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="login"><label>Username<input name="username" required autocomplete="username"></label><label>Password<input type="password" name="password" required autocomplete="current-password"></label><button>Login</button></form><a href="../index.php">Back to website</a></main></body></html><?php exit;}
$edit=null;if(isset($_GET['edit'])){$q=$pdo->prepare('SELECT * FROM festival_places WHERE id=?');$q->execute([(int)$_GET['edit']]);$edit=$q->fetch();}
$places=$pdo->query('SELECT * FROM festival_places ORDER BY id DESC')->fetchAll();$photos=$pdo->query('SELECT * FROM gallery ORDER BY id DESC')->fetchAll();$feedback=$pdo->query('SELECT * FROM feedback ORDER BY created_at DESC')->fetchAll();
page_head('Admin dashboard');?>
<header class="top"><b>Santipur360 · Admin</b><span><?=ae($_SESSION['admin_username'])?> · <a href="?logout=1">Logout</a></span></header><main class="wrap">
<?php if($error):?><p class="error"><?=ae($error)?></p><?php endif;?><?php if($notice):?><p class="success"><?=ae($notice)?></p><?php endif;?>
<nav class="tabs"><a href="#places">Places & map pins</a><a href="#gallery">Photos</a><a href="#feedback">Feedback</a></nav>
<section class="panel" id="places"><h2><?= $edit?'Edit place':'Add puja/pandal, bigraha house, transport or helpline'?></h2><p>Enter accurate latitude and longitude. Published records appear on the public map.</p>
<form class="grid" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="save_place"><input type="hidden" name="id" value="<?=ae($edit['id']??'')?>"><label>Name *<input name="name" required value="<?=ae($edit['name']??'')?>"></label><label>Category<select name="category"><?php foreach(['pandal'=>'Puja / Pandal','bigraha'=>'Bigraha house','transport'=>'Transport','helpline'=>'Helpline','other'=>'Other'] as $k=>$v):?><option value="<?=$k?>" <?=($edit['category']??'other')===$k?'selected':''?>><?=$v?></option><?php endforeach;?></select></label><label>Latitude *<input type="number" step="any" name="latitude" required value="<?=ae($edit['latitude']??'23.25')?>"></label><label>Longitude *<input type="number" step="any" name="longitude" required value="<?=ae($edit['longitude']??'88.43')?>"></label><label>Address<input name="address" value="<?=ae($edit['address']??'')?>"></label><label>Phone<input name="phone" value="<?=ae($edit['phone']??'')?>"></label><label class="wide">Description<textarea name="description" rows="3"><?=ae($edit['description']??'')?></textarea></label><label>Photo (JPG/PNG/WEBP, max 8MB)<input type="file" name="photo" accept="image/jpeg,image/png,image/webp"></label><label class="check"><input type="checkbox" name="is_published" <?=(!$edit||!empty($edit['is_published']))?'checked':''?>> Publish on website</label><div class="wide"><button>Save place</button> <?php if($edit):?><a href="index.php#places">Cancel</a><?php endif;?></div></form>
<div class="table-wrap"><table><tr><th>Name</th><th>Category</th><th>Lat, Long</th><th>Published</th><th>Action</th></tr><?php foreach($places as $r):?><tr><td><?=ae($r['name'])?></td><td><?=ae($r['category'])?></td><td><?=ae($r['latitude'])?>, <?=ae($r['longitude'])?></td><td><?=$r['is_published']?'Yes':'No'?></td><td><a href="?edit=<?=$r['id']?>#places">Edit</a> <form class="inline" method="post" onsubmit="return confirm('Delete this record?')"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="delete_place"><input type="hidden" name="id" value="<?=$r['id']?>"><button class="danger">Delete</button></form></td></tr><?php endforeach;?></table></div></section>
<section class="panel" id="gallery"><h2>Upload photos / screenshots</h2><form class="grid" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="add_gallery"><label>Title<input name="title"></label><label>Caption<input name="caption"></label><label>Photo *<input type="file" name="photo" required accept="image/jpeg,image/png,image/webp"></label><div><button>Upload</button></div></form><div class="photos"><?php foreach($photos as $g):?><article><img src="../<?=ae($g['image'])?>" alt=""><b><?=ae($g['title'])?></b><p><?=ae($g['caption'])?></p><form method="post" onsubmit="return confirm('Delete photo?')"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="delete_gallery"><input type="hidden" name="id" value="<?=$g['id']?>"><button class="danger">Delete</button></form></article><?php endforeach;?></div></section>
<section class="panel" id="feedback"><h2>Visitor feedback (<?=count($feedback)?>)</h2><?php if(!$feedback):?><p>No feedback received yet.</p><?php endif;?><?php foreach($feedback as $f):?><article class="feedback"><b><?=ae($f['visitor_name'])?></b> · <?=ae($f['email'])?> · <?=ae($f['phone'])?><span class="muted"><?=ae($f['created_at'])?> · <?=ae($f['category'])?> · <?=str_repeat('★',(int)$f['rating'])?></span><p><?=nl2br(ae($f['message']))?></p><form method="post" onsubmit="return confirm('Permanently delete this feedback?')"><input type="hidden" name="csrf" value="<?=ae(csrf_token())?>"><input type="hidden" name="action" value="delete_feedback"><input type="hidden" name="id" value="<?=$f['id']?>"><button class="danger">Delete feedback</button></form></article><?php endforeach;?></section>
</main></body></html>
