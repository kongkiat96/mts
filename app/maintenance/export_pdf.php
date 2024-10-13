<?php
require '../../vendor/autoload.php';
require '../../core/config.core.php';
require '../../core/connect.core.php';
require '../../core/functions.core.php';
// สร้างตัวแปร mPDF พร้อมกำหนด encoding
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
// กำหนดระยะขอบ (ซ้าย, ขวา, บน, ล่าง)
$mpdf->SetMargins(2, 2, 5); // ระยะขอบ 15 มม. ด้านซ้าย ขวา และด้านบน
$mpdf->SetAutoPageBreak(true, 5); // กำหนดการตัดหน้าอัตโนมัติที่ 15 มม. ด้านล่าง
// ตั้งค่าฟอนต์เพื่อรองรับภาษาไทย
$mpdf->AddFontDirectory('../../font');
$mpdf->SetFont('THSarabunNew', '', 12);

// เปิดใช้งาน autoScriptToLang
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;

$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_set_charset($connect, "utf8");
date_default_timezone_set('Asia/Bangkok');
$system_info = $getdata->my_sql_query($connect, null, 'system_info', null);
$chk_case = $getdata->my_sql_query($connect, NULL, "building_list", "ticket='" . htmlspecialchars($_GET['key']) . "'");

if ($chk_case->pic_before == null) {
    $mapImg = '<img class="img-thumbnail" src="../../resource/bu/file_pic_now/no-img.png" width="40%">';
} else {
    $mapImg = '<img class="img-thumbnail" src="../../resource/bu/delevymo/' . $chk_case->pic_before . '" width="40%">';
}

// เนื้อหา PDF
$html = '
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ใบงานแจ้งซ่อมฝ่ายอาคาร (ช่าง)</title>
    <style>
        body { 
            font-family: "THSarabunNew", sans-serif; 
            margin: 20px; 
            font-size: 14px;
        }
        .card { 
            border: 1px solid #0a446c; 
            border-radius: 5px; 
            padding: 15px; 
        }
        .card-header { 
            background-color: #0a446c; 
            color: white; 
            padding: 10px; 
            text-align: center; 
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: 1em;
            text-align: right;
        }
        .text-highlight { 
            font-size: 0.9em; 
            color: #000; 
            margin: 0 5px;
            line-height: 1.5; 
        }
        .text-center { text-align: center; }
        .img-thumbnail { 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            padding: 5px; 
            max-width: 40%;
            height: auto;
        }
        .footer-label { 
            margin-top: 10px; 
            text-align: center; 
        }
        .remark { 
            border-top: 1px solid #000; 
            padding-top: 10px; 
            margin-top: 20px;
        }
        .signature-line {
            border-bottom: 1px dotted #000;
            width: 80%;
            margin: 10px auto;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3><b>ใบงานแจ้งซ่อมฝ่ายอาคาร (ช่าง)</b></h3>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <th>Ticket Number : </th>
                    <td class="text-highlight">' . $chk_case->ticket . '</td>
                </tr>
                <tr>
                    <th>รหัสสินทรัพย์ : </th>
                    <td class="text-highlight">' . $chk_case->as_code . '</td>
                </tr>
                <tr>
                    <th>ผู้แจ้ง : </th>
                    <td class="text-highlight">' . getemployee($chk_case->user_key) . '</td>
                </tr>
                <tr>
                    <th>วันที่แจ้งปัญหา : </th>
                    <td class="text-highlight">' . dateConvertor($chk_case->date) . '</td>
                </tr>
                <tr>
                    <th>หมวดหมู่ : </th>
                    <td class="text-highlight">' . service($chk_case->se_id) . '</td>
                </tr>
                <tr>
                    <th>ปัญหาที่พบ : </th>
                    <td class="text-highlight">' . prefixConvertorServiceList($chk_case->se_li_id) . '</td>
                </tr>
                <tr>
                    <th>ชื่อผู้แจ้ง : </th>
                    <td class="text-highlight">' . getemployee($chk_case->se_namecall) . '</td>
                </tr>
                <tr>
                    <th>สาขา : </th>
                    <td class="text-highlight">' . prefixbranch($chk_case->se_location) . '</td>
                </tr>
                <tr>
                    <th>รายละเอียดเพิ่มเติม : </th>
                    <td class="text-highlight">' . $chk_case->se_other . '</td>
                </tr>
                <tr>
                    <th>ผู้อนุมัติ : </th>
                    <td class="text-highlight">' . $chk_case->se_approve . '</td>
                </tr>
                <tr>
                    <th>เข้าดำเนินการ : </th>
                    <td class="text-highlight"></td>
                </tr>
                <tr>
                    <th>ปิดงาน : </th>
                    <td class="text-highlight"></td>
                </tr>
                <tr>
                    <th>รูปภาพก่อนแจ้ง : </th>
                    <td class="text-center">
                        ' . $mapImg . '
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-center footer-label">
            <div class="form-group">
                <div style="width: 50%; float: left;">
                    <label>ผู้ปฏิบัติงาน</label>
                    <div class="signature-line" style="margin-top: 50px"></div>
                </div>
                <div style="width: 50%; float: right;">
                    <label>ผู้ขอใช้บริการ</label>
                    <div class="signature-line" style="margin-top: 50px"></div>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div class="remark">
                <label>หมายเหตุเพิ่มเติม:</label>
                <p style="border-bottom: 1px dotted #000; padding-bottom: 20px;"></p>
                <p style="border-bottom: 1px dotted #000; padding-bottom: 20px;"></p>
            </div>
        </div>
    </div>
</body>
</html>

';


// เขียนเนื้อหาไปยัง PDF
$mpdf->WriteHTML($html);

// สร้าง PDF และดาวน์โหลด
$mpdf->Output('documentCase_' . $chk_case->ticket . '.pdf', 'I'); // 'I' สำหรับแสดงในเบราว์เซอร์, 'D' สำหรับดาวน์โหลด
