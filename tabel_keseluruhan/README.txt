<?php
function hari_ini(){
    return $this->db->query("SELECT c.kode_barang, c.nama_barang, sum(a.jumlah_jual) as terjual, b.waktu_proses FROM `mu_transaksi_detail` a JOIN mu_transaksi b ON a.id_transaksi=b.id_transaksi JOIN mu_barang c ON a.id_barang=c.id_barang  where SUBSTR(b.waktu_proses, 1,10)=DATE(NOW()) GROUP BY c.id_barang");
}
 
function minggu_ini(){
    return $this->db->query("SELECT c.kode_barang, c.nama_barang, sum(a.jumlah_jual) as terjual, b.waktu_proses FROM `mu_transaksi_detail` a JOIN mu_transaksi b ON a.id_transaksi=b.id_transaksi JOIN mu_barang c ON a.id_barang=c.id_barang  where YEARWEEK(b.waktu_proses)=YEARWEEK(NOW()) GROUP BY c.id_barang");
}
 
function bulan_ini(){
    return $this->db->query("SELECT c.kode_barang, c.nama_barang, sum(a.jumlah_jual) as terjual, b.waktu_proses FROM `mu_transaksi_detail` a JOIN mu_transaksi b ON a.id_transaksi=b.id_transaksi JOIN mu_barang c ON a.id_barang=c.id_barang  where MONTH(b.waktu_proses)=MONTH(NOW()) GROUP BY c.id_barang");
}
 
function tahun_ini(){
    return $this->db->query("SELECT c.kode_barang, c.nama_barang, sum(a.jumlah_jual) as terjual, b.waktu_proses FROM `mu_transaksi_detail` a JOIN mu_transaksi b ON a.id_transaksi=b.id_transaksi JOIN mu_barang c ON a.id_barang=c.id_barang  where YEAR(b.waktu_proses)=YEAR(NOW()) GROUP BY c.id_barang");
}
?>