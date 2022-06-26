USE casino;

DROP TABLE IF EXISTS transactions;
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

CREATE TABLE transactions (
  id int(20) NOT NULL,
  title varchar(150) NOT NULL,
  category_id int(5) NOT NULL,
  amount float(10,2) NOT NULL,
  date date NOT NULL,
  id_user int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO categories (id, name, color) VALUES
(1, 'Ingreso de dinero', '#044E0A'),
(2, 'Egreso de dinero', '#FF0000'),
(3, 'Apuesta', '#FF0073'),
(4, 'Retorno Apuesta', '#681FDE'),
(5, 'Egreso Rockola', '#221FDE');


INSERT INTO transactions (id, category_id, amount, date, id_user) VALUES
(1, 1, 1000, '2022-06-20', 1),
(2, 3, -100, '2022-06-20', 1),
(4, 4, 150, '2022-06-20', 1),
(5, 3, -200, '2022-06-21', 1),
(6, 5, -10, '2022-06-21', 1),
(7, 4, 0, '2022-06-21', 1),
(10, 1, 1050, '2022-06-24', 1),
(11, 3, -500, '2022-06-24', 1),
(12, 5, -10, '2022-06-24', 1),
(13, 5, -10, '2022-06-24', 1),
(14, 3, -200, '2022-06-24', 1),
(19, 4, 0, '2022-06-24', 1);


ALTER TABLE categories
  ADD PRIMARY KEY (id);

  ALTER TABLE transactions
  ADD PRIMARY KEY (id),
  ADD KEY id_user_expense (id_user),
  ADD KEY id_category_expense (category_id);

  ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY username (username);


ALTER TABLE categories
  MODIFY id int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table transactions
--
ALTER TABLE transactions
  MODIFY id int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE transactions
  ADD CONSTRAINT id_category_expense FOREIGN KEY (category_id) REFERENCES categories (id),
  ADD CONSTRAINT id_user_expense FOREIGN KEY (id_user) REFERENCES users (id);