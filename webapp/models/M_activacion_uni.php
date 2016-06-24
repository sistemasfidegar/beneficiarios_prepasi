<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'no se permite el acceso directo al script' );

	class M_activacion_uni extends MY_Model {
		function __construct() {
			parent::__construct ();
		}
		
		/**
		 * M&eacute;todo que obtiene si el m&oacute;dulo de Activaci&oacute;n Uni se encuentra activo o no.
		 *
		 * @param  int:$id_modulo         N&uacute;mero entero que representa el identificador del m&oacute;dulo de Activaci&oacute;n
		 *
		 * @return modulos:inicio,fin     Fecha de inicio y fecha fin del m&oacute;dulo de Activaci&oacute;n. Null en caso contrario.
		 *
		 * @since  2016-06-24
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
		 * Obtiene si la persona a buscar es un beneficiario universitario o no.
		 *
		 * @param  String:$dato                 Dato a buscar (Matr&iacute;cula PS o CURP).
		 *
		 * @return String:matricula_asignada    Matr&iacute;cula asignada. Null en caso contrario.
		 *
		 * @since  2016-06-24
		 * @author Ing. Alfredo Mart&iacute;nez Cobos
		 */
		function getMatriculaUni($dato = "") {
			$results = "";
			
			if(!empty($dato)) {
				$this->sql = "SELECT B.matricula_asignada
				FROM beneficiarios B
				INNER JOIN b_personal P ON B.matricula_asignada = P.matricula_asignada
				WHERE P.matricula_asignada = UPPER('$dato') OR P.CURP = UPPER('$dato') AND B.id_archivo = 3;";
				$results = $this->db->query($this->sql);
				return $results->result_array();
			}
			
			return $results;
		}
		
		/**
		 * Obtiene si la persona a buscar es un beneficiario universitario o no.
		 *
		 * @param  String:$dato                Dato a buscar (matr&iacute;cula escuela UNAM).
		 *
		 * @return String:matricula_asignada   Matr&iacute;cula asignada. Null en caso contrario.
		 *
		 * @since  2016-06-24
		 * @author Ing. Alfredo Mart&iacute;nez Cobos
		 */
		function getMatriculaUnamUni($dato = "") {
			$results = "";
			
			if(!empty($dato)) {
				$this->sql = "SELECT E.matricula_asignada 
				FROM  b_escolar E
				INNER JOIN b_personal P ON E.matricula_asignada = P.matricula_asignada
				WHERE E.matricula_escuela = UPPER('$dato') AND E.id_archivo = 3 AND E.id_institucion = 15;";
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
		 * @since  2016-06-24
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
		 * @param  String:$matricula      Matr&iacute;cula PS a buscar.
		 *
		 * @return List:tarjetas_banorte
		 *
		 * @since  2016-06-24
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
		 * @since  2016-06-24
		 * @author Ing. Alfredo Mart&iacute;nez Cobos
		 */
		function statusEspera() {
			$this->sql = "SELECT MAX(id_statustarjeta) AS status
				FROM cat_statustarjeta
				WHERE id_statustarjeta BETWEEN 300 AND 499;";
			$results = $this->db->query($this->sql);
			return $results->result_array();
		}
	}