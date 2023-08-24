-- Create nrMigrations Table if not exists
--
------------------------------------------------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS nrMigrations (
  id INT NOT NULL AUTO_INCREMENT,
  identifier VARCHAR (128) NOT NULL default '',
  version INTEGER NOT NULL default 0,
  sqlfile VARCHAR (256) NOT NULL default '',
  executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  executed_by VARCHAR (128) NOT NULL default 'Unknown',
  PRIMARY KEY (id)
);
