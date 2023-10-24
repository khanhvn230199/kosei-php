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

//require_once(DIR_VENDOR . "/autoload.php");
global $mod;

function default_ggauth()
{
    global $core, $CONFIG, $clsRewrite, $GG_API;
    if ($core->_SESS->isLoggedin()) {
        redirectURL(VNCMS_URL);
    }
    $clsUsers = new Users();
    $oauth_provider = "Google";

    // Call Google API
    $client = new Google_Client();
    $client->setApplicationName('Login to ' . $CONFIG['site_name']);
    $client->setClientId($GG_API['client_id']);
    $client->setClientSecret($GG_API['client_secret']);
    $client->setRedirectUri($clsRewrite->url_ggauth());
    $client->addScope("email");
    $client->addScope("profile");

    $oauth_service = new Google_Service_Oauth2($client);

    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['google_access_token'] = $client->getAccessToken();
    }
    if (isset($_SESSION['google_access_token']) && !empty($_SESSION['google_access_token'])) {
        $client->setAccessToken($_SESSION['google_access_token']);
    }
    if ($client->getAccessToken()) {
        // Get user profile data from google
        $user = $oauth_service->userinfo->get();

        if ($clsUsers->doOauthRegister($user, $oauth_provider) == 1) {
            $core->_SESS->doOauthLogin($user, $oauth_provider);
            header("location:" . VNCMS_URL);
            exit();
        } else {
            echo "Error when registering Google user";
            exit();
        }
    } else {
        // Redirect to login url
        $loginUrl = $client->createAuthUrl();
        header("location:" . filter_var($loginUrl, FILTER_SANITIZE_URL));
        exit();
    }
}
