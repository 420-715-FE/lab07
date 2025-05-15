DROP DATABASE IF EXISTS photo_gallery;
CREATE DATABASE photo_gallery;
USE photo_gallery;

CREATE TABLE photo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL DEFAULT '',
    timestamp DATETIME DEFAULT NULL,
    latitude DOUBLE DEFAULT NULL,
    longitude DOUBLE DEFAULT NULL,
    filepath VARCHAR(4096)
);

CREATE TABLE tag (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE
);

CREATE TABLE photo_tag (
    photo_id INT,
    tag_id INT,
    PRIMARY KEY (photo_id, tag_id),
    FOREIGN KEY (photo_id) REFERENCES photo(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE
);

CREATE TABLE album (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    featured_photo_id INT,
    FOREIGN KEY (featured_photo_id) REFERENCES photo(id) ON DELETE SET NULL
);

CREATE TABLE album_photo (
    album_id INT,
    photo_id INT,
    PRIMARY KEY (album_id, photo_id),
    FOREIGN KEY (album_id) REFERENCES album(id) ON DELETE CASCADE,
    FOREIGN KEY (photo_id) REFERENCES photo(id) ON DELETE CASCADE
);

INSERT INTO photo (filepath, timestamp, latitude, longitude, description)
    VALUES
    (
        'images/01c2fe0d-6758-4f0a-945d-0dc44a95f973.jpg',
        '2023-07-17T20:39',
        47.861675,
        -69.551439,
        'Parc de la Pointe, Rivière-du-Loup.'
    ),
    (
        'images/27a53ca3-1777-4376-a5f0-bd406b1d0bf6.jpg',
        '2021-07-30T12:06',
        45.419461,
        -72.721696,
        'Des flamants roses au Zoo de Granby.'
    ),
    (
        'images/38fec351-8f80-41e8-bc53-22cd0d02bdf5.jpg',
        '2019-07-10T21:25',
        46.240744,
        -64.509389,
        'Coucher de soleil à Parlee Beach, Shediac, Nouveau-Brunswick.'
    ),
    (
        'images/352ea3d4-bb25-4677-a718-5f45c812506d.jpg',
        '2019-07-13T19:39',
        46.499394,
        -63.391767,
        'Château de sable sur la plage Cavendish au Parc national de l’Île-du-Prince-Édouard.'
    ),
    (
        'images/493e1729-565c-4b3f-a2c7-95a0dc258bac.jpg',
        '2023-07-19T12:29',
        48.366102,
        -68.754103,
        'L''Île-aux-Amours, Parc national du Bic.'
    ),
    (
        'images/29625b50-6fe2-48de-b024-8317755c9744.jpg',
        '2021-07-30T12:40',
        45.418786,
        -72.721306,
        'Une très grosse tortue!!!'
    ),
    (
        'images/a301c7b6-a71a-43af-95cb-27918535aa2d.jpg',
        '2019-07-14T14:47',
        46.456972,
        -63.303561,
        'North Rustico, Île-du-Prince-Édouard.'   
    ),
    (
        'images/b3ab66cf-2d54-4dd1-ab1a-04699bdf3c56.jpg',
        '2021-07-30T11:48',
        45.418861,
        -72.723686,
        'Un éléphant qui mange.'
    ),
    (
        'images/df2eafca-1094-46a9-b69e-0fa6fbe98a75.jpg',
        '2021-07-30T11:58',
        45.418911,
        -72.723355,
        'DES GIRAFES!!!'
    ),
    (
        'images/e794140d-0ea3-4c7e-91f7-345611541fc9.jpg',
        '2021-07-30T11:48',
        45.418861,
        -72.723686,
        'Un éléphant au Zoo de Granby.'
    )
    ;

INSERT INTO tag (name)
    VALUES
    ('animaux'),
    ('plage'),
    ('coucher de soleil'),
    ('zoo'),
    ('tortue'),
    ('flamant rose'),
    ('éléphant'),
    ('girafe'),
    ('oiseaux')
    ;

INSERT INTO photo_tag (photo_id, tag_id)
    VALUES
    (1, 2),
    (2, 1),
    (2, 4),
    (2, 6),
    (2, 9),
    (3, 2),
    (3, 3),
    (4, 2),
    (5, 1),
    (5, 2),
    (5, 9),
    (6, 1),
    (6, 4),
    (6, 5),
    (7, 2),
    (8, 1),
    (8, 4),
    (8, 7),
    (9, 1),
    (9, 4),
    (9, 8),
    (10, 1),
    (10, 4),
    (10, 7)
    ;

INSERT INTO album (name, featured_photo_id)
    VALUES
    ('Zoo de Granby', 2),
    ('Plages', 3)
    ;
    
INSERT INTO album_photo (album_id, photo_id)
    VALUES
    (1, 2),
    (1, 6),
    (1, 8),
    (1, 9),
    (1, 10),
    (2, 1),
    (2, 3),
    (2, 4),
    (2, 5),
    (2, 7)
    ;
