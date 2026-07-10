CREATE DATABASE IF NOT EXISTS kost_keluhan;
USE kost_keluhan;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user',
    no_kamar VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE keluhan (
    id_keluhan INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    fasilitas VARCHAR(100) NOT NULL,
    deskripsi TEXT NOT NULL,
    foto VARCHAR(255),
    prioritas ENUM('Normal','Penting') DEFAULT 'Normal',
    status ENUM('Pending','Diproses','Selesai') DEFAULT 'Pending',
    catatan_admin TEXT,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_user)
    REFERENCES users(id_user)
    ON DELETE CASCADE
);

CREATE TABLE notifikasi (
    id_notif INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    pesan TEXT NOT NULL,
    status_baca ENUM('Belum','Sudah') DEFAULT 'Belum',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_user)
    REFERENCES users(id_user)
    ON DELETE CASCADE
);