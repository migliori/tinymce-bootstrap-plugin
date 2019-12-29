<?php
include_once('conf/conf.php');

/* images path for file browser */

$get_path = parse_url($_GET['images_path']);
$img_dir = $get_path['path']; // ex : '/dir/img/' with or without slashes
$current_path = parse_url($_SERVER['HTTP_REFERER']);
$img_path = ''; // default
if (preg_match('`^/`', $img_dir)) { // absolute url sended
    $img_path = $img_dir;
    if (!preg_match('`/$`', $img_dir)) { // add final slash if needed
        $img_path .= '/';
    }
}
$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/'); // remove final slash if needed
if (!is_file($root . $img_path . 'secure.php')) {
    $security_msg = '<body><div class="container"><p>&nbsp;</p><p class="alert alert-danger">Your images dir is not authorized.</p><p class="text-center">Please create an empty file named <strong><i>secure.php</i></strong> and save it into <strong><i>' . $img_path . '</i></strong> to allow access.</p></div><body>';
}

if (isset($_GET['imgSrc'])) {
    $imgSrc        = preg_replace('/\r|\n/', '', urldecode($_GET['imgSrc']));
    $imgAlt        = preg_replace('/\r|\n/', '', urldecode($_GET['imgAlt']));
    $imgWidth      = preg_replace('/\r|\n/', '', urldecode($_GET['imgWidth']));
    $imgHeight     = preg_replace('/\r|\n/', '', urldecode($_GET['imgHeight']));
    $imgStyle      = preg_replace('/\r|\n/', '', urldecode($_GET['imgStyle']));
    $imgResponsive = preg_replace('/\r|\n/', '', urldecode($_GET['imgResponsive']));
    $imgCode       = build_image();
} else {
    $imgSrc        = str_replace('bootstrap-image.php', '', $_SERVER['SCRIPT_NAME']) . 'img/tinymce-bootstrap-plugin-small-preview.png';
    $imgAlt        = '';
    $imgWidth      = '';
    $imgHeight     = '';
    $imgStyle      = '';
    $imgResponsive = 'true';
    $imgCode       = build_image();
}

