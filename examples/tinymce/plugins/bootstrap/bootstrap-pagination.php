<?php
include_once('conf/conf.php');
if (isset($_GET['edit'])) {
    $newPagination = false;
    $paginationCode  = '';
} else {
    $newPagination = true;
    $paginationCode  = '<ul class="pagination"><li><a href="' . SITE_URL . '">&laquo;</a></li><li class="active"><a href="' . SITE_URL . '/page-1.html">1</a></li><li><a href="' . SITE_URL . '/page-2.html">2</a></li><li><a href="' . SITE_URL . '/page-3.html">3</a></li><li><a href="' . SITE_URL . '/page-4.html">4</a></li><li><a href="' . SITE_URL . '/page-5.html">5</a></li><li><a href="' . SITE_URL . '/page-5.html">&raquo;</a></li></ul>';
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
            <div class="choice-title">
                <span><?php echo SIZE; ?></span>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <div class="choice selector select-size">
                        <ul class="pagination pagination-sm" data-attr="pagination-sm">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                    <div class="choice selector select-size">
                        <ul class="pagination" data-attr="">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                    <div class="choice selector select-size">
                        <ul class="pagination pagination-lg" data-attr="pagination-lg">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="margin-bottom-md">
            <div class="row choice-title margin-bottom-md">
                <span><?php echo ITEMS; ?></span>
            </div>
            <div class="row">
                    <div class="col-xs-2"><h4><?php echo TITLE; ?></h4></div>
                    <div class="col-xs-6"><h4><?php echo LINK; ?></h4></div>
                    <div class="col-xs-2"><h4><?php echo CURRENT; ?></h4></div>
                    <div class="col-xs-2"><h4><?php echo DELETE_CONST; ?></h4></div>
            </div>
            <div id="items">
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="first">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="1">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/page-1.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-default" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-success active" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="2">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/page-2.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="3">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/page-3.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="4">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/page-4.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="5">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/page-5.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="last">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>/page-5.html">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-control form-control-like">
                            <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 margin-bottom-md">
                <div class="form-control form-control-like">
                    <button class="btn btn-sm btn-success" id="add-new-item"><?php echo ADD_NEW_ITEM; ?><span class="bootstrap-icon-plus append"></span></button>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 margin-bottom-md" id="test-wrapper">
                <?php echo $paginationCode ?>
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
    var newPagination  = '<?php echo $newPagination; ?>';
    var paginationSize;
    var paginationCode  = '<?php echo $paginationCode; ?>';
    var index;
    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();

        /* if newPagination === false, we get code from tinymce */

        if (!newPagination) {
            paginationCode = getCode('.pagination.active');
            var find = new Array(/\s?data-mce-[a-z]+="[^"]+"/g);
            var replace = new Array('', '', '', '', '');

            for (var i = find.length - 1; i >= 0; i--) {
                paginationCode = paginationCode.replace(find[i], replace[i]);
            }
            $('#test-wrapper').html(paginationCode);

            /* empty items list, get each li from test-wrapper and report it to item editable list */

            var text;
            var link;
            $('#items').empty();
            $('#test-wrapper').find('li').each(function () {
                text = $(this).find('a').html();
                link = $(this).find('a').attr('href');
                addNewItem(text, link, false);
                if ($(this).hasClass('active')) {
                    index = $('#test-wrapper li').index(this);
                    var btnGroup = $('.btn-toggle')[index];
                    toggleBtn(btnGroup);
                }
            });

            /* add ID to table test if table code has been received from php */

            $('#test-wrapper .pagination').attr('id', 'pagination-test');
        }

        /* pagination size */

        if ($('#test-wrapper .pagination').hasClass('pagination-sm')) {
            paginationSize = 'pagination-sm';
        } else if ($('#test-wrapper .pagination').hasClass('pagination-lg')) {
            paginationSize = 'pagination-lg';
        } else {
            paginationSize = ''; // default
        }
        $('.selector.select-size').each(function (event, element) {

            /* set size on load */

            if ($(element).find('.pagination').attr('data-attr') === paginationSize) {
                $(element).addClass('active');
            }

            $(element).on('click', function (event) {
                $('.selector.select-size').removeClass('active');
                $(this).addClass('active');
                if (paginationSize !== '') {
                    $('#test-wrapper .pagination').removeClass(paginationSize);
                }
                paginationSize = $(this).find('.pagination').attr('data-attr');
                $('#test-wrapper .pagination').addClass(paginationSize);
                updateCode();
            });
        });

        /* set default size active on load if no other activated */

        if (!$('.selector.select-size.active')[0]) {
            $('.selector.select-size > pagination[data-attr=""]').parent().addClass('active');
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
            index = $('.btn-delete-item').index(this);
            deleteItem(index);
        });

        /* toggle active */

        activateToggleButtons();


        /* add new item button */

        $('#add-new-item').on('click', function () {
            index = $('#test-wrapper li').length;
            if ($('#test-wrapper li:first-child a').text() == '«') {
                index -= 1;
            }
            if ($('#test-wrapper li:last-child a').text() == '»') {
                index -= 1;
            }
            var indexNewItem = index + 1;
            var linkNewItem  = '<?php echo SITE_URL; ?>/page-' + indexNewItem + '.html';
            addNewItem(indexNewItem, linkNewItem, true);
        });

        function activateToggleButtons()
        {
            $('.btn-toggle').each( function () {
                $(this).on('click', function () {
                    index = $('.btn-toggle').index(this);
                    toggleActive(this, index);
                });
            });
        }

        function changeText(input, index)
        {
            var li = $('#test-wrapper ul li')[index];
            var value = $(input).prop('value');console.log(value);
            if (value == 'first') {
                value = '&laquo;';
            } else if (value == 'last') {
                value = '&raquo;';
            }
            $(li).find('a').html(value);
            updateCode();
        }

        function changeLink(input, index)
        {
            var li = $('#test-wrapper ul li')[index];
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

        function toggleActive(btnGroup, index)
        {
            toggleAllBtns('.btn-toggle', false);
            toggleBtn(btnGroup);
            $('#test-wrapper li').removeClass('active');
            var li = $('#test-wrapper li')[index];
            $(li).addClass('active');
            updateCode();
        }

        function addNewItem(text, link, addToPreview)
        {
            text = text.toString();
            var newItemHtml;
            var newItemPreview;

            /* replace first/last code by &laquo;/&raquo; in input */

            if (text.match(/first/)) {
                text = '&laquo;';
            } else if (text.match(/last/)) {
                text = '&raquo;';
            }
            newItemHtml = '<div class="row"> <div class="col-xs-2"> <div class="form-group"> <input class="form-control select-text" type="text" value="' + text + '"> </div> </div> <div class="col-xs-6"> <div class="form-group"> <input class="form-control select-link" type="text" value="' + link + '"> </div> </div> <div class="col-xs-2"> <div class="btn-group btn-toggle"> <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button> <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button> </div> </div> <div class="col-xs-2"> <div class="form-control form-control-like"> <button class="btn btn-sm btn-danger btn-xs btn-delete-item" data-toggle="tooltip" title="<?php echo DELETE_THIS_ITEM; ?>"><span class="bootstrap-icon-minus"></span></button> </div> </div> </div>';
            newItemPreview = '<li><a href="' + link + '.html">' + text + '</a></li>';

            /* on load, if pagination update, test-wrapper has already pagination html.
               => we get only items elements.*/

            if (!addToPreview) {
                $('#items').append(newItemHtml);
            } else { // items loaded in preview from tinymce
                if ($('#test-wrapper li:last-child a').html() == '»') {
                    var penultimate = $('#items').find('div.row').last().prev('div.row');
                    if (penultimate.length > 0) {
                        penultimate.after(newItemHtml);
                    } else {
                        $('#items').append(newItemHtml);
                    }
                    var penultimateLi = $('#test-wrapper').find('li').last().prev('li');
                    penultimateLi.after(newItemPreview);
                } else {
                    $('#items').append(newItemHtml);
                    newItemPreview = '<li><a href="<?php echo SITE_URL; ?>/page-' + indexNewItem + '.html">' + indexNewItem + '</a></li>';
                    $('#test-wrapper ul').append(newItemPreview);
                }
            }

            $('button[data-toggle="tooltip"]').tooltip();
            activateToggleButtons();
            updateCode();
        }

        function deleteItem(index)
        {
            var li = $('#test-wrapper ul li')[index];
            var row = $('#items div.row')[index];
            li.remove();
            row.remove();
            updateCode();
        }
    });
</script>
</body>
</html>
