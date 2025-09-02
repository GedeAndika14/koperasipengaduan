<?php
include "config.php";
header("Content-Type: application/json");

$aksi = $_GET["aksi"] ?? "";

if ($aksi=="list") {
    $res = $conn->query("SELECT * FROM pengaduan ORDER BY id DESC");
    $data=[];
    while($row=$res->fetch_assoc()){
        $row["riwayat"] = json_decode($row["riwayat"], true);
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}

if ($aksi=="add") {
    $tiket = $_POST["tiket"];
    $nama = $_POST["nama"];
    $nik = $_POST["nik"];
    $hp = $_POST["hp"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $jk = $_POST["jk"];
    $jenis = $_POST["jenis"];
    $prioritas = $_POST["prioritas"];
    $deskripsi = $_POST["deskripsi"];
    $lampiran = $_POST["lampiran"];
    $status = $_POST["status"];
    $tanggal = $_POST["tanggal"];
    $riwayat = $_POST["riwayat"];

    $stmt = $conn->prepare("INSERT INTO pengaduan 
        (tiket,nama,nik,hp,email,alamat,jk,jenis,prioritas,deskripsi,lampiran,status,tanggal,riwayat) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssssss", 
        $tiket,$nama,$nik,$hp,$email,$alamat,$jk,$jenis,$prioritas,$deskripsi,$lampiran,$status,$tanggal,$riwayat
    );
    $stmt->execute();
    echo json_encode(["success"=>true]);
    exit;
}

if ($aksi=="update") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $nik = $_POST["nik"];
    $hp = $_POST["hp"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $jenis = $_POST["jenis"];
    $prioritas = $_POST["prioritas"];
    $deskripsi = $_POST["deskripsi"];
    $status = $_POST["status"];
    $riwayat = $_POST["riwayat"];

    $stmt = $conn->prepare("UPDATE pengaduan SET 
        nama=?, nik=?, hp=?, email=?, alamat=?, jenis=?, prioritas=?, deskripsi=?, status=?, riwayat=? 
        WHERE id=?");
    $stmt->bind_param("ssssssssssi", 
        $nama,$nik,$hp,$email,$alamat,$jenis,$prioritas,$deskripsi,$status,$riwayat,$id
    );
    $stmt->execute();
    echo json_encode(["success"=>true]);
    exit;
}

if ($aksi=="delete") {
    $id = $_POST["id"];
    $conn->query("DELETE FROM pengaduan WHERE id=$id");
    echo json_encode(["success"=>true]);
    exit;
}
?>
