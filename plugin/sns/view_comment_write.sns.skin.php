<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!$board['bo_use_sns']) return;
?>
<tr>
    <th scope="row">SNS 동시등록</th>
    <td>
        <ul id="bo_vc_sns">
        <?php
        //============================================================================
        // 페이스북
        //----------------------------------------------------------------------------
        if ($config['cf_facebook_appid']) {
            $facebook_user = get_session("ss_facebook_user");
            if (!$facebook_user) {
                include_once(G5_SNS_PATH."/facebook/src/facebook.php");
                $facebook = new Facebook(array(
                    'appId'  => $config['cf_facebook_appid'],
                    'secret' => $config['cf_facebook_secret']
                ));

                $facebook_user = $facebook->getUser();

                if ($facebook_user) {
                    try {
                        $facebook_user_profile = $facebook->api('/me');
                    } catch (FacebookApiException $e) {
                        error_log($e);
                        $facebook_user = null;
                    }
                }
            }

            echo '<li>';
            if ($facebook_user) {
                echo '<img src="'.G5_SNS_URL.'/icon/facebook.png" id="facebook_icon">';
                echo '<label for="" class="sound_only">페이스북 동시 등록</label>';
                echo '<input type="checkbox" name="facebook_checked" id="facebook_checked" '.(get_cookie('ck_facebook_checked')?'checked':'').' value="1">';
            } else {
                $facebook_url = $facebook->getLoginUrl(array("redirect_uri"=>G5_SNS_URL."/facebook/callback.php", "scope"=>"publish_stream,read_stream,offline_access", "display"=>"popup"));

                echo '<a href="'.$facebook_url.'" id="facebook_url" onclick="return false;"><img src="'.G5_SNS_URL.'/icon/facebook'.($facebook_user?'':'_off').'.png" id="facebook_icon"></a>';
                echo '<label for="" class="sound_only">페이스북 동시 등록</label>';
                echo '<input type="checkbox" name="facebook_checked" id="facebook_checked" disabled value="1">';
                echo '<script>$(function(){ $("#facebook_url").click(function(){ window.open(this.href, "facebook_url", "width=600,height=250"); }); });</script>';
            }
            echo '</li>';
        }
        //============================================================================


        //============================================================================
        // 트위터
        //----------------------------------------------------------------------------
        if ($config['cf_twitter_key']) {
            $twitter_user = get_session("ss_twitter_user");
            if (!$twitter_user) {
                include_once(G5_SNS_PATH."/twitter/twitteroauth/twitteroauth.php");
                include_once(G5_SNS_PATH."/twitter/twitterconfig.php");

                $twitter_user = false;
                /*
                if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
                    $twitter_url = G5_SNS_URL."/twitter/redirect.php";
                } else {
                    $access_token = $_SESSION['access_token']; 
                    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                    $content = $connection->get('account/verify_credentials');

                    switch ($connection->http_code) {
                        case 200:
                            $twitter_user = true;
                            $twitter_url = $connection->getAuthorizeURL($token);
                            break;
                        default : 
                            $twitter_url = G5_SNS_URL."/twitter/redirect.php";
                    }
                }
                */
                $access_token = $_SESSION['access_token']; 
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $content = $connection->get('account/verify_credentials');

                switch ($connection->http_code) {
                    case 200:
                        $twitter_user = true;
                        $twitter_url = $connection->getAuthorizeURL($token);
                        break;
                    default : 
                        $twitter_url = G5_SNS_URL."/twitter/redirect.php";
                }
            }

            echo '<li>';
            if ($twitter_user) {
                echo '<img src="'.G5_SNS_URL.'/icon/twitter.png" id="twitter_icon">';
                echo '<label for="" class="sound_only">트위터 동시 등록</label>';
                echo '<input type="checkbox" name="twitter_checked" id="twitter_checked" '.(get_cookie('ck_twitter_checked')?'checked':'').' value="1">';
            } else {
                echo '<a href="'.$twitter_url.'" id="twitter_url" onclick="return false;"><img src="'.G5_SNS_URL.'/icon/twitter'.($twitter_user?'':'_off').'.png" id="twitter_icon"></a>';
                echo '<label for="" class="sound_only">트위터 동시 등록</label>';
                echo '<input type="checkbox" name="twitter_checked" id="twitter_checked" disabled value="1">';
                echo '<script>$(function(){ $("#twitter_url").click(function(){ window.open(this.href, "twitter_url", "width=600,height=250"); }); });</script>';
            }
            echo '</li>';
        }
        //============================================================================


        //============================================================================
        // 미투데이
        //----------------------------------------------------------------------------
        if ($config['cf_me2day_key']) {
            /*
            $me2day_user = false;
            if (empty($_SESSION['me2day']['user_id']) || empty($_SESSION['me2day']['user_key'])) {
                $result = json_decode(file_get_contents("http://me2day.net/api/get_auth_url.json?akey=".$config['cf_me2day_key']));
                $me2day_url = $result->url;
            } else {
                $me2day_user = true;
            }
            */

            $me2day_user = get_session("ss_me2day_user");
            if (!$me2day_user) {
                $result = json_decode(file_get_contents("http://me2day.net/api/get_auth_url.json?akey=".$config['cf_me2day_key']));
                $me2day_url = $result->url;
            }

            echo '<li>';
            if ($me2day_user) {
                echo '<img src="'.G5_SNS_URL.'/icon/me2day.png" id="me2day_icon">';
                echo '<label for="" class="sound_only">미투데이 동시 등록</label>';
                echo '<input type="checkbox" name="me2day_checked" id="me2day_checked" '.(get_cookie('ck_me2day_checked')?'checked':'').' value="1">';
            } else {
                echo '<a href="'.$me2day_url.'" id="me2day_url" onclick="return false;"><img src="'.G5_SNS_URL.'/icon/me2day'.($me2day_user?'':'_off').'.png" id="me2day_icon"></a>';
                echo '<label for="" class="sound_only">미투데이 동시 등록</label>';
                echo '<input type="checkbox" name="me2day_checked" id="me2day_checked" disabled value="1">';
                echo '<script>$(function(){ $("#me2day_url").click(function(){ window.open(this.href, "me2day_url", "width=1000,height=800"); }); });</script>';
            }
            echo '</li>';
        }
        //============================================================================
        ?>
        </ul>
    </td>
</tr>
