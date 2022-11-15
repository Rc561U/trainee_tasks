create table tokens
(
    id int auto_increment primary key,
    user_id      int          not null,
    token        varchar(500) not null,
    created_date datetime default current_timestamp() null,
    expired_date datetime     not null,
    constraint tokens_ibfk_1
    foreign key (user_id) references authentication (id)
    on update cascade on delete cascade
);

