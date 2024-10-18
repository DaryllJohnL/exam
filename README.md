# User Management System

This project is a User Management System that allows for the creation, retrieval, updating, and deletion of user information. The system is built using PHP and uses MySQL for data storage. Below are the details on how to set up and use the `users` table.

## Table Structure

The application utilizes a `users` table to store user information. The schema for the `users` table is as follows:

```sql
CREATE TABLE smusertest1.users (
    USER_ID INT PRIMARY KEY AUTO_INCREMENT,
    USERNAME VARCHAR(55),
    PASSWORD VARCHAR(100),
    FIRST_NAME VARCHAR(50),
    MIDDLE_NAME VARCHAR(50),
    LAST_NAME VARCHAR(50),
    FULL_NAME VARCHAR(150),
    BIRTHDATE DATE,
    MOBILE_NO BIGINT(11),
    COMPANY VARCHAR(10),
    STORE_CODE VARCHAR(25),
    ENV_CODE VARCHAR(25),
    EMAIL VARCHAR(100),
    CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
    LAST_UPDATE_DATE DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE company_branch (
    COMPANY VARCHAR(10) NOT NULL,
    COMPANY_DESC VARCHAR(50),
    STORE_CODE VARCHAR(10) NOT NULL,
    STORE_DESC VARCHAR(50),
    STORE_GROUP VARCHAR(50),
    CHOSEN VARCHAR(1),
    ABBR VARCHAR(200),
    ENV_CODE VARCHAR(50),
    ENV INT,
    SECTORE_CODE VARCHAR(10) NOT NULL,
    SECTOR VARCHAR(50),
    STORE_OPENING_DATE DATE
);
