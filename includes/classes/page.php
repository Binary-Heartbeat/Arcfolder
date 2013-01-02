<?php
    class page
    {
        public static function invoke($_, $auth, $authLoc)
        {
            if (isset($_GET['page'])) {
                $page['page']    = $_GET['page'];
                $page['pages']   = array('auth', 'home', 'addons', 'authors', 'help', 'about', 'melder');
                $page['actions'] = array('activate', 'register', 'login', 'logout');

                if (isset($_GET['action'])) {
                    $page['action'] = $_GET['action'];
                } else {
                    $page['action'] = null;
                }

                if (!in_array($page['page'], $page['pages'])) {
                    $page['page'] = '404';
                    $page['type'] = 'error';
                } elseif ($page['page'] == 'auth') {
                    if (!in_array($page['action'], $page['actions']) or $page['action'] == null) {
                        $page['type'] = 'error';
                        $page['page'] = '404';
                    } else {
                        $page['type'] = 'auth';
                    }

                } else {
                    $page['type'] = 'page';
                }

            } else {
                header('Location: '.$_['web_root'].'home');
            }

            // new dBug( $page ); die();

            return $page;
        }
    }
