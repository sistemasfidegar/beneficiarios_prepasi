<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Activacion_uni extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper('my_date_helper');
		$this->load->model('m_activacion_uni');
	}
	
	public function index() {
		$datos['title'] = 'Activaci&oacute;n de Tarjeta Universitarios Sí';
		$this->load->view('layout/header', $datos, false);
	
		if ($this->checkModuloActivacionUni()) {
			$this->load->view('activacion_uni/busca_beneficiario', $datos, false);
		} else {
			$datos ['disponible'] = 1;
			$this->load->view('activacion_uni/busca_beneficiario', $datos, false);
		}
	
		$this->load->view('layout/footer', false, false);
	}
	
	public function checkModuloActivacionUni() {
		$id_modulo = 4;
		$hoy = new DateTime(fecha_actual());
	
		// Modulo Activo
		$aux = $this->m_activacion_uni->getModuloActivo($id_modulo);
		$inicio = isset($aux[0]['inicio']) ? new DateTime ($aux[0]['inicio']) : null;
		$fin = isset($aux[0]['fin']) ? new DateTime ($aux[0]['fin']) : null;
	
		if (!is_null($inicio) && !is_null($fin)) {
			if ($hoy >= $inicio && $hoy <= $fin) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function getBeneficiario() {
		if(!empty($this->input->post())){
			$matricula = $this->input->post('matricula');
			$aux = $this->m_activacion_uni->getMatriculaUni($matricula);
				
			$aux = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
				
			if (! is_null($aux)) {
				$revision = $this->m_activacion_uni->revision($aux);
	
				if (!empty($revision)) {
					// verificamos que el beneficiario no tenga rechazos
					if ($revision[0]['id_rechazo'] != 0) {
						echo $revision[0]['descripcion'];
						return;
					}
						
					//verificamos si le expediente del beneficiario se encuentra en revision
					if ($revision[0]['aceptado'] == 0) {
						echo 'revision';
						return;
					}
						
					$tarjeta = $this->m_activacion_uni->tarjeta($revision[0]['matricula_asignada']);
						
					if (!empty($tarjeta)) {
						//verificamos si el beneficiario ya tiene tarjeta activa
						if ($tarjeta[0]['id_statustarjeta'] == 1 || $tarjeta[0]['id_statustarjeta'] == 100) {
							echo 'activa';
							return;
						}
	
						$status = $this->m_activacion_uni->statusEspera();
	
						if ($tarjeta[0]['id_statustarjeta'] == $status[0]['status']) {
							echo 'ok';
						} else {
							echo 'sinregistro';
						}
					}
				} else {
					echo 'sinregistro';
				}
			} else {
				echo 'sinregistro';
			}
		} else {
			header("Location: " . base_url('activacion_uni'));
		}
	}
	
	public function getBeneficiarioUnam() {
		if(!empty($this->input->post())){
			$matricula = $this->input->post('matricula_escuela');
			$aux = $this->m_activacion_uni->getMatriculaUnamUni($matricula);
	
			$aux = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
	
			if (!is_null($aux)) {
				$revision = $this->m_activacion_uni->revision($aux);
	
				if (!empty($revision)) {
					// verificamos que el beneficiario no tenga rechazos
					if ($revision[0]['id_rechazo'] != 0) {
						echo $revision[0]['descripcion'];
						return;
					}
	
					//verificamos si le expediente del beneficiario se encuentra en revision
					if ($revision[0]['aceptado'] == 0) {
						echo 'revision';
						return;
					}
	
					$tarjeta = $this->m_activacion_uni->tarjeta($revision[0]['matricula_asignada']);
	
					if (!empty($tarjeta)) {
						//verificamos si el beneficiario ya tiene tarjeta activa
						if ($tarjeta[0]['id_statustarjeta'] == 1 || $tarjeta[0]['id_statustarjeta'] == 100) {
							echo 'activa';
							return;
						}
	
						$status = $this->m_activacion_uni->statusEspera();
	
						if ($tarjeta[0]['id_statustarjeta'] == $status[0]['status']) {
							echo 'ok';
						} else {
							echo 'sinregistro';
						}
					}
				} else {
					echo 'sinregistro';
				}
			} else {
				echo 'sinregistro';
			}
		} else {
			header("Location: " . base_url('activacion_uni'));
		}
	}
}