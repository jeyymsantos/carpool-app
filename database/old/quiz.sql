mysql u- root

CREATE DATABASE personnel_db;

USE personnel_db;

CREATE TABLE emp_tb (
  e_id char(8) NOT NULL PRIMARY KEY,
  e_name varchar(50) NOT NULL,
  e_dept char(1) NOT NULL,
  e_salary float(9, 2),
  e_allow float(9, 2),
  e_hired DATE NOT NULL,
  e_regis timestamp NOT NULL DEFAULT current_timestamp
);

DESCRIBE emp_tb;


INSERT INTO `emp_tb` (`e_id`, `e_name`, `e_dept`, `e_salary`, `e_allow`, `e_hired`) VALUES 
('NU-0001', 'Shae Smith', 'A', '50000.00', '10000.00', '2022-03-14'),
('NU-0002', 'Sam Espino', 'A', '150600.50', '25000.00', '2022-05-01'),
('NU-0005', 'Michelle West', 'C', '510100.91', '55100.00', '2022-02-07'),
('NU-0008', 'Liv Tyler', 'B', '100000.00', '15000.00', '2022-05-04'),
('NU-0125', 'Third Lee', 'C', '1150500.50', '100000.00', '2022-03-14')
;

SELECT * FROM emp_tb;

BEGIN;
DELETE FROM emp_tb WHERE e_id = 'NU-0125';
SELECT * FROM emp_tb;
ROLLBACK;

SELECT * FROM emp_tb;


CREATE INDEX e_name_idx ON emp_tb(e_name);
SHOW INDEX FROM emp_tb;
ALTER TABLE emp_tb DROP INDEX e_name_idx;

SELECT e_ID, e_name, e_salary + e_allow AS 'Gross Pay' FROM emp_tb;

UPDATE emp_tb SET e_salary = e_salary + 1000;
SELECT * FROM emp_tb;
UPDATE emp_tb SET e_dept = 'B', e_name = 'Shae Wright' WHERE e_id = 'NU-0001';
SELECT * FROM emp_tb;