CREATE TABLE tag_type
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    parent_id INT,
    leftbound INT,
    rightbound INT,
    depth INT,
    rank INT,
    type_id INT,
    status INT,
    slug VARCHAR(1024),
    path TEXT,
    name VARCHAR(1024),
    properties TEXT,
    creation_date DATETIME,
    update_date DATETIME
)