<?php
    session_start();
    require_once 'config.php';

    $page = page::invoke($_, $auth, $authLoc);
    if ($page['type'] == 'auth' and $page['action'] !== null) {
        if ($page['action'] == 'register') {
            $check = register::invoke($_, $auth, $authLoc);
        } elseif ($page['action'] == 'login') {
            $check = login::invoke($_, $auth, $authLoc);
        } elseif ($page['action'] == 'logout') {
            $check = logout::invoke($_, $auth, $authLoc);
        } elseif ($page['action'] == 'activate') {
            $check = activate::invoke($_, $auth, $authLoc);
        }
    }

    $twigRender = array(
        'siteName'   => $_['site_name'],
        'webRoot'    => $_['web_root'],
        'pageType'   => $page['type'],
        'page'       => $page['page'],
        'action'     => $page['action'],
        'navigation' => array(
            array(
                'name' => 'Home',
                'href' => 'home'
            ),
            array(
                'name' => 'Addons',
                'href' => 'addons'
            ),
            array(
                'name' => 'Authors',
                'href' => 'authors'
            ),
            array(
                'name' => 'Help',
                'href' => 'help'
            ),
            array(
                'name' => 'About',
                'href' => 'about'
            ),
            array(
                'name' => 'Melder',
                'href' => 'melder'
            )
        )
    );

    if ($page['type'] !== 'error') { // Skip a bunch of would-be-wasteful processing if an error page is being returned

        if ($page['type'] == 'auth' and $page['action'] !== null) { // Check if the page/action pairing is valid for auth pages

            $twigRender['authLoc'] = $authLoc;

            if ($page['action'] == 'login' or $page['action'] == 'register'){
                $twigRender['check'] = $check;

                $twigRender['username']['maxlength'] = $auth['validate_username']['max_length'];
                $twigRender['password']['maxlength'] = $auth['validate_password']['max_length'];

                if (isset($_POST['trigger_login']) and $_POST['trigger_login']) {
                    $trigger_login = true;
                } else {
                    $trigger_login = false;
                }

                if (isset($_POST['trigger_register']) and $_POST['trigger_register']) {
                    $trigger_register = true;
                    $twigRender['email']['valid'] = $check['email']['valid'];
                    $twigRender['email']['value'] = $_POST['email'];
                } else {
                    $trigger_register = false;
                }

                if ($trigger_login or $trigger_register) {
                    $twigRender['username']['value'] = $_POST['username'];
                    $twigRender['username']['valid'] = $check['username']['valid'];

                    $twigRender['password']['valid'] = $check['password']['valid'];
                }
            }

            if ($page['action'] == 'login') {
                if (isset($_SESSION['show_valid_register']) and $_SESSION['show_valid_register']) {
                    $twigRender['showValidRegister'] = true;
                    unset($_SESSION['show_valid_register']);
                }
            }

            // TODO: implement a show_captcha variable that is used to check if a captcha should be shown. The value of this variable is set based on the page being rendered, and in the case of login, if it's time to force the captcha
            if (
                $check['captcha']['force'] or
                in_array(
                    $page['action'], array(
                        'register',
                        'activate',
                        'recover'
                    )
                ) /*or
                in_array(
                    $page['page'], array(
                        ''
                    )
                )*/
            ) {
                $twigRender['captcha']['show']   = true;
                $twigRender['captcha']['render'] = auth::getCaptcha($auth, $check, $page);
            }

        }
    }

    if (core::debug($_, '$twigRender contents:')) {
        core::debug($_, $twigRender);
    }

    if ($_['debug']) { // If we're debugging the PHP, cut it short since the template is unnecessary
        die();
    }

    require_once $_['fs_root'].'includes/lib/twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem($_['fs_root'].'includes/templates/');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('framework/base.twig');
    echo $twig->render('framework/base.twig', $twigRender);
