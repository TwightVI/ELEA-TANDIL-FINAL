CREATE DATABASE IF NOT EXISTS ecommerce_template
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE ecommerce_template;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(180) NOT NULL DEFAULT '',
  sort_order SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY categories_name_unique (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  category_id INT UNSIGNED NOT NULL,
  name VARCHAR(160) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(12,2) NOT NULL DEFAULT 0,
  image_url VARCHAR(2048) NOT NULL,
  is_featured TINYINT(1) NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY products_category_active (category_id, is_active),
  CONSTRAINT products_category_fk FOREIGN KEY (category_id) REFERENCES categories (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT INTO users (name, email, password_hash, role)
VALUES ('Administración', 'admin@eleaserimarket.com.ar', '$2y$10$kUsDWEYmYVlnmFDbhxRtR.hwL101d8.CHBtGx/.v8dV7a1M9MgGOy', 'admin')
ON DUPLICATE KEY UPDATE email = VALUES(email);

INSERT IGNORE INTO categories (name, description, sort_order) VALUES
('Vinilo de corte', 'Para diseños, cartelería y personalización', 1),
('Vidrios y ventanales', 'Esmerilados, polarizados y privacidad', 2),
('Vinilo vehicular', 'Materiales para personalización automotor', 3),
('Para el hogar', 'Placas y vinilos autoadhesivos decorativos', 4),
('Máquinas', 'Plotters y equipos para producción', 5),
('Textil', 'Materiales termotransferibles y DTF', 6),
('Herramientas', 'Complementos para instalación y trabajo', 7),
('Posicionadores y otros', 'Accesorios y materiales gráficos', 8);

INSERT INTO products (category_id, name, description, price, image_url, is_featured, is_active)
SELECT c.id, sample.name, sample.description, sample.price, sample.image_url, sample.is_featured, 1
FROM (
  SELECT 'Vinilo de corte' AS category, 'Vinilo McCal brillante por metro' AS name, 'Vinilo autoadhesivo para corte, rotulación y señalética.' AS description, 8500.00 AS price, 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=900&q=80' AS image_url, 1 AS is_featured
  UNION ALL SELECT 'Vidrios y ventanales', 'Vinilo esmerilado liso', 'Privacidad y terminación mate para vidrios y ventanales.', 12500.00, 'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&w=900&q=80', 1
  UNION ALL SELECT 'Textil', 'Vinilo termotransferible textil', 'Material flexible para personalización de prendas.', 9900.00, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=900&q=80', 1
  UNION ALL SELECT 'Herramientas', 'Espátula aplicadora', 'Herramienta de aplicación para vinilos y films.', 4500.00, 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?auto=format&fit=crop&w=900&q=80', 0
  UNION ALL SELECT 'Vinilo vehicular', 'Film para personalización vehicular', 'Film autoadhesivo para detalles y proyectos de personalización.', 18400.00, 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=900&q=80', 0
  UNION ALL SELECT 'Máquinas', 'Plotter de corte compacto', 'Equipo de corte para proyectos creativos y producción gráfica.', 428000.00, 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=900&q=80', 1
  UNION ALL SELECT 'Para el hogar', 'Placa autoadhesiva decorativa', 'Superficie decorativa autoadhesiva para renovar ambientes.', 14500.00, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=900&q=80', 0
  UNION ALL SELECT 'Posicionadores y otros', 'Cinta de posicionamiento', 'Accesorio para aplicar vinilos con mayor precisión.', 3700.00, 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?auto=format&fit=crop&w=900&q=80', 0
) AS sample
INNER JOIN categories c ON c.name = sample.category
WHERE NOT EXISTS (SELECT 1 FROM products existing WHERE existing.name = sample.name);
