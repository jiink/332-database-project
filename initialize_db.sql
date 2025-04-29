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
    PhoneNumber VARCHAR(7),
    MajorDepNumber INT
);

INSERT INTO Student (CWID, FirstName, LastName, StreetAddress, City, State, ZipCode, AreaCode, PhoneNumber) VALUES
(123456789, 'John', 'Doe', '123 Main St', 'Fullerton', 'CA', '92832', '714', '5551212', 100),
(987654321, 'Jane', 'Smith', '456 Oak Ave', 'Anaheim', 'CA', '92805', '657', '5553434', 200),
(112233445, 'Alice', 'Johnson', '789 Pine Rd', 'Irvine', 'CA', '92618', '949', '5556789', 300),
(556677889, 'Bob', 'Brown', '321 Elm St', 'Santa Ana', 'CA', '92701', '714', '5559876', 200),
(998877665, 'Charlie', 'Davis', '654 Maple Ln', 'Orange', 'CA', '92866', '657', '5554321', 400),
(338045367, 'Emily', 'Martinez', '112 Oak Dr', 'Tustin', 'CA', '92780', '714', '4972345', 300),
(671738190, 'David', 'Garcia', '445 Birch Blvd', 'Fullerton', 'CA', '92831', '657', '6758765', 100),
(489460132, 'Sophia', 'Lee', '233 Cedar Ave', 'Laguna Niguel', 'CA', '92677', '714', '5253456', 100);

CREATE TABLE Professor (
    SSN INT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Title VARCHAR(20),
    Salary DECIMAL(9, 2),
    Sex VARCHAR(10),
    StreetAddress VARCHAR(100),
    City VARCHAR(50),
    State CHAR(2),
    ZipCode VARCHAR(10),
    AreaCode CHAR(3),
    PhoneNumber VARCHAR(7)
);

INSERT INTO Professor (SSN, FirstName, LastName, Title, Salary, Sex, StreetAddress, City, State, ZipCode, AreaCode, PhoneNumber) VALUES
(943865930, 'David', 'Garcia', 'Doctor', 120000.00, 'Male', '445 Birch Blvd', 'Fullerton', 'CA', '92831', '657', '6758765'),
(837492615, 'Linda', 'Chung', 'Professor', 135000.00, 'Female', '128 Oakwood Dr', 'Berkeley', 'CA', '94720', '510', '4239821'),
(720394857, 'Michael', 'Stein', 'Associate Professor', 112500.00, 'Male', '92 Valley Rd', 'Palo Alto', 'CA', '94301', '650', '3891742'),
(605938174, 'Fatima', 'Rahman', 'Assistant Professor', 98000.00, 'Female', '310 Sunset Ave', 'Irvine', 'CA', '92617', '949', '7745938');

CREATE TABLE ProfessorDegree (
    ProfSSN INT,
    Degree VARCHAR(30) NOT NULL,
    PRIMARY KEY (ProfSSN, Degree)
);

INSERT INTO ProfessorDegree (ProfSSN, Degree) VALUES
(943865930, "Ph.D. in Computer Science"),
(943865930, "M.S. in Software Engineering"),
(837492615, "B.A. in English Literature"),
(720394857, "B.S. in Applied Mathematics"),
(605938174, "B.A. in International Relations");

CREATE TABLE Department (
    DepartmentNumber INT PRIMARY KEY,   -- Should this be a string, like how CSUF does CPSC or ENGL, etc.?
    DepartmentName VARCHAR(50),
    ChairSSN INT,
    Telephone VARCHAR(10),      -- Assuming all area codes will be the same, but you can change it to two attributes if you want
    OfficeLocation VARCHAR(50)
);

INSERT INTO Department (DepartmentNumber, DepartmentName, ChairSSN, Telephone, OfficeLocation) VALUES
(100, 'Mathematics', 720394857, '6575274123', 'Idk what goes here' ),
(200, 'English', 837492615, '6577940374', '' ),
(300, 'Political Science', 605938174, '6576938493', '' ),
(400, 'Computer Science', 943865930, '6575274123', '' );

CREATE TABLE Course (
    CourseNumber INT PRIMARY KEY,
    Title VARCHAR(50) NOT NULL,
    Textbook VARCHAR(50),
    Units INT,
    DepartmentNumber INT
);

INSERT INTO Course (CourseNumber, Title, Textbook, Units, DepartmentNumber) VALUES
(1010, 'Calculus I', 'Calculus: Early Transcendentals', 4, 100),
(1020, 'Linear Algebra', 'Introduction to Linear Algebra', 3, 100),
(2010, 'Introduction to Literature', 'The Norton Introduction to Literature', 3, 200),
(2020, 'Shakespearean Drama', 'The Complete Works of William Shakespeare', 3, 200),
(3010, 'Intro to Political Science', 'Essentials of Comparative Politics', 3, 300),
(3020, 'International Relations', 'World Politics: Trend and Transformation', 3, 300),
(4010, 'Intro to Programming', 'Python Crash Course', 3, 400),
(4020, 'Data Structures and Algorithms', 'Algorithms, 4th Edition', 3, 400);

