<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<link rel="stylesheet" href="<?php echo $member_skin_url ?>/style.css">

<div id="profile" class="new_win">
    <h1><?php echo $mb_nick ?>님의 프로필</h1>

    <table class="frm_tbl">
    <tbody>
    <tr>
        <th scope="row">회원권한</th>
        <td><?php echo $mb['mb_level'] ?></td>
    </tr>
    <tr>
        <th scope="row">포인트</th>
        <td><?php echo number_format($mb['mb_point']) ?></td>
    </tr>
    <?php if ($mb_homepage) { ?>
    <tr>
        <th scope="row">홈페이지</th>
        <td><a href="<?php echo $mb_homepage ?>" target="_blank"><?php echo $mb_homepage ?></a></td>
    </tr>
    <?php } ?>
    <tr>
        <th scope="row">회원가입일</th>
        <td><?php echo ($member['mb_level'] >= $mb['mb_level']) ?  substr($mb['mb_datetime'],0,10) ." (".number_format($mb_reg_after)." 일)" : "알 수 없음"; ?></td>
    </tr>
    <tr>
        <th scope="row">최종접속일</th>
        <td><?php echo ($member['mb_level'] >= $mb['mb_level']) ? $mb['mb_today_login'] : "알 수 없음"; ?></td>
    </tr>
    </tbody>
    </table>

    <section>
        <h2>인사말</h2>
        <p><?php echo $mb_profile ?></p>
    </section>

    <div class="btn_win">
        <button type="button" onclick="window.close();">창닫기</button>
    </div>
</div>
