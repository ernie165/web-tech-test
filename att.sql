

-- Users table (for teachers and students)
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    PasswordHash VARCHAR(255) NOT NULL,
    Role ENUM('teacher', 'student') NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Classes table
CREATE TABLE Classes (
    ClassID INT AUTO_INCREMENT PRIMARY KEY,
    ClassName VARCHAR(255) NOT NULL,
    TeacherID INT NOT NULL,
    FOREIGN KEY (TeacherID) REFERENCES Users(UserID)
);

-- Students in classes
CREATE TABLE ClassStudents (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ClassID INT NOT NULL,
    StudentID INT NOT NULL,
    FOREIGN KEY (ClassID) REFERENCES Classes(ClassID),
    FOREIGN KEY (StudentID) REFERENCES Users(UserID)
);

-- Attendance table
CREATE TABLE Attendance (
    AttendanceID INT AUTO_INCREMENT PRIMARY KEY,
    ClassID INT NOT NULL,
    StudentID INT NOT NULL,
    Date DATE NOT NULL,
    Status ENUM('Present', 'Absent') NOT NULL,
    FOREIGN KEY (ClassID) REFERENCES Classes(ClassID),
    FOREIGN KEY (StudentID) REFERENCES Users(UserID),
    UNIQUE (ClassID, StudentID, Date)
);
