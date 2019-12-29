<?php
$error = false;
$data['snippetsList'] = '';
$data['totalSnippets'] = '';
if (file_exists('../langs/' . $_GET['language'] . '.php')) {
    $lang = $_GET['language'];
} else { // default
    $lang = 'en_EN';
}
require_once '../langs/' . $lang . '.php';
if (!isset($_GET['index']) || !is_numeric($_GET['index'])) {
    $error = true;
    $return_msg = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . WRONG_DATA . '</div>';
} else {
    require_once 'Snippets.php';
    $snippets = new Snippets('snippets.xml', true);
    $snippets->getSnippets();
    $out = $snippets->deleteSnippet($_GET['index']);
    $return_msg = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . SNIPPET_DELETED . '</div>';
}
if ($error == false) {
    $data['snippetsList']  = $snippets->render();
    $data['totalSnippets'] = $snippets->total_snippets;
}
$data['returnMsg'] = $return_msg;
echo json_encode($data);
