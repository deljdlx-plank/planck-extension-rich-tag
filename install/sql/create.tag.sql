CREATE TABLE tag
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type_id INT,
    category_id INT,
    status INT,
    slug VARCHAR(1024),
    path TEXT,

    image_id INT,

    name VARCHAR(1024),
    properties TEXT,
    creation_date DATETIME,
    update_date DATETIME

)