<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=fblogin
 * Display Home Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
global $mod;
//require_once(DIR_VENDOR . "/autoload.php");

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;


function default_fbauth()
{
    global $core, $clsRewrite, $FB_APP;

    if ($core->_SESS->isLoggedin()) {
        redirectURL(VNCMS_URL);
    }

    $clsUsers = new Users();
    $oauth_provider = "Facebook";

    // Call Facebook API
    $fb = new Facebook([
        'app_id' => $FB_APP['appId'],
        'app_secret' => $FB_APP['secret'],
        'default_graph_version' => $FB_APP['version']
    ]);
    // Get redirect login helper
    $helper = $fb->getRedirectLoginHelper();

    if (isset($_GET['state'])) {
        $helper->getPersistentDataHandler()->set('state', $_GET['state']);
    }

    // Try to get access token
    try {
        if (isset($_SESSION['facebook_access_token']) && !empty($_SESSION['facebook_access_token'])) {
            $accessToken = $_SESSION['facebook_access_token'];
        } else {
            $accessToken = $helper->getAccessToken();
        }
    } catch (FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    // if isset accessToken go to login
    if (isset($accessToken)) {
        if (isset($_SESSION['facebook_access_token']) && !empty($_SESSION['facebook_access_token'])) {
            echo 'abc';
            die();
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        } else {
            // Put short-lived access token in session
            $_SESSION['facebook_access_token'] = (string)$accessToken;
            // OAuth 2.0 client handler helps to manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();
            // Exchanges a short-lived access token for a long-lived one
            $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
            $_SESSION['facebook_access_token'] = (string)$longLivedAccessToken;
            // Set default access token to be used in script
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }
        // Redirect the user back to the same page if url has "code" parameter in query string
        if (isset($_GET['code'])) {
            header("location:" . VNCMS_URL);
        }
        // Getting user's profile info from Facebook
        try {
            $graphResponse = $fb->get('/me?fields=id,name,first_name,last_name,email,link,gender,picture');
            $user = $graphResponse->getGraphUser();
            //Register FB user
            if ($clsUsers->doOauthRegister($user, $oauth_provider) == 1) {
                $core->_SESS->doOauthLogin($user, $oauth_provider);
                header("location:" . VNCMS_URL);
                exit();
            } else {
                echo "Error when registering FB user";
                exit();
            }
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            $core->_SESS->doLogout();
            header("location:" . VNCMS_URL);
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    } else {
        // Redirect to login url
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl($clsRewrite->url_fbauth(), $permissions);
        header("location:$loginUrl");
        exit();
    }
}
