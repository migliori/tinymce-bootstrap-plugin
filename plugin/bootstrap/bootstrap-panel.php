<?php
include_once('conf/conf.php');
if (isset($_GET['edit'])) {
    $newPanel            = false;
    $panelHeading        = '';
    $panelHeadingContent = '';
    $panelBodyContent    = '';
    $panelFooter         = '';
    $panelFooterContent  = '';
    $panelStyle          = '';
    $panelCode           = '';
} else {
    $newPanel            = true;
    $panelHeading        = true;
    $panelHeadingContent = '<h3 class="panel-title">' . PANEL_TITLE . '</h3>';
    $panelBodyContent    = '<p>' . PANEL_CONTENT . '</p>';
    $panelFooter         = false;
    $panelFooterContent  = '';
    $panelStyle          = 'panel-primary';
    $panelCode           = '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">' . PANEL_TITLE . '</h3></div><div class="panel-body"><p>' . PANEL_CONTENT . '</p></div></div>';
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
                <span><?php echo SECTIONS; ?></span>
            </div>
            <div class="col-sm-4 col-sm-offset-2 col-xs-6">
                <div class="btn-group btn-toggle-panel-heading">
                    <button class="btn btn-sm btn-default" data-attr="false"><?php echo NO_HEADING; ?></button>
                    <button class="btn btn-sm btn-success active" data-attr="true"><?php echo HEADING; ?></button>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="btn-group btn-toggle-panel-footer">
                    <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO_FOOTER; ?></button>
                    <button class="btn btn-sm btn-default" data-attr="true"><?php echo FOOTER; ?></button>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title margin-bottom-md">
                <span><?php echo PANEL_STYLE; ?></span>
            </div>
            <div class="col-sm-2 col-xs-4 text-center">
                <div class="choice selector select-panel-style">
                    <div class="panel panel-default" data-attr="panel-default"><div class="panel-heading">default</div><div class="panel-body">panel</div></div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4 text-center">
                <div class="choice selector select-panel-style">
                    <div class="panel panel-primary" data-attr="panel-primary"><div class="panel-heading">primary</div><div class="panel-body">panel</div></div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4 text-center">
                <div class="choice selector select-panel-style">
                    <div class="panel panel-success" data-attr="panel-success"><div class="panel-heading">success</div><div class="panel-body">panel</div></div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4 text-center">
                <div class="choice selector select-panel-style">
                    <div class="panel panel-info" data-attr="panel-info"><div class="panel-heading">info</div><div class="panel-body">panel</div></div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4 text-center">
                <div class="choice selector select-panel-style">
                    <div class="panel panel-warning" data-attr="panel-warning"><div class="panel-heading">warning</div><div class="panel-body">panel</div></div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-4 text-center">
                <div class="choice selector select-panel-style">
                    <div class="panel panel-danger" data-attr="panel-danger"><div class="panel-heading">danger</div><div class="panel-body">panel</div></div>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo PANEL_CONTENT; ?></span>
            </div>
        </div>
        <div class="clearfix">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="panel-heading-content" class="col-xs-4"><?php echo HEADING_CONTENT; ?> : </label>
                    <div class="col-xs-8">
                        <input name="panel-heading-content" class="form-control select-text" type="text" value="&lt;h3 class=&quot;panel-title&quot;&gt;<?php echo PANEL_TITLE; ?>&lt;/h3&gt;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="panel-body-content" class="col-xs-4"><?php echo MAIN_CONTENT; ?> : </label>
                    <div class="col-xs-8">
                        <input name="panel-body-content" class="form-control select-text" type="text" value="&lt;p&gt;<?php echo PANEL_CONTENT; ?>&lt;/p&gt;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="panel-footer-content" class="col-xs-4"><?php echo FOOTER_CONTENT; ?> : </label>
                    <div class="col-xs-8">
                        <input name="panel-footer-content" class="form-control select-text" type="text" value="">
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <p class="text-success text-center"><?php echo HTML_AUTHORIZED; ?></p>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title" class="margin-bottom-md">
                <span class="label-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 margin-bottom-md" id="test-wrapper">
                <?php echo $panelCode ?>
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
    var newPanel            = '<?php echo $newPanel; ?>';
    var panelHeading        = '<?php echo $panelHeading; ?>';
    var panelHeadingContent = '<?php echo $panelHeadingContent; ?>';
    var panelBodyContent    = '<?php echo $panelBodyContent; ?>';
    var panelFooter         = '<?php echo $panelFooter; ?>';
    var panelFooterContent  = '<?php echo $panelFooterContent; ?>';
    var panelStyle          = '<?php echo $panelStyle; ?>';
    var panelCode           = '<?php echo $panelCode; ?>';
    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();

        $('#panel-footer-input-wrapper').hide(); // default

        /* if newPanel === false, we get code from tinymce */

        if (!newPanel) {
            panelCode = getCode('.panel.active');
            if ($(panelCode).find('.panel-heading').length > 0) {
                panelHeading = true;
                panelHeadingContent = $(panelCode).find('.panel-heading').html();
            }
            panelBodyContent = $(panelCode).find('.panel-body').html();
            if ($(panelCode).find('.panel-footer').length > 0) {
                panelFooter = true;
                panelFooterContent = $(panelCode).find('.panel-footer').html();
            }
            var find = new Array(/\s?data-mce-[a-z]+="[^"]+"/g, / active/);
            var replace = new Array('', '');

            for (var i = find.length - 1; i >= 0; i--) {
                panelCode = panelCode.replace(find[i], replace[i]);
            }
            $('#test-wrapper').html(panelCode);

            /* get style from tinymce */

            $('.select-panel-style div').each(function (index, el) {
                var dataAttr = $(this).attr('data-attr');
                if ($('#test-wrapper div.panel').hasClass(dataAttr)) {
                    panelStyle = dataAttr;
                }
            });

            if (!panelHeading) {
                toggleBtn($('.btn-toggle-panel-heading')[0]);
                $('#panel-heading-input-wrapper').hide();
            }
            if (panelFooter) {
                toggleBtn($('.btn-toggle-panel-footer')[0]);
                $('#panel-footer-input-wrapper').show();
            }

            /* input text value */

            $('input[name="panel-heading-content"]').val(panelHeadingContent);
            $('input[name="panel-body-content"]').val(panelBodyContent);
            $('input[name="panel-footer-content"]').val(panelFooterContent);
        }


        updateCode();

        /* button style */

        $('.selector.select-panel-style').each(function (event, element) {

            /* set style on load */

            if ($(element).find('div').hasClass(panelStyle)) {
                $(element).addClass('active');
            }

            $(element).on('click', function (event) {
                $('.selector.select-panel-style').removeClass('active');
                $(this).addClass('active');
                $('#test-wrapper div.panel').removeClass(panelStyle);
                panelStyle = $(this).find('div').attr('data-attr');
                $('#test-wrapper div.panel').addClass(panelStyle);
                updateCode();
            });
        });

        /* text inputs */

        $('input[name="panel-heading-content"]').on('click, focus', function () {
            $(this).on('keyup', function () {
                changeText(this, '.panel-heading');
                if ($(this).prop('value').length > 0) {
                    if ($('#test-wrapper .panel-heading').length < 1) {
                        $('.btn-toggle-panel-heading').trigger('click');
                    }
                } else {
                    if ($('#test-wrapper .panel-heading').length > 0) {
                        $('.btn-toggle-panel-heading').trigger('click');
                    }
                }
            });
        });
        $('input[name="panel-body-content"]').on('click, focus', function () {
            $(this).on('keyup', function () {
                changeText(this, '.panel-body');
            });
        });
        $('input[name="panel-footer-content"]').on('click, focus', function () {
            $(this).on('keyup', function () {
                changeText(this, '.panel-footer');
                if ($(this).prop('value').length > 0) {
                    if ($('#test-wrapper .panel-footer').length < 1) {
                        $('.btn-toggle-panel-footer').trigger('click');
                    }
                } else {
                    if ($('#test-wrapper .panel-footer').length > 0) {
                        $('.btn-toggle-panel-footer').trigger('click');
                    }
                }
            });
        });

        /* toggle dismissable */

        activateToggle('panel-heading');
        activateToggle('panel-footer');

        function changeText(input, target)
        {
            var value = $(input).prop('value');
            $('#test-wrapper').find(target).html(value);
            updateCode();
        }

        function activateToggle(target)
        {
            $('.btn-toggle-' + target).on('click', function () {
                toggle(this, target);
            });
        }

        function toggle(btnGroup, target)
        {
            var panelDiv = $('#test-wrapper .panel');
            if (target == 'panel-heading') {
                panelHeading = toggleBtn(btnGroup);
                if (panelHeading) {
                    if ($('#test-wrapper .panel-heading').length < 1) {
                        $('<div class="panel-heading">' + panelHeadingContent + '</div>').prependTo(panelDiv);
                        $('#panel-heading-input-wrapper').slideDown(200);
                    }
                } else {
                    if ($('#test-wrapper .panel-heading').length > 0) {
                        $('#test-wrapper .panel-heading').remove();
                        $('#panel-heading-input-wrapper').slideUp(200);
                    }
                }
            } else { // 'panel-footer'
                panelFooter = toggleBtn(btnGroup);
                if (panelFooter) {
                    if ($('#test-wrapper .panel-footer').length < 1) {
                        $('<div class="panel-footer">' + panelFooterContent + '</div>').appendTo(panelDiv);
                        $('#panel-footer-input-wrapper').slideDown(200);
                    }
                } else {
                    if ($('#test-wrapper .panel-footer').length > 0) {
                        $('#test-wrapper .panel-footer').remove();
                        $('#panel-footer-input-wrapper').slideUp(200);
                    }
                }
            }
            updateCode();
        }
    });
</script>
</body>
</html>
