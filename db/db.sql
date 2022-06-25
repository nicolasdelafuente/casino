USE casino;

DROP TABLE IF EXISTS expenses;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;




CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  role enum('user','admin') NOT NULL,
  name varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE categories (
  id int(5) NOT NULL,
  name varchar(100) NOT NULL,
  color varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE expenses (
  id int(20) NOT NULL,
  title varchar(150) NOT NULL,
  category_id int(5) NOT NULL,
  amount float(10,2) NOT NULL,
  date date NOT NULL,
  id_user int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO categories (id, name, color) VALUES
(1, 'Ingreso de dinero', '#DE1F59'),
(2, 'Egreso de dinero', '#DE1FAA'),
(3, 'Apuesta', '#B01FDE'),
(4, 'Retorno Apuesta', '#681FDE'),
(5, 'Egreso Rockola', '#1FAADE');


INSERT INTO expenses (id, category_id, amount, date, id_user) VALUES
(1, 1, 1000, '2022-06-20', 1),
(2, 3, -100, '2020-03-21', 1),
(4, 4, 150, '2020-03-22', 1),
(5, 3, -200, '2020-03-26', 1),
(6, 5, -10, '2020-01-25', 1),
(7, 4, 0, '2020-03-27', 1),
(10, 1, 1050, '2020-04-03', 1),
(11, 3, -500, '2020-04-03', 1),
(12, 5, -10, '2020-04-03', 1),
(13, 5, -10, '2020-04-03', 1),
(14, 3, -200, '2020-04-03', 1),
(19, 4, 0, '2020-01-01', 1);


ALTER TABLE categories
  ADD PRIMARY KEY (id);

  ALTER TABLE expenses
  ADD PRIMARY KEY (id),
  ADD KEY id_user_expense (id_user),
  ADD KEY id_category_expense (category_id);

  ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY username (username);


  ALTER TABLE categories
  MODIFY id int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table expenses
--
ALTER TABLE expenses
  MODIFY id int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;


  ALTER TABLE expenses
  ADD CONSTRAINT id_category_expense FOREIGN KEY (category_id) REFERENCES categories (id),
  ADD CONSTRAINT id_user_expense FOREIGN KEY (id_user) REFERENCES users (id);
COMMIT;