DELIMITER $$
CREATE FUNCTION get_A (drugId INT, event_name VARCHAR(512))
  RETURNS INT
DETERMINISTIC
  BEGIN
    DECLARE A INT;
    SELECT count(Events.event_description) INTO A
    FROM drug
    INNER JOIN icsr
    ON(icsr.drug_id = drug.id)
    INNER JOIN icsr_event as Events
    ON(Events.icsr_id = icsr.id)
    WHERE drug.id = drugId
    AND Events.event_description = event_name;
    RETURN A;
  END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION get_AB(drugId INT)
  RETURNS INT
DETERMINISTIC
  BEGIN
    DECLARE AB INT;
    SELECT count(Events.event_description) INTO AB
    FROM drug
      INNER JOIN icsr
        ON(icsr.drug_id = drug.id)
      INNER JOIN icsr_event as Events
        ON(Events.icsr_id = icsr.id)
    WHERE drug.id = drugId;
    RETURN AB;
  END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION get_C (drugId INT, event_name VARCHAR(512))
  RETURNS INT
DETERMINISTIC
  BEGIN
    DECLARE C INT;
    SELECT count(Events.event_description) INTO C
    FROM drug
      INNER JOIN icsr
        ON(icsr.drug_id = drug.id)
      INNER JOIN icsr_event as Events
        ON(Events.icsr_id = icsr.id)
    WHERE drug.id != drugId
          AND Events.event_description = event_name;
    RETURN C;
  END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION get_CD(drugId INT)
  RETURNS INT
DETERMINISTIC
  BEGIN
    DECLARE CD INT;
    SELECT count(Events.event_description) INTO CD
    FROM drug
      INNER JOIN icsr
        ON(icsr.drug_id = drug.id)
      INNER JOIN icsr_event as Events
        ON(Events.icsr_id = icsr.id)
    WHERE drug.id != drugId;
    RETURN CD;
  END$$
DELIMITER ;


CREATE VIEW V_signal_detection AS
  SELECT
    drug.id as "drug_id",
    Events.event_description ,
    get_A(drug.id , Events.event_description) AS "A",
    get_AB(drug.id) as "AB",
    get_C(drug.id , Events.event_description) AS "C",
    get_CD(drug.id) AS "CD"
  FROM drug
    INNER JOIN icsr
      ON(icsr.drug_id = drug.id)
    INNER JOIN icsr_event as Events
      ON(Events.icsr_id = icsr.id)
  GROUP BY Events.event_description;

select * from V_signal_detection
where drug_id = 6

