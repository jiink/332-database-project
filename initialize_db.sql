-- This will delete the "cs332s3" database, create a new one, and fill it
-- with sample data.

DROP DATABASE IF EXISTS cs332s3;
CREATE DATABASE cs332s3;
USE cs332s3;

CREATE TABLE Student (
    CWID INT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    StreetAddress VARCHAR(100),
    City VARCHAR(50),
    State CHAR(2),
    ZipCode VARCHAR(10),
    AreaCode CHAR(3),
    PhoneNumber VARCHAR(7)
);

INSERT INTO Student (CWID, FirstName, LastName, StreetAddress, City, State, ZipCode, AreaCode, PhoneNumber) VALUES
(123456789, 'John', 'Doe', '123 Main St', 'Fullerton', 'CA', '92832', '714', '5551212'),
(987654321, 'Jane', 'Smith', '456 Oak Ave', 'Anaheim', 'CA', '92805', '657', '5553434'),
(112233445, 'Alice', 'Johnson', '789 Pine Rd', 'Irvine', 'CA', '92618', '949', '5556789'),
(556677889, 'Bob', 'Brown', '321 Elm St', 'Santa Ana', 'CA', '92701', '714', '5559876'),
(998877665, 'Charlie', 'Davis', '654 Maple Ln', 'Orange', 'CA', '92866', '657', '5554321');
