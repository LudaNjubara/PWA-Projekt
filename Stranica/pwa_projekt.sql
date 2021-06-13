-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 10:36 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwa_projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prezime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `korisnickoIme` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lozinka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razinaDozvole` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnickoIme`, `lozinka`, `razinaDozvole`) VALUES
(20, 'Mihael', 'Šestak', 'LudaNjubara', '$2y$10$nrpoWptd/HioSoHuzmppP.FQ8oUqhabOtrEDya0QLUJN/QLm78RLK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `članci`
--

CREATE TABLE `članci` (
  `datum` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naslov` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sazetak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategorija` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `članci`
--

INSERT INTO `članci` (`datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`, `id`) VALUES
('11/06/2021 18:24:26', 'Ratni zapovjednik', 'Ratko Mladić pravomoćno proglašen krivim', 'RATNI zapovjednik vojske bosanskih Srba Ratko Mladić u utorak je pravomoćno proglašen krivim za najteže ratne zločine i osuđen na kaznu doživotnog zatvora na temelju odluke žalbenog vijeća Mehanizma za međunarodne kaznene sudove (MICT).\r\n\r\nPredsjednica petočlanog sudskog vijeća, sutkinja iz Zambije Prisca Matimba Nyambe, izričući presudu Mladiću (78) kazala je kako je većina sudaca u cijelosti prihvatila zaključke i presudu prvostupanjskog vijeća iz 2017. godine te odbacila navode iz žalbi koje su na bili podnijeli Mladić i tužiteljstvo MICT-a.\r\n\r\nPresuda Mladiću dolazi gotovo 26 godina nakon genocida u Srebrenici koji se dogodio u srpnju 1995. godine. Bilo je to pred kraj rata u kojem je Mladić bio odgovoran za brojne zločine.\r\n\r\nHrvatski ministar vanjskih poslova Gordan Grlić Radman rekao je da je riječ o zakašnjeloj pravdi.\r\n\r\n\"Što se tiče Republike Hrvatske i hrvatskog naroda, možemo, nažalost, zaključiti kako naše patnje i žrtve tijekom ovog suđenja nisu dobile nikakvu satisfakciju. Jedinu utjehu u ovoj presudi možemo pronaći u činjenici da je već nekoliko puta presuđeno zločinačkoj velikosrpskoj politici, a čija je nesumnjivo jedna od glavnih personifikacija bio baš ratni zločinac Ratko Mladić\", naglasio je.', 'test_person.jpg', 'politika', 0, 141),
('09/06/2021 04:31:32', 'Naslov vijesti', 'Kratki sažetak vijesti', 'RATNI zapovjednik vojske bosanskih Srba Ratko Mladić u utorak je pravomoćno proglašen krivim za najteže ratne zločine i osuđen na kaznu doživotnog zatvora na temelju odluke žalbenog vijeća Mehanizma za međunarodne kaznene sudove (MICT).\r\n\r\nPredsjednica petočlanog sudskog vijeća, sutkinja iz Zambije Prisca Matimba Nyambe, izričući presudu Mladiću (78) kazala je kako je većina sudaca u cijelosti prihvatila zaključke i presudu prvostupanjskog vijeća iz 2017. godine te odbacila navode iz žalbi koje su na bili podnijeli Mladić i tužiteljstvo MICT-a.\r\n\r\nPresuda Mladiću dolazi gotovo 26 godina nakon genocida u Srebrenici koji se dogodio u srpnju 1995. godine. Bilo je to pred kraj rata u kojem je Mladić bio odgovoran za brojne zločine.\r\n\r\nHrvatski ministar vanjskih poslova Gordan Grlić Radman rekao je da je riječ o zakašnjeloj pravdi.\r\n\r\n&quot;Što se tiče Republike Hrvatske i hrvatskog naroda, možemo, nažalost, zaključiti kako naše patnje i žrtve tijekom ovog suđenja nisu dobile nikakvu satisfakciju. Jedinu utjehu u ovoj presudi možemo pronaći u činjenici da je već nekoliko puta presuđeno zločinačkoj velikosrpskoj politici, a čija je nesumnjivo jedna od glavnih personifikacija bio baš ratni zločinac Ratko Mladić&quot;, naglasio je.', 'crna_pozadina.jpg', 'politika', 0, 142),
('09/06/2021 04:32:37', 'Dalić o englezima', 'Dalić pripremio Englezima veliko iznenađenje?', 'ZLATKO DALIĆ na treningu u Rovinju dao je naslutiti koja bi momčad mogla zaigrati u nedjelju protiv Engleske u prvom kolu Europskog prvenstva.\r\n\r\nU jednoj fazi treninga u napadu je odlučio zaigrati s trojicom krilnih nogometaša. Tako je Nikola Vlašić dobio poziciju na desnom krilu, Perišić na lijevom, a najistureniji bio je Ante Rebić. \r\n\r\nAko Rebić zaigra kao napadač od prve minute protiv Engleske, to bi bilo Dalićevo iznenađenje jer se dosad prednost na toj poziciji davala Andreju Kramariću i Bruni Petkoviću.\r\n\r\nDominik Livaković je siguran na golu, a ispred njega su Šime Vrsaljko, Domagoj Vida, Duje Ćaleta-Car te Borna Barišić koji i dalje ima prednost na poziciji lijevog beka ispred Joška Gvardiola. Čini se da Dejan Lovren ipak neće biti spreman za prvo kolo Europskog prvenstva.\r\n\r\nIzgledno je da će vezni red u nedjelju na Wembleyju biti Marcelo Brozović, Luka Modrić i Mateo Kovačić.', 'test_person.jpg', 'sport', 0, 143),
('10/06/2021 01:12:31', 'Pad moćnih sudaca', 'Kako im je Mamić namjestio klopku koja bi se i njemu mogla obiti o glavu', 'UHIĆENIM osječkim sucima i poduzetniku, nakon pretrage domova, a za neke od njih i ispitivanja u zagrebačkom sjedištu Uskoka, slijedi noć u policijskom pritvoru. \r\n\r\nPrema neslužbenim informacijama do kojih je tijekom dana došao Index, suci su uhićeni u sklopu proširenja istrage protiv braće Zdravka i Zorana Mamića vezane uz davanje mita i trgovanje utjecajem. Istragom je obuhvaćeno šest osoba: tri suca, Tadić i braća Mamić. Stavlja im se na teret većina onoga što je Mamić i pisao na Facebooku, a ukupna cifra kojom su suci podmićeni je oko 400 tisuća eura.\r\n\r\nUskok i policija u srijedu su, ne navodeći identitete, potvrdili uhićenja trojice osječkih sudaca koje je bivši čelnik Dinama Zdravko Mamić prozvao za korupciju. Uz suce Darka Krušlina, Zvonka Vekića i Antu Kvesića, uhićen je i osječki poduzetnik Drago Tadić.\r\n\r\nU Zagreb su, kako se doznalo, najprije dovedeni Krušlin i Kvesić, a Tadiću su za to vrijeme pretresane zagrebačke nekretnine.\r\n\r\nU Uskoku je prvi od uhićene četvorke ispitan poduzetnik Drago Tadić. Njegov je odvjetnik prije ispitivanja kratko rekao kako mu nije jasno kakvu ulogu u svemu ima Tadić, a nakon ispitivanja nije davao nikakve izjave. \r\n\r\nNa ispitivanje je sljedeći doveden sudac koji je bio predsjednik sudskog vijeća koje je sudilo i presudilo Mamićima - Darko Krušlin. Njegov odvjetnik Ljubo Pavasović Visković najavio je da će Krušlin iznositi obranu. \r\n\r\nTijekom dana su se obavljali pretresi imovine uhićenih sudaca u Osijeku, a Dragi Tadiću pretresala se imovina i u Zagrebu. Zagrebački stan trebao je biti pretresen i sucu Zvonku Vekiću, no kako su potrajali pretresi niza njegovih nekretnina u Osijeku, to se do večernjih sati još nije dogodilo pa je postalo jasno da on sigurno danas neće biti ispitan u Uskoku.\r\n\r\nNakon što se svi uhićeni ispitaju u Uskoku, taj specijalizirani odjel Državnog odvjetništva protiv osumnjičenih bi trebao pokrenuti istragu, a zatraže li za nekog od uhićenih istražni zatvor, o tome će odlučivati sudac istrage zagrebačkog Županijskog suda.', 'crna_pozadina.jpg', 'sport', 0, 145),
('10/06/2021 01:14:51', 'Lude mačke', 'Mačka nokautirala drugu mačku. Snimka je hit', 'TEŠKO je povjerovati da mačka može nokautirati drugu mačku, ali i to se dogodilo. Ova situacija srećom je zabilježena kamerom pa je objavljena na Twitteru i nije trebalo dugo čekati da postane hit. \r\n\r\nJasno se vidi kako mačka podiže šapu i udara drugu mačku u glavu, nakon čega ova pada na leđa i ostaje ležati nekoliko sekundi na podu. Potom se diže i odlazi, kao da se ništa nije dogodilo.', 'crna_pozadina.jpg', 'zabava', 0, 146),
('10/06/2021 01:16:11', 'Nova Opel Astra', 'Ovo su prvi detalji nove Opel Astre', 'DUGO iščekivana nova generacija Opelovog kompakta polako razotkriva svoje obline. \r\n\r\nStellantis koncern je u ofenzivi. Samo nekoliko mjeseci nakon otkrivanja novog Peugeota 308, iz koncerna kreće razotkrivanje još jednog kompakta. U pitanju je nova Astra, a sudeći po detaljima, očekuje se drastičan odmak od dosadašnjih generacija. \r\n\r\nIako je osnova ista kao kod 308-ice, Opel se doista svojski potrudio podariti svojem kompaktu snažnu dozu osobnosti. Receptura je posuđena od nove Mokke, a to znači prepoznatljivu Vizor prednjicu, dok straga ime modela dobiva centralno mjesto.', 'test_person.jpg', 'zabava', 0, 147),
('11/06/2021 22:12:29', '&lt;option value= . $row2[kate', 'sssssssssss', 'ssssssssssss', 'test_person.jpg', 'Znanstvena fantastika', 0, 148),
('11/06/2021 22:12:58', '&lt;option value= . $row2[kate', 'sssssssssss', 'ssssssssssss', 'test_person.jpg', 'Znanstvena fantastika', 0, 149),
('11/06/2021 22:14:29', '&lt;option value= . $row2[kate', 'sssssssssss', 'ssssssssssss', 'test_person.jpg', 'Znanstvena fantastika', 0, 150),
('11/06/2021 22:15:29', '&quot;Netko&quot;', 'ssssssssssssssss', 'ssssssssssssssss', 'test_person.jpg', 'Znanstvena fantastika', 0, 151),
('11/06/2021 22:17:13', 'Netko', 'sssssssssssssss', 'ssssss', 'test_person.jpg', 'Znanstvena fantastika', 0, 152);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnickoIme` (`korisnickoIme`);

--
-- Indexes for table `članci`
--
ALTER TABLE `članci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `članci`
--
ALTER TABLE `članci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
