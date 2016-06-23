
<?php
if (! defined('BASEPATH')) exit('no se permite el acceso directo al script');

class M_registro extends MY_Model{

	function M_registro(){
		parent::__construct();
	}

	function getFechaInscripcion($id_institucion){
		$this->sql="SELECT to_char(fecha1,'DD-MM-YYYY') as inicio, to_char(fecha2,'DD-MM-YYYY') as fin FROM cat_calendario where id_institucion=$id_institucion;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getModuloActivo($id_modulo){
		$this->sql="SELECT to_char(fecha_inicio,'DD-MM-YYYY') as inicio, to_char(fecha_fin,'DD-MM-YYYY') as fin FROM modulos where id_modulo=$id_modulo and activo is true;";
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
	function getInstitucion($id_institucion){
		$this->sql="select id_institucion, institucion, abreviacion from cat_institucion where id_institucion=$id_institucion and activo is true;";
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
	function getNoPagosUni($matricula){
		$this->sql="SELECT count(matricula_asignada) as cuenta from dispersion_reportes where matricula_asignada='$matricula' and id_cargo=5;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getNoPagosBach($matricula){
		$this->sql="SELECT count(matricula_asignada) as cuenta from dispersion_reportes where matricula_asignada='$matricula' and id_cargo=3;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getDatosReinscripcion($matricula){
		$this->sql="select  pe.id_estado_civil, pe.id_hijos, pe.celular, pe.telefono, pe.am_m,pe.am_p,pe.ap_m,pe.ap_p,pe.email,pe.finado_madre,pe.finado_padre,pe.id_discapacidad,pe.id_grupo_etnico,pe.id_ocupacion, pe.nombre_m,pe.nombre_p,
		d.andador, d.calle,d.departamento,d.ecalle,d.edificio,d.entrada,d.id_colonia,d.id_tiempo_residencia,d.lote,d.manzana,d.noext,d.noint,d.pasillo,d.rampa,d.villa,d.ycalle,
		e.id_carrera,e.id_generacion,e.id_grado, e.id_plantel,e.id_institucion,e.id_turno,e.matricula_escuela,e.num_mat_adeuda,e.promedio,e.id_sistema
		FROM b_direccion d
		INNER JOIN b_escolar e on d.matricula_asignada= e.matricula_asignada
		INNER JOIN b_personal pe on e.matricula_asignada=pe.matricula_asignada
		
		WHERE pe.matricula_asignada='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getDelegacion($id_colonia){
		$this->sql="SELECT id_delegacion, cp from cat_colonia WHERE id_colonia=$id_colonia; ";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getConsecutivo(){
		$this->sql="select consecutivo+1 as cons, ciclo from consecutivo_matricula;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function InsertaInscripcion($datos){
		// CONSTRUCCION DE PS
		$consecutivo=$this->getConsecutivo();
		
		$datos['cons']=$consecutivo[0]['cons'];
		$datos['ciclo']=$consecutivo[0]['ciclo'];
		$datos['ps']='PS'.$datos['ciclo'].$datos['escolar'].$datos['cons'];
		
		//inserta sig consecutivo
		$this->sql="update consecutivo_matricula set consecutivo=:cons";
		$this->bindParameters($datos);
		$incrementa = $this->db->query($this->sql);
		
		$this->db->trans_begin();
			
		
		//beneficiario
		$this->sql="insert into beneficiarios (matricula_asignada, ap, am, nombre, id_solicitud,id_archivo, id_generacion_ps,fecha_carga, id_programa) values(:ps,:ap_p,:ap_m,:nombre,:id_solicitud,:id_archivo,:id_generacion,now(),:id_programa) returning matricula_asignada;";
 		$this->bindParameters($datos);
 		$this->db->query($this->sql);
		$beneficiario = $this->db->query($this->sql);
		
	 	//print_r($beneficiario);
		
		//b_personal
		$this->sql="insert into b_personal (matricula_asignada,ap_p, am_p, nombre_p,ap_m, am_m, nombre_m, celular,telefono, fecha_nacimiento, edad, id_sexo, email, curp, id_archivo, id_ocupacion,
										   id_estado_civil,id_grupo_etnico,id_hijos,finado_padre, finado_madre, id_lugar_nacimiento, id_discapacidad,petnica)
 							 		values(:ps,upper(:apellidoPadreP), upper(:apellidoPadreM), upper(:nombrePadre),upper(:apellidoMadreP), upper(:apellidoMadreM), upper(:nombreMadre), :celular,:telefono, :fecha_nac, :edad, :sexo, upper(:email), :curp, :id_archivo, :id_ocupacion,
										   :id_estado_civil,:id_etnia,:id_hijos,:finado_padre, :finado_madre, :lugar_nac, :id_discapacidad, :petnica) returning matricula_asignada;";
			
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		$b_personal = $this->db->query($this->sql);
		
		//b_escolar
		$this->sql="insert into b_escolar (matricula_asignada,matricula_escuela, id_institucion,id_plantel,id_turno,promedio,id_grado,id_sistema,num_mat_adeuda,id_archivo,id_carrera, id_generacion) 
									values(:ps,:matricula_escuela, :id_institucion,:id_plantel,:id_turno,:promedio,:id_grado,:id_sistema,:materias,:id_archivo,:id_carrera, :id_generacion) returning matricula_asignada;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		$b_escolar = $this->db->query($this->sql);
		
		//b_direccion
		$this->sql="insert into b_direccion (matricula_asignada,calle,noext,noint,ecalle,id_colonia,id_entidad,id_ut,id_archivo,ycalle,manzana,lote,edificio,rampa,andador,departamento,pasillo,villa,entrada,id_tiempo_residencia)
									values(:ps,upper(:calle),:noext,:noint,upper(:ecalle),:id_colonia,:lugar_nac,:id_uts,:id_archivo,upper(:ycalle),:manzana,:lote,:edificio,:rampa,:andador,:departamento,:pasillo,:villa,:entrada,:id_tiempo_residencia) returning matricula_asignada;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		$b_dir = $this->db->query($this->sql);

		//if ($beneficiario==1 && $b_personal==1 && $b_escolar==1&& $b_dir==1)
		if($this->db->trans_status() === TRUE){
			$this->db->trans_commit();
			return true;
		} else {
			$this->db->trans_rollback();
			//asignamos el motivo por el cual falló la inscripción
			$motivo = ($beneficiario != 1) ? "Datos incorrectos en la Tabla beneficiarios" : ($b_personal != 1) ? "Datos incorrectos en la Tabla b_personal" : ($b_escolar != 1) ? "Datos incorrectos en la Tabla b_escolar" : ($b_dir != 1) ? "Datos incorrectos en la Tabla b_direccion" : "";
			//insertamos en la tabla log_inscripcion el error producido para tener conocimiento de los consecutivos perdidos y el por qué
			$data = array(
					'matricula_asignada' => $datos['ps'],
					'curp' => $datos['curp'],
					'consecutivo' => $datos['cons'],
					'ciclo' => $datos['ciclo'],
					'motivo' => $motivo,
					'fecha_carga' => date('Y-m-d H:i:s')
			);
			
			$this->db->insert('log_inscripcion', $data);
			return false;
		}
	}
	
	function getUT($id_colonia, $id_cp){
		$this->sql="SELECT id_ut from cat_uts where id_colonia=$id_colonia and cp='$id_cp'; ";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function UpdateInscripcion($datos){
		$this->db->trans_begin();
		
		//beneficiario
		$this->sql="update beneficiarios set id_solicitud=:id_solicitud,id_archivo=:id_archivo, id_generacion_ps=:id_generacion,fecha_carga=now(), id_programa=:id_programa 
					where matricula_asignada=:matricula_ps;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		//$beneficiario = $this->db->query($this->sql);
		
		//b_personal
		$this->sql="update b_personal set ap_p=upper(:apellidoPadreP), am_p=upper(:apellidoPadreM), nombre_p=upper(:nombrePadre), ap_m=upper(:apellidoMadreP), am_m=upper(:apellidoMadreM), nombre_m=upper(:nombreMadre), celular=:celular
				, fecha_nacimiento=:fecha_nac, edad=:edad, id_sexo=:sexo, email=upper(:email), curp=:curp, id_archivo=:id_archivo, id_ocupacion=:id_ocupacion, id_estado_civil=:id_estado_civil,
				id_grupo_etnico=:id_etnia, id_hijos=:id_hijos, finado_padre=:finado_padre, finado_madre=:finado_madre, id_lugar_nacimiento=:lugar_nac, id_discapacidad=:id_discapacidad,petnica=:petnica
				where matricula_asignada=:matricula_ps;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		//$b_personal = $this->db->query($this->sql);
		
		//b_escolar
		$this->sql="update b_escolar set matricula_escuela=:matricula_escuela, id_plantel=:id_plantel,id_turno=:id_turno,promedio=:promedio,id_grado=:id_grado
					,id_sistema=:id_sistema,num_mat_adeuda=:materias,id_archivo=:id_archivo,id_carrera=:id_carrera, id_generacion=:id_generacion
					where matricula_asignada=:matricula_ps;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		//$b_escolar = $this->db->query($this->sql);
		
		//b_direccion
		$this->sql="update b_direccion set calle=upper(:calle),noext=:noext,noint=:noint,ecalle=upper(:ecalle),id_colonia=:id_colonia,id_entidad=:lugar_nac,id_ut=:id_uts,id_archivo=:id_archivo,ycalle=upper(:ycalle)
								,manzana=:manzana,lote=:lote,edificio=:edificio,rampa=:rampa,andador=:andador,departamento=:departamento,pasillo=:pasillo,villa=:villa,entrada=:entrada,id_tiempo_residencia=:id_tiempo_residencia
								where matricula_asignada=:matricula_ps;";
		$this->bindParameters($datos);
		$this->db->query($this->sql);
		//$b_dir = $this->db->query($this->sql);
		
		//if ($beneficiario && $b_personal && $b_escolar && $b_dir)
		if($this->db->trans_status() === TRUE){
			$this->db->trans_commit();
			return 'ok';
		} else {
			$this->db->trans_rollback();
			return false;	
		}
	}
	
	
}
