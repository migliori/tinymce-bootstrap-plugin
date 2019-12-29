<?php
$error = false;
$data['snippetsList'] = '';
$data['totalSnippets'] = '';
$data['returnMsg'] = '';
$data['returnDangerMsg'] = '';
if (file_exists('../langs/' . $_POST['language'] . '.php')) {
    $lang = $_POST['language'];
} else { // default
    $lang = 'en_EN';
}
require_once '../langs/' . $lang . '.php';
require_once 'Snippets.php';
$snippets = new Snippets('snippets.xml', true);
$snippets->getSnippets();
if (!isset($_POST['title']) || !isset($_POST['code']) || !preg_match('`[a-zA-Z0-9_ -]{1,150}`', $_POST['title'])) {
    $error = true;
    if (!preg_match('`[a-zA-Z0-9_ -]{1,150}`', $_POST['title'])) {
        $return_msg = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . TITLE_MUST_MATCH . '</div>';
    } else {
        $return_msg = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . WRONG_DATA . '</div>';
    }
} else {
    $out = $snippets->addNewSnippet(utf8_decode(urldecode($_POST['title'])), utf8_decode(urldecode($_POST['code'])));
    $return_msg = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . SNIPPET_ADDED . '</div>';
    $return_danger_msg = '';
    if ($out === 'script_forbidden') {
        $return_danger_msg = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . SCRIPT_FORBIDDEN . '</div>';
    } elseif ($out === 'php_forbidden') {
        $return_danger_msg = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . PHP_FORBIDDEN . '</div>';
    }
}
// if ($error == false) {
    $data['snippetsList']  = $snippets->render();
    $data['totalSnippets'] = $snippets->total_snippets;
// }
$data['returnMsg'] = $return_msg;
$data['returnDangerMsg'] = $return_danger_msg;
echo json_encode($data);
