<?php
    include("db/db_cn.php");
    require_once("./dompdf/autoload.inc.php");

    use Dompdf\Dompdf;
    extract($_POST);
    
    $dompdf = new Dompdf();
    $sql = "SELECT * FROM LOP";
        $query = mysqli_query($conn, $sql);
        $html ='';
        $html.= '
            <h2 style="text-align: center;">Thong ke danh sach lop hoc</h2>
            <table style ="width :100%; border-collapse: collapse;">
            <tr>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left">Ma lop hoc</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left">Ten lop hoc</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left">Nien khoa</th>
            </tr>
        ';
        if(mysqli_num_rows($query) > 0) {
            foreach($query as $data) {
                $html .= '
                    <tr>
                    <td style ="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data["MALP"] . '</td>
                    <td style ="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data["TENLP"] . '</td>
\                    <td style ="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data["NK"] . '</td>
\                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr>
                    <td colspan ="4" style ="border: 1px solid #ddd; padding: 8px; text-align: left;">Khong co du lieu</td>
                </tr>
            ';
        }
    $html .= '</table>';
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4", "lnandscape");
    $dompdf->render();
    $dompdf->stream("thongkedanhsachlophoc.pdf");
?>


