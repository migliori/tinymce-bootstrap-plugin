/**
 * TinyMce Bootstrap plugin
 *
 * @version 2.3.2
 * @author Gilles Migliori - gilles.migliori@gmail.com
 *
 */

/**
 * Iconpicker Iconsets & classes :
 * glyphicon      => .glyphicon
 * ionicon        => [class*="ion-"]
 * fontawesome    => .fa
 * weathericon    => .wi
 * mapicon        => [class*="map-icon-"]
 * octicon        => .octicon
 * typicon        => .typcn
 * elusiveicon    => [class*="el-icon-"]
 * materialdesign => [class*="md-"]
 */

/*jshint globalstrict: true, unused:false*/
/*global jQuery, jQuery, tinymce, window, document*/
'use strict';

tinymce.PluginManager.requireLangPack('bootstrap');
tinymce.PluginManager.add('bootstrap', function(editor, url) {

    var iFrameDefaultWidth = 885,
        bootstrapElements,
        menuType,
        dropdownText,
        bootstrapDefaultCssPath,
        bootstrapCssPath,
        bootstrapIcon = [],
        DefaultImagesPath,
        imagesPath;

    if(typeof(editor.settings.bootstrapConfig) == 'undefined') {
        editor.settings.bootstrapConfig = [
        ];
    }

    /* Default Bootstrap Elements */

    if(typeof(editor.settings.bootstrapConfig.bootstrapElements) == 'undefined') {
        editor.settings.bootstrapConfig.bootstrapElements = {
            'btn': true,
            'icon': true,
            'image': true,
            'table': true,
            'template': true,
            'breadcrumb': true,
            'pagination': true,
            'pager': true,
            'label': true,
            'badge': true,
            'alert': true,
            'panel': true,
            'snippet': true
        };
    }

    bootstrapElements = editor.settings.bootstrapConfig.bootstrapElements;

    /* Set valid elements to prevent tinymce from removing glyphicon or other empty tags */

    if ((editor.settings.verify_html !== false || editor.settings.valid_elements !== '*[*]') && editor.settings.bootstrapConfig.overwriteValidElements !== false) {
        editor.settings.valid_elements = getValidElements();
    }

    /* Default Menu type (buttongroup|dropdownMenu) */

    if(typeof(editor.settings.bootstrapConfig.type) == 'undefined') {
        editor.settings.bootstrapConfig.type = 'buttongroup';
    }

    menuType = editor.settings.bootstrapConfig.type;

    /* Default text for dropdownMenu */

    if(typeof(editor.settings.bootstrapConfig.dropdownText) == 'undefined') {
        editor.settings.bootstrapConfig.dropdownText = 'Elements';
    }

    dropdownText = editor.settings.bootstrapConfig.dropdownText;

    /* Default Bootstrap css path */

    if(typeof(editor.settings.bootstrapConfig.bootstrapCssPath) == 'undefined') {
        bootstrapDefaultCssPath = url + '/css/bootstrap.min.css';
        editor.settings.bootstrapConfig.bootstrapCssPath = bootstrapDefaultCssPath;
    }
    bootstrapCssPath = editor.settings.bootstrapConfig.bootstrapCssPath;

    /* Default Icon font */

    if(typeof(editor.settings.bootstrapConfig.bootstrapIconFont) == 'undefined') {
        bootstrapIcon.defaultFont = 'glyphicon';
        editor.settings.bootstrapConfig.bootstrapIconFont = bootstrapIcon.defaultFont;
    }
    bootstrapIcon.font = editor.settings.bootstrapConfig.bootstrapIconFont;

    /* set search type & parameter to look for icon */

    if(bootstrapIcon.font == 'glyphicon') {
        bootstrapIcon.searchClass = 'glyphicon-';
    } else if(bootstrapIcon.font == 'ionicon') {
        bootstrapIcon.searchClass = 'ion-';
    } else if(bootstrapIcon.font == 'fontawesome') {
        bootstrapIcon.searchClass = 'fa-';
    } else if(bootstrapIcon.font == 'weathericon') {
        bootstrapIcon.searchClass = 'wi-';
    } else if(bootstrapIcon.font == 'mapicon') {
        bootstrapIcon.searchClass = 'map-icon-';
    } else if(bootstrapIcon.font == 'octicon') {
        bootstrapIcon.searchClass = 'octicon-';
    } else if(bootstrapIcon.font == 'typicon') {
        bootstrapIcon.searchClass = 'typcn-';
    } else if(bootstrapIcon.font == 'elusiveicon') {
        bootstrapIcon.searchClass = 'el-icon-';
    } else if(bootstrapIcon.font == 'materialdesign') {
        bootstrapIcon.searchClass = 'md-';
    }

    /* Default Images path */

    if(typeof(editor.settings.bootstrapConfig.imagesPath) == 'undefined') {
        DefaultImagesPath = url + '/';
        editor.settings.bootstrapConfig.imagesPath = {'imagesPath': DefaultImagesPath};
    }
    imagesPath = editor.settings.bootstrapConfig.imagesPath;

    /* Snippet Management (Allow / Disallow) */

    if(typeof(editor.settings.bootstrapConfig.bootstrapElements.snippet === true && editor.settings.bootstrapConfig.allowSnippetManagement) == 'undefined') {
        editor.settings.bootstrapConfig.allowSnippetManagement = true;
    }

    /* Add Bootstrap css + icons css to editor */

    var content_css = editor.settings.content_css;
    var icon_css;
    if(typeof(content_css) == 'undefined') {
        content_css = bootstrapCssPath + ',' + url + '/css/editor-content.min.css';
    } else {
        content_css = bootstrapCssPath + ',' + content_css + ',' + url + '/css/editor-content.min.css';
    }
    if(bootstrapIcon.font == 'glyphicon') {
        icon_css = '';
    } else if(bootstrapIcon.font == 'ionicon') {
        icon_css = 'ionicons.min.css';
    } else if(bootstrapIcon.font == 'fontawesome') {
        icon_css = 'font-awesome.min.css';
    } else if(bootstrapIcon.font == 'weathericon') {
        icon_css = 'weather-icons.min.css';
    } else if(bootstrapIcon.font == 'mapicon') {
        icon_css = 'map-icons.min.css';
    } else if(bootstrapIcon.font == 'octicon') {
        icon_css = 'octicons.min.css';
    } else if(bootstrapIcon.font == 'typicon') {
        icon_css = 'typicons.min.css';
    } else if(bootstrapIcon.font == 'elusiveicon') {
        icon_css = 'elusive-icons.min.css';
    } else if(bootstrapIcon.font == 'materialdesign') {
        icon_css = 'material-design-iconic-font.min.css';
    }
    if(icon_css !== '') {
        content_css += ',' + url + '/css/iconpicker/css/' + icon_css;
    }
    editor.settings.content_css = content_css;

    /**
     * look for current icon class in element class
     * @param  object   selectedNode
     * @return Boolean
     */
    function isIcon(selectedNode)
    {
        if(selectedNode.is('[class*="' + bootstrapIcon.searchClass + '"]')) {

            return true;
        }

        return false;
    }

    /**
     * Open iframe dialog,
     * Get and transmit selected element attributes to iframe
     * @param  string iframeUrl
     * @param  string iframeTitle
     * @param  string iframeHeight
     * @param  string type      the dialog to display
     * (bsBtn|bsIcon|bsImage|bsTable|bsTemplate|bsBreadcrumb|bsPagination|bsPager|bsLabel|bsBadge|bsAlert|bsPanel|bsSnippet)
     * @return void
     */
    function showDialog(iframeUrl, iframeTitle, iframeHeight, type)
    {

        /* get selected element values to transmit to iframe */

        var selectedNode = getSelectedNode('showDialog');
        var nodeAttributes = '';
        if(jQuery(selectedNode).hasClass('active')) {
            if(jQuery(selectedNode).hasClass('btn')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsBtn');
            } else if(isIcon(jQuery(selectedNode))) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsIcon');
            } else  if(jQuery(selectedNode).is('img')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsImage');
            } else if(jQuery(selectedNode).hasClass('table')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsTable');
            } else if(jQuery(selectedNode).hasClass('breadcrumb')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsBreadcrumb');
            } else if(jQuery(selectedNode).hasClass('pagination')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsPagination');
            } else if(jQuery(selectedNode).hasClass('pager')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsPager');
            } else if(jQuery(selectedNode).hasClass('label')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsLabel');
            } else if(jQuery(selectedNode).hasClass('badge')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsBadge');
            } else if(jQuery(selectedNode).hasClass('alert')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsAlert');
            } else if(jQuery(selectedNode).hasClass('panel')) {
                nodeAttributes = getNodeAttributes(selectedNode, 'bsPanel');
            }
        }
        var getTheHtml = function (){
            var html = '';
            var language = editor.getParam('language');
            if(!language) {
                language = 'en_EN';
            }
            html += '<input type="hidden" name="bs-code" id="bs-code" />';
            var qrySign = '?';
            if(iframeUrl.match(/\?/)) {
                qrySign = '&';
            }
            html += '<iframe src="'+ url + '/' + iframeUrl + qrySign + 'language=' + language + '&images_path=' + imagesPath + '&bootstrap_css_path=' + bootstrapCssPath + '&iconFont=' + bootstrapIcon.font + '&' + nodeAttributes + '&' + new Date().getTime() + '"></iframe>';

            return html;
        };

        var iFrameWidth = iFrameDefaultWidth;

        if(jQuery(window).width() < 885) {
            iFrameWidth = jQuery(window).width()*0.9;
        }

        if(jQuery(window).height() > iframeHeight) {
            iframeHeight = (jQuery(window).height()*0.9) - 90;
        }

        var win = editor.windowManager.open({
            title: iframeTitle,
            width : iFrameWidth,
            height : iframeHeight,
            html: getTheHtml(),
            buttons: [
                {
                    text: 'OK',
                    subtype: 'primary',
                    onclick: function(element) {
                        renderContent(element, type);
                        this.parent().parent().close();
                    }
                },
                {
                    text: 'Cancel',
                    onclick: function() {
                        this.parent().parent().close();
                    }
                }
            ]
        });

        /* OK / Cancel buttons position for responsive */

        jQuery('.mce-floatpanel').find('.mce-widget.mce-abs-layout-item.mce-first').css({'left':'auto', 'right':'82px'});
        jQuery('.mce-floatpanel').find('.mce-widget.mce-last.mce-abs-layout-item').css({'left':'auto', 'right':'10px'});

        jQuery(window).on('resize', function() {
            resizeDialog();
        });
    }

    function resizeDialog()
    {
        var iFrameWidth = iFrameDefaultWidth;
        if(jQuery(window).width() > iFrameDefaultWidth) {
            iFrameWidth = iFrameDefaultWidth;
        } else {
            iFrameWidth = jQuery(window).width()*0.9;
        }
        jQuery('.mce-floatpanel').width(iFrameWidth).css('left', (jQuery(window).width() - iFrameWidth) / 2);
        jQuery('.mce-floatpanel').find('.mce-container-body, .mce-foot, .mce-abs-layout').width(iFrameWidth);
        if(iFrameWidth < 768) {
            jQuery('.mce-edit-area iframe').contents().find('.container').addClass('container-xs');
        } else {
            jQuery('.mce-edit-area iframe').contents().find('.container').removeClass('container-xs');
        }
    }

    /**
     * gets the selected node in editor, or the active parent matching a bootstrap element
     * @return matching bootstrap element
     */
    function getSelectedNode(callingFunction)
    {
        var selectedNode = editor.selection.getNode();
        /*if(callingFunction == 'renderContent' && !jQuery(selectedNode).is('th') && !jQuery(selectedNode).is('td') && jQuery(selectedNode).closest('.breadcrumb').length < 1) {
            return selectedNode;
        }*/
        if(!jQuery(selectedNode).hasClass('active') || jQuery(selectedNode).closest('.table').length > 0 || jQuery(selectedNode).closest('ol.breadcrumb').length > 0 || jQuery(selectedNode).closest('ul.pagination').length > 0 || jQuery(selectedNode).closest('ul.pager').length > 0 || jQuery(selectedNode).closest('div.alert').length > 0) { // li without link HAS class 'active' in bootstrap

            /* look for .table|.breadcrumb|.pagination|.pager|.alert|.panel in parents */

            var classes = ['.table', '.breadcrumb', '.pagination', '.pager', '.alert', '.panel'];
            var found = false;

            for (var i = 0; i < classes.length; i++) {
                if(jQuery(selectedNode).closest(classes[i]).length > 0 && found === false) {
                    selectedNode = jQuery(selectedNode).closest(classes[i]);
                    found = true;
                }
            }
        }
        return selectedNode;
    }

    /**
     * insert|update editor content
     * @param  string element the 'ok' button of iframe
     * @param  string type    type of content to insert|update
     *                        (bsBtn|bsIcon|bsImage|bsTable|bsTemplate|bsBreadcrumb|bsPagination|bsPager|bsLabel|bsBadge|bsAlert|bsPanel)
     * @return void
     */
    function renderContent(element, type)
    {
        var markup = htmlDecode(document.getElementById('bs-code').value);
        var selectedNode = getSelectedNode('renderContent');
        if(jQuery(selectedNode).hasClass('active') || jQuery(selectedNode).siblings().hasClass('active')) {

            /* insert new content */

            jQuery(selectedNode).after(markup);

            /* remove old content */

            var typesClasses = {
                'bsBtn': 'btn',
                'bsIcon': bootstrapIcon.searchClass,
                'bsImage': 'img',
                'bsTable': 'table',
                'bsBreadcrumb': 'breadcrumb',
                'bsPagination': 'pagination',
                'bsPager': 'pager',
                'bsLabel': 'label',
                'bsBadge': 'badge',
                'bsAlert': 'alert',
                'bsPanel': 'panel'
            };

            for(var key in typesClasses)
            {
              var value = typesClasses[key];
                if(type == key) {
                    if(type == 'bsImage' && jQuery(selectedNode).is('img')) {
                        editor.dom.remove(selectedNode);
                    } else if(jQuery(selectedNode).hasClass(value) || jQuery(selectedNode).is('[class*="' + value + '"]')) { // remove old element (is(value) is for icon class))
                        editor.dom.remove(selectedNode);
                    }
                }
            }
        } else {

            /* if none selected, insert new content */

            editor.insertContent(markup);
        }
        /* remove the '<br data-mce-bogus="1"> added by tinyMce in pagination with firefox */
        editor.dom.remove(editor.dom.select('li > br[data-mce-bogus="1"]'));
    }

    function getIconClass(selectedNode)
    {
        var iconClass = '',
            elClasses = jQuery(selectedNode).attr('class').split(' '),
            reg = new RegExp(bootstrapIcon.searchClass, 'g');
        jQuery.each(elClasses, function (index, value) {
            if(value.match(reg)) {
                iconClass = value;
            }
        });

        return iconClass;
    }

    /**
     * get selected node attributes to transmit to iframe
     * @param  string selectedNode
     * @param  string type         type of the clicked btn
     *                             (bsBtn|bsIcon|bsImage|bsTable|bsTemplate|bsBreadcrumb|bsPagination|bsPager|bsLabel|bsBadge|bsAlert|bsPanel)
     * @return string              node attributes
     */
    function getNodeAttributes(selectedNode, type)
    {
        var urlString = '';
        if(type == 'bsBtn') {
            var i;
            var btnCode = jQuery(selectedNode)[0].outerHTML.replace(' active', '');
            var btnIcon = '';
            if(jQuery(selectedNode).find('span')[0]) {
                btnIcon = getIconClass(jQuery(selectedNode).find('span').get(0));
            }
            var iconFont  = bootstrapIcon.font;
            var styles = new Array('default', 'btn-primary', 'btn-success', 'btn-info', 'btn-warning', 'btn-danger');
            var btnStyle = '';
            for (i = styles.length - 1; i >= 0; i--) {
                if(jQuery(selectedNode).hasClass(styles[i])) {
                    btnStyle = styles[i];
                }
            }
            var sizes = new Array('btn-xs', 'btn-sm', 'btn-lg');
            var btnSize = '';
            for (i = sizes.length - 1; i >= 0; i--) {
                if(jQuery(selectedNode).hasClass(sizes[i])) {
                    btnSize = sizes[i];
                }
            }
            var btnTag = jQuery(selectedNode).prop('tagName').toLowerCase();
            var btnHref = '';
            if(btnTag == 'a') {
                btnHref = jQuery(selectedNode).attr('href');
            }
            var btnType = '';
            if(btnTag == 'button' || btnTag == 'input') {
                btnType = jQuery(selectedNode).attr('type');
            }
            var btnText;
            if(btnTag == 'button' || btnTag == 'a') {
                btnText = jQuery(selectedNode).remove('i').text();
            } else {
                btnText = jQuery(selectedNode).val();
            }
            var iconPos = 'prepend';
            if(jQuery(selectedNode).find('span')[0]) {
                var reg = new RegExp('/^' + btnText + '/');
                if(reg.test(jQuery(selectedNode).html()) === true) {
                    iconPos = 'append';
                }
            }
            btnCode   = encodeURIComponent(btnCode);
            btnIcon   = encodeURIComponent(btnIcon);
            btnStyle  = encodeURIComponent(btnStyle);
            btnSize   = encodeURIComponent(btnSize);
            btnTag    = encodeURIComponent(btnTag);
            btnHref   = encodeURIComponent(btnHref);
            btnType   = encodeURIComponent(btnType);
            btnText   = encodeURIComponent(btnText);
            iconFont  = encodeURIComponent(iconFont);
            iconPos   = encodeURIComponent(iconPos);
            urlString =  'btnCode=' + btnCode + '&btnIcon=' + btnIcon + '&btnStyle=' + btnStyle + '&btnSize=' + btnSize + '&btnTag=' + btnTag + '&btnHref=' + btnHref + '&btnType=' + btnType + '&btnText=' + btnText + '&iconFont=' + iconFont + '&iconPos=' + iconPos;
        }
        else if(type == 'bsImage') {
            var imgSrc       = jQuery(selectedNode).attr('src');
            var imgAlt       = '';
            var imgWidth     = '';
            var imgHeight    = '';
            var imgStyle     = '';
            var imgResponsive = 'false';
            if(jQuery(selectedNode).hasClass('img-rounded')) {
                imgStyle = 'img-rounded';
            } else if(jQuery(selectedNode).hasClass('img-circle')) {
                imgStyle = 'img-circle';
            } else if(jQuery(selectedNode).hasClass('img-thumbnail')) {
                imgStyle = 'img-thumbnail';
            }
            if(jQuery(selectedNode).hasClass('img-responsive')) {
                imgResponsive = 'true';
            }
            if(jQuery(selectedNode).attr('alt')) {
                imgAlt       = jQuery(selectedNode).attr('alt');
            }
            if(jQuery(selectedNode).attr('width')) {
                imgWidth       = jQuery(selectedNode).attr('width');
            }
            if(jQuery(selectedNode).attr('height')) {
                imgHeight       = jQuery(selectedNode).attr('height');
            }
            imgSrc    = encodeURIComponent(imgSrc);
            imgAlt    = encodeURIComponent(imgAlt);
            imgWidth  = encodeURIComponent(imgWidth);
            imgHeight = encodeURIComponent(imgHeight);
            imgStyle  = encodeURIComponent(imgStyle);
            urlString =  'imgSrc=' + imgSrc + '&imgAlt=' + imgAlt + '&imgWidth=' + imgWidth + '&imgHeight=' + imgHeight + '&imgStyle=' + imgStyle + '&imgResponsive=' + imgResponsive;
        } else if(type == 'bsIcon') {
            var icon      = getIconClass(selectedNode);
            var iconSize  = jQuery(selectedNode).css('font-size');
            var iconColor = jQuery(selectedNode).css('color');
            icon      = encodeURIComponent(icon);
            iconSize  = encodeURIComponent(iconSize);
            iconColor = encodeURIComponent(iconColor);
            urlString =  'icon=' + icon + '&iconSize=' + iconSize + '&iconColor=' + iconColor;
        }
        else if(type == 'bsTable') {
            selectedNode = jQuery(selectedNode).closest('.table');
            var tableStriped    = 'false';
            var tableBordered   = 'false';
            var tableHover      = 'false';
            var tableCondensed  = 'false';
            var tableResponsive = 'false';
            if(jQuery(selectedNode).hasClass('table-striped')) {
                tableStriped = 'true';
            }
            if(jQuery(selectedNode).hasClass('table-bordered')) {
                tableBordered = 'true';
            }
            if(jQuery(selectedNode).hasClass('table-hover')) {
                tableHover = 'true';
            }
            if(jQuery(selectedNode).hasClass('table-condensed')) {
                tableCondensed = 'true';
            }
            if(jQuery(selectedNode).hasClass('table-responsive')) {
                tableResponsive = 'true';
            }
            urlString =  'tableStriped=' + tableStriped + '&tableBordered=' + tableBordered + '&tableHover=' + tableHover + '&tableCondensed=' + tableCondensed + '&tableResponsive=' + tableResponsive;
        }
        else if(type == 'bsBreadcrumb' || type == 'bsPagination' || type == 'bsPager' || type == 'bsLabel' || type == 'bsBadge' || type == 'bsAlert'| type == 'bsPanel') {
            urlString =  'edit=true';
        }

        return urlString.replace(/(\r\n|\n|\r)/gm, '');
    }

    function htmlDecode(input){
        var e = document.createElement('div');
        e.innerHTML = input;
        return e.childNodes.length === 0 ? '' : e.childNodes[0].nodeValue;
    }

    // Add custom css for toolbar icons

    editor.on('init', function()
    {
        var cssURL = url + '/css/editor.min.css';
        if(document.createStyleSheet){
            document.createStyleSheet(cssURL);
        } else {
            var cssLink = editor.dom.create('link', {
                        rel: 'stylesheet',
                        href: cssURL
                      });
            document.getElementsByTagName('head')[0].
                      appendChild(cssLink);
        }

        /* get custom background color */

        var tinymceBackgroundColor = editor.settings.bootstrapConfig.tinymceBackgroundColor;
        if(tinymceBackgroundColor !== '') {
            editor.dom.addStyle('.mce-content-body {background-color: ' + tinymceBackgroundColor + ' !important}');
        }
        initCallbackEvents();
    });

    /**
     * toggle visual aid for templates
     * @return void
     */
    function toggleVisualAid()
    {
        if(editor.hasVisual) {
            editor.dom.addClass(editor.dom.select('.mce-content-body '), 'hasVisual');
        } else {
            editor.dom.removeClass(editor.dom.select('.mce-content-body '), 'hasVisual');
        }
    }

    /* callback events to select bootstrap elements on click and allow updates */

    /**
     * initCallbackEvents
     * @return void
     */
    function initCallbackEvents()
    {
        toggleVisualAid();
        editor.on('ExecCommand', function(e) {
            if(e.command == 'mceToggleVisualAid'); {
                toggleVisualAid();
            }
        });
        toggleVisualAid();
        editor.on('click keyup', function(e) {
            var elementSelector = '';
            var editorBtnName = '';
            if(jQuery(e.target).is('img')) { // image
                elementSelector = 'img';
                editorBtnName = 'insertImageBtn';
            } else if(jQuery(e.target).attr('class')) {
                if(jQuery(e.target).attr('class').match(/btn/)) {
                    elementSelector = '.btn';
                    editorBtnName = 'insertBtnBtn';
                } else if(isIcon(jQuery(e.target))) {
                    elementSelector = 'icon';
                    editorBtnName = 'insertIconBtn';
                } else if(jQuery(e.target).attr('class').match(/label/)) {
                    elementSelector = '.label';
                    editorBtnName = 'insertLabelBtn';
                } else if(jQuery(e.target).attr('class').match(/badge/)) {
                    elementSelector = '.badge';
                    editorBtnName = 'insertBadgeBtn';
                } else if(jQuery(e.target).attr('class').match(/alert/)) {
                    elementSelector = '.alert';
                    editorBtnName = 'insertAlertBtn';
                }
            } else if(jQuery(e.target).closest('.table').attr('class')) { // table
                elementSelector = '.table';
                editorBtnName = 'insertTableBtn';
            } else if(jQuery(e.target).closest('.breadcrumb').attr('class')) { // breadcrumb
                elementSelector = '.breadcrumb';
                editorBtnName = 'insertBreadcrumbBtn';
            } else if(jQuery(e.target).closest('.pagination').attr('class')) { // pagination
                elementSelector = '.pagination';
                editorBtnName = 'insertPaginationBtn';
            } else if(jQuery(e.target).closest('.pager').attr('class')) { // pager
                elementSelector = '.pager';
                editorBtnName = 'insertPagerBtn';
            } else if(jQuery(e.target).closest('.alert').attr('class')) { // alert
                elementSelector = '.alert';
                editorBtnName = 'insertAlertBtn';
            } else if(jQuery(e.target).closest('.panel').attr('class')) { // panel
                elementSelector = '.panel';
                editorBtnName = 'insertPanelBtn';
            }

            /* deactivate all previous activated */

            deactivateAll();

            if(elementSelector === '') {
                return;
            }

            /* activate current */

            activate(e.target, elementSelector, editorBtnName);
        });
        deactivateAll(); // onLoad
    }

    function activate(element, elementSelector, editorBtnName)
    {
        if(elementSelector == 'icon') {
            editor.selection.setCursorLocation(element);
        } else if(elementSelector == '.btn' && jQuery(element).is('input') !== true) {
            editor.selection.setCursorLocation(element, true);
        }
        if(elementSelector == '.table') {
            jQuery(element).closest('.table').addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        } else if(elementSelector == '.breadcrumb') {
            jQuery(element).closest('.breadcrumb').addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        } else if(elementSelector == '.pagination') {
            jQuery(element).closest('.pagination').addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        } else if(elementSelector == '.pager') {
            jQuery(element).closest('.pager').addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        } else if(elementSelector == '.alert') {
            jQuery(element).closest('.alert').addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        } else if(elementSelector == '.panel') {
            jQuery(element).closest('.panel').addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        } else {
            jQuery(element).addClass('active');
            toggleEditorButton(editorBtnName, 'on');
        }
    }

    function deactivateAll()
    {
        var elements = new Array('.btn', '[class*="' + bootstrapIcon.searchClass + '"]', 'img', '.table', '.breadcrumb', '.pagination', '.pager', '.label', '.badge', '.alert', '.panel');
        for (var i = 0; i < elements.length; i++) {
            jQuery(editor.dom.select(elements[i])).removeClass('active');
        }
        var editorBtns;
        if(menuType == 'buttongroup') {
            editorBtns = editor.buttons.bootstrap.items;
        } else {
            editorBtns = editor.buttons.bootstrap.menu;
        }
        for (var j = editorBtns.length - 1; j >= 0; j--) {
            editorBtns[j].active(false);
        }
    }

    function toggleEditorButton(editorBtnName, onOff)
    {
        var editorBtns;
        if(menuType == 'buttongroup') {
            editorBtns = editor.buttons.bootstrap.items;
        } else {
            editorBtns = editor.buttons.bootstrap.menu;
        }
        for (var i = editorBtns.length - 1; i >= 0; i--) {
            if(editorBtnName == 'allBtns' || editorBtns[i]._name == editorBtnName) {
                if(onOff == 'on') {
                    editorBtns[i].active(true);
                }
            }
        }
    }

    // Create and render a buttongroup with buttons

    var bsItems = [],
        elType  = 'button',
        elClass = 'widget btn bs-icon-btn',
        text    = {},
        bsText  = [],
        bsTip   = [];
        text.button     = 'Button';
        text.image      = 'Image';
        text.icon       = 'Icon';
        text.table      = 'Table';
        text.template   = 'Template';
        text.breadcrumb = 'Breadcrumb';
        text.pagination = 'Pagination';
        text.pager      = 'Pager';
        text.label      = 'Label';
        text.badge      = 'Badge';
        text.alert      = 'Alert';
        text.panel      = 'Panel';
        text.snippet    = 'Snippet';
        jQuery.each(text, function(key, val) {
            bsText[key] = val;
            bsTip[key] = 'Insert/Edit ' + val;
        });
    if(menuType == 'buttongroup') {
        jQuery.each(text, function(key, val) {
             bsText[key] = '';
        });
    } else {
        elType = 'menuitem';
        elClass = 'bs-list-icon-btn';
    }
    if(menuType == 'buttongroup') {
        var bs3Btn = tinymce.ui.Factory.create({
            type: elType,
            text: '',
            classes: elClass,
            icon: 'bootstrap-icon',
            tooltip: 'Bootstrap Elements'
        });
        bsItems.push(bs3Btn);
    }
    if(bootstrapElements.btn) {
        var insertBtn = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['button'],
            icon: 'icon-btn',
            name: 'insertBtnBtn',
            tooltip: bsTip['button'],
            onclick: function() {
                showDialog('bootstrap-btn.php', 'Insert/Edit Bootstrap Button', 580, 'bsBtn');
            }
        });
        bsItems.push(insertBtn);
    }
    if(bootstrapElements.image) {
        var insertImage = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['image'],
            icon: 'icon-image',
            name: 'insertImageBtn',
            tooltip: bsTip['image'],
            onclick: function() {
                showDialog('bootstrap-image.php', 'Insert/Edit Bootstrap Image', 580, 'bsImage');
            }
        });
        bsItems.push(insertImage);
    }
    if(bootstrapElements.icon) {
        var insertIcon = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['icon'],
            icon: 'icon-icon',
            name: 'insertIconBtn',
            tooltip: bsTip['icon'],
            onclick: function() {
                showDialog('bootstrap-icon.php', 'Insert/Edit Bootstrap Icon', 450, 'bsIcon');
            }
        });
        bsItems.push(insertIcon);
    }
    if(bootstrapElements.table) {
        var insertTable = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['table'],
            icon: 'icon-table',
            name: 'insertTableBtn',
            tooltip: bsTip['table'],
            onclick: function() {
                showDialog('bootstrap-table.php', 'Insert/Edit Bootstrap Table', 620, 'bsTable');
            }
        });
        bsItems.push(insertTable);
    }
    if(bootstrapElements.template) {
        var insertTemplate = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['template'],
            icon: 'icon-template',
            name: 'insertTemplateBtn',
            tooltip: bsTip['template'],
            onclick: function() {
                showDialog('bootstrap-template.php', 'Insert Bootstrap Template', 580, 'bsTemplate');
            }
        });
        bsItems.push(insertTemplate);
    }
    if(bootstrapElements.breadcrumb) {
        var insertBreadcrumb = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['breadcrumb'],
            icon: 'icon-breadcrumb',
            name: 'insertBreadcrumbBtn',
            tooltip: bsTip['breadcrumb'],
            onclick: function() {
                showDialog('bootstrap-breadcrumb.php', 'Insert/Edit Bootstrap Breadcrumb', 580, 'bsBreadcrumb');
            }
        });
        bsItems.push(insertBreadcrumb);
    }
    if(bootstrapElements.pagination) {
        var insertPagination = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['pagination'],
            icon: 'icon-pagination',
            name: 'insertPaginationBtn',
            tooltip: bsTip['pagination'],
            onclick: function() {
                showDialog('bootstrap-pagination.php', 'Insert/Edit Bootstrap Pagination', 650, 'bsPagination');
            }
        });
        bsItems.push(insertPagination);
    }
    if(bootstrapElements.pager) {
        var insertPager = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['pager'],
            icon: 'icon-pager',
            name: 'insertPagerBtn',
            tooltip: bsTip['pager'],
            onclick: function() {
                showDialog('bootstrap-pager.php', 'Insert/Edit Bootstrap Pager', 450, 'bsPager');
            }
        });
        bsItems.push(insertPager);
    }
    if(bootstrapElements.label) {
        var insertLabel = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['label'],
            icon: 'icon-label',
            name: 'insertLabelBtn',
            tooltip: bsTip['label'],
            onclick: function() {
                showDialog('bootstrap-label.php', 'Insert/Edit Bootstrap Label', 350, 'bsLabel');
            }
        });
        bsItems.push(insertLabel);
    }
    if(bootstrapElements.badge) {
        var insertBadge = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['badge'],
            icon: 'icon-badge',
            name: 'insertBadgeBtn',
            tooltip: bsTip['badge'],
            onclick: function() {
                showDialog('bootstrap-badge.php', 'Insert/Edit Bootstrap Badge', 350, 'bsBadge');
            }
        });
        bsItems.push(insertBadge);
    }
    if(bootstrapElements.alert) {
        var insertAlert = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['alert'],
            icon: 'icon-alert',
            name: 'insertAlertBtn',
            tooltip: bsTip['alert'],
            onclick: function() {
                showDialog('bootstrap-alert.php', 'Insert/Edit Bootstrap Alert', 580, 'bsAlert');
            }
        });
        bsItems.push(insertAlert);
    }
    if(bootstrapElements.panel) {
        var insertPanel = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['panel'],
            icon: 'icon-panel',
            name: 'insertPanelBtn',
            tooltip: bsTip['panel'],
            onclick: function() {
                showDialog('bootstrap-panel.php', 'Insert/Edit Bootstrap Panel', 650, 'bsPanel');
            }
        });
        bsItems.push(insertPanel);
    }
    if(bootstrapElements.snippet) {
        var insertSnippet = tinymce.ui.Factory.create({
            type: elType,
            classes: elClass,
            text: bsText['snippet'],
            icon: 'icon-snippet',
            name: 'insertSnippetBtn',
            tooltip: bsTip['snippet'],
            onclick: function() {
                showDialog('bootstrap-snippet.php?allowEdit=' + editor.settings.bootstrapConfig.allowSnippetManagement, 'Insert Snippet', 650, 'bsSnippet');
            }
        });
        bsItems.push(insertSnippet);
    }
    if(menuType == 'buttongroup') {
        editor.addButton('bootstrap', {
            type: 'buttongroup',
            classes: 'bs-btn',
            items: bsItems
        });
    } else {
        editor.addButton('bootstrap', {
            type: 'menubutton',
            text: dropdownText,
            icon: false,
            menu: bsItems
        });
    }

    /**
     * set tinymce valid_elements according to html5 shema
     * based on veprbl / html5_valid_elements.js
     * https://gist.github.com/veprbl/1136304
     * @return string
     */
    function getValidElements()
    {
        var valid_elements = '@[accesskey|draggable|style|class|hidden|tabindex|contenteditable|id|title|contextmenu|lang|dir<ltr?rtl|spellcheck|onabort|onerror|onmousewheel|onblur|onfocus|onpause|oncanplay|onformchange|onplay|oncanplaythrough|onforminput|onplaying|onchange|oninput|onprogress|onclick|oninvalid|onratechange|oncontextmenu|onkeydown|onreadystatechange|ondblclick|onkeypress|onscroll|ondrag|onkeyup|onseeked|ondragend|onload|onseeking|ondragenter|onloadeddata|onselect|ondragleave|onloadedmetadata|onshow|ondragover|onloadstart|onstalled|ondragstart|onmousedown|onsubmit|ondrop|onmousemove|onsuspend|ondurationmouseout|ontimeupdate|onemptied|onmouseover|onvolumechange|onended|onmouseup|onwaiting],a[target<_blank?_self?_top?_parent|ping|media|href|hreflang|type|rel<alternate?archives?author?bookmark?external?feed?first?help?index?last?license?next?nofollow?noreferrer?prev?search?sidebar?tag?up],abbr,address,area[alt|coords|shape|href|target<_blank?_self?_top?_parent|ping|media|hreflang|type|shape<circle?default?poly?rect|rel<alternate?archives?author?bookmark?external?feed?first?help?index?last?license?next?nofollow?noreferrer?prev?search?sidebar?tag?up],article,aside,audio[src|preload<none?metadata?auto|autoplay<autoplay|loop<loop|controls<controls|mediagroup],blockquote[cite],body,br,button[autofocus<autofocus|disabled<disabled|form|formaction|formenctype|formmethod<get?put?post?delete|formnovalidate?novalidate|formtarget<_blank?_self?_top?_parent|name|type<reset?submit?button|value],canvas[width,height],caption,cite,code,col[span],colgroup[span],command[type<command?checkbox?radio|label|icon|disabled<disabled|checked<checked|radiogroup|default<default],datalist[data],dd,del[cite|datetime],details[open<open],dfn,div,dl,dt,em/i,embed[src|type|width|height],eventsource[src],fieldset[disabled<disabled|form|name],figcaption,figure,footer,form[accept-charset|action|enctype|method<get?post?put?delete|name|novalidate<novalidate|target<_blank?_self?_top?_parent],h1,h2,h3,h4,h5,h6,header,hgroup,hr,iframe[name|src|srcdoc|seamless<seamless|width|height|sandbox],img[alt=|src|ismap|usemap|width|height],input[accept|alt|autocomplete<on?off|autofocus<autofocus|checked<checked|disabled<disabled|form|formaction|formenctype|formmethod<get?put?post?delete|formnovalidate?novalidate|formtarget<_blank?_self?_top?_parent|height|list|max|maxlength|min|multiple<multiple|name|pattern|placeholder|readonly<readonly|required<required|size|src|step|type<hidden?text?search?tel?url?email?password?datetime?date?month?week?time?datetime-local?number?range?color?checkbox?radio?file?submit?image?reset?button|value|width],ins[cite|datetime],kbd,keygen[autofocus<autofocus|challenge|disabled<disabled|form|name],label[for|form],legend,li[value],mark,map[name],menu[type<context?toolbar?list|label],meter[value|min|low|high|max|optimum],nav,noscript,object[data|type|name|usemap|form|width|height],ol[reversed|start],optgroup[disabled<disabled|label],option[disabled<disabled|label|selected<selected|value],output[for|form|name],p,param[name,value],-pre,progress[value,max],q[cite],ruby,rp,rt,samp,script[src|async<async|defer<defer|type|charset],section,select[autofocus<autofocus|disabled<disabled|form|multiple<multiple|name|size],small,source[src|type|media],span,-strong/b,-sub,summary,-sup,table,tbody,td[colspan|rowspan|headers],textarea[autofocus<autofocus|disabled<disabled|form|maxlength|name|placeholder|readonly<readonly|required<required|rows|cols|wrap<soft|hard],tfoot,th[colspan|rowspan|headers|scope],thead,time[datetime],tr,ul,var,video[preload<none?metadata?auto|src|crossorigin|poster|autoplay<autoplay|mediagroup|loop<loop|muted<muted|controls<controls|width|height],wbr';

        return valid_elements;
    }


    /* =============================================
    hit ctrl + enter to add line break
    hit alt + enter to set cursor out of element
    ============================================= */
    editor.on('keydown', function(e) {
        var currentNode,
            newParagraph,
            lineBreak,
            specificParents = new Array('table', 'div.row', 'ol.breadcrumb', 'ul.pagination', 'ul.pager', 'span.badge', '.alert', '.panel', 'ul.nav-tabs', 'div.carousel', 'nav.navbar', 'ul.nav-pills', 'div.panel-group', 'div.jumbotron'),
            bsElement,
            specificParentFound = false,
            jQuery = tinymce.dom.DomQuery;
        if((e.keyCode == 13 || e.keyCode == 10) && (e.altKey === true || e.ctrlKey === true)) {
            e.preventDefault();
            e.stopPropagation();

            var parents = editor.dom.getParents(editor.selection.getNode());
            if(parents.length > 0) {
                currentNode = parents[0];
                if(e.altKey === true) {
                    newParagraph = jQuery('<p>&nbsp;</p>');

                    // if in table, row, breadcrumb pagination
                    for (var i = 0; i < specificParents.length; i++) {
                        bsElement = specificParents[i];
                        if(jQuery(currentNode).closest(bsElement)[0]) {
                            jQuery(parents).each(function() {
                                if(jQuery(this).is(bsElement)) {
                                    jQuery(this).after(newParagraph);
                                    specificParentFound = true;
                                }
                            });
                        }
                    }
                    if(specificParentFound === false) {
                        jQuery(currentNode).after(newParagraph);
                    }
                    editor.selection.setCursorLocation(newParagraph[0], 0);
                } else {
                    editor.execCommand('mceInsertContent', false, '<br /> ');
                    var curElm = editor.selection.getRng().startContainer;
                    var caretPos = editor.selection.getBookmark(curElm.textContent).rng.startOffset;
                    editor.selection.setCursorLocation(curElm, caretPos - 1);
                }
            }
            return false;
        }
    });
});