/*
*   
*   This lists the create tables sql for the tables, laying out the scheme of the database tables
*   
*/

 CREATE TABLE IF NOT EXISTS user(
   email VARCHAR(100) NOT NULL UNIQUE,
   password VARCHAR(100) NOT NULL,
   userName VARCHAR(40) NOT NULL,
   reg_code VARCHAR( 255 ) default NULL,
   PRIMARY KEY ( email )
  );

/*
*   This creates a table library that has an id incremented automatically
*   The display name is set by the uer and names the library
*   The owner email is a foreign key. It references the user table and,
*   when the value of email is updated in user the change is "cascaded" 
*   to this table, and when it is deleted the table rows are deleted.
*/

CREATE TABLE IF NOT EXISTS library(
    id INT UNSIGNED AUTO_INCREMENT UNIQUE,
    displayName VARCHAR(100) NOT NULL,
    ownerEmail VARCHAR(100) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(ownerEmail)
        REFERENCES user(email)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
*   Creates table of libraries shared between users
*/

CREATE TABLE IF NOT EXISTS shareLib(
    id INT UNSIGNED AUTO_INCREMENT UNIQUE,
    libID INT UNSIGNED NOT NULL,
    sharedUser VARCHAR(100) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(sharedUser) REFERENCES user(email)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(libID) REFERENCES library(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS reference(
    id INT UNSIGNED AUTO_INCREMENT UNIQUE,
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    url VARCHAR(255),
    publishMonth INT,
    publishYear YEAR,
    abstract VARCHAR(100),
    address VARCHAR(100),
    annote VARCHAR(100),
    bookTitle VARCHAR(100),
    chapter VARCHAR(100),
    crossReference VARCHAR(100),
    edition VARCHAR(100),
    eprint VARCHAR(100),
    institution VARCHAR(100),
    journal VARCHAR(100),
    bibtexKey VARCHAR(100),
    NOTE VARCHAR(255),
    issueNumber varchar(100),
    organisation VARCHAR(100),
    pages INT,
    Publisher VARCHAR(100),
    school VARCHAR(100),
    series VARCHAR(100),
    publishType VARCHAR(100),
    volume VARCHAR(100),
    dataAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    libraryID INT NOT NULL
);