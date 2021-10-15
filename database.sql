DROP TABLE IF EXISTS bride;
CREATE TABLE bride (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  payment INT NOT NULL
);
INSERT INTO bride (name, payment) VALUES
('Sam Burns', '100'),
('Samuel Yans', '52563');
