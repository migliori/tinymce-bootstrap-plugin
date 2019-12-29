<?php
include_once('conf/conf.php');

$iconFont        = preg_replace('/\r|\n/', '', urldecode($_GET['iconFont']));
$icon_main_class = '';
$default_icon    = '';
$css_icon_file   = ''; // default = glyphicon
$js_icon_file    = 'iconset-glyphicon.min.js'; // default

if($iconFont == 'glyphicon') {
    $icon_main_class = 'glyphicon ';
    $default_icon  = 'glyphicon-home';
} else if($iconFont == 'ionicon') {
    $css_icon_file = 'ionicons.min.css';
    $js_icon_file  = 'iconset-ionicon-1.5.2.min.js';
    $default_icon  = 'ion-home';
} else if($iconFont == 'fontawesome') {
    $css_icon_file = 'font-awesome.min.css';
    $js_icon_file  = 'iconset-fontawesome-4.2.0.min.js';
    $icon_main_class = 'fa ';
    $default_icon  = 'fa-home';
} else if($iconFont == 'weathericon') {
    $css_icon_file = 'weather-icons.min.css';
    $js_icon_file  = 'iconset-weathericon-1.2.0.min.js';
    $icon_main_class = 'wi ';
    $default_icon  = 'wi-horizon-alt';
} else if($iconFont == 'mapicon') {
    $css_icon_file = 'map-icons.min.css';
    $js_icon_file  = 'iconset-mapicon-2.1.0.min.js';
    $default_icon  = 'map-icon-art-gallery';
} else if($iconFont == 'octicon') {
    $css_icon_file = 'octicons.min.css';
    $js_icon_file  = 'iconset-octicon-2.1.2.min.js';
    $icon_main_class = 'octicon ';
    $default_icon  = 'octicon-home';
} else if($iconFont == 'typicon') {
    $css_icon_file = 'typicons.min.css';
    $js_icon_file  = 'iconset-typicon-2.0.6.min.js';
    $icon_main_class = 'typcn ';
    $default_icon  = 'typcn-home';
} else if($iconFont == 'elusiveicon') {
    $css_icon_file = 'elusive-icons.min.css';
    $js_icon_file  = 'iconset-elusiveicon-2.0.0.min.js';
    $default_icon  = 'el-icon-home';
} else if($iconFont == 'materialdesign') {
    $css_icon_file = 'material-design-iconic-font.min.css';
    $js_icon_file  = 'iconset-materialdesign-1.1.1.min.js';
    $default_icon  = 'md-home';
}

