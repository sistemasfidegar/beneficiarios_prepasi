<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function index()
	{		
		if($_POST!=null)
		{								
			$datos['fechaNac'] = $this->input->post('fechanac');
			$datos['strNombre'] = $this->input->post('strNombre');
			$datos['strAp'] = $this->input->post('strAp');
			$datos['strAm'] = $this->input->post('strAm');
			$datos['strTramite'] = $this->input->post('tramite');
			$datos['id_archivo'] = (int) $this->input->post('id_archivo');
			
			$datos['matricula'] = $this->input->post('matricula');		
			$datos['strInstitucion'] = $this->input->post('strInstitucion');
			$datos['id_institucion'] = (int) $this->input->post('IdInstitucion');
			
			$datos['diaNac'] =  $this->input->post('strDia');
			$datos['mesNac'] =  $this->input->post('strMesNac');
			$datos['strMesNac'] = $this->input->post('strMes');
			$datos['anioNac'] = (int) $this->input->post('strAnio');
			$datos['id_entidad'] = (int) $this->input->post('idEntidad');
			$datos['strAcronimoEntidad'] = $this->input->post('strAcronimo');
			$datos['strEntidad'] = $this->input->post('strEntidad');
			$datos['edad'] = (int) $this->input->post('strEdad');
			$datos['id_genero'] = (int) $this->input->post('strIdGenero');
			$datos['strGenero'] = $this->input->post('strGenero');
			$datos['strCurp'] = $this->input->post('strCurp');
			$datos['select_id_institucion'] = (int) $this->input->post('selectInst');
			
			
			
			//APLICAR LAS VALIDACIONES NECESARISA
			//institucion activa		
			//#pagos
			//tal vez que provenga del formulario de curp, luego vemos que hacer con esta
					
			
			$this->load->view('registro/form_registro', $datos, false);
		}
		else
		{
			$datos['heading'] = "Sistema deshabilitado para esta operación";
			$ip_addr = $_SERVER['REMOTE_ADDR'];
			$msg = "&nbsp;&nbsp;&nbsp;  Estas intentando accesar directamente a la aplicación y no está permitido!!!<br /><br />&nbsp;&nbsp;&nbsp;";
			$msg .= "Se ha registrado la IP: <strong>$ip_addr</strong> <br /><br />&nbsp;&nbsp;&nbsp;";
			$msg .= '<a href="http://www.prepasi.df.gob.mx/Inscripcion">Sistema de Registro de Beneficiarios del Programa Prepa Sí</a><br /><br />';
			
			$datos['message'] = $msg;
			
			$this->load->view('errors/html/error_404', $datos, null);
		}
	}
}


?>
