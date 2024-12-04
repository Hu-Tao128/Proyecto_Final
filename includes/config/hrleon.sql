create table department(
    code varchar(5) primary key,
    name varchar(30) not null,
    index idx_department(name)
);

create table promotion(
    code varchar(5) primary key,
    name varchar(60) not null,
    description varchar(60) not null,
    status varchar(10) not null,
    publicationDate date not null,
    index idx_promotion(publicationDate)
);

CREATE TABLE `position` (
    code VARCHAR(5) PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    salary FLOAT NOT NULL,
    departmentCode VARCHAR(5) NOT NULL,
    INDEX idx_position (name),
    FOREIGN KEY (departmentCode) REFERENCES department(code)
);


create table employee(
    code varchar(5) primary key,
    firstName varchar(30) not null,
    lastName varchar(30) not null,
    middleName varchar(30) not null,
    email varchar(35) not null,
    gender varchar(1) not null,
    age int not null,
    image varchar(255),
    mobile varchar(15) not null,
    password varchar(20) not null,
    contractDate date not null,
    status varchar(30) not null default 'Active',
    positionCode varchar(5) not null,
    supervisorId varchar(5),
    index idx_employee(lastName),
    
    foreign key(positionCode) references `position`(code)
);

alter table employee add foreign key(supervisorId) references employee(code);

create table attendance(
    number int primary key auto_increment,
    startDate datetime not null,
    endDate datetime,
    employee varchar(5) not null,
    index idx_date(startDate),

    Foreign Key (employee) REFERENCES employee(code)
);

create table benefits(
    code varchar(5) primary key,
    name varchar(60) not null,
    type varchar(20) not null,
    description varchar(60) not null,
    index idx_benefits(name)
);

create table performance(
    code varchar(5) primary key,
    score float not null,
    evaluationDate date not null,
    comments varchar(60),
    employee varchar(5) not null,
    index idx_performance(score),

    foreign key(employee) REFERENCES employee(code)
);

create table vacations(
    id int primary key auto_increment,
    startDate date not null,
    endDate date not null,
    status varchar(10) not null,
    employee varchar(5) not null,
    index idx_vacations(startDate),

    foreign key(employee) references employee(code)
);

create table complaints(
    id int primary key auto_increment,
    date date not null,
    description varchar(60) not null,
    status varchar(10) not null,
    employee varchar(5) not null,
    index idx_complaints(date),

    foreign key(employee) references employee(code)
);

create table absence(
    id int primary key auto_increment,
    startDate date not null,
    endDate date not null,
    status varchar(10) not null,
    type varchar(10) not null,
    description varchar(60) not null,
    employee varchar(5) not null,
    index idx_absence(startDate),

    foreign key(employee) references employee(code)
);

create table incident(
    id int primary key auto_increment,
    incidentType varchar(40) not null,
    incidentDate date not null,
    description varchar(60) not null,
    employee varchar(5) not null,
    index idx_incident(incidentDate),

    foreign key(employee) references employee(code)
);

create table application(
    id int primary key auto_increment,
    publicationDate date not null,
    status varchar(10) not null,
    employee varchar(5) not null,
    promotion varchar(5) not null,
    index idx_application(publicationDate),

    foreign Key(employee) references employee(code),
    foreign key(promotion) references promotion(code)
);

create table payments(
    id int primary key auto_increment,
    hourlyPayment float(5,2) not null,
    totalPayment float(10,2) not null,
    bonuses float(10,2),
    employee varchar(5) not null,
    index idx_payments(id),

    foreign key(employee) references employee(code)
);


create table MD_benefies(
    id int primary key auto_increment,
    code varchar(5) not null,
    name varchar(60) not null,
    type varchar(20) not null,
    description varchar(60) not null,
    action varchar(20) not null,
    eliminationDate date,
    employee varchar(5) not null,
    index idx_employeeDB(employee),

    foreign key(employee) references employee(code)
);

create table MD_promotions(
    id int primary key auto_increment,
    code varchar(5) not null,
    name varchar(60) not null,
    description varchar(60) not null,
    status varchar(10) not null,
    publicationDate date not null,
    action varchar(20) not null,
    eliminationDate date,
    employee varchar(5) not null,
    index idx_employeeDP(employee),

    Foreign key(employee) references employee(code)
);

create table MD_incident(
    id int primary key auto_increment,
    idIn int not null,
    incidentType varchar(40) not null,
    incidentDate date not null,
    description varchar(60) not null,
    employee varchar(5) not null,
    action varchar(20) not null,
    eliminationDate date,
    employeeDel varchar(5) not null,
    index idx_employeeDI(employeeDel),

    Foreign key(employeeDel) references employee(code)
);

