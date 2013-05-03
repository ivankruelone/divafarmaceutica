<?php
class Cuentas_model extends CI_Model {

    var $juris = null;
    var $numsuc = null;
    var $nivel = null;
    var $user_id = null;

    function __construct()
    {
        parent::__construct();
        $this->juris = $this->session->userdata('juris');
        $this->numsuc = $this->session->userdata('numsuc');
        $this->nivel = $this->session->userdata('nivel');
        $this->user_id = $this->session->userdata('id');
    }
    
    
    function cuentas_xcobrar()
    {
        $sql = "SELECT p.id, p.fecha, numsuc, sucursal, sum(d.iva + d.subtotal) as total, condiciones, date(f_ruta + interval condiciones day) as vencimiento, datediff(f_ruta + interval condiciones day, now()) as dias, (select ifnull(sum(monto), 0) from cobrar_parcial where cuenta_id = p.id) as cancelado, p.factura
FROM pedidos p
left join detalle d on p.id = d.p_id
left join sucursales s on p.sucursal_id = s.numsuc
where p.estatus = 4
group by p.id
order by dias asc;";
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function cuentas_xcobrar_limites()
    {
        $sql = "SELECT p.id, p.fecha, numsuc, sucursal, sum(d.iva + d.subtotal) as total, condiciones, date(f_ruta + interval condiciones day) as vencimiento, datediff(f_ruta + interval condiciones day, now()) as dias, (select ifnull(sum(monto), 0) from cobrar_parcial where cuenta_id = p.id) as cancelado, p.factura, s.limite
FROM pedidos p
left join detalle d on p.id = d.p_id
left join sucursales s on p.sucursal_id = s.numsuc
where p.estatus = 4
group by numsuc
having total > limite
order by dias asc
;";
        
        $query = $this->db->query($sql);
        return $query->result();
    }

    function cuentas_xcobrar_maximo_parcialidad($id)
    {
        $sql = "SELECT sum(d.iva + d.subtotal) - (select ifnull(sum(monto), 0) from cobrar_parcial where cuenta_id = p.id) as maximo
FROM pedidos p
left join detalle d on p.id = d.p_id
left join sucursales s on p.sucursal_id = s.numsuc
where p.estatus = 4 and p.id = ?;";
        
        $query = $this->db->query($sql, $id);
        
        $row = $query->row();
        return $row->maximo;
    }
    
    function detalle_parcialidades_cobrar($id)
    {
        $sql = "SELECT * FROM cobrar_parcial c where cuenta_id = ?;";
        $query = $this->db->query($sql, $id);
        return $query->result();
    }

    function cuentas_xpagar()
    {
        $sql = "SELECT e.id, rfc, razon, e.fec_doc as fecha, e.referencia, e.monto as total, sum(a.monto) as cancelado, condiciones, (fec_doc + interval condiciones day) as vencimiento, datediff(fec_doc + interval condiciones day, now()) as dias
FROM entradas_c e
left join proveedores p on e.proveedor_id = p.id
left join pagar_parcial a on e.id = a.cuenta_id
where e.estatus = 1
group by e.id;";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function cuentas_xpagar_maximo_parcialidad($id)
    {
        $sql = "SELECT e.monto - ifnull(sum(a.monto), 0) as maximo
FROM entradas_c e
left join proveedores p on e.proveedor_id = p.id
left join pagar_parcial a on e.id = a.cuenta_id
where e.estatus = 1 and e.id = ?;";
        
        $query = $this->db->query($sql, $id);
        
        $row = $query->row();
        return $row->maximo;
    }

    function detalle_parcialidades_pagar($id)
    {
        $sql = "SELECT * FROM pagar_parcial c where cuenta_id = ?;";
        $query = $this->db->query($sql, $id);
        return $query->result();
    }
    
    function balance_cuentas()
    {
        $a = "[['Cuentas por cobrar', ".$this->cuentas_xcobrar_balance()."],['Cuentas por pagar', ".$this->cuentas_xpagar_balance()."]]";
        return $a;
    }

    function cuentas_xcobrar_balance()
    {
        $sql = "SELECT sum((d.iva + d.subtotal) - (select ifnull(sum(monto), 0) from cobrar_parcial where cuenta_id = p.id)) as maximo
FROM pedidos p
left join detalle d on p.id = d.p_id
left join sucursales s on p.sucursal_id = s.numsuc
where p.estatus = 4;";
        
        $query = $this->db->query($sql);
        
        $row = $query->row();
        return $row->maximo;
    }

    function cuentas_xpagar_balance()
    {
        $sql = "SELECT sum(e.monto - (select ifnull(sum(monto), 0) from pagar_parcial where cuenta_id = e.id ) )  as maximo
FROM entradas_c e
where e.estatus = 1;";
        
        $query = $this->db->query($sql);
        
        $row = $query->row();
        return $row->maximo;
    }
    
    function checar_cuentaxcobrar_cancelada($id)
    {
        $saldo = $this->cuentas_xcobrar_maximo_parcialidad($id);
        
        if((double)$saldo == 0){
            $data = new stdClass();
            $data = array(
                    'estatus' => 6
                    );
            $this->db->set('f_pago', 'now()', false);
            $this->db->where('id', $id);
            $this->db->update('pedidos', $data);
            
            return $this->db->affected_rows();

        }
    }

    function checar_cuentaxpagar_cancelada($id)
    {
        $saldo = $this->cuentas_xpagar_maximo_parcialidad($id);
        
        if((double)$saldo == 0){
            $data = new stdClass();
            $data = array(
                    'estatus' => 3
                    );
            $this->db->set('f_pago', 'now()', false);
            $this->db->where('id', $id);
            $this->db->update('entradas_c', $data);
            
            return $this->db->affected_rows();

        }
    }

}
