    <?php
    require_once "data_barang.php";
    require 'header.php';
    $dataBarang = new DataBarang();

    // Inisialisasi variabel
    $id = "";
    $gambar = "";
    $nama = "";
    $kategori = "";
    $harga_beli = "";
    $harga_jual = "";
    $stok = "";

    // Cek apakah ada data yang dikirimkan melalui URL (untuk edit)
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $barang = $dataBarang->getAllDataBarang($id)[0];
        if ($barang) {
            $gambar = $barang['gambar'];
            $nama = $barang['nama'];
            $kategori = $barang['kategori'];
            $harga_beli = $barang['harga_beli'];
            $harga_jual = $barang['harga_jual'];
            $stok = $barang['stok'];
        }
    }

    // Proses form jika tombol submit ditekan
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $gambar = $_POST['gambar'];
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];

        // Cek apakah id ada, jika ada berarti edit data barang, jika tidak ada berarti tambah data barang
        if (!empty($id)) {
            // Edit data barang
            $result = $dataBarang->updateDataBarang($id, $gambar, $nama, $kategori, $harga_beli, $harga_jual, $stok);
            if ($result) {
                header("Location: index.php");
                exit;
            }
        } else {
            // Tambah data barang
            $result = $dataBarang->InsertDataBarang($gambar, $nama, $kategori, $harga_beli, $harga_jual, $stok);
            if ($result) {
                header("Location: index.php");
                exit;
            }
        }
    }
    ?>

    <h1 class="judul">Form Barang</h1>
    <div class="container-form">
        <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <label>Gambar:</label>
            <input type="file" name="gambar" value="<?php echo $gambar; ?>"><br>
            <br><label>Nama:</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
            <br><label>Kategori:</label>

            <input type="text" name="kategori" value="<?php echo $kategori; ?>"><br>
            <br><label>Harga Beli:</label>
            <input type="text" name="harga_beli" value="<?php echo $harga_beli; ?>"><br>
            <br><label>Harga Jual:</label>
            <input type="text" name="harga_jual" value="<?php echo $harga_jual; ?>"><br>
            <br><label>Stok:</label>
            <input type="text" name="stok" value="<?php echo $stok; ?>"><br><br><br>
            <input type="submit" name="submit" value="Simpan" class="tambah tombol">
            <a href="index.php" class="tambah tombol">Kembali</a>
        </form>
        
    </div>
    <?php require 'footer.php'; ?>