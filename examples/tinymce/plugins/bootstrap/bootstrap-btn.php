<?php
include_once('conf/conf.php');
if (isset($_GET['btnCode'])) {
    $btnCode  = preg_replace('/\r|\n/', '', urldecode($_GET['btnCode']));
    $btnIcon  = preg_replace('/\r|\n/', '', urldecode($_GET['btnIcon']));
    $btnStyle = preg_replace('/\r|\n/', '', urldecode($_GET['btnStyle']));
    $btnSize  = preg_replace('/\r|\n/', '', urldecode($_GET['btnSize']));
    $btnTag   = preg_replace('/\r|\n/', '', urldecode($_GET['btnTag']));
    $btnHref  = preg_replace('/\r|\n/', '', urldecode($_GET['btnHref']));
    $btnType  = preg_replace('/\r|\n/', '', urldecode($_GET['btnType']));
    $btnText  = preg_replace('/\r|\n/', '', urldecode($_GET['btnText']));
    $iconPos  = preg_replace('/\r|\n/', '', urldecode($_GET['iconPos']));
} else {
    $btnCode  = '<button type="button" class="btn btn-primary" id="btn-test">' . MY_FANTASTIC_BUTTON . '</button>';
    $btnIcon  = 'glyphicon-none';
    $btnStyle = 'btn-primary';
    $btnSize  = '';
    $btnTag   = 'button';
    $btnHref  = '#';
    $btnType  = 'button';
    $btnText  = MY_FANTASTIC_BUTTON;
    $iconPos  = 'prepend';
}
$iconFont = urldecode($_GET['iconFont']);
$css_icon_file = ''; // default = glyphicon
$js_icon_file = 'iconset-glyphicon.min.js'; // default
if($iconFont == 'ionicon') {
    $css_icon_file = 'ionicons.min.css';
    $js_icon_file  = 'iconset-ionicon-1.5.2.min.js';
} else if($iconFont == 'fontawesome') {
    $css_icon_file = 'font-awesome.min.css';
    $js_icon_file  = 'iconset-fontawesome-4.2.0.min.js';
} else if($iconFont == 'weathericon') {
    $css_icon_file = 'weather-icons.min.css';
    $js_icon_file  = 'iconset-weathericon-1.2.0.min.js';
} else if($iconFont == 'mapicon') {
    $css_icon_file = 'map-icons.min.css';
    $js_icon_file  = 'iconset-mapicon-2.1.0.min.js';
} else if($iconFont == 'octicon') {
    $css_icon_file = 'octicons.min.css';
    $js_icon_file  = 'iconset-octicon-2.1.2.min.js';
} else if($iconFont == 'typicon') {
    $css_icon_file = 'typicons.min.css';
    $js_icon_file  = 'iconset-typicon-2.0.6.min.js';
} else if($iconFont == 'elusiveicon') {
    $css_icon_file = 'elusive-icons.min.css';
    $js_icon_file  = 'iconset-elusiveicon-2.0.0.min.js';
} else if($iconFont == 'materialdesign') {
    $css_icon_file = 'material-design-iconic-font.min.css';
    $js_icon_file  = 'iconset-materialdesign-1.1.1.min.js';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="<?php echo $bootstrap_css_path; ?>">
    <link rel="stylesheet" href="css/plugin.min.css">
    <link rel="stylesheet" href="css/bootstrap-iconpicker.min.css">
    <!-- Icon Fonts CSS -->
    <?php if(!empty($css_icon_file)) { ?>
    <link href="css/iconpicker/css/<?php echo $css_icon_file; ?>" rel="stylesheet">
    <?php } ?>
    <link href="<?php echo PRISM_CSS; ?>" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo BUTTON_STYLE; ?></span>
            </div>
            <div class="col-sm-10 col-sm-offset-1">
                <div class="text-center">
                    <div class="choice selector select-style">
                        <button type="button" class="btn btn-default" data-attr="btn-default">default</button>
                    </div>
                    <div class="choice selector select-style">
                        <button type="button" class="btn btn-primary" data-attr="btn-primary">primary</button>
                    </div>
                    <div class="choice selector select-style">
                        <button type="button" class="btn btn-success" data-attr="btn-success">success</button>
                    </div>
                    <div class="choice selector select-style">
                        <button type="button" class="btn btn-info" data-attr="btn-info">info</button>
                    </div>
                    <div class="choice selector select-style">
                        <button type="button" class="btn btn-warning" data-attr="btn-warning">warning</button>
                    </div>
                    <div class="choice selector select-style">
                        <button type="button" class="btn btn-danger" data-attr="btn-danger">danger</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo BUTTON_SIZE; ?></span>
            </div>
            <div class="col-sm-10 col-sm-offset-1">
                <div class="text-center">
                    <div class="choice selector select-size">
                        <button type="button" class="btn <?php echo $btnStyle; ?> btn-xs" data-attr="btn-xs">extra-small</button>
                    </div>
                    <div class="choice selector select-size">
                        <button type="button" class="btn <?php echo $btnStyle; ?> btn-sm" data-attr="btn-sm">small</button>
                    </div>
                    <div class="choice selector select-size">
                        <button type="button" class="btn <?php echo $btnStyle; ?>" data-attr="">medium</button>
                    </div>
                    <div class="choice selector select-size">
                        <button type="button" class="btn <?php echo $btnStyle; ?> btn-lg" data-attr="btn-lg">large</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo TAG; ?></span>
            </div>
            <div class="col-sm-4 col-sm-offset-2">
                <div id="button-select" class="choice selector select-tag" data-target="btn-input-type">
                    <span>&lt;button&gt;</span>
                </div>
                <div id="link-select" class="choice selector select-tag" data-target="btn-link">
                    <span>&lt;a&gt;</span>
                </div>
                <div id="input-select" class="choice selector select-tag" data-target="btn-input-type">
                    <span>&lt;input&gt;</span>
                </div>
            </div>
            <div class="col-sm-6 target-wrapper">
                <div id="btn-link" class="target">
                    <?php echo LINK; ?> : <input type="text" name="btn-link-text" value="<?php echo $btnHref; ?>" placeholder="http://">
                </div>
                <div id="btn-input-type" class="target">
                    <div class="form-group margin-bottom-zero">
                          <label class="radio-inline">
                            <input type="radio" name="options-input-type" value="button">
                            button
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="options-input-type" value="submit">
                            submit
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="options-input-type" value="cancel">
                            cancel
                          </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="choice-title">
                <span><?php echo OTHERS; ?></span>
            </div>
            <div class="text-center">
                <div class="choice">
                    <label><?php echo DISABLED; ?> : </label>
                    <div class="btn-group btn-toggle" id="disabled">
                        <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                        <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                    </div>
                </div>
                <div class="choice">
                    <label><?php echo WIDTH; ?> 100% : </label>
                    <div class="btn-group btn-toggle" id="width100">
                        <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                        <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                    </div>
                </div>
                <div class="choice">
                    <div id="btn-text" class="autoheight margin-bottom-md form-inline form-group">
                        <label id="text-label"><?php echo TEXT; ?> :</label> <input type="text"  class="form-control" name="btn-text" value="<?php echo $btnText; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-warning text-center" id="disabled-warning">
            <span class="glyphicon glyphicon-warning-sign"></span> <?php echo DISABLED_ELEMENTS_WILL_NOT_BE_EDITABLE_IN_TINYMCE_EDITOR; ?>
        </div>
        <div class="row margin-bottom-md" id="icon-choice">
            <div class="text-center">
                <div class="choice">
                    <?php echo ICON; ?> :
                    <button class="btn btn-default" id="iconpicker"></button>
                </div>
                <div class="choice">
                    <label class="radio-inline">
                        <input type="radio" name="icon-pos" value="prepend">
                        <?php echo PREPEND; ?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="icon-pos" value="append">
                        <?php echo APPEND; ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title" class="margin-bottom-md">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 text-center margin-bottom-md" id="test-wrapper">
                <?php echo $btnCode ?>
            </div>
        </div>
        <div class="row">
            <div id="code-title">
                <a href="#" id="code-slide-link"><?php echo CODE; ?> <i class="glyphicon glyphicon-arrow-up"></i></a>
            </div>
            <div class="col-sm-12" id="code-wrapper">
                <pre><?php
                    echo htmlspecialchars($btnCode);
                    ?></pre>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo JQUERY_JS ?>"></script>
<script type="text/javascript" src="<?php echo BOOTSTRAP_JS ?>"></script>
<script type="text/javascript" src="js/utils.min.js"></script>
<script type="text/javascript" src="js/jquery.htmlClean.min.js"></script>
<script type="text/javascript" src="js/iconset/<?php echo $js_icon_file; ?>"></script>
<script type="text/javascript" src="js/bootstrap-iconpicker.min.js"></script>
<script type="text/javascript" src="<?php echo PRISM_JS; ?>"></script>
<script type="text/javascript">
console.log(decodeURIComponent('btnCode=%3Cbutton%20class%3D%22btn%20btn-info%22%20type%3D%22button%22%3E%09%3Cspan%20class%3D%22md-receipt%22%3E%3C%2Fspan%3E%20My%20Fantastic%20Button%3C%2Fbutton%3E'));
    var btnCode  = '<?php echo $btnCode; ?>';
    var iconFont = '<?php echo $iconFont; ?>';
    var btnIcon  = '<?php echo $btnIcon; ?>';
    var btnStyle = '<?php echo $btnStyle; ?>';
    var btnSize  = '<?php echo $btnSize; ?>';
    var btnTag   = '<?php echo $btnTag; ?>';
    var btnHref  = '<?php echo $btnHref; ?>';
    var btnType  = '<?php echo $btnType; ?>';
    var btnText  = '<?php echo $btnText; ?>';
    var iconPos  = '<?php echo $iconPos; ?>';
    var btnWidth = '';
    var iconMainClass = '';
    if(iconFont == 'glyphicon') {
        iconMainClass = 'glyphicon ';
    } else if(iconFont == 'fontawesome') {
        iconMainClass = 'fa ';
    } else if(iconFont == 'weathericon') {
        iconMainClass = 'wi ';
    } else if(iconFont == 'octicon') {
        iconMainClass = 'octicon ';
    } else if(iconFont == 'typicon') {
        iconMainClass = 'typcn';
    }
    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();

        /* add ID to button test if btn code has been received from php */

        if (!$('#test-wrapper #btn-test')[0]) {
            $('#test-wrapper .btn').attr('id', 'btn-test');
        }

        btnWidth = $('#btn-test').outerWidth();
        $('#btn-link').hide();
        $('#disabled-warning').hide();
        $('#iconpicker').iconpicker({
            arrowClass: 'btn-success',
            arrowPrevIconClass: 'glyphicon glyphicon-chevron-left',
            arrowNextIconClass: 'glyphicon glyphicon-chevron-right',
            cols: 5,
            icon: btnIcon,
            iconset: iconFont,
            labelHeader: '<?php echo ZERO_OF_1_PAGES; ?>',
            labelFooter: '<?php echo ZERO_1_OF_2_ICONS; ?>',
            placement: 'top',
            rows: 6,
            cols: 20,
            search: false,
            selectedClass: 'btn-success',
            unselectedClass: ''
        }).on('change', function (e) {
            changeBtnText();
        });

        /* button style */

        $('.selector.select-style').each(function (event, element) {

            /* set style on load */

            if ($(element).find('button').hasClass(btnStyle)) {
                $(element).addClass('active');
            }

            $(element).on('click', function (event) {
                $('.selector.select-style').removeClass('active');
                $(this).addClass('active');
                $('#btn-test').removeClass(btnStyle);
                $('.selector.select-size button').removeClass(btnStyle);
                btnStyle = $(this).find('button').attr('data-attr');
                $('#btn-test').addClass(btnStyle);
                $('.selector.select-size button').addClass(btnStyle);
                updateCode();
            });
        });

        /* button size */

        $('.selector.select-size').each(function (event, element) {

            /* set size on load */

            if ($(element).find('button').hasClass(btnSize)) {
                $(element).addClass('active');
            }

            $(element).on('click', function (event) {
                $('.selector.select-size').removeClass('active');
                $(this).addClass('active');
                $('#btn-test').removeClass(btnSize);
                btnSize = $(this).find('button').attr('data-attr');
                $('#btn-test').addClass(btnSize);
                btnWidth = $('#btn-test').outerWidth();
                updateCode();
            });
        });

        /* set default size active on load if no other activated */

        if (!$('.selector.select-size.active')[0]) {
            $('.selector.select-size > button[data-attr=""]').parent().addClass('active');
        }

        /* button tag */

        $('.selector.select-tag').each(function (event, element) {

            /* set tag on load */

            if (btnTag == 'button' && $(element).attr('id') == 'button-select') {
                $(element).addClass('active');
            } else if (btnTag == 'a' && $(element).attr('id') == 'link-select') {
                $(element).addClass('active');
                $('.target').each(function () {
                    if ($(this).css('display') == 'block') {
                        $(this).fadeOut(200).removeClass('active');
                    }
                }).promise().done(function () {
                    $('#btn-link').fadeIn(200);
                $('#btn-link').addClass('active');
                });
            } else if (btnTag == 'input' && $(element).attr('id') == 'input-select') {
                $(element).addClass('active');
                $('#text-label').text('<?php echo VALUE; ?> : ');
            }

            $(element).on('click', function (event) {
                var target = $(this).attr('data-target');

                /* add/remove active class */

                $('.selector.select-tag').removeClass('active');
                $(this).addClass('active');

                /* show/hide target */

                if (!$('#' + target).hasClass('active')) {
                    $('.target').each(function () {
                        if ($(this).css('display') == 'block') {
                            $(this).fadeOut(200).removeClass('active');
                        }
                    }).promise().done(function () {
                        $('#' + target).fadeIn(200);
                        $('#' + target).addClass('active');
                    });
                }

                /* change button test tag */

                changeBtnTag(target);
            });
        });

        /* set type on load */

        $('input[name="options-input-type"]').each(function () {
            if ($(this).val() == btnType) {
                $(this).attr('checked', true);
            }
        });

        /* set icon position on load */

        $('input[name="icon-pos"]').each(function () {
            if ($(this).val() == iconPos) {
                $(this).attr('checked', true);
            }
        });

        $('input[name="options-input-type"]').on('change', function () {
            changeBtnTag('btn-input-type');
        });
        $('#btn-text').on('keyup', changeBtnText);
        $('input[name="btn-link-text"]').on('keyup', changeBtnLink);
        $('#disabled').on('click', changeBtnState);
        $('#width100').on('click', changeBtnWidth);

        /* set width100 on load */

        if ($('#btn-test').hasClass('btn-block')) {
            $('#width100').trigger('click');
        }
        $('input[name="icon-pos"]').on('change', changeBtnText);
        updateCode();
        /* change button test tag */

        function changeBtnTag(target)
        {
            var btnClass = $('#btn-test').attr('class');
            var btnType = $('input[name="options-input-type"]:checked').val();
            var link;
            var html;
            if ($('#btn-test').is('input')) {
                btnText = $('#btn-test').prop('value');
            } else {
                btnText = $('#btn-test').html();
            }
            if (target == 'btn-link') {
                link = $('input[name="btn-link-text"]').val();
                if (link === '') {
                    link = '#';
                }
                html = '<a href="' + link + '" class="' + btnClass + '" id="btn-test"></a>';
                $('#text-label').text('text : ');
                $('#iconpicker').removeAttr('disabled');
            } else if (target == 'btn-input-type') {                    // button or input
                if ($('#input-select').hasClass('active')) {            // input
                    html = '<input type="' + btnType + '" class="' + btnClass + '" id="btn-test" value="">';
                    $('#text-label').text('<?php echo VALUE; ?> : ');
                    $('#iconpicker').attr('disabled', true);
                } else if ($('#button-select').hasClass('active')) {    // button
                    html = '<button type="' + btnType + '" class="' + btnClass + '" id="btn-test"></button>';
                    $('#text-label').text('text : ');
                    $('#iconpicker').removeAttr('disabled');
                }
            }
            $('#test-wrapper').html(html);
            changeBtnText();
        }

        /* change button test link */

        function changeBtnLink()
        {
            var link = $('input[name="btn-link-text"]').val();
            if (link === '') {
                link = '#';
            }
            $('#btn-test').attr('href', link);
            updateCode();
        }

        /* change button state (enabled/disabled) */

        function changeBtnState()
        {
            var checked = toggleBtn(this);
            if (checked) {
                $('#btn-test').attr('disabled', true);
                $('#disabled-warning').show(500);
            } else {
                $('#btn-test').removeAttr('disabled');
                $('#disabled-warning').hide(500);
            }
            updateCode();
        }

        /* change button width (class btn-block) */

        function changeBtnWidth()
        {
            var wrapperWidth = $('#test-wrapper').width;
            var checked = toggleBtn(this);
            $('#test-wrapper').addClass('no-transition');
            if (checked) {
                btnWidth = $('#btn-test').outerWidth();
                $('#btn-test').css('width', btnWidth + 'px').addClass('btn-block').animate({'width': '100%'}, 500, function () {
                    $(this).css({'width': '', 'overflow': ''});
                    updateCode();
                    $('#test-wrapper').removeClass('no-transition');
                });
            } else {
                $('#btn-test').css('width', '100%').removeClass('btn-block').animate({'width': btnWidth + 'px'}, 500, function () {
                    $(this).css({'width': '', 'overflow': ''});
                    updateCode();
                    $('#test-wrapper').removeClass('no-transition');
                });
            }
        }

        /* change button text */

        function changeBtnText()
        {
            btnText = $('input[name="btn-text"]').prop('value');
            btnIcon = $('#iconpicker').find('input[type="hidden"]').prop('value');
            iconPos = $('input[name="icon-pos"]:checked').val();
            if ($('#btn-test').is('input')) {
                $('#btn-test').attr('value', btnText);
            } else {
                if (btnIcon == 'glyphicon-none') {
                    $('#btn-test').html(btnText);
                } else {
                    if (iconPos == 'prepend') {
                        $('#btn-test').html('<span class="' + iconMainClass + btnIcon + '"></span> ' + btnText);
                    } else {
                        $('#btn-test').html(btnText + ' <span class="' + iconMainClass + btnIcon + '"></span>');
                    }
                }
            }
            updateCode();
        }
    });

</script>
</body>
</html>
