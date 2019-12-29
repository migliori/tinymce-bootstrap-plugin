<?php @session_start();
$allowEdit = addslashes($_GET['allowEdit']);
include_once('conf/conf.php');
require_once 'snippets/Snippets.php';
$snippets = new Snippets('snippets/snippets.xml', $allowEdit);
$snippets->getSnippets();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="<?php echo $bootstrap_css_path; ?>">
    <link rel="stylesheet" href="css/plugin.min.css">
    <link rel="stylesheet" href="<?php echo CODEMIRROR_FOLDER; ?>lib/codemirror.css">
    <link href="<?php echo PRISM_CSS; ?>" type="text/css" rel="stylesheet" />
    <style type="text/css">
        .CodeMirror {border: 1px solid #ccc;}
    </style>
</head>
<body>
    <div class="container">
        <div id="ajax-msg"></div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo SNIPPETS; ?></span>
            </div>
            <div id="snippets-list" class="col-xs-12">
                <?php echo $snippets->render(); ?>
            </div>
        </div>
<?php
if ($allowEdit == 'true') { ?>
            <div class="row margin-bottom-md" id="new-snippet-form-wrapper">
                <div class="choice-title">
                    <span><?php echo ADD_NEW_SNIPPET; ?></span>
                </div>
                <div class="form-horizontal col-sm-8 col-sm-offset-2">
                    <div id="end-edit-warning"></div>
                    <form name="new-snippet-form" id="new-snippet-form" action="" novalidate>
                        <div class="form-group">
                            <label class="col-sm-4 col-xs-6 text-right"><?php echo TITLE; ?> :</label>
                            <div class="col-sm-8 col-xs-6">
                                <input type="text" class="form-control" id="new-snippet-title" name="new-snippet-title" value="" required="required" pattern="[a-zA-Z0-9_ -]{1,150}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 col-xs-6 text-right"><?php echo CODE; ?> :</label>
                            <div class="col-sm-8 col-xs-6">
                                <textarea class="form-control" id="new-snippet-code" name="new-snippet-code" required="required" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-xs-6 col-sm-offset-4 col-xs-offset-6">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary" id="new-snippet-ok-button"><?php echo OK; ?></button>
                                    <button type="button" class="btn btn-default" id="new-snippet-cancel-button"><?php echo CANCEL; ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    <?php
} // end $allowEdit ?>
        <div class="row" id="preview">
            <div id="preview-title" class="margin-bottom-md">
                <span class="label-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 margin-bottom-md text-center test-snippet-wrapper" id="test-wrapper">
            </div>
        </div>
        <div class="row">
            <div id="code-title">
                <a href="#" id="code-slide-link"><?php echo CODE; ?> <i class="glyphicon glyphicon-arrow-up"></i></a>
<?php
if ($allowEdit == 'true') { ?>
                <a href="#" id="edit-snippet-button" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="<?php echo CHOOSE_SNIPPET_TO_EDIT; ?>">
                    <?php echo EDIT; ?> <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a href="#" id="delete-snippet-button" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="<?php echo CHOOSE_SNIPPET_TO_DELETE; ?>">
                    <?php echo DELETE_CONST; ?> <i class="glyphicon glyphicon-remove"></i>
                </a>
    <?php
} // end $allowEdit ?>
            </div>
            <div class="col-sm-12" id="code-wrapper">
                <pre></pre>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo JQUERY_JS ?>"></script>
<script type="text/javascript" src="<?php echo BOOTSTRAP_JS ?>"></script>
<script type="text/javascript" src="js/utils.min.js"></script>
<script type="text/javascript" src="js/jquery.htmlClean.min.js"></script>
<script type="text/javascript" src="<?php echo PRISM_JS; ?>"></script>
<script src="<?php echo CODEMIRROR_FOLDER; ?>lib/codemirror.js"></script>
<script src="<?php echo CODEMIRROR_FOLDER; ?>mode/xml/xml.js"></script>
<script src="<?php echo CODEMIRROR_FOLDER; ?>mode/javascript/javascript.js"></script>
<script src="<?php echo CODEMIRROR_FOLDER; ?>mode/css/css.js"></script>
<script src="<?php echo CODEMIRROR_FOLDER; ?>mode/vbscript/vbscript.js"></script>
<script src="<?php echo CODEMIRROR_FOLDER; ?>mode/htmlmixed/htmlmixed.js"></script>
<?php
if (preg_match('`tinymce-bootstrap-plugin`', $_SERVER['REQUEST_URI']) || preg_match('`codecanyon.creation-site.org`', $_SERVER['REQUEST_URI'])) {
    if (!isset($_SESSION['demo_warning_ok'])) {
        $_SESSION['demo_warning_ok'] = true; ?>
        <!-- Modal -->
        <div class="modal fade" id="demo-warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Demo warning</h4>
              </div>
              <div class="modal-body">
                <p>Users's snippets are deleted each 10 minutes in this demo</p>
                <p>Bootstrap javascript do not launch in tinyMce preview.<br>That's a normal behaviour, it'll work as intended into your pages.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Got it !</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#demo-warning').modal('show');
            });
        </script>
    <?php
    }
} // end demo_warning ?>
<script type="text/javascript">
/* jshint strict: true */
/*global $, makeResponsive, getBootstrapStyles, updateCode*/

