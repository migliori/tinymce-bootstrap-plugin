<?php
include_once('conf/conf.php');
if (isset($_GET['edit'])) {
    $newBreadcrumb = false;
    $breadcrumbCode  = '';
} else {
    $newBreadcrumb = true;
    $breadcrumbCode  = '<ol class="breadcrumb"><li><a href="' . SITE_URL . '"><span class="glyphicon glyphicon-home"></span></a></li><li><a href="' . SITE_URL . '/content.php">content</a></li><li class="active">page</li></ol>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="<?php echo $bootstrap_css_path; ?>">
    <link rel="stylesheet" href="css/plugin.min.css">
    <link href="<?php echo PRISM_CSS; ?>" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row margin-bottom-md">
            <div class="choice-title margin-bottom-md">
                <span><?php echo ITEMS; ?></span>
            </div>
                <div class="col-sm-4"><h4><?php echo TITLE; ?></h4></div>
                <div class="col-sm-6"><h4><?php echo LINK; ?></h4></div>
            <div class="col-md-12" id="items">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="icon-home">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="content">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/content.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="page">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 margin-bottom-md">
                <div class="form-control form-control-like">
                    <button class="btn btn-sm btn-success" id="add-new-item"><?php echo ADD_NEW_ITEM; ?><span class="bootstrap-icon-plus append"></span></button>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title" class="margin-bottom-md">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 margin-bottom-md" id="test-wrapper">
                <?php echo $breadcrumbCode ?>
            </div>
        </div>
        <div class="row">
            <div id="code-title">
                <a href="#" id="code-slide-link"><?php echo CODE; ?> <i class="glyphicon glyphicon-arrow-up"></i></a>
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
<script type="text/javascript">
    var newBreadcrumb  = '<?php echo $newBreadcrumb; ?>';
    var breadcrumbCode  = '<?php echo $breadcrumbCode; ?>';
    var index;
    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();

        /* if newBreadcrumb === false, we get code from tinymce */

        if (!newBreadcrumb) {
            breadcrumbCode = getCode('.breadcrumb.active');
            var find = new Array(/\s?data-mce-[a-z]+="[^"]+"/g);
            var replace = new Array('', '', '', '', '');

            for (var i = find.length - 1; i >= 0; i--) {
                breadcrumbCode = breadcrumbCode.replace(find[i], replace[i]);
            }
            $('#test-wrapper').html(breadcrumbCode);

            /* empty items list, get each li from test-wrapper and report it to item editable list */

            var text;
            var link;
            $('#items').empty();
            $('#test-wrapper').find('li').each(function () {
                if ($(this).find('a').length < 1) { // no link
                    text = $(this).html();
                    link = '';
                } else { // link present
                    text = link = $(this).find('a').html();
                    link = $(this).find('a').attr('href');
                }
                addNewItem(text, link, false);
            });

            /* add ID to table test if table code has been received from php */

            $('#test-wrapper .breadcrumb').attr('id', 'breadcrumb-test');
        }

        updateCode();

        $('button[data-toggle="tooltip"]').tooltip();

        /* text inputs */

        $('#items').on('click, focus', '.select-text', function () {
            index = $('.select-text').index(this);
            $(this).on('keyup', function () {
                changeText(this, index);
            });
        });

        /* link inputs */

        $('#items').on('click, focus', '.select-link', function () {
            index = $('.select-link').index(this);
            $(this).on('keyup', function () {
                changeLink(this, index);
            });
        });

        /* delete item button */

        $('#items').on('click', '.btn-delete-item', function () {
            index = $('.btn-delete-item').index(this) + 1; // first item has no remove button
            deleteItem(index);
        });

        /* add new item button */

        $('#add-new-item').on('click', function () {
            addNewItem('new item', '', true);
        });

        function changeText(input, index)
        {
            var li = $('#test-wrapper ol li')[index];
            var value = $(input).prop('value');
            if (value == 'icon-home') {
                value = '<span class="glyphicon glyphicon-home"></span>';
            }
            if ($(li).find('a').length < 1) {
                $(li).html(value);
            } else {
                $(li).find('a').html(value);
            }
            updateCode();
        }

        function changeLink(input, index)
        {
            var li = $('#test-wrapper ol li')[index];
            var value = $(input).prop('value');
            if (value.length < 1) { // new link empty
                $(li).html($(li).find('a').html());
                $(li).addClass('active');
            } else { // new link present
                if ($(li).find('a').length < 1) { // no old link
                    $(li).removeClass('active');
                    var link = $('<a>').attr('href', value).html($(li).html());
                    $(li).empty().append(link);
                } else { // old link present
                    $(li).find('a').attr('href', value);
                }
            }
            updateCode();
        }

        function addNewItem(text, link, addToPreview)
        {
            var newItemHtml;
            var newItemPreview;

            /* replace glyphicon-home code by 'icon-home' in input */

            if (text.match(/glyphicon-home/)) {
                text = 'icon-home';
            }

            newItemHtml = '<div class="row"> <div class="col-sm-4"> <div class="form-group"> <input class="form-control select-text" type="text" value="' + text + '"> </div> </div> <div class="col-sm-6"> <div class="form-group"> <input class="form-control select-link" type="text" value="' + link + '"> </div> </div> <div class="col-sm-2"> <div class="form-control form-control-like"> <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button> </div> </div> </div>';
            $('#items').append(newItemHtml);
            if (addToPreview) {
                newItemPreview = '<li class="active"> <?php echo NEW_ITEM; ?> </li>';
                $('#test-wrapper ol').append(newItemPreview);
            }
            $('button[data-toggle="tooltip"]').tooltip();
            updateCode();
        }

        function deleteItem(index)
        {
            var li = $('#test-wrapper ol li')[index];
            var row = $('#items div.row')[index];
            li.remove();
            row.remove();
            updateCode();
        }
    });
</script>
</body>
</html>
