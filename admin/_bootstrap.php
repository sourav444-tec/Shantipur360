<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../includes/db.php';
function ae($v): string { return htmlspecialchars((string)$v, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }
function csrf_token(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function csrf_check(): void { if(!hash_equals($_SESSION['csrf']??'',(string)($_POST['csrf']??''))){http_response_code(400);exit('Invalid request token.');} }
function require_admin(): void { if(empty($_SESSION['admin_id'])){header('Location: index.php');exit;} }
function save_image(string $field): ?string {
 if(empty($_FILES[$field]['name'])) return null;
 if($_FILES[$field]['error']!==UPLOAD_ERR_OK) throw new RuntimeException('Photo upload failed.');
 if($_FILES[$field]['size']>8*1024*1024) throw new RuntimeException('Image limit is 8 MB.');
 $mime=(new finfo(FILEINFO_MIME_TYPE))->file($_FILES[$field]['tmp_name']);
 $ext=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'][$mime]??null;
 if(!$ext) throw new RuntimeException('Only JPG, PNG and WEBP images are accepted.');
 $name=bin2hex(random_bytes(16)).'.'.$ext;
 if(!move_uploaded_file($_FILES[$field]['tmp_name'],__DIR__.'/../uploads/'.$name)) throw new RuntimeException('Unable to save image.');
 return 'uploads/'.$name;
}
function remove_image(?string $path): void {
 if($path && preg_match('#^uploads/[a-f0-9]{32}\.(jpg|png|webp)$#',$path)){ $f=__DIR__.'/../'.$path; if(is_file($f)) unlink($f); }
}
