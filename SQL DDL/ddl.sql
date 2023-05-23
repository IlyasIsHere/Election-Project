DROP DATABASE IF EXISTS elections;
CREATE DATABASE elections;

USE elections;

CREATE TABLE users (
    user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    is_admin BOOLEAN
);

CREATE TABLE elections (
    election_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description VARCHAR(255),
    start_date DATE,
    end_date DATE
);

CREATE TABLE candidates (
  candidate_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  election_id INTEGER,
  name VARCHAR(50),
  photo VARCHAR(255),
  FOREIGN KEY (election_id) REFERENCES elections(election_id)
);

CREATE TABLE votes (
    vote_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    election_id INTEGER,
    user_id INTEGER,
    vote INTEGER,
    TIMESTAMP TIMESTAMP,
    FOREIGN KEY (election_id) REFERENCES elections(election_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (vote) REFERENCES candidates(candidate_id)
);

CREATE TABLE programs (
    program_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    candidate_id INTEGER,
    program_title VARCHAR(255),
    program_description VARCHAR(255),
    program_video VARCHAR(255),
    program_affiche VARCHAR(255),
    FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id)
);

INSERT INTO users (username, email, password, is_admin) VALUES ('admin', 'admin@gmail.com', '$2y$10$bCFW/0PoMt119BQ27d0.je92iNvODER4xTZQByottUeaS4W5tkWC6', true);