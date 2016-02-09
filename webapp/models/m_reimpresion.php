<?php
if (! defined('BASEPATH')) exit('no se permite el acceso directo al script');

class M_reimpresion extends MY_Model{

	function M_registro(){
		parent::__construct();
	}
	function getModuloActivo($id_modulo){
		$this->sql="SELECT to_char(fecha_inicio,'DD-MM-YYYY') as inicio, to_char(fecha_fin,'DD-MM-YYYY') as fin FROM modulos where id_modulo=$id_modulo and activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getBeneficiarioCurp($curp){
		$this->sql="select  pe.id_estado_civil, pe.id_hijos, pe.celular, pe.telefono, pe.am_m,pe.am_p,pe.ap_m,pe.ap_p,pe.email,pe.finado_madre,pe.finado_padre,pe.id_discapacidad,pe.id_grupo_etnico,pe.id_ocupacion, pe.nombre_m,pe.nombre_p,
		d.andador, d.calle,d.departamento,d.ecalle,d.edificio,d.entrada,d.id_colonia,d.id_tiempo_residencia,d.lote,d.manzana,d.noext,d.noint,d.pasillo,d.rampa,d.villa,d.ycalle,
		e.id_carrera,e.id_generacion,e.id_grado, e.id_plantel,e.id_institucion,e.id_turno,e.matricula_escuela,e.num_mat_adeuda,e.promedio,e.id_sistema,
		b.ap, b.ap, b.am, b.matricula_asignada
		FROM b_direccion d
		INNER JOIN b_escolar e on d.matricula_asignada= e.matricula_asignada
		INNER JOIN b_personal pe on e.matricula_asignada=pe.matricula_asignada
		INNER JOIN beneficiarios b on b.matricula_asignada=pe.matricula_asignada
		where curp='$curp' and b.id_archivo in (1,2,3);";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getBeneficiarioPS($matricula){
		$this->sql="select  pe.id_estado_civil, pe.id_hijos, pe.celular, pe.telefono, pe.am_m,pe.am_p,pe.ap_m,pe.ap_p,pe.email,pe.finado_madre,pe.finado_padre,pe.id_discapacidad,pe.id_grupo_etnico,pe.id_ocupacion, pe.nombre_m,pe.nombre_p,
		d.andador, d.calle,d.departamento,d.ecalle,d.edificio,d.entrada,d.id_colonia,d.id_tiempo_residencia,d.lote,d.manzana,d.noext,d.noint,d.pasillo,d.rampa,d.villa,d.ycalle,
		e.id_carrera,e.id_generacion,e.id_grado, e.id_plantel,e.id_institucion,e.id_turno,e.matricula_escuela,e.num_mat_adeuda,e.promedio,e.id_sistema,
		b.ap, b.ap, b.am, b.matricula_asignada
		FROM b_direccion d
		INNER JOIN b_escolar e on d.matricula_asignada= e.matricula_asignada
		INNER JOIN b_personal pe on e.matricula_asignada=pe.matricula_asignada
		INNER JOIN beneficiarios b on b.matricula_asignada=pe.matricula_asignada
		where b.matricula_asignada='$matricula' and b.id_archivo in (1,2,3);";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getBeneficiarioNocta($nocta){
		$this->sql="select  pe.id_estado_civil, pe.id_hijos, pe.celular, pe.telefono, pe.am_m,pe.am_p,pe.ap_m,pe.ap_p,pe.email,pe.finado_madre,pe.finado_padre,pe.id_discapacidad,pe.id_grupo_etnico,pe.id_ocupacion, pe.nombre_m,pe.nombre_p,
		d.andador, d.calle,d.departamento,d.ecalle,d.edificio,d.entrada,d.id_colonia,d.id_tiempo_residencia,d.lote,d.manzana,d.noext,d.noint,d.pasillo,d.rampa,d.villa,d.ycalle,
		e.id_carrera,e.id_generacion,e.id_grado, e.id_plantel,e.id_institucion,e.id_turno,e.matricula_escuela,e.num_mat_adeuda,e.promedio,e.id_sistema,
		b.ap, b.ap, b.am, b.matricula_asignada
		FROM b_direccion d
		INNER JOIN b_escolar e on d.matricula_asignada= e.matricula_asignada
		INNER JOIN b_personal pe on e.matricula_asignada=pe.matricula_asignada
		INNER JOIN beneficiarios b on b.matricula_asignada=pe.matricula_asignada
		where e.matricula_escuela='$nocta' and b.id_archivo in (1,2,3);";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
}