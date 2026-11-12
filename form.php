<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// INSERT DATA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor = $_POST['nomor'];
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    $jenis = $_POST['jenis'];
    $alamat = $_POST['alamat'];
    $pilihan = $_POST['pilihan'];
    $jarak = $_POST['jarak'];
    $kendaraan = $_POST['kendaraan'];

    $sql = "INSERT INTO signup (nomor, nama, asal, jenis, alamat, pilihan, jarak, kendaraan)
            VALUES ('$nomor','$nama','$asal','$jenis','$alamat','$pilihan','$jarak','$kendaraan')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIGN UP FOR NEW STUDENT</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body style="background:#0d570b;">

  <div class="wrapper">
    <div class="title" style="background:green; color: black;">
        <span>SIGN UP STUDENT</span>
    </div>

    <form action="form.php" method="POST">
      <div class="row">
        <input type="text" name="nomor" placeholder="Nomor Pendaftaran" required />
      </div>

      <div class="row">
        <input type="text" name="nama" placeholder="Nama Siswa" required />
      </div>

      <div class="row">
        <input type="text" name="asal" placeholder="Asal Sekolah" required />
      </div>

      <div class="row">
        <label for="jenis">Pilih Jenis Kelamin:</label>
        <select name="jenis" id="jenis">
            <option value="laki laki">Laki-Laki</option>
            <option value="perempuan">Perempuan</option>
        </select>
      </div>

      <div class="row">
        <input type="text" name="alamat" placeholder="Alamat Rumah" required />
      </div>

      <div class="row">
        <label for="pilihan">Prestasi:</label>
        <select name="pilihan" id="pilihan">
            <option value="akademik">Akademik</option>
            <option value="olahraga">Olahraga (Non-Akademik)</option>
        </select>
      </div>

      <div class="row">
        <input type="text" name="jarak" placeholder="Jarak Rumah ke Sekolah" required />
      </div>

      <div class="row">
        <label for="kendaraan">Kendaraan:</label>
        <select name="kendaraan" id="kendaraan">
            <option value="umum">Angkutan Umum</option>
            <option value="pribadi">Pribadi</option>
            <option value="sepeda">Sepeda</option>
        </select>
      </div>

      <div class="row button">
        <input type="submit" value="SUBMIT" style="background:green; color:black;" />
      </div>
    </form>
    <a href="web.php">BACK TO HOME</a>
    
    <h2 style="text-align:center; color:white; margin-top:40px;">DAFTAR PENDAFTAR</h2>
    <div style="width: 700px; margin-left:-100px; overflow-x:auto; background:#0f3d06; padding:20px; border-radius:10px; align-content:center; justify-content:center">
      <table border="1" align="center" cellpadding="10" cellspacing="0" style="width:100%; color:white; border-color:#1a1a1a; ">
        <tr style="background:green; color:black; font-weight:bold; text-align:center;">
          <th>No</th>
          <th>Nama</th>
          <th>Asal</th>
          <th>Jenis</th>
          <th>Alamat</th>
          <th>Prestasi</th>
          <th>Jarak</th>
          <th>Kendaraan</th>
        </tr>
      </div>
        
      <?php
      // SELECT DATA
      $result = $conn->query("SELECT * FROM signup ORDER BY nomor ASC");

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>".$row['nomor']."</td>
                    <td>".$row['nama']."</td>
                    <td>".$row['asal']."</td>
                    <td>".$row['jenis']."</td>
                    <td>".$row['alamat']."</td>
                    <td>".$row['pilihan']."</td>
                    <td>".$row['jarak']."</td>
                    <td>".$row['kendaraan']."</td>
                  </tr>";
          }
      } else {
          echo "<tr><td colspan='8' style='text-align:center;'>Belum ada pendaftar</td></tr>";
      }
      ?>
    </table>
  </div>

</body>
</html>

<?php
$conn->close();
?>
