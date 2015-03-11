<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Master_barang extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_master_barang');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Barang');

		//meta description jika perlu
		$this->layout->set_desc('Made with love by Raksa Abadi Informatika');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Master', site_url('master'));
		$this->breadcrumb->add_crumb('Barang');		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
    $config['sql']      				= $this->m_master_barang->get();//Query SQL - bukan array lho ya...
    $config['per_page'] 				= 3;                            //jumlah item tiap halaman
    $data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

    //judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Merupakan induk dari semua data';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','master_barang/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Barang');

		//meta description jika perlu
		$this->layout->set_desc('Made with love by Raksa Abadi Informatika');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Master', site_url('master'));
		$this->breadcrumb->add_crumb('Barang');	

		//buat cari
		if(isset($_POST['keyword'])){
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}	

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load the "paging" library
    $config['sql']      				= $this->m_master_barang->get_cari($data['keyword']);//your SQL - bukan array lho ya...
    $config['per_page'] 				= 3;                            //Display items per page
    $data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

    //judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Merupakan induk dari semua data';

		//menggunakan theme back
		$this->layout->theme('back','master_barang/index', $data);
	}

	function barang_detail($id_barang = '', $id_produksi = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_barang, $id_produksi);

		//Layout
		//title
		$this->layout->set_title('Detail Barang');

		//meta description jika perlu
		$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Barang', site_url('master_barang'));
		$this->breadcrumb->add_crumb('Detail Barang');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Merupakan induk dari semua data';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_master_barang->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','master_barang/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Barang');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Barang', site_url('master_barang'));
		$this->breadcrumb->add_crumb('Tambah Barang');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Merupakan induk dari semua data';

		//menggunakan theme back
		$this->layout->theme('back','master_barang/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$dataInsert = array(
			'id_produksi' => $this->input->post('id_produksi'), 
			'nama' => $this->input->post('nama'), 
			'ket' => $this->input->post('ket')
			);

		if(!$this->m_master_barang->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('nama').'</b> gagal ditambahkan.');
			redirect('master_barang','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('nama').'</b> berhasil ditambahkan.');
			redirect('master_barang','refresh');
		}

		//simpan melalui model
		$this->m_master_barang->save($dataInsert);

		//kembalikan ke halaman master_barang
		redirect('master_barang');
	}

	function edit($id_barang = '', $id_produksi = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_barang, $id_produksi);

		//layout
		//title
		$this->layout->set_title('Edit Data Barang');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Master', site_url('master'));
		$this->breadcrumb->add_crumb('Barang', site_url('master_barang'));
		$this->breadcrumb->add_crumb('Edit Barang');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Merupakan induk dari semua data';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_master_barang->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','master_barang/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//ambil data dari form
		$id_barang = $this->input->post('id_barang');
		$dataUpdate = array(
			'id_produksi' => $this->input->post('id_produksi'), 
			'nama' => $this->input->post('nama'), 
			'ket' => $this->input->post('ket')
			);

		if(!$this->m_master_barang->update($id_barang, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('nama').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('nama').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_barang = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_master_barang->delete($id_barang)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	function excel(){
		$this->rule->type('R');
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Data Barang');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Data Barang Raksa Abadi Informatika');
		$this->excel->getActiveSheet()->setCellValue('A2', 'No.');
		$this->excel->getActiveSheet()->setCellValue('B2', 'ID Produksi');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Nama Barang');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Keterangan');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//set style
	  $TitleStyle = array(
	    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
	    ),
	    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '00994C') // hijau tua
      ),
      'font'  => array(
	      'bold'  => false,
	      'color' => array('rgb' => 'FFFFFF'),
	      'size'  => 15,
	      'name'  => 'Verdana'
  		)
  	);

	  $HeaderStyle = array(
	    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
	    ),
	    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '32CD32') // hijau
      )
  	);

  	$ContentStyle = array(
	    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
	    ),
	    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00') // kuning
      )
  	);
  	
		$this->excel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($TitleStyle);
		$this->excel->getActiveSheet()->getStyle('A2:D2')->applyFromArray($HeaderStyle);
		//isi
		$list_data = $this->m_master_barang->get_export();
		$cols = 3;
		$num = 1;
		foreach($list_data as $row){
			$col = $cols++;
			$this->excel->getActiveSheet()->setCellValue('A' . $col, $num++);
			$this->excel->getActiveSheet()->setCellValue('B' . $col, $row['id_produksi']);
			$this->excel->getActiveSheet()->setCellValue('C' . $col, $row['nama']);
			$this->excel->getActiveSheet()->setCellValue('D' . $col, $row['ket']);
		}

		//warna
		$cols2 = 3;
		foreach($list_data as $row){
			$col2 = $cols2++;
			$this->excel->getActiveSheet()->getStyle('A' . $col2)->applyFromArray($ContentStyle);
			$this->excel->getActiveSheet()->getStyle('B' . $col2)->applyFromArray($ContentStyle);
			$this->excel->getActiveSheet()->getStyle('C' . $col2)->applyFromArray($ContentStyle);
			$this->excel->getActiveSheet()->getStyle('D' . $col2)->applyFromArray($ContentStyle);
		}

		$this->excel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);


		$filename='data barang.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

	function pdf(){
		// rule type
		$this->rule->type('R');
		//ambil data
		$data['results'] = $this->m_master_barang->get_export();
		// pdf library
		$this->load->library('pdf');
		ob_start();		
		$this->load->view('back/layouts/master_barang/pdf', $data);
    $content = ob_get_clean();
  	try{
  		// L => Landscape, P => Potrait, array(215,330) => ukuran kertas, array(10, 10, 5, 5) => margin
      $html2pdf = new HTML2PDF('P', array(215,330), 'en', true, 'UTF-8', array(10, 10, 5, 5));
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output("data_barang.pdf");
  	}
  	catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  	}
	}

}