if (isset($_GET['icon'])) {
    $icon      = preg_replace('/\r|\n/', '', urldecode($_GET['icon']));
    $iconSize  = preg_replace('/\r|\n/', '', urldecode($_GET['iconSize']));
    $iconColor = preg_replace('/\r|\n/', '', urldecode($_GET['iconColor']));
    $iconCode  = '<span class="' . $icon_main_class . $icon . '" id="icon-test" style="font-size:' . $iconSize . ';color:' . $iconColor . '"></span>';
} else {
    $icon      = $default_icon;
    $iconSize  = false;
    $iconColor = false;
    $iconCode  = '<span class="' . $icon_main_class . $default_icon . '" id="icon-test"></span>';
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
    <link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.min.css" />
    <link href="<?php echo PRISM_CSS; ?>" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row margin-bottom-md ">
            <div class="choice-title">
                <span><?php echo ICON; ?></span>
            </div>
            <div class="text-center">
                <button class="btn btn-default" id="iconpicker"></button>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo ICON_SIZE; ?></span>
            </div>
            <div class="text-center">
                <div class="choice selector select-size margin-bottom-md">
                    <p><i class="selector-icon <?php echo $icon_main_class . $icon; ?>"></i> extra-small</p>
                </div>
                <div class="choice selector select-size margin-bottom-md">
                    <h4><i class="selector-icon <?php echo $icon_main_class . $icon; ?>"></i> small</h4>
                </div>
                <div class="choice selector select-size margin-bottom-md">
                    <h3><i class="selector-icon <?php echo $icon_main_class . $icon; ?>"></i> medium</h3>
                </div>
                <div class="choice selector select-size margin-bottom-md">
                    <h2><i class="selector-icon <?php echo $icon_main_class . $icon; ?>"></i> large</h2>
                </div>
                <strong><?php echo CUSTOM; ?></strong> : <input name="size-input" size="10" value=""> <strong>px</strong>
            </div>
        </div>
        <div class="row margin-bottom-md ">
            <div class="choice-title">
                <span><?php echo COLOR; ?></span>
            </div>
            <div class="text-center">
                <div class="choice selector select-color">
                    <span class="color btn-default"></span>
                </div>
                <div class="choice selector select-color">
                    <span class="color btn-primary"></span>
                </div>
                <div class="choice selector select-color">
                    <span class="color btn-success"></span>
                </div>
                <div class="choice selector select-color">
                    <span class="color btn-info"></span>
                </div>
                <div class="choice selector select-color">
                    <span class="color btn-warning"></span>
                </div>
                <div class="choice selector select-color">
                    <span class="color btn-danger"></span>
                </div>
                <div id="colorselector">
                    <label><?php echo CUSTOM; ?> : </label><div style="background-color: rgb(239, 239, 239);"></div>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <!-- don't remove beginning space,
            otherwise tinymce will not allow empty tag and will remove your icon -->
            <div class="col-sm-12 margin-bottom-md text-center test-icon-wrapper" id="test-wrapper">
                &nbsp;<?php echo $iconCode; ?>
            </div>
        </div>
        <div class="row">
            <div id="code-title">
                <a href="#" id="code-slide-link">code <i class="glyphicon glyphicon-arrow-up"></i></a>
            </div>
            <div class="col-sm-12 text-center" id="code-wrapper">
                <pre><?php
                    echo htmlspecialchars($iconCode);
                    ?></pre>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo JQUERY_JS ?>"></script>
<script type="text/javascript" src="<?php echo BOOTSTRAP_JS ?>"></script>
<script type="text/javascript" src="js/colorpicker.min.js"></script>
<script type="text/javascript" src="js/utils.min.js"></script>
<script type="text/javascript" src="js/jquery.htmlClean.min.js"></script>
<script type="text/javascript" src="js/iconset/<?php echo $js_icon_file; ?>"></script>
<script type="text/javascript" src="js/bootstrap-iconpicker.min.js"></script>
<script type="text/javascript" src="<?php echo PRISM_JS; ?>"></script>
<script type="text/javascript">
    var icon      = '<?php echo $icon; ?>'; //console.log(icon);
    var iconFont  = '<?php echo $iconFont; ?>'; //console.log(iconFont);
    var iconSize  = '<?php echo $iconSize; ?>'; // console.log(iconSize);
    var iconColor = '<?php echo $iconColor; ?>'; //console.log(iconColor);
    var iconCode  = '<?php echo $iconCode; ?>'; //console.log(iconCode);

    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();

        /* icon size */

        if (!iconSize) { // default size
            iconSize = $('.selector.select-size h3').css('font-size');
        }

        if (!iconColor) {
            iconColor = $('.selector.select-color .btn-primary').attr('data-color');
        }

        $('.selector.select-size').each(function (event, element) {

            /* select the good one on load ; */

            if ($(element).find('i').css('font-size') == iconSize) {
                $(element).addClass('active');
            }

            /* set color on load */

            $('.selector.select-size i').css('color', iconColor);

            $(element).on('click', function (event) {
                $('.selector.select-size').removeClass('active');
                $(this).addClass('active');
                iconSize = $(this).find('i').parent().css('font-size');
                $('#icon-test').css('font-size', iconSize);
                iconCode = $('#test-wrapper').html();
                updateCode();
            });
        });

        /* if none selected, add custom size into input on load */

        if (!$('.selector.select-size').hasClass('active')) {
            $('input[name="size-input"]').val(<?php echo str_replace('px', '', $iconSize); ?>);
        }

        $('input[name="size-input"]').on('keyup', function () {
            var value = $(this).prop('value');
            if (value > 0) {
                iconSize = $(this).prop('value') + 'px';
                $('#icon-test').css('font-size', iconSize);
                $('.selector.select-size').removeClass('active');
                iconCode = $('#test-wrapper').html();
                updateCode();
            } else {
                iconSize = $('.selector.select-size.active').find('i').parent().css('font-size');
                $('#icon-test').css('font-size', iconSize);
                updateCode();
            }
        });

        /* color selectors */

        $('.selector.select-color').each(function (event, element) {

            /* select the good one on load ; */

            $(element).find('span.color').attr('data-color', $(element).find('span.color').css('background-color')); // we catch background because it changes on hover
            if ($(element).find('span.color').attr('data-color') == iconColor) {
                $(element).addClass('active');
            }
            $(element).on('click', function (event) {
                $('.selector.select-color').removeClass('active');
                $(this).addClass('active');
                iconColor = $(this).find('span').attr('data-color');
                $('.selector .selector-icon').css('color', iconColor);
                $('#icon-test').css('color', iconColor);
                $('#iconpicker i.selector-icon').css('color', iconColor);
                iconCode = $('#test-wrapper').html();
                updateCode();
            });
        });

        /* color picker */

        /* select the good one on load */

        $('#colorselector div').css('background-color', iconColor);

        /* instanciate colorpicker */

        $('#colorselector').ColorPicker({
            color: iconColor,
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);

                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);

                return false;
            },
            onChange: function (hsb, hex, rgb) {
                iconColor = '#' + hex;
                $('.selector .selector-icon').css('color', iconColor);
                $('#colorselector div').css('background-color', iconColor);
                $('#icon-test').css('color', iconColor);
                $('#iconpicker i').css('color', iconColor);
                $('.selector.select-color').removeClass('active');
                iconCode = $('#test-wrapper').html();
                updateCode();
            }
        });

        /* icon picker */

        $('#iconpicker').iconpicker({
            arrowClass: 'btn-success',
            arrowPrevIconClass: 'glyphicon glyphicon-chevron-left',
            arrowNextIconClass: 'glyphicon glyphicon-chevron-right',
            icon: '<?php echo $icon; ?>',
            iconset: '<?php echo $iconFont; ?>',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom',
            rows: 10,
            cols: 20,
            search: false,
            selectedClass: 'btn-success',
            unselectedClass: ''
        }).on('change', function (e) {
            changeIcon();
        });

        $('#iconpicker i').css('color', iconColor);

        /* icon */

        function changeIcon()
        {
            var newIcon = $('#iconpicker').find('input[type="hidden"]').prop('value');
            iconCode = iconCode.replace(icon, newIcon);
            $('.selector.select-size i').removeClass(icon).addClass(newIcon);
            $('#test-wrapper').html(iconCode);
            icon = newIcon;
            updateCode();
        }

        /* update code on load */

        if ($('.selector.select-size').hasClass('active')) {
            $('.selector.select-size.active').trigger('click');
        } else { // if custom size
            $('input[name="size-input"]').trigger('keyup');
        }
    });
</script>
</body>
</html>
