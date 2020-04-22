<?php
//menginclude file koneksi.php sebagai cara koneksi database
include('koneksi.php');
//metode import file element dompdf yang dibutuhkan 
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
//membuat instance dompdf baru
$dompdf = new Dompdf();
//query pemanggilan dari database
$query = mysqli_query($koneksi,"select * from tb_siswa");
//pembuatan variabel html bersambung yang akan dimunculkan pada laman
$html = '<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th>No</th>
 <th>Nama</th>
 <th>Kelas</th>
 <th>Alamat</th>
 </tr>';
//pembuatan variabel bantuan nomer urut
$no = 1;
//looping untuk menuliskan isi dari tabel dalam database
while($row = mysqli_fetch_array($query))
{
	//penulisan variabel $html masih terhubung dengan sebelumnya karena diberikan .= sebagai operasi penggabungan string
 $html .= "<tr>
 <td>".$no."</td>
 <td>".$row['nama']."</td>
 <td>".$row['kelas']."</td>
 <td>".$row['alamat']."</td>
 </tr>";
 $no++;
}
$html .= "</html>";
//membuat tampilan web berupa pdf sesuai variabel yang telah tersimpan
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_siswa.pdf');
?>