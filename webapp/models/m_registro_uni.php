<?php
if (! defined('BASEPATH')) exit('no se permite el acceso directo al script');

class M_registro_uni extends MY_Model{

	function M_registro_uni(){
		parent::__construct();
	}
	
	
	function getfechaActivo($id_modulo){
		$this->sql="SELECT to_char(fecha_inicio,'DD') as idia, to_char(fecha_inicio,'MM') as imes, to_char(fecha_inicio,'YYYY') as ianio,
						to_char(fecha_inicio,'DD') as fdia, to_char(fecha_inicio,'MM') as fmes, to_char(fecha_inicio,'YYYY') as fanio
						FROM modulos where id_modulo=$id_modulo and activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getDatosUniversitario($matricula){
		$this->sql="select b.am,b.ap,b.nombre,pe.curp, to_char(pe.fecha_nacimiento,'dd/mm/yyyy') as fecha_nac, pe.matricula_asignada as matricula, d.id_entidad, en.estado, pe.edad, pe.id_sexo 

		FROM b_direccion d
		INNER JOIN b_personal pe on d.matricula_asignada=pe.matricula_asignada
		INNER JOIN beneficiarios b on b.matricula_asignada=pe.matricula_asignada
		INNER JOIN cat_entidades en on en.id_entidad= d.id_entidad
		WHERE pe.matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getTarjeta($matricula){
		$this->sql="Select notarjeta From tarjetas_banorte Where matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}

	function inscrito($matricula){
		$this->sql="Select id_archivo From beneficiarios Where matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function getMatricula($curp){
		$this->sql="SELECT matricula_asignada  from b_personal where curp='$curp';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getNoPagosUni($matricula){
		$this->sql="SELECT count(matricula_asignada) as cuenta from dispersion_reportes where matricula_asignada='$matricula' and id_cargo=5;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getInstitucion($id_institucion){
		$this->sql="select id_institucion, institucion, abreviacion from cat_institucion where id_institucion=$id_institucion and activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getDelegacion($id_colonia){
		$this->sql="SELECT id_delegacion, cp from cat_colonia WHERE id_colonia=$id_colonia; ";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getPlantel($id_institucion){
		$this->sql="select id_plantel, plantel from cat_plantel where id_institucion=$id_institucion and activo is true and es_universidad=1;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getGrupoEtnico(){
		$this->sql="select * from cat_grupo_etnico;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getGeneracion(){
		$this->sql="select id_generacion, generacion from cat_generacion where activo is true order by id_generacion desc;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getCarreraUni($id_institucion){
		$this->sql="select id_carrera_uni, carrera from cat_carreras_uni where id_institucion=$id_institucion;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getGradoEscolar($id_institucion){
		$this->sql="select id_grado_uni,grado,periodicidad from cat_grados_uni where id_institucion=$id_institucion and activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getColonias($id_delegacion){
		$this->sql="Select id_colonia,colonia, cp From cat_colonia Where id_delegacion=$id_delegacion Order By id_colonia Asc ;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function DatosReinscripcion($matricula){
		$this->sql="select  pe.id_estado_civil, pe.id_hijos, pe.celular,pe.telefono, pe.am_m,pe.am_p,pe.ap_m,pe.ap_p,pe.email,pe.finado_madre,pe.finado_padre,pe.id_discapacidad,pe.id_grupo_etnico,pe.id_ocupacion, pe.nombre_m,pe.nombre_p,
		d.andador, d.calle,d.departamento,d.ecalle,d.edificio,d.entrada,d.id_colonia,d.id_tiempo_residencia,d.lote,d.manzana,d.noext,d.noint,d.pasillo,d.rampa,d.villa,d.ycalle,
		e.id_carrera,e.id_generacion,e.id_grado, e.id_plantel,e.id_institucion,e.id_turno,e.matricula_escuela,e.num_mat_adeuda,e.promedio,e.id_sistema
		FROM b_direccion d
		INNER JOIN b_escolar e on d.matricula_asignada= e.matricula_asignada
		INNER JOIN b_personal pe on e.matricula_asignada=pe.matricula_asignada
	
		WHERE pe.matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function guardaUniversitario($datos){
	
		$this->db->trans_begin();
		
		//beneficiario
		$this->sql="update beneficiarios set id_generacion_uni=:id_generacion, id_solicitud=:id_solicitud,id_archivo=:id_archivo, id_generacion_ps=:id_generacion,fecha_carga=now(), id_programa=:id_programa
					where matricula_asignada=:matricula;";
		$this->bindParameters($datos);
		$beneficiario = $this->db->query($this->sql);
		
		//b_personal
		$this->sql="update b_personal set ap_p=upper(:apellidoPadreP), am_p=upper(:apellidoPadreM), nombre_p=upper(:nombrePadre), ap_m=upper(:apellidoMadreP), am_m=upper(:apellidoMadreM), nombre_m=upper(:nombreMadre), celular=:celular,telefono=:telefono
				, email=:email, id_archivo=:id_archivo, id_ocupacion=:id_ocupacion, id_estado_civil=:id_estado_civil,id_grupo_etnico=:id_etnia, id_hijos=:id_hijos, finado_padre=:finado_padre, 
				finado_madre=:finado_madre, id_discapacidad=:id_discapacidad,petnica=:petnica 
				where matricula_asignada=:matricula;";
		$this->bindParameters($datos);
		$b_personal = $this->db->query($this->sql);
		
		//b_escolar
		$this->sql="update b_escolar set matricula_escuela_uni=:matricula_escuela, id_institucion_uni=:id_institucion, id_plantel_uni=:id_plantel,id_turno_uni=:id_turno,promedio_uni=:promedio,id_grado_uni=:id_grado
					,id_sistema_uni=:id_sistema,num_mat_adeuda=:materias,id_archivo=:id_archivo,id_carrera_uni=:id_carrera
					where matricula_asignada=:matricula;";
		$this->bindParameters($datos);
		$b_escolar = $this->db->query($this->sql);
		
		//b_direccion
		$this->sql="update b_direccion set calle=upper(:calle),noext=:noext,noint=:noint,ecalle=upper(:ecalle),id_colonia=:id_colonia,id_ut=:id_uts,id_archivo=:id_archivo,upper(ycalle=:ycalle)
								,manzana=:manzana,lote=:lote,edificio=:edificio,rampa=:rampa,andador=:andador,departamento=:departamento,pasillo=:pasillo,villa=:villa,entrada=:entrada,id_tiempo_residencia=:id_tiempo_residencia
								where matricula_asignada=:matricula;";
		$this->bindParameters($datos);
		$b_dir = $this->db->query($this->sql);
		
		if ($beneficiario && $b_personal && $b_escolar && $b_dir)
		{
			$this->db->trans_commit();
			return 'ok';
		}
		else
		{
			$this->db->trans_rollback();
			return false;
		
		}
	
	}
}
