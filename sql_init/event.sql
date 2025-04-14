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
    ('University Lecture on Climate Change', '2023-10-24', '09:00', 'Lecture Hall B1, University of Oxford, UK', 'An informative lecture by a renowned climate scientist.', 1002);

INSERT INTO events (event_title, event_date, event_time, venue, description, creator_id) VALUES
('Art Exhibition', '2025-05-01', '18:00:00', 'City Art Gallery', 'An exhibition showcasing local artists.', 1001),
('Tech Conference', '2025-05-05', '09:00:00', 'Convention Center', 'A conference on the latest in technology.', 1001),
('Music Festival', '2025-06-10', '14:00:00', 'Central Park', 'A day of live music and performances.', 1001),
('Food Fair', '2025-06-15', '11:00:00', 'Downtown Square', 'Taste food from various cultures.', 1004),
('Charity Run', '2025-07-20', '07:00:00', 'Riverfront Trail', 'A charity run for local schools.', 1001),
('Book Launch', '2025-08-01', '17:00:00', 'Local Library', 'Launch of a new novel by a local author.', 1001),
('Outdoor Movie Night', '2025-08-15', '20:00:00', 'Community Park', 'Watch classic movies under the stars.', 1001),
('Tech Workshop', '2025-09-05', '10:00:00', 'Innovation Hub', 'Hands-on workshop for new tech skills.', 1001),
('Yoga Retreat', '2025-09-10', '09:00:00', 'Mountain Resort', 'A weekend retreat for relaxation and yoga.', 1001),
('Startup Pitch Night', '2025-09-25', '18:00:00', 'Business Incubator', 'Startup teams pitch their ideas.', 1001),
('Halloween Party', '2025-10-31', '19:00:00', 'Community Center', 'A spooky night of fun and games.', 1001),
('Winter Fair', '2025-12-05', '12:00:00', 'City Hall', 'Crafts, food, and holiday cheer.', 1001),
('New Year Celebration', '2026-01-01', '22:00:00', 'City Plaza', 'Celebrate the New Year with fireworks.', 1001),
('Science Fair', '2026-02-10', '09:00:00', 'High School Auditorium', 'Showcasing student science projects.', 1001),
('Health Expo', '2026-03-15', '10:00:00', 'Community Health Center', 'Explore health and wellness options.', 1001),
('Photography Workshop', '2026-04-20', '13:00:00', 'Art Studio', 'Learn photography from professionals.', 1001),
('Garden Show', '2026-05-05', '09:00:00', 'Botanical Gardens', 'A showcase of beautiful plants and flowers.', 1001),
('Cultural Festival', '2026-06-12', '11:00:00', 'Town Hall', 'Celebrate diverse cultures with food and performances.', 1001),
('Sports Day', '2026-07-20', '10:00:00', 'Local Stadium', 'A day of various sports and competitions.', 1001),
('Annual Gala', '2026-08-15', '19:00:00', 'Grand Ballroom', 'A formal gala to support local charities.', 1000);

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
    (1000, 1000),
    (1000, 1002),
    (1001, 1001),
    (1001, 1003),
    (1002, 1004),
    (1004, 1001),
    (1004, 1002),
    (1000, 1003);
