create table black_list
(
    id  int auto_increment primary key,
    ip  varchar(120) not null,
    created_date datetime default current_timestamp() null,
    expired_date datetime not null
);

