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

---LEAS estado de validacion rvisión de la correción de la solicitud 
insert into c_estado (id, name) value (7, 'Revisión de corrección de la solicitud');
---Mr. Guag
insert into c_ciudad (nombre) values('México');
insert into c_ciudad (nombre) values('Roma');
insert into c_ciudad (nombre) values('Grecia');

insert into c_departamento (nombre) values('depto 1');
insert into c_departamento (nombre) values('depto 2');
insert into c_departamento (nombre) values('depto 3');

update seccion_solicitud set  tbl_seccion='desc_fisica', nom_seccion = 'Descripción física', cve_seccion='df' where id = 7;
delete from seccion_solicitud where id = 8;
UPdate seccion_solicitud set id = 8 where id = 9;
UPdate seccion_solicitud set id = 9 where id = 10;
update seccion_solicitud set srt_seccion = id, estado = 1;
update seccion_solicitud set estado=0 where id=7;


--- Modifica la entidad "sse_result_evaluacion" del esquema de encuestas -- Ejecución LEAS
CREATE TABLE encuestas.sse_result_evaluacion_encuesta_curso (
	evaluacion_resul_cve int8 NOT NULL DEFAULT nextval('encuestas.sse_result_evaluacion_evaluacion_resul_cve_seq'::regclass),
	encuesta_cve int4 NOT NULL,
	course_cve int4 NOT NULL,
	group_id int4 NOT NULL,
	evaluado_user_cve int4 NOT NULL,
	evaluador_user_cve int4 NOT NULL,
	total_puntua_si int4 NOT NULL DEFAULT 0,
	total_nos int4 NOT NULL DEFAULT 0,
	total_no_puntua_napv int4 NOT NULL DEFAULT 0,
	total_reactivos_bono int4 NOT NULL DEFAULT 0,
	base int4 NOT NULL DEFAULT 0,
	calif_emitida numeric(6,3) NOT NULL DEFAULT 0,
	CONSTRAINT sse_result_evaluacion_encuesta_cursopkey PRIMARY KEY (evaluacion_resul_cve)
)
WITH (
	OIDS=FALSE
);

ALTER SEQUENCE encuestas.sse_indicador RESTART WITH 1; --reinicia contador de "encuestas.sse_indicador"

alter table encuestas.sse_preguntas add
  CONSTRAINT fkpre_indicador
  FOREIGN KEY (tipo_indicador_cve) 
  REFERENCES  encuestas.sse_indicador(indicador_cve);


---25/01/17
create table files(
	id integer not null auto_increment,
	nombre varchar(255) not null,
	nombre_fisico varchar(255) not null,
	solicitud_id integer not null,
	constraint pk_files
	primary key(id),
	constraint fk_file_solicitud
	foreign key(solicitud_id)
	references solicitud(id) 
);

alter table colaboradores 
add column nacionalidad int not null default 1,
add constraint fk_colab_nac
foreign key (nacionalidad)
references c_idioma(id);

alter table desc_fisica_impresa 
add constraint uq_solicitud
unique (solicitud_id);

alter table desc_electronica
add constraint uq_solicitud
unique (solicitud_id);

alter table desc_fisica_impresa add column 
num_tintas int not null default 1;

create table c_num_tintas(
	id int auto_increment,
	value varchar(100) not null,
	primary key(id)
);

alter table desc_fisica_impresa
add constraint fk_dfi_nt
foreign key(num_tintas)
references c_num_tintas(id);

alter table desc_electronica
add column tamanio_desc varchar(200);

create table c_nacionalidad(
	id integer not null auto_increment,
	nombre varchar(255) not null,
	constraint pk_nacionalidad
	primary key(id)
);
INSERT into c_nacionalidad(nombre) values
('Alemania'),
('Argelia'),
('Argentina'),
('Armenia'),
('Australia'),
('Austria'),
('Bélgica'),
('Bolivia'),
('Brasil'),
('Bulgaria'),
('Camerún'),
('Canadá'),
('Chile'),
('China'),
('Colombia'),
('Congo'),
('Costa Rica'),
('Cuba'),
('Desconocida'),
('Dinamarca'),
('Ecuador'),
('Egipto'),
('El Salvador'),
('Emiratos Árabes Unidos'),
('Eslovenia'),
('España'),
('Estados Unidos'),
('Etiopia'),
('Federación Rusa'),
('Filipinas'),
('Finlandia'),
('Francia'),
('Ghana'),
('Grecia'),
('Guatemala'),
('Guyana'),
('Haití'),
('Holanda'),
('Honduras'),
('Hungría'),
('India'),
('Irak'),
('Irán'),
('Irlanda'),
('Israel'),
('Italia'),
('Jamaica'),
('Japón'),
('Jordania'),
('Kenia'),
('Líbano'),
('Libia'),
('Lituania'),
('Macedonia'),
('Malasia'),
('Marruecos'),
('México'),
('Mozambique'),
('Myanmar'),
('Nicaragua'),
('Nigeria'),
('Noruega'),
('Nueva Zelanda'),
('Panamá'),
('Paraguay'),
('Perú'),
('Polonia'),
('Portugal'),
('Puerto Rico'),
('Reino Unido'),
('República Checa'),
('República De Corea'),
('República Dominicana'),
('Rumania'),
('Senegal'),
('Serbia'),
('Singapur'),
('Sudán'),
('Suecia'),
('Suiza'),
('Sur África'),
('Tailandia'),
('Tanzania'),
('Trinidad Y Tobago'),
('Turquía'),
('Ucrania'),
('Uruguay'),
('Vaticano'),
('Venezuela'),
('Vietnam');

