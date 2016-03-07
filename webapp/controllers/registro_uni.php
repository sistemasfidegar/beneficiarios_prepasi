<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_uni extends CI_Controller {

	public function __construct() {
		parent::__construct();

			
		$this->load->model('m_registro_uni');
		$this->load->model('m_registro');
		$this->load->helper('my_date_helper');
	}
	public function index()
	{
		$id_modulo=5;
		$datos['title']='Registro de Beneficiarios del Universitarios Sí';
		$hoy=new DateTime(fecha_actual());
		$aux=$this->m_registro->getModuloActivo($id_modulo);
		$inicio=new DateTime($aux[0]['inicio']);
      	$fin = new DateTime($aux[0]['fin']);
      	
		//MODULO ACTIVO UNIVERSITARIOS=5
		
		if ($hoy >= $inicio && $hoy <=$fin){
		 $this->load->view('layout/header', $datos, false);
		 $this->load->view('universitario/registro_uni', false, false);
		 $this->load->view('layout/footer', false, false);
		}else 
		{	
			$aux=$this->m_registro->getModuloActivo($id_modulo);
			$datos['fecha']=$aux[0];
			$datos['sin_ins']=2;
			$this->load->view('layout/header', $datos, false);
			$this->load->view('universitario/sin_registro_uni', $datos, false);
			$this->load->view('layout/footer', false, false);
			
		}
		
	}
	function buscaUniversitario(){
			
		$datos['strCurp'] = $this->input->post('strCurp');
		$aux=$this->m_registro_uni->getMatricula($datos['strCurp']);
		$datos['matricula']= $aux[0]['matricula_asignada'];
		
		$datos['title']='Registro de Beneficiarios del Universitarios Sí';
		//print_r($datos['matricula']['matricula_asignada']);
		if($datos['matricula']==""){
			$datos['sin_ins']=3;
			$this->load->view('layout/header', $datos, false);
			$this->load->view('universitario/sin_registro_uni', $datos, false);
			$this->load->view('layout/footer', false, false);
		}
		else{
			
			$aux=$this->m_registro_uni->inscrito($datos['matricula']);
			$datos['inscrito']=$aux[0]['id_archivo'];
			
			if ($datos['inscrito']==null){
			$aux=$this->m_registro_uni->getNoPagosUni($datos['matricula']);
			$datos['pagoUni']=$aux[0]['cuenta'];
			if ($datos['pagoUni']!=0){
				$datos['sin_ins']=5;
				$this->load->view('layout/header', $datos, false);
				$this->load->view('universitario/sin_registro_uni', $datos, false);
				$this->load->view('layout/footer', false, false);
				
			}else{
				
				$aux=$this->m_registro_uni->getTarjeta($datos['matricula']);
				$datos['tarjeta']=$aux[0]['notarjeta'];
				
				
				if($datos['tarjeta']==null){
					$datos['sin_ins']=4;
					$this->load->view('layout/header', $datos, false);
					$this->load->view('universitario/sin_registro_uni', $datos, false);
					$this->load->view('layout/footer', false, false);
				}
				else{ 
					$aux=$this->m_registro_uni->getDatosUniversitario($datos['matricula']);
					$datos['dato']=$aux[0];
					$this->load->view('layout/header', $datos, false);
					$this->load->view('universitario/sin_registro_uni', $datos, false);
					$this->load->view('layout/footer', false, false);
				}
			
			}
			}
			else {
				$datos['sin_ins']=6;
				$this->load->view('layout/header', $datos, false);
				$this->load->view('universitario/sin_registro_uni', $datos, false);
				$this->load->view('layout/footer', false, false);
			}
		}		
	}
	
	function buscaInstitucion(){
		
		$datos['title']='Registro de Beneficiarios del Universitarios Sí';
		
		$datos['matricula'] = $this->input->post('matricula');
		$datos['id_institucion'] = $this->input->post('selectInst');
		$datos['nombre'] = $this->input->post('nombre');
		$datos['ap'] = $this->input->post('ap');
		$datos['am'] = $this->input->post('am');
		$datos['curp'] = $this->input->post('curp');
		$datos['fecha_nac'] = $this->input->post('fecha_nac');
		$datos['edad'] = $this->input->post('edad');
		$datos['sexo'] = $this->input->post('sexo');
		$datos['lugar_nac'] = $this->input->post('lugar_nac');
		$datos['id_entidad'] = $this->input->post('id_entidad');
		
		
		$datos['carrera']=$this->m_registro_uni->getCarreraUni($datos['id_institucion']);
		$datos['grado']=$this->m_registro_uni->getGradoEscolar($datos['id_institucion']);
		$aux=$this->m_registro->getInstitucion($datos['id_institucion']);
		$datos['institucion']=$aux[0];
		$datos['plantel']=$this->m_registro_uni->getPlantel($datos['id_institucion']);
		$datos['grupo_etnico']=$this->m_registro_uni->getGrupoEtnico();
		$datos['generacion']=$this->m_registro_uni->getGeneracion();
		
		$aux=$this->m_registro_uni->DatosReinscripcion($datos['matricula']);
		$datos['dato']=$aux[0];
		$aux= $this->m_registro_uni->getDelegacion($datos['dato']['id_colonia']);
		$datos['del']=$aux[0];
		$datos['colonias']=$this->m_registro_uni->getColonias($datos['del']['id_delegacion']);
		
		$this->load->view('layout/header', $datos, false);
		$this->load->view('universitario/form_registro_completo', $datos, false);
		$this->load->view('layout/footer', false, false);
	}
	function  guardaUniversitario(){
		
		$datos['id_archivo'] =3;
		$datos['id_programa'] =2;
		$datos['id_solicitud']=1;
		
		
		
		$datos['matricula'] = $this->input->post('matricula_ps');
		$datos['edad'] =$this->input->post('edad');
		$datos['sexo'] =(int)$this->input->post('sexo');
		$datos['id_discapacidad'] =(int)$this->input->post('id_discapacidad');
		$datos['id_etnia'] =$this->input->post('id_etnia');
		$datos['id_estado_civil'] =$this->input->post('id_estado_civil');
		$datos['id_hijos'] =$this->input->post('id_hijos');
		$datos['id_ocupacion'] =$this->input->post('id_ocupacion');
		$datos['email'] =($this->input->post('email1'));
		
		$datos['id_colonia'] =$this->input->post('id_colonia');
		$datos['cp'] =$this->input->post('id_cp');
		$datos['calle'] =($this->input->post('calle'));
		$datos['noext'] =$this->input->post('noext');
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
		
		$aux=$this->m_registro->getUT($datos['id_colonia'],$datos['cp']);
		if($aux!=null){
			$datos['id_uts']=$aux[0]['id_ut'];
		}
		else 
			$datos['id_uts']=0;
		$datos['apellidoPadreP'] =($this->input->post('apellidoPadreP'));
		$datos['apellidoPadreM'] =($this->input->post('apellidoPadreM'));
		$datos['nombrePadre']    =($this->input->post('nombrePadre'));
		$datos['apellidoMadreP'] =($this->input->post('apellidoMadreP'));
		$datos['apellidoMadreM'] =($this->input->post('apellidoMadreM'));
		$datos['nombreMadre']    =($this->input->post('nombreMadre'));
		
		$datos['id_institucion'] =$this->input->post('id_institucion');
		$datos['id_plantel'] =$this->input->post('id_plantel');
		$datos['id_carrera'] =$this->input->post('id_carrera');
		$datos['id_generacion'] =$this->input->post('id_ciclo');
		$datos['id_sistema'] =$this->input->post('id_sistema');
		$datos['id_turno'] =$this->input->post('id_turno');
		$datos['promedio'] =$this->input->post('promedio');
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
		
		
		$datos['inserta']=$this->m_registro_uni->guardaUniversitario($datos);
		echo $datos['inserta'];
	}
	
	
}