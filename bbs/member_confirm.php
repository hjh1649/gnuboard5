<?php
include_once('./_common.php');

if ($is_guest)
    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

/*
if ($url)
    $urlencode = urlencode($url);
else
    $urlencode = urlencode($_SERVER[REQUEST_URI]);
*/

$g5['title'] = '회원 패스워드 확인';
include_once('./_head.sub.php');

include_once($member_skin_path.'/member_confirm.skin.php');

include_once('./_tail.sub.php');
?>
