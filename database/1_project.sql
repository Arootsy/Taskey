CREATE TABLE projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title STRING,
    description STRING
);

INSERT INTO projects (title, description)
VALUES ('Mixing Pancakes', 'A nice description of pancakes'),
       ('Go to Home', '21 reasons to go home');