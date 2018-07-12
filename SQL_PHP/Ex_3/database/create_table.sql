CREATE TABLE movies
(
    id int PRIMARY KEY AUTO_INCREMENT,
    title varchar(55) NOT NULL,
    actors varchar(255) NOT NULL,
    director varchar(55) NOT NULL,
    producer varchar(55) NOT NULL,
    year_of_prod year NOT NULL,
    language varchar(2) NOT NULL,
    category enum('Action', 'Adventure', 'Animation', 'Biography', 'Comedy', 'Crime', 'Documentary', 'Drama', 'Family', 'Fantasy', 'History', 'Horror', 'Music', 'Musical', 'Mystery', 'Romance', 'Sci-Fi', 'Short', 'Sport', 'Superhero', 'Thriller', 'War', 'Western') NOT NULL,
    storyline text NOT NULL,
    video varchar(255) NOT NULL
)
