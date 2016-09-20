<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Export_xls
{
    public function __construct() {
error_reporting(0);
    }
function generate($tbl){
session_start();

$_SESSION['zprofile'] = 'yes';
$_SESSION['zprofile']['username'] = 'root';
$_SESSION['zprofile']['useremail'] = 'geheeh@daasd.ccc';
$_SESSION['zprofile']['usercompany'] = 'hehehahhaha';

$_GET['var'] = 'tbl_tes';
$_SESSION['tbl_tes'] = $tbl;
/* $_SESSION['tbl_tes'] = '
<table border="1">
	<thead>
		<tr bgcolor="yellow">
			<th>no</th>
			<th>col1</th>
			<th>col2</th>
			<th>col3</th>
			<th>col4</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>B2</td>
			<td>C2</td>
			<td rowspan="2">D2</td>
            <td>E3</td>
		</tr>
		<tr>
			<td>2</td>
			<td colspan="2">B3</td>
			<td>C3</td>
		</tr>
		<tr>
			<td>3</td>
			<td>B4</td>
			<td colspan="2" rowspan="2">C4</td>
			<td>D4</td>
		</tr>
		<tr>
			<td>4</td>
			<td>
                B5<img src="././assets/img/ecsi.png" name="gambar tes" title="hehehe coba titlenya" width="100" height="100">
			<td><b>C5</b></td>
		</tr>
	</tbody>
</table>
'; */
//echo $_SESSION['tbl_tes'];exit();

ini_set("memory_limit", "-1");
ini_set("set_time_limit", "0");
set_time_limit(0);
if (isset($_SESSION['zprofile'])) {
    $username = $_SESSION['zprofile']['username']; // user's name
    $usermail = $_SESSION['zprofile']['useremail']; // user's emailid
    $usercompany = $_SESSION['zprofile']['usercompany']; // user's company
} else {
    header('Location: index.php?e=0');
}
if (!isset($_GET['var'])) {
    echo "<br />No Table Variable Present, nothing to Export.";
    exit;
} else {
    $tablevar = $_GET['var'];
}
if (!isset($_GET['limit'])) {
    $limit = 12;
} else {
    $limit = $_GET['limit'];
}
if (!isset($_GET['debug'])) {
    $debug = false;
} else {
    $debug = true;
    $handle = fopen("Auditlog/exportlog.txt", "w");
    fwrite($handle, "\nDebugging On...");
}
if (!isset($_SESSION[$tablevar]) or $_SESSION[$tablevar] == '') {
    echo "<br />Empty HTML Table, nothing to Export.";
    exit;
} else {
    $htmltable = $_SESSION[$tablevar];
}
if (strlen($htmltable) == strlen(strip_tags($htmltable))) {
    echo "<br />Invalid HTML Table after Stripping Tags, nothing to Export.";
    exit;
}
$htmltable = strip_tags($htmltable,
    "<table><tr><th><thead><tbody><tfoot><td><br><br /><b><span><img><img />");
$htmltable = str_replace("<br />", "\n", $htmltable);
$htmltable = str_replace("<br/>", "\n", $htmltable);
$htmltable = str_replace("<br>", "\n", $htmltable);
$htmltable = str_replace("&nbsp;", " ", $htmltable);
$htmltable = str_replace("\n\n", "\n", $htmltable);
//
//  Extract HTML table contents to array
//
$dom = new domDocument;
$dom->loadHTML($htmltable);
if (!$dom) {
    echo "<br />Invalid HTML DOM, nothing to Export.";
    exit;
}
$dom->preserveWhiteSpace = false; // remove redundant whitespace
$tables = $dom->getElementsByTagName('table');
if (!is_object($tables)) {
    echo "<br />Invalid HTML Table DOM, nothing to Export.";
    exit;
}
if ($debug) {
    fwrite($handle, "\nTable Count: " . $tables->length);
}
$tbcnt = $tables->length - 1; // count minus 1 for 0 indexed loop over tables
if ($tbcnt > $limit) {
    $tbcnt = $limit;
}
//
//
// Create new PHPExcel object with default attributes
//
require_once ('PHPExcel/PHPExcel.php');
$objPHPExcel = new PHPExcel();
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9);
$tm = date(YmdHis);
$pos = strpos($usermail, "@");
$user = substr($usermail, 0, $pos);
$user = str_replace(".", "", $user);
$tfn = $user . "_" . $tm . "_" . $tablevar . ".xlsx";
//$fname = "AuditLog/".$tfn;
$fname = $tfn;
$objPHPExcel->getProperties()->setCreator($username)->setLastModifiedBy($username)->
    setTitle("Automated Export")->setSubject("Automated Report Generation")->
    setDescription("Automated report generation.")->setKeywords("Exported File")->
    setCompany($usercompany)->setCategory("Export");
//
// Loop over tables in DOM to create an array, each table becomes a worksheet
//
for ($z = 0; $z <= $tbcnt; $z++) {
    $maxcols = 0;
    $totrows = 0;
    $headrows = array();
    $bodyrows = array();
    $r = 0;
    $h = 0;
    $rows = $tables->item($z)->getElementsByTagName('tr');
    $totrows = $rows->length;
    if ($debug) {
        fwrite($handle, "\nTotal Rows: " . $totrows);
    }
    foreach ($rows as $row) {
        $ths = $row->getElementsByTagName('th');
        if (is_object($ths)) {
            if ($ths->length > 0) {
                $headrows[$h]['colcnt'] = $ths->length;
                if ($ths->length > $maxcols) {
                    $maxcols = $ths->length;
                }
                $nodes = $ths->length - 1;
                for ($x = 0; $x <= $nodes; $x++) {
                    $thishdg = $ths->item($x)->nodeValue;
                    $headrows[$h]['th'][] = $thishdg;
                    $headrows[$h]['bold'][] = $this->findWrapText('b',$this->innerHTML($ths->item($x)));
                    $headrows[$h]['italic'][] = $this->findWrapText('i',$this->innerHTML($ths->item($x)));
                    $headrows[$h]['underline'][] = $this->findWrapText('u',$this->innerHTML($ths->item($x)));
                    if ($ths->item($x)->hasAttribute('style')) {
                        $style = $ths->item($x)->getAttribute('style');
                        $stylecolor = $this->findStyleCSS('color',$style);
                        if ($stylecolor == '') {
                            $headrows[$h]['color'][] = $this->findSpanColor($this->innerHTML($ths->item($x)));
                        } else {
                            $headrows[$h]['color'][] = $stylecolor;
                        }
                        $headrows[$h]['font_name'][] = $this->findStyleCSS('font-family',$style);
                        $headrows[$h]['font_size'][] = $this->findStyleCSS('font-size',$style);
                        $headrows[$h]['border_top'][] = $this->findStyleCSS('border-top',$style);
                        $headrows[$h]['border_bottom'][] = $this->findStyleCSS('border-bottom',$style);
                        $headrows[$h]['border_left'][] = $this->findStyleCSS('border-left',$style);
                        $headrows[$h]['border_right'][] = $this->findStyleCSS('border-right',$style);
                    } else {
                        $headrows[$h]['color'][] = $this->findSpanColor($this->innerHTML($ths->item($x)));
                    }
                    if ($ths->item($x)->hasAttribute('colspan')) {
                        $headrows[$h]['colspan'][] = $ths->item($x)->getAttribute('colspan');
                    } else {
                        $headrows[$h]['colspan'][] = 1;
                    }
                    if ($ths->item($x)->hasAttribute('rowspan')) {
                        $headrows[$h]['rowspan'][] = $ths->item($x)->getAttribute('rowspan');
                    } else {
                        $headrows[$h]['rowspan'][] = 1;
                    }
                    if ($ths->item($x)->hasAttribute('align')) {
                        $headrows[$h]['align'][] = $ths->item($x)->getAttribute('align');
                    } else {
                        $headrows[$h]['align'][] = 'left';
                    }
                    if ($ths->item($x)->hasAttribute('valign')) {
                        $headrows[$h]['valign'][] = $ths->item($x)->getAttribute('valign');
                    } else {
                        $headrows[$h]['valign'][] = 'top';
                    }
                    if ($ths->item($x)->hasAttribute('bgcolor')) {
                        $headrows[$h]['bgcolor'][] = str_replace("#", "", $ths->item($x)->getAttribute('bgcolor'));
                    } else {
                        $headrows[$h]['bgcolor'][] = 'FFFFFF';
                    }
                }
                $h++;
            }
        }
    }
    $iRow = 0;
    $fillCell = array();
    foreach ($rows as $row) {
        $iRow++;
        $tds = $row->getElementsByTagName('td');
        if (is_object($tds)) {
            if ($tds->length > 0) {
                $bodyrows[$r]['colcnt'] = $tds->length;
                if ($tds->length > $maxcols) {
                    $maxcols = $tds->length;
                }
                $nodes = $tds->length - 1;
                $iCol = 'A';
                for ($x = 0; $x <= $nodes; $x++) {
                    $thistxt = $tds->item($x)->nodeValue;
                    $bodyrows[$r]['td'][] = $thistxt;
                    $bodyrows[$r]['img'][] = $this->collecImg($tds->item($x)->getElementsByTagName('img'));
                    $bodyrows[$r]['bold'][] = $this->findWrapText('b',$this->innerHTML($tds->item($x)));
                    $bodyrows[$r]['italic'][] = $this->findWrapText('i',$this->innerHTML($tds->item($x)));
                    $bodyrows[$r]['underline'][] = $this->findWrapText('u',$this->innerHTML($tds->item($x)));
                    if ($tds->item($x)->hasAttribute('style')) {
                        $style = $tds->item($x)->getAttribute('style');
                        $stylecolor = $this->findStyleCSS('color',$style);
                        if ($stylecolor == '') {
                            $bodyrows[$r]['color'][] = $this->findSpanColor($this->innerHTML($tds->item($x)));
                        } else {
                            $bodyrows[$r]['color'][] = $stylecolor;
                        }
                        $bodyrows[$h]['font_name'][] = $this->findStyleCSS('font-family',$style);
                        $bodyrows[$h]['font_size'][] = $this->findStyleCSS('font-size',$style);
                        $bodyrows[$h]['border_top'][] = $this->findStyleCSS('border-top',$style);
                        $bodyrows[$h]['border_bottom'][] = $this->findStyleCSS('border-bottom',$style);
                        $bodyrows[$h]['border_left'][] = $this->findStyleCSS('border-left',$style);
                        $bodyrows[$h]['border_right'][] = $this->findStyleCSS('border-right',$style);
                    } else {
                        $bodyrows[$r]['color'][] = $this->findSpanColor($this->innerHTML($tds->item($x)));
                    }
                    if ($tds->item($x)->hasAttribute('colspan')) {
                        $icolspan = $tds->item($x)->getAttribute('colspan');
                        $bodyrows[$r]['colspan'][] = $tds->item($x)->getAttribute('colspan');
                    } else {
                        $icolspan = 1;
                        $bodyrows[$r]['colspan'][] = 1;
                    }
                    if ($tds->item($x)->hasAttribute('rowspan')) {
                        $irowspan = $tds->item($x)->getAttribute('rowspan');
                        $bodyrows[$r]['rowspan'][] = $irowspan;
                    } else {
                        $irowspan = 1;
                        $bodyrows[$r]['rowspan'][] = 1;
                    }
                    if ($tds->item($x)->hasAttribute('align')) {
                        $bodyrows[$r]['align'][] = $tds->item($x)->getAttribute('align');
                    } else {
                        $bodyrows[$r]['align'][] = 'left';
                    }
                    if ($tds->item($x)->hasAttribute('valign')) {
                        $bodyrows[$r]['valign'][] = $tds->item($x)->getAttribute('valign');
                    } else {
                        $bodyrows[$r]['valign'][] = 'top';
                    }
                    if ($tds->item($x)->hasAttribute('bgcolor')) {
                        $bodyrows[$r]['bgcolor'][] = str_replace("#", "", $tds->item($x)->getAttribute('bgcolor'));
                    } else {
                        $bodyrows[$r]['bgcolor'][] = 'FFFFFF';
                    }

                    $lastIcol = $iCol;
                    $lastIrow = $iRow;

                    for ($ic = 1; $ic < $icolspan; $ic++) {
                        $lastIcol++;
                        $fillCell[$lastIcol . ':' . $lastIrow] = true;
                    }

                    $lastIcol = $iCol;
                    $lastIrow = $iRow;

                    for ($ir = 1; $ir < $irowspan; $ir++) {
                        $lastIrow++;
                        $fillCell[$lastIcol . ':' . $lastIrow] = true;
                    }

                    $lastIcol = $iCol;
                    $lastIrow = $iRow;

                    for ($ic = 1; $ic < $icolspan; $ic++) {
                        for ($ir = 1; $ir < $irowspan; $ir++) {
                            $lastIrow++;
                            $fillCell[$lastIcol . ':' . $lastIrow] = true;
                        }
                        $lastIcol++;
                        $fillCell[$lastIcol . ':' . $lastIrow] = true;
                    }

                    $iCol++;
                }
                $r++;
            }
        }
    }
    //echo '<pre>';print_r($fillCell);
    //exit();
    if ($z > 0) {
        $objPHPExcel->createSheet($z);
    }
    $suf = $z + 1;
    $tableid = $tablevar . $suf;
    $wksheetname = ucfirst($tableid);
    $objPHPExcel->setActiveSheetIndex($z); // each sheet corresponds to a table in html
    $objPHPExcel->getActiveSheet()->setTitle($wksheetname); // tab name
    $worksheet = $objPHPExcel->getActiveSheet(); // set worksheet we're working on
    $style_overlay = array(
        'font' => array(
            'color' => array('rgb' => '000000'),
            'bold' => false,
            ),
        'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' =>
                    'CCCCFF')),
        'alignment' => array(
            'wrap' => true,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP),
        'borders' => array(
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
        );
    $xcol = '';
    $xrow = 1;
    $usedhdrows = 0;
    $heightvars = array(
        1 => '42',
        2 => '42',
        3 => '48',
        4 => '52',
        5 => '58',
        6 => '64',
        7 => '68',
        8 => '76',
        9 => '82');
    for ($h = 0; $h < count($headrows); $h++) {
        $th = $headrows[$h]['th'];
        $colspans = $headrows[$h]['colspan'];
        $rowspans = $headrows[$h]['rowspan'];
        $aligns = $headrows[$h]['align'];
        $valigns = $headrows[$h]['valign'];
        $bgcolors = $headrows[$h]['bgcolor'];
        $colcnt = $headrows[$h]['colcnt'];
        $colors = $headrows[$h]['color'];
        $bolds = $headrows[$h]['bold'];
        $italics = $headrows[$h]['italic'];
        $underlines = $headrows[$h]['underline'];
        $font_sizes = $headrows[$h]['font_size'];
        $font_names = $headrows[$h]['font_name'];
        $border_tops = $headrows[$h]['border_top'];
        $border_bottoms = $headrows[$h]['border_bottom'];
        $border_lefts = $headrows[$h]['border_left'];
        $border_rights = $headrows[$h]['border_right'];
        $usedhdrows++;
        $mergedcells = false;
        for ($t = 0; $t < count($th); $t++) {
            if ($xcol == '') {
                $xcol = 'A';
            } else {
                $xcol++;
            }
            $thishdg = $th[$t];
            $thisalign = $aligns[$t];
            $thisvalign = $valigns[$t];
            $thiscolspan = (int)$colspans[$t];
            $thisrowspan = (int)$rowspans[$t];
            $thiscolor = $colors[$t];
            $thisbg = $bgcolors[$t];
            $thisbold = $bolds[$t];
            $thisitalic = $italics[$t];
            $thisunderline = $underlines[$t];
            $thissize = (float)str_replace(array('pt','PT','px','PX'),'',$font_sizes[$t]);
            $thissize = $thissize > 0 ? $thissize : 9;
            $thisname = $font_names[$t];
            $thisname = $thisname ? $thisname : 'Arial';
            $thisbordertop = str_replace(array('px','PX'),'',$border_tops) > 0 && !empty($border_tops) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $thisborderbottom = str_replace(array('px','PX'),'',$border_bottoms) > 0 && !empty($border_bottoms) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $thisborderleft = str_replace(array('px','PX'),'',$border_lefts) > 0 && !empty($border_lefts) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $thisborderright = str_replace(array('px','PX'),'',$border_rights) > 0 && !empty($border_rights) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $strbordertop = str_replace(array('px','PX'),'',$border_tops) > 0 ? 'true':'false';
            $strborderbottom = str_replace(array('px','PX'),'',$border_bottoms) > 0 ? 'true':'false';
            $strborderleft = str_replace(array('px','PX'),'',$border_lefts) > 0 ? 'true':'false';
            $strborderright = str_replace(array('px','PX'),'',$border_rights) > 0 ? 'true':'false';
            $strbold = ($thisbold == true) ? 'true' : 'false';
            $stritalic = ($thisitalic== true) ? 'true' : 'false';
            $strunderline = ($thisunderline == true) ? 'true' : 'false';
            if ($thisbg == 'FFFFFF') {
                $style_overlay['fill']['type'] = PHPExcel_Style_Fill::FILL_NONE;
            } else {
                $style_overlay['fill']['type'] = PHPExcel_Style_Fill::FILL_SOLID;
            }
            $style_overlay['alignment']['vertical'] = $thisvalign; // set styles for cell
            $style_overlay['alignment']['horizontal'] = $thisalign;
            $style_overlay['font']['color']['rgb'] = $thiscolor;
            $style_overlay['font']['bold'] = $thisbold;
            $style_overlay['font']['italic'] = $thisitalic;
            $style_overlay['font']['underline'] = $thisunderline == true ? PHPExcel_Style_Font::UNDERLINE_SINGLE:PHPExcel_Style_Font::UNDERLINE_NONE;
            $style_overlay['font']['size'] = $thissize;
            $style_overlay['font']['name'] = $thisname;
            $style_overlay['borders']['top']['style'] = $thisbordertop;
            $style_overlay['borders']['bottom']['style'] = $thisborderbottom;
            $style_overlay['borders']['left']['style'] = $thisborderleft;
            $style_overlay['borders']['right']['style'] = $thisborderright;
            $style_overlay['fill']['color']['rgb'] = $thisbg;
            $worksheet->setCellValue($xcol . $xrow, $thishdg);
            $worksheet->getStyle($xcol . $xrow)->applyFromArray($style_overlay);
            if ($debug) {
                fwrite($handle, "\n" . $xcol . ":" . $xrow . " Rowspan:" . $thisrowspan .
                    " ColSpan:" . $thiscolspan . " Color:" . $thiscolor . " Align:" . $thisalign .
                    " VAlign:" . $thisvalign . " BGColor:" . $thisbg . " Bold:" . $strbold .
                    " Italic:".$stritalic." Underline:".$strunderline." Font-name:".$thisname." Font-size:".$thissize.
                    " Border-top: ".$strbordertop." Border-bottom".$strborderbottom." Border-left:".$strborderleft." Border-right:".$strborderright.
                    " cellValue: " . $thishdg);
            }
            if ($thiscolspan > 1 && $thisrowspan < 1) { // spans more than 1 column
                $mergedcells = true;
                $lastxcol = $xcol;
                for ($j = 1; $j < $thiscolspan; $j++) {
                    $lastxcol++;
                    $worksheet->setCellValue($lastxcol . $xrow, '');
                    $worksheet->getStyle($lastxcol . $xrow)->applyFromArray($style_overlay);
                }
                $cellRange = $xcol . $xrow . ':' . $lastxcol . $xrow;
                if ($debug) {
                    fwrite($handle, "\nmergeCells: " . $xcol . ":" . $xrow . " " . $lastxcol . ":" .
                        $xrow);
                }
                $worksheet->mergeCells($cellRange);
                $worksheet->getStyle($cellRange)->applyFromArray($style_overlay);
                $num_newlines = substr_count($thishdg, "\n"); // count number of newline chars
                if ($num_newlines > 1) {
                    $rowheight = $heightvars[1]; // default to 35
                    if (array_key_exists($num_newlines, $heightvars)) {
                        $rowheight = $heightvars[$num_newlines];
                    } else {
                        $rowheight = 75;
                    }
                    $worksheet->getRowDimension($xrow)->setRowHeight($rowheight); // adjust heading row height
                }
                $xcol = $lastxcol;
            }
        }
        $xrow++;
        $xcol = '';
    }
    //Put an auto filter on last row of heading only if last row was not merged
    if (!$mergedcells) {
        $worksheet->setAutoFilter("A$usedhdrows:" . $worksheet->getHighestColumn() . $worksheet->
            getHighestRow());
    }
    if ($debug) {
        fwrite($handle, "\nautoFilter: A" . $usedhdrows . ":" . $worksheet->
            getHighestColumn() . $worksheet->getHighestRow());
    }
    // Freeze heading lines starting after heading lines
    $usedhdrows++;
    $worksheet->freezePane("A$usedhdrows");
    if ($debug) {
        fwrite($handle, "\nfreezePane: A" . $usedhdrows);
    }
    //
    // Loop thru data rows and write them out
    //

    $xcol = '';
    $xrow = $usedhdrows;
    for ($b = 0; $b < count($bodyrows); $b++) {
        $td = $bodyrows[$b]['td'];
        $img = $bodyrows[$b]['img'];
        $colcnt = $bodyrows[$b]['colcnt'];
        $colspans = $bodyrows[$b]['colspan'];
        $rowspans = $bodyrows[$b]['rowspan'];
        $aligns = $bodyrows[$b]['align'];
        $valigns = $bodyrows[$b]['valign'];
        $bgcolors = $bodyrows[$b]['bgcolor'];
        $colors = $bodyrows[$b]['color'];
        $bolds = $bodyrows[$b]['bold'];
        $italics = $bodyrows[$h]['italic'];
        $underlines = $bodyrows[$h]['underline'];
        $font_sizes = $bodyrows[$h]['font_size'];
        $font_names = $bodyrows[$h]['font_name'];
        $border_tops = $bodyrows[$h]['border_top'];
        $border_bottoms = $bodyrows[$h]['border_bottom'];
        $border_lefts = $bodyrows[$h]['border_left'];
        $border_rights = $bodyrows[$h]['border_right'];
        for ($t = 0; $t < count($td); $t++) {
            if ($xcol == '') {
                $xcol = 'A';
            } else {
                $xcol++;
            }
            if (isset($fillCell[$xcol . ':' . $xrow])) {
                $xcol = $this->nextCol($xcol, $xrow);
            }
            $thistext = $td[$t];
            $thisimg = $img[$t];
            $thisalign = $aligns[$t];
            $thisvalign = $valigns[$t];
            $thiscolspan = (int)$colspans[$t];
            $thisrowspan = (int)$rowspans[$t];
            $thiscolor = $colors[$t];
            $thisbg = $bgcolors[$t];
            $thisbold = $bolds[$t];
            $strbold = ($thisbold == true) ? 'true' : 'false';
            $thisbold = $bolds[$t];
            $thisitalic = $italics[$t];
            $thisunderline = $underlines[$t];
            $thissize = (float)str_replace(array('pt','PT','px','PX'),'',$font_sizes[$t]);
            $thissize = $thissize > 0 ? $thissize : 9;
            $thisname = $font_names[$t];
            $thisname = $thisname ? $thisname : 'Arial';
            $thisbordertop = str_replace(array('px','PX'),'',$border_tops) > 0 && !empty($border_tops) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $thisborderbottom = str_replace(array('px','PX'),'',$border_bottoms) > 0 && !empty($border_bottoms) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $thisborderleft = str_replace(array('px','PX'),'',$border_lefts) > 0 && !empty($border_lefts) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $thisborderright = str_replace(array('px','PX'),'',$border_rights) > 0 && !empty($border_rights) ? PHPExcel_Style_Border::BORDER_THIN : PHPExcel_Style_Border::BORDER_NONE;
            $strbold = ($thisbold == true) ? 'true' : 'false';
            $stritalic = ($thisitalic== true) ? 'true' : 'false';
            $strunderline = ($thisunderline == true) ? 'true' : 'false';
            $strbordertop = str_replace(array('px','PX'),'',$border_tops) > 0 ? 'true':'false';
            $strborderbottom = str_replace(array('px','PX'),'',$border_bottoms) > 0 ? 'true':'false';
            $strborderleft = str_replace(array('px','PX'),'',$border_lefts) > 0 ? 'true':'false';
            $strborderright = str_replace(array('px','PX'),'',$border_rights) > 0 ? 'true':'false';
            if ($thisbg == 'FFFFFF') {
                $style_overlay['fill']['type'] = PHPExcel_Style_Fill::FILL_NONE;
            } else {
                $style_overlay['fill']['type'] = PHPExcel_Style_Fill::FILL_SOLID;
            }
            $style_overlay['alignment']['vertical'] = $thisvalign; // set styles for cell
            $style_overlay['alignment']['horizontal'] = $thisalign;
            $style_overlay['font']['color']['rgb'] = $thiscolor;
            $style_overlay['font']['bold'] = $thisbold;
            $style_overlay['font']['italic'] = $thisitalic;
            $style_overlay['font']['underline'] = $thisunderline == true ? PHPExcel_Style_Font::UNDERLINE_SINGLE:PHPExcel_Style_Font::UNDERLINE_NONE;
            $style_overlay['font']['size'] = $thissize;
            $style_overlay['font']['name'] = $thisname;
            $style_overlay['borders']['top']['style'] = $thisbordertop;
            $style_overlay['borders']['bottom']['style'] = $thisborderbottom;
            $style_overlay['borders']['left']['style'] = $thisborderleft;
            $style_overlay['borders']['right']['style'] = $thisborderright;
            $style_overlay['fill']['color']['rgb'] = $thisbg;
            if ($thiscolspan == 1) {
                $worksheet->getColumnDimension($xcol)->setWidth(25);
            }
            $worksheet->setCellValue($xcol . $xrow, $thistext);
            if (is_array($thisimg) && count($thisimg) > 0) {
                $thisCellWidth = $worksheet->getColumnDimension($xcol)->getWidth();
                $thisCellHeight = 0;
                $offsetY = 5;
                foreach ($thisimg as $Vimg) {
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setWorksheet($worksheet);
                    $objDrawing->setName($Vimg['name']);
                    $objDrawing->setDescription($Vimg['title']);
                    $objDrawing->setPath($Vimg['src']);
                    $objDrawing->setCoordinates($xcol . $xrow);
                    $objDrawing->setOffsetX(1);
                    $objDrawing->setOffsetY($offsetY);
                    $objDrawing->setWidth($Vimg['width']);
                    $objDrawing->setHeight($Vimg['height']);
                    $thisCellHeight += $Vimg['height'];
                    if ($Vimg['width'] > $thisCellWidth) {
                        $worksheet->getColumnDimension($xcol)->setWidth(($Vimg['width'] / 5));
                    }
                    if ($Vimg['height'] > 0) {
                        $worksheet->getRowDimension($xrow)->setRowHeight($thisCellHeight);
                    }

                    if ($debug) {
                        fwrite($handle, "\n Insert Image on " . $xcol . ":" . $xrow . ' src:' . $Vimg['src'] .
                            ' Width:' . $Vimg['width'] . ' Height:' . $Vimg['height'] . ' Offset:' . $offsetY);
                    }

                    $offsetY += $Vimg['height'] + 10;
                }
            }
            if ($debug) {
                fwrite($handle, "\n" . $xcol . ":" . $xrow . " Rowspan:" . $thisrowspan .
                    " ColSpan:" . $thiscolspan . " Color:" . $thiscolor . " Align:" . $thisalign .
                    " VAlign:" . $thisvalign . " BGColor:" . $thisbg . " Bold:" . $strbold .
                    " Italic:".$stritalic." Underline:".$strunderline." Font-name:".$thisname." Font-size:".$thissize.
                    " Border-top: ".$strbordertop." Border-bottom".$strborderbottom." Border-left:".$strborderleft." Border-right:".$strborderright.
                    " cellValue: " . $thistext);
            }
            $worksheet->getStyle($xcol . $xrow)->applyFromArray($style_overlay);
            if ($thiscolspan > 1 && $thisrowspan == 1) { // spans more than 1 column
                $lastxcol = $xcol;
                for ($j = 1; $j < $thiscolspan; $j++) {
                    $lastxcol++;
                }
                $cellRange = $xcol . $xrow . ':' . $lastxcol . $xrow;
                if ($debug) {
                    fwrite($handle, "\nmergeCells: " . $xcol . ":" . $xrow . " " . $lastxcol . ":" .
                        $xrow);
                }
                $worksheet->mergeCells($cellRange);
                $worksheet->getStyle($cellRange)->applyFromArray($style_overlay);
                $xcol = $lastxcol;
            } elseif ($thiscolspan == 1 && $thisrowspan > 1) { // spans more than 1 column
                $lastxrow = $xrow;
                for ($j = 1; $j < $thisrowspan; $j++) {
                    $lastxrow++;
                    //$fillCell[$xcol.':'.$lastxrow] = true;
                }
                $cellRange = $xcol . $xrow . ':' . $xcol . $lastxrow;
                if ($debug) {
                    fwrite($handle, "\nmergeCells: " . $xcol . ":" . $xrow . " " . $xcol . ":" . $lastxrow);
                }
                $worksheet->mergeCells($cellRange);
                $worksheet->getStyle($cellRange)->applyFromArray($style_overlay);
                //$xrow = $lastxrow;
            } elseif ($thiscolspan > 1 && $thisrowspan > 1) { // spans more than 1 column
                $lastxcol = $xcol;
                $lastxrow = $xrow;
                for ($j = 1; $j < $thiscolspan; $j++) {
                    $lastxcol++;
                    for ($k = 1; $k < $thisrowspan; $k++) {
                        $lastxrow++;
                        //$fillCell[$lastxcol.':'.$lastxrow] = true;
                    }
                }
                $cellRange = $xcol . $xrow . ':' . $lastxcol . $lastxrow;
                if ($debug) {
                    fwrite($handle, "\nmergeCells: " . $xcol . ":" . $xrow . " " . $lastxcol . ":" .
                        $lastxrow);
                }
                $worksheet->mergeCells($cellRange);
                $worksheet->getStyle($cellRange)->applyFromArray($style_overlay);
                $xcol = $lastxcol;
                //$xrow = $lastxrow;
            }
        }
        $xrow++;
        $xcol = '';
    }
    // autosize columns to fit data
    $azcol = 'A';
    for ($x = 1; $x == $maxcols; $x++) {
        $worksheet->getColumnDimension($azcol)->setAutoSize(true);
        $azcol++;
    }
    if ($debug) {
        fwrite($handle, "\nHEADROWS: " . print_r($headrows, true));
        fwrite($handle, "\nBODYROWS: " . print_r($bodyrows, true));
        fwrite($handle, "\nFILLCELL: " . print_r($fillCell, true));
    }
} // end for over tables
$objPHPExcel->setActiveSheetIndex(0); // set to first worksheet before close
//
// Write to Browser
//
if ($debug) {
    fclose($handle);
}
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=$fname");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save($fname);
$objWriter->save('php://output');
exit;

}

