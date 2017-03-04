# PV Radar #
[Roadmap](Roadmap)
TODO
-verfy all exsiting fileds are in column comments 
-Make xml dynmic 
-Add xml fileds in description 
-load medra 
-improve security
-add xml refrence  


drug presecritopn 
	show drug list of the comapnyy 
icsr event
	icsr list : remove list all icsr events link 
fix date conversion issue 
remove $patient_weight_unit
remove more info from test
use of active ssubtance vs traade name 


question 
what is the diffece betwenn A.1.0.1, A.1.10.2, 

xml must have files 
====================

A.1 Case
     A.1.0.1 Sender’s (case) safety report unique identifier
     A.1.1 Identification of the country of the primary source
     A.1.3 Date of this transmission
     A.1.4 Type of report
     A.1.5 Seriousness
     A.1.5.2. Seriousness criteria
     A.1.6 Date report was first received from source
     A.1.10 Worldwide unique case identification number.
     A.1
A.2 Reporter
    A.2.1.1 Reporter identifier (name or initials)
    A.2.1.2 Reporter’s address
    A.2.1.3 Country
    A.2.1.4 Qualification

A.3 Sender and reviver 
    A.3.1.1 Sender Type 
    A.3.1.2 Sender identifier
==> A.3.1.3 Person responsible for sending the report
    A.3.2.1 Receiver Type


B.1 Patient  
    B.1.1 Patient (name or initials)
    B.1.2.1 Date of birth
    B.1.2.2 Age at time of onset of reaction / event
    B.1.3 Weight (kg)
    B.1.7.2 Text for relevant medical history and concurrent conditions (not including reaction/event)



B.2 Reactions or events
    B.2.i.0 Reaction or event as reported by the primary source
    B.2.i.1 Reaction or event in MedDRA terminology (Lowest Level Term)
    B.2.i.2 Reaction or event in MedDRA terminology (Preferred Term)
    B.2.i.4 Date of start of reaction or event
	B.2.i.5 Date of end of reaction or event
	B.2.i.8 Outcome of reaction or event at the time of last observation (Recovered/resolved,Recovering/resolving,Not recovered/not resolved,Recovered/resolved with sequelae,Fatal,Unknown

B.3
    B.3.1 Structured information (repeat as necessary)
    B.3.2 Results of tests and procedures relevant to the investigation

B.4
	B.4.k.1 Characterization of drug role (Suspect/Concomitant/Interacting)
	B.4.k.2 Drug identification
	B.4.k.3 Batch/lot number
	B.4.k.6 Dosage text
	B.4.k.8 Route of administration
	B.4.k.11 Indication for use in the case
	B.4.k.12 Date of start of drug
	B.4.k.14 Date of last administration
	B.4.k.15 Duration of drug administration
	B.4.k.16 Action(s) taken with drug (− Drug withdrawn,− Dose reduced,− Dose increased,− Dose not changed,− Unknown,− Not applicable)
	B.4.k.17 Effect of rechallenge
	B.4.k.19 Additional information on drug
	











Post launch 
===========
A.1
	A.1.2 Identification of the country where the reaction / event occurred
    A.1.7 Date of receipt of the most recent information for this report
    A.1.8.1 Are additional documents available?
    A.1.11 Other case identifiers in previous transmissions
    
A.2
    A.2.2 Literature references
    A.2.3 Study identification


A.3
    A.3.1.1 Type (Pharmaceutical company, Regulatory authority, Health professional, Regional pharmacovigilance center, WHO collaborating center for international drug monitoring, Other (e.g., distributor, study sponsor, or contract research organization)
    A.3.1.4 Sender’s address, fax, telephone, and E-mail address


B.1
    B.1.2.2.1 Gestation period when reaction or event was observed in the fetus
    B.1.2.3 Patient age group (as per reporter) Neonate,Infant,Child,Adolescent,Adult,Elderly
    B.1.4 Height (cm)
    B.1.5 Sex
    B.1.6 Last menstrual period date
    B.1.7.1 Relevant medical history and concurrent conditions (not including reaction or event)(strctured) 
    B.1.8 Relevant past drug history (repeat the line as necessary)
===>B.1.9. In case of death

    B.1.10.1 Parent identification
B.2
    B.2.i.3 Term highlighted by the reporter
==>	B.2.i.6 Duration of reaction or event    
==> B.2.i.7 Time intervals between suspect drug administration and start of reaction or event

B.4
=>?	B.4.k.2.2 Active substance name(s)
	B.4.k.2.3 Identification of the country where the drug was obtained.
=>  B.4.k.4 Holder and authorization/application number of drug (needs expalination)
	B.4.k.7 Pharmaceutical form (Dosage form)
	B.4.k.9 Parent route of administration (in case of a parent child/fetus report)
	B.4.k.10 Gestation period at time of exposure
	B.4.k.13 Time intervals between drug administration and start of reaction/event
	B.4.k.17.2 If yes to item B.4.k.17.1, which reaction(s)/event(s) recurred?
===>B.4.k.18 Relatedness of drug to reaction(s)/event(s) (repeat B.4.k.18.1 through B.4.k.18.4 as necessary)

B.5 Narrative case summary and further information
