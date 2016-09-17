Create database solicitud_isbn;

CREATE TABLE subsistema (
    subsistema_id integer not null auto_increment,
    name varchar(100) not null,
    
    CONSTRAINT pk_subsistema
    primary key (subsistema_id)
);

create table entidad(
    entidad_id integer not null auto_increment,
    name varchar(100) not null,
    code varchar(10) null,
    
    constraint pk_entidad
    primary key(entidad_id)
);

create table estado(
    estado_id integer not null,
    name varchar(50) not null,
    description varchar(100),
    
    constraint pk_estado
    primary key(estado_id)
);

create table obra(
    obra_id integer not null auto_increment,
    title varchar(255) not null,
    isbn varchar(15),
    subsistema_id integer,
    
    constraint fk_obra_subsistema
    foreign key (subsistema_id)
    references subsistema(subsistema_id),
    
    constraint pk_libro
    primary key(obra_id)
);

create table solicitud(
    solicitud_id integer not null auto_increment,
    date_created date not null,
    folio varchar(50) not null,
    entidad_id integer not null,
    obra_id integer not null,
    
    constraint fk_solicitud_entidad
    foreign key(entidad_id)
    references entidad(entidad_id),
    
    constraint fk_solicitud_obra
    foreign key (obra_id)
    references obra(obra_id),
    
    constraint uq_folio
    UNIQUE(folio),
    
    constraint pk_solicitud
    primary key(solicitud_id)
);

CREATE TABLE IF NOT EXISTS `estado_solicitud`(
    `estado_solicitud_id` INT NOT NULL,
    `solicitud_id` INT NOT NULL,
    `estado_id` INT NOT NULL,
    `date_changed` TIMESTAMP NOT NULL DEFAULT now(),
    `comment` TEXT NULL,
    CONSTRAINT `fk_estado_solicitud_solicitud` 
    FOREIGN KEY(solicitud_id)
    REFERENCES solicitud(solicitud_id),
    CONSTRAINT `fk_estado_solicitud_estado` 
    FOREIGN KEY(`estado_id` )
    REFERENCES estado(estado_id),
    CONSTRAINT pk_estado_solicitud_id
    PRIMARY KEY (`estado_solicitud_id`))
ENGINE = InnoDB;