create table MD_aplications(
    id int primary key auto_increment,
    idAp int not null, 
    publicationDate date not null,
    status varchar(10) not null,
    employee varchar(5) not null,
    promotion varchar(5) not null,
    action varchar(20) not null,
    eliminationDate date,
    employeeDel varchar(5) not null,
    index idx_employeeDA(employeeDel),

    foreign key(employeeDel) references employee(code)
);


INSERT INTO department (code, name) VALUES
('D001', 'Human Resources'),
('D002', 'Technology'),
('D003', 'Marketing'),
('D004', 'Finance'),
('D005', 'Sales'),
('D006', 'Operations'),
('D007', 'Customer Service');

-- Inserción en la tabla promocion
INSERT INTO promotion (code, name, description, status, publicationDate) VALUES
('P001', 'Annual Promotion', '10% salary increase', 'Active', '2023-01-15'),
('P002', 'Performance Bonus', 'Bonus for exceptional performance', 'Active', '2023-02-01'),
('P003', 'Summer Promotion', 'Temporary increase during the summer', 'Inactive', '2023-06-01'),
('P004', 'Christmas Bonus', 'Special bonus for Christmas', 'Active', '2023-12-01'),
('P005', 'Birthday Promotion', '5% salary increase', 'Active', '2023-03-01'),
('P006', 'Project Promotion', 'Bonus for project completion', 'Active', '2023-04-01'),
('P007', 'Innovation Promotion', 'Recognition for innovation', 'Active', '2023-05-01'),
('P008', 'Retention Bonus', 'Bonus for staying with the company', 'Active', '2023-07-01'),
('P009', 'Leadership Promotion', 'Increase for leadership role', 'Active', '2023-08-01'),
('P010', 'Training Promotion', 'Bonus for completed training', 'Active', '2023-09-01');

-- Inserción en la tabla puesto
INSERT INTO position (code, name, salary, departmentCode) VALUES
('P001', 'Human Resources Manager', 60000, 'D001'),
('P002', 'Software Developer', 80000, 'D002'),
('P003', 'Marketing Specialist', 50000, 'D003'),
('P004', 'Financial Analyst', 70000, 'D004'),
('P005', 'Sales Executive', 55000, 'D005'),
('P006', 'Operations Coordinator', 65000, 'D006'),
('P007', 'Customer Service Agent', 30000, 'D007'),  
('P008', 'Recruitment Specialist', 45000, 'D001'),
('P009', 'Training Coordinator', 40000, 'D001'),
('P010', 'HR Assistant', 35000, 'D001'),
('P011', 'System Administrator', 75000, 'D002'),
('P012', 'QA Engineer', 70000, 'D002'),
('P013', 'IT Support Specialist', 50000, 'D002'),
('P014', 'Content Writer', 40000, 'D003'),
('P015', 'Social Media Manager', 45000, 'D003'),
('P016', 'Market Analyst', 48000, 'D003'),
('P017', 'Accountant', 65000, 'D004'),
('P018', 'Payroll Specialist', 50000, 'D004'),
('P019', 'Budget Analyst', 58000, 'D004'),
('P020', 'Account Manager', 52000, 'D005'),
('P021', 'Sales Representative', 45000, 'D005'),
('P022', 'Business Development Coordinator', 55000, 'D005'),
('P023', 'Logistics Manager', 60000, 'D006'),
('P024', 'Inventory Specialist', 48000, 'D006'),
('P025', 'Operations Analyst', 50000, 'D006'),
('P026', 'Customer Support Specialist', 35000, 'D007'),
('P027', 'Technical Support Representative', 40000, 'D007'),
('P028', 'Client Success Manager', 50000, 'D007');

DELIMITER $$
CREATE TRIGGER generate_employee_code 
BEFORE INSERT ON employee 
FOR EACH ROW
BEGIN
    DECLARE dept_letter CHAR(1) DEFAULT NULL;
    DECLARE pos_letter CHAR(1) DEFAULT NULL;
    DECLARE consecutive INT DEFAULT 1;
    DECLARE generated_code VARCHAR(10);

    SELECT LEFT(name, 1) INTO dept_letter
    FROM department
    WHERE code = (SELECT departmentCode FROM `position` WHERE code = NEW.positionCode)
    LIMIT 1;

    SELECT LEFT(name, 1) INTO pos_letter
    FROM `position`
    WHERE code = NEW.positionCode
    LIMIT 1;

    IF dept_letter IS NOT NULL AND pos_letter IS NOT NULL THEN
        
        REPEAT
            SET generated_code = CONCAT(UPPER(dept_letter), UPPER(pos_letter), LPAD(consecutive, 2, '0'));
            SET consecutive = consecutive + 1;
        UNTIL NOT EXISTS (
            SELECT 1 
            FROM employee 
            WHERE code = generated_code
        )
        END REPEAT;

        SET NEW.code = generated_code;
    END IF;
