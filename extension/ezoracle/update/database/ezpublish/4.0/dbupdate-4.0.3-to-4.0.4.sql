UPDATE ezsite_data SET value='4.0.4' WHERE name='ezpublish-version';
UPDATE ezsite_data SET value='1' WHERE name='ezpublish-release';

ALTER TABLE ezworkflow_event MODIFY (
    data_text1 VARCHAR2(255),
    data_text2 VARCHAR2(255),
    data_text3 VARCHAR2(255),
    data_text4 VARCHAR2(255));
