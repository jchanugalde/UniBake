.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;


create table UserLogin(
	userID integer unique primary key, 
	name text,
	phone text unique
);

create table Login(
	userID integer unique,
	email text primary key,
	password text,
	foreign key(userID) references UserLogin(userID) 
);

create table School(
	schoolID integer unique primary key,
	name text,
	domain text unique
);

create table Attends(
	userID integer unique,
	schoolID integer,
	foreign key(userID) references UserLogin(userID),
	foreign key(schoolID) references School(schoolID)
);

create table Recipe(
	filePath text unique primary key,
	bakeTime integer
);

create table Category(
	filePath text,
	category text,
	foreign key(filePath) references Recipe(filePath)
);

create table BakeRequest(
	userID integer unique,
	startTime time,
	endTime time check (endTime > startTime),
	foreign key(userID) references UserLogin(userID) 
);

--NOTE: "category" technically references from the relation Category
--However, it doesn't reference a specific tuple, the value just has to be present in the Category relation.
create table RequestCategory(
	userID integer,
	category text,
	foreign key(userID) references UserLogin(userID)
);

create table Pair(
	user1 integer unique,
	user2 integer unique,
	recipe text references Recipe(filePath),
	primary key (user1, user2),
	foreign key(user1) references UserLogin(userID),
	foreign key(user2) references UserLogin(userID)
);

