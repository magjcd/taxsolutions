<form action="index?page=clFiled" method="post" style="text-align: center;">
	<select name="taxYr" class="gjFldL" dir="rtl">
		<option value="">Select Tax Year</option>
		<?php
		$txyear = 2000;
		for($i = $txyear; $i <= 2050; $i++){
		?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
	</select><br />	
	<input type="submit" value="GET DATA" class="gjFldL">
</form>

<?php
if(isset($_POST['taxYr'])){

$noClFiled = $ContObj->noClFiled($_POST['taxYr']);
// echo '<pre>';
// print_r($noClFiled);


$html = '<table>
<tr><td colspan="5" style="text-align: center;"><h2>Return Filing Status</h2></td><td><a href="view/clFiledPdf.php?taxYr='.$_POST['taxYr'].'"><i class="fa fa-file-pdf fa-lg fa-fw"></i></a></td></tr>
<tr><td colspan="6" style="text-align: center;"><h4>for Year '.$_POST['taxYr'].'</h4></td></tr>
<tr>
<th>Town Name</th>
<th style="text-align: right;">Cases</th>
<th style="text-align: right;">Cases Filed</th>
<th style="text-align: right;">Ach %</th>
<th style="text-align: right;">Cases Rem</th>
<th style="text-align: right;">Rem %</th>
</tr>';

foreach($noClFiled as $noClFiledDet){


	$ratio = (($noClFiledDet['NoLedCases'] / $noClFiledDet['NoCases']) * 100);
	$pending = ($noClFiledDet['NoCases'] - $noClFiledDet['NoLedCases']);
	$rem = (($pending / $noClFiledDet['NoCases']) * 100);
	$html .= '<tr>
	<td>'.$noClFiledDet['cityNm'].'</td>
	<td style="text-align: right;">'.$noClFiledDet['NoCases'].'</td>
	<td style="text-align: right;">'.$noClFiledDet['NoLedCases'].'</td>
	<td style="text-align: right;">'.number_format($ratio,2).'%</td>
	<td style="text-align: right;">'.$pending.'</td>
	<td style="text-align: right;">'.number_format($rem,2).'%</td></tr>';
}
$html .= '</table><br /><br /><br />';

echo $html;
}
// include('vendor/autoload.php');
// $mpdf = new \Mpdf\Mpdf();
// $mpdf->debug = true;
// $mpdf->WriteHTML($html);
// //$file = './pdf/'.$userNm.' '.date('d_m_Y_h_i_s_A').'.pdf';
// $file = date('d_m_Y_h_i_s_A').'.pdf';
// ob_clean();
// $mpdf->Output($file,'D');	
// //header('location: index?page=DWvRetTrk');
?>