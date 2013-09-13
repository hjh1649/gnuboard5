<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$delete_str = "";
if ($w == 'x') $delete_str = "댓";
if ($w == 'u') $g5['title'] = $delete_str."글 수정";
else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
else $g5['title'] = $g5['title'];
?>

<link rel="stylesheet" href="<?php echo $member_skin_url ?>/style.css">

<div id="pw_confirm">
    <h1><?php echo $g5['title'] ?></h1>
    <p>
        <?php if ($w == 'u') { ?>
        <strong>작성자만 글을 수정할 수 있습니다.</strong>
        작성자 본인이라면, 글 작성시 입력한 패스워드를 입력하여 글을 수정할 수 있습니다.
        <?php } else if ($w == 'd' || $w == 'x') { ?>
        <strong>작성자만 글을 삭제할 수 있습니다.</strong>
        작성자 본인이라면, 글 작성시 입력한 패스워드를 입력하여 글을 삭제할 수 있습니다.
        <?php } else { ?>
        <strong>비밀글 기능으로 보호된 글입니다.</strong>
        작성자와 관리자만 열람하실 수 있습니다. 본인이라면 패스워드를 입력하세요.
        <?php } ?>
    </p>

    <form name="fboardpassword" action="<?php echo $action; ?>" method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">

    <fieldset>
        <input type="password" name="wr_password" id="pw_wr_password"  placeholder="패스워드(필수)" required class="frm_input required" maxLength="20">
        <input type="submit" class="btn_submit" value="확인">
    </fieldset>
    </form>

    <div class="btn_confirm">
        <a href="<?php echo $return_url ?>">돌아가기</a>
    </div>

</div>
