-- Create Anggota table
CREATE TABLE IF NOT EXISTS Anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Create Buku_Request table
CREATE TABLE IF NOT EXISTS Buku_Request (
    id_buku_request INT AUTO_INCREMENT PRIMARY KEY,
    id_anggota INT,
    judul_buku VARCHAR(255) NOT NULL,
    edisi_tahun VARCHAR(20),
    penerbit VARCHAR(100),
    pengarang VARCHAR(100),
    jenis_buku VARCHAR(50),
    link_beli VARCHAR(255),
    tanggal_request DATE,
    status ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
    FOREIGN KEY (id_anggota) REFERENCES Anggota(id_anggota)
);

-- Create Dosen table
CREATE TABLE IF NOT EXISTS Dosen (
    id_dosen INT AUTO_INCREMENT PRIMARY KEY,
    nama_dosen VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Create Request_Cetak_Modul table
CREATE TABLE IF NOT EXISTS Request_Cetak_Modul (
    request_cetak_id INT AUTO_INCREMENT PRIMARY KEY,
    id_dosen INT,
    judul_modul VARCHAR(255) NOT NULL,
    tanggal_request DATE,
    dokumen_pendukung TEXT,
    jumlah_cetak INT,
    status ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);

-- Create Request_Modul table
CREATE TABLE IF NOT EXISTS Request_Modul (
    request_update_id INT AUTO_INCREMENT PRIMARY KEY,
    id_dosen INT,
    judul_modul VARCHAR(255) NOT NULL,
    tanggal_request DATE,
    dokumen_pendukung TEXT,
    status ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);

-- Create Staff_Perpustakaan table
CREATE TABLE IF NOT EXISTS Staff_Perpustakaan (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    nama_staff VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Create Notifikasi_Request_Modul table
CREATE TABLE IF NOT EXISTS Notifikasi_Request_Modul (
    id_notifikasi INT AUTO_INCREMENT PRIMARY KEY,
    request_cetak_id INT,
    request_update_id INT,
    staff_id INT,
    waktu_notifikasi DATETIME,
    tipe_request ENUM('cetak', 'update'),
    status_request ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
    FOREIGN KEY (request_cetak_id) REFERENCES Request_Cetak_Modul(request_cetak_id),
    FOREIGN KEY (request_update_id) REFERENCES Request_Modul(request_update_id),
    FOREIGN KEY (staff_id) REFERENCES Staff_Perpustakaan(staff_id)
);

