/*Create database solicitud_isbn;*/

CREATE TABLE c_subsistema (
    id integer not null auto_increment,
    name varchar(100) not null,
    
    CONSTRAINT pk_subsistema
    primary key (id)
);

create table c_entidad(
    id integer not null auto_increment,
    name varchar(100) not null,
    code varchar(10) null,
    subsistema_id integer,    
    constraint fk_entidad_subsistema
    foreign key (subsistema_id)
    references c_subsistema(id),
    constraint pk_entidad
    primary key(id)
);

create table c_estado(
    id integer not null,
    name varchar(50) not null,
    description varchar(100),
    
    constraint pk_estado
    primary key(id)
);

create table libro(
    id integer not null auto_increment,
    title varchar(255) not null,
    subtitle varchar(255) not null,
    isbn varchar(15),
    
    constraint pk_libro
    primary key(id)
);

create table c_categoria(
    id integer not null auto_increment,
    nombre varchar(60) not null,
    constraint pk_categoria
    primary key(id)
);

create table c_subcategoria(
    id integer not null auto_increment,
    nombre varchar(60) not null,
    id_categoria integer not null,
    constraint pk_subcategoria
    primary key(id),
    constraint pk_sc_cat
    foreign key(id_categoria)
    references c_categoria(id)
);

create table solicitud(
    id integer not null auto_increment,
    date_created date not null,
    folio varchar(50) not null,
    entidad_id integer not null,
    libro_id integer not null,
    is_printed numeric(1) default 0,
    is_comercializable numeric(1) default 0,
    has_clasificacion_tematica numeric(1) default 0,
    has_tema numeric(1) default 0,
    has_idioma numeric(1) default 0,
    has_colaboradores numeric(1) default 0,
    has_traduccion numeric(1) default 0,
    has_informacion_edicion numeric(1) default 0,
    has_comercializable numeric(1) default 0,
    has_desc_fisica numeric(1) default 0,
    has_pago numeric(1) default 0,
    has_codigo_barras numeric(1) default 0,
    
    constraint fk_solicitud_entidad
    foreign key(entidad_id)
    references c_entidad(id),
    
    constraint fk_solicitud_libro
    foreign key (libro_id)
    references libro(id),
    
    constraint uq_folio
    UNIQUE(folio),
    
    constraint pk_solicitud
    primary key(id)
);

create table c_tipo_contenido(
    id integer not null auto_increment,
    nombre varchar(255) not null,
    constraint pk_tc
    primary key(id)
);

create table tema(
    id integer not null auto_increment,
    coleccion varchar(100) not null,
    no_coleccion varchar(50)not null,
    nombre_serie varchar(200) not null,
    solicitud_id integer not null,
    tipo_contenido integer not null,
    
    constraint fk_tema_tc
    foreign key (tipo_contenido)
    references c_tipo_contenido(id),
    
    constraint fk_tema_sol
    foreign key(solicitud_id)
    references solicitud(id),
    
    constraint pk_tema
    primary key(id)
);

create table colaboradores(
    id_colab integer not null auto_increment,
    nombre varchar(100) not null,
    tipo char(1) not null,
    solicitud_id integer not null,
    orden numeric(2) not null,
    constraint pk_col
    primary key(id_colab),
    constraint fk_colab_sol
    foreign key(solicitud_id)
    references solicitud(id)
);

create table c_idioma_del(
    id integer not null auto_increment,
    nombre varchar(100) not null,
    constraint pk_idioma_del
    primary key(id)
);

create table ic_dioma_original(
    id integer not null auto_increment,
    nombre varchar(100) not null,
    constraint pk_idioma_original
    primary key(id)
);

create table c_idioma_al(
    id integer not null auto_increment,
    nombre varchar(100) not null,
    constraint pk_idioma_al
    primary key(id)
);

create table traduccion(
    id integer not null auto_increment,
    titulo_original varchar(255) not null,
    idioma_del integer not null,
    idioma_original integer not null,
    idioma_al integer not null,
    solicitud_id integer not null,
    
    constraint pk_traduccion
    primary key(id),
    
    constraint fk_translate_idiomadel
    foreign key(idioma_del)
    references c_idioma_del(id),
    
    constraint fk_translate_idiomaoriginal
    foreign key(idioma_original)
    references ic_dioma_original(id),
    
    constraint fk_translate_idiomaal
    foreign key(idioma_al)
    references c_idioma_al(id),
    
    constraint fk_trad_soli
    foreign key(solicitud_id)
    references solicitud(id)
);

create table c_departamento(
     id integer not null auto_increment,
    nombre varchar(100) not null,
    constraint pk_departamento
    primary key(id)
);

create table c_ciudad(
     id integer not null auto_increment,
    nombre varchar(100) not null,
    constraint pk_ciudad
    primary key(id)
);

create table edicion(
    id integer not null auto_increment,
    solicitud_id integer not null,
    no_edicion integer not null,
    depto_id integer not null,
    fecha_aparicion date not null,
    ciudad_id integer not null,
    coedicion numeric(1) not null default 0,
    coeditor varchar(200) not null,
    constraint pk_editor
    primary key(id),
    
    constraint fk_edicion_sol
    foreign key(solicitud_id)
    references solicitud(id),
    
    constraint fk_edicion_depto
    foreign key(depto_id)
    references c_departamento(id),
    
    constraint fk_edicion_city
    foreign key(ciudad_id)
    references c_ciudad(id)
);

