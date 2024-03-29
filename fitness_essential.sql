CREATE TABLE RkU_SUBSCRIPTION(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    startDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    endDate DATE NOT NULL,
    renewalDate DATE,
    nextPaymentDate DATE,
    paymentFrequency INTEGER NOT NULL,
    price FLOAT NOT NULL,
    discount FLOAT
    );
CREATE TABLE RkU_SPORT(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255)
    );


CREATE TABLE RkU_CITY(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    zipCode INTEGER NOT NULL
    );

CREATE TABLE RkU_USER(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(180) NOT NULL,
    email VARCHAR(255) NOT NULL,
    civility CHAR(1) NOT NULL,
    avatar VARCHAR(255) DEFAULT 0 NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(200) NOT NULL,
    city VARCHAR(180) NOT NULL,
    zipCode INTEGER NOT NULL,
    birthday DATE NOT NULL,
    fitcoin INTEGER NOT NULL CHECK (fitcoin >= 0),
    role INTEGER NOT NULL,
    registrationDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    lastUpdate timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    lastPasswordUpdate timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    token CHAR(17) DEFAULT NULL,
    token_confirm_inscription CHAR(17) DEFAULT NULL,
    subscription INTEGER DEFAULT NULL REFERENCES RkU_SUBSCRIPTION(id)
    );

CREATE TABLE RkU_GYMS(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    surfaceArea INTEGER NOT NULL,
    address VARCHAR(255) NOT NULL,
    user INTEGER NOT NULL REFERENCES RkU_USER(id),
    city INTEGER REFERENCES RkU_CITY(id)
    );

CREATE TABLE RkU_BOOKING(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    status INTEGER NOT NULL,
    price FLOAT NOT NULL,
    discount FLOAT,
    sport INTEGER NOT NULL REFERENCES RkU_SPORT(id),
    gym INTEGER NOT NULL REFERENCES RkU_GYMS(id)
    );

CREATE TABLE RkU_PAYMENT(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    amount FLOAT NOT NULL,
    paymentDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    subscription INTEGER NOT NULL REFERENCES RkU_SUBSCRIPTION(id),
    booking INTEGER NOT NULL REFERENCES RkU_BOOKING(id)
    );

CREATE TABLE RkU_MACHINE(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    serialNumber VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    state INTEGER,
    gym INTEGER NOT NULL REFERENCES RkU_GYMS(id)
    );

CREATE TABLE RkU_TOPIC(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    creationDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    topicOrder INTEGER NOT NULL
);
    
CREATE TABLE RkU_QUESTION(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    creationDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    userId INTEGER NOT NULL REFERENCES RkU_USER(id),
    topic INTEGER NOT NULL REFERENCES RkU_TOPIC(id),
    status CHAR(1)
    );

CREATE TABLE RkU_MESSAGE(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    dateSend timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    content TEXT NOT NULL,
    userId INTEGER NOT NULL REFERENCES RkU_USER(id),
    question INTEGER NOT NULL REFERENCES RkU_QUESTION(id)
   	);

CREATE TABLE RkU_RESERVES(
    user INTEGER REFERENCES RkU_USER(id),
    booking INTEGER REFERENCES RkU_USER(id)
    );

CREATE TABLE RkU_PROGRAM(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL,
    description VARCHAR(255),
    creationDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
    );
    
CREATE TABLE RkU_EXERCICE(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL,
    description VARCHAR(255)
    );
    
CREATE TABLE RkU_CONTAINS(
    repeats INTEGER NOT NULL,
    series INTEGER NOT NULL,
    program INTEGER NOT NULL REFERENCES RkU_PROGRAM(id),
    exercice INTEGER NOT NULL REFERENCES RkU_EXERCICE(id)
    );