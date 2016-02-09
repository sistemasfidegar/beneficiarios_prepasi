<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reimpresion extends CI_Controller {

	public function __construct() {
		parent::__construct();
	
			
		$this->load->model('m_reimpresion');
		$this->load->helper('my_date_helper');
	}
	public function index()
	{
		$id_modulo=3;
		$hoy=new DateTime(fecha_actual());
		$aux=$this->m_reimpresion->getModuloActivo($id_modulo);
		$inicio=new DateTime($aux[0]['inicio']);
		$fin = new DateTime($aux[0]['fin']);
		
			
		if ($hoy >= $inicio && $hoy <=$fin){
			$this->load->view('reimpresion_documentos/busca_beneficiario', true, false);
		}
		else{
			$datos['sin_ins']=2;
			$this->load->view('reimpresion_documentos/sin_registro', $datos, false);
		}
		
	}
	function buscaBeneficiario(){
		$datos['curp']=$this->input->post('strCurp');
		$datos['matricula_ps']=$this->input->post('matricula_ps');
		$datos['nocta']=$this->input->post('nocta');
		
		
		if($datos['curp']!=''){
			$datos['busca']=$this->m_reimpresion->getBeneficiarioCurp($datos['curp']);
		}
		else if ($datos['matricula_ps']!=''){
			$datos['busca']=$this->m_reimpresion->getBeneficiarioPS($datos['matricula_ps']);
		}
		else{
			$datos['busca']=$this->m_reimpresion->getBeneficiarioNocta($datos['nocta']);
		} 
// 		print_r($datos['curp']);
// 		echo '<br>';
// 		print_r($datos['matricula_ps']);
// 		echo '<br>';
// 		print_r($datos['nocta']);

		if ($datos['busca']!=null){
			$this->pdf();
		}
		else
		{
			$datos['sin_ins']=1;
			$this->load->view('reimpresion_documentos/sin_registro', $datos, false);
		}
	}
	function pdf(){
		
	}
}
	
?>