create table comercializable(
    id integer not null auto_increment,
    ejemplares_nacional integer not null,
    precio_local numeric(9,2) not null,
    ejemplares_externa integer not null,
    precio_externo numeric(9,2) not null,
    oferta_total integer not null,
    solicitud_id integer not null,
    constraint pk_comercializable
    primary key(id),
    constraint fk_comersializable_sol
    foreign key(solicitud_id)
    references solicitud(id)
);

create table c_desc_fisica(
    id integer not null,
    nombre varchar(100),
    constraint pk_desc_fisica
    primary key(id)
);

create table c_gramaje(
    id integer not null,
    nombre varchar(100),
    constraint pk_gramaje
    primary key(id)
);

create table c_encuadernacion(
    id integer not null,
    nombre varchar(100),
    constraint pk_encuadernacion
    primary key(id)
);

create table c_tipo_papel(
    id integer not null,
    nombre varchar(100),
    constraint pk_tipo_papel
    primary key(id)
);

create table c_tinta(
    id integer not null,
    nombre varchar(100),
    constraint pk_tintas
    primary key(id)
);

create table c_impresion(
    id integer not null,
    nombre varchar(100),
    constraint pk_impresion
    primary key(id)
);

create table desc_fisica_impresa(
    id integer not null auto_increment,
    solicitud_id integer not null,
    desc_fisica integer not null,
    encuadernacion integer not null,
    tipo_papel integer not null,
    impresion integer not null,
    tinta integer not null,
    gramaje integer not null,
    no_paginas integer not null,
    ancho integer not null,
    alto integer not null,
    
    constraint pk_dfi
    primary key(id),
    
    constraint fk_dfi_sol
    foreign key (solicitud_id)
    references solicitud(id),
    
    constraint fk_dfi_df
    foreign key(desc_fisica)
    references c_desc_fisica(id),

    constraint fk_dfi_enc
    foreign key(encuadernacion)
    references c_encuadernacion(id),
    
    constraint fk_dfi_tp
    foreign key(tipo_papel)
    references c_tipo_papel(id),

    constraint fk_dfi_imp
    foreign key(impresion)
    references c_impresion(id),

    constraint fk_dfi_tint
    foreign key(tinta)
    references c_tinta(id),

    constraint fk_dfi_gram
    foreign key(gramaje)
    references c_gramaje(id)
);

create table c_medio(
    id integer not null,
    nombre varchar(100),
    constraint pk_medio
    primary key(id)
);

create table c_formato(
    id integer not null,
    nombre varchar(100),
    constraint pk_formato
    primary key(id)
);

create table c_tamanio(
    id integer not null,
    nombre varchar(100),
    constraint pk_medio
    primary key(id)
);

create table desc_electronica(
    id integer not null auto_increment,
    solicitud_id integer not null,
    medio integer not null,
    formato integer not null,
    tamanio integer not null,
    constraint pk_de
    primary key(id),
    
    constraint fk_de_sol
    foreign key (solicitud_id)
    references solicitud(id),

    constraint fk_de_medio
    foreign key(medio)
    references c_medio(id),

    constraint fk_de_formato
    foreign key(formato)
    references c_formato(id),

    constraint fk_de_tamanio
    foreign key(tamanio)
    references c_tamanio(id)
);

create table c_barcode_size(
    id integer not null,
    nombre varchar(100),
    constraint pk_barcode_size
    primary key(id)
);

create table c_img_size(
    id integer not null,
    nombre varchar(100),
    constraint pk_img_size
    primary key(id)
);

create table barcode(
    id integer not null auto_increment,
    solicitud_id integer not null,
    solicitar_barcode numeric(1) not null,
    barcode_size integer not null,
    barcode_img integer not null,
    constraint pk_barcode
    primary key(id),

    constraint fk_bc_sol
    foreign key (solicitud_id)
    references solicitud(id),

    constraint fk_bc_bcz
    foreign key(barcode_size)
    references c_barcode_size(id),

    constraint fk_bc_iz
    foreign key(barcode_img)
    references c_img_size(id)
);

create table epay(
    id integer not null auto_increment,
    solicitud_id integer not null,
    pay_hash varchar(255) not null,
    cadena_dependencia varchar(255) not null,
    cadena_referencia varchar(255) not null,
    no_operacion varchar(255) not null,

    constraint pk_epay
    primary key(id),

    constraint fk_ep_sol
    foreign key (solicitud_id)
    references solicitud(id)
);

create table hist_revision_isbn(
    id integer not null auto_increment,
    c_estado_id  integer not null,
    reg_revision datetime DEFAULT CURRENT_TIMESTAMP,
    is_actual boolean default 1,
    constraint pk_hist_revision_isbn
    primary key(id),
    constraint fk_estado_revision
    foreign key(c_estado_id)
    references c_estado(id)
);

create table hist_revision_isbn(
    id integer not null auto_increment,
    c_estado_id  integer not null,
    reg_revision datetime DEFAULT CURRENT_TIMESTAMP,
    is_actual boolean default 1,
    constraint pk_hist_revision_isbn
    primary key(id),
    constraint fk_estado_revision
    foreign key(c_estado_id)
    references c_estado(id)
);