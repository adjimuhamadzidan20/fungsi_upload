<?php  
	// fungsi upload gambar
	function upload() {
		// mengambil data dari method $_FILES
		$namaFile 	= $_FILES['gambar']['name']; // nama file
		$ukuranFile = $_FILES['gambar']['size']; // ukuran file
		$errorFile 	= $_FILES['gambar']['error']; // error 0 = tidak ada error, error 4 = tidak ada file yg diupload
		$tempatFile = $_FILES['gambar']['tmp_name']; // lokasi file yang terupload (sementara)

		// cek jika gambar belum ter upload
		if ($errorFile === 4) {
			
			echo "
				<script>
					alert('Gambar belum diupload');
				</script>
			";

			// menyetop proses
			return false;
		}

		// cek jenis ext gambar yang diupload
		$extGambarValid = ['jpg', 'jpeg', 'png'];
		$extGambar = explode('.', $namaFile); // memecah sebuah string menjadi array
		$extGambar = strtolower(end($extGambar)); // mengkonversi ke lowercase & mengambil index terakhir dlm string

		if ( !in_array($extGambar, $extGambarValid) ) {
			echo "
				<script>
					alert('yang anda upload bukan file gambar');
				</script>
			";

			// menyetop proses
			return false;
		}

		// cek batas ukuran gambar ( 1 MB )
		if ( $ukuranFile > 1000000 ) {
			echo "
				<script>
					alert('ukuran gambar terlalu besar');
				</script>
			";

			// menyetop proses
			return false;
		}

		// generate nama file gambar baru
		$newNamaFile = uniqid(); // membangkitkan string random (angka)
		$newNamaFile .= '.'; // delimiter
		$newNamaFile .= $extGambar;

		// lulus pengecekan, gambar bisa diupload
		move_uploaded_file($tempatFile, 'gambar/' . $newNamaFile);

		// mengembalikan / menampilkan nama file gambar
		return $newNamaFile;
	}

?>