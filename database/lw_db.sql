CREATE DATABASE IF NOT EXISTS lw_db;
USE lw_db;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS transactiondetails, transactions, carts, products, brands, users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    userID INT(10) AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(100) NOT NULL,
    userEmail VARCHAR(100) NOT NULL UNIQUE,
    userPassword VARCHAR(100) NOT NULL,
    userRole VARCHAR(20) NOT NULL
);

CREATE TABLE brands (
    brandID INT(10) AUTO_INCREMENT PRIMARY KEY,
    brandName VARCHAR(100) NOT NULL,
    brandOrigin VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    productID INT(10) AUTO_INCREMENT PRIMARY KEY,
    brandID INT(10) NOT NULL,
    productName VARCHAR(100) NOT NULL,
    productDescription VARCHAR(255) NULL,
    productPrice INT(10) NOT NULL,
    productStock INT(10) NOT NULL,
    productImage VARCHAR(255) NOT NULL,
    FOREIGN KEY (brandID) REFERENCES brands(brandID)
);

CREATE TABLE carts (
    userID INT(10) NOT NULL,
    productID INT(10) NOT NULL,
    quantity INT(10) NOT NULL,
    PRIMARY KEY (userID, productID),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (productID) REFERENCES products(productID) ON DELETE CASCADE
);

CREATE TABLE transactions (
    transactionID INT(10) AUTO_INCREMENT PRIMARY KEY,
    userID INT(10) NOT NULL,
    transactionDate DATE NOT NULL,
    totalAmount INT(10) NOT NULL,
    shippingAddress VARCHAR(255) NOT NULL,
    FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE transactiondetails (
    transactionID INT(10) NOT NULL,
    productID INT(10) NOT NULL,
    quantity INT(10) NOT NULL,
    subtotalPrice INT(10) NOT NULL,
    PRIMARY KEY (transactionID, productID),
    FOREIGN KEY (transactionID) REFERENCES transactions(transactionID),
    FOREIGN KEY (productID) REFERENCES products(productID)
);

INSERT INTO users (userName, userEmail, userPassword, userRole) VALUES
('admin', 'admin@gmail.com', '$2y$10$3gvBGYiFrOAUsJtKFkoG0.pqr7r29P56..rN3ISOqnF931ym5cyL6', 'admin'),
('member1', 'member1@gmail.com', '$2y$10$lILPamrqaExp9sjYLC9IYe.KuNpJUPDz83AiJWKKkZccwQ3l/FiN2', 'member');

INSERT INTO brands (brandName, brandOrigin) VALUES
('Brand A', 'USA'),
('Brand B', 'Japan'),
('Brand C', 'Germany');

INSERT INTO products (brandID, productName, productDescription, productPrice, productStock, productImage) VALUES
(1, 'Product 1', 'Description for Product 1', 100, 50, 'product1.jpg'),
(1, 'Product 2', 'Description for Product 2', 150, 30, 'product2.jpg'),
(2, 'Product 3', 'Description for Product 3', 200, 20, 'product3.jpg'),
(2, 'Product 4', 'Description for Product 4', 250, 10, 'product4.jpg'),
(3, 'Product 5', 'Description for Product 5', 300, 5, 'product5.jpg');

