-- Academic_Calendar
CREATE TABLE `Academic_Calendar` (
  `DATE` text,
  `CAMPUS_EVENTS` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Admin
CREATE TABLE `Admin` (
  `Admin_id` int NOT NULL,
  `Priority_level` int DEFAULT NULL,
  PRIMARY KEY (`Admin_id`),
  UNIQUE KEY `Admin_id_UNIQUE` (`Admin_id`),
  CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `Users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Advisor
CREATE TABLE `Advisor` (
  `Faculty_ID` int NOT NULL,
  `Student_ID` int NOT NULL,
  `Date_Assigned` text,
  PRIMARY KEY (`Faculty_ID`,`Student_ID`),
  KEY `Student_ID_idx` (`Student_ID`),
  CONSTRAINT `Advisor_ibfk_1` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Advisor_ibfk_2` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Student_ID` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Attendence
CREATE TABLE `Attendence` (
  `CRN` int NOT NULL,
  `Student_ID` int NOT NULL,
  `Class_Section` int DEFAULT NULL,
  `Attendance` text,
  `Date` text,
  `Course_Name` text,
  PRIMARY KEY (`CRN`,`Student_ID`),
  KEY `Student_ID` (`Student_ID`),
  CONSTRAINT `Attendence_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Building
CREATE TABLE `Building` (
  `BUILDING ID` varchar(45) NOT NULL,
  `BUILDING NAME` text,
  `BUILDING TYPE` text,
  PRIMARY KEY (`BUILDING ID`),
  UNIQUE KEY `BUILDING ID_UNIQUE` (`BUILDING ID`),
  CONSTRAINT `Building_ibfk_1` FOREIGN KEY (`BUILDING ID`) REFERENCES `Building` (`BUILDING ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Class
CREATE TABLE `Class` (
  `CRN` int NOT NULL,
  `Course_ID` int DEFAULT NULL,
  `Class_Section` int DEFAULT NULL,
  `Room_ID` text,
  `Faculty_ID` int DEFAULT NULL,
  `Timeslot_ID` text,
  `Semester_Year` text,
  PRIMARY KEY (`CRN`),
  KEY `Course_ID` (`Course_ID`),
  KEY `Faculty_ID` (`Faculty_ID`),
  CONSTRAINT `Class_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `Courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Class_ibfk_2` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Courses
CREATE TABLE `Courses` (
  `Course_ID` int NOT NULL,
  `Course_Name` text,
  `Course_Credit` int DEFAULT NULL,
  `Major` text,
  `Department_Name` text,
  PRIMARY KEY (`Course_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Day
CREATE TABLE `Day` (
  `Day_ID` varchar(100) NOT NULL,
  `Weekday` text,
  PRIMARY KEY (`Day_ID`),
  UNIQUE KEY `Day_ID_UNIQUE` (`Day_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Department
CREATE TABLE `Department` (
  `Dept_ID` varchar(100) NOT NULL,
  `Dept_Name` text,
  `Building_ID` varchar(100) DEFAULT NULL,
  `Office_ID` varchar(100) DEFAULT NULL,
  `Chair` text,
  `Phone_Number` text,
  `Email` text,
  `MAJOR IN DEPARTMENT` text,
  `MINOR IN DEPARTMENT` text,
  PRIMARY KEY (`Dept_ID`),
  UNIQUE KEY `Dept_ID_UNIQUE` (`Dept_ID`),
  KEY `Office_ID_idx` (`Office_ID`),
  KEY `Building_ID` (`Building_ID`),
  CONSTRAINT `Department_ibfk_1` FOREIGN KEY (`Building_ID`) REFERENCES `Building` (`BUILDING ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Enrollment
CREATE TABLE `Enrollment` (
  `CRN` int NOT NULL,
  `Student_ID` int NOT NULL,
  `Grade` text,
  `Semester_ID` varchar(100) NOT NULL,
  PRIMARY KEY (`CRN`,`Student_ID`,`Semester_ID`),
  KEY `Student_ID` (`Student_ID`),
  KEY `Semester_ID` (`Semester_ID`),
  CONSTRAINT `Enrollment_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Enrollment_ibfk_2` FOREIGN KEY (`Semester_ID`) REFERENCES `Semester` (`Semester ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Fac_FacFullTime
CREATE TABLE `Fac_FullTime` (
  `Faculty_ID` int NOT NULL,
  PRIMARY KEY (`Faculty_ID`),
  UNIQUE KEY `Faculty_ID_UNIQUE` (`Faculty_ID`),
  CONSTRAINT `Fac_FullTime_ibfk_1` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Fac_PartTime
CREATE TABLE `Fac_PartTime` (
  `Faculty_ID` int NOT NULL,
  PRIMARY KEY (`Faculty_ID`),
  UNIQUE KEY `Faculty_ID_UNIQUE` (`Faculty_ID`),
  CONSTRAINT `Fac_PartTime_ibfk_1` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Faculty
CREATE TABLE `Faculty` (
  `Faculty_ID` int NOT NULL,
  `Dept_ID` varchar(100) NOT NULL,
  `Faculty_Rank` text,
  `Faculty_Type` text,
  PRIMARY KEY (`Faculty_ID`,`Dept_ID`),
  UNIQUE KEY `Faculty_ID_UNIQUE` (`Faculty_ID`),
  KEY `Dept_ID` (`Dept_ID`),
  CONSTRAINT `Faculty_ibfk_1` FOREIGN KEY (`Dept_ID`) REFERENCES `Department` (`Dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Faculty_ibfk_2` FOREIGN KEY (`Faculty_ID`) REFERENCES `Users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Faculty_Dept
CREATE TABLE `Faculty_Dept` (
  `Dept_ID` varchar(100) NOT NULL,
  `Faculty_ID` int NOT NULL,
  `Percentage_Time` text,
  `Appointment_Date` text,
  PRIMARY KEY (`Dept_ID`,`Faculty_ID`),
  KEY `Faculty_ID` (`Faculty_ID`),
  CONSTRAINT `Faculty_Dept_ibfk_1` FOREIGN KEY (`Dept_ID`) REFERENCES `Department` (`Dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Faculty_Dept_ibfk_2` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Faculty_History
CREATE TABLE `Faculty_History` (
  `Faculty_ID` int NOT NULL,
  `Course_ID` int NOT NULL,
  `Semester_ID` varchar(100) NOT NULL,
  `Semester_Year` int DEFAULT NULL,
  PRIMARY KEY (`Faculty_ID`,`Course_ID`,`Semester_ID`),
  UNIQUE KEY `Faculty_ID_UNIQUE` (`Faculty_ID`),
  KEY `Semester_ID` (`Semester_ID`),
  KEY `Course_ID` (`Course_ID`),
  CONSTRAINT `Faculty_History_ibfk_2` FOREIGN KEY (`Semester_ID`) REFERENCES `Semester` (`Semester ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Faculty_History_ibfk_3` FOREIGN KEY (`Faculty_ID`) REFERENCES `Faculty` (`Faculty_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Faculty_History_ibfk_4` FOREIGN KEY (`Course_ID`) REFERENCES `Courses` (`Course_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Grad_FT
CREATE TABLE `Grad_FT` (
  `Student_ID` int NOT NULL,
  `Year_Of_Study` int DEFAULT NULL,
  `Qualifying_Exam` text,
  `Year_Graduated` text,
  `Thesis` text,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`),
  CONSTRAINT `Grad_FT_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Grad_PT
CREATE TABLE `Grad_PT` (
  `Student_ID` int NOT NULL,
  `Year_Of_Study` int DEFAULT NULL,
  `Qualifying_Exam` text,
  `Year_Grad` text,
  `Thesis` text,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`),
  CONSTRAINT `Grad_PT_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Graduate
CREATE TABLE `Graduate` (
  `Student_ID` int NOT NULL,
  `Student_Type` text,
  `Program` text,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`),
  CONSTRAINT `Graduate_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Hold
CREATE TABLE `HOLD` (
  `HOLD_ID` varchar(100) NOT NULL,
  `HOLD_NAME` text,
  PRIMARY KEY (`HOLD_ID`),
  UNIQUE KEY `HOLD_ID_UNIQUE` (`HOLD_ID`),
  CONSTRAINT `HOLD_ibfk_1` FOREIGN KEY (`HOLD_ID`) REFERENCES `HOLD` (`HOLD_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Lab
CREATE TABLE `LAB` (
  `Room_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `WS_AVAILABLE` int DEFAULT NULL,
  `TOTAL_SEATS` int DEFAULT NULL,
  PRIMARY KEY (`Room_ID`),
  CONSTRAINT `LAB_ibfk_1` FOREIGN KEY (`Room_ID`) REFERENCES `Room` (`Room_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Lecture_Hall
CREATE TABLE `Lecture_Hall` (
  `Room_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Total_Seats` int DEFAULT NULL,
  PRIMARY KEY (`Room_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Major
CREATE TABLE `Major` (
  `Major_ID` varchar(100) NOT NULL,
  `Dept_ID` varchar(100) NOT NULL,
  `Dept_Name` text,
  `Major_Name` text,
  `Min_Grade_Required` text,
  `Credits_Required` int DEFAULT NULL,
  PRIMARY KEY (`Major_ID`,`Dept_ID`),
  UNIQUE KEY `Major_ID_UNIQUE` (`Major_ID`),
  KEY `Dept_ID` (`Dept_ID`),
  CONSTRAINT `Major_ibfk_1` FOREIGN KEY (`Dept_ID`) REFERENCES `Department` (`Dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Major_Requirements
CREATE TABLE `Major_Requirements` (
  `Major_ID` varchar(100) NOT NULL,
  `Course_ID` int NOT NULL,
  PRIMARY KEY (`Major_ID`,`Course_ID`),
  KEY `Course_ID` (`Course_ID`),
  CONSTRAINT `Major_Requirements_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `Courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Minor
CREATE TABLE `Minor` (
  `Minor_ID` varchar(100) NOT NULL,
  `Dept_ID` varchar(100) NOT NULL,
  `Department Name` text,
  `Minor Name` text,
  `Grade_Required` text,
  `Credits_Required` int DEFAULT NULL,
  PRIMARY KEY (`Minor_ID`,`Dept_ID`),
  KEY `Dept_ID` (`Dept_ID`),
  CONSTRAINT `Minor_ibfk_1` FOREIGN KEY (`Dept_ID`) REFERENCES `Department` (`Dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Minor_Requirements
CREATE TABLE `Minor_Requirements` (
  `Minor_ID` text,
  `Course_ID` int DEFAULT NULL,
  KEY `Course_ID` (`Course_ID`),
  CONSTRAINT `Minor_Requirements_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `Courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Office
CREATE TABLE `Office` (
  `Office_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Total_Seats` int DEFAULT NULL,
  `Office_Type` text,
  PRIMARY KEY (`Office_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Period
CREATE TABLE `Period` (
  `Period_ID` varchar(100) NOT NULL,
  `Start_Time` text,
  `End_Time` text,
  PRIMARY KEY (`Period_ID`),
  UNIQUE KEY `Period_ID_UNIQUE` (`Period_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Prerequesites
CREATE TABLE `Prerequesites` (
  `PRE_ID` varchar(100) NOT NULL,
  `Course_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MIN_GRADE` text,
  PRIMARY KEY (`PRE_ID`,`Course_Name`),
  UNIQUE KEY `PRE_ID_UNIQUE` (`PRE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Research_Staff
CREATE TABLE `Research_Staff` (
  `Researcher_Id` int NOT NULL,
  `Priviledge_level` int DEFAULT NULL,
  PRIMARY KEY (`Researcher_Id`),
  UNIQUE KEY `Researcher_Id_UNIQUE` (`Researcher_Id`),
  CONSTRAINT `Research_Staff_ibfk_1` FOREIGN KEY (`Researcher_Id`) REFERENCES `Users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Room
CREATE TABLE `Room` (
  `Room_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Building_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Room_Type` text,
  PRIMARY KEY (`Room_ID`),
  KEY `Building_ID` (`Building_ID`),
  CONSTRAINT `Room_ibfk_1` FOREIGN KEY (`Building_ID`) REFERENCES `Building` (`BUILDING ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Semester
CREATE TABLE `Semester` (
  `Semester ID` varchar(100) NOT NULL,
  `Semester Name` text,
  `Semester_Year` int DEFAULT NULL,
  `Start Date` text,
  `End Date` text,
  `Grade Due Date` text,
  `Registration Date` text,
  `Drop Course Date` text,
  PRIMARY KEY (`Semester ID`),
  UNIQUE KEY `Semester ID_UNIQUE` (`Semester ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Student
CREATE TABLE `Student` (
  `STUDENT_ID` int NOT NULL,
  `CREDITS_TAKEN` int DEFAULT NULL,
  `STUDENT_TYPE` text,
  `STUDENT` text,
  `STUDENT_GPA` double DEFAULT NULL,
  `CREDITS_EARNED` int DEFAULT NULL,
  `STUDENT_LEVEL` text,
  `Program` text,
  PRIMARY KEY (`STUDENT_ID`),
  UNIQUE KEY `STUDENT_ID_UNIQUE` (`STUDENT_ID`),
  CONSTRAINT `Student_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Student_ibfk_2` FOREIGN KEY (`STUDENT_ID`) REFERENCES `Users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Student_History
CREATE TABLE `Student_History` (
  `Student_ID` int NOT NULL,
  `CRN` int NOT NULL,
  `Grade` text,
  `Semester_Year` text,
  PRIMARY KEY (`Student_ID`,`CRN`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`),
  CONSTRAINT `Student_History_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Student_Holds
CREATE TABLE `Student_Holds` (
  `HOLD_ID` varchar(100) NOT NULL,
  `Student_ID` int NOT NULL,
  `HOLD_TYPE` text,
  PRIMARY KEY (`HOLD_ID`,`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`),
  CONSTRAINT `Student_Holds_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Student_Holds_ibfk_2` FOREIGN KEY (`HOLD_ID`) REFERENCES `HOLD` (`HOLD_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Student_Major
CREATE TABLE `Student_Major` (
  `Major_ID` varchar(100) NOT NULL,
  `STUDENT_ID` int NOT NULL,
  `Date_Declared` text,
  PRIMARY KEY (`Major_ID`,`STUDENT_ID`),
  KEY `STUDENT_ID` (`STUDENT_ID`),
  CONSTRAINT `Student_Major_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Student_Major_ibfk_2` FOREIGN KEY (`Major_ID`) REFERENCES `Major` (`Major_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Student_Minor
CREATE TABLE `Student_Minor` (
  `Minor_ID` varchar(100) NOT NULL,
  `STUDENT_ID` int NOT NULL,
  `Date_Declared` text,
  PRIMARY KEY (`Minor_ID`,`STUDENT_ID`),
  KEY `STUDENT_ID` (`STUDENT_ID`),
  CONSTRAINT `Student_Minor_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Student_Minor_ibfk_2` FOREIGN KEY (`Minor_ID`) REFERENCES `Minor` (`Minor_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Time_slot
CREATE TABLE `Time_slot` (
  `Timeslot_ID` varchar(100) NOT NULL,
  `Day_ID` varchar(100) NOT NULL,
  `Period_ID` varchar(100) NOT NULL,
  PRIMARY KEY (`Timeslot_ID`,`Day_ID`,`Period_ID`),
  UNIQUE KEY `Timeslot_ID_UNIQUE` (`Timeslot_ID`),
  KEY `Day_ID` (`Day_ID`),
  KEY `Period_ID` (`Period_ID`),
  CONSTRAINT `Time_slot_ibfk_1` FOREIGN KEY (`Timeslot_ID`) REFERENCES `Time_slot` (`Timeslot_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Time_slot_ibfk_2` FOREIGN KEY (`Day_ID`) REFERENCES `Day` (`Day_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Time_slot_ibfk_3` FOREIGN KEY (`Period_ID`) REFERENCES `Period` (`Period_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Time_Slot_Period
CREATE TABLE `Time_Slot_Period` (
  `Timeslot_ID` varchar(100) NOT NULL,
  `Period_ID` varchar(100) NOT NULL,
  PRIMARY KEY (`Timeslot_ID`,`Period_ID`),
  KEY `Time_Slot_Period_ibfk_1` (`Period_ID`),
  CONSTRAINT `Time_Slot_Period_ibfk_1` FOREIGN KEY (`Period_ID`) REFERENCES `Period` (`Period_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Time_Slot_Period_ibfk_2` FOREIGN KEY (`Timeslot_ID`) REFERENCES `Time_slot` (`Timeslot_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Undergrad_FT
CREATE TABLE `Undergrad_FT` (
  `Student_ID` int NOT NULL,
  `Credits_Taken` int DEFAULT NULL,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`),
  CONSTRAINT `Undergrad_FT_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Undergrad_PT
CREATE TABLE `Undergrad_PT` (
  `STUDENT_ID` int NOT NULL,
  `Credits_Taken` int DEFAULT NULL,
  PRIMARY KEY (`STUDENT_ID`),
  UNIQUE KEY `STUDENT_ID_UNIQUE` (`STUDENT_ID`),
  CONSTRAINT `Undergrad_PT_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `Student` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Undergraduate
CREATE TABLE `Undergraduate` (
  `Student_ID` int NOT NULL,
  `Student_Type` text,
  `Program` text,
  `Standing` text,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--User_Login
CREATE TABLE `User_Login` (
  `User_ID` int NOT NULL,
  `Email` text,
  `Password` text,
  `Seq_Question` text,
  `User_Type` text,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_ID`),
  CONSTRAINT `User_Login_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--Users
CREATE TABLE `Users` (
  `User_ID` int NOT NULL,
  `first_name` text,
  `last_name` text,
  `Date of Birth` text,
  `Date_Created` text,
  `Street` text,
  `Zipcode` int DEFAULT NULL,
  `Country` text,
  `State` text,
  `City` text,
  `User_Type` text,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_ID`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
