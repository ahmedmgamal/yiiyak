<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/d4b4964a63cc95065fa0ae19074007ee
 *
 * @package default
 */


use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

 $config = \Yii::$app->getModule('crud')->params;

?>
 
<!DOCTYPE ichicsr SYSTEM "ich-icsr-v2_1.dtd">
<ichicsr lang="en">
	<ichicsrmessageheader>
		<messagetype>ICSR</messagetype>
		<messageformatversion>2.1</messageformatversion>
		<messageformatrelease>1.0</messageformatrelease>
		<messagenumb><?php echo $model->id; ?></messagenumb>
		<messagesenderidentifier><?php echo $model->getDrug()->one()->getCompany()->one()->name;  ?></messagesenderidentifier>
		<messagereceiveridentifier><?php echo $config['messagereceiveridentifier'] ?></messagereceiveridentifier>
		<messagedateformat>102</messagedateformat>
		<messagedate><?php echo date("Ymd"); ?> </messagedate>
	</ichicsrmessageheader>
	<safetyreport>
		<safetyreportversion>1.0</safetyreportversion>
		<safetyreportid> EG-<?php echo $model->getDrug()->one()->getCompany()->one()->name;  ?>-<?php echo $model->id; ?></safetyreportid>
		<primarysourcecountry>EG</primarysourcecountry>
		<occurcountry>EG</occurcountry>
		<transmissiondateformat>102</transmissiondateformat>
		<transmissiondate><?php echo date("Ymd"); ?> </transmissiondate>
		<reporttype>1</reporttype>
 
                <receiptdateformat>102</receiptdateformat>
		<receiptdate><?php echo date("Ymd"); ?> </receiptdate>
 
		<primarysource>
  
		</primarysource>

		<sender>
 			<senderorganization>pharmaceutical company</senderorganization>
 		</sender>
		<receiver>
			<receivertype>6</receivertype>
		</receiver>
		<patient>
  
			<reaction>
				
			</reaction>
 			<drug>
			 
			</drug>
 		</patient>
	</safetyreport>
</ichicsr>
