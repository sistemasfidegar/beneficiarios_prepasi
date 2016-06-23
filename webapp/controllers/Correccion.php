<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correccion extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('m_correccion');
		$this->load->helper('my_date_helper');
	}
	public function index()
	{
		$id_modulo=6;
		$datos['title']='Correción de Datos';
		$hoy=new DateTime(fecha_actual());
		
		//Modulo Activo
		$aux=$this->m_correccion->getModuloActivo($id_modulo);
		$inicio=new DateTime($aux[0]['inicio']);
		$fin = new DateTime($aux[0]['fin']);
		
		if ($hoy >= $inicio && $hoy <=$fin){
			$this->load->view('layout/header', $datos, false);
			$this->load->view('correcciones/busca_beneficiario', $datos, false);
			$this->load->view('layout/footer', false, false);
		}
		else
		{
			$datos['disponible']=1;
			$this->load->view('layout/header', $datos, false);
			$this->load->view('correcciones/noDisponible', $datos, false);
			$this->load->view('layout/footer', false, false);
		}
	}
	function corrigeBeneficiario($matricula){
			$datos['title']='Correción de Datos';
			$datos['matricula']=$matricula;
			
			$datos['direccion']=array('andador'=>'','calle'=>'','departamento'=>'','ecalle'=>'','edificio'=>'','entrada'=>'','id_colonia'=>'','id_tiempo_residencia'=>''
					,'lote'=>'','manzana'=>'','noext'=>'','noint'=>'','pasillo'=>'','rampa'=>'','villa'=>'','ycalle'=>'','estado'=>'');
			$datos['escolar']=array('matricula_escuela'=>'','plantel'=>'','institucion'=>'','id_institucion'=>'','plantel'=>'','id_turno'=>'','promedio'=>'','id_grado'=>''
					,'num_mat_adeuda'=>0,'id_carrera'=>'','id_generacion'=>'','id_sistema'=>'');
			$datos['del']=array('id_delegacion'=>'','cp'=>'');
			
			$datos['reg_escolar']=0;
			$datos['reg_direccion']=0;
			
			$datos['generacion']=$this->m_correccion->getGeneracion();
			$datos['carrera']=$this->m_correccion->getCarreraBach();
			
			$aux=$this->m_correccion->getBeneficiarios($matricula);
			if ($aux!=null )
			{
				$datos['beneficiario']=$aux[0];
				//$aux=$this->m_correccion->getDatos($matricula);
			}
			$aux=$this->m_correccion->getPersonal($matricula);
				
			if($aux!=null){
				$datos['personal']=$aux[0];
			
				$datos['grupo_etnico']=$this->m_correccion->getGrupoEtnico();
			}
				
			$aux=$this->m_correccion->getEscolar($matricula);
			if ($aux!=null)
			{
				$datos['escolar']=$aux[0];
				$datos['reg_escolar']=1;
				$datos['plantel']=$this->m_correccion->getPlantel($datos['escolar']['id_institucion']);
				$datos['grado']=$this->m_correccion->getGradoEscolar($datos['escolar']['id_institucion']);
			
			}
			else 
				$datos['institucion']=$this->m_correccion->getInstitucion();
				
			$aux=$this->m_correccion->getDireccion($matricula);
			if ($aux!=null )
			{
				$datos['direccion']=$aux[0];
				$datos['reg_direccion']=1;
				$aux= $this->m_correccion->getDelegacion($datos['direccion']['id_colonia']);
				$datos['del']=$aux[0];
				$datos['colonias']=$this->m_correccion->getColonias($datos['del']['id_delegacion']);
			}
			if ($datos['reg_direccion']==0)
				$datos['entidad']=$this->m_correccion->getEntidad();
				
			$this->load->view('layout/header', $datos, false);
			$this->load->view('correcciones/correcion_bach', $datos, false);
			$this->load->view('layout/footer', false, false);
			
			
	}
	function ajaxGetGrado($institucion){
		
		$grado=$this->m_correccion->getGradoEscolar($institucion);
	
		echo '<option value="0">[Seleccionar]</option>';
		foreach($grado as $row)
		{
			echo '<option value="'.$row['id_grado'].'">'.$row['grado'].' - '.$row['periodicidad'].'</option>';
		}
	}
	function ajaxPlantel($institucion){
		$escuela=$this->m_correccion->getPlantel($institucion);
		
		echo '<option value="0">[Seleccionar]</option>';
		foreach($escuela as $row)
		{
			echo '<option value="'.$row['id_plantel'].'">'.$row['plantel'].'</option>';
		}
	}
	function ajax_beneficiario_matricula(){
		$matricula =  $this->input->post('matricula');
		$aux = $this->m_correccion->getMatricula($matricula);
		
		$aux = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
		
		if(!is_null($aux)) {
			$aceptado = $this->m_correccion->aceptado($aux);
			$aceptado = isset($aceptado[0]['aceptado']) ? $aceptado[0]['aceptado'] : null;
			
			if (is_null($aceptado) || $aceptado != 1)
				echo $matricula = $aux;
			else
				echo 'aceptado';
		}
		else
		{
			echo 'bad';
		}
	}
	
	
	function ajax_beneficiario_unam(){
		$matricula =  $this->input->post('matricula_escuela');
		$aux = $this->m_correccion->getMatriculaUnam($matricula);
		$aux = isset($aux[0]['matricula_asignada']) ? $aux[0]['matricula_asignada'] : null;
		
		if(!is_null($aux)) {
			$aceptado = $this->m_correccion->aceptado($aux);
			$aceptado = isset($aceptado[0]['aceptado']) ? $aceptado[0]['aceptado'] : null;
			
			if (is_null($aceptado) || $aceptado != 1)
				echo $matricula = $aux;
			else
				echo 'aceptado';
		}
		else
		{
			echo 'bad';
		}
	}
	function ajaxGetColonias($id_delegacion){
	
		$aux=$this->m_correccion->getColonias($id_delegacion);
		$existente=array();
		echo '<option value="0">[Seleccionar]</option>';
	
		foreach ($aux as $colonia){
			$cp = $colonia['cp'];
			$col = $this->limpia_cadena($colonia['colonia']);
			$cad =$cp."|".$col;
			if(!in_array($cad,$existente))
			{
				$existente[] = $cad;
					
				echo "<option value='".$colonia['id_colonia']."'>[".$colonia['cp']."] - ".$colonia['colonia']."</option>";
			}
		}
		echo '</select>';
	}
	function  guardaBeneficiario(){
		
		$datos['id_programa'] =1;
		$datos['id_solicitud']=1;
		$datos['id_usuario_update']=1;
		
		
		$datos['reg_direccion'] =(int)$this->input->post('reg_direccion');
		$datos['reg_escolar'] =(int)$this->input->post('reg_escolar');
		$datos['id_archivo'] =(int)$this->input->post('id_archivo');
		$datos['id_entidad'] =(int)$this->input->post('id_entidad');
		
		
		$datos['id_discapacidad'] =(int)$this->input->post('id_discapacidad');
		$datos['id_etnia'] =$this->input->post('id_etnia');
		$datos['id_estado_civil'] =$this->input->post('id_estado_civil');
		$datos['id_hijos'] =$this->input->post('id_hijos');
		$datos['id_ocupacion'] =$this->input->post('id_ocupacion');
		$datos['email'] =$this->input->post('email1');
		
		$datos['id_colonia'] =$this->input->post('id_colonia');
		$datos['cp'] =$this->input->post('id_cp');
		$datos['calle'] =$this->input->post('calle');
		$datos['noext'] =(int)$this->input->post('noext');
		$datos['noint'] =$this->input->post('noint');
		$datos['id_tiempo_residencia'] =$this->input->post('id_residencia');
		$datos['ycalle'] =($this->input->post('ycalle'));
		$datos['ecalle'] =($this->input->post('ecalle'));
		$datos['edificio'] =$this->input->post('edificio');
		$datos['departamento'] =$this->input->post('departamento');
		$datos['manzana'] =$this->input->post('manzana');
		$datos['lote'] =$this->input->post('lote');
		$datos['rampa'] =$this->input->post('rampa');
		$datos['andador'] =$this->input->post('andador');
		$datos['pasillo'] =$this->input->post('pasillo');
		$datos['villa'] =$this->input->post('villa');
		$datos['entrada'] =$this->input->post('entrada');
		$datos['celular'] =$this->input->post('celular');
		$datos['telefono'] =$this->input->post('telefono');
		
		$aux=$this->m_correccion->getUT($datos['id_colonia'],$datos['cp']);
		if($aux!=null){
			$datos['id_uts']=$aux[0]['id_ut'];
		}
		else
			$datos['id_uts']=0;
		
		
		$datos['apellidoPadreP'] =($this->input->post('apellidoPadreP'));
		$datos['apellidoPadreM'] =($this->input->post('apellidoPadreM'));
		$datos['nombrePadre'] 	 =($this->input->post('nombrePadre'));
		$datos['apellidoMadreP'] =($this->input->post('apellidoMadreP'));
		$datos['apellidoMadreM'] =($this->input->post('apellidoMadreM'));
		$datos['nombreMadre']  	 =($this->input->post('nombreMadre'));
		
		
		$datos['id_plantel'] =$this->input->post('id_plantel');
		$datos['id_carrera'] =$this->input->post('id_carrera');
		$datos['id_generacion'] =$this->input->post('id_ciclo');
		$datos['id_sistema'] =$this->input->post('id_sistema');
		$datos['id_turno'] =$this->input->post('id_turno');
		$datos['promedio'] =$this->input->post('promedio');
		$datos['id_institucion'] =$this->input->post('id_institucion');
		
		
		$datos['materias'] =$this->input->post('materias');
		$datos['matricula_escuela'] =$this->input->post('matricula');
		$datos['id_grado'] =$this->input->post('id_grado');
		$aux=$this->input->post('finado_madre');
		if($aux=='on'){
			$datos['finado_madre']=1;
		}else
			$datos['finado_madre']=0;
		$aux==$this->input->post('finado_padre');
		if($aux=='on'){
			$datos['finado_padre']=1;
		}else
			$datos['finado_padre']=0;
		$aux= $this->input->post('es_etnia');
		if($aux=='on'){
			$datos['petnica']=1;
		}else
			$datos['petnica']=0;
		$datos['matricula_ps']=$this->input->post('matricula_ps');
		$datos['inserta']=$this->m_correccion->UpdateDatos($datos,$datos['reg_direccion'],$datos['reg_escolar']);
		echo $datos['inserta'];
	}
	
	function limpia_cadena($string)
	{
		$string = trim($string);
	
		$string = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$string
		);
	
		$string = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$string
		);
	
		$string = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$string
		);
	
		$string = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$string
		);
	
		$string = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$string
		);
	
		$string = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C',),
				$string
		);
	
		return $string;
	}
	
}