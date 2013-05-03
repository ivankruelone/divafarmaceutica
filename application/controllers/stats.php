<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->logeado();
    }
    
    private function logeado()
    {
        $sess = $this->session->userdata('logged_in');
        if($sess === FALSE){
            redirect('login');
        }
    }

	function index()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Estadisticas del Almacen';
       $data['contenido'] = 'stats/portada';
       $this->load->view('main', $data);
        
	}

	function req_vs_sur_diario()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Requeridas Vs. Surtidas Diarias';
       $data['contenido'] = 'stats/req_vs_sur_diario';
       $data['js'] = 'stats/req_vs_sur_diario_js';
       $this->load->view('main', $data);
        
	}

    function get_json_req_vs_sur_diario($serie)
    {
        header("Content-type: text/json");
        $this->db->select('unix_timestamp(fec_embarque) as fecha, '.$serie.' as can');
        $query = $this->db->get('canreq_vs_cansur_embarcado');
        
        $a = "[";
        
        foreach($query->result() as $row)
        {
            //$a.= "[Date.UTC(".$row->anio.",".$row->mes.",".$row->dia.",".$row->horas.",".$row->minuto.",".$row->segundo."),".$row->inventario."],";
            $a.= "[".($row->fecha*1000).",".$row->can."],";
        }
        
        $a = substr($a, 0, -1); 
        
        $a.="]";
        
        
        echo $a;
        
    }

	function negados()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Negados';
       $data['contenido'] = 'stats/negados';
       $data['js'] = 'stats/negados_js';
       $this->load->view('main', $data);
        
	}
    
	function surtidos()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Surtidos';
       $data['contenido'] = 'stats/surtidos';
       $data['js'] = 'stats/surtidos_js';
       $this->load->view('main', $data);
        
	}

    function negados_resultado()
    {
        $this->load->model('inv_model');
        $data['perini'] = $this->input->post('perini');
        $data['perfin'] = $this->input->post('perfin');
        $data['query'] = $this->inv_model->negados($this->input->post('perini'), $this->input->post('perfin'));
        $this->load->view('stats/negados_resultado', $data);
    }

    function surtidos_resultado()
    {
        $this->load->model('inv_model');
        $data['perini'] = $this->input->post('perini');
        $data['perfin'] = $this->input->post('perfin');
        $data['query'] = $this->inv_model->surtidos($this->input->post('perini'), $this->input->post('perfin'));
        $this->load->view('stats/surtidos_resultado', $data);
    }
    
    function detalle_surtidos($clave, $perini, $perfin)
    {
        $this->load->model('inv_model');
        $data['query'] = $this->inv_model->detalle_surtidos($clave, $perini, $perfin);
        $this->load->view('stats/detalle_surtidos_resultado', $data);
    }

    function detalle_negados($clave, $perini, $perfin)
    {
        $this->load->model('inv_model');
        $data['query'] = $this->inv_model->detalle_negados($clave, $perini, $perfin);
        $this->load->view('stats/detalle_negados_resultado', $data);
    }

	function precio_historicos()
	{
	   $data['menu'] = 10;
	   $data['submenu'] = 10.1;
       $data['titulo'] = 'Historico de precios';
       $data['contenido'] = 'stats/precios_historico';
       $data['js'] = 'stats/js_precios_historico';
       $data['claves'] = $this->comun->productos_combo();
       $this->load->view('main', $data);
        
	}
    
    function submit_precios_historico()
    {
        $this->load->model('productos_model');
        $clave = $this->input->post('clave');
        $proveedor = $this->input->post('proveedor');
        
        $sql = "SELECT o.id, o.razon, descripcion, susa, d.precio, c.fec_doc FROM entradas_c c
inner join entradas d on c.id = d.e_id
inner join productos p on d.p_id = p.id
inner join proveedores o on c.proveedor_id = o.id
where clave = ? and c.tipo = 1 and c.subtipo = 4 and estatus in(1, 3) and c.proveedor_id = ?
order by c.fec_doc desc;";
        
        $query = $this->db->query($sql, array($clave, $proveedor));
        $data['query'] = $query->result();
        $data['producto'] = $this->productos_model->producto_clave_precio($clave, $proveedor);
        $this->load->view('stats/historico_precios_busca', $data);
        
        
    }

    function get_json_precio_historico($clave)
    {
        header("Content-type: text/json");
        
        $sql = "SELECT d.precio, unix_timestamp(c.fec_doc) as fecha FROM entradas_c c
inner join entradas d on c.id = d.e_id
inner join productos p on d.p_id = p.id
inner join proveedores o on c.proveedor_id = o.id
where clave = ? and c.tipo = 1 and c.subtipo = 4 and estatus in(1, 3)
order by c.fec_doc asc;";
        
        $query = $this->db->query($sql, $clave);
        
        $a = "[";
        
        foreach($query->result() as $row)
        {
            //$a.= "[Date.UTC(".$row->anio.",".$row->mes.",".$row->dia.",".$row->horas.",".$row->minuto.",".$row->segundo."),".$row->inventario."],";
            $a.= "[".($row->fecha*1000).",".$row->precio."],";
        }
        
        $a = substr($a, 0, -1); 
        
        $a.="]";
        
        
        echo $a;
        
    }

    function proveedor_clave()
    {
        $clave = $this->input->post('clave');
        $a = null;
        
        $sql = "SELECT o.id, o.razon FROM entradas_c c
inner join entradas d on c.id = d.e_id
inner join productos p on d.p_id = p.id
inner join proveedores o on c.proveedor_id = o.id
where clave = ? and c.tipo = 1 and c.subtipo = 4 and estatus in(1, 3)
group by o.id;";
        $query = $this->db->query($sql, $clave);
        
        foreach($query->result() as $row)
        {
            $a .= "<option value=\"$row->id\">$row->id - $row->razon</option>";
        }
        
        echo $a;
    }
}