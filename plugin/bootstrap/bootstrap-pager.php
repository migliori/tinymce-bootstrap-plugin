<?php
include_once('conf/conf.php');
if (isset($_GET['edit'])) {
    $newPager = false;
    $pagerCode  = '';
} else {
    $newPager = true;
    $pagerCode  = '<ul class="pager"><li class="previous"><a href="#">&larr; ' . PREVIOUS . '</a></li> <li class="next"><a href="#">' . NEXT . ' &rarr;</a></li></ul>';
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
                <span><?php echo POSITION; ?></span>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <div class="btn-group btn-toggle-position">
                        <button class="btn btn-sm btn-default" data-attr="false"><?php echo CENTER; ?></button>
                        <button class="btn btn-sm btn-success active" data-attr="true"><?php echo PUSH_TO_THE_SIDES; ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title margin-bottom-md">
                <span><?php echo CONTENT; ?></span>
            </div>
            <div class="col-xs-4"><h4><?php echo TITLE; ?></h4></div>
            <div class="col-xs-4"><h4><?php echo LINK; ?></h4></div>
            <div class="col-xs-4"><h4><?php echo DISABLED; ?></h4></div>
            <div class="col-xs-12" id="content">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="&larr; <?php echo PREVIOUS; ?>">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-text" type="text" value="<?php echo NEXT; ?> &rarr;">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <input class="form-control select-link" type="text" value="<?php echo SITE_URL; ?>">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="btn-group btn-toggle">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 margin-bottom-md" id="test-wrapper">
                <?php echo $pagerCode ?>
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
    var newPager  = '<?php echo $newPager; ?>';
    var pagerCode  = '<?php echo $pagerCode; ?>';
    var index;
    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();

        /* if newPager === false, we get code from tinymce */

        if (!newPager) {
            pagerCode = getCode('.pager.active');
            var find = new Array(/\s?data-mce-[a-z]+="[^"]+"/g);
            var replace = new Array('', '', '', '', '');

            for (var i = find.length - 1; i >= 0; i--) {
                pagerCode = pagerCode.replace(find[i], replace[i]);
            }
            $('#test-wrapper').html(pagerCode);

            /* empty content, get each li from test-wrapper and report it to content editable */

            var text;
            var link;
            var disabled;
            $('#content').empty();
            $('#test-wrapper').find('li').each(function () {
                text = $(this).find('a').html();
                link = $(this).find('a').attr('href');
                if ($(this).hasClass('disabled')) {
                    disabled = true;
                } else {
                    disabled = false;
                }
                addNewItem(text, link, disabled);
            });

            /* toggle position btn if needed */

            if (!$('#test-wrapper li:first-child').hasClass('previous')) {
                var btnGroup = $('.btn-toggle-position')[0];
                toggleBtn(btnGroup);
            }

            /* add ID to table test if table code has been received from php */

            $('#test-wrapper .pager').attr('id', 'pager-test');
        }

        updateCode();

        /* text inputs */

        $('#content').on('click, focus', '.select-text', function () {
            index = $('.select-text').index(this);
            $(this).on('keyup', function () {
                changeText(this, index);
            });
        });

        /* link inputs */

        $('#content').on('click, focus', '.select-link', function () {
            index = $('.select-link').index(this);
            $(this).on('keyup', function () {
                changeLink(this, index);
            });
        });

        /* toggle disabled|position */

        activateToggleDisabled();
        activateTogglePosition();

        function activateToggleDisabled()
        {
            $('.btn-toggle').each( function () {
                $(this).on('click', function () {
                    index = $('.btn-toggle').index(this);
                    toggleDisabled(this, index);
                });
            });
        }

        function activateTogglePosition()
        {
            $('.btn-toggle-position').on('click', function () {
                togglePosition(this);
            });
        }

        function changeText(input, index)
        {
            var li = $('#test-wrapper ul li')[index];
            var value = $(input).prop('value');
            $(li).find('a').html(value);
            updateCode();
        }

        function changeLink(input, index)
        {
            var li = $('#test-wrapper ul li')[index];
            var value = $(input).prop('value');
            $(li).find('a').attr('href', value);
            updateCode();
        }

        function toggleDisabled(btnGroup, index)
        {
            var disabled = toggleBtn(btnGroup);
            var li = $('#test-wrapper li')[index];
            if (disabled) {
                $(li).addClass('disabled');
            } else {
                $(li).removeClass('disabled');
            }
            updateCode();
        }

        function togglePosition(btnGroup)
        {
            var pulledPager = toggleBtn(btnGroup);
            if (pulledPager) {
                $('#test-wrapper li:first-child').addClass('previous');
                $('#test-wrapper li:last-child').addClass('next');
            } else {
                $('#test-wrapper li:first-child').removeClass('previous');
                $('#test-wrapper li:last-child').removeClass('next');
            }
            updateCode();
        }

        function addNewItem(text, link, disabled)
        {
            text = text.toString();
            var newItemHtml = '<div class="row"><div class="col-sm-4"><div class="form-group"><input class="form-control select-text" type="text" value="' + text + '"></div></div><div class="col-sm-4"><div class="form-group"><input class="form-control select-link" type="text" value="' + link + '"></div></div>';
            if (disabled) {
                newItemHtml += '<div class="col-sm-4"><div class="btn-group btn-toggle"><button class="btn btn-sm btn-default" data-attr="false"><?php echo NO; ?></button><button class="btn btn-sm btn-success active" data-attr="true"><?php echo YES; ?></button></div></div></div>'
            } else {
                newItemHtml += '<div class="col-sm-4"><div class="btn-group btn-toggle"><button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button><button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button></div></div></div>'
            }
            $('#content').append(newItemHtml);
        }
    });
</script>
</body>
</html>
