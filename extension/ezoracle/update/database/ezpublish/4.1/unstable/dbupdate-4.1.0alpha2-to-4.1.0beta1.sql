UPDATE ezsite_data SET value='4.1.0beta1' WHERE name='ezpublish-version';
UPDATE ezsite_data SET value='1' WHERE name='ezpublish-release';

ALTER TABLE ezsession ADD user_hash VARCHAR2( 32 ) NOT NULL;