CREATE TABLE CoursePrereqs (
    CourseNumber INT,
    PrereqNumber INT,
    PRIMARY KEY (CourseNumber, PrereqNumber)
);

INSERT INTO CoursePrereqs (CourseNumber, PrereqNumber) VALUES
(2020, 2010),
(3020, 3010),
(4020, 4010);

CREATE TABLE Minor (
    CWID INT,
    DepartmentNumber INT,
    PRIMARY KEY (CWID, DepartmentNumber)
);

INSERT INTO Minor (CWID, DepartmentNumber) VALUES
(123456789, 400),
(987654321, 300),
(998877665, 100);

CREATE TABLE Section (
    CourseNumber INT,
    SectionNumber INT,
    Classroom VARCHAR(50),
    ProfSSN INT,
    Seats INT,
    BeginTime INT,              -- Should the times be characters instead? Or it could be military time like 1400
    EndTime INT,
    MeetingDays VARCHAR(100)    -- Not sure if this should be a string or multi-valued attribute
);

INSERT INTO Section (CourseNumber, SectionNumber, Classroom, ProfSSN, Seats, BeginTime, EndTime, MeetingDays) VALUES
-- Calculus I
(1010, 10210, 'MH 101', 720394857, 35, 900, 1015, 'MWF'),
(1010, 10230, 'MH 103', 720394857, 30, 1400, 1515, 'TR'),

-- Linear Algebra
(1020, 17350, 'MH 201', 720394857, 40, 1100, 1215, 'MWF'),

-- Introduction to Literature
(2010, 11240, 'GH 202', 837492615, 30, 1000, 1115, 'TR'),
(2010, 23310, 'GH 204', 837492615, 28, 1300, 1415, 'MWF'),

-- Shakespearean Drama
(2020, 22900, 'GH 301', 837492615, 25, 930, 1045, 'MWF'),

-- Intro to Political Science
(3010, 13450, 'UH 105', 605938174, 50, 1030, 1145, 'TR'),

-- International Relations
(3020, 24820, 'UH 106', 605938174, 40, 800, 915, 'MWF'),

-- Intro to Programming
(4010, 10710, 'CS 101', 943865930, 45, 1200, 1315, 'MWF'),
(4010, 10720, 'CS 102', 943865930, 40, 1500, 1615, 'TR'),

-- Data Structures and Algorithms
(4020, 85920, 'CS 201', 943865930, 35, 900, 1015, 'MWF');

CREATE TABLE Enrollment (
    CWID INT,
    SectionNumber INT,
    Grade VARCHAR(2),
    PRIMARY KEY (CWID, SectionNumber)
);

INSERT INTO Enrollment (CWID, SectionNumber, Grade) VALUES
-- John Doe (Math Major)
(123456789, 10210, 'A'),  -- Calculus I
(123456789, 17350, 'B'),  -- Linear Algebra
(123456789, 11240, 'B'),  -- Introduction to Literature

-- Jane Smith (English Major)
(987654321, 11240, 'A'),  -- Introduction to Literature
(987654321, 13450, 'A'),  -- Intro to Political Science

-- Alice Johnson (Political Science Major)
(112233445, 13450, 'A'),  -- Intro to Political Science
(112233445, 24820, 'C'),  -- International Relations
(112233445, 10710, 'C'),  -- Intro to Programming

-- Bob Brown (English Major)
(556677889, 11240, 'B'),  -- Introduction to Literature
(556677889, 24820, 'A'),  -- International Relations

-- Charlie Davis (CS Major)
(998877665, 10710, 'A'),  -- Intro to Programming
(998877665, 85920, 'B'),  -- Data Structures and Algorithms
(998877665, 10210, 'B'),  -- Calculus I

-- Emily Martinez (Political Science Major)
(338045367, 13450, 'A'),  -- Intro to Political Science
(338045367, 24820, 'B'),  -- International Relations
(338045367, 17350, 'D'),  -- Linear Algebra

-- David Garcia (Math Major)
(671738190, 10210, 'B'),  -- Calculus I
(671738190, 17350, 'A'),  -- Linear Algebra
(671738190, 13450, 'A'),  -- Intro to Political Science

-- Sophia Lee (Math Major)
(489460132, 10210, 'C'),  -- Calculus I
(489460132, 17350, 'A')   -- Linear Algebra
