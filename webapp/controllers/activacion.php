<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Activacion extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'my_date_helper' );
		$this->load->model ( 'm_activacion' );
	}
	
	public function index() {
		$id_modulo = 2;
		$datos['title'] = 'Activaci&oacute;n de Tarjeta';
		$hoy = new DateTime(fecha_actual());
		
		// Modulo Activo
		$aux = $this->m_activacion->getModuloActivo ( $id_modulo );
		$inicio = isset ( $aux [0] ['inicio'] ) ? new DateTime ( $aux [0] ['inicio'] ) : null;
		$fin = isset ( $aux [0] ['fin'] ) ? new DateTime ( $aux [0] ['fin'] ) : null;
		
		$this->load->view ( 'layout/header', $datos, false );
		
		if (! is_null ( $inicio ) && ! is_null ( $fin )) {
			if ($hoy >= $inicio && $hoy <= $fin) {
				$this->load->view ( 'activacion/busca_beneficiario', $datos, false );
			} else {
				$datos ['disponible'] = 1;
				$this->load->view ( 'activacion/noDisponible', $datos, false );
			}
		} else {
			$datos ['disponible'] = 1;
			$this->load->view ( 'activacion/noDisponible', $datos, false );
		}
		
		$this->load->view ( 'layout/footer', false, false );
	}
	
	function getBeneficiario() {
		$matricula = $this->input->post('matricula');
		$aux = $this->m_activacion->getMatricula($matricula);
		
		$aux = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
		
		if (! is_null($aux)) {
			$revision = $this->m_activacion->revision ($aux);
			
			if (!empty($revision)) {
				// verificamos que el beneficiario no tenga rechazos
				if ($revision[0]['id_rechazo'] != 0) {
					echo $revision[0]['descripcion'];
				}
				
				//verificamos si le expediente del beneficiario se encuentra en revision
				if ($revision[0]['aceptado'] == 0) {
					echo 'revision';
				}
				
				$tarjeta = $this->m_activacion->tarjeta($revision[0]['matricula_asignada']);
				
				if (!empty($tarjeta)) {
					if (($tarjeta[0]['id_statustarjeta'] == 1 || $tarjeta[0]['id_statustarjeta'] == 100) && ($tarjeta[0]['id_archivo'] == 1 || $tarjeta[0]['id_archivo'] == 2)) {
						echo 'activa';
					}
					
					$status = $this->m_activacion->statusEspera();
					
					if (($tarjeta[0]['id_archivo'] == 1 || $tarjeta[0]['id_archivo'] == 2) && ($tarjeta[0]['id_statustarjeta'] == $status[0]['status'])) {
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
	}
	function getBeneficiarioUnam()
	{
		$matricula = $this->input->post('matricula_escuela');
		$aux = $this->m_activacion->getMatriculaUnam($matricula);
		$matricula = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
		
		if (! is_null($matricula)) {
			
			$revision = $this->m_activacion->revision ($matricula);
				
			if (!empty($revision)) {
				// verificamos que el beneficiario no tenga rechazos
				if ($revision[0]['id_rechazo'] != 0) {
					echo $revision[0]['descripcion'];
				}
			
				//verificamos si le expediente del beneficiario se encuentra en revision
				if ($revision[0]['aceptado'] == 0) {
					echo 'revision';
				}
			
				$tarjeta = $this->m_activacion->tarjeta($revision[0]['matricula_asignada']);
			
				if (!empty($tarjeta)) {
					if (($tarjeta[0]['id_statustarjeta'] == 1 || $tarjeta[0]['id_statustarjeta'] == 100) && ($tarjeta[0]['id_archivo'] == 1 || $tarjeta[0]['id_archivo'] == 2)) {
						echo 'activa';
					}
						
					$status = $this->m_activacion->statusEspera();
						
					if (($tarjeta[0]['id_archivo'] == 1 || $tarjeta[0]['id_archivo'] == 2) && ($tarjeta[0]['id_statustarjeta'] == $status[0]['status'])) {
						echo 'ok';
					} else {
						echo 'sinregistro';
					}
				}
			} else
			{
				echo 'sinregistro';
			}
		}
		else
		{
			echo 'sinregistro';
		}	
	}
	
	function buscaBeneficiario($matricula) {
		$datos['title'] = 'Activaci&oacute;n de Tarjeta';
		$aux = $this->m_activacion->getMatricula($matricula);
		
		$matricula = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
		
		$this->load->view('layout/header', $datos, false);
		
		if(!is_null($matricula)) {
			$beneficiario = $this->m_activacion->getDatos($matricula);
			
			if(!empty($beneficiario)) {
				$datos['beneficiario'] = $beneficiario[0];
				$this->load->view('activacion/activacion', $datos, false);
			} else {
				$this->load->view('activacion/activacion', false, false);
			}
		} else {
			$this->load->view('activacion/activacion', false, false);
		}
		
		$this->load->view('layout/footer', false, false);
	}
	function buscaBeneficiarioUnam($matricula) {
		$datos['title'] = 'Activaci&oacute;n de Tarjeta';
		$aux = $this->m_activacion->getMatriculaUnam($matricula);
	
		$matricula = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
	
		$this->load->view('layout/header', $datos, false);
	
		if(!is_null($matricula)) {
			$beneficiario = $this->m_activacion->getDatos($matricula);
				
			if(!empty($beneficiario)) {
				$datos['beneficiario'] = $beneficiario[0];
				$this->load->view('activacion/activacion', $datos, false);
			} else {
				$this->load->view('activacion/activacion', false, false);
			}
		} else {
			$this->load->view('activacion/activacion', false, false);
		}
	
		$this->load->view('layout/footer', false, false);
	}
	
	function actualizar() {
		if($this->m_activacion->update($this->input->post(), 1)) {
			echo 'ok';
		} else {
			echo 'bad';
		}
	}
	
}