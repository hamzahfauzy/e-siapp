CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    opd_id INT DEFAULT NULL
);

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE role_routes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    route_path VARCHAR(100) NOT NULL,
    CONSTRAINT fk_role_routes_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    CONSTRAINT fk_user_roles_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_user_roles_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(100) NOT NULL,
    execute_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE opd (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kd_opd VARCHAR(100) NOT NULL,
    nm_opd VARCHAR(100) NOT NULL
);

CREATE TABLE prioritas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kd_prioritas VARCHAR(100) NOT NULL,
    nm_prioritas VARCHAR(100) NOT NULL
);

CREATE TABLE kegiatan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kd_kegiatan VARCHAR(100) NOT NULL,
    kd_prioritas VARCHAR(100) NOT NULL,
    program_prioritas VARCHAR(100) NOT NULL,
    total_target VARCHAR(100) NOT NULL,
    kegiatan_2021 VARCHAR(100) NOT NULL,
    target_2021 VARCHAR(100) NOT NULL,
    satuan_2021 VARCHAR(100) NOT NULL,
    opd_2021 VARCHAR(100) NOT NULL,
    kegiatan_2022 VARCHAR(100) NOT NULL,
    target_2022 VARCHAR(100) NOT NULL,
    satuan_2022 VARCHAR(100) NOT NULL,
    opd_2022 VARCHAR(100) NOT NULL,
    kegiatan_2023 VARCHAR(100) NOT NULL,
    target_2023 VARCHAR(100) NOT NULL,
    satuan_2023 VARCHAR(100) NOT NULL,
    opd_2023 VARCHAR(100) NOT NULL,
    kegiatan_2024 VARCHAR(100) NOT NULL,
    target_2024 VARCHAR(100) NOT NULL,
    satuan_2024 VARCHAR(100) NOT NULL,
    opd_2024 VARCHAR(100) NOT NULL,
    kegiatan_2025 VARCHAR(100) NOT NULL,
    target_2025 VARCHAR(100) NOT NULL,
    satuan_2025 VARCHAR(100) NOT NULL,
    opd_2025 VARCHAR(100) NOT NULL,
    kegiatan_2026 VARCHAR(100) NOT NULL,
    target_2026 VARCHAR(100) NOT NULL,
    satuan_2026 VARCHAR(100) NOT NULL,
    opd_2026 VARCHAR(100) NOT NULL
);

CREATE TABLE capaian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tahun VARCHAR(100) NOT NULL,
    bulan VARCHAR(100) NOT NULL,
    prioritas VARCHAR(100) NOT NULL,
    program_prioritas VARCHAR(100) NOT NULL,
    kegiatan VARCHAR(100) NOT NULL,
    target VARCHAR(100) NOT NULL,
    capaian_tahun_sebelumnya VARCHAR(100) NOT NULL,
    realisasi VARCHAR(100) NOT NULL,
    keterangan TEXT NOT NULL
);

