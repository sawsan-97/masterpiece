-- إنشاء جدول المستخدمين
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50),
  `last_name` varchar(50),
  `phone_number` varchar(20),
  `address` varchar(255),
  `city` varchar(50),
  `profile_image` varchar(255),
  `role` ENUM('customer', 'provider', 'admin') DEFAULT 'customer',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- إنشاء جدول فئات الخدمات
CREATE TABLE `service_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `icon` varchar(255),
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
);

-- إنشاء جدول الخدمات
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `base_price` decimal(10, 2) NOT NULL,
  `duration` int COMMENT 'مدة الخدمة بالدقائق',
  `image` varchar(255),
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `service_categories`(`id`) ON DELETE CASCADE
);

-- إنشاء جدول مزودي الخدمات
CREATE TABLE `providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `business_name` varchar(100),
  `bio` text,
  `is_verified` tinyint(1) DEFAULT 0,
  `avg_rating` decimal(3, 2) DEFAULT 0,
  `completed_jobs` int DEFAULT 0,
  `is_available` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- إنشاء جدول ساعات عمل مزودي الخدمات
CREATE TABLE `provider_working_hours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `day_of_week` int NOT NULL COMMENT '0 = الأحد، 6 = السبت',
  `start_time` time,
  `end_time` time,
  `is_working` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`provider_id`) REFERENCES `providers`(`id`) ON DELETE CASCADE
);

-- إنشاء جدول الخدمات التي يقدمها كل مزود
CREATE TABLE `provider_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `service_id` int NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`provider_id`) REFERENCES `providers`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE
);

-- إنشاء جدول الكوبونات
CREATE TABLE `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL UNIQUE,
  `discount_type` ENUM('percentage', 'fixed') NOT NULL,
  `discount_value` decimal(10, 2) NOT NULL,
  `min_order_value` decimal(10, 2) DEFAULT 0,
  `max_discount` decimal(10, 2),
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `usage_limit` int,
  `usage_count` int DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- إنشاء جدول الحجوزات
CREATE TABLE `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `provider_id` int NOT NULL,
  `service_id` int NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `special_instructions` text,
  `subtotal` decimal(10, 2) NOT NULL,
  `discount` decimal(10, 2) DEFAULT 0,
  `total_price` decimal(10, 2) NOT NULL,
  `coupon_id` int,
  `status` ENUM('pending', 'confirmed', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`provider_id`) REFERENCES `providers`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`coupon_id`) REFERENCES `coupons`(`id`) ON DELETE SET NULL
);

-- إنشاء جدول التقييمات
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `provider_id` int NOT NULL,
  `service_id` int NOT NULL,
  `rating` int NOT NULL CHECK (rating BETWEEN 1 AND 5),
  `comment` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`booking_id`),
  FOREIGN KEY (`booking_id`) REFERENCES `bookings`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`provider_id`) REFERENCES `providers`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE
);

-- إنشاء جدول الإشعارات
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `reference_id` int COMMENT 'معرف المرجع (مثلاً معرف الحجز)',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- إنشاء جدول لحفظ بيانات لوحة التحكم
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL UNIQUE,
  `setting_value` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- إدخال بيانات فئات الخدمات الأساسية
INSERT INTO `service_categories` (`name`, `description`, `icon`) VALUES
('Cleaning', 'Professional cleaning services for your home', 'cleaning-icon.png'),
('TV and Electronics', 'Installation and repair of TVs and electronics', 'electronics-icon.png'),
('Assembly', 'Assembly of furniture and other items', 'assembly-icon.png'),
('Plumbing', 'Professional plumbing services', 'plumbing-icon.png'),
('Painting', 'Interior and exterior painting services', 'painting-icon.png'),
('Moving', 'Help with moving and transportation', 'moving-icon.png');
