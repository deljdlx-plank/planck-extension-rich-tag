CREATE TABLE tag_association
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,

    tag_id INT,

    type_id INT,

    target_type varchar(1024),
    target_id varchar(1024),
    target_fingerprint varchar(2048),

    properties TEXT,

    creation_date DATETIME,
    update_date DATETIME
)