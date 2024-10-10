-- Create a new database
CREATE DATABASE seo_services_digital;

-- Use the created database
USE seo_services_digital;

-- Create a contacts table
CREATE TABLE contacts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE service_form (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mobile VARCHAR(10) NOT NULL,  -- Mobile number as BIGINT
    email VARCHAR(255) NOT NULL,
    service VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);