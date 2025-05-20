
USE electricity;

CREATE TABLE Consumer (
    consumer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    address VARCHAR(255)
);

CREATE TABLE Billing (
    bill_id INT AUTO_INCREMENT PRIMARY KEY,
    consumer_id INT,
    units INT,
    amount DECIMAL(10, 2),
    bill_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (consumer_id) REFERENCES Consumer(consumer_id)
);
