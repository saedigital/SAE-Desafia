create table if not exists shows
(
	id int auto_increment
		primary key,
	name text not null,
	sits int not null,
	date datetime default CURRENT_TIMESTAMP null,
	place text not null,
	reserved_sits int default 0 null
)
comment 'Tabela de espetáculos';

