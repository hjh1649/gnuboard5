<?php
include_once('./_common.php');

// 금일 인증시도 회수 체크
certify_count_check($member['mb_id'], 'hp');

include_once('./hpcert.config.php');

/**************************************************************************
okname 실행
**************************************************************************/
$option = "Q";

$cmd = "$exe $svcTxSeqno \"$name\" $birthday $gender $ntvFrnrTpCd $mblTelCmmCd $mbphnNo $rsv1 $rsv2 $rsv3 \"$returnMsg\" $returnUrl $inTpBit $hsCertMsrCd $hsCertRqstCausCd $memId $clientIp $clientDomain $endPointURL $logPath $option";

//cmd 실행
exec($cmd, $out, $ret);

/**************************************************************************
okname 응답 정보
**************************************************************************/
$retcode = "";										// 결과코드
$retmsg = "";										// 결과메시지
$e_rqstData = "";									// 암호화된요청데이터

if ($ret == 0) {//성공일 경우 변수를 결과에서 얻음
    $retcode = $out[0];
    $retmsg  = $out[1];
    $e_rqstData = $out[2];
}
else {
    if($ret <=200)
        $retcode=sprintf("B%03d", $ret);
    else
        $retcode=sprintf("S%03d", $ret);
}

$g5['title'] = 'KCB 휴대폰 본인확인';
include_once(G5_PATH.'/head.sub.php');
?>

<script>
function request(){
    //window.name = "<?php echo $targetId; ?>";

    document.form1.action = "<?php echo $commonSvlUrl; ?>";
    document.form1.method = "post";

    document.form1.submit();
}
</script>

<form name="form1">
<!-- 인증 요청 정보 -->
<!--// 필수 항목 -->
<input type="hidden" name="tc" value="kcb.oknm.online.safehscert.popup.cmd.P901_CertChoiceCmd"> <!-- 변경불가-->
<input type="hidden" name="rqst_data"				value="<?php echo $e_rqstData; ?>">		    <!-- 요청데이터 -->
<input type="hidden" name="target_id"				value="<?php echo $targetId; ?>">		    <!-- 타겟ID -->
<!-- 필수 항목 //-->
</form>

<?php
if ($retcode == "B000") {
    //인증요청
    echo ("<script>request();</script>");
} else {
    //요청 실패 페이지로 리턴
    echo ("<script>alert(\"$retcode\"); self.close();</script>");
}

include_once(G5_PATH.'/tail.sub.php');
?>