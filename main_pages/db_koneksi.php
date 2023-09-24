<?php
//konstanta untuk koneksi database
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "kafe");
//konstanta keur aran web
define('NAMI_WEB', 'Sistem Monitoring Asap Rokok');

$dataJSON = file_get_contents('');
/** ngieun koneksi **/
class CRUD
{
    public $db;
    public function __construct()
    {
        $this->db = new mysqli(HOST, USER, PASS, DB);
        if ($this->db->connect_errno) {
            header("location:../error.html");
        }
    }

    /** disini membuat fungsi yang lain seperti CRUD **/
    /** login  dan yang lainnya **/
    public function login($user, $nama_tabel, $where)
    {
        //menghitung jumlah
        $query = $this->db->query("SELECT count(*) from 
	$nama_tabel where $where='$user'");
        $hasil = $query->fetch_row();
        return $hasil;
    }
    public function login_dua($user)
    {
        $query = $this->db->query("SELECT * from user 
	where username='$user'");
        $cek = $query->fetch_array();
        return $cek;
    }
    public function view($nama_tabel)
    {
        $query = $this->db->query("SELECT * from $nama_tabel ");
        return $query;
    }
    public function memesan($nama_tabel_a, $nama_tabel_b)
    {
        $query = $this->db->query("SELECT * from $nama_tabel_a INNER JOIN $nama_tabel_b ");
        return $query;
    }
    public function meja($no_meja)
    {
        $query = $this->db->query("SELECT * from meja where no_meja='$no_meja' ");
        return $query;
    }
    public function pupus($nama_tabel, $where, $kode)
    {
        $query = $this->db->prepare("DELETE from $nama_tabel where $where='$kode' ");
        $data = $query->execute();
        return $data;
    }
    //UNTUK CETAK LAPORAN----------------------------------------------------------------------->
    public function laporan($nama_tabel, $id_masakan)
    {
        $query = $this->db->query("SELECT * from $nama_tabel order by $id_masakan asc");
        return $query;
    }
    public function laporan_laku($detail_order, $masakan)
    {
        $query = $this->db->query("SELECT b.id_masakan, b.nama_masakan, sum(qty) as jumlah, b.harga, sum(qty)* b.harga as Total FROM detail_order as a INNER JOIN masakan as b ON a.id_masakan=b.id_masakan group by b.id_masakan ASC");
        return $query;
    }

    //khusus edit atau robah ---------------------------------------------------------------------------
    public function edit($nama_tabel, $where, $kode)
    {
        $query = $this->db->query("SELECT * from $nama_tabel where 
		$where='$kode' ");
        $data = $query->fetch_row();
        return $data;
    }
    public function robah_order($nama_tabel, $id_order, $no_meja, $tanggal, $id_user, $keterangan, $status_order)
    {
        $query = $this->db->prepare("UPDATE $nama_tabel set id_order='$id_order', no_meja='$no_meja', tanggal='$tanggal', id_user='$id_user', keterangan='$keterangan', status_order='$status_order' where id_order='$id_order'");
        $data = $query->execute();
        return $data;
    }
    public function robah_detail_order($nama_tabel, $id_detail_order, $id_order, $id_masakan, $qty, $keterangan, $status_detail_order)
    {
        $query = $this->db->prepare("UPDATE $nama_tabel set id_detail_order='$id_detail_order', id_order='$id_order', id_masakan='$id_masakan', qty='$qty', keterangan='$keterangan', status_detail_order='$status_detail_order' where id_detail_order='$id_detail_order'");
        $data = $query->execute();
        return $data;
    }
    public function robah_pembeli($nama_tabel, $kode, $nama_pembeli, $alamat, $jk, $no_hp, $foto)
    {
        $query = $this->db->prepare("UPDATE $nama_tabel set id_pembeli = '$kode', nama_pembeli ='$nama_pembeli', alamat='$alamat', foto = '$foto', jk='$jk', no_hp='$no_hp' where id_pembeli='$kode'");
        $data = $query->execute();
        return $data;
    }
    public function robah_user($nama_tabel, $id_user, $nama_user, $nama_foto)
    {
        $query = $this->db->prepare("UPDATE $nama_tabel set nama_user = '$nama_user', nama_foto='$nama_foto' where id_user='$id_user'");
        $data = $query->execute();
        return $data;
    }
    public function robah_level($nama_tabel, $id_level, $nama_level)
    {
        $query = $this->db->prepare("UPDATE $nama_tabel set id_level = '$id_level', nama_level ='$nama_level' where id_level='$id_level'");
        $data = $query->execute();
        return $data;
    }
    public function robah_masakan($nama_tabel, $id_masakan, $nama_masakan, $harga, $status_masakan, $stok)
    {
        $query = $this->db->prepare("UPDATE $nama_tabel set id_masakan = '$id_masakan', nama_masakan ='$nama_masakan', harga = '$harga', status_masakan = '$status_masakan', stok = '$stok' where id_masakan='$id_masakan'");
        $data = $query->execute();
        return $data;
    }



    //Khusus input atau tambah data +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /*	public function insert($meja,$tgl,$id_user,$ket,$stat)
	{
		$query = $this->db->prepare("INSERT into order values
		('','$data')");
		$yes = $query->execute();
		return $yes;
	}*/
    public function input_pembeli($nama_tabel, $id_pembeli, $nama_pembeli, $alamat, $nama_foto, $jk, $telp)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('$id_pembeli','$nama_pembeli','$alamat','$nama_foto','$jk','$telp')");
        $data = $query->execute();
        return $data;
    }
    public function input_user($nama_tabel, $nama_user, $username, $password, $id_level, $nama_foto)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('','$username','$password','$nama_user','$nama_foto','$id_level')");
        $data = $query->execute();
        return $data;
    }
    public function input_order($nama_tabel, $kode, $no_meja, $tanggal, $id_user, $keterangan, $status_order)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('$kode','$no_meja','$tanggal','$id_user','$keterangan','$status_order')");
        $data = $query->execute();
        return $data;
    }
    public function input_detail_order($nama_tabel, $id_order, $id_masakan, $qty, $keterangan, $status_detail_order)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('','$id_order','$id_masakan','$qty','$keterangan','$status_detail_order')");
        $data = $query->execute();
        return $data;
    }
    public function input_meja($nama_tabel, $no_meja)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('','$no_meja')");
        $data = $query->execute();
        return $data;
    }
    public function input_level($nama_tabel, $id_level, $nama_meja)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('$id_level','$nama_meja')");
        $data = $query->execute();
        return $data;
    }
    public function input_masakan($nama_tabel, $nama_masakan, $harga, $status_masakan, $stok)
    {
        $query = $this->db->prepare("INSERT into $nama_tabel values
		('','$nama_masakan','$harga','$status_masakan','$stok')");
        $data = $query->execute();
        return $data;
    }
    public function insert($table, $rows = null)
    {
        $sql = "INSERT INTO $table";
        $row = null;
        $value = null;
        foreach ($rows as $key => $nilai) {
            $row .= "," . $key;
            $value .= ",'" . $nilai . "'";
        }
        $sql .= "(" . substr($row, 1) . ")";
        $sql .= "VALUES(" . substr($value, 1) . ")";
        $input = $this->db->prepare("$sql") or die($this->db->error);
        return $input;
    }
    public function select($table, $where = null, $order = null)
    {
        $sql = "SELECT * FROM $table";
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        if ($order != null) {
            $sql .= " ORDER BY $order";
        }
        $select = $this->db->query("$sql") or die($this->db->error);
        return $select;
    }

    public function total($io)
    {

        $query = $this->db->query("select b.nama_masakan,b.harga,a.qty, a.qty * b.harga as Total  from detail_order as a
	 JOIN masakan as b ON a.id_masakan=b.id_masakan where a.id_order='$io'");
        return $query;
    }

    public function bayar_meja($meja)
    {
        $query = $this->db->query("select pesan.no_meja,meja.status, 
		pesan.id_order,detail_order.id_masakan, detail_order.qty, masakan.harga,masakan.harga*detail_order.qty as total, masakan.nama_masakan from pesan inner JOIN meja on pesan.no_meja=meja.no_meja inner join detail_order on detail_order.id_order=pesan.id_order inner join masakan on masakan.id_masakan=detail_order.id_masakan
	 where pesan.no_meja='$meja' AND meja.status='0' AND pesan.status_order='BL'
		");
        return $query;
    }

    public function ubah_status($io)
    {
        $query = $this->db->query("update meja inner join pesan on meja.no_meja = pesan.no_meja set meja.status='1', 
	pesan.status_order='L' where pesan.id_order='$io'");
        return $query;
    }
    //laporan
    public function duit_perbulan($thnbln)
    {
        $query = $this->db->query("SELECT sum(total_bayar) as Total from transaksi where 
	SUBSTRING(tanggal,1,7)=SUBSTRING('$thnbln',1,7)");
        return $query;
    }
    public function laporan_perbulan($thnbln)
    {
        $query = $this->db->query("SELECT * from transaksi where 
	SUBSTRING(tanggal,1,7)=SUBSTRING('$thnbln',1,7)");
        return $query;
    }

    public function duit_kabeh()
    {
        $query = $this->db->query("SELECT sum(total_bayar) as Total from transaksi");
        return $query;
    }
}
$ok = new CRUD();


class LUPA
{
    public $db;
    public function __construct()
    {

        $this->db = new mysqli(HOST, USER, PASS, DB);
        if ($this->db->connect_errno) {
            echo "Database tidak dapat di temukan";
        }
    }

    public function cari($nama_tabel, $where, $key)
    {
        $query = $this->db->query("SELECT * from $nama_tabel where 
	$where LIKE '%$key%'");
        return $query;
    }
}
$Kcari = new LUPA();
