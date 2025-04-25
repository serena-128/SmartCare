drop database if exists smartcare;
create database smartcare;
use smartcare;

create table resident
(	
	id int auto_increment primary key,
	firstname varchar(50), 
	lastname varchar(50), 
	dateofbirth date, 
	gender varchar(20), 
	roomnumber int, 
	admissiondate DATE,
	created_at datetime,
   updated_at datetime,
   deleted_at datetime
);

create table role 
( 
	id int auto_increment primary key, 
	firstname varchar(50), 
	lastname varchar(50), 
	roletype varchar(50 ), 
	contactnumber varchar(15), 
	email varchar(100), 
	employmentstartdate DATE,
	created_at datetime,
   updated_at datetime,
   deleted_at datetime 
);

create table staffmember
( 	
	id int auto_increment primary key,
	reportsto int, 
	firstname varchar(50), 
	lastname varchar(50), 
	role VARCHAR(50), 
	contactnumber varchar(15), 
	email varchar(50), 
	startdate date,
	created_at datetime,
   updated_at datetime,
   deleted_at DATETIME,
	foreign key (reportsto) references role(id) 
);

create table nextofkin 
( 
	id int auto_increment primary key,
	residentid int, 
	firstname varchar(50), 
	lastname varchar(50), 
	relationshiptoresident varchar(100), 
	contactnumber varchar(15), 
	email varchar(100), 
	address varchar(100), 
	created_at datetime,
   updated_at datetime,
   deleted_at DATETIME,
	foreign key (residentid) references resident(id)
);
create table appointment 
(
	id int auto_increment primary key,
	residentid int, 
	staffmemberid int, 
	date date, 
	time time, 
	reason varchar(100), 
	location varchar(100),
	created_at datetime,
   updated_at datetime,
   deleted_at DATETIME,
	foreign key (residentid) references resident(id), 
	foreign key (staffmemberid) references staffmember(id) 
);

create table dose 
( 
	id int auto_increment primary key,
	residentid int, 
	name varchar(50), 
	dosage varchar(50), 
	frequency varchar(50), 
	startdate date, 
	enddate date, 
	prescribedby int, 
	notes varchar(50), 
	created_at datetime,
   updated_at datetime,
   deleted_at DATETIME,
	foreign key (residentid) references resident(id), 
	foreign key (prescribedby) references staffmember(id) 
);

create table careplan 
(
	id int auto_increment primary key,
	residentid int,
	roleid int, 
	caregoals varchar(100), 
	caretreatment varchar(100), 
	notes varchar(200), 
	created_at datetime,
   updated_at datetime,
   deleted_at datetime,
	foreign key (residentid) references resident(id), 
	foreign key (roleid) references role(id) 
);

create table standardtask 
(
	id int auto_increment primary key,
	assignedto int, 
	description varchar(200), 
	duedate date, 
	prioritylevel varchar(20), 
	completedby int, 
	completiondatetime datetime,
	created_at datetime,
   updated_at datetime,
   deleted_at datetime,
	foreign key (assignedto) references staffmember(id), 
	foreign key (completedby) references staffmember(id) 
);

create table emergencyalert 
(
	id int auto_increment primary key,
	residentid int, 
	triggeredbyid int, 
	alerttype varchar(50), 
	alerttimestamp datetime, 
	status varchar(20), 
	resolvedbyid INT,
	created_at datetime,
   updated_at datetime,
   deleted_at datetime, 
	foreign key (residentid) references resident(id), 
	foreign key (triggeredbyid) references staffmember(id), 
	foreign key (resolvedbyid) references staffmember(id)
);

create table dietaryrestriction
(
	id int auto_increment primary key,
	residentid int, 
	foodrestrictions varchar(100), 
	foodpreferences varchar(100), 
	allergies varchar(100), 
	notes varchar(200), 
	lastupdatedby int, 
	created_at datetime,
   updated_at datetime,
   deleted_at datetime,
	foreign key (residentid) references resident(id), 
	foreign key (lastupdatedby) references staffmember(id) 
);

create table diagnosis 
(
	id int auto_increment primary key,
	residentid int,
	diagnosis varchar(100), 
	vitalsigns varchar(100), 
	treatment varchar(200), 
	testresults varchar(200), 
	notes varchar(200), 
	lastupdatedby int, 
	created_at datetime,
   updated_at datetime,
   deleted_at datetime,
	foreign key (residentid) references resident(id), 
	foreign key (lastupdatedby) references staffmember(id)
);

create table schedule
(
	id int auto_increment primary key,
	roleid int, 
	staffmemberid int, 
	shiftdate date, 
	starttime time, 
	endtime time, 
	shifttype varchar(50), 
	created_at datetime,
   updated_at datetime,
   deleted_at datetime,
	foreign key (roleid) references role(id), 
	foreign key (staffmemberid) references staffmember(id)
);

create table stafftask
(
	id int auto_increment primary key,
	staffmemberid int, 
	taskid int, 
	roleintask varchar(100), 
	startdate date, 
	enddate date, 
	created_at datetime,
   updated_at datetime,
   deleted_at datetime,
	foreign key (staffmemberid) references staffmember(id), 
	foreign key (taskid) references standardtask(id)
);
