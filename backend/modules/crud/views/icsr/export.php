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
		<messagenumb><?php echo $model->id; ?></messagenumb>
		<messagesenderidentifier><?php echo $model->getDrug()->one()->getCompany()->one()->name;  ?></messagesenderidentifier>
		<messagereceiveridentifier><?php echo $config['messagereceiveridentifier'] ?></messagereceiveridentifier>
		<messagedateformat>102</messagedateformat>
		<messagedate><?php echo date("Ymd"); ?> </messagedate>
	</ichicsrmessageheader>
	<safetyreport>
		<safetyreportversion>1.0</safetyreportversion>

		<!--A.1.0.1 Sender’s (case) safety report unique identifier-->
		<safetyreportid> <?php echo $model->getReactionCountry()->one()->code; ?>-<?php echo $model->getDrug()->one()->getCompany()->one()->name;  ?>-<?php echo $model->id; ?></safetyreportid>

		<!--     A.1.1 Identification of the country of the primary source -->
		<primarysourcecountry><?php echo $model->getReactionCountry()->one()->code; ?></primarysourcecountry>
		
		<!--      A.1.3 Date of this transmission -->
		<transmissiondateformat>102</transmissiondateformat>
		<transmissiondate><?php echo date("Ymd"); ?> </transmissiondate>

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
		
		<!--A.1.10	Worldwide unique case identification number.      --> 
		<companynumb> <?php echo $model->getReactionCountry()->one()->code; ?>-<?php echo $model->getDrug()->one()->getCompany()->one()->name;  ?>-<?php echo $model->id; ?></companynumb>
 
		<?php foreach($model->icsrReporters as $reporter){ ?>
			<primarysource>
				<!--A.2.1.1	Reporter identifier (name or initials)       -->
				<reportergivename><?php echo $reporter->first_name ?></reportergivename>
				<reporterfamilyname><?php echo $reporter->last_name ?></reporterfamilyname>
				
				<!-- A.2.1.2	Reporter’s address          -->
				<reporterstreet><?php echo $reporter->address_line_1  ?> <?php echo $reporter->address_line_2  ?> </reporterstreet>
				<reportercity><?php echo $reporter->city  ?></reportercity>
				<reporterstate><?php echo $reporter->state  ?></reporterstate>
				<reporterpostcode><?php echo $reporter->zip_code  ?></reporterpostcode>
			
				<!--  A.2.1.3	Country           -->
				<reportercountry><?php echo $reporter->getCountryLkp()->one()->code; ?></reportercountry>
				
				<!-- A.2.1.4	Qualification           -->
				<qualification> <?php echo $reporter->getOccupationLkp()->one()->id ?> </qualification>

			</primarysource>  
	 
		<?php } ?>
 
	
	<!-- A.3	Sender	and reviver          -->
		<sender>
 			
<!-- A.3.1.1	Sender Type          -->
			<sendertype>1</sendertype>
					
<!--	A.3.1.2	Sender identifier          -->
			<senderorganization><?php echo Yii::$app->user->identity->getCompany()->one()->name;  ?></senderorganization>

<!--***	A.3.1.3	Person responsible for sending the report      -->
			<sendergivename><?php echo Yii::$app->user->identity->username;  ?></sendergivename>

<!-- A.3.1.4l E-mail address -->
 			<senderemailaddress><?php echo Yii::$app->user->identity->email;  ?></senderemailaddress>

 		</sender>
 

		<receiver>
			 <!--	A.3.2.1	Receiver Type          -->
			<receivertype>6</receivertype>
		</receiver>

		<patient>
<!--  B.1.1	Patient (name or initials)        -->
			<patientinitial><?php echo $model->patient_identifier  ?></patientinitial>

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
				<reactionmeddrallt><?php echo isset($event->meddra_llt_id)?$event->getMeddraLlt()->one()->code:$event->meddra_llt_text ; ?></reactionmeddrallt>
<!--  B.2.i.2	Reaction or event in MedDRA terminology (Preferred Term)    -->
				<reactionmeddraversionpt>  <?php echo $config['meddraversion'] ?> </reactionmeddraversionpt>
				<reactionmeddrapt><?php echo isset($event->meddra_pt_id)?$event->getMeddraPt()->one()->code:$event->meddra_pt_text ; ?></reactionmeddrapt>
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


	<?php foreach($model->icsrTests as $test){ ?>
		<test>
			<!--B.3.1	Structured information (repeat as necessary)       -->
				<testdateformat>102</testdateformat>
				<testdate><?php echo date('Ymd',strtotime($test->date)) ; ?></testdate>
				<testname>	<?php echo isset($test->test_lkp_id)?$test->getTestLkp()->one()->name:$test->test_name ; ?></testname>
				<testresult><?php echo $test->result ; ?></testresult>
				<testunit><?php echo $test->result_unit ; ?></testunit>
				<lowtestrange><?php echo $test->normal_low_range ; ?></lowtestrange>
				<hightestrange><?php echo $test->normal_high_range ; ?></hightestrange>
				<moreinformation><?php echo $test->more_info ; ?></moreinformation>
			
		</test>
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
 <!--  B.4.k.3	Batch/lot number           -->
				<drugbatchnumb><?php echo $drug->lot_no ; ?></drugbatchnumb>

<!--  B.4.k.6	Dosage text           -->
				<drugdosagetext><?php echo $drug->dose ; ?></drugdosagetext>

<!--  B.4.k.8	Route of administration   -->       
				<drugadministrationroute><?php echo empty($drug->active_substance_names) ? $model->drug->route_lkp_id:'' ; ?></drugadministrationroute>

<!--  B.4.k.11	Indication for use in the case       -->
				<drugindication><?php echo $drug->reason_of_use ; ?></drugindication>
<!--  B.4.k.12	Date of start of drug        -->
				<drugstartdateformat>102</drugstartdateformat>
				<drugstartdate><?php echo date('Ymd',strtotime($drug->use_date_start)) ; ?></drugstartdate>
<!--  B.4.k.14	Date of last administration      -->  
 				<drugenddateformat>102</drugenddateformat>
				<drugenddate><?php echo date('Ymd',strtotime($drug->use_date_end)) ; ?></drugenddate>
<!--  B.4.k.15	Duration of drug administration      -->   
				<drugtreatmentduration><?php echo $drug->duration_of_use ; ?></drugtreatmentduration>
				<drugtreatmentdurationunit><?php echo $drug->duration_of_use_unit ; ?></drugtreatmentdurationunit>
<!--  B.4.k.16	Action(s) taken with drug (− Drug withdrawn,− Dose reduced,− Dose increased,− Dose -->

			<actiondrug><?= $drug->lkp_drug_action_id ?></actiondrug>


<!--  B.4.k.17	Effect of rechallenge          -->
				<drugrecurreadministration><?php echo  $drug->problem_returned_after_reuse ; ?></drugrecurreadministration>

<!--  B.4.k.19	Additional information on drug     -->    
				<drugadditional><?php echo $drug->drug_addtional_info ; ?></drugadditional>
			</drug>
	<?php } ?>

 		</patient>
	</safetyreport>
</ichicsr>