var snippetIndex,
    snippetCode;

var initClickEvents,
    slideCodeWrapperDown;

$.noConflict();
jQuery(document).ready(function ($) {
    'use strict';
    makeResponsive();
    getBootstrapStyles();

<?php
if ($allowEdit == 'true') { ?>
    var disableOkButton,
        showAddSnippetForm;

    disableOkButton = function (event) {
        event.preventDefault();
        var target = $('#code-wrapper');
        if ($('#new-snippet-form-wrapper').css('display') == 'block') {
            target = $('#end-edit-warning');
        }
        target.prepend('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please end edit before validate</div>');

        return false;
    };

    slideCodeWrapperDown = function () {
        if ($('#code-wrapper').css('display') == 'none') {
            $('#code-title a').not('#edit-snippet-button, #delete-snippet-button').trigger('click');
        }
    };

    /* Add snippet */

    showAddSnippetForm = function () {
        $('#new-snippet-form-wrapper').show(400).scrollToTop();

        /* Disable main OK button while adding snippet */

        $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').addClass('disabled').on('click', disableOkButton);
        $('#new-snippet-cancel-button').on('click', function () {
            $('#new-snippet-form-wrapper').hide(400);

            /* Re-enable OK button */

            $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').removeClass('disabled').off('click');
        });
    };

    /* new snippet form */

    $('#new-snippet-form-wrapper').hide();
    var newSnippetEditor = CodeMirror.fromTextArea(document.getElementById('new-snippet-code'), {
        mode: 'htmlmixed',
        indentUnit: 4,
        tabSize: 4,
        lineWrapping: true,
        searchMode: 'inline'
    });
    $('#new-snippet-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'snippets/add-new-snippet.php',
            type: 'POST',
            dataType: 'json',
            data: {title: $('#new-snippet-title').val(), code: $('#new-snippet-code').val(), language: 'en_EN'}
        })
        .done(function (data) {
            var totalSnippets   = data.totalSnippets,
                snippetsList    = data.snippetsList,
                returnMsg       = data.returnMsg,
                returnDangerMsg       = data.returnDangerMsg,
                newSnippetIndex = (totalSnippets - 1);
            $('#snippets-list').html(snippetsList);
            $('#new-snippet-title').val('');
            $('#new-snippet-code').val('');
            $('#new-snippet-form-wrapper').hide(400);
            initClickEvents();
            $('.selector.select-snippet[data-index="' + newSnippetIndex + '"]').trigger('click');
            if (returnMsg === null) {
                returnMsg = '';
            }
            if (returnDangerMsg === null) {
                returnDangerMsg = '';
            }
            $('#ajax-msg').html(returnMsg + returnDangerMsg).scrollToTop();

            /* Re-enable OK button */

            $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').removeClass('disabled').off('click');
        })
        .fail(function () {
            $('#ajax-msg').html('error').scrollToTop();
        });

        return false;
    });

    /* Edit snippet */

    $('#edit-snippet-button').tooltip();
    $('#edit-snippet-button').on('click', function () {
        $('#code-title').scrollToTop();
        if ($(this).hasClass('btn-primary')) {
            slideCodeWrapperDown();
            var editSnippetIndex = $('.select-snippet.active').attr('data-index'),
                editSnippetTitle = $('.select-snippet.active').html().trim(),
                editSnippetCode = $('#content-' + editSnippetIndex).html().trim();
            $('#code-wrapper').html('<form name="edit-snippet-form" action="" novalidate> <div class="form-group"> <label><?php echo TITLE; ?> :</label> <input type="text" class="form-control" id="edit-snippet-title" name="edit-snippet-title" value="' + editSnippetTitle + '" required="required" pattern="[a-zA-Z0-9_ -]{1,150}"> </div> <div class="form-group"> <label><?php echo CODE; ?> :</label> <textarea class="form-control" name="edit-snippet-code" id="edit-snippet-code" rows="10">' + editSnippetCode + '</textarea> </div> <div class="form-group"> <div class="btn-group"> <button type="submit" class="btn btn-primary" id="edit-snippet-ok-button"><?php echo OK; ?></button> <button type="button" class="btn btn-default" id="edit-snippet-cancel-button"><?php echo CANCEL; ?></button> </div> </div> </form>');
            /* Code Mirror */

            var editSnippetEditor = CodeMirror.fromTextArea(document.getElementById('edit-snippet-code'), {
                mode: 'htmlmixed',
                indentUnit: 4,
                tabSize: 4,
                lineWrapping: true,
                searchMode: 'inline'
            });

            /* Disable main OK button while editing snippet */

            $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').addClass('disabled').on('click', disableOkButton);

            /* Update Snippet (Ajax) */

            $('#edit-snippet-ok-button').on('click', function (e) {
                e.preventDefault();
                editSnippetEditor.save();
                $.ajax({
                    url: 'snippets/edit-snippet.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {index: editSnippetIndex, title: $('#edit-snippet-title').val(), code: $('#edit-snippet-code').val(), language: 'en_EN'}
                })
                .done(function (data) {
                    var snippetsList    = data.snippetsList,
                        returnMsg       = data.returnMsg,
                        returnDangerMsg = data.returnDangerMsg;
                    $('#snippets-list').html(snippetsList);
                    $('#edit-snippet-title').val('');
                    $('#edit-snippet-code').val('');
                    initClickEvents();
                    $('.selector.select-snippet[data-index="' + editSnippetIndex + '"]').trigger('click');
                    if (returnMsg === null) {
                        returnMsg = '';
                    }
                    if (returnDangerMsg === null) {
                        returnDangerMsg = '';
                    }
                    $('#ajax-msg').html(returnMsg + returnDangerMsg).scrollToTop();
                })
                .fail(function () {
                    $('#ajax-msg').html('error').scrollToTop();
                });
            });
            $('#edit-snippet-cancel-button').on('click', function (e) {
                e.preventDefault();
                $('.selector.select-snippet[data-index=' + editSnippetIndex + ']').trigger('click');
                $('#ajax-msg').scrollToTop();
            });

            /* Re-enable OK button */

            $('#edit-snippet-ok-button, #edit-snippet-cancel-button').on('click', function () {
                $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').removeClass('disabled').off('click');
            });
        }
    });

    /* Delete snippet */

    $('#delete-snippet-button').tooltip();
    $('#delete-snippet-button').on('click', function () {
        if ($(this).hasClass('btn-danger')) {
            slideCodeWrapperDown();
            $('#code-title').scrollToTop();
            var deleteSnippetIndex = $('.select-snippet.active').attr('data-index'),
                deleteSnippetTitle = $('.select-snippet.active').text().trim();
                $('#code-wrapper').html('<p class="text-danger">Delete "' + deleteSnippetTitle + '" ?</p><form name="delete-snippet-form" action=""><div class="form-group"> <div class="btn-group"> <button type="submit" class="btn btn-primary" id="delete-snippet-ok-button">OK</button> <button type="button" class="btn btn-default" id="delete-snippet-cancel-button">Cancel</button> </div> </div></form>');

            /* Disable main OK button while editing snippet */

            $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').addClass('disabled').on('click', disableOkButton);

            /* Update Snippet (Ajax) */

            $('#delete-snippet-ok-button').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'snippets/delete-snippet.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {index: deleteSnippetIndex, language: 'en_EN'}
                })
                .done(function (data) {
                    var snippetsList    = data.snippetsList,
                        returnMsg       = data.returnMsg;
                    $('#snippets-list').html(snippetsList);
                    $('#test-wrapper').html('');
                    $('#edit-snippet-button').removeClass('btn-primary').addClass('btn-default').tooltip('destroy');
                    $('#delete-snippet-button').removeClass('btn-danger').addClass('btn-default').tooltip('destroy');
                    updateCode();
                    initClickEvents();
                    $('#ajax-msg').html(returnMsg).scrollToTop();
                })
                .fail(function () {
                    $('#ajax-msg').html('error').scrollToTop();
                });
            });
            $('#delete-snippet-cancel-button').on('click', function (e) {
                e.preventDefault();
                $('.selector.select-snippet[data-index=' + deleteSnippetIndex + ']').trigger('click');
            });

            /* Re-enable OK button */

            $('#delete-snippet-ok-button, #delete-snippet-cancel-button').on('click', function () {
                $(window.parent.document.body).find('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').find('button').removeClass('disabled').off('click');
            });
        }
    });
    <?php
} // end $allowEdit ?>

    /* select snippet */

    initClickEvents = function () {
        $('.selector.select-snippet').each(function (event, element) {
            $(element).on('click', function (event) {
                $('.selector.select-snippet').removeClass('active');
                $(this).addClass('active');
                snippetIndex = $(this).attr('data-index');
                snippetCode = $('#content-' + snippetIndex).html();
                $('#test-wrapper').fadeOut(200, function () {
                    $(this).html(snippetCode);
                    updateCode();
                    $(this).fadeIn(200);
                });
                $('#edit-snippet-button').removeClass('btn-default').addClass('btn-primary').tooltip('destroy');
                $('#delete-snippet-button').removeClass('btn-default').addClass('btn-danger').tooltip('destroy');
            });
        });
<?php
if ($allowEdit == 'true') { ?>
        $('#add-new-snippet-btn').on('click', showAddSnippetForm);
    <?php
} // end $allowEdit ?>
    };
    initClickEvents();
});
</script>
</body>
</html>
