CREATE DATABASE IF NOT EXISTS cafe;
USE cafe;

-- The menu
DROP TABLE IF EXISTS menu;
CREATE TABLE IF NOT EXISTS menu (
  menuid int unsigned NOT NULL auto_increment,
  category varchar(20) NOT NULL,
  name varchar(50) NOT NULL,
  description varchar(100) NOT NULL,
  price float NOT NULL,
  PRIMARY KEY (menuid)
) AUTO_INCREMENT=1;
INSERT INTO menu (menuid,category,name,description,price) VALUES(1,'eat',"Bread Basket","Assortment of fresh baked fruit breads and muffins", 5.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(2,'eat','Honey Almond Granola with Fruits','Natural cereal of honey toasted oats, raisins, almonds and dates', 7.00);
INSERT INTO menu (menuid,category,name,description,price) VALUES(3,'eat','Belgian Waffle','Vanilla flavored batter with malted flour', 7.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(4,'eat','Scrambled Eggs','Scrambled eggs, roasted red pepper and garlic, with green onions', 7.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(5,'eat','Blueberry Pancakes','With syrup, butter and lots of berries', 8.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(6,'eat','Mince on Toast','Mince with a poached egg on wholemeal toast',9.00);
INSERT INTO menu (menuid,category,name,description,price) VALUES(7,'eat','Smashed Avocado','Avo on toast with leaves and dressing',8.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(8,'eat','Mushrooms on Toast','Garlic mushrooms on ciabatta toat',7.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(9,'eat','Full English','Everything you expect - sausage, bacon, mushroom, tomato, beans and black pudding',10.00);
INSERT INTO menu (menuid,category,name,description,price) VALUES(10,'drink','Coffee','Regular coffee', 2.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(11,'drink','Chocolato','Chocolate espresso with milk', 4.50);
INSERT INTO menu (menuid,category,name,description,price) VALUES(12,'drink','Corretto','Whiskey and coffee', 5.00);
INSERT INTO menu (menuid,category,name,description,price) VALUES(13,'drink','Iced tea','Hot tea, except not hot', 3.00);
INSERT INTO menu (menuid,category,name,description,price) VALUES(14,'drink','Soda','Coke, Sprite, Fanta, etc.', 2.50);


-- The bookings
DROP TABLE IF EXISTS booking;
CREATE TABLE IF NOT EXISTS booking (
  bookingid int unsigned NOT NULL auto_increment,
  name varchar(50) NOT NULL,
  people tinyint unsigned NOT NULL,
  dateandtime datetime NOT NULL,
  comment varchar(100),
  PRIMARY KEY (bookingid)
) AUTO_INCREMENT=1;
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(1,'Alana',2,'2022-09-30 11:00:00','children included');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(2,'Vikesh',4,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(3,'Tui',3,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(4,'Ana',2,'2022-09-30 11:00:00','away from the door please');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(5,'Michael',5,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(6,'Jax',3,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(7,'Famous Five',5,'2022-09-30 11:00:00','none');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(8,'Lunch ladies',8,'2022-09-30 11:00:00','vegans');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(9,'Pedro',3,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(10,'Angus',2,'2022-09-30 11:00:00','some of the party will be late');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(11,'Tipene',6,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(12,'Sue',2,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(13,'Freddy',3,'2022-09-30 11:00:00','');
INSERT INTO booking(bookingid,name,people,dateandtime,comment) VALUES(14,'JJ',2,'2022-09-30 11:00:00','');






    



    
