/*
Navicat PGSQL Data Transfer

Source Server         : postgres@192.168.50.93
Source Server Version : 90310
Source Host           : localhost:5432
Source Database       : beneficiarios_prepasi
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90310
File Encoding         : 65001

Date: 2016-01-20 20:06:35
*/


-- ----------------------------
-- Table structure for arch_disp
-- ----------------------------
--DROP TABLE IF EXISTS "public"."arch_disp";
CREATE TABLE "public"."arch_disp" (
"folio" numeric(32),
"oficio" varchar(50) COLLATE "default",
"text" varchar(255) COLLATE "default",
"notarjeta" varchar(25) COLLATE "default",
"matricula" varchar(25) COLLATE "default",
"monto" numeric(1000),
"cvrechazo" numeric(20),
"mes_dispersado" varchar(50) COLLATE "default",
"id_cargo" numeric(32),
"fecha_carga" date,
"observaciones" varchar(255) COLLATE "default",
"meses_disp" varchar(100) COLLATE "default",
"archivo" varchar(50) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for arch_log
-- ----------------------------
--DROP TABLE IF EXISTS "public"."arch_log";
CREATE TABLE "public"."arch_log" (
"folio" numeric(32),
"oficio" varchar(50) COLLATE "default",
"fechaenvio" date,
"text" varchar(200) COLLATE "default",
"notarjeta" varchar(25) COLLATE "default",
"matricula" varchar(25) COLLATE "default",
"monto" numeric(100),
"fechapaso" date,
"cvrechazo" numeric(32),
"mes_dispersado" varchar(50) COLLATE "default",
"id_cargo" numeric(32),
"fecha_carga" date,
"observaciones" varchar(255) COLLATE "default",
"meses_disp" varchar(120) COLLATE "default",
"archivo" varchar(50) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for b_direccion
-- ----------------------------
--DROP TABLE IF EXISTS "public"."b_direccion";
CREATE TABLE "public"."b_direccion" (
"matricula_asignada" varchar(60) COLLATE "default",
"calle" varchar(150) COLLATE "default",
"noext" varchar(10) COLLATE "default",
"noint" varchar(10) COLLATE "default",
"ecalle" varchar(150) COLLATE "default",
"id_colonia" numeric(32),
"id_entidad" numeric(32),
"id_ut" numeric(32),
"id_archivo" numeric(32),
"id_usuario" numeric(32),
"ycalle" varchar(150) COLLATE "default",
"manzana" varchar(35) COLLATE "default",
"lote" varchar(35) COLLATE "default",
"edificio" varchar(120) COLLATE "default",
"rampa" varchar(100) COLLATE "default",
"andador" varchar(120) COLLATE "default",
"departamento" varchar(35) COLLATE "default",
"pasillo" varchar(100) COLLATE "default",
"villa" varchar(120) COLLATE "default",
"entrada" varchar(100) COLLATE "default",
"id_tiempo_res" numeric(32),
"colonia_desc" varchar(150) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for b_escolar
-- ----------------------------
--DROP TABLE IF EXISTS "public"."b_escolar";
CREATE TABLE "public"."b_escolar" (
"matricula_asignada" varchar(60) COLLATE "default",
"matricula_escuela" varchar(60) COLLATE "default",
"id_institucion" numeric(32),
"id_plantel" numeric(32),
"id_institucion_uni" numeric(32),
"id_plantel_uni" numeric(32),
"id_turno" numeric(32),
"id_turno_uni" numeric(32),
"promedio" varchar(20) COLLATE "default",
"id_grado" numeric(32),
"id_sistema" numeric(32),
"num_mat_adeuda" numeric(2),
"id_archivo" numeric(32),
"id_usuario" numeric(32),
"matricula_escuela_uni" varchar(40) COLLATE "default",
"matricula_ps" varchar(60) COLLATE "default",
"promedio_uni" varchar(20) COLLATE "default",
"id_grado_uni" numeric(32),
"id_sistema_uni" numeric(32),
"id_area_uni" numeric(32),
"id_carrera" numeric(32),
"id_carrera_uni" numeric(32),
"id_max_estudios" numeric(32),
"id_generacion" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for b_personal
-- ----------------------------
--DROP TABLE IF EXISTS "public"."b_personal";
CREATE TABLE "public"."b_personal" (
"matricula_asignada" varchar(60) COLLATE "default",
"ap_p" varchar(70) COLLATE "default",
"am_p" varchar(70) COLLATE "default",
"nombre_p" varchar(80) COLLATE "default",
"ap_m" varchar(70) COLLATE "default",
"am_m" varchar(70) COLLATE "default",
"nombre_m" varchar(80) COLLATE "default",
"telefono" numeric(50),
"celular" numeric(50),
"fecha_nacimiento" date,
"edad" numeric(2),
"id_sexo" numeric(32),
"email" varchar(180) COLLATE "default",
"curp" varchar(50) COLLATE "default",
"id_archivo" numeric(32),
"id_usuario" numeric(32),
"id_nacionalidad" numeric(32),
"id_ocupacion" numeric(32),
"id_estado_civil" numeric(32),
"id_grupo_etnico" numeric(32),
"petnica" numeric(32),
"id_hijos" numeric(1),
"finado_padre" numeric(1),
"finado_madre" numeric(1),
"id_lugar_nacimiento" numeric(32),
"id_discapacidad" numeric(32),
"correovalidado" numeric(1)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for beneficiarios
-- ----------------------------
--DROP TABLE IF EXISTS "public"."beneficiarios";
CREATE TABLE "public"."beneficiarios" (
"folio" numeric(10),
"matricula_asignada" varchar(60) COLLATE "default",
"ap" varchar(60) COLLATE "default",
"am" varchar(60) COLLATE "default",
"nombre" varchar(100) COLLATE "default",
"id_cargo" numeric(32),
"id_solicitud" numeric(32),
"id_archivo" numeric(32),
"id_generacion_ps" numeric(32),
"id_usuario" numeric(32),
"fecha_carga" date,
"id_programa" numeric(32),
"id_generacion_uni" numeric(32),
"unificacion_de_matricula" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_archivos
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_archivos";
CREATE TABLE "public"."cat_archivos" (
"id_archivo" numeric(32) NOT NULL,
"archivo" varchar(200) COLLATE "default",
"activo" numeric(32),
"descripcion" varchar(255) COLLATE "default",
"fecha_recepcion" date,
"medio" varchar(200) COLLATE "default",
"solicitante" varchar(200) COLLATE "default",
"nombre_archivos" varchar(200) COLLATE "default",
"id_informatica" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_area_rechazo
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_area_rechazo";
CREATE TABLE "public"."cat_area_rechazo" (
"id_area" numeric(32) NOT NULL,
"descripcion" varchar(200) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_area_uni
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_area_uni";
CREATE TABLE "public"."cat_area_uni" (
"id_area_uni" numeric(32),
"id_institucion" numeric(32),
"area" varchar(255) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_calendario
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_calendario";
CREATE TABLE "public"."cat_calendario" (
"id_calendario" numeric(32) NOT NULL,
"tb_abreviacion" varchar(20) COLLATE "default",
"fecha1" date,
"fecha2" date,
"inscritos" numeric(50),
"lugares" numeric(20),
"id_institucion" numeric(32),
"univ" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_cargo
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_cargo";
CREATE TABLE "public"."cat_cargo" (
"id_cargo" numeric(32) NOT NULL,
"cargo" varchar(100) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_carreras
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_carreras";
CREATE TABLE "public"."cat_carreras" (
"id_carrera" numeric(32) NOT NULL,
"carrera" varchar(255) COLLATE "default",
"status" varchar(2) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_carreras_uni
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_carreras_uni";
CREATE TABLE "public"."cat_carreras_uni" (
"id_carrera_uni" numeric(32) NOT NULL,
"id_istitucion" numeric(32),
"id_area" numeric(32),
"carrera" varchar(255) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_categorias
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_categorias";
CREATE TABLE "public"."cat_categorias" (
"id_categoria" numeric(32) NOT NULL,
"categoria" varchar(200) COLLATE "default",
"activo" bool,
"objetivo" varchar(255) COLLATE "default",
"orden" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_codigo_postal
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_codigo_postal";
CREATE TABLE "public"."cat_codigo_postal" (
"id_cp" numeric(32) NOT NULL,
"cp" varchar(10) COLLATE "default",
"id_delegacion" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_colonia
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_colonia";
CREATE TABLE "public"."cat_colonia" (
"id_colonia" numeric(32) NOT NULL,
"colonia" varchar(255) COLLATE "default",
"co" varchar(10) COLLATE "default",
"delegacion" varchar(100) COLLATE "default",
"id_delegacion" numeric(32),
"id_colonia_a" numeric(32),
"id_colonias" numeric(32),
"id_colonia_a2" numeric(32),
"id_colonia_a3" numeric(32),
"id_colonias_2" numeric(32),
"id_colonias_3" numeric(32),
"id_colonia_a4" numeric(32),
"id_colonias_4" numeric(32),
"id_colonias5" numeric(32),
"id_colonias_6" numeric(32),
"id_colonias_7" numeric(32),
"id_colonias_8" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_delegacion
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_delegacion";
CREATE TABLE "public"."cat_delegacion" (
"id_del" numeric(32) NOT NULL,
"delegacion" varchar(100) COLLATE "default",
"orden" numeric(32),
"abreviacion" varchar(10) COLLATE "default",
"id_status" numeric(32),
"id_zona" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_discapacidad
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_discapacidad";
CREATE TABLE "public"."cat_discapacidad" (
"id_discapacidad" numeric(32) NOT NULL,
"discapacidad" varchar(100) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_entidades
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_entidades";
CREATE TABLE "public"."cat_entidades" (
"id_entidad" numeric(32) NOT NULL,
"estado" varchar(100) COLLATE "default",
"activo" bool,
"acronimo" varchar(5) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_estado_civil
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_estado_civil";
CREATE TABLE "public"."cat_estado_civil" (
"id_estado_civil" numeric(32) NOT NULL,
"estado_civil" varchar(30) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_folio_revision
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_folio_revision";
CREATE TABLE "public"."cat_folio_revision" (
"id_folio" numeric(32),
"folio" varchar(10) COLLATE "default",
"id_zona" numeric(32),
"id_del" numeric(32),
"fechaalta" date,
"id_usuario" numeric(32),
"activo" bool,
"id_institucion" numeric(32),
"id_plantel" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_generacion
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_generacion";
CREATE TABLE "public"."cat_generacion" (
"id_generacion" numeric(32),
"generacion" varchar(20) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_grados
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_grados";
CREATE TABLE "public"."cat_grados" (
"id_grado" numeric(32),
"id_institucion" numeric(32),
"grado" varchar(30) COLLATE "default",
"periodicidad" varchar(30) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_grados_uni
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_grados_uni";
CREATE TABLE "public"."cat_grados_uni" (
"id_grado_uni" numeric(32) NOT NULL,
"id_institucion" numeric(32),
"grado" varchar(30) COLLATE "default",
"periodicidad" varchar(30) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_grupo_etnico
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_grupo_etnico";
CREATE TABLE "public"."cat_grupo_etnico" (
"id_grupo_etnico" numeric(32) NOT NULL,
"grupo_etnico" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_hijos
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_hijos";
CREATE TABLE "public"."cat_hijos" (
"id_hijos" numeric(32) NOT NULL,
"hijos" varchar(20) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_institucion
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_institucion";
CREATE TABLE "public"."cat_institucion" (
"id_institucion" numeric(32) NOT NULL,
"institucion" varchar(100) COLLATE "default",
"activo" bool,
"abreviacion" varchar(20) COLLATE "default",
"tb_abreviacion" varchar(20) COLLATE "default",
"es_universidad" numeric(1),
"orden" numeric(3),
"lugares" numeric(5),
"inscritos" numeric(20)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_mov_incidencias
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_mov_incidencias";
CREATE TABLE "public"."cat_mov_incidencias" (
"id_movimiento" numeric(32) NOT NULL,
"descripcion" varchar(200) COLLATE "default",
"incidencia" varchar(15) COLLATE "default",
"apl" varchar(10) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_nacionalidad
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_nacionalidad";
CREATE TABLE "public"."cat_nacionalidad" (
"id_nac" numeric(32) NOT NULL,
"nacionalidad" varchar(100) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_nivel_academico
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_nivel_academico";
CREATE TABLE "public"."cat_nivel_academico" (
"id_nivel" numeric(32) NOT NULL,
"descripcion" varchar(100) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_ocupacion
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_ocupacion";
CREATE TABLE "public"."cat_ocupacion" (
"id_ocupacion" numeric(32) NOT NULL,
"ocupacion" varchar(150) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_perfil
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_perfil";
CREATE TABLE "public"."cat_perfil" (
"id_perfil" numeric(32) NOT NULL,
"descripcion" varchar(100) COLLATE "default",
"estatus" bool,
"privilegios" bool,
"usuarios" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_plantel
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_plantel";
CREATE TABLE "public"."cat_plantel" (
"id_plantel" numeric(32) NOT NULL,
"id_institucion" numeric(32),
"plantel" varchar(200) COLLATE "default",
"activo" bool,
"conse_folio" numeric(32),
"id_categoria" numeric(32),
"direccion" varchar(200) COLLATE "default",
"id_categoria_2008" numeric(32),
"es_universidad" numeric(1),
"id_plantel_institucion" numeric(32),
"id_estado" numeric(32),
"id_delegacion" numeric(32),
"id_colonia" numeric(32),
"id_ut" numeric(32),
"id_zona" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_promedio
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_promedio";
CREATE TABLE "public"."cat_promedio" (
"id_promedio" numeric(32) NOT NULL,
"promedio" varchar(20) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_rechazos_banco
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_rechazos_banco";
CREATE TABLE "public"."cat_rechazos_banco" (
"id_rechazo" numeric(32) NOT NULL,
"rechazo" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_rechazos_revision
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_rechazos_revision";
CREATE TABLE "public"."cat_rechazos_revision" (
"id_rechazo" numeric(32),
"descripcion" varchar(255) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_sexo
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_sexo";
CREATE TABLE "public"."cat_sexo" (
"id_sexo" numeric(32) NOT NULL,
"sexo" varchar(20) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_sistema
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_sistema";
CREATE TABLE "public"."cat_sistema" (
"id_sistema" numeric(32),
"descripcion" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_statustarjeta
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_statustarjeta";
CREATE TABLE "public"."cat_statustarjeta" (
"id_statustarjeta" numeric(32),
"descripcion" varchar(200) COLLATE "default",
"activo" bool,
"id_nivel" numeric(1),
"tipo" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_turno
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_turno";
CREATE TABLE "public"."cat_turno" (
"id_turno" numeric(32) NOT NULL,
"turno" varchar(30) COLLATE "default",
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_unidad_territorial
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_unidad_territorial";
CREATE TABLE "public"."cat_unidad_territorial" (
"id_ut" numeric(32),
"ut" varchar(25) COLLATE "default",
"nombre_unidad" varchar(200) COLLATE "default",
"id_del" numeric(32),
"cp" varchar(10) COLLATE "default",
"colonias" varchar(255) COLLATE "default",
"id_colonia" numeric(32),
"id_colonia_m" numeric(32),
"prioridad" numeric(2),
"prioridad_cp" numeric(2),
"id_colonia_f" numeric(10)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_usuarios
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_usuarios";
CREATE TABLE "public"."cat_usuarios" (
"id_usuario" numeric(32) NOT NULL,
"usuario" varchar(100) COLLATE "default",
"pwd" varchar(100) COLLATE "default",
"ap" varchar(100) COLLATE "default",
"am" varchar(100) COLLATE "default",
"nombres" varchar(100) COLLATE "default",
"id_area" numeric(32),
"tipo" numeric(1),
"email" varchar(200) COLLATE "default",
"status" numeric(1),
"id_perfil" numeric(32),
"activo" bool
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_uts
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_uts";
CREATE TABLE "public"."cat_uts" (
"id_ut" numeric(32) NOT NULL,
"ut" varchar(30) COLLATE "default",
"nombre_unidad" varchar(200) COLLATE "default",
"cp" varchar(10) COLLATE "default",
"colonias" varchar(50) COLLATE "default",
"id_colonias_a" numeric(32),
"id_colonia" numeric(32),
"colonia" varchar(200) COLLATE "default",
"delegacion" varchar(100) COLLATE "default",
"prioridad" numeric(2),
"distrito_local" numeric(3),
"distrito_federal" numeric(3),
"unico" numeric(2),
"id_marg" numeric(2)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_uts_distritos
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_uts_distritos";
CREATE TABLE "public"."cat_uts_distritos" (
"distrito_local" numeric(32),
"distrito_federal" numeric(1),
"id_ut" varchar(30) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for cat_zona
-- ----------------------------
--DROP TABLE IF EXISTS "public"."cat_zona";
CREATE TABLE "public"."cat_zona" (
"id_zona" numeric(32) NOT NULL,
"desc_zona" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dispersion
-- ----------------------------
--DROP TABLE IF EXISTS "public"."dispersion";
CREATE TABLE "public"."dispersion" (
"matricula_asignada" varchar(60) COLLATE "default",
"monto" numeric(100),
"notarjeta" varchar(25) COLLATE "default",
"archivo" varchar(25) COLLATE "default",
"fechaenvio" date,
"fechapaso" date,
"id_oficio" numeric(32),
"mes_dispersado" numeric(10),
"id_institucion" numeric(32),
"id_plantel" numeric(32),
"id_dispersion" numeric(32),
"id_cargo" numeric(32),
"cverechazo" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dispersion_historico
-- ----------------------------
--DROP TABLE IF EXISTS "public"."dispersion_historico";
CREATE TABLE "public"."dispersion_historico" (
"matricula_asignada" numeric(60),
"monto" numeric(150),
"notarjeta" varchar(20) COLLATE "default",
"archivo" varchar(15) COLLATE "default",
"fechaenvio" date,
"fechapaso" date,
"id_oficio" numeric(32),
"mes_dispersado" numeric(10),
"id_institucion" numeric(32),
"id_plantel" numeric(32),
"id_dispersion" numeric(32),
"id_cargo" numeric(32),
"id_rechazo" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for dispersion_reportes
-- ----------------------------
--DROP TABLE IF EXISTS "public"."dispersion_reportes";
CREATE TABLE "public"."dispersion_reportes" (
"matricula_asignada" varchar(60) COLLATE "default",
"monto" numeric(150),
"notarjeta" varchar(20) COLLATE "default",
"archivo" varchar(20) COLLATE "default",
"fechaenvio" date,
"fechapaso" date,
"id_oficio" numeric(32),
"mes_dispersado" numeric(10),
"id_institucion" numeric(32),
"id_plantel" numeric(32),
"id_dispersion" numeric(32),
"id_cargo" numeric(32),
"id_rechazo" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for historico_incidencias
-- ----------------------------
--DROP TABLE IF EXISTS "public"."historico_incidencias";
CREATE TABLE "public"."historico_incidencias" (
"matricula_asignada" varchar(60) COLLATE "default",
"id_movimiento" numeric(10),
"fecha_mov" date,
"id_usuario" numeric(32),
"observacion" varchar(255) COLLATE "default",
"id_historial" numeric(32),
"datos_ant" varchar(255) COLLATE "default",
"datos_nuevos" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for revision
-- ----------------------------
--DROP TABLE IF EXISTS "public"."revision";
CREATE TABLE "public"."revision" (
"matricula_asignada" varchar(60) COLLATE "default",
"id_movimiento" numeric(10),
"id_folio" numeric(32),
"aceptado" numeric(10),
"id_rechazo" numeric(32),
"fecha_carga" date,
"id_usuario" numeric(32),
"id_modifica" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tarjetas_banorte
-- ----------------------------
--DROP TABLE IF EXISTS "public"."tarjetas_banorte";
CREATE TABLE "public"."tarjetas_banorte" (
"consecutivo" numeric(32),
"notarjeta" varchar(30) COLLATE "default",
"matricula_asignada" varchar(60) COLLATE "default",
"id_statustarjeta" numeric(32),
"fecha_recepcion" date,
"observaciones" varchar(200) COLLATE "default",
"id_archivo" numeric(32),
"id_usuario" numeric(32),
"id_accion" numeric(32)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table cat_archivos
-- ----------------------------
ALTER TABLE "public"."cat_archivos" ADD PRIMARY KEY ("id_archivo");

-- ----------------------------
-- Primary Key structure for table cat_area_rechazo
-- ----------------------------
ALTER TABLE "public"."cat_area_rechazo" ADD PRIMARY KEY ("id_area");

-- ----------------------------
-- Primary Key structure for table cat_calendario
-- ----------------------------
ALTER TABLE "public"."cat_calendario" ADD PRIMARY KEY ("id_calendario");

-- ----------------------------
-- Primary Key structure for table cat_cargo
-- ----------------------------
ALTER TABLE "public"."cat_cargo" ADD PRIMARY KEY ("id_cargo");

-- ----------------------------
-- Primary Key structure for table cat_carreras
-- ----------------------------
ALTER TABLE "public"."cat_carreras" ADD PRIMARY KEY ("id_carrera");

-- ----------------------------
-- Primary Key structure for table cat_carreras_uni
-- ----------------------------
ALTER TABLE "public"."cat_carreras_uni" ADD PRIMARY KEY ("id_carrera_uni");

-- ----------------------------
-- Primary Key structure for table cat_categorias
-- ----------------------------
ALTER TABLE "public"."cat_categorias" ADD PRIMARY KEY ("id_categoria");

-- ----------------------------
-- Primary Key structure for table cat_codigo_postal
-- ----------------------------
ALTER TABLE "public"."cat_codigo_postal" ADD PRIMARY KEY ("id_cp");

-- ----------------------------
-- Primary Key structure for table cat_colonia
-- ----------------------------
ALTER TABLE "public"."cat_colonia" ADD PRIMARY KEY ("id_colonia");

-- ----------------------------
-- Primary Key structure for table cat_delegacion
-- ----------------------------
ALTER TABLE "public"."cat_delegacion" ADD PRIMARY KEY ("id_del");

-- ----------------------------
-- Primary Key structure for table cat_discapacidad
-- ----------------------------
ALTER TABLE "public"."cat_discapacidad" ADD PRIMARY KEY ("id_discapacidad");

-- ----------------------------
-- Primary Key structure for table cat_entidades
-- ----------------------------
ALTER TABLE "public"."cat_entidades" ADD PRIMARY KEY ("id_entidad");

-- ----------------------------
-- Primary Key structure for table cat_estado_civil
-- ----------------------------
ALTER TABLE "public"."cat_estado_civil" ADD PRIMARY KEY ("id_estado_civil");

-- ----------------------------
-- Primary Key structure for table cat_grados_uni
-- ----------------------------
ALTER TABLE "public"."cat_grados_uni" ADD PRIMARY KEY ("id_grado_uni");

-- ----------------------------
-- Primary Key structure for table cat_grupo_etnico
-- ----------------------------
ALTER TABLE "public"."cat_grupo_etnico" ADD PRIMARY KEY ("id_grupo_etnico");

-- ----------------------------
-- Primary Key structure for table cat_hijos
-- ----------------------------
ALTER TABLE "public"."cat_hijos" ADD PRIMARY KEY ("id_hijos");

-- ----------------------------
-- Primary Key structure for table cat_institucion
-- ----------------------------
ALTER TABLE "public"."cat_institucion" ADD PRIMARY KEY ("id_institucion");

-- ----------------------------
-- Primary Key structure for table cat_mov_incidencias
-- ----------------------------
ALTER TABLE "public"."cat_mov_incidencias" ADD PRIMARY KEY ("id_movimiento");

-- ----------------------------
-- Primary Key structure for table cat_nacionalidad
-- ----------------------------
ALTER TABLE "public"."cat_nacionalidad" ADD PRIMARY KEY ("id_nac");

-- ----------------------------
-- Primary Key structure for table cat_nivel_academico
-- ----------------------------
ALTER TABLE "public"."cat_nivel_academico" ADD PRIMARY KEY ("id_nivel");

-- ----------------------------
-- Primary Key structure for table cat_ocupacion
-- ----------------------------
ALTER TABLE "public"."cat_ocupacion" ADD PRIMARY KEY ("id_ocupacion");

-- ----------------------------
-- Primary Key structure for table cat_perfil
-- ----------------------------
ALTER TABLE "public"."cat_perfil" ADD PRIMARY KEY ("id_perfil");

-- ----------------------------
-- Primary Key structure for table cat_plantel
-- ----------------------------
ALTER TABLE "public"."cat_plantel" ADD PRIMARY KEY ("id_plantel");

-- ----------------------------
-- Primary Key structure for table cat_promedio
-- ----------------------------
ALTER TABLE "public"."cat_promedio" ADD PRIMARY KEY ("id_promedio");

-- ----------------------------
-- Primary Key structure for table cat_rechazos_banco
-- ----------------------------
ALTER TABLE "public"."cat_rechazos_banco" ADD PRIMARY KEY ("id_rechazo");

-- ----------------------------
-- Primary Key structure for table cat_sexo
-- ----------------------------
ALTER TABLE "public"."cat_sexo" ADD PRIMARY KEY ("id_sexo");

-- ----------------------------
-- Primary Key structure for table cat_turno
-- ----------------------------
ALTER TABLE "public"."cat_turno" ADD PRIMARY KEY ("id_turno");

-- ----------------------------
-- Primary Key structure for table cat_usuarios
-- ----------------------------
ALTER TABLE "public"."cat_usuarios" ADD PRIMARY KEY ("id_usuario");

-- ----------------------------
-- Primary Key structure for table cat_uts
-- ----------------------------
ALTER TABLE "public"."cat_uts" ADD PRIMARY KEY ("id_ut");

-- ----------------------------
-- Primary Key structure for table cat_zona
-- ----------------------------
ALTER TABLE "public"."cat_zona" ADD PRIMARY KEY ("id_zona");
