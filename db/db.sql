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
(1, 'comida', '#DE1F59'),
(2, 'hogar', '#DE1FAA'),
(3, 'ropa', '#B01FDE'),
(4, 'Juegos', '#681FDE'),
(5, 'Viajes', '#1FAADE');


INSERT INTO expenses (id, title, category_id, amount, date, id_user) VALUES
(1, 'prueba', 3, 12.40, '2020-03-21', 5),
(2, 'starbucks', 1, 60.00, '2020-03-21', 5),
(4, 'Regalo de cumpleaños mamá', 2, 1200.00, '2020-03-22', 5),
(5, 'Nintendo Switch', 4, 4600.00, '2020-03-26', 5),
(6, 'Viaje a Nueva York', 5, 20000.00, '2020-01-25', 5),
(7, 'Chocolates Ferrero', 1, 140.00, '2020-03-27', 5),
(10, 'sdsdsd', 1, 2323.00, '2020-04-03', 5),
(11, 'sadas', 1, 232.00, '2020-04-03', 5),
(12, 'sadas', 3, 11.00, '2020-04-03', 5),
(13, 'sdsd', 5, 23.00, '2020-04-03', 5),
(14, 'sdsd', 5, 23.00, '2020-04-03', 5),
(19, 'Chilis', 1, 300.00, '2020-01-01', 5),
(20, 'juego de Halo', 4, 1100.00, '2020-04-04', 5),
(21, 'Uñas', 3, 200.00, '2020-04-09', 6),
(23, 'pastillas para la tos', 2, 21.00, '2020-06-06', 5),
(24, 'Ropa nueva', 3, 300.00, '2020-06-04', 5),
(25, 'juego Nintendo', 2, 200.00, '2020-07-12', 5);


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
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


  ALTER TABLE expenses
  ADD CONSTRAINT id_category_expense FOREIGN KEY (category_id) REFERENCES categories (id),
  ADD CONSTRAINT id_user_expense FOREIGN KEY (id_user) REFERENCES users (id);
COMMIT;