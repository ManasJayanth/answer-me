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


drop table test;
create table test(
	testid int primary key AUTO_INCREMENT,
	testname varchar(50),
	questions varchar(100),
	testnos int,
	timelimit int,
	negmarking boolean
);

create table student (
	loginid varchar(10) primary key,
	name varchar(50),
	password varchar(32)
);

insert into student values('1','abc',md5('xyz'));