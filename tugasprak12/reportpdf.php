<?php
							//metode import file element dompdf yang dibutuhkan 
							include('koneksi.php');
							require_once("dompdf/autoload.inc.php");
							use Dompdf\Dompdf;
							//membuat instance dompdf baru
							$dompdf = new Dompdf(); 
							//query pemanggilan dari database
							$query = mysqli_query($koneksi,"select * from pendaftaran_siswa");
							//pembuatan variabel html bersambung yang akan dimunculkan pada laman
							$html = '<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
							$html .= '<table border="1" width="100%">
							 <tr>
							 <th>No</th>
							<th>Nomer Pendaftaran</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>NISN</th>
							<th>NIK</th>
							<th>Tempat Kelahiran</th>
							<th>Tanggal Lahir</th>
							<th>No. Akta Kelahiran</th>
							<th>Agama</th>
							<th>Kewarganegaraan</th>
							<th>Kebutuhan Khusus</th>
							<th>Alamat</th>
							<th>RT</th>
							<th>RW</th>
							<th>Dusun</th>
							<th>Kelurahan</th>
							<th>Kecamatan</th>
							<th>Kode Pos</th>
							<th>Lintang</th>
							<th>Bujur</th>
							<th>Tempat Tinggal</th>
							<th>Moda Transportasi</th>
							<th>No. KKS</th>
							<th>Anak ke</th>
							<th>Ada KPS ?</th>
							<th>No. KPS/PKH</th>
							</tr>';
							$query = mysqli_query($koneksi,"select * from pendaftaran_siswa");
							//variabel bantuan nomor urut
							$no = 1;
							//mengatur agar tanggal dapat tertulis sesuai standar indonesia dipisahkan dengan tanda pisah per indeks.
							$bulan  = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
							//looping 
							while($row = mysqli_fetch_array($query))
							{
								//mengatur agar tanggal dapat tertulis sesuai standar indonesia dipisahkan dengan tanda pisah per indeks.
								$tgl  = explode('-', $row['tgl_lhr']);
										//memasukkan isi dari database ke dalam file excel sesuai tabel yang ditentukan database
							 //memasukkan isi dari database ke dalam file excel sesuai tabel yang ditentukan database
							$html .= "<tr>
								<th>".$no."</th>
								<th>".$row[0]."</th>
								<th>".$row[1]."</th>
								<th>".$row[2]."</th>
								<th>".$row[3]."</th>
								<th>".$row[4]."</th>
								<th>".$row[5]."</th>
								<th>".$tgl[2] .' '.$bulan[(int)$tgl[1]]. ' '.$tgl[0]."</th>
								<th>".$row[7]."</th>
								<th>".$row[8]."</th>
								<th>".$row[9]."</th>
								<th>".$row[10]."</th>
								<th>".$row[11]."</th>
								<th>".$row[12]."</th>
								<th>".$row[13]."</th>
								<th>".$row[14]."</th>
								<th>".$row[15]."</th>
								<th>".$row[16]."</th>
								<th>".$row[17]."</th>
								<th>".$row[18]."</th>
								<th>".$row[19]."</th>
								<th>".$row[20]."</th>
								<th>".$row[21]."</th>
								<th>".$row[22]."</th>
								<th>".$row[23]."</th>
								<th>".$row[24]."</th>
								<th>".$row[25]."</th>
							 </tr>";
							 $no++;
							}
							$html .= "</html>";
							//membuat tampilan web berupa pdf sesuai variabel yang telah tersimpan
							$dompdf->loadHtml($html);
							// Setting ukuran dan orientasi kertas
							$dompdf->setPaper('A1', 'landscape');
							// Rendering dari HTML Ke PDF
							$dompdf->render();
							// Melakukan output file Pdf
							$dompdf->stream('Report_Data_Pendaftaran_Siswa.pdf');
							
							// echo "<script>window.alert('Data berhasil di export ke C:/xampp/hthocs/reportpdf/tugasprak12/Report Data Pendaftaran Siswa.pdf');</script>"; 
?>