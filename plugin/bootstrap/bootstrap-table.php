<?php
include_once('conf/conf.php');
if (isset($_GET['tableStriped'])) {
    $newTable        = 'false';
    $tableRows       = "''";
    $tableCols       = "''";
    $tableStriped    = preg_replace('/\r|\n/', '', urldecode($_GET['tableStriped']));
    $tableBordered   = preg_replace('/\r|\n/', '', urldecode($_GET['tableBordered']));
    $tableHover      = preg_replace('/\r|\n/', '', urldecode($_GET['tableHover']));
    $tableCondensed  = preg_replace('/\r|\n/', '', urldecode($_GET['tableCondensed']));
    $tableResponsive = preg_replace('/\r|\n/', '', urldecode($_GET['tableResponsive']));
    $tableCode       = "''";
} else {
    $newTable        = 'true';
    $tableRows       = 5;
    $tableCols       = 5;
    $tableStriped    = 'false';
    $tableBordered   = 'false';
    $tableHover      = 'false';
    $tableCondensed  = 'false';
    $tableResponsive = 'false';
    $tableCode       = "''";
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
    <div class="container margin-bottom-md">
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo CELLS; ?></span>
            </div>
            <div class="text-center">
                <button class="btn btn-success" id="cellpicker"><?php echo ROWS_COLS; ?> <span class="glyphicon glyphicon-circle-arrow-down append"></span></button>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo STRUCTURE; ?></span>
            </div>
            <div class="text-center">
                <label class="col-sm-3 col-sm-offset-1 col-xs-7"><?php echo HORIZONTAL_HEADER; ?> : </label>
                <div class="btn-group btn-toggle col-sm-2 col-xs-5" id="horizontal-header">
                    <button class="btn btn-sm btn-default" data-attr="false"><?php echo NO; ?></button>
                    <button class="btn btn-sm btn-success active" data-attr="true"><?php echo YES; ?></button>
                </div>
                <label class="col-sm-3 col-xs-7"><?php echo VERTICAL_HEADER; ?> : </label>
                <div class="btn-group btn-toggle col-sm-2 col-xs-5" id="vertical-header">
                    <button class="btn btn-sm btn-success active" data-attr="false"><?php echo NO; ?></button>
                    <button class="btn btn-sm btn-default" data-attr="true"><?php echo YES; ?></button>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-md">
            <div class="choice-title">
                <span><?php echo STYLE; ?></span>
            </div>
            <div class="text-center">
                <div class="choice selector select-style">
                    <label>table striped</label>
                    <span id="table-striped"></span>
                </div>
                <div class="choice selector select-style">
                    <label>table bordered</label>
                    <span id="table-bordered"></span>
                </div>
                <div class="choice selector select-style">
                    <label>table condensed</label>
                    <span id="table-condensed"></span>
                </div>
                <div class="choice selector select-style">
                    <label>table hover</label>
                    <span id="table-hover"></span>
                </div>
                <div class="choice selector select-style">
                    <label>table responsive</label>
                    <span id="table-responsive"></span>
                </div>
            </div>
        </div>
        <div class="row" id="preview">
            <div id="preview-title" class="margin-bottom-md">
                <span class="btn-primary"><?php echo PREVIEW; ?></span>
            </div>
            <div class="col-sm-12 test-wrapper-table" id="test-wrapper" style="overflow:auto;">
            </div>
        </div>
        <div class="row">
            <div id="code-title">
                <a href="#" id="code-slide-link"><?php echo CODE; ?> <i class="glyphicon glyphicon-arrow-down"></i></a>
            </div>
            <div class="col-sm-9 col-sm-offset-3" id="code-wrapper">
                <pre></pre>
            </div>
        </div>
    </div>
    <div id="table-builder-wrapper">
        <table id="table-builder">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <p id="cellNumbers" class="text-center"></p>
    </div>
<script type="text/javascript" src="<?php echo JQUERY_JS ?>"></script>
<script type="text/javascript" src="<?php echo BOOTSTRAP_JS ?>"></script>
<script type="text/javascript" src="js/utils.min.js"></script>
<script type="text/javascript" src="js/jquery.htmlClean.min.js"></script>
<script type="text/javascript" src="<?php echo PRISM_JS; ?>"></script>
<script type="text/javascript">
    var newTable        = <?php echo $newTable; ?>;
    var tableRows       = <?php echo $tableRows; ?>; //console.log(glyphicon);
    var tableCols       = <?php echo $tableCols; ?>; // console.log(tableCols);
    var tableStriped    = <?php echo $tableStriped; ?>; //console.log(tableStriped);
    var tableBordered   = <?php echo $tableBordered; ?>; //console.log(tableBordered);
    var tableHover      = <?php echo $tableHover; ?>; //console.log(tableHover);
    var tableCondensed  = <?php echo $tableCondensed; ?>; //console.log(tableCondensed);
    var tableResponsive = <?php echo $tableResponsive; ?>; //console.log(tableResponsive);
    var horizontalHeader = true;
    var verticalHeader = false;
    var tableCode;

    /* random text for new tables */

    var content = [
        ['Name', 'Company', 'Street Adress', 'City', 'Region', 'Postal / Zip', 'Country', 'Phone / Fax', 'Email', 'Date'],
        ['Raymond', 'Sed Hendrerit Limited', '7434 Ut', 'Rd.', 'Belfast', 'U', '36240', 'Aruba', '712-9512', 'non.magna.Nam@dapibus.ca', 'non.magna.Nam@dapibus.ca', 'Mon, Sep 28'],
        ['Sylvester', 'Elit Etiam Laoreet Company', 'Ap #910-7911 Nunc. St.', 'Alandur', 'Tamil Nadu', '60-231', 'Suriname', '1-744-173-8448', 'nibh@est.com', 'Sun, Jul 20'],
        ['Wayne', 'Dolor Donec Corporation', '8118 Donec St.', 'Billings', 'Montana', '619879', 'Qatar', '850-7630', 'vulputate@lacus.net', 'Fri, May 02'],
        ['Hakeem', 'Etiam Corp.', '723-503 Molestie Street', 'Cork', 'Munster', '2837', 'Northern Mariana Islands', '636-9924', 'hendrerit.neque@Mauris.co.uk', 'Wed, Sep 17'],
        ['Noah', 'Lectus Rutrum Corporation', 'P.O. Box 835', '1423 Cras Avenue', 'Galashiels', 'SE', '11506', 'Slovenia', '918-6912', 'dolor@interdumCurabitur.edu', 'Fri, Oct 16'],
        ['Upton', 'Blandit LLP', 'Ap #270-7313 Adipiscing', 'Ave', 'Middelburg', 'Zeeland', '23967', 'Dominica', '1-765-258-3249', 'ultrices.Vivamus.rhoncus@amet.co.uk', 'Tue, Jul 21'],
        ['Nehru', 'Vitae Sodales At Industries', '303-180 Etiam Avenue', 'Cartago', 'C', '3940', 'Heard Island and Mcdonald Islands', '1-750-269-5948', 'consequat.purus.Maecenas@mus.net', 'Thu, Dec 18'],
        ['Jonah', 'Consectetuer Adipiscing Consulting', 'P.O. Box 844', '1463 Lorem', 'Rd.', 'St. Andrä', 'Carinthia', '91826', 'Congo (Brazzaville)', '770-0620', 'tristique.senectus@ridiculusmus.co.uk', 'Mon, Jul 07'],
        ['Charles', 'Phasellus Incorporated', 'P.O. Box 396', '3093 Egestas. St.', 'Sluis', 'Zeeland', '28-939', 'Ghana', '1-652-482-1968', 'natoque@vitaeeratVivamus.ca', 'Fri, Jan 30']
    ];

    $.noConflict();
    jQuery(document).ready(function ($) {

        makeResponsive();
        getBootstrapStyles();
        $('#code-wrapper').hide();

        var bgSuccess = $('#cellpicker').css('background-color');

        /* disable cellpicker if newTable == false */

        if (!newTable) {
            $('#cellpicker').attr('disabled', true).toggleClass('btn-success').addClass('btn-default');
            $('#cellpicker').closest('div.row').append('<div class="col-sm-12"><br><p class="alert alert-info text-center small"><span class="glyphicon glyphicon-info-sign prepend"></span> <?php echo ROW_COL_EDITION_IS_DISABLED_FOR_EDITED_TABLES; ?></p></div>');
            tableCode = getCode('.table.active');
            // tableCode = $(window.parent.document.body).find("iframe").contents().find(".table.active").clone().wrap('<div>').parent().html();
            $('#test-wrapper').html(tableCode);

            /* add ID to table test if table code has been received from php */

            $('#test-wrapper .table').attr('id', 'table-test');
            updateCode();
        } else {

            buildTable();

            /* cell picker */

            $('#cellpicker').popover({
                'placement': 'bottom',
                'content': $('#table-builder-wrapper').html(),
                'html': true
            });
            $('#cellpicker').on('shown.bs.popover', function () {
                $('#table-builder td').on('mouseover', function () {

                    /* number of rows / cols */

                    tableCols = $(this).prevAll('td').length + 1;
                    tableRows = $(this).parent('tr').prevAll('tr').length + 1;
                    $('#cellNumbers').html(tableCols + ' x ' + tableRows);

                    /* add active class to selected */

                    $('#table-builder tr:nth-child(-n + ' + tableRows + ') td:nth-child(-n + ' + (tableCols) + ')').addClass('active').css('background', bgSuccess);
                    $('#table-builder tr:nth-child(n + ' + (tableRows + 1) + ') td').add('#table-builder tr:nth-child(-n + ' + tableRows + ') td:nth-child(n + ' + (tableCols + 1) + ')').removeClass('active').css('background', 'none');
                }).on('click', function () {
                    $('#cellpicker').trigger('click'); // hide popover
                    buildTable();
                });
            });
        }

        $('#horizontal-header').on('click', function () {
            toggleHeader(this, 'horizontalHeader');
        });
        $('#vertical-header').on('click', function () {
            toggleHeader(this, 'verticalHeader');
        });

        /* table style */

        /* set style on load */

        if (tableStriped) {
            $('#table-striped').parent('.selector.select-style').addClass('active');
        }
        if (tableBordered) {
            $('#table-bordered').parent('.selector.select-style').addClass('active');
        }
        if (tableHover) {
            $('#table-hover').parent('.selector.select-style').addClass('active');
        }
        if (tableCondensed) {
            $('#table-condensed').parent('.selector.select-style').addClass('active');
        }
        if (tableResponsive) {
            $('#table-responsive').parent('.selector.select-style').addClass('active');
        }

        $('#table-striped').parent('.selector.select-style').on('click', function () {
            $(this).toggleClass('active');
            tableStriped = !tableStriped;
            $('#test-wrapper table').toggleClass('table-striped');
            updateCode();
        });

        $('#table-bordered').parent('.selector.select-style').on('click', function () {
            $(this).toggleClass('active');
            tableBordered = !tableBordered;
            $('#test-wrapper table').toggleClass('table-bordered');
            updateCode();
        });

        $('#table-hover').parent('.selector.select-style').on('click', function () {
            $(this).toggleClass('active');
            tableHover = !tableHover;
            $('#test-wrapper table').toggleClass('table-hover');
            updateCode();
        });

        $('#table-condensed').parent('.selector.select-style').on('click', function () {
            $(this).toggleClass('active');
            tableCondensed = !tableCondensed;
            $('#test-wrapper table').toggleClass('table-condensed');
            updateCode();
        });

        $('#table-responsive').parent('.selector.select-style').on('click', function () {
            $(this).toggleClass('active');
            tableResponsive = !tableResponsive;
            if (tableResponsive) {
                $('#test-wrapper table').wrap('<div class="table-responsive"></div>');
            } else {
                $('#test-wrapper table').unwrap();
            }
            updateCode();
        });

        /**
         * toggle horizontal or vertical header
         * @param  string headerType : horizontalHeader|verticalHeader
         * @return void
         */
        function toggleHeader(element, headerType)
        {
            var checked = toggleBtn(element);
            if (headerType == 'horizontalHeader') {
                horizontalHeader = checked;
            } else if (headerType == 'verticalHeader') {
                verticalHeader = checked;
            }
            if ($('#test-wrapper table thead')[0]) {
                $('#test-wrapper table tr').unwrap('thead');
            }
            if ($('#test-wrapper table tbody')[0]) {
                var content = $('#test-wrapper table tbody').html();
                $('#test-wrapper table tbody').replaceWith(content);
            }
            if (verticalHeader) {
                $('#test-wrapper table tr td:first-child').each(function () {
                    $(this).replaceWith( "<th>" + $( this ).text() + "</th>" );
                });
            } else {
                $('#test-wrapper table tr th:first-child').each(function () {
                    $(this).replaceWith( "<td>" + $( this ).text() + "</td>" );
                });
            }
            if (horizontalHeader) {
                $('#test-wrapper table tr:first-child').find('td').each(function () {
                    $(this).replaceWith( "<th>" + $( this ).text() + "</th>" );
                });
            } else {
                $('#test-wrapper table tr:first-child').find('th').each(function () {
                    $(this).replaceWith( "<td>" + $( this ).text() + "</td>" );
                });
                if (verticalHeader) {
                    $('#test-wrapper table tr:first-child td:first-child').each(function () {
                        $(this).replaceWith( "<th>" + $( this ).text() + "</th>" );
                    });
                }
            }
            $('#test-wrapper table').wrapInner('<tbody>');
            if ($('#test-wrapper table tbody tr:first-child th:nth-child(2)')[0]) {
                var firstRow = $('#test-wrapper table tbody > tr:first-child').clone();
                $('#test-wrapper table tbody > tr:first-child').remove();
                $('<thead></thead>').prependTo('#test-wrapper table');
                $('#test-wrapper table thead').append(firstRow);
            }
            updateCode();
        }

        function buildTable()
        {
            tableCode = '';
            if (tableResponsive) {
                tableCode += '<div class="table-responsive">' + " \n";
            }
            tableCode += '<table class="table';
            if (tableStriped) {
                tableCode += ' table-striped';
            }
            if (tableBordered) {
                tableCode += ' table-bordered';
            }
            if (tableHover) {
                tableCode += ' table-hover';
            }
            if (tableCondensed) {
                tableCode += ' table-condensed';
            }
            tableCode += '"' + " \n";
            if (newTable) {
                tableCode += ' data-attr="new-table"';
            }
            tableCode += '>' + " \n";
            for (var i = 0; i <= tableRows - 1; i++) { // loop rows
                if (i == 0) { // first row
                    if (horizontalHeader) {
                        tableCode += '    <thead>' + " \n";
                    } else {
                        tableCode += '    <tbody>' + " \n";
                    }
                }
                tableCode += '        <tr>' + " \n";
                for (var j = 0; j <= tableCols - 1; j++) { // loop cols
                    if (i == 0 && horizontalHeader) { // first row
                        if (horizontalHeader) {
                            tableCode += '            <th>' + content[i][j] + '</th>' + " \n";
                        }
                    } else { // others
                        if (verticalHeader && j == 0) {
                            tableCode += '            <th>' + content[i][j] + '</th>' + " \n";
                        } else {
                            tableCode += '            <td>' + content[i][j] + '</td>' + " \n";
                        }
                    }
                }
                tableCode += '        </tr>' + " \n";
                if (i == 0 && horizontalHeader) { // first row end
                    tableCode += '    </thead>' + " \n";
                    tableCode += '    <tbody>' + " \n";
                }
            }
            tableCode += '    </tbody>' + " \n";
            tableCode += '</table>' + " \n";
            if (tableResponsive) {
                tableCode += '</div>';
            }
            $('#test-wrapper').html(tableCode);
            updateCode();
        }
    });
</script>
</body>
</html>
