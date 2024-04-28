DROP DATABASE IF EXISTS ISIDB;

CREATE DATABASE ISIDB CHARACTER SET utf8 COLLATE utf8_general_ci;

USE ISIDB;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE NOT NULL,
    login VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role ENUM('student', 'teacher' , 'entreprise', 'department_head', 'admin') NOT NULL
);
CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    major VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE companies (
    company_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE department_heads (
    head_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    department VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE projects (
    project_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    teacher_id INT,
    company_id INT,
    FOREIGN KEY (teacher_id) REFERENCES users(user_id),
    FOREIGN KEY (company_id) REFERENCES companies(company_id)
    State ENUM('proposé','validé','créé','en_cours','achevé') NOT NULL
);
CREATE TABLE applications (
    application_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    project_id INT,
    cv TEXT,
    motivation_letter TEXT,
    status ENUM('pending', 'accepted', 'rejected') NOT NULL,
    feedback TEXT,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

CREATE TABLE evaluations (
    evaluation_id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    grade DECIMAL(3,2) NOT NULL,
    feedback TEXT,
    evaluator_id INT,
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (evaluator_id) REFERENCES users(user_id)
);
CREATE TABLE schedules (
    schedule_id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    date TIMESTAMP NOT NULL,
    head_id INT,
    jury_id INT,
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (head_id) REFERENCES department_heads(head_id),
    FOREIGN KEY (jury_id) REFERENCES users(user_id)
);

INSERT INTO users VALUES (null,'admin','admin','adminexemple@gmail.com','admin',md5('admin'),'admin');
INSERT INTO users VALUES (null,'Wassim','Ben Abdallah','wassimbenabdallah@gmail.com','wassim',md5('wassim'),'student');  
INSERT INTO users VALUES (null,'Moez','Ben Rkaya','moezrkaya@gmail.com','moez',md5('moez'),'teacher');  
INSERT INTO users VALUES (null,'gomycode',null,'go_my_code@gmail.com','gmcode',md5('gmcode'),'entreprise');   
INSERT INTO users VALUES (null,'Sami','Ghazouali','samighazouali@gmail.com','sami',md5('sami'),'department_head');    