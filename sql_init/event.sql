USE database;


CREATE TABLE users (
    user_id INT UNIQUE NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    PRIMARY KEY(user_id)
);
ALTER TABLE users AUTO_INCREMENT=1000;
INSERT INTO users (username, password, email)
VALUES
    ('Alice', 'password123', 'Alice@Alice.com'),
    ('Bob', 'securePass456', 'Bob@Bob.com'),
    ('Charlie', 'qwerty789', 'Charlie@Charlie.com'),
    ('Dana', 'letmein101', 'Dana@Dana.com'),
    ('Eve', 'mypass2023', 'Eve@Eve.com');

CREATE TABLE events (
    event_id INT UNIQUE NOT NULL AUTO_INCREMENT,
    event_title VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME,
    venue VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    creator_id INT NOT NULL,
    PRIMARY KEY (event_id),
    FOREIGN KEY (creator_id) REFERENCES users(user_id) ON DELETE CASCADE
);
ALTER TABLE events AUTO_INCREMENT=1000;
INSERT INTO events (event_title, event_date, event_time, venue, description, creator_id)
VALUES
    ('Soccer Match', '2023-10-28', '19:45', 'Allianz Arena, Munich, Germany', 'A thrilling soccer match between two top teams featuring star players.', 1001),
    ('Basketball Final', '2023-10-27', '20:30', 'Basketball Stadium', 'An epic final match with intense action and crowd support.', 1000),
    ('Concert by The Rolling Stones', '2023-10-26', '18:00', 'The Stonebank, London, UK', 'A legendary concert featuring The Rolling Stones performing their greatest hits.', 1001),
    ('Wedding Ceremony', '2023-10-25', '13:30', 'Hotel du Lac, Annecy, France', 'A beautiful wedding ceremony with a traditional French theme.', 1000),
    ('University Lecture on Climate Change', '2023-10-24', '09:00', 'Lecture Hall B1, University of Oxford, UK', 'An informative lecture by a renowned climate scientist.', 1002),
    ('University Lecture on Climate Change', '2023-10-24', '09:00', 'Lecture Hall B1, University of Oxford, UK', 'An informative lecture by a renowned climate scientist.', 1003);

CREATE TABLE user_events (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);
ALTER TABLE user_events AUTO_INCREMENT=1000;
INSERT INTO user_events (user_id, event_id)
VALUES
    (1000, 1001),
    (1000, 1002),
    (1001, 1001),
    (1001, 1003),
    (1002, 1004),
    (1003, 1005),
    (1004, 1001),
    (1004, 1002),
    (1000, 1003),
    (1002, 1005);
