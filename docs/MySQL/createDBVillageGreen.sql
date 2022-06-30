-- Création de la Database

DROP DATABASE IF EXISTS villagegreen;
CREATE DATABASE IF NOT EXISTS villagegreen;
USE villagegreen;

DROP TABLE IF EXISTS suppliers;
CREATE TABLE IF NOT EXISTS suppliers(
   supp_id INT NOT NULL AUTO_INCREMENT,
   supp_name VARCHAR(25) NOT NULL,
   supp_adress VARCHAR(255) NOT NULL,
   supp_zipcode VARCHAR(5) NOT NULL,
   supp_city VARCHAR(25) NOT NULL,
   supp_phone VARCHAR(10) NOT NULL,
   supp_mail VARCHAR(255) NOT NULL,
   supp_type TINYINT(1) NOT NULL,
   PRIMARY KEY(supp_id)
);

DROP TABLE IF EXISTS employees;
CREATE TABLE IF NOT EXISTS employees(
   emp_id INT NOT NULL AUTO_INCREMENT,
   emp_firstname VARCHAR(25) NOT NULL,
   emp_lastname VARCHAR(25) NOT NULL,
   emp_phone VARCHAR(10) NOT NULL,
   emp_mail VARCHAR(255) NOT NULL,
   emp_dep VARCHAR(25) NOT NULL,
   PRIMARY KEY(emp_id)
);

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category(
   cat_id INT NOT NULL AUTO_INCREMENT,
   cat_name VARCHAR(25) NOT NULL,
   PRIMARY KEY(cat_id)
);

DROP TABLE IF EXISTS subcategory;
CREATE TABLE IF NOT EXISTS subcategory(
   subcat_id INT NOT NULL AUTO_INCREMENT,
   subcat_name VARCHAR(50) NOT NULL,
   subcat_cat_id INT NOT NULL,
   PRIMARY KEY(subcat_id),
   FOREIGN KEY(subcat_cat_id) REFERENCES category(cat_id)
);

DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products(
   pro_id INT NOT NULL AUTO_INCREMENT,
   pro_ref VARCHAR(6) NOT NULL,
   pro_short_lib VARCHAR(25) NOT NULL,
   pro_long_lib VARCHAR(255) NOT NULL,
   pro_s_price DECIMAL(8,2) NOT NULL,
   pro_b_price DECIMAL(8,2) NOT NULL,
   pro_img_href VARCHAR(255) NOT NULL,
   pro_stock_p INT NOT NULL, 
   pro_stock_a INT NOT NULL,
   pro_subcat_id INT NOT NULL,
   pro_supp_id INT NOT NULL,
   PRIMARY KEY(pro_id),
   FOREIGN KEY(pro_subcat_id) REFERENCES subcategory(subcat_id),
   FOREIGN KEY(pro_supp_id) REFERENCES suppliers(supp_id)
);

DROP TABLE IF EXISTS customers;
CREATE TABLE IF NOT EXISTS customers(
   cus_id INT NOT NULL AUTO_INCREMENT,
   cus_firstname VARCHAR(25) NOT NULL,
   cus_lastname VARCHAR(25) NOT NULL,
   cus_adress VARCHAR(255) NOT NULL,
   cus_zipcode VARCHAR(5) NOT NULL,
   cus_city VARCHAR(25) NOT NULL,
   cus_phone VARCHAR(10) NOT NULL,
   cus_mail VARCHAR(255) NOT NULL,
   cus_adress_del VARCHAR(255),
   cus_zipcode_del VARCHAR(5),
   cus_city_del VARCHAR(25),
   cus_type TINYINT(1) NOT NULL,
   cus_emp_id INT NOT NULL,
   PRIMARY KEY(cus_id),
   FOREIGN KEY(cus_emp_id) REFERENCES employees(emp_id)
);

DROP TABLE IF EXISTS orders;
CREATE TABLE IF NOT EXISTS orders(
   ord_id INT NOT NULL AUTO_INCREMENT,
   ord_date DATE NOT NULL,
   ord_status VARCHAR(15) NOT NULL,
   ord_total DECIMAL(11,2) NOT NULL,
   ord_cus_id INT NOT NULL,
   PRIMARY KEY(ord_id),
   FOREIGN KEY(ord_cus_id) REFERENCES customers(cus_id)
);

DROP TABLE IF EXISTS ord_detail;
CREATE TABLE IF NOT EXISTS ord_detail(
   ode_id INT NOT NULL AUTO_INCREMENT,
   ode_qt INT NOT NULL,
   ode_unit_price DECIMAL(8,2) NOT NULL,
   ode_ord_id INT NOT NULL,
   ode_pro_id INT NOT NULL,
   PRIMARY KEY(ode_id),
   FOREIGN KEY(ode_ord_id) REFERENCES orders(ord_id),
   FOREIGN KEY(ode_pro_id) REFERENCES products(pro_id)
);

DROP TABLE IF EXISTS delivery;
CREATE TABLE IF NOT EXISTS delivery(
   del_id INT NOT NULL AUTO_INCREMENT,
   del_date_ship DATE NOT NULL,
   del_date_deliv DATE NOT NULL,
   del_qt_del INT NOT NULL,
   del_qt_remainder INT NOT NULL,
   del_ord_id INT NOT NULL,
   PRIMARY KEY(del_id),
   FOREIGN KEY(del_ord_id) REFERENCES orders(ord_id)
);

DROP TABLE IF EXISTS billing;
CREATE TABLE IF NOT EXISTS billing(
   bill_id INT NOT NULL AUTO_INCREMENT,
   bill_discount DECIMAL(5,2) NOT NULL,
   bill_more_discount DECIMAL(5,2) NOT NULL,
   bill_date DATE NOT NULL,
   bill_total DECIMAL(11,2) NOT NULL,
   bill_status TINYINT(1) NOT NULL,
   bill_payment_type TINYINT(1) NOT NULL,
   bill_ord_id INT NOT NULL,
   PRIMARY KEY(bill_id),
   FOREIGN KEY(bill_ord_id) REFERENCES orders(ord_id)
);

CREATE UNIQUE INDEX ux_category ON category (cat_id,cat_name);
CREATE UNIQUE INDEX ux_subcategory ON subcategory (subcat_id,subcat_name);

/*CREATE INDEX ix_suppliers ON suppliers;
CREATE INDEX ix_employees ON employees;
CREATE INDEX ix_products ON products;
CREATE INDEX ix_customers ON customers;
CREATE INDEX ix_orders ON orders;
CREATE INDEX ix_ord_detail ON ord_detail;
CREATE INDEX ix_delivery ON delivery;
CREATE INDEX ix_billing ON billing;*/