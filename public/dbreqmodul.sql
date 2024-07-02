-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 25 Jun 2024 pada 02.44
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbreqmodul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_anggota_request` varchar(16) DEFAULT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `edisi_tahun` varchar(20) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `jenis_buku` varchar(50) DEFAULT NULL,
  `link_beli` varchar(255) DEFAULT NULL,
  `perkiraan_harga` int(11) DEFAULT NULL,
  `tanggal_request` date DEFAULT NULL,
  `status` enum('pending','diterima','ditolak','proses eksekusi','sudah dieksekusi') NOT NULL DEFAULT 'pending',
  `tanggal_verifikasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_anggota_request`, `judul_buku`, `edisi_tahun`, `penerbit`, `pengarang`, `jenis_buku`, `link_beli`, `perkiraan_harga`, `tanggal_request`, `status`, `tanggal_verifikasi`) VALUES
(207, '1083701898753437', 'Quo deleniti qui voluptatem.', '2008', 'Doyle LLC', 'Elizabeth Rath', 'Hobi', 'https://wunsch.com/ad-eum-excepturi-dicta-deleniti-eos-sed.html', 182655, '1972-03-15', 'pending', NULL),
(208, '1083701898753437', 'Quam velit maxime.', '1999', 'Brekke-McCullough', 'Mrs. Delores Hamill', 'Refrensi', 'http://berge.net/', 123170, '1997-01-25', 'pending', NULL),
(209, '1083701898753437', 'Sint adipisci quasi.', '2011', 'Connelly-Auer', 'Beau Torp', 'Hobi', 'http://shields.com/', 145607, '2004-06-10', 'pending', NULL),
(210, '1083701898753437', 'Rem doloremque voluptatem aut.', '2012', 'McGlynn-Satterfield', 'Elwin Koss Sr.', 'Refrensi', 'http://www.krajcik.net/quidem-sapiente-ipsa-non', 156918, '2004-06-21', 'pending', NULL),
(211, '1083701898753437', 'Dolore aliquam ipsum voluptate.', '2012', 'Heaney-DuBuque', 'Larry Kessler', 'Hobi', 'https://www.ohara.net/dicta-rerum-id-ipsa-tempora-ut', 50473, '1970-03-14', 'pending', NULL),
(212, '1083701898753437', 'Laudantium similique consectetur doloribus quo.', '2018', 'Nolan-Brakus', 'Prof. Coy Ankunding V', 'Hobi', 'http://powlowski.net/ipsum-non-illum-sint-quis', 138530, '1976-07-05', 'pending', NULL),
(213, '1083701898753437', 'Quia voluptas laudantium eligendi repudiandae.', '1995', 'Ferry PLC', 'Dakota Hirthe', 'Hobi', 'http://www.dibbert.com/', 136062, '1997-09-28', 'pending', NULL),
(214, '1083701898753437', 'Nihil ut dignissimos.', '2000', 'Kunde, Schumm and Roob', 'Pierce Toy', 'Hobi', 'http://marvin.com/', 186950, '1972-12-02', 'pending', NULL),
(215, '1083701898753437', 'Dolor molestias.', '1991', 'Osinski, Hegmann and Feeney', 'Prof. Martina Kuvalis PhD', 'Refrensi', 'http://leuschke.com/et-voluptatem-aliquam-exercitationem-aspernatur-ut-incidunt-est-ipsum', 239577, '2017-04-24', 'pending', NULL),
(216, '1083701898753437', 'Possimus voluptatum.', '2003', 'Turcotte Group', 'Billie Gusikowski', 'Hobi', 'https://www.smith.com/neque-debitis-rerum-voluptatum-voluptatem', 86954, '2017-12-23', 'pending', NULL),
(217, '1083701898753437', 'Ab soluta perspiciatis.', '1997', 'Mosciski-Lind', 'Loyce Rempel', 'Refrensi', 'https://cremin.org/cupiditate-rem-accusamus-et-officiis-dolores-aperiam-aut.html', 163246, '2005-11-03', 'pending', NULL),
(218, '1083701898753437', 'Animi et occaecati quisquam.', '2015', 'Lehner PLC', 'Prof. Kamryn Skiles PhD', 'Refrensi', 'http://www.bins.com/accusantium-aut-inventore-sunt-in', 239095, '1978-03-26', 'pending', NULL),
(219, '1083701898753437', 'Incidunt dolorem.', '1996', 'Ledner, Kessler and Morar', 'Abraham Champlin MD', 'Refrensi', 'http://www.hodkiewicz.com/', 167444, '2022-07-24', 'pending', NULL),
(220, '1083701898753437', 'Dicta animi voluptas.', '1992', 'Feeney LLC', 'Roselyn Balistreri', 'Refrensi', 'http://www.ruecker.com/', 250324, '2012-02-28', 'pending', NULL),
(221, '1083701898753437', 'Voluptatibus et aut.', '1990', 'Wilkinson, Hudson and Roob', 'Dr. Sincere Wolff', 'Refrensi', 'http://www.casper.com/quisquam-fugiat-aut-officiis-cumque-quia-odio-quia-eveniet', 135261, '2009-03-28', 'pending', NULL),
(222, '1083701898753437', 'Voluptatem quae eos et.', '2014', 'Bogan, Feest and Will', 'Mr. Haley Lowe', 'Refrensi', 'http://www.torp.com/quasi-occaecati-at-autem-minus-distinctio.html', 131424, '2023-10-31', 'pending', NULL),
(223, '1083701898753437', 'Esse facere quia et.', '2002', 'Osinski, Sawayn and Luettgen', 'Mrs. Jackie Crist DVM', 'Refrensi', 'http://www.brakus.biz/', 64925, '2023-03-27', 'pending', NULL),
(224, '1083701898753437', 'Itaque vero officiis deleniti cumque.', '2020', 'DuBuque Ltd', 'Dr. Lenora Shanahan III', 'Refrensi', 'https://abernathy.com/assumenda-non-eum-debitis-error-quia-itaque.html', 106665, '2014-01-01', 'pending', NULL),
(225, '1083701898753437', 'Quis unde molestiae suscipit.', '1998', 'Padberg and Sons', 'Jacinthe Fritsch', 'Hobi', 'http://eichmann.com/et-et-omnis-incidunt-perferendis-voluptas-inventore-id.html', 152940, '2007-11-01', 'pending', NULL),
(226, '1083701898753437', 'Aut sed voluptatibus.', '2021', 'Kerluke, Morissette and Smith', 'Henri Emard', 'Refrensi', 'https://gibson.biz/velit-debitis-et-voluptas-exercitationem-vero-distinctio.html', 176028, '1972-08-26', 'pending', NULL),
(227, '1083701898753437', 'Quo consequatur in in.', '1994', 'Anderson LLC', 'Rachelle Gutkowski', 'Hobi', 'http://www.pouros.info/ipsa-voluptatem-enim-quis-incidunt-consequatur.html', 175661, '1991-12-09', 'pending', NULL),
(228, '1083701898753437', 'Ut suscipit qui est.', '1996', 'Gorczany LLC', 'Eino Pagac', 'Hobi', 'https://bergnaum.info/iusto-nam-dolor-dolores-et-porro.html', 157443, '1978-12-16', 'pending', NULL),
(229, '1083701898753437', 'Rerum mollitia aliquam.', '2023', 'Wunsch-Rodriguez', 'Prof. Jettie Hill', 'Hobi', 'http://reynolds.com/sed-deleniti-possimus-explicabo-nihil-explicabo-architecto', 277323, '1998-10-18', 'pending', NULL),
(230, '1083701898753437', 'Aliquam consequuntur tempora numquam.', '2003', 'Hills Group', 'Santa Ortiz Sr.', 'Hobi', 'http://www.cummings.info/', 91017, '2010-07-15', 'pending', NULL),
(231, '1083701898753437', 'Qui repudiandae et.', '1993', 'Runte, Brown and Hagenes', 'Mr. Horacio Torphy DDS', 'Refrensi', 'http://kuhlman.biz/necessitatibus-asperiores-nihil-ratione.html', 236334, '2014-07-29', 'pending', NULL),
(232, '1083701898753437', 'Error dicta.', '1998', 'Christiansen-Waelchi', 'Emma Schimmel', 'Hobi', 'http://www.gutmann.com/beatae-consequatur-aliquid-praesentium-enim-ut-atque', 101088, '1986-06-24', 'pending', NULL),
(233, '1083701898753437', 'Nam in repellat.', '1999', 'Littel, Volkman and Kuvalis', 'Vella Stracke', 'Refrensi', 'http://www.dicki.com/quo-amet-architecto-suscipit', 128841, '1994-01-01', 'pending', NULL),
(234, '1083701898753437', 'Sit sunt optio autem.', '2017', 'Sauer PLC', 'Ms. Estelle Schmeler DVM', 'Hobi', 'http://muller.com/animi-nihil-optio-quia-quo-quia-quia-similique.html', 127840, '2023-01-08', 'pending', NULL),
(235, '1083701898753437', 'Cum aperiam architecto vitae.', '2001', 'Murazik LLC', 'Victoria Sauer PhD', 'Hobi', 'http://www.hackett.org/nemo-explicabo-quia-sunt-dicta-eius-deleniti-soluta-mollitia.html', 240809, '1980-05-31', 'pending', NULL),
(236, '1083701898753437', 'Quae omnis exercitationem recusandae.', '1996', 'Haley PLC', 'Catherine Bartoletti', 'Hobi', 'http://www.mcglynn.com/', 101481, '1992-05-19', 'pending', NULL),
(237, '1083701898753437', 'Odit enim aperiam.', '1991', 'Ryan Ltd', 'Miss Meta Grant DVM', 'Refrensi', 'http://haag.com/doloribus-dicta-id-dolorem-et-sunt-consequatur-quod.html', 117904, '1986-04-30', 'pending', NULL),
(238, '1083701898753437', 'Iusto facilis deleniti.', '1993', 'Schneider, Kohler and Goodwin', 'Mylene Morissette', 'Hobi', 'https://monahan.com/labore-facilis-perspiciatis-ad-incidunt-molestias-sunt.html', 197884, '1983-04-24', 'pending', NULL),
(239, '1083701898753437', 'Ex est similique.', '2004', 'O\'Kon, Hauck and Upton', 'Mr. Quentin Hahn I', 'Refrensi', 'http://kunde.org/rerum-tempore-aliquam-doloremque-minus', 262585, '1978-03-11', 'pending', NULL),
(240, '1083701898753437', 'Distinctio et culpa consequatur.', '2017', 'Howell-Borer', 'Isabell Abbott Jr.', 'Hobi', 'https://murphy.com/eligendi-ullam-aut-doloremque-sunt-tempora-porro-dolorem.html', 53117, '2008-01-10', 'pending', NULL),
(241, '1083701898753437', 'Blanditiis eos sit.', '2017', 'Schaefer Inc', 'Prof. Elfrieda Harvey Sr.', 'Hobi', 'https://jerde.org/sunt-voluptatum-accusantium-ipsam-quasi-aut-a.html', 166879, '1999-05-27', 'pending', NULL),
(242, '1083701898753437', 'Et sapiente quidem.', '2023', 'Koch-Steuber', 'Breanne Satterfield', 'Refrensi', 'https://rath.com/illum-et-voluptatem-quam-dolorum-sunt-velit-quibusdam-praesentium.html', 262873, '2004-02-13', 'pending', NULL),
(243, '1083701898753437', 'Voluptate ut eum.', '1992', 'Goldner, Schimmel and Leannon', 'Dr. Nettie Kshlerin Jr.', 'Refrensi', 'http://www.schneider.com/ea-maxime-mollitia-recusandae-qui-blanditiis-qui-et-eum.html', 223324, '2023-01-28', 'pending', NULL),
(244, '1083701898753437', 'Recusandae qui doloremque.', '2009', 'Gottlieb LLC', 'Garrett Klocko DVM', 'Refrensi', 'http://fahey.com/aut-aut-dolorum-possimus-corporis.html', 72224, '1988-05-08', 'pending', NULL),
(245, '1083701898753437', 'Saepe sed quasi.', '2016', 'Ernser-Hansen', 'Prof. Caroline Jaskolski', 'Refrensi', 'http://www.williamson.info/fugiat-placeat-omnis-quia-consequatur', 224746, '1995-11-06', 'pending', NULL),
(246, '1083701898753437', 'Autem nisi sapiente aliquam.', '2001', 'Hills-Thompson', 'Rosendo Heidenreich', 'Hobi', 'http://www.hartmann.com/', 235033, '1998-07-09', 'pending', NULL),
(247, '1083701898753437', 'Quia ut quaerat aperiam.', '1990', 'Rippin-Dicki', 'Dr. Nora McGlynn MD', 'Hobi', 'https://www.schowalter.net/molestiae-reprehenderit-ullam-quibusdam-voluptas-hic', 172059, '2008-07-25', 'pending', NULL),
(248, '1083701898753437', 'Tenetur quis exercitationem.', '1996', 'Stamm Ltd', 'Dr. Maynard Cronin', 'Refrensi', 'http://www.carter.com/repudiandae-quibusdam-occaecati-et', 226530, '1986-09-02', 'pending', NULL),
(249, '1083701898753437', 'Minus est.', '1996', 'Wintheiser-Brekke', 'Jovany Hauck', 'Hobi', 'http://www.schmitt.com/quo-velit-sapiente-nisi-dolorum-itaque-eum.html', 179511, '2003-05-12', 'pending', NULL),
(250, '1083701898753437', 'Facere at velit eum.', '1991', 'Heaney, Medhurst and Fritsch', 'Gunner Kshlerin', 'Refrensi', 'http://hegmann.info/', 107433, '1988-09-11', 'pending', NULL),
(251, '1083701898753437', 'Asperiores quaerat odio.', '2023', 'Gulgowski, Klocko and Roberts', 'Abraham Pfeffer', 'Hobi', 'http://www.mccullough.org/iure-dignissimos-ea-numquam-voluptas', 87463, '2014-06-07', 'pending', NULL),
(252, '1083701898753437', 'Ut incidunt aperiam modi ratione.', '2024', 'Jakubowski Ltd', 'Jaquelin Rath', 'Hobi', 'http://hyatt.com/', 214180, '1972-04-05', 'pending', NULL),
(253, '1083701898753437', 'Ex omnis sapiente.', '2014', 'Mills Inc', 'Crystel Boyle', 'Refrensi', 'http://schmitt.com/quasi-in-voluptatum-omnis-quia-vitae-tempora.html', 148203, '2012-08-14', 'pending', NULL),
(254, '1083701898753437', 'Dolore quod molestias sit.', '1996', 'Durgan, Becker and Flatley', 'Wilfred Toy', 'Refrensi', 'http://www.buckridge.com/', 69273, '1975-11-25', 'pending', NULL),
(255, '1083701898753437', 'Ut commodi officia et.', '2003', 'Metz, Fisher and Welch', 'Olen Weissnat', 'Hobi', 'http://www.johns.com/', 169276, '1991-06-15', 'pending', NULL),
(256, '1083701898753437', 'Cumque esse eos.', '2012', 'Rice LLC', 'Reilly Auer', 'Refrensi', 'http://beer.com/magni-enim-quas-veritatis-enim-culpa', 207790, '2008-10-06', 'pending', NULL),
(257, '1083701898753437', 'Et quis eos quasi.', '2002', 'Bernier Inc', 'Mr. Fritz Mante', 'Refrensi', 'http://www.kub.org/quia-modi-saepe-perferendis-vel-libero-labore-voluptas', 173269, '1991-07-16', 'pending', NULL),
(258, '1083701898753437', 'Earum quaerat eligendi.', '1992', 'Schulist-Christiansen', 'Lea Herzog', 'Refrensi', 'http://huel.com/blanditiis-sed-labore-aliquam-impedit-possimus-dolorem', 127577, '1995-12-03', 'pending', NULL),
(259, '1083701898753437', 'Voluptate quas quisquam quam.', '1995', 'Fisher, Heidenreich and Rempel', 'Prof. Frances Schinner', 'Hobi', 'http://oberbrunner.net/deserunt-ea-laboriosam-quibusdam-ipsa-consequuntur-sunt', 242604, '1977-04-07', 'pending', NULL),
(260, '1083701898753437', 'Qui consequatur voluptatibus.', '1997', 'Donnelly-Veum', 'Miss Dortha Nikolaus', 'Refrensi', 'http://www.will.com/dolorem-repellat-earum-facere-quo-pariatur.html', 226280, '1973-09-04', 'pending', NULL),
(261, '1083701898753437', 'Aliquid soluta a cumque maxime.', '2011', 'Johnston Group', 'Miss Mafalda Wiegand', 'Hobi', 'http://schneider.com/molestiae-officia-animi-sit-rerum.html', 157977, '2019-01-15', 'pending', NULL),
(262, '1083701898753437', 'In laudantium deserunt id.', '2024', 'Mayer-Tillman', 'Will Kuhlman', 'Hobi', 'http://www.schuppe.biz/', 148233, '2018-06-12', 'pending', NULL),
(263, '1083701898753437', 'Quia veritatis sint pariatur.', '1992', 'Daugherty-Morar', 'Mrs. Kayli Bayer', 'Hobi', 'http://okeefe.com/labore-facere-accusantium-qui-fugiat-tempore.html', 176695, '2021-09-10', 'pending', NULL),
(264, '1083701898753437', 'Quibusdam saepe dolorem fugit.', '1999', 'Ledner-Boyle', 'Henriette Ebert', 'Hobi', 'http://schinner.com/', 159780, '2008-05-03', 'pending', NULL),
(265, '1083701898753437', 'Sint officia suscipit et.', '2018', 'Gleason-Cormier', 'Prof. Rocio Block', 'Refrensi', 'https://mueller.org/possimus-ea-assumenda-in-asperiores-nam-et-necessitatibus.html', 65733, '2018-05-17', 'pending', NULL),
(266, '1083701898753437', 'Optio sapiente et eum.', '2015', 'Johnson and Sons', 'Lela Jast', 'Refrensi', 'https://www.rogahn.com/esse-totam-qui-omnis-suscipit-qui-atque-eaque', 147314, '1990-04-09', 'pending', NULL),
(267, '1083701898753437', 'Unde est et.', '1993', 'Douglas-Kunde', 'Dr. Bertha Leuschke', 'Hobi', 'http://www.toy.org/veniam-magnam-quia-ut-quis', 236696, '1994-03-16', 'pending', NULL),
(268, '1083701898753437', 'Ad aperiam optio.', '2012', 'Moore Ltd', 'Cade Gusikowski', 'Refrensi', 'http://www.green.com/', 164691, '1978-06-29', 'pending', NULL),
(269, '1083701898753437', 'Beatae reprehenderit voluptates.', '2023', 'Erdman Group', 'Alyce Roob', 'Hobi', 'https://www.lemke.net/id-et-molestiae-nesciunt-libero', 260958, '1971-10-09', 'pending', NULL),
(270, '1083701898753437', 'Quod consequatur sed.', '1991', 'Beier-Shields', 'Prof. Myrtie Langosh V', 'Refrensi', 'http://www.nicolas.com/sit-architecto-repellendus-adipisci-praesentium-explicabo', 119657, '1975-01-30', 'pending', NULL),
(271, '1083701898753437', 'Error velit aspernatur.', '2002', 'Bergnaum LLC', 'Cassidy Thiel', 'Refrensi', 'http://larkin.com/harum-et-explicabo-ut', 288210, '2015-09-19', 'pending', NULL),
(272, '1083701898753437', 'Laudantium dolorum beatae beatae.', '2013', 'Stehr Inc', 'Johnnie Bosco', 'Hobi', 'http://oconner.info/voluptatem-rerum-est-odit.html', 73411, '2017-08-25', 'pending', NULL),
(273, '1083701898753437', 'Quaerat veritatis ea.', '1996', 'Koelpin Ltd', 'Frederique Smitham', 'Hobi', 'http://goldner.com/', 210979, '2012-04-12', 'pending', NULL),
(274, '1083701898753437', 'Possimus beatae earum magni.', '1997', 'Reichert-Bartoletti', 'Ms. Olga Schowalter', 'Refrensi', 'http://www.rosenbaum.com/ut-quo-voluptas-qui-libero-perferendis-dolorem-sed', 187824, '1982-06-20', 'pending', NULL),
(275, '1083701898753437', 'Commodi ipsa et minus.', '2005', 'Zemlak-Rempel', 'Alford Koelpin', 'Refrensi', 'http://crist.com/', 277391, '1986-10-10', 'pending', NULL),
(276, '1083701898753437', 'Voluptatem quia adipisci.', '2002', 'Hodkiewicz-O\'Reilly', 'Prof. Tyree Harber II', 'Hobi', 'http://www.mcglynn.biz/molestiae-possimus-architecto-et-in-ea', 281390, '1986-11-04', 'pending', NULL),
(277, '1083701898753437', 'Et tempora.', '2017', 'Mitchell-Lebsack', 'Emie O\'Connell', 'Refrensi', 'http://boyle.biz/nobis-omnis-et-quod-quia', 204926, '2014-01-02', 'pending', NULL),
(278, '1083701898753437', 'Saepe voluptas.', '1991', 'Murazik-Grant', 'Tad Fahey', 'Refrensi', 'http://www.hahn.com/dolor-consequatur-mollitia-quia-dicta-occaecati-omnis-vero', 148642, '1972-06-28', 'pending', NULL),
(279, '1083701898753437', 'Cumque ut nemo quo.', '1993', 'Paucek, Hickle and Stoltenberg', 'Adrienne Keebler', 'Refrensi', 'http://www.orn.com/', 75991, '2005-10-12', 'pending', NULL),
(280, '1083701898753437', 'Qui voluptatibus magnam.', '2005', 'Cummings, Luettgen and Kerluke', 'Prof. Berry Towne DVM', 'Hobi', 'http://www.weber.info/autem-sequi-nulla-enim-nam-voluptatem-expedita-fuga', 229185, '2007-11-03', 'pending', NULL),
(281, '1083701898753437', 'Consequuntur est aut.', '2023', 'Price-Wiza', 'Prof. Napoleon Upton I', 'Hobi', 'https://friesen.info/nam-explicabo-autem-rem-delectus-id-modi-rem.html', 269040, '1982-09-23', 'pending', NULL),
(282, '1083701898753437', 'Sapiente atque veritatis.', '1993', 'Hudson-Gusikowski', 'Gabriel Lang', 'Refrensi', 'http://prohaska.biz/id-ad-ut-recusandae-maxime.html', 159782, '2004-10-21', 'pending', NULL),
(283, '1083701898753437', 'Sequi necessitatibus officiis.', '2011', 'Bauch-Cassin', 'Elise Reynolds', 'Refrensi', 'http://www.hagenes.com/', 81689, '2014-02-17', 'pending', NULL),
(284, '1083701898753437', 'Sed et fuga.', '2002', 'Pouros, Emard and Yost', 'Everardo Wuckert', 'Refrensi', 'http://www.bradtke.com/animi-occaecati-ut-libero-nostrum-quia-aut-rem.html', 197911, '2010-05-18', 'pending', NULL),
(285, '1083701898753437', 'Quia ullam blanditiis quisquam.', '2000', 'Wunsch Ltd', 'Maximus Heidenreich', 'Hobi', 'http://pouros.info/eos-voluptas-itaque-mollitia-eos', 211514, '2019-10-19', 'pending', NULL),
(286, '1083701898753437', 'Pariatur pariatur voluptatem.', '2004', 'Jacobs-Schneider', 'Dr. Nathaniel Schmeler', 'Refrensi', 'http://www.zulauf.info/eos-eligendi-et-tenetur-et-dolorem-consequatur-itaque', 278145, '1972-06-15', 'pending', NULL),
(287, '1083701898753437', 'Quis officiis sunt a.', '2010', 'Thiel Inc', 'Amy Dickens', 'Refrensi', 'http://www.hettinger.biz/quas-culpa-adipisci-ut-libero-amet-facere', 285327, '2002-07-18', 'pending', NULL),
(288, '1083701898753437', 'Aliquam aliquam rerum.', '2022', 'Kertzmann Ltd', 'Drake Tillman', 'Refrensi', 'http://mckenzie.com/', 168348, '2007-10-15', 'pending', NULL),
(289, '1083701898753437', 'Suscipit recusandae optio.', '2002', 'Krajcik, Zieme and Gibson', 'Dee Kuhlman', 'Refrensi', 'http://windler.com/ut-accusamus-quia-voluptatum-voluptates-voluptas-adipisci', 73669, '2021-05-18', 'pending', NULL),
(290, '1083701898753437', 'Quia dignissimos voluptas aliquam.', '2003', 'Murphy Inc', 'Mr. Izaiah Ryan MD', 'Hobi', 'https://www.runolfsdottir.com/quia-consectetur-dolorem-in-mollitia-labore-facere-maiores', 104576, '2023-07-10', 'pending', NULL),
(291, '1083701898753437', 'Ea iste quos dolorem.', '1991', 'Schiller-Schneider', 'Maryse Schuster', 'Hobi', 'http://stehr.com/numquam-est-culpa-dicta-occaecati-ea-et-eligendi-labore.html', 125850, '1999-07-21', 'pending', NULL),
(292, '1083701898753437', 'Architecto porro soluta hic.', '2015', 'Conn Inc', 'Erich Orn', 'Refrensi', 'http://keebler.com/cupiditate-rerum-omnis-qui-libero-a', 64360, '2001-05-03', 'pending', NULL),
(293, '1083701898753437', 'Et sed nulla praesentium enim.', '2017', 'Lemke Inc', 'Prof. Lempi Hand V', 'Hobi', 'http://hayes.com/nihil-voluptas-nulla-autem-tenetur-ea-labore-amet', 122553, '2010-09-26', 'pending', NULL),
(294, '1083701898753437', 'Aliquid est odio.', '2023', 'Leffler, Wisozk and Bogisich', 'Sincere Leuschke', 'Refrensi', 'http://bartoletti.com/temporibus-quisquam-et-consequatur-eos.html', 124404, '2009-01-06', 'pending', NULL),
(295, '1083701898753437', 'Error nisi tempora sequi.', '2003', 'Altenwerth and Sons', 'Vivien Rogahn', 'Refrensi', 'http://www.streich.com/', 142296, '1977-02-26', 'pending', NULL),
(296, '1083701898753437', 'Perspiciatis totam id odio.', '2018', 'Hahn Inc', 'Prof. Dannie Wolf', 'Hobi', 'https://www.kub.net/reiciendis-autem-atque-rerum-ex-enim', 121498, '1990-10-19', 'pending', NULL),
(297, '1083701898753437', 'Magni magnam recusandae.', '2006', 'Hayes, Kshlerin and Sporer', 'Mrs. Myrtis Schimmel V', 'Hobi', 'http://www.tromp.com/', 224095, '1977-09-10', 'pending', NULL),
(298, '1083701898753437', 'Et nobis.', '1994', 'Corkery-Haag', 'Xander Huel', 'Hobi', 'https://www.olson.com/quibusdam-qui-illum-debitis-molestiae-officiis-occaecati-rerum-temporibus', 170602, '1976-06-24', 'pending', NULL),
(299, '1083701898753437', 'Iure a ipsa ullam.', '2021', 'Hackett, Runte and Johnston', 'Bert Walker I', 'Hobi', 'http://champlin.com/eum-et-nulla-animi-tempore-architecto-pariatur-et', 82042, '1972-09-27', 'pending', NULL),
(300, '1083701898753437', 'Ratione et eos fuga.', '2013', 'Connelly Group', 'Petra Frami', 'Hobi', 'http://www.effertz.biz/unde-sint-minus-aut-est-soluta-et', 123934, '2020-01-06', 'pending', NULL),
(301, '1083701898753437', 'Doloribus nihil.', '2006', 'Moen-King', 'Mr. Leopold Heaney', 'Refrensi', 'http://www.turcotte.com/aut-excepturi-explicabo-temporibus-odit', 66066, '2003-09-24', 'pending', NULL),
(302, '1083701898753437', 'Placeat laborum similique qui.', '2004', 'Funk, Schaden and Hodkiewicz', 'Darby Doyle', 'Refrensi', 'http://bednar.com/modi-dolores-doloremque-soluta-fugit', 252620, '1973-05-19', 'pending', NULL),
(303, '1083701898753437', 'Aut voluptates at.', '1997', 'Larson LLC', 'Brice Hand', 'Hobi', 'http://www.konopelski.com/', 272175, '2015-07-05', 'pending', NULL),
(304, '1083701898753437', 'Ut nulla.', '1994', 'O\'Conner, Abernathy and Keeling', 'Talon Willms', 'Refrensi', 'https://pfeffer.org/eveniet-non-cum-exercitationem-cum-minus-doloribus.html', 88166, '2019-01-19', 'pending', NULL),
(305, '1083701898753437', 'Id excepturi odit eos.', '1991', 'Weimann-Pfeffer', 'Seth Rutherford', 'Refrensi', 'http://leffler.net/', 285302, '2007-03-25', 'pending', NULL),
(306, '1083701898753437', 'Dignissimos error ab numquam optio.', '1994', 'Veum LLC', 'Lamar Beahan', 'Hobi', 'http://rowe.biz/temporibus-possimus-sed-blanditiis-suscipit.html', 82722, '1988-12-27', 'pending', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `civitas_akademik`
--

CREATE TABLE `civitas_akademik` (
  `id_anggota` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `civitas_akademik`
--

INSERT INTO `civitas_akademik` (`id_anggota`, `email`, `nama`, `password`, `role`) VALUES
('1', 'dosen@dosen.pcr.ac.id', 'dosen', '$2y$10$kSHcNw.4EgfTDoSNQuqLG.aFy2aega7eyVmKi4dI5Fr4gl4m7E93W', 'dosen'),
('1083701898753437', 'chairunnas23ti@mahasiswa.pcr.ac.id', 'CHAIRUNNAS ARIEF MAULANA', '$2y$10$7m8fYC7n.c0QQrYJAp/AaeDTNcs6JcPmMTmlUl.as6GGaKtGxfUw2', 'mahasiswa'),
('12', 'mahasiswa@mahasiswa.pcr.ac.id', 'mahasiswa', '$2y$10$EBjS6Ya8QeOdqzIf686ThujpkQI2RRuE5/m1o1rGow2AL3Xgf6XEa', 'mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `modul_id` int(11) NOT NULL,
  `id_anggota_request` varchar(16) DEFAULT NULL,
  `judul_modul` varchar(255) NOT NULL,
  `soft_file` varchar(255) DEFAULT NULL,
  `jumlah_cetak` int(11) DEFAULT NULL,
  `status` enum('pending','diterima','ditolak','proses eksekusi','sudah dieksekusi') NOT NULL DEFAULT 'pending',
  `tanggal_request` date NOT NULL,
  `tanggal_verifikasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`modul_id`, `id_anggota_request`, `judul_modul`, `soft_file`, `jumlah_cetak`, `status`, `tanggal_request`, `tanggal_verifikasi`) VALUES
