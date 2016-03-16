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
	
	
	function getMatricula($dato){
		$this->sql="SELECT B.matricula_asignada
						FROM beneficiarios B
						INNER JOIN b_personal P on b.matricula_asignada = p.matricula_asignada
						WHERE  P.matricula_asignada ='$dato' OR P.CURP='$dato' and b.id_archivo in (1,2,3);";
		
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getMatriculaUnam($dato){
		$this->sql="SELECT matricula_asignada FROM  b_escolar 	WHERE matricula_escuela ='$dato' and id_archivo in (1,2,3) and id_institucion in (1,2,15);";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getIdentificacion($matricula)
	{
		$this->sql = "select matricula_asignada, ap,am,nombre,b.id_archivo, ap_p, am_p,nombre_p,ap_m,am_m,nombre_m, telefono,celular,fecha_nacimiento,
				        edad,id_sexo,email,curp,id_ocupacion,id_estado_civil,id_lugar_nacimiento,to_char(b.fecha_carga, 'yyyy-MM-dd') as fecha 
						from	beneficiarios b
						inner join b_personal p using(matricula_asignada)
						where matricula_asignada = '$matricula';";
				
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getDireccion($matricula)
	{
	
		$this->sql = "select delegacion, cp,colonia, d.*
						from b_direccion d
						INNER JOIN cat_colonia c on c.id_colonia= d.id_colonia
						
						where matricula_asignada =  '$matricula';";
				
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getEscolarBach($matricula)
	{
	
		$this->sql ="SELECT p.plantel, i.institucion, turno,g.grado,descripcion as sistema, matricula_escuela,promedio
					 FROM b_escolar e 
					 INNER JOIN  cat_institucion i ON i.id_institucion=e.id_institucion 
					 INNER JOIN	cat_plantel p ON p.id_plantel=e.id_plantel
					 INNER JOIN  cat_grados g on g.id_grado=e.id_grado
					 LEFT JOIN   cat_turno t on e.id_turno=t.id_turno
					 LEFT JOIN cat_sistema s on s.id_sistema=e.id_sistema
					 WHERE matricula_asignada = '$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	function getEscolarUni($matricula)
	{
	
		$this->sql ="
					SELECT i.institucion as institucion_uni,p.plantel as plantel_uni, gu.grado as grado_uni, descripcion as sistema,
					turno as turno_uni,descripcion as sistema, matricula_escuela,promedio_uni
					FROM b_escolar e 
					INNER JOIN cat_institucion i ON i.id_institucion=e.id_institucion_uni
					INNER JOIN cat_plantel p ON p.id_plantel=e.id_plantel_uni
					INNER JOIN cat_grados g on g.id_grado=e.id_grado_uni
					INNER JOIN cat_grados_uni gu on gu.id_grado_uni=e.id_grado_uni
					INNER JOIN cat_turno t on e.id_turno_uni=t.id_turno
					INNER JOIN cat_sistema s on s.id_sistema=e.id_sistema
					WHERE matricula_asignada = '$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
}