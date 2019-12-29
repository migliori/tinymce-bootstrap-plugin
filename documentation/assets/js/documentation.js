$(document).ready(function() {
                if (typeof(base_url) == "undefined") {
                    var base_url = location.protocol + '//' + location.host + '/';
                }
                $(".hidden-wrapper").dependantFields();
                $("#content").tinymce({

                    script_url : base_url + 'phpformbuilder/plugins/tinymce/tinymce.min.js',
                    document_base_url: base_url,
                    relative_urls: false,
                    theme: "modern",
                    language: 'fr_FR',
                    element_format: "html",
                    // content_css : "/css/bootstrap.css, /css/main.css",
                    // menubar: "edit view insert table tools",
                    plugins: [
                        "advlist autolink autoresize charmap code codemirror contextmenu fullscreen link lists paste preview table visualblocks textcolor charmap media image responsivefilemanager"
                    ],
                    codemirror: {
                        indentOnInit: true, // Whether or not to indent code on init.
                        path: 'CodeMirror', // Path to CodeMirror distribution
                        config: {           // CodeMirror config object
                           mode: 'application/x-httpd-php' //,
                           // lineNumbers: false
                        },
                        jsFiles: [          // Additional JS files to load
                           'mode/php/php.js'
                        ]
                    },
                    entity_encoding : "raw",
                    contextmenu: "link image inserttable | cell row column deletetable",
                    toolbar: "undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | link image preview | removeformat formats", // add 'responsivefilemanager' to add 'insert file' button
                    schema: "html5",
                    /* responsivefilemanager (configure /phpformbuilder/plugins/filemanager/config/config.php) */
                    external_filemanager_path: base_url + "/phpformbuilder/plugins/filemanager/",
                    filemanager_title: "Responsive Filemanager" ,
                    external_plugins: { "filemanager" : base_url + "/phpformbuilder/plugins/filemanager/plugin.min.js"},
                    /* END responsivefilemanager */
                    image_advtab: true
                });

                // IMPORTANT : the code below prevents a bug (impossible focus in plugins fields) with tinyMce in Bootstrap modal

                $(document).on('focusin', function(e) {
                    if ($(event.target).closest(".mce-window").length) {
                        e.stopImmediatePropagation();
                    }
                });
                $('input[name="human-or-robot"]').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });
                var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
                ];
                $('#autocomplete-input-1').autocomplete({
                    source: availableTags
                });

                $("#autocomplete-input-2").autocomplete({
                    source: "assets/search-form-autocomplete/complete.php",
                    minLength: 2
                });
                $("#content-word-char-count").tinymce({
                    init_instance_callback : function(editor) {

                        /* word-character-count init */

                        $('iframe').contents().find('.mce-content-body').wordCharCountTinyMce("#content-word-char-count", {'maxAuthorized': 200});
                    },
                    script_url : base_url + 'phpformbuilder/plugins/tinymce/tinymce.min.js',
                    document_base_url: base_url,
                    relative_urls: false,
                    theme: "modern",
                    language: 'fr_FR',
                    element_format: "html",
                    // content_css : "/css/bootstrap.css, /css/main.css",
                    // menubar: "edit view insert table tools",
                    plugins: [
                        "advlist autolink autoresize charmap code codemirror contextmenu fullscreen link lists paste preview table visualblocks textcolor charmap media image responsivefilemanager"
                    ],
                    codemirror: {
                        indentOnInit: true, // Whether or not to indent code on init.
                        path: 'CodeMirror', // Path to CodeMirror distribution
                        config: {           // CodeMirror config object
                           mode: 'application/x-httpd-php' //,
                           // lineNumbers: false
                        },
                        jsFiles: [          // Additional JS files to load
                           'mode/php/php.js'
                        ]
                    },
                    entity_encoding : "raw",
                    contextmenu: "link image inserttable | cell row column deletetable",
                    toolbar: "undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | link image preview | removeformat formats", // add 'responsivefilemanager' to add 'insert file' button
                    schema: "html5",
                    /* responsivefilemanager (configure /phpformbuilder/plugins/filemanager/config/config.php) */
                    external_filemanager_path: base_url + "/phpformbuilder/plugins/filemanager/",
                    filemanager_title: "Responsive Filemanager" ,
                    external_plugins: { "filemanager" : base_url + "/phpformbuilder/plugins/filemanager/plugin.min.js"},
                    /* END responsivefilemanager */
                    image_advtab: true
                });
                $("#defaultColorPicker").colpick({
                    onSubmit:function(hsb,hex,rgb,el) {
                        $(el).val('#'+hex);
                        $(el).colpickHide();
                    }
                });
                $("#myCustomColorPicker").colpick({
                    colorScheme:'dark',
                    layout:'rgbhex',
                    color:'ff8800',
                    onSubmit:function(hsb,hex,rgb,el) {
                        $(el).val('you choosed #'+hex).css('color', '#'+hex);
                        $(el).colpickHide();
                    }
                });
                $("#myTimePicker").timepicker();
                $("#myDatePicker").datepicker();
                $("#captcha").realperson({
                    length: 6,
                    regenerate:'Click to change',
                    dot: '#'
                });
                $('#message').wordCharCount({'maxAuthorized': 200});
                $("#user-password").wrap('<div id="#user-password-wrap">').passField({
                    pattern: "abcdeF"
                });
                $(".selectpicker").selectpicker({container: 'body'});
                $("#user-date").pickadate({
                    labelYearSelect: 'Select a year',
                    formatSubmit: 'yyyy-mm-dd'
                });
            });