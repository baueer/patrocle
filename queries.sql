create table users (
    id int unique auto_increment not null,
    email varchar(256) unique not null,
    password varchar(1024) not null,
    active int default 1,
    date_added timestamp not null default current_timestamp,
    admin int default 0,
    primary key(id)
);
-- conturi admin - teste
insert into users (email, password, admin) values ('test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1); -- 1234
insert into users (email, password, admin) values ('admin@yahoo.ro', 'd93591bdf7860e1e4ee2fca799911215', 1); -- 4321
insert into users (email, password, admin) values ('moise@patrocle.me', '7813d1590d28a7dd372ad54b5d29d033', 1); -- 6969

-- conturi users - teste
insert into users (email, password) values ('ionungureanu@patrocle.me', 'a204c482c5b3188f83337b55cb194edf'); -- ionel
insert into users (email, password) values ('ctinpanturescu@patrocle.me', 'c8d56be998c94089ea6e1147dc9253c1'); -- president

create table login_attempt_logs (
    id int unique auto_increment not null,
    email varchar(256) not null,
    ts timestamp not null default current_timestamp,
    ip varchar(256) not null,
    loc varchar(512) not null,
    coords varchar(128) not null,
    postal_code varchar(16) not null,
    primary key(id)
);
create table login_logs (
    id int unique auto_increment not null,
    email varchar(256) not null,
    uid int not null,
    action int not null,
    ts timestamp not null default current_timestamp,
    ip varchar(256) not null,
    loc varchar(128) not null,
    primary key(id)
);


create table user_data (
    id int unique auto_increment not null,
    email varchar(256) not null,
    uid int,
    display_name varchar(256) not null,
    active int default 1, 
    company int not null default 0,
    title varchar(256),
    department int not null default 0,
    team int not null default 0,
    rfid_tag varchar(64) default null,
    last_seen timestamp null default null,
    date_added timestamp not null default current_timestamp,
    primary key(id)
);
insert into user_data (email, uid, display_name, company, title) values ('test@gmail.com', 1, 'Vasilica Gigica', 1, 'Chief Executive Officer');
insert into user_data (email, uid, display_name, company, title) values ('ionungureanu@patrocle.me', 14, 'Ion Ungureanu', 1, 'El professore');
insert into user_data (email, uid, display_name, company, title) values ('ctinpanturescu@patrocle.me', 15, 'Constantin Panturescu', 1, 'Milogus Sapiens');

create table companies (
    id int unique auto_increment not null,
    name varchar(256) not null,
    active int default 1,
    date_added timestamp not null default current_timestamp,
    primary key(id)
);
insert into companies (name) value ('Primaria Curtea de Arges');

create table teams (
    id int unique auto_increment not null,
    company int not null default 0,
    department int not null default 0,
    display_name varchar(256) not null,
    active int default 1,
    date_added timestamp not null default current_timestamp,
    primary key(id)
);
insert into teams (company, department, display_name) values (1, 1, 'Retelistica');

create table departments (
    id int unique auto_increment not null,
    company int not null default 0,
    display_name varchar(256) not null,
    active int default 1,
    date_added timestamp not null default current_timestamp,
    primary key(id)
);
insert into departments (company, display_name) values (1, 'TESA');