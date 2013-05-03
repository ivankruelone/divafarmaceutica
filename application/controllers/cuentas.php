<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentas extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
        $this->load->model('cuentas_model');
            // Your own constructor code
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	function cobrar()
	{
	   $data['menu'] = 1;
	   $data['submenu'] = 1.1;
       $data['titulo'] = 'Cuentas por cobrar';
       $data['contenido'] = 'cuentas/cuentasxcobrar';
       $data['js'] = 'cuentas/cuentasxcobrar_js';
       $data['query'] = $this->cuentas_model->cuentas_xcobrar();
       $this->load->view('main', $data);
        
	}

	function asignar_factura_pedido($id)
	{
	   $data['menu'] = 1;
	   $data['submenu'] = 1.1;
       $data['titulo'] = 'Cuentas por cobrar: asignar numero de factura';
       $data['contenido'] = 'cuentas/asignar_factura_pedido';
       $data['cuenta'] = $id;
       $this->load->view('main', $data);
        
	}

    function submit_asignar_factura_pedido()
    {
        $data = new StdClass();
        $data->factura = trim($this->input->post('factura'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pedidos', $data);
        redirect('cuentas/cobrar');
    }

	function cobrar_parcialidad($id)
	{
	   $data['menu'] = 1;
	   $data['submenu'] = 1.1;
       $data['titulo'] = 'Cuentas por cobrar: ingresar una parcialidad';
       $data['contenido'] = 'cuentas/cuentasxcobrar_parcialidad';
       $data['js'] = 'cuentas/cuentasxcobrar_parcialidad_js';
       $data['cuenta'] = $id;
       $data['maximo'] = $this->cuentas_model->cuentas_xcobrar_maximo_parcialidad($id);
       $this->load->view('main', $data);
        
	}
    
    function submit_cobrar_parcialidad()
    {
        //id, cuenta_id, fecha, monto, referencia
        
        $data = new StdClass();
        $data->cuenta_id = $this->input->post('id');
        $data->fecha = $this->input->post('fecha');
        $data->monto = $this->input->post('monto');
        $data->referencia = $this->input->post('referencia');
        $data->forma = $this->input->post('forma');
        
        if($this->db->insert('cobrar_parcial', $data)){
            
            $this->cuentas_model->checar_cuentaxcobrar_cancelada($this->input->post('id'));
            
            redirect('cuentas/cobrar');
        }else{
            redirect('cuentas/cobrar');
        }
        
        
    }
    
    function detalle_parcialidades($id)
    {
        $data['query'] = $this->cuentas_model->detalle_parcialidades_cobrar($id);
        $this->load->view('cuentas/detalle_parcialidades', $data);
    }

	function pagar()
	{
	   $data['menu'] = 1;
	   $data['submenu'] = 1.2;
       $data['titulo'] = 'Cuentas por pagar';
       $data['contenido'] = 'cuentas/cuentasxpagar';
       $data['js'] = 'cuentas/cuentasxpagar_js';
       $data['query'] = $this->cuentas_model->cuentas_xpagar();
       $this->load->view('main', $data);
        
	}

	function pagar_parcialidad($id)
	{
	   $data['menu'] = 1;
	   $data['submenu'] = 1.2;
       $data['titulo'] = 'Cuentas por pagar: ingresar una parcialidad';
       $data['contenido'] = 'cuentas/cuentasxpagar_parcialidad';
       $data['js'] = 'cuentas/cuentasxpagar_parcialidad_js';
       $data['cuenta'] = $id;
       $data['maximo'] = $this->cuentas_model->cuentas_xpagar_maximo_parcialidad($id);
       $this->load->view('main', $data);
        
	}

    function submit_pagar_parcialidad()
    {
        //id, cuenta_id, fecha, monto, referencia
        
        $data = new StdClass();
        $data->cuenta_id = $this->input->post('id');
        $data->fecha = $this->input->post('fecha');
        $data->monto = $this->input->post('monto');
        $data->referencia = $this->input->post('referencia');
        $data->forma = $this->input->post('forma');
        
        if($this->db->insert('pagar_parcial', $data)){
            
            $this->cuentas_model->checar_cuentaxpagar_cancelada($this->input->post('id'));
            
            redirect('cuentas/pagar');
        }else{
            redirect('cuentas/pagar');
        }
        
        
    }

    function detalle_parcialidades_pagar($id)
    {
        $data['query'] = $this->cuentas_model->detalle_parcialidades_pagar($id);
        $this->load->view('cuentas/detalle_parcialidades', $data);
    }

	function indicadores()
	{
	   $data['menu'] = 1;
	   $data['submenu'] = 1.3;
       $data['titulo'] = 'Indicadores';
       $data['contenido'] = 'cuentas/indicadores';
       $data['js'] = 'cuentas/indicadores_js';
       $data['balance'] = $this->cuentas_model->balance_cuentas();
       $data['limites'] = $this->cuentas_model->cuentas_xcobrar_limites();
       $this->load->view('main', $data);
        
	}

}