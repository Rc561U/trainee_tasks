create table authentication
(
    id          int auto_increment
        primary key,
    email       varchar(100)                          not null,
    password    varchar(60)                           not null,
    first_name  varchar(60)                           not null,
    last_name   varchar(60)                           not null,
    crated_date timestamp default current_timestamp() null,
    constraint unique_email
        unique (email)
);

