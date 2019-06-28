create table if not exists booking
(
	id int auto_increment
		primary key,
	username text not null,
	show_id int not null
)
comment 'Reservas de poltronas';