function build_image()
{
    global $imgSrc;
    global $imgAlt;
    global $imgWidth;
    global $imgHeight;
    global $imgStyle;
    global $imgResponsive;
      if (@getimagesize($imgSrc) || @getimagesize($_SERVER['DOCUMENT_ROOT'] . $imgSrc)) {
        $info = new SplFileInfo($imgSrc);
        if (preg_match('`jpg|jpeg|png|gif`', strtolower($info))) {
            $img = '<img src="' . $imgSrc . '"';
            if (!empty($imgWidth)) {
                $img .= ' width="' . $imgWidth . '"';
            }
            if (!empty($imgHeight)) {
                $img .= ' height="' . $imgHeight . '"';
            }
            $imgClass = '';
            if (!empty($imgStyle)) {
                $imgClass .= $imgStyle;
            }
            if ($imgResponsive !== 'false') {
                if (empty($imgClass)) {
                    $imgClass = 'img-responsive';
                } else {
                    $imgClass .= ' img-responsive';
                }
            }
            if (!empty($imgClass)) {
                $img .= ' class="' . $imgClass . '"';
            }
            $img .= ' alt="' . $imgAlt . '"';
            $img .= ' />';

            return $img;
        }
    } else {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="<?php echo $bootstrap_css_path; ?>">
    <link rel="stylesheet" href="css/plugin.min.css">
    <link href='jquery-file-tree/jqueryFileTree.css' rel='stylesheet' type='text/css'>
    <link href="<?php echo PRISM_CSS; ?>" type="text/css" rel="stylesheet" />
</head>
<?php
    if (isset($security_msg)) {
        exit($security_msg);
    }
?>
<body>
    <div class="container">
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo IMAGE; ?></span>
            </div>
            <div class="col-sm-6 text-center margin-bottom-md">
                <button type="button" class="btn btn-primary" id="browseBtn"><?php echo BROWSE; ?></button>
            </div>
            <div class="col-sm-6 text-center" id="thumb-div">
            <?php echo $imgCode; ?>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo IMAGE_STYLE; ?></span>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <div class="choice selector select-style">
                        <img src="<?php echo $imgSrc; ?>" class="" data-attr="none"><br><br>
                        <label>none</label>
                    </div>
                    <div class="choice selector select-style">
                        <img src="<?php echo $imgSrc; ?>" class="img-rounded"><br><br>
                        <label>rounded</label>
                    </div>
                    <div class="choice selector select-style">
                        <img src="<?php echo $imgSrc; ?>" class="img-circle"><br><br>
                        <label>circle</label>
                    </div>
                    <div class="choice selector select-style">
                        <img src="<?php echo $imgSrc; ?>" class="img-thumbnail"><br><br>
                        <label>thumbnail</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="choice-title">
                <span><?php echo OTHERS; ?></span>
            </div>
            <div class="text-center col-xs-10 col-xs-offset-1">
                <div class="form-horizontal col-sm-4">
                    <div class="form-group">
                        <label class="col-xs-6 text-right"><?php echo RESPONSIVE; ?> : </label>
                        <div class="btn-group btn-toggle col-xs-6" id="responsive">
                            <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                            <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-sm-4">
                    <div class="form-group">
                    <label class="col-xs-6 text-right" id="width-label"><?php echo WIDTH; ?> :</label>
                        <div class="input-group col-xs-6">
                            <input type="text"  class="form-control" name="img-width" id="img-width" value="<?php echo $imgWidth; ?>">
                            <span class="input-group-addon">px</span>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-sm-4">
                    <div class="form-group">
                    <label class="col-xs-6 text-right" id="height-label"><?php echo HEIGHT; ?> :</label>
                        <div class="input-group col-xs-6">
                            <input type="text"  class="form-control" name="img-height" id="img-height" value="<?php echo $imgHeight; ?>">
                            <span class="input-group-addon">px</span>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-sm-8 col-sm-offset-2">
                    <div class="form-group">
                        <label class="col-sm-4 col-xs-6 text-right" id="alt-label"><?php echo ALT_TEXT; ?> :</label>
                        <div class="col-sm-8 col-xs-6">
                            <input type="text" class="form-control" name="img-alt" value="<?php echo $imgAlt; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title" class="margin-bottom-md">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 margin-bottom-md center-img text-center test-icon-wrapper" id="test-wrapper">
                <?php echo $imgCode; ?>
            </div>
        </div>
        <div class="row">
            <div id="code-title">
                <a href="#" id="code-slide-link">code <i class="glyphicon glyphicon-arrow-up"></i></a>
            </div>
            <div class="col-sm-12 text-center" id="code-wrapper">
                <pre><?php
                    echo htmlspecialchars($imgCode);
                    ?></pre>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo JQUERY_JS ?>"></script>
<script type="text/javascript" src="<?php echo BOOTSTRAP_JS ?>"></script>
<script type="text/javascript" src="js/utils.min.js"></script>
<script type="text/javascript" src="js/jquery.htmlClean.min.js"></script>
<script type="text/javascript" src="jquery-file-tree/jqueryFileTree.js"></script>
<script type="text/javascript" src="<?php echo PRISM_JS; ?>"></script>
<script type="text/javascript">
    var imgSrc        = '<?php echo $imgSrc; ?>';
    var imgAlt        = '<?php echo $imgAlt; ?>';
    var imgWidth      = '<?php echo $imgWidth; ?>';
    var imgHeight     = '<?php echo $imgHeight; ?>';
    var imgStyle      = '<?php echo $imgStyle; ?>';
    var imgResponsive = <?php echo $imgResponsive; ?>;
    var imgCode       = '<?php echo $imgCode; ?>';
    var imgPath       = '<?php echo $img_path; ?>';
    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();

        /* file browser */

        $('#file-tree-wrapper').hide();
        $('#browseBtn').on('click', function () {
            $('#file-tree-content').fileTree({ root: imgPath }, function (file) {
                openFile(file);
            });
            $('#file-tree-wrapper').fadeIn(500);
        });
        $('#file-tree-wrapper').find('.btn-default').on('click', function () {
            $('#file-tree-wrapper').fadeOut(500);
        });

        /* image style */

        $('.selector.select-style').each(function (event, element) {

            /* set style on load */

            if (imgStyle === '') {
                if ($(element).find('img').attr('data-attr') == "none") {
                    $(element).addClass('active');
                }
            } else if ($(element).find('img').hasClass(imgStyle)) {
                $(element).addClass('active');
            }

            $(element).on('click', function (event) {
                $('.selector.select-style').removeClass('active');
                imgStyle = $(this).find('img').attr('class');
                $(this).addClass('active');
                $('#test-wrapper').find('img').removeClass('img-rounded').removeClass('img-circle').removeClass('img-thumbnail').addClass(imgStyle);
                updateCode();
            });
        });

        $('#responsive').on('click', changeImgResponsive);

        /* on load */

        updateCode();

        function changeImgResponsive()
        {
            var checked = toggleBtn(this);
            if (checked) {
                imgResponsive = true;
                $('#test-wrapper').find('img').addClass('img-responsive');
            } else {
                imgResponsive = false;
                $('#test-wrapper').find('img').removeClass('img-responsive');
            }
            updateCode();
        }

        /* change image responsive (enabled/disabled) */

        if (imgResponsive) { // on load
            $('#responsive').trigger('click');
        }

        /* image width / height */

        $('#img-width').on('keyup', function () {
            changeImgSize($(this).val(), 'width');
        });
        $('#img-height').on('keyup', function () {
            changeImgSize($(this).val(), 'height');
        });

        /* alt text */

        $('input[name="img-alt"]').on('keyup', changeImgAlt);

        function changeImgAlt()
        {
            imgAlt = $('input[name="img-alt"]').prop('value');
            $('#test-wrapper').find('img').attr('alt', imgAlt);
            updateCode();
        }

        /**
         * changeImgSize
         * @param  int val
         * @param  string widthHeight 'width' or 'height'
         * @return void
         */
        function changeImgSize(val, widthHeight)
        {
            if (val % 1 === 0) { // check if val is an integer
                $('#test-wrapper').find('img').attr(widthHeight, val);
            } else {
                $('#test-wrapper').find('img').removeAttr(widthHeight);
            }
            updateCode();
        }

        function openFile(file)
        {
            var extension = file.substr( (file.lastIndexOf('.') +1) ).toLowerCase();
            switch (extension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    $('#image-file-preview').html('<img src="' + file + '" alt="">');
                    $('#file-tree-wrapper').find('.btn-primary').removeAttr('disabled').on('click', function () {
                        imgSrc = file;
                        var img = $('<img>');
                        img.attr('src', imgSrc).attr('alt', imgAlt);
                        if (imgWidth !== '') {
                            img.attr('width', imgWidth);
                        }
                        if (imgHeight !== '') {
                            img.attr('width', imgHeight);
                        }
                        if (imgStyle !== '') {
                            img.addClass(imgStyle);
                        }
                        if (imgResponsive) {
                            img.addClass('img-responsive');
                        }
                        $('#thumb-div').html($('#image-file-preview').html());
                        $('#test-wrapper').html(img);
                        updateCode();
                        $('#file-tree-wrapper').fadeOut(500);
                        $('#image-file-preview').find('.btn-primary').attr('disabled');
                    });
                break;
                default:
                $('#image-file-preview').html('<p class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo PLEASE_CHOOSE_AN_IMAGE ?></p>');
                $('#image-file-preview').find('.btn-primary').attr('disabled');
                break;
            }
        }
    });
</script>
<div id="file-tree-wrapper">
    <div id="file-tree">
    <div id="file-tree-content"></div>
    <p></p>
    <div class="row">
        <div class="choice-title margin-bottom-md">
            <span class="btn-primary"><?php echo PREVIEW; ?></span>
        </div>
        <div class="col-md-12">
            <div id="image-file-preview"></div>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary" disabled="disabled"><?php echo OK; ?></button>
                    <button type="button" class="btn btn-default"><?php echo CANCEL; ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
