------25/10/2016
aLTER TABLE libro MODIFY COLUMN subtitle varchar(255) NULL;

--datos de secciones
alter table seccion_solicitud add column 
	cve_seccion varchar(5) not null;
alter table seccion_solicitud add column 
	tbl_seccion varchar(200) not null;
alter table seccion_solicitud add column 
	srt_seccion numeric(2) not null;

alter table solicitud add column 
	id_subcategoria integer not null;
alter table solicitud add 
constraint fk_solicitud_subcat
foreign key(id_subcategoria)
references c_subcategoria(id);
alter table solicitud drop column has_clasificacion_tematica;

create table c_idioma(
	id integer not null auto_increment,
	nombre varchar(100) not null,
	constraint pk_idioma
	primary key(id)
);

create table sol_idioma(
	id integer not null auto_increment,
	idioma integer not null,
	solicitud integer not null,

	constraint fk_sol_idioma_idioma
	foreign key(idioma)
	references c_idioma(id),

	constraint fk_sol_idioma_solicitud
	foreign key (solicitud)
	references solicitud(id),

	constraint pk_sol_idioma
	primary key(id),

	constraint uq_solicitud_idioma
	unique(solicitud,idioma)
);

insert into seccion_solicitud 
	(nom_seccion, cve_seccion,tbl_seccion,srt_seccion) 
values 
	('Tema','t','tema',1),
	('Idioma','lng','sol_idioma',2),
	('Colaboradores','colab','colaboradores',3),
	('Traduccion','trns','traduccion',4),
	('Información de edición','ed','edicion',5),
	('Comercialización','cmrc','comercializable',6),
	('Descripción física electrónica','dfe','desc_electronica',7),
	('Descripción física impresa','dfi','desc_fisica_impresa',7),
	('Pago electrónico','epay','epay',8),
	('Código de barras','bc','barcode',10);
----30/10/2016

alter table solicitud add column sol_tipo_obra char(1);
alter table solicitud add constraint ck_tipo_obra check(sol_tipo_obra in('I','C','V'));