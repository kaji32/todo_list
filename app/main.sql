create table todos(
id integer  primary key,
isDone BOOL DEFAULT false,
title text
);

insert into todos (title) values ('aaa');
insert into todos (title, isDone) values ('bbb', true);
insert into todos (title) values ('ccc');

select * from todos;