create table c_tipo_colab(
	id integer not null auto_increment,
	nombre varchar(255) not null,
	constraint pk_tipo_colab
	primary key(id)
);
insert into c_tipo_colab(nombre) values
('Autor'),
('Adaptador'),
('Compilador'),
('Director del Libro'),
('Fotógrafo'),
('Ilustrador'),
('Editor Literario'),
('Traductor'),
('Coordinador'),
('Prologuista'),
('Director de la Colección'),
('Recopilador'),
('Director de la obra');

alter table colaboradores drop column tipo;
alter table colaboradores add column tipo integer default 0;
update colaboradores set tipo = 1;
alter table colaboradores add 
constraint pk_tc_unico
	unique(nombre,solicitud_id,nacionalidad, tipo);
alter table colaboradores add column seudonimo varchar(100);
alter table colaboradores add column email varchar(255);

alter table files add column file_type varchar(2) default 'o';
alter table files add column description text;

--Leas 12/03/2017 agregar archivo estado y agregar nuevo estado
ALTER TABLE hist_revision_isbn ADD id_file INT(11) NULL;
CREATE INDEX XIF15FILE_ESTADO_SOLICITUD ON hist_revision_isbn (id_file);  /* Se vuelve index el campo */
ALTER TABLE hist_revision_isbn ADD CONSTRAINT file_id_fk 
FOREIGN KEY (id_file) REFERENCES files(id) ON DELETE RESTRICT ON UPDATE RESTRICT;  /* Asigna llave foranía*/

--14-03-2017
insert into c_estado (id, name) values (8, 'Comprobar');
insert into c_estado (id, name) values (9, 'Comprobado');

alter table colaboradores add 
column paterno varchar(100);
alter table colaboradores add
column materno varchar(100);

ALTER TABLE seccion_solicitud ADD validar_datos_obligatorios boolean default 1; /*Agrega bandera que indica que la seccion es obligatoria */
update seccion_solicitud set validar_datos_obligatorios = 0 where cve_seccion = 'df';  /* No existe la tabla "_descripcion_fisica" validar tabla */

Alter table edicion add column radicado varchar(100);	

delete from seccion_solicitud where id in (8,10);

alter table desc_electronica add column url varchar(255);


-----22/marzo/2017

INSERT INTO isbn.c_entidad
(name, code, subsistema_id)
VALUES('Dirección General de Publicaciones y Fomento Editorial', 'DGPE', 2);

INSERT INTO usuario
(usuario_cve, usu_nick, usu_nombre, usu_paterno, usu_materno, usu_correo, usu_contrasenia, usu_estado, rol_cve, usu_fch_registro, entidad_id)
VALUES(5, 'DGPFE', 'Dirección General de Publicaciones y Fomento Editorial ', ' ', ' ', 'gchavezs@unam.mx
', 'affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686', 1, 4, NULL, 155);

update usuario set usu_correo = 'guillermochavezs@gmail.com' where usuario_cve=3;

--limpiar tablas
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE tema;
TRUNCATE sol_idioma; 
TRUNCATE colaboradores;
TRUNCATE traduccion;
TRUNCATE edicion; 
TRUNCATE comercializable; 
TRUNCATE epay; 
TRUNCATE desc_electronica; 
TRUNCATE desc_fisica_impresa; 
TRUNCATE files; 

TRUNCATE hist_revision_isbn; 
TRUNCATE observaciones_seccion_solicitud; 

TRUNCATE solicitud; 
TRUNCATE libro;  
SET FOREIGN_KEY_CHECKS = 1;

/*Importantes para asignar mensajes leas 22032017 00:48*/
insert into seccion_solicitud (id, nom_seccion, srt_seccion, cve_seccion,tbl_seccion, referencia, estado, validar_datos_obligatorios)
values (12, 'Titulo del libro', 12, 'tl', 'libro', 'solicitud_id',0,0),
(11, 'Archivos', 11, 'fl', 'files', 'solicitud_id',0,0),
(13, 'Clasificación tematica', 13, 'ct', 'ctema', 'solicitud_id',0,0);


alter table colaboradores drop foreign key fk_colab_nac;
alter table colaboradores add constraint fk_colab_nac 
foreign key (nacionalidad) references c_nacionalidad(id);

alter table solicitud add column folio_coleccion varchar(50);

--mayo 29
update  seccion_solicitud set validar_datos_obligatorios = 0 where id=4;
alter table libro add column resenia text null;

--19 de junio de 2017
insert into c_estado (id, name) values (8, 'Comprobado');
alter table tema add constraint uq_solicitud unique(solicitud_id);

alter table comercializable add column has_price varchar(5);

alter table solicitud add column isbn_coleccion varchar(18);
alter table solicitud add column titulo_coleccion varchar(255);

--abril 2018
alter table observaciones_seccion_solicitud add column rol integer;
alter table observaciones_seccion_solicitud add column nombre varchar(200);
update observaciones_seccion_solicitud set rol = 3 where rol is null;
update observaciones_seccion_solicitud set nombre = 'Dirección General de Asuntos Jurídicos' where rol = 3;
alter table libro add column folio_indautor varchar(50) null;
---junio2018
ALTER TABLE colaboradores DROP INDEX pk_tc_unico;