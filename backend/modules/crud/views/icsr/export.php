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
 \Yii::$app->formatter->booleanFormat = [2,1];
 $formatter = \Yii::$app->formatter;
  
?>
<ichicsr lang="en">
	<ichicsrmessageheader>
		<messagetype>ICSR</messagetype>
		<messageformatversion>2.1</messageformatversion>
		<messageformatrelease>1.0</messageformatrelease>
		<messagenumb><?php echo $model->getReactionCountry()->one()->code.'-'.$model->getDrug()->one()->getCompany()->one()->short_name.'-'.$model->id; ?></messagenumb>
		<messagesenderidentifier><?php echo $model->getDrug()->one()->getCompany()->one()->short_name;  ?></messagesenderidentifier>
		<messagereceiveridentifier><?php echo $config['messagereceiveridentifier'] ?></messagereceiveridentifier>
		<messagedateformat>102</messagedateformat>
		<messagedate><?php echo date("Ymd"); ?> </messagedate>
	</ichicsrmessageheader>
	<safetyreport>


		<!--A.1.0.1 Sender’s (case) safety report unique identifier-->
		<safetyreportid> EG-<?php echo $model->getDrug()->one()->getCompany()->one()->short_name;  ?>-<?php echo $model->id; ?></safetyreportid>

		<!--     A.1.1 Identification of the country of the primary source -->
		<primarysourcecountry><?php echo $model->getReactionCountry()->one()->code; ?></primarysourcecountry>
		

		<!--     A.1.4 Type of report --> 
		<reporttype><?php echo $model->getIcsrType()->one()->id; ?></reporttype>
 		
 		<!--A.1.5 Seriousness -->
 		<serious><?php echo $formatter->asBoolean( $model->is_serious); ?></serious>

		<!--A.1.5.2. Seriousness criteria-->
		<seriousnessdeath><?php echo  $formatter->asBoolean( $model->results_in_death); ?></seriousnessdeath>
		<seriousnesslifethreatening><?php echo  $formatter->asBoolean( $model->life_threatening); ?></seriousnesslifethreatening>
		<seriousnesshospitalization><?php echo  $formatter->asBoolean( $model->requires_hospitalization); ?></seriousnesshospitalization>
		<seriousnessdisabling><?php echo  $formatter->asBoolean( $model->results_in_disability); ?></seriousnessdisabling>
		<seriousnesscongenitalanomali><?php echo  $formatter->asBoolean( $model->is_congenital_anomaly); ?></seriousnesscongenitalanomali>
		<seriousnessother><?php echo  $formatter->asBoolean( $model->others_significant); ?></seriousnessother>
		
		<!--*** A.1.6 Date report was first received from source-->
		<receivedateformat>102</receivedateformat>
		<receivedate>19970102</receivedate>

        <!--*** A.1.7	Date of receipt of the most recent information for this report --> 
        <receiptdateformat>102</receiptdateformat>
		<receiptdate><?php echo date("Ymd"); ?> </receiptdate>
		<authoritynumb> 'EG'<?php echo'-'.$model->getDrug()->one()->getCompany()->one()->short_name.'-'.$model->id; ?></authoritynumb>

		<?php if (isset($nullReason)){?>
		<!--A.1.13	 -->
		<casenullification>1</casenullification>

		<!--A.1.13.1	    -->
		<nullificationreason><?php echo $nullReason; ?></nullificationreason>
		<?php }?>

		<?php foreach($model->icsrReporters as $reporter){ ?>
			<primarysource>
				<!-- A.2.1.4	Qualification           -->
				<qualification> <?php echo $reporter->getOccupationLkp()->one()->id ?> </qualification>

			</primarysource>  
	 
		<?php } ?>
 
	
	<!-- A.3	Sender	and reviver          -->
		<sender>
 			
<!-- A.3.1.1	Sender Type          -->
			<sendertype>1</sendertype>
					
<!--	A.3.1.2	Sender identifier          -->
			<senderorganization><?php echo Yii::$app->user->identity->getCompany()->one()->short_name;  ?></senderorganization>

<!-- A.3.1.4l E-mail address -->
 			<senderemailaddress><?php echo Yii::$app->user->identity->email;  ?></senderemailaddress>

 		</sender>


		<receiver/>

		<patient>

<!--  B.1.2.1	Date of birth         -->
			<patientbirthdateformat>102</patientbirthdateformat>
            <patientbirthdate><?php echo  date('Ymd',strtotime($model->patient_birth_date))  ; ?></patientbirthdate>
<!--  B.1.2.2	Age at time of onset of reaction / event   -->
			<patientonsetage><?php echo $model->patient_age ; ?></patientonsetage>
			<patientonsetageunit><?php echo $model->patient_age_unit ; ?></patientonsetageunit>
<!--  B.1.3	Weight (kg)          -->
			<patientweight><?php echo $model->patient_weight ; ?></patientweight>

<!--  B.1.7.2	Text for relevant medical history and concurrent conditions (not including reaction/event) -->
			<patientmedicalhistorytext><?php echo $model->extra_history ; ?></patientmedicalhistorytext>

	<?php foreach($model->icsrEvents as $event){ ?>
			<reaction>
<!--  B.2.i.0	Reaction or event as reported by the primary source   -->
				<primarysourcereaction><?php echo $event->event_description ; ?></primarysourcereaction>

<!--  B.2.i.1	Reaction or event in MedDRA terminology (Lowest Level Term)   -->
				<reactionmeddraversionllt> <?php echo $config['meddraversion'] ?> </reactionmeddraversionllt>
				<reactionmeddrallt><?php echo isset($event->meddra_llt_id)?$event->getMeddraLlt()->one()->term:$event->meddra_llt_text ; ?></reactionmeddrallt>

<!--  B.2.i.4	Date of start of reaction or event     -->
				<reactionstartdateformat>102</reactionstartdateformat>
				<reactionstartdate><?php echo date('Ymd',strtotime($event->event_date)) ; ?></reactionstartdate>
<!--  B.2.i.5	Date of end of reaction or event     -->
				<reactionenddateformat>102</reactionenddateformat>
				<reactionenddate><?php echo date('Ymd',strtotime($event->event_end_date)) ; ?></reactionenddate>

<!--  B.2.i.8	Outcome of reaction or event at the time of last observation (Recovered/resolved,Recovering/resolving,Not-->
				<reactionoutcome><?php echo $event->lkp_icsr_eventoutcome_id ; ?></reactionoutcome>


			</reaction>
	<?php } ?>



		<?php foreach($model->drugPrescriptions as $drug){ ?>
		<drug>
<!--  B.4.k.1	Characterization of drug role (Suspect/Concomitant/Interacting)    -->   
				<drugcharacterization><?php echo $drug->drug_role ; ?></drugcharacterization>

<!--  B.4.k.2	Drug identification           -->

 <?php if(empty($drug->active_substance_names)) { ?>

				<medicinalproduct><?php echo $model->drug->trade_name ; ?></medicinalproduct>

				<?php } else {?>
				<medicinalproduct><?php echo $drug->active_substance_names ; ?></medicinalproduct>

		<?php }?>

		</drug>
	<?php } ?>
		<?php if (isset($model->narrative->id)){ ?>
			<!-- B.5 Narrative case summary and further information-->
			<summary>
				<!-- B.5.1 Case narrative including clinical course, therapeutic measures, outcome and additional relevant information -->
				<narrativeincludeclinical><?php echo $model->narrative->narritive ?></narrativeincludeclinical>
			</summary>
			<?php }?>
 		</patient>
	</safetyreport>
</ichicsr>
