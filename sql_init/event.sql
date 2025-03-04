USE database;

CREATE TABLE users (user_id INT UNIQUE, PRIMARY KEY(user_id));

CREATE TABLE events (
    event_id INT NOT NULL AUTO_INCREMENT,
    event_title VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    venue VARCHAR(255),
    description VARCHAR(255),
    PRIMARY KEY(event_id)
);

ALTER TABLE events AUTO_INCREMENT=1000;

INSERT INTO events (event_title, event_date, event_time, venue, description)
VALUES
    ('Soccer Match', '2023-10-28', '19:45', 'Allianz Arena, Munich, Germany', 'A thrilling soccer match between two top teams featuring star players.'),
    ('Basketball Final', '2023-10-27', '20:30', 'Basketball Stadium', 'An epic final match with intense action and crowd support.'),
    ('Concert by The Rolling Stones', '2023-10-26', '18:00', 'The Stonebank, London, UK', 'A legendary concert featuring The Rolling Stones performing their greatest hits.'),
    ('Wedding Ceremony', '2023-10-25', '13:30', 'Hotel du Lac, Annecy, France', 'A beautiful wedding ceremony with a traditional French theme.'),
    ('University Lecture on Climate Change', '2023-10-24', '09:00', 'Lecture Hall B1, University of Oxford, UK', 'An informative lecture by a renowned climate scientist.');

CREATE TABLE user_events (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);
