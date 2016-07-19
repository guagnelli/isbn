Create database solicitud_isbn;

CREATE TABLE subsistema (
    id integer not null auto_increment,
    name varchar(100) not null,
    
    CONSTRAINT pk_subsistema
    primary key (id)
);

create table entidad(
    id integer not null auto_increment,
    name varchar(100) not null,
    code varchar(10) null,
    subsistema_id integer,
    
    constraint fk_entidad_subsistema
    foreign key (subsistema_id)
    references subsistema(id),
    
    constraint pk_entidad
    primary key(id)
);

create table estado(
    id integer not null,
    name varchar(50) not null,
    description varchar(100),
    
    constraint pk_estado
    primary key(id)
);

create table libro(
    id integer not null auto_increment,
    title varchar(255) not null,
    isbn varchar(15),
    
    constraint pk_libro
    primary key(id)
);

create table solicitud(
    id integer not null auto_increment,
    date_created date not null,
    folio varchar(50) not null,
    entidad_id integer not null,
    libro_id integer not null,
    
    constraint fk_solicitud_entidad
    foreign key(entidad_id)
    references entidad(id),
    
    constraint fk_solicitud_libro
    foreign key (libro_id)
    references libro(id),
    
    constraint uq_folio
    UNIQUE(folio),
    
    constraint pk_solicitud
    primary key(id)
);