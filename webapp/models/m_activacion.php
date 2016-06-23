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
	 * @param  int:$id_modulo         N&uacute;mero entero que representa el identificador del m&oacute;dulo de Activaci&oacute;n
	 *        
	 * @return modulos:inicio,fin     Fecha de inicio y fecha fin del m&oacute;dulo de Activaci&oacute;n. Null en caso contrario.
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function getModuloActivo($id_modulo = "") {
		$results = "";
		
		if(!empty($id_modulo)) {
			$this->sql = "SELECT to_char(fecha_inicio, 'DD-MM-YYYY') AS inicio, to_char(fecha_fin, 'DD-MM-YYYY') AS fin FROM modulos WHERE id_modulo = $id_modulo AND activo IS TRUE;";
			$results = $this->db->query ($this->sql);
			return $results->result_array ();
		}
		
		return $results;
	}
	
	/**
	 * Obtiene si la persona a buscar es un beneficiario o no.
	 * 
	 * @param String:$dato                 Dato a buscar (Matr&iacute;cula PS o CURP).
	 * 
	 * @return String:matricula_asignada   Matr&iacute;cula asignada. Null en caso contrario.
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function getMatricula($dato = "") {
		$results = "";
		
		if(!empty($dato)) {
			$this->sql = "SELECT B.matricula_asignada
			FROM beneficiarios B
			INNER JOIN b_personal P ON B.matricula_asignada = P.matricula_asignada
			WHERE  P.matricula_asignada = UPPER('$dato') OR P.CURP = '$dato' AND B.id_archivo IN (1, 2);";
			$results = $this->db->query ($this->sql);
			return $results->result_array();
		}
		
		return $results;
	}
	
	/**
	 * Obtiene si la persona a buscar es un beneficiario o no.
	 *
	 * @param  String:$dato                Dato a buscar (matr&iacute;cula escuela UNAM).
	 *
	 * @return String:matricula_asignada   Matr&iacute;cula asignada. Null en caso contrario.
	 *
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function getMatriculaUnam($dato = ""){
		$results = "";
	
		if(!empty($dato)) {
			$this->sql = "SELECT E.matricula_asignada
			FROM  b_escolar E
			INNER JOIN b_personal P ON E.matricula_asignada = P.matricula_asignada
			WHERE E.matricula_escuela = UPPER('$dato') AND E.id_archivo IN (1, 2) AND E.id_institucion in (1, 2);";
			$results = $this->db->query($this->sql);
			return $results->result_array();
		}
	
		return $results;
	}
	
	/**
	 * Obtenemos si el beneficiario cuenta con rechazos y tambi&eacute;n si su expediente tiene o no incosistencias.
	 * 
	 * @param  String:$matricula    Matr&iacute;cula PS a buscar.
	 * 
	 * @return List:matricula_asignada, id_rechazo, aceptado, descripcion
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function revision($matricula = "") {
		$results = "";
		
		if(!empty($matricula)) {
			$this->sql = "SELECT R.matricula_asignada, R.id_rechazo, R.aceptado, RE.descripcion 
			FROM revision R
			LEFT JOIN cat_rechazos_revision RE on R.id_rechazo = RE.id_rechazo
			WHERE  R.matricula_asignada = '$matricula' AND R.id_movimiento = 1;";
			$results = $this->db->query ( $this->sql );
			return $results->result_array ();
		}
		
		return $results;
	}
	
	/**
	 * Obtenemos los datos de la Tarjeta Banorte que tiene asignada el beneficiario.
	 * 
	 * @param  String:$matricula     Matr&iacute;cula PS a buscar.
	 * 
	 * @return List:tarjetas_banorte
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function tarjeta($matricula = "") {
		$results = "";
		
		if(!empty($matricula)) {
			$this->sql = "SELECT * 
			FROM tarjetas_banorte 
			WHERE matricula_asignada = '$matricula' 
			ORDER BY fecha_recepcion DESC;";
			$results = $this->db->query($this->sql);
			return $results->result_array();
		}
		
		return $results;
	}
	
	/**
	 * Obtenemos el &uacute;ltimo status de la tarjeta, que es el que contiene las indicaciones del Ciclo de Reactivaci&oacute;n (300-400).
	 * 
	 * @return int:id_statustarjeta
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function statusEspera() {
		$this->sql = "SELECT MAX(id_statustarjeta) AS status 
				FROM cat_statustarjeta 
				WHERE id_statustarjeta BETWEEN 300 AND 499;";
		$results = $this->db->query($this->sql);
		return $results->result_array();
	}
	
	/**
	 * Obtiene los datos personales e institucionales de un Beneficiario.
	 * 
	 * @param  String:$matricula     Matr&iacute;cula PS a buscar.
	 * 
	 * @return List:nombre, ap, am, matricula_asignada, id_archivo, curp, plantel, institucion
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos   
	 */
	function getDatos($matricula = "") {
		$results = "";
		
		if(!empty($matricula)) {
			$this->sql = "SELECT B.nombre, B.ap, B.am, B.matricula_asignada, B.id_archivo, P.curp, PL.plantel, I.institucion
			FROM beneficiarios B, b_escolar E, b_personal P, cat_institucion I, cat_plantel PL
			WHERE B.matricula_asignada = E.matricula_asignada 
			AND B.matricula_asignada = P.matricula_asignada 
			AND E.id_institucion = I.id_institucion
			AND E.id_plantel = PL.id_plantel
			AND B.matricula_asignada ='$matricula';";
			$results = $this->db->query($this->sql);
			return $results->result_array();
		}
		
		return $results;
	}
	
	/**
	 * Verificamos que la tarjeta a activar sea en realidad la que se le ha asignado.
	 * 
	 * @param  String:$post['tarjeta1']        16 digitos de la tarjeta bancaria a verificar.
	 * @param  String:$post['matricula']       Matr&iacute;cula PS del beneficario.
	 * 
	 * @return boolean                         True en caso que la tarjeta sea la correcta. False en caso contrario.
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function checkTarjeta($post = "") {
		if(!empty($post)) {
			$this->db->select('notarjeta');
			$this->db->from('tarjetas_banorte');
			$this->db->where('notarjeta', $post['tarjeta1']);
			$this->db->where('matricula_asignada', $post['matricula']);
			$query = $this->db->get();
			$tarjetasBanorteInstance = $query->row_array();
			$query->free_result();
				
			if (!empty($tarjetasBanorteInstance)) {
				return true;
			} else {
				return false;
			}
		}
		
		return false;
	}
	
	/**
	 * Actualizamos los datos del beneficiario en lo que se refiere a la Activaci&oacute;n de la Tarjeta Bancaria (status, fecha, observaciones e identificador de archivo).
	 * 
	 * @param  String:$post['archivo']    Identificador del tr&aacute;mite (1, inscripci&oacute;n. 2, reinscripci&acute;on).
	 * @param  String:$post['tarjeta1']   16 digitos de la tarjeta bancaria.
	 * @param  String:$post['matricula']  Matr&iacute;cula PS del beneficario. 
	 * @param  int:$status                Nuevo status que va a tener la tarjeta bancaria del beneficiario (Activa).
	 * 
	 * @return boolean                    True en caso de actualizaci&oacute;n correcta. False en caso contrario.
	 * 
	 * @since  2016-06-23
	 * @author Ing. Alfredo Mart&iacute;nez Cobos
	 */
	function update($post = "", $status = "") {
		if(!empty($post) && !empty($status)) {
			$data = array(
					'id_statustarjeta' => $status,
					'fecha_recepcion' => date('Y-m-d'),
					'observaciones' => 'Activación por Sistema 2016-2017',
					'id_archivo' => $post['archivo']
			);
				
			$this->db->where('notarjeta', $post['tarjeta1']);
			$this->db->where('matricula_asignada', $post['matricula']);
				
			if($this->db->update('tarjetas_banorte', $data)) {
				return true;
			} else {
				return false;
			}
		}
		
		return false;
	}
}