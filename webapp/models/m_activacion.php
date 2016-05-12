<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'no se permite el acceso directo al script' );
class M_activacion extends MY_Model {
	function __construct() {
		parent::__construct ();
	}
	
	/**
	 * M&eacute;todo que obtiene si el m&oacute;dulo de Activaci&oacute;n se encuentra activo o no.
	 *
	 * @param
	 *        	int:$id_modulo N&uacute;mero entero que representa el identificador del modulo de Activaci&oacute;n
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 *        
	 * @return modulos:inicio,fin Fecha de inicio y fecha fin del m&oacute;dulo de Activaci&oacute;n. Null en caso contrario.
	 */
	function getModuloActivo($id_modulo) {
		$this->sql = "SELECT to_char(fecha_inicio, 'DD-MM-YYYY') as inicio, to_char(fecha_fin, 'DD-MM-YYYY') as fin FROM modulos WHERE id_modulo = $id_modulo AND activo is true;";
		$results = $this->db->query ( $this->sql );
		return $results->result_array ();
	}
	function getMatricula($dato) {
		$this->sql = "SELECT B.matricula_asignada
		FROM beneficiarios B
		INNER JOIN b_personal P on B.matricula_asignada = P.matricula_asignada
		WHERE  P.matricula_asignada ='$dato' OR P.CURP='$dato' and b.id_archivo IN (1,2);";
		$results = $this->db->query ( $this->sql );
		return $results->result_array ();
	}
	function getMatriculaUnam($dato) {
		$this->sql="select matricula_asignada FROM b_escolar WHERE matricula_escuela='$dato' AND id_archivo IN (1,2) and id_institucion in (1,2);";
		$results = $this->db->query ( $this->sql );
		return $results->result_array ();
	}
	function revision($matricula) {
		$this->sql = "SELECT R.matricula_asignada, R.id_rechazo, R.aceptado, RE.descripcion 
		FROM revision R
		LEFT JOIN cat_rechazos_revision RE on R.id_rechazo = RE.id_rechazo
		WHERE  R.matricula_asignada = '$matricula' AND R.id_movimiento = 1;";
		$results = $this->db->query ( $this->sql );
		return $results->result_array ();
	}
	
	function tarjeta($matricula) {
		$this->sql = "SELECT * 
		FROM tarjetas_banorte 
		WHERE matricula_asignada = '$matricula' 
		ORDER BY fecha_recepcion DESC;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function statusEspera() {
		$this->sql = "SELECT MAX(id_statustarjeta) AS status 
				FROM cat_statustarjeta 
				WHERE id_statustarjeta BETWEEN 300 AND 499;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function getDatos($matricula) {
		$this->sql = "SELECT B.nombre, B.ap, B.am, B.matricula_asignada, P.curp, PL.plantel, I.institucion
		FROM beneficiarios B, b_escolar E, b_personal P, cat_institucion I, cat_plantel PL
		WHERE B.matricula_asignada = E.matricula_asignada 
		AND B.matricula_asignada = P.matricula_asignada 
		AND E.id_institucion = I.id_institucion
		AND E.id_plantel = PL.id_plantel
		AND B.matricula_asignada ='$matricula';";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function update($post, $status) {
		$fecha = date('Y-m-d');
		$observaciones = 'Activación por Sistema 2016-2017';
		$tarjeta = $post['tarjeta1'];
		$matricula = $post['matricula'];
		$this->sql = "UPDATE tarjetas_banorte 
		SET id_statustarjeta = '$status', fecha_recepcion = '$fecha', observaciones = '$observaciones' 
		WHERE notarjeta = '$tarjeta' AND matricula_asignada = '$matricula';";
		$results = $this->db->query($this->sql);
		
		if (!is_null($results)) {
			return true;
		} else {
		
		return false;
		}
	}
	//universitarios
	function getMatriculaUni($dato) {
		$this->sql = "SELECT B.matricula_asignada
		FROM beneficiarios B
		INNER JOIN b_personal P on B.matricula_asignada = P.matricula_asignada
		WHERE  P.matricula_asignada ='$dato' OR P.CURP='$dato' and b.id_archivo=3;";
		$results = $this->db->query ( $this->sql );
		return $results->result_array ();
	}
	function getMatriculaUnamUni($dato) {
		$this->sql="select matricula_asignada FROM b_escolar WHERE matricula_escuela_uni='$dato' AND id_archivo =3 and id_institucion_uni = 15;";
		$results = $this->db->query ( $this->sql );
		return $results->result_array ();
	}
}