function innerHTML($node)
{
    $doc = $node->ownerDocument;
    $frag = $doc->createDocumentFragment();
    foreach ($node->childNodes as $child) {
        $frag->appendChild($child->cloneNode(true));
    }
    return $doc->saveXML($frag);
}
function findSpanColor($node)
{
    $pos = stripos($node, "color:"); // ie: looking for style='color: #FF0000;'
    if ($pos === false) { //                        12345678911111
        return '000000'; //                                 01234
    }
    $node = substr($node, $pos); // truncate to color: start
    $start = "#"; // looking for html color string
    $end = ";"; // should end with semicolon
    $node = " " . $node; // prefix node with blank
    $ini = stripos($node, $start); // look for #
    if ($ini === false)
        return "000000"; // not found, return default color of black
    $ini += strlen($start); // get 1 byte past start string
    $len = stripos($node, $end, $ini) - $ini; // grab substr between start and end positions
    return substr($node, $ini, $len); // return the RGB color without # sign
}
function findStyleCSS($param,$style)
{
    $pos = stripos($style, $param.":"); // ie: looking for style='color: #FF0000;'
    if ($pos === false) { //                        12345678911111
        return ''; //                                 01234
    }
    $style = substr($style, $pos); // truncate to color: start
    if($param=='color'){
        $start = "#"; // looking for html color string
    }
    $style = str_replace(' ','',$style);
    $end = ";"; // should end with semicolon
    $style = " " . $style; // prefix node with blank
    $ini = stripos($style, $param.':'.$start); // look for #
    if ($ini === false)
        return ""; // not found, return default color of black
    $ini += strlen($param.':'.$start); // get 1 byte past start string
    $len = stripos($style, $end, $ini) - $ini; // grab substr between start and end positions
    return substr($style, $ini, $len); // return the RGB color without # sign
}
function findWrapText($type,$node)
{
    $pos = stripos($node, "<".$type.">"); // ie: looking for bolded text
    if ($pos === false) { //                        12345678911111
        return false; //                                 01234
    }
    return true; // found <b>
}
function nextCol($col, $row)
{
    global $fillCell;

    if (isset($fillCell[$col . ':' . $row])) {
        $col++;
    } else {
        return $col;
    }
    return nextCol($col, $row);
}
function collecImg($array)
{
    $ret = array();
    foreach ($array as $img) {
        $ret[] = array(
            'src' => $img->getAttribute('src'),
            'width' => $img->getAttribute('width'),
            'height' => $img->getAttribute('height'),
            'title' => $img->getAttribute('title'),
            'name' => $img->getAttribute('name'));
    }
    return $ret;
}
}
?>