(5, '1', 'anjay mantap', 'Certificate.pdf', 12, 'proses eksekusi', '2024-06-23', NULL),
(6, '1', 'belajar bersama saya', NULL, 12, 'proses eksekusi', '2024-06-23', NULL),
(7, '1', 'anjay mantap', NULL, 200, 'proses eksekusi', '2024-06-23', NULL),
(8, '1', 'belajar bersama saya', NULL, 46, 'pending', '2024-06-23', NULL),
(9, '1', 'Iusto eum quo.', NULL, 133, 'pending', '1990-04-08', NULL),
(10, '1', 'Facere totam corporis.', NULL, 230, 'pending', '1987-04-02', NULL),
(11, '1', 'Eaque iusto tempora.', NULL, 104, 'pending', '1970-03-12', NULL),
(12, '1', 'Optio sit voluptates dolor.', NULL, 171, 'pending', '2021-06-01', NULL),
(13, '1', 'Et velit eum.', NULL, 165, 'pending', '1995-12-20', NULL),
(14, '1', 'Ab omnis veritatis in.', NULL, 239, 'pending', '1995-11-25', NULL),
(15, '1', 'Omnis sequi voluptas at.', NULL, 132, 'pending', '1992-04-02', NULL),
(16, '1', 'Quae modi dolore.', NULL, 179, 'pending', '1988-05-02', NULL),
(17, '1', 'Enim quod enim adipisci.', NULL, 188, 'pending', '2012-09-04', NULL),
(18, '1', 'Aut qui nesciunt libero.', NULL, 115, 'pending', '2001-08-14', NULL),
(19, '1', 'Quia magnam aliquam.', NULL, 128, 'pending', '2021-06-10', NULL),
(20, '1', 'Aut aliquam praesentium.', NULL, 202, 'pending', '2016-02-13', NULL),
(21, '1', 'Repudiandae suscipit ad deleniti.', NULL, 203, 'pending', '1991-11-11', NULL),
(22, '1', 'Aperiam minima qui.', NULL, 177, 'pending', '2014-07-16', NULL),
(23, '1', 'Aut cumque sapiente harum ipsa.', NULL, 153, 'pending', '1974-12-10', NULL),
(24, '1', 'In hic nam officiis.', NULL, 135, 'pending', '2000-09-10', NULL),
(25, '1', 'Architecto deleniti adipisci incidunt.', NULL, 217, 'pending', '2011-02-09', NULL),
(26, '1', 'Eos harum non quibusdam.', NULL, 105, 'pending', '1977-08-31', NULL),
(27, '1', 'Eius modi unde.', NULL, 223, 'pending', '2015-02-07', NULL),
(28, '1', 'Molestiae a alias.', NULL, 194, 'pending', '2007-10-08', NULL),
(29, '1', 'Itaque alias velit pariatur.', NULL, 128, 'pending', '1978-12-26', NULL),
(30, '1', 'Enim quibusdam et voluptatem.', NULL, 177, 'pending', '1975-11-23', NULL),
(31, '1', 'Aspernatur exercitationem voluptatem.', NULL, 158, 'pending', '2009-04-03', NULL),
(32, '1', 'Recusandae voluptate consequatur.', NULL, 184, 'pending', '1981-06-15', NULL),
(33, '1', 'Sunt eos numquam.', NULL, 237, 'pending', '2004-10-12', NULL),
(34, '1', 'Eius ut nihil.', NULL, 229, 'pending', '2010-05-10', NULL),
(35, '1', 'Est sit officia.', NULL, 118, 'pending', '2023-06-11', NULL),
(36, '1', 'Enim deleniti necessitatibus.', NULL, 173, 'pending', '1975-05-26', NULL),
(37, '1', 'Repellat corporis minima nam.', NULL, 246, 'pending', '1992-09-15', NULL),
(38, '1', 'Iste et non.', NULL, 150, 'pending', '2013-05-21', NULL),
(39, '1', 'Et reiciendis non consectetur.', NULL, 138, 'pending', '2020-02-20', NULL),
(40, '1', 'Sint rerum quidem.', NULL, 184, 'pending', '2014-01-20', NULL),
(41, '1', 'Maiores aspernatur necessitatibus aspernatur.', NULL, 181, 'pending', '2018-01-20', NULL),
(42, '1', 'Praesentium similique optio.', NULL, 110, 'pending', '2019-04-23', NULL),
(43, '1', 'Eligendi accusamus.', NULL, 196, 'pending', '2009-07-03', NULL),
(44, '1', 'Ducimus omnis inventore et.', NULL, 111, 'pending', '2015-04-21', NULL),
(45, '1', 'Et voluptas modi in.', NULL, 228, 'pending', '2002-11-14', NULL),
(46, '1', 'Velit non a veniam.', NULL, 212, 'pending', '1971-02-02', NULL),
(47, '1', 'Ut ad recusandae dolores.', NULL, 125, 'pending', '2017-04-22', NULL),
(48, '1', 'Ratione aut.', NULL, 153, 'pending', '1996-11-28', NULL),
(49, '1', 'Rerum ut.', NULL, 158, 'pending', '1986-09-28', NULL),
(50, '1', 'Alias ut.', NULL, 140, 'pending', '2013-05-21', NULL),
(51, '1', 'Esse sit quibusdam.', NULL, 156, 'pending', '2010-09-26', NULL),
(52, '1', 'Excepturi dolor et eos.', NULL, 221, 'pending', '1990-01-14', NULL),
(53, '1', 'Non corrupti id.', NULL, 202, 'pending', '1987-06-10', NULL),
(54, '1', 'Eum totam totam ut.', NULL, 123, 'pending', '1977-12-04', NULL),
(55, '1', 'Aut non ipsum.', NULL, 175, 'pending', '2013-11-21', NULL),
(56, '1', 'Quae recusandae voluptatum.', NULL, 157, 'pending', '1996-02-03', NULL),
(57, '1', 'Distinctio velit quos.', NULL, 161, 'pending', '1985-10-05', NULL),
(58, '1', 'Molestias velit quis deleniti voluptas.', NULL, 106, 'pending', '1974-03-06', NULL),
(59, '1', 'Soluta similique dolor.', NULL, 241, 'pending', '1983-11-16', NULL),
(60, '1', 'Incidunt ut nesciunt distinctio expedita.', NULL, 188, 'pending', '1983-06-23', NULL),
(61, '1', 'Qui aspernatur molestias ipsum.', NULL, 214, 'pending', '1978-08-21', NULL),
(62, '1', 'Ea assumenda et veniam.', NULL, 219, 'pending', '2009-11-12', NULL),
(63, '1', 'Sit mollitia cum maxime.', NULL, 192, 'pending', '1980-07-04', NULL),
(64, '1', 'Ut officia aut.', NULL, 119, 'pending', '1970-02-11', NULL),
(65, '1', 'Qui eaque aut doloribus ipsam.', NULL, 231, 'pending', '2020-07-20', NULL),
(66, '1', 'Debitis quod veniam quae.', NULL, 197, 'pending', '1983-03-17', NULL),
(67, '1', 'Quaerat vero perferendis quaerat.', NULL, 232, 'pending', '1980-11-26', NULL),
(68, '1', 'Et qui id quo.', NULL, 246, 'pending', '2012-04-15', NULL),
(69, '1', 'Repellat quasi maxime minus est.', NULL, 130, 'pending', '2005-05-10', NULL),
(70, '1', 'Reiciendis eum voluptatem accusantium.', NULL, 129, 'pending', '1996-05-25', NULL),
(71, '1', 'Inventore vero non voluptatem.', NULL, 203, 'pending', '2017-04-11', NULL),
(72, '1', 'Est nisi est beatae.', NULL, 193, 'pending', '2010-03-04', NULL),
(73, '1', 'Itaque dolorem.', NULL, 213, 'pending', '2013-11-10', NULL),
(74, '1', 'Porro impedit odit est.', NULL, 234, 'pending', '2012-07-02', NULL),
(75, '1', 'Quia doloribus velit velit.', NULL, 199, 'pending', '2021-07-16', NULL),
(76, '1', 'Cum nesciunt consequatur placeat voluptatem.', NULL, 245, 'pending', '1975-01-08', NULL),
(77, '1', 'Sunt labore quas.', NULL, 141, 'pending', '2009-12-29', NULL),
(78, '1', 'Voluptatem praesentium et eius.', NULL, 241, 'pending', '2023-12-26', NULL),
(79, '1', 'Tempore neque.', NULL, 226, 'pending', '1979-04-07', NULL),
(80, '1', 'Distinctio necessitatibus et vel.', NULL, 207, 'pending', '2005-07-11', NULL),
(81, '1', 'Quo vel est id ad.', NULL, 147, 'pending', '2024-03-02', NULL),
(82, '1', 'Et aut praesentium.', NULL, 193, 'pending', '2015-09-26', NULL),
(83, '1', 'Et voluptatum fugiat.', NULL, 219, 'pending', '2024-05-13', NULL),
(84, '1', 'Et quisquam et aut.', NULL, 156, 'pending', '2009-12-25', NULL),
(85, '1', 'Non et quos voluptatem.', NULL, 207, 'pending', '1983-02-26', NULL),
(86, '1', 'Et sed necessitatibus.', NULL, 148, 'pending', '1977-05-26', NULL),
(87, '1', 'Quia ullam eum vel.', NULL, 113, 'pending', '1977-04-09', NULL),
(88, '1', 'Ut aut deleniti nihil.', NULL, 201, 'pending', '2021-08-22', NULL),
(89, '1', 'Recusandae tenetur et enim quis.', NULL, 246, 'pending', '1991-12-15', NULL),
(90, '1', 'Ut sed autem.', NULL, 152, 'pending', '1987-01-27', NULL),
(91, '1', 'Libero nihil ut sapiente.', NULL, 152, 'pending', '1973-07-20', NULL),
(92, '1', 'Rerum facere.', NULL, 199, 'pending', '1980-11-09', NULL),
(93, '1', 'Explicabo saepe quam incidunt dignissimos.', NULL, 157, 'pending', '2004-07-01', NULL),
(94, '1', 'Quos occaecati adipisci necessitatibus.', NULL, 189, 'pending', '1993-10-22', NULL),
(95, '1', 'Omnis omnis autem.', NULL, 107, 'pending', '1997-12-29', NULL),
(96, '1', 'Omnis ea voluptas eligendi autem.', NULL, 156, 'pending', '1973-07-17', NULL),
(97, '1', 'Voluptatem aperiam totam.', NULL, 151, 'pending', '1993-12-22', NULL),
(98, '1', 'Quam necessitatibus blanditiis.', NULL, 104, 'pending', '2013-07-03', NULL),
(99, '1', 'Cumque laborum quaerat laborum.', NULL, 148, 'pending', '2013-04-28', NULL),
(100, '1', 'Consequatur consequatur ducimus ipsam et.', NULL, 233, 'pending', '2020-09-29', NULL),
(101, '1', 'Adipisci eius dignissimos.', NULL, 184, 'pending', '1981-02-25', NULL),
(102, '1', 'Molestiae cupiditate natus quas.', NULL, 148, 'pending', '2014-03-28', NULL),
(103, '1', 'Iusto quis earum ut error.', NULL, 163, 'pending', '1986-06-03', NULL),
(104, '1', 'Saepe incidunt.', NULL, 110, 'pending', '1994-11-28', NULL),
(105, '1', 'Sapiente quibusdam modi inventore.', NULL, 142, 'pending', '2021-03-31', NULL),
(106, '1', 'Mollitia aut error reprehenderit.', NULL, 167, 'pending', '2019-12-14', NULL),
(107, '1', 'Voluptatem numquam consequatur eum.', NULL, 100, 'pending', '1999-10-22', NULL),
(108, '1', 'Qui quia alias.', NULL, 132, 'pending', '1999-05-15', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff_perpustakaan`
--

CREATE TABLE `staff_perpustakaan` (
  `staff_id` varchar(16) NOT NULL,
  `nama_staff` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staff_perpustakaan`
--

INSERT INTO `staff_perpustakaan` (`staff_id`, `nama_staff`, `email`, `password`) VALUES
('12341', 'admin', 'admin@gmail.com', '$2y$10$qCEwKnrtWkZG5QpnXM/3B.hHzO2dnZ8DQmtAnC8bN5wK5WNb/rPPC'),
('99', 'staff', 'staff@pcr.ac.id', '$2y$10$94XRpaRXHgiTo046FpBe4ucp6kFWO96UO3HNt8D3eA8eemIsOiFLq');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_anggota_request` (`id_anggota_request`);

--
-- Indeks untuk tabel `civitas_akademik`
--
ALTER TABLE `civitas_akademik`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`modul_id`),
  ADD KEY `id_anggota_request` (`id_anggota_request`);

--
-- Indeks untuk tabel `staff_perpustakaan`
--
ALTER TABLE `staff_perpustakaan`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_anggota_request`) REFERENCES `civitas_akademik` (`id_anggota`);

--
-- Ketidakleluasaan untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_anggota_request`) REFERENCES `civitas_akademik` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;