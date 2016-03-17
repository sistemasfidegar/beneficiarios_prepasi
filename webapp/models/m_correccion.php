<?php
if (! defined('BASEPATH')) exit('no se permite el acceso directo al script');

class M_correccion extends MY_Model{

	function M_correccion(){
		parent::__construct();
	}
	
	function getModuloActivo($id_modulo){
		$this->sql="SELECT to_char(fecha_inicio,'DD-MM-YYYY') as inicio, to_char(fecha_fin,'DD-MM-YYYY') as fin FROM modulos where id_modulo=$id_modulo and activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getMatricula($dato){
		$this->sql="SELECT B.matricula_asignada
		FROM beneficiarios B
		INNER JOIN b_personal P on b.matricula_asignada = p.matricula_asignada
		WHERE  P.matricula_asignada ='$dato' OR P.CURP='$dato' and b.id_archivo in (1,2);";
	
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getMatriculaUnam($dato){
		$this->sql="SELECT matricula_asignada FROM  b_escolar 	WHERE matricula_escuela ='$dato' and id_archivo in (1,2) and id_institucion in (1,2);";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function aceptado($matricula){
		/** */
		$this->sql="SELECT aceptado from revision where matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	//TODOS LOS DATOS
	function getDatos($matricula){
		$this->sql="select  b.nombre,b.ap, b.am,pe.id_estado_civil, 
		pe.id_hijos, pe.celular, pe.telefono, pe.am_m,pe.am_p,pe.ap_m,pe.ap_p,pe.email,pe.finado_madre,pe.finado_padre,pe.id_discapacidad,pe.id_grupo_etnico,pe.id_ocupacion, 
		pe.nombre_m,pe.nombre_p,pe.fecha_nacimiento,pe.curp,pe.edad,id_sexo,		
		d.andador, d.calle,d.departamento,d.ecalle,d.edificio,d.entrada,d.id_colonia,d.id_tiempo_residencia,d.lote,d.manzana,d.noext,d.noint,d.pasillo,d.rampa,d.villa,d.ycalle,id_entidad,
		e.id_carrera,e.id_generacion,e.id_grado, e.id_plantel,e.id_institucion,e.id_turno,e.matricula_escuela,e.num_mat_adeuda,e.promedio,e.id_sistema,e.id_generacion
		FROM beneficiarios b
		LEFT JOIN b_direccion d on b.matricula_asignada=d.matricula_asignada
		LEFT JOIN b_escolar e on d.matricula_asignada= e.matricula_asignada
		INNER JOIN b_personal pe on e.matricula_asignada=pe.matricula_asignada
		
		WHERE pe.matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		
		return $results->result_array();
	}
	//por tabla
	function getBeneficiarios($matricula){
		$this->sql="SELECT nombre, ap, am, id_archivo FROM beneficiarios	
		WHERE matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		
		return $results->result_array();
	}
	function getPersonal($matricula){
		$this->sql="SELECT id_hijos, celular, telefono, am_m,am_p,ap_m,ap_p,email,finado_madre,finado_padre,id_discapacidad,id_grupo_etnico,id_ocupacion,nombre_m,nombre_p,
		fecha_nacimiento,curp,id_sexo,id_estado_civil,edad
		FROM b_personal
		WHERE matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getDireccion($matricula){
		$this->sql="SELECT andador,calle,departamento,ecalle,edificio,entrada,id_colonia,id_tiempo_residencia,lote,manzana,noext,noint,pasillo,rampa,villa,ycalle,estado
		FROM b_direccion d
		INNER JOIN cat_entidades e on d.id_entidad=e.id_entidad
		WHERE matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		
		return $results->result_array();
	}
	function getInstitucion(){
		$this->sql="select id_institucion, institucion from cat_institucion where activo is true and es_universidad=0;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getEscolar($matricula){
		$this->sql="SELECT matricula_escuela,plantel,ci.institucion,b.id_institucion,b.id_plantel,id_turno,promedio,id_grado, num_mat_adeuda,id_carrera,id_generacion,id_sistema
				FROM b_escolar b
				INNER JOIN cat_institucion ci on b.id_institucion=ci.id_institucion
				INNER JOIN cat_plantel cp on b.id_plantel=cp.id_plantel
				WHERE matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		
		return $results->result_array();
	}
	
	//***********CATALOGOS
	function getDelegacion($id_colonia){
		$this->sql="SELECT id_delegacion, cp from cat_colonia WHERE id_colonia=$id_colonia; ";
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
	function getPlantel($id_institucion){
		$this->sql="select id_plantel, plantel from cat_plantel where id_institucion=$id_institucion and activo is true ;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getCarreraBach(){
		$this->sql="select id_carrera, carrera from cat_carreras;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getGradoEscolar($id_institucion){
		$this->sql="select id_grado,grado,periodicidad from cat_grados where id_institucion=$id_institucion and activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getColonias($id_delegacion){
		$this->sql="Select id_colonia,colonia, cp From cat_colonia Where id_delegacion=$id_delegacion Order By colonia Asc ;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getUT($id_colonia, $id_cp){
		$this->sql="SELECT id_ut from cat_uts where id_colonia=$id_colonia and cp='$id_cp'; ";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getEntidad(){
		$this->sql="SELECT id_entidad, estado from cat_entidades where activo is true; ";
		$results = $this->db->query($this->sql);
		return $results->result_array();
		
	}
	//update
	function UpdateDatos($datos,$rdir,$resc){
		$this->db->trans_begin();
	
		//beneficiario
		$this->sql="update beneficiarios set id_generacion_ps=:id_generacion,id_usuario_update=:id_usuario_update,fecha_update=now()
					where matricula_asignada=:matricula_ps;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
	
		//b_personal
		$this->sql="update b_personal set ap_p=upper(:apellidoPadreP), am_p=upper(:apellidoPadreM), nombre_p=upper(:nombrePadre), ap_m=upper(:apellidoMadreP), am_m=upper(:apellidoMadreM), nombre_m=upper(:nombreMadre), 
				celular=:celular, email=upper(:email), id_ocupacion=:id_ocupacion, id_estado_civil=:id_estado_civil,id_grupo_etnico=:id_etnia, 
				id_hijos=:id_hijos, finado_padre=:finado_padre, finado_madre=:finado_madre, id_discapacidad=:id_discapacidad,petnica=:petnica
				where matricula_asignada=:matricula_ps;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		if ($resc!=0){
			//b_escolar
			$this->sql="update b_escolar set id_plantel=:id_plantel,id_turno=:id_turno,id_grado=:id_grado,id_sistema=:id_sistema,num_mat_adeuda=:materias,id_carrera=:id_carrera, 
						id_generacion=:id_generacion
						where matricula_asignada=:matricula_ps;";
		}
		else 
			$this->sql="insert into b_escolar (matricula_asignada,matricula_escuela, id_institucion,id_plantel,id_turno,promedio,id_grado,id_sistema,num_mat_adeuda,id_archivo,id_carrera, id_generacion)
									values(:matricula_ps, :matricula_escuela,:id_institucion,:id_plantel,:id_turno,:promedio,:id_grado,:id_sistema,:materias,:id_archivo,:id_carrera, :id_generacion) returning matricula_asignada;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		if($rdir!=0){
		//b_direccion
				$this->sql="update b_direccion set calle=upper(:calle),noext=:noext,noint=:noint,ecalle=upper(:ecalle),id_colonia=:id_colonia,id_ut=:id_uts,ycalle=upper(:ycalle)
					,manzana=:manzana,lote=:lote,edificio=:edificio,rampa=:rampa,andador=:andador,departamento=:departamento,pasillo=:pasillo,villa=:villa,entrada=:entrada,id_tiempo_residencia=:id_tiempo_residencia
					where matricula_asignada=:matricula_ps;";
		}
		else 
			 $this->sql="insert into b_direccion (matricula_asignada,id_entidad,calle,noext,noint,ecalle,id_colonia,id_ut,ycalle,manzana,lote,edificio,rampa,andador,departamento,pasillo,villa,entrada,id_tiempo_residencia)
									values(:matricula_ps,:id_entidad,upper(:calle),:noext,:noint,upper(:ecalle),:id_colonia,:id_uts,upper(:ycalle),:manzana,:lote,:edificio,:rampa,:andador,:departamento,:pasillo,:villa,:entrada,:id_tiempo_residencia) returning matricula_asignada;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		
		//$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE)
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