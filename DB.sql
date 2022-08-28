CREATE DATABASE test_inline_2;
CREATE TABLE test_inline_2.post (
	userId int NOT null,
    id int PRIMARY KEY,
    title varchar(100) NOT null,
    body varchar(500) NOT null
    
);
CREATE TABLE test_inline_2.comm (
	postId int,
    FOREIGN KEY (postId) REFERENCES test_inline.post(id),
    id int PRIMARY KEY,
    name varchar(100) NOT null,
    email varchar(100) NOT null,
    body varchar(500) NOT null
    
);