END$$
DELIMITER ;



INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('1', 'Juan', 'Pérez', 'Alberto', 'juan.perez@example.com', 'M', 30, '5551234567', 'pass123', '2021-01-15', 'P001', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('2', 'María', 'González', 'Fernanda', 'maria.gonzalez@example.com', 'F', 28, '5552345678', 'pass234', '2021-02-20', 'P002', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('3', 'Luis', 'Martínez', 'Antonio', 'luis.martinez@example.com', 'M', 35, '5553456789', 'pass345', '2020-03-10', 'P003', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('4', 'Ana', 'López', 'Carmen', 'ana.lopez@example.com', 'F', 26, '5554567890', 'pass456', '2022-04-18', 'P004', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('5', 'Carlos', 'Hernández', 'Eduardo', 'carlos.hernandez@example.com', 'M', 32, '5555678901', 'pass567', '2021-05-21', 'P005', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('6', 'Laura', 'García', 'Isabel', 'laura.garcia@example.com', 'F', 29, '5556789012', 'pass678', '2021-06-30', 'P006', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('7', 'Jorge', 'Ramírez', 'Diego', 'jorge.ramirez@example.com', 'M', 40, '5557890123', 'pass789', '2019-07-15', 'P007', NULL);

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('8', 'Sofía', 'Mendoza', 'María', 'sofia.mendoza@example.com', 'F', 34, '5558901234', 'pass890', '2020-08-25', 'P008', 'HH01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('9', 'Diego', 'Gómez', 'Julián', 'diego.gomez@example.com', 'M', 31, '5559012345', 'pass901', '2021-09-10', 'P009', "TS01");

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('10', 'Claudia', 'Martínez', 'Patricia', 'claudia.martinez@example.com', 'F', 27, '5550123456', 'pass012', '2022-10-05', 'P010', "MM01");

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('11', 'Fernando', 'Rodríguez', 'Ricardo', 'fernando.rodriguez@example.com', 'M', 38, '5551234568', 'pass1234', '2018-11-12', 'P011', "FF01");

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('12', 'Patricia', 'Lopez', 'Elena', 'patricia.lopez@example.com', 'F', 33, '5552345679', 'pass2345', '2019-12-20', 'P012', "SS01");

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('13', 'Andrés', 'Sánchez', 'Luis', 'andres.sanchez@example.com', 'M', 36, '5553456780', 'pass3456', '2020-01-30', 'P013', "OO01");

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('14', 'Elena', 'Morales', 'Ana', 'elena.morales@example.com', 'F', 30, '5554567891', 'pass4567', '2021-02-15', 'P014', "CC01");

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('15', 'Roberto', 'González', 'Javier', 'roberto.gonzalez@example.com', 'M', 29, '5555678902', 'pass5678', '2021-03-20', 'P015', 'HH01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('16', 'Victoria', 'Fernández', 'Lucía', 'victoria.fernandez@example.com', 'F', 32, '5556789013', 'pass6789', '2021-04-25', 'P016', 'TS01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('17', 'Pablo', 'Jiménez', 'Fernando', 'pablo.jimenez@example.com', 'M', 37, '5557890124', 'pass7890', '2020-05-30', 'P017', 'MM01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('18', 'Gabriela', 'Pérez', 'María', 'gabriela.perez@example.com', 'F', 28, '5558901235', 'pass8901', '2021-06-15', 'P018', 'FF01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('19', 'Samuel', 'Ríos', 'Andrés', 'samuel.rios@example.com', 'M', 34, '5559012346', 'pass9012', '2021-07-10', 'P019', 'SS01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('20', 'Jessica', 'Hernández', 'Sofía', 'jessica.hernandez@example.com', 'F', 31, '5550123457', 'pass0123', '2021-08-05', 'P020', 'OO01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('21', 'Ricardo', 'Ruiz', 'Luis', 'ricardo.ruiz@example.com', 'M', 39, '5551234569', 'pass12345', '2020-09-15', 'P021', 'CC01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('22', 'Mariana', 'Díaz', 'Isabel', 'mariana.diaz@example.com', 'F', 25, '5552345670', 'pass23456', '2020-10-10', 'P022', 'HH01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('23', 'Hugo', 'Martínez', 'Ricardo', 'hugo.martinez@example.com', 'M', 33, '5553456781', 'pass34567', '2021-11-05', 'P023', 'TS01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('24', 'Karina', 'Gómez', 'Raquel', 'karina.gomez@example.com', 'F', 30, '5554567892', 'pass45678', '2020-12-01', 'P024', 'MM01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('25', 'Alfonso', 'Serrano', 'Martín', 'alfonso.serrano@example.com', 'M', 37, '5555678903', 'pass56789', '2021-01-05', 'P025', 'FF01');

INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId)
VALUES ('26', 'Olga', 'Vázquez', 'Susana', 'olga.vazquez@example.com', 'F', 29, '5556789014', 'pass67890', '2021-02-10', 'P026', 'SS01');


/*HOLA*/

INSERT INTO benefits (code, name, type, description) VALUES
('B001', 'Health Insurance', 'Insurance', 'Comprehensive health insurance coverage'),
('B002', 'Retirement Plan', 'Retirement', 'Company-sponsored retirement savings plan'),
('B003', 'Paid Time Off', 'Leave', 'Accrued paid time off for vacation and personal use'),
('B004', 'Gym Membership', 'Wellness', 'Annual gym membership reimbursement'),
('B005', 'Tuition Reimbursement', 'Education', 'Reimbursement for educational expenses'),
('B006', 'Flexible Work Hours', 'Work Arrangement', 'Ability to adjust work hours'),
('B007', 'Childcare Assistance', 'Support', 'Financial assistance for childcare costs'),
('B008', 'Transportation Allowance', 'Allowance', 'Monthly allowance for commuting expenses'),
('B009', 'Professional Development', 'Training', 'Funding for professional training and workshops'),
('B010', 'Employee Discounts', 'Discount', 'Discounts on company products and services');

-- Inserción en la tabla desempenio
INSERT INTO performance (code, score, evaluationDate, comments, employee) VALUES
('PE001', 85.5, '2023-01-20', 'Excellent performance throughout the year', 'MC01'),
('PE002', 78.0, '2023-02-15', 'Good performance but needs improvement in teamwork', 'SS02'),
('PE003', 90.0, '2023-03-10', 'Outstanding contributions to projects', 'FP01'),
('PE004', 72.5, '2023-04-05', 'Satisfactory performance, but missed deadlines', 'OO02'),
('PE005', 88.0, '2023-05-15', 'Consistently meets expectations', 'TS02'),
('PE006', 95.0, '2023-06-10', 'Exceptional leadership skills', 'HR01'),
('PE007', 80.0, '2023-07-20', 'Good performance, needs to focus on efficiency', 'MS01'),
('PE008', 75.0, '2023-08-30', 'Meets expectations but lacks initiative', 'SB01');

-- Inserción en la tabla vacaciones
INSERT INTO vacations (startDate, endDate, status, employee) VALUES
('2024-07-01', '2024-07-10', 'Approved', 'HH01'),
('2024-12-20', '2025-01-05', 'Pending', 'TS01'),
('2023-08-15', '2023-08-25', 'Approved', 'MM01'),
('2023-12-01', '2023-12-10', 'Rejected', 'FF01'),
('2024-02-10', '2024-02-20', 'Pending', 'SS01'),
('2023-06-01', '2023-06-10', 'Approved', 'SS01'),
('2023-09-10', '2023-09-15', 'Approved', 'OO01'),
('2024-03-01', '2024-03-10', 'Pending', 'CC01'),
('2024-05-05', '2024-05-15', 'Approved', 'FP01'),
('2024-11-01', '2024-11-10', 'Approved', 'HH02');

-- Inserción en la tabla quejas
INSERT INTO complaints (date, description, status, employee) VALUES
('2023-06-15', 'Issue with a colleague', 'Resolved', 'HH01'),
('2023-09-01', 'Complaint about defective equipment', 'Pending', 'TS01'),
('2023-08-05', 'Conflict with supervisor', 'Resolved', 'MM01'),
('2023-10-12', 'Problems with work schedule', 'Pending', 'FF01'),
('2023-11-20', 'Incident with a customer', 'Resolved', 'SS01'),
('2023-07-15', 'Dispute over project responsibilities', 'Resolved', 'SS01'),
('2023-08-25', 'Concerns about workplace safety', 'Pending', 'OO01'),
('2023-09-30', 'Feedback on team collaboration', 'Resolved', 'CC01');

-- Inserción en la tabla ausencia
INSERT INTO absence (startDate, endDate, status, type, description, employee) VALUES
('2023-01-15', '2023-01-20', 'Approved', 'Sick', 'Flu symptoms', 'HH01'),
('2023-02-10', '2023-02-12', 'Approved', 'Personal', 'Family emergency', 'TS01'),
('2023-03-05', '2023-03-06', 'Pending', 'Vacation', 'Planned family trip', 'MM01'),
('2023-04-15', '2023-04-16', 'Approved', 'Sick', 'Migraine', 'FF01'),
('2023-05-01', '2023-05-02', 'Approved', 'Personal', 'Moving house', 'SS01'),
('2023-06-20', '2023-06-22', 'Approved', 'Sick', 'Stomach flu', 'SS01'),
('2023-07-10', '2023-07-15', 'Pending', 'Vacation', 'Beach holiday', 'OO01'),
('2023-08-01', '2023-08-03', 'Approved', 'Personal', 'Medical appointment', 'CC01');

-- Inserción en la tabla incidente
INSERT INTO incident (incidentType, incidentDate, description, employee) VALUES
('Safety', '2023-01-15', 'Slip and fall accident in the workplace', 'HH01'),
('Harassment', '2023-02-20', 'Reported inappropriate comments from a colleague', 'TS01'),
('Equipment Failure', '2023-03-10', 'Machine malfunction during operation', 'MM01'),
('Policy Violation', '2023-04-05', 'Failure to adhere to safety protocols', 'FF01'),
('Theft', '2023-05-15', 'Personal belongings stolen from the locker', 'SS01'),
('Injury', '2023-06-25', 'Injury while lifting heavy equipment', 'SS01'),
('Conflict', '2023-07-30', 'Dispute over project responsibilities', 'OO01'),
('Accident', '2023-08-15', 'Minor accident during transportation', 'CC01');

-- Inserción en la tabla postulacion
INSERT INTO application (publicationDate, status, employee, promotion) VALUES
('2023-01-01', 'Approved', 'MC01', 'P001'),
('2023-02-01', 'Pending', 'SS02', 'P002'),
('2023-03-01', 'Rejected', 'FP01', 'P003'),
('2023-04-01', 'Approved', 'OO02', 'P004'),
('2023-05-01', 'Approved', 'TS02', 'P005'),
('2023-06-01', 'Pending', 'HR01', 'P006'),
('2023-07-01', 'Approved', 'MS01', 'P007'),
('2023-08-01', 'Rejected', 'SB01', 'P008'),
('2023-09-01', 'Pending', 'FA01', 'P009'),
('2023-10-01', 'Approved', 'HH02', 'P010'),
('2023-11-01', 'Approved', 'OI01', 'P001'),
('2023-12-01', 'Rejected', 'SA01', 'P002'),
('2024-01-01', 'Pending', 'TI01', 'P003'),
('2024-02-01', 'Approved', 'CC02', 'P004'),
('2024-03-01', 'Rejected', 'FB01', 'P005'),
('2024-04-01', 'Approved', 'TQ01', 'P006'),
('2024-05-01', 'Pending', 'HT01', 'P007'),
('2024-06-01', 'Approved', 'MM02', 'P008'),
('2024-07-01', 'Rejected', 'OL01', 'P009'),
('2024-08-01', 'Approved', 'HH01', 'P010');

-- Inserción en la tabla pagos
INSERT INTO payments (hourlyPayment, totalPayment, bonuses, employee) VALUES
(20.00, 1600.00, 200.00, 'CC01'),
(25.00, 2000.00, 300.00, 'MC01'),
(30.00, 2400.00, 250.00, 'SS02'),
(22.50, 1800.00, 150.00, 'FP01'),
(27.00, 2160.00, 100.00, 'OO02'),
(20.50, 1640.00, 250.00, 'TS02'),
(23.00, 1840.00, 300.00, 'HR01'),
(29.00, 2320.00, 200.00, 'MS01'),
(24.00, 1920.00, 400.00, 'SB01'),
(28.00, 2240.00, 350.00, 'FA01'),
(21.00, 1680.00, 150.00, 'HH02'),
(26.00, 2080.00, 250.00, 'OI01'),
(30.00, 2400.00, 300.00, 'SA01'),
(25.50, 2040.00, 200.00, 'TI01'),
(22.00, 1760.00, 100.00, 'CC02'),
(27.50, 2200.00, 200.00, 'FB01'),
(24.50, 1960.00, 150.00, 'TQ01'),
(29.50, 2360.00, 300.00, 'HT01'),
(30.50, 2440.00, 350.00, 'MM02'),
(28.50, 2280.00, 250.00, 'OL01');



/*Procedimiento para eliminar un incidente y guardar su informacion para poder restablecerla de nuevo*/
DELIMITER $$
DROP PROCEDURE IF EXISTS deleteIncident;
CREATE PROCEDURE deleteIncident(IN p_id INT, IN p_employeeCode VARCHAR(5))
BEGIN
    DECLARE v_incidentType VARCHAR(40);
    DECLARE v_incidentDate DATE;
    DECLARE v_description VARCHAR(60);
    DECLARE v_employee VARCHAR(5);
    DECLARE v_eliminationDate DATE;

    SELECT incidentType, incidentDate, description, employee
    INTO v_incidentType, v_incidentDate, v_description, v_employee
    FROM incident
    WHERE id = p_id;

    SET v_eliminationDate = CURDATE();

    INSERT INTO MD_incident (idIn, incidentType, incidentDate, description, employee, action, eliminationDate, employeeDel)
    VALUES (p_id, v_incidentType, v_incidentDate, v_description, v_employee, 'Deleted', v_eliminationDate, p_employeeCode);

    DELETE FROM incident WHERE id = p_id;
END$$
DELIMITER ;


--Procedimiento para promociones
DELIMITER $$
DROP PROCEDURE IF EXISTS deletePromotion;
CREATE PROCEDURE deletePromotion(IN p_code VARCHAR(5), IN p_employeeCode VARCHAR(5))
BEGIN
    DECLARE v_name VARCHAR(60);
    DECLARE v_description VARCHAR(60);
    DECLARE v_status VARCHAR(10);
    DECLARE v_publicationDate DATE;
    DECLARE v_eliminationDate DATE;

    SELECT name, description, status, publicationDate
    INTO v_name, v_description, v_status, v_publicationDate
    FROM promotion
    WHERE code = p_code;

    SET v_eliminationDate = CURDATE();

    INSERT INTO MD_promotions (code, name, description, status, publicationDate, action, eliminationDate, employee)
    VALUES (p_code, v_name, v_description, v_status, v_publicationDate, 'Deleted', v_eliminationDate, p_employeeCode);

    DELETE FROM promotion WHERE code = p_code;
END$$
DELIMITER ;


--Procedimiento para beneficios
DELIMITER $$
DROP PROCEDURE IF EXISTS deleteBenefit;
CREATE PROCEDURE deleteBenefit(IN p_code VARCHAR(5), IN p_employeeCode VARCHAR(5))
BEGIN
    DECLARE v_name VARCHAR(60);
    DECLARE v_type VARCHAR(20);
    DECLARE v_description VARCHAR(60);
    DECLARE v_eliminationDate DATE;

    SELECT name, type, description
    INTO v_name, v_type, v_description
    FROM benefits
    WHERE code = p_code;

    SET v_eliminationDate = CURDATE();

    INSERT INTO MD_benefies (code, name, type, description, action, eliminationDate, employee)
    VALUES (p_code, v_name, v_type, v_description, 'Deleted', v_eliminationDate, p_employeeCode);

    DELETE FROM benefits WHERE code = p_code;
END$$
DELIMITER ;


--Procedimiento para aplicaciones
DELIMITER $$
DROP PROCEDURE IF EXISTS deleteApplication;
CREATE PROCEDURE deleteApplication(IN p_id INT, IN p_employeeCode VARCHAR(5))
BEGIN
    DECLARE v_publicationDate DATE;
    DECLARE v_status VARCHAR(10);
    DECLARE v_promotion VARCHAR(5);
    DECLARE v_employee VARCHAR(5);
    DECLARE v_eliminationDate DATE;

    SELECT publicationDate, status, promotion, employee
    INTO v_publicationDate, v_status, v_promotion, v_employee
    FROM application
    WHERE id = p_id;

    SET v_eliminationDate = CURDATE();

    INSERT INTO MD_aplications (idAp, publicationDate, status, employee, promotion, action, eliminationDate, employeeDel)
    VALUES (p_id, v_publicationDate, v_status, v_employee, v_promotion, 'Deleted', v_eliminationDate, p_employeeCode);

    DELETE FROM application WHERE id = p_id;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS restoreIncident;
CREATE PROCEDURE restoreIncident(IN p_id INT)
BEGIN
    DECLARE v_idIn INT;
    DECLARE v_incidentType VARCHAR(40);
    DECLARE v_incidentDate DATE;
    DECLARE v_description VARCHAR(60);
    DECLARE v_employee VARCHAR(5);

    SELECT idIn, incidentType, incidentDate, description, employee
    INTO v_idIn, v_incidentType, v_incidentDate, v_description, v_employee
    FROM MD_incident
    WHERE id = p_id;

    INSERT INTO incident (id, incidentType, incidentDate, description, employee)
    VALUES (v_idIn, v_incidentType, v_incidentDate, v_description, v_employee);

    DELETE FROM MD_incident WHERE id = p_id;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS restoreApplication;
CREATE PROCEDURE restoreApplication(IN p_id INT)
BEGIN
    DECLARE v_idAp INT;
    DECLARE v_publicationDate DATE;
    DECLARE v_status VARCHAR(10);
    DECLARE v_employee VARCHAR(5);
    DECLARE v_promotion VARCHAR(5);

    SELECT idAp, publicationDate, status, employee, promotion
    INTO v_idAp, v_publicationDate, v_status, v_employee, v_promotion
    FROM MD_aplications
    WHERE id = p_id;

    INSERT INTO application (id, publicationDate, status, employee, promotion)
    VALUES (v_idAp, v_publicationDate, v_status, v_employee, v_promotion);

    DELETE FROM MD_aplications WHERE id = p_id;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS restorePromotion;
CREATE PROCEDURE restorePromotion(IN p_id int)
BEGIN
    DECLARE v_code varchar(5);
    DECLARE v_name varchar(60);
    DECLARE v_description VARCHAR(60);
    DECLARE v_status VARCHAR(10);
    DECLARE v_publicationDate DATE;

    SELECT code, name, description, status, publicationDate
    INTO v_code, v_name, v_description, v_status, v_publicationDate
    FROM MD_promotions
    WHERE id = p_id;

    INSERT INTO promotion (code, name, description, status, publicationDate)
    VALUES (v_code, v_name, v_status, v_description, v_publicationDate);

    DELETE FROM MD_promotions WHERE id = p_id;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS restoreBenefit;
CREATE PROCEDURE restoreBenefit(IN p_id int)
BEGIN
    DECLARE v_code varchar(5);
    DECLARE v_name varchar(60);
    DECLARE v_type VARCHAR(20);
    DECLARE v_description VARCHAR(60);

    SELECT code, name, type, description
    INTO v_code, v_name, v_type, v_description
    FROM MD_benefies
    WHERE id = p_id;

    INSERT INTO benefits (code, name, type, description)
    VALUES (v_code, v_name, v_type, v_description);

    DELETE FROM MD_benefies WHERE id = p_id;
END$$
DELIMITER ;


/*Obtener el promedio de los rating/score de cada departemento*/
SELECT d.name AS Department, AVG(p.score) AS Score 
FROM employee e 
INNER JOIN performance p ON e.code = p.employee 
INNER JOIN position pos ON e.positionCode = pos.code 
INNER JOIN department d ON pos.departmentCode = d.code 
GROUP BY d.code, d.name 
ORDER BY Score DESC;










/*TIRGGERS*/

/*Trigger para el codigo de los beneficios con explicacion porque es la base de los otros*/
/*Nuevo trigger para devolver poder devolver los beneficios eliminados, no arroge error*/
DELIMITER $$
DROP TRIGGER IF EXISTS generate_benefit_code$$
CREATE TRIGGER generate_benefit_code
BEFORE INSERT ON benefits
FOR EACH ROW
BEGIN
    DECLARE max_code INT;
    DECLARE new_code VARCHAR(4);

    IF new.code = 'code' then

        SELECT IFNULL(MAX(CAST(SUBSTRING(code, 2) AS UNSIGNED)), 0) INTO max_code FROM benefits;

        SET new_code = CONCAT('B', LPAD(max_code + 1, 3, '0'));

        WHILE EXISTS (SELECT 1 FROM benefits WHERE code = new_code) DO
            SET max_code = max_code + 1;
            SET new_code = CONCAT('B', LPAD(max_code, 3, '0'));
        END WHILE;

        SET NEW.code = new_code;
    end if;
END$$
DELIMITER ;

/*Trigger para el codigo de departament(RH)*/
DELIMITER $$
CREATE TRIGGER generate_department_code
BEFORE INSERT ON department
FOR EACH ROW
BEGIN
    DECLARE max_code INT;
    DECLARE new_code VARCHAR(4);

    SELECT IFNULL(MAX(CAST(SUBSTRING(code, 2) AS UNSIGNED)), 0) INTO max_code FROM department;

    SET new_code = CONCAT('D', LPAD(max_code + 1, 3, '0'));

    WHILE EXISTS (SELECT 1 FROM department WHERE code = new_code) DO
        SET max_code = max_code + 1;
        SET new_code = CONCAT('D', LPAD(max_code, 3, '0'));
    END WHILE;

    SET NEW.code = new_code;
END$$
DELIMITER ;


-- Trigger para el codigo de promotion
DELIMITER $$
DROP TRIGGER IF EXISTS generate_promotion_code$$
CREATE TRIGGER generate_promotion_code
BEFORE INSERT ON promotion
FOR EACH ROW
BEGIN
    DECLARE max_code INT DEFAULT 0;
    DECLARE new_code VARCHAR(4);

    IF NEW.code = 'code' THEN
        SELECT IFNULL(MAX(CAST(SUBSTRING(code, 2) AS UNSIGNED)), 0)
        INTO max_code
        FROM promotion;

        SET new_code = CONCAT('P', LPAD(max_code + 1, 3, '0'));

        WHILE EXISTS (SELECT 1 FROM promotion WHERE code = new_code) DO
            SET max_code = max_code + 1;
            SET new_code = CONCAT('P', LPAD(max_code, 3, '0'));
        END WHILE;

        SET NEW.code = new_code;
    END IF;
END$$
DELIMITER ;


-- Trigger para el codigo de los puestos
DELIMITER $$
CREATE TRIGGER generate_position_code
BEFORE INSERT ON `position`
FOR EACH ROW
BEGIN
    DECLARE max_code INT;
    DECLARE new_code VARCHAR(4);

    SELECT IFNULL(MAX(CAST(SUBSTRING(code, 2) AS UNSIGNED)), 0) INTO max_code FROM `position`;

    SET new_code = CONCAT('P', LPAD(max_code + 1, 3, '0'));

    WHILE EXISTS (SELECT 1 FROM `position` WHERE code = new_code) DO
        SET max_code = max_code + 1;
        SET new_code = CONCAT('P', LPAD(max_code, 3, '0'));
    END WHILE;

    SET NEW.code = new_code;
END$$
DELIMITER ;






DELIMITER $$
DROP TRIGGER IF EXISTS before_vacation$$
CREATE TRIGGER before_vacation
BEFORE INSERT ON vacations
FOR EACH ROW
BEGIN
    DECLARE days INT DEFAULT 0;
    DECLARE years INT;
    DECLARE daysTotal INT;
    DECLARE newDays INT;



    SELECT TIMESTAMPDIFF(YEAR, contractDate, NOW()) into years
    FROM employee as e
    INNER JOIN vacations as v
    ON e.code = v.employee
    WHERE employee = NEW.employee
    LIMIT 1;

    SELECT IFNULL(SUM(TIMESTAMPDIFF(DAY, startDate, endDate)), 0) INTO days
    FROM vacations
    WHERE status = 'Approved' AND employee = NEW.employee;

    IF years >= 1 AND years <= 5 THEN
        SET daysTotal = 12 + (years * 2);
    ELSEIF years >= 6 AND years <= 10 THEN
        SET daysTotal = 22;
    ELSEIF years >= 11 AND years <= 15 THEN
        SET daysTotal = 24;
    ELSEIF years >= 16 AND years <= 20 THEN
        SET daysTotal = 26;
    ELSEIF years >= 21 AND years <= 25 THEN
        SET daysTotal = 28;
    ELSEIF years >= 26 AND years <= 30 THEN
        SET daysTotal = 30;
    ELSEIF years >= 31 AND years <= 35 THEN
        SET daysTotal = 32;
    END IF;

    SELECT IFNULL(SUM(TIMESTAMPDIFF(DAY, NEW.startDate, NEW.endDate)), 0) INTO newDays
    FROM vacations
    WHERE employee = NEW.employee;

    SET daysTotal = daysTotal - days - newDays;

    IF daysTotal <= 0 THEN
        SET NEW.status = "Rejected";
    END IF;

END$$

DELIMITER ;



DELIMITER $$
CREATE TRIGGER remove_accents_from_employee
BEFORE INSERT ON employee
FOR EACH ROW
BEGIN
    SET NEW.firstName = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
        NEW.firstName, 
        'á', 'a'), 
        'é', 'e'), 
        'í', 'i'), 
        'ó', 'o'), 
        'ú', 'u'), 
        'Á', 'A'), 
        'É', 'E'), 
        'Í', 'I'), 
        'Ó', 'O'), 
        'Ú', 'U');

    SET NEW.lastName = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
        NEW.lastName, 
        'á', 'a'), 
        'é', 'e'), 
        'í', 'i'), 
        'ó', 'o'), 
        'ú', 'u'), 
        'Á', 'A'), 
        'É', 'E'), 
        'Í', 'I'), 
        'Ó', 'O'), 
        'Ú', 'U');

    SET NEW.middleName = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
        NEW.middleName, 
        'á', 'a'), 
        'é', 'e'), 
        'í', 'i'), 
        'ó', 'o'), 
        'ú', 'u'), 
        'Á', 'A'), 
        'É', 'E'), 
        'Í', 'I'), 
        'Ó', 'O'), 
        'Ú', 'U');
END$$
DELIMITER ;