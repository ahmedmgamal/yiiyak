TODO
-Make xml dynmic 
-Add xml fileds in description 
-load medra 
-improve security
-add xml refrence  




xml must have files 
====================

A.1 Case
    A.1.0.1 Sender’s (case) safety report unique identifier
    A.1.1 Identification of the country of the primary source
 ==>A.1.4 Type of report
 ==>A.1.5 Seriousness
 ==>A.1.5.2. Seriousness criteria
    A.1.6 Date report was first received from source
    A.1.10 Worldwide unique case identification number.

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











missing fields:

icsr: 
            'primary_cource_county' => Yii::t('app', 'A.1.1: country of primary source '),
            'report_type' => Yii::t('app', 'A.1.4: Spontaneous report,Report from study,Other,Not available to sender (unknown)'),
                
            'seriousness'=>    Yii::t('app', 'A.1.5.1 Serious (yes, no)'),
                'seriousnessdeath'=>    Yii::t('app', 'A.1.5.2'),           
                'seriousnesslifethreatening'=>    Yii::t('app', 'A.1.5.3'),         
                'seriousnesshospitalization'=>    Yii::t('app', 'A.1.5.4'),         
                'seriousnessdisabling'=>    Yii::t('app', 'A.1.5.5'),         
                'seriousnesscongenitalanomali'=>    Yii::t('app', 'A.1.5.6'),         
                'seriousnessother'=>    Yii::t('app', 'A.1.5.7'),         
            'report_first_received' => Yii::t('app', 'A.1.6 Date report was first received from source'),
            'ww_case_id' => Yii::t('app', 'A.1.10.2 Worldwide unique case identification number.'),
           
company:
A.3.1.2 Sender identifier

user
    sendertitle










post launch 
A.1.7 Date of receipt of the most recent information for this report
A.1.8.1 Are additional documents available?

A.2.2 Literature references
A.2.3 Study identification


A.3
A.3.1.1 Type (Pharmaceutical company, Regulatory authority, Health professional, Regional pharmacovigilance center, WHO collaborating center for international drug monitoring, Other (e.g., distributor, study sponsor, or contract research organization)
A.3.1.4 Sender’s address, fax, telephone, and E-mail address



B.1.2.2.1 Gestation period when reaction or event was observed in the fetus
B.1.2.3 Patient age group (as per reporter) Neonate,Infant,Child,Adolescent,Adult,Elderly
B.1.4 Height (cm)
B.1.5 Sex
B.1.6 Last menstrual period date
B.1.7 Relevant medical history and concurrent conditions (not including reaction or event)
B.1.8 Relevant past drug history (repeat the line as necessary)

B.1.10.1 Parent identification

inbetween 

B.1.9. In case of death
