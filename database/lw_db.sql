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

INSERT INTO brands (brandID, brandName, brandOrigin) VALUES
(1, 'Dior', 'France'),
(2, 'Chanel', 'France'),
(3, 'Yves Saint Laurent', 'France'),
(4, 'Giorgio Armani', 'Italy'),
(5,'Versace', 'Italy'),
(6, 'Calvin Klein', 'USA');

INSERT INTO products (productID, brandID, productName, productDescription, productPrice, productStock, productImage) VALUES
(1, 1, 'Sauvage EDT 100ml', 'Aroma segar dengan bergamot dan ambroxan, cocok untuk pria', 1850000, 20, 'product1.jpg'),
(2, 1, 'Miss Dior Eau de Parfum 50ml', 'Aroma floral mawar dan peony, feminin dan elegan', 1950000, 15, 'product2.jpg'),
(3, 2, 'Bleu de Chanel EDP 100ml', 'Aroma woody aromatik yang maskulin dan tahan lama', 2600000, 12, 'product3.jpg'),
(4, 2, 'Coco Mademoiselle EDP 50ml', 'Aroma oriental floral dengan jeruk dan patchouli', 2400000, 10, 'product4.jpg'),
(5, 3, 'Libre EDP 50ml', 'Aroma lavender dan bunga jeruk, berani dan hangat', 1800000, 18, 'product5.jpg'),
(6, 3, 'Y EDP 60ml', 'Aroma segar apel dengan sentuhan woody', 1700000, 16, 'product6.jpg'),
(7, 4, 'Acqua di Gio Profumo 75ml', 'Aroma aquatic dengan patchouli, segar dan bersih', 1900000, 14, 'product7.jpg'),
(8, 4, 'My Way EDP 50ml', 'Aroma floral putih dengan vanila, lembut dan hangat', 1750000, 12, 'product8.jpg'),
(9, 5, 'Eros EDT 100ml', 'Aroma mint dan apel hijau dengan vanila, kuat dan segar', 1250000, 25, 'product9.jpg'),
(10, 6, 'CK One EDT 100ml', 'Aroma unisex yang segar dengan jeruk dan teh hijau', 650000, 30, 'product10.jpg');

