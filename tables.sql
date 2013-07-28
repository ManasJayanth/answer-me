create database answerMe;

use answerMe;

create table questions(
	qno int primary key,
	qtext varchar(100) not null,
	nchoices int not null,
	answer int
);

create table choices(
	qno int,
	cno int,
	foreign key(qno) references questions(qno),
	choice varchar(100) not null
);

create table qImgs(
	qno int,
	foreign key(qno) references questions(qno),
	imgname varchar(100)
);