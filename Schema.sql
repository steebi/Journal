/*
*   
*   This lists the create tables sql for the tables, laying out the scheme of the database tables
*   
*/

 CREATE TABLE IF NOT EXISTS user(
   email VARCHAR(100) NOT NULL,
   password VARCHAR(100) NOT NULL UNIQUE,
   userName VARCHAR(40) NOT NULL,
   reg_code VARCHAR( 255 ) default NULL,
   PRIMARY KEY ( email )
  );