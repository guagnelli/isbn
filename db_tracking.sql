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

ALTER TABLE solicitud modify date_created datetime DEFAULT current_timestamp


-----31/10/2016
ALTER TABLE usuario ADD entidad_id int(11) NULL;

------01/11/2016
insert into c_tipo_contenido(nombre)values('Periodística'),('Cuento');
insert into c_idioma (nombre) values('Español'),('Inglés'),('Italiano');

-----01112018 LEAS 
ALTER TABLE observaciones_seccion_solicitud ADD comentarios text NULL;
ALTER TABLE observaciones_seccion_solicitud ADD fecha_comment datetime default current_timestamp;;

-----03112016
alter table seccion_solicitud add column referencia varchar(50) not null ;
update seccion_solicitud set referencia = 'solicitud_id';
alter table traduccion drop foreign key fk_translate_idiomaal;
alter table traduccion drop foreign key fk_translate_idiomadel;
alter table traduccion drop foreign key fk_translate_idiomaoriginal;

alter table traduccion add
  CONSTRAINT `fk_translate_idiomaal` 
  FOREIGN KEY (`idioma_al`) 
  REFERENCES `c_idioma` (`id`);

alter table traduccion add
  CONSTRAINT `fk_translate_idiomadel` 
  FOREIGN KEY (`idioma_del`) 
  REFERENCES `c_idioma` (`id`);

alter table traduccion add
  CONSTRAINT `fk_translate_idiomaoriginal` 
  FOREIGN KEY (`idioma_original`) 
  REFERENCES `c_idioma` (`id`);

insert into c_entidad(name,code,subsistema_id)values('Facultad de Medicina','FM','1');

insert into usuario (usu_nick,usu_nombre, usu_paterno,
		usu_materno,usu_correo,entidad_id,rol_cve,usu_contrasenia) 
	values('medicina','Facultad de Medicina','unam',''
		  ,'medicina@unam.mx',4,4,
'affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686');

alter table colaboradores drop column orden;

alter table seccion_solicitud add column estado numeric(1) default 1;

---Leas estado de validacion rvisión de la correción de la solicitud 
insert into c_estado (id, name) value (7, 'Revisión de corrección de la solicitud');
