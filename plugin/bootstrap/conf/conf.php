<?php

/* =============================================
Paths definitions for libraries (css & js files)

You can use :
    -   absolute                                     example : http://www.domain.comassets/
    -   relative absolute                            example : /assets/
    -   relative from tinymce/plugins/bootstrap/     example : ../../../assets/
============================================= */

define('JQUERY_JS', 'js/jquery-2.1.1.min.js');
define('BOOTSTRAP_JS', 'js/bootstrap.min.js');

// prism is required for all plugins
// codemirror is required for snippets tool, for syntax highlighting in textarea (cannot be done with prism unfortunately)
define('CODEMIRROR_FOLDER', 'codemirror/');
define('PRISM_CSS', 'prism/prism.min.css');
define('PRISM_JS', 'prism/prism.min.js');

$bootstrap_css_path = addslashes($_GET['bootstrap_css_path']);
function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];

    return $protocol.$domainName;
}
define('SITE_URL', siteURL());

/* language */

if (file_exists('langs/' . $_GET['language'] . '.php')) {
    require_once 'langs/' . $_GET['language'] . '.php';
} else { // default
    require_once 'langs/en_EN.php';
}