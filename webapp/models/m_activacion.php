<?php
if (! defined('BASEPATH')) exit('no se permite el acceso directo al script');

class M_activacion extends MY_Model{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * M&eacute;todo que obtiene si el m&oacute;dulo de Activaci&oacute;n se encuentra activo o no.
	 * 
	 * @param  int:$id_modulo       N&uacute;mero entero que representa el identificador del modulo de Activaci&oacute;n
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 * 
	 * @return modulos:inicio,fin   Fecha de inicio y fecha fin del m&oacute;dulo de Activaci&oacute;n. Null en caso contrario.   
	 */
	function getModuloActivo($id_modulo){
		$this->sql = "SELECT to_char(fecha_inicio, 'DD-MM-YYYY') as inicio, to_char(fecha_fin, 'DD-MM-YYYY') as fin FROM modulos WHERE id_modulo = $id_modulo AND activo is true;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function getMatricula($dato){
		$this->sql = "SELECT B.matricula_asignada
		FROM beneficiarios B
		INNER JOIN b_personal P on B.matricula_asignada = P.matricula_asignada
		WHERE  P.matricula_asignada ='$dato' OR P.CURP='$dato' and b.id_archivo IN (1,2);";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function revision($matricula) {
		$this->sql = "SELECT R.matricula_asignada, R.id_rechazo, R.aceptado, RE.descripcion 
		FROM revision R
		LEFT JOIN cat_rechazos_revision RE on R.id_rechazo = RE.id_rechazo
		WHERE  R.matricula_asignada = '$matricula' AND R.id_movimiento = 1;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	function tarjetaActiva($matricula) {
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
}