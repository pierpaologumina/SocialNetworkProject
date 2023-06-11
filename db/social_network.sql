-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Nov 01, 2019 alle 08:58
-- Versione del server: 5.7.25
-- Versione PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratori`
--

CREATE TABLE `amministratori` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `amministratori`
--

INSERT INTO `amministratori` (`id_admin`, `nome`, `cognome`, `password`, `data`, `email`) VALUES
(1, 'Carlo', 'Carletto', 'password', '2019-06-14', 'carlo@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `appunti`
--

CREATE TABLE `appunti` (
  `id_appunto` int(11) NOT NULL,
  `caricato_da` varchar(30) NOT NULL,
  `caricato_il` date NOT NULL,
  `link` varchar(255) NOT NULL,
  `materia` varchar(30) NOT NULL,
  `corso` varchar(30) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `appunti`
--

INSERT INTO `appunti` (`id_appunto`, `caricato_da`, `caricato_il`, `link`, `materia`, `corso`, `descrizione`) VALUES
(3, '17', '2019-07-20', 'https://it.wikipedia.org/wiki/Unified_Modeling_Language', 'Sistemi Operativi', 'Ingegneria', 'Qui troverete tutti i miei appunti di SO. Ciao!'),
(4, '17', '2019-07-20', 'https://www.w3schools.com/howto/howto_css_searchbar.asp', 'Programmazione III', 'Scienze Informatiche', 'Qui troverete tutti i miei appunti di Programmazione III. Ciao!');

-- --------------------------------------------------------

--
-- Struttura della tabella `bookcrossing`
--

CREATE TABLE `bookcrossing` (
  `id` int(11) NOT NULL,
  `bcid` varchar(105) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `autore` varchar(100) NOT NULL,
  `img_copertina` varchar(30) NOT NULL,
  `utente_inserito` int(11) NOT NULL,
  `data_inserimento` date NOT NULL,
  `stato` varchar(30) DEFAULT NULL,
  `possessore` int(11) DEFAULT NULL,
  `data_possesso` date DEFAULT NULL,
  `luogo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `bookcrossing`
--

INSERT INTO `bookcrossing` (`id`, `bcid`, `titolo`, `autore`, `img_copertina`, `utente_inserito`, `data_inserimento`, `stato`, `possessore`, `data_possesso`, `luogo`) VALUES
(4, 'Manuale di diritto privato79', 'Manuale di diritto privato', 'Andrea Torrente, Piero Schlesinger, F. Anelli, C. Granelli', '133diritto.jpg', 19, '2019-07-17', 'disponibile', NULL, NULL, 'Casa mia'),
(5, 'Divina Commedia293', 'Divina Commedia', 'Dante Alighieri', '147divina_commedia.jpg', 17, '2019-07-17', 'rimessa', 17, '2019-07-23', 'Polo Papardo (bibblioteca centrale, Terzo Piano)'),
(6, 'I promessi sposi341', 'I promessi sposi', 'Alessandro Manzoni', '156promessi_sposi.jpg', 17, '2019-07-17', 'disponibile', NULL, NULL, 'Facolt&agrave; di Lettere (bibblioteca centrale, 5&deg; piano)'),
(7, 'Le mie risposte alle 385', 'Le mie risposte alle grandi domande', 'Stephen Hawking', '151sh.jpg', 17, '2019-07-17', 'disponibile', NULL, NULL, 'Dipartimento di Ingegneria (5 Piano, blocco A)'),
(8, 'Harry Potter e il calice498', 'Harry Potter e il calice di fuoco', 'J.K. Rowling', '178hp_cdf.jpg', 19, '2019-07-17', 'disponibile', NULL, NULL, 'Dipartimento di Ingegneria (bibblioteca 5 Piano, blocco A)');

-- --------------------------------------------------------

--
-- Struttura della tabella `canali`
--

CREATE TABLE `canali` (
  `id_canale` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `data` date NOT NULL,
  `titolo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `canali`
--

INSERT INTO `canali` (`id_canale`, `nome`, `id_prof`, `data`, `titolo`) VALUES
(1, 'Sistemi Operativi', 1, '2019-06-11', 'Qui vengono inserite informazioni riguardanti SO');

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti_canali`
--

CREATE TABLE `commenti_canali` (
  `id_commento` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `commenti_canali`
--

INSERT INTO `commenti_canali` (`id_commento`, `post_id`, `user_id`, `contenuto`, `data`) VALUES
(1, 1, 17, 'sono pienamente d\'accordo', '2019-06-02'),
(11, 2, 1, 'sembra funzionare\r\n', '2019-06-12'),
(14, 1, 1, 'non ce di che', '2019-06-13'),
(15, 1, 1, 'che fate studenti stasera?', '2019-06-13'),
(16, 2, 17, 'salve prof sono pierpaolo', '2019-06-13'),
(17, 2, 19, 'Salve sono Frescobaldo e mi sono tolto da legge per inscrivermi a Ingegneria', '2019-06-13');

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(1, 38, 18, 'ciaoo', '', '2019-06-12');

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `id_libro` int(11) NOT NULL,
  `corso` varchar(30) NOT NULL,
  `titolo_testo` varchar(100) NOT NULL,
  `edizione` int(11) NOT NULL,
  `autore` varchar(100) NOT NULL,
  `caricato_da` int(11) NOT NULL,
  `condizione` varchar(30) NOT NULL,
  `prezzo` int(30) NOT NULL,
  `caricato_il` date NOT NULL,
  `img_libro` varchar(50) NOT NULL,
  `info` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`id_libro`, `corso`, `titolo_testo`, `edizione`, `autore`, `caricato_da`, `condizione`, `prezzo`, `caricato_il`, `img_libro`, `info`) VALUES
(3, 'Ingegneria', 'Basi di dati. Con Connect', 5, 'Paolo Atzeni, Stefano Ceri, Piero Fraternali, Stefano Paraboschi, Riccardo Torlone', 19, 'Ottime', 23, '2019-07-12', '53dbms.jpg', 1234567890),
(4, 'Ingegneria', 'Harry Potter e il Calice di Fuoco', 4, 'Jk ', 17, 'Ottime', 12, '2019-07-23', '88sh.jpg', 1234567890);

-- --------------------------------------------------------

--
-- Struttura della tabella `mebri_canali`
--

CREATE TABLE `mebri_canali` (
  `id_m` int(11) NOT NULL,
  `id_studente` int(11) NOT NULL,
  `id_canale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `mebri_canali`
--

INSERT INTO `mebri_canali` (`id_m`, `id_studente`, `id_canale`) VALUES
(14, 19, 2),
(16, 17, 1),
(18, 19, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(200) NOT NULL,
  `upload_img` varchar(255) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_img`, `post_date`) VALUES
(38, 18, 'asdasdasd', '', '2019-06-11'),
(39, 17, 'Ciao a tutti sono un Informatico', '', '2019-06-11'),
(40, 20, 'ciao a tutti', '', '2019-06-12'),
(41, 17, 'Buongiorno', 'dbms.jpg.100', '2019-07-23');

-- --------------------------------------------------------

--
-- Struttura della tabella `post_canali`
--

CREATE TABLE `post_canali` (
  `id_post` int(11) NOT NULL,
  `id_canale` int(11) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  `post_img` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `post_canali`
--

INSERT INTO `post_canali` (`id_post`, `id_canale`, `titolo`, `contenuto`, `post_img`, `date`) VALUES
(1, 1, 'Compito di Giorno 24 giugno', 'Gli studenti sono pregati di iscriversi su ESSE3', '', '2019-06-02'),
(2, 1, 'Sviluppo', 'Lo sviluppo segue la fase di studio', '', '2019-06-11');

-- --------------------------------------------------------

--
-- Struttura della tabella `professori`
--

CREATE TABLE `professori` (
  `id_prof` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `corso` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `professori`
--

INSERT INTO `professori` (`id_prof`, `nome`, `cognome`, `password`, `corso`, `data`, `email`) VALUES
(1, 'Alberto', 'Albertini', 'password', 'Ingegneria', '2019-06-11', 'alberto@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `prova`
--

CREATE TABLE `prova` (
  `id_utente` int(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `paese` varchar(30) NOT NULL,
  `sesso` varchar(30) NOT NULL,
  `compleanno` date NOT NULL,
  `u_status` varchar(30) NOT NULL,
  `u_posts` varchar(30) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `relazioni` varchar(30) NOT NULL,
  `user_cover` varchar(30) NOT NULL,
  `user_image` varchar(30) NOT NULL,
  `user_reg_date` date NOT NULL,
  `recovery_account` varchar(30) DEFAULT NULL,
  `facolta` varchar(20) NOT NULL,
  `grado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `prova`
--

INSERT INTO `prova` (`id_utente`, `nome`, `cognome`, `user_name`, `pass`, `email`, `paese`, `sesso`, `compleanno`, `u_status`, `u_posts`, `descrizione`, `relazioni`, `user_cover`, `user_image`, `user_reg_date`, `recovery_account`, `facolta`, `grado`) VALUES
(17, 'Pierpaolo', 'Gumina', 'pierpaolo_gumina_200190', 'password', 'pier@gmail.com', 'Italia', 'Maschio', '1994-06-10', 'verified', 'YES', 'Descrizione di default, iserisci la tua descrizione!', '...', 'default_cover.jpg', 'dog.png', '2019-06-11', '...', 'Ingegneria', 'Studente'),
(19, 'frescobaldo', 'Libero', 'frescobaldo_libero_859993', 'password', 'frescolibero@gmail.com', 'Italia', 'Maschio', '1994-08-07', 'verified', 'no', 'Descrizione di default, iserisci la tua descrizione!', '...', 'default_cover.jpg', 'dog.png', '2019-06-11', '...', 'Ingegneria', 'Studente'),
(20, 'Rosalba', 'Rossa', 'rosalba_rossa_734587', 'password', 'rosalba@gmail.com', 'Italia', 'Femmina', '1994-06-24', 'verified', 'no', 'Descrizione di default, iserisci la tua descrizione!', '...', 'default_cover.jpg', 'plane.png', '2019-06-24', '...', 'Ingegneria', 'Studente');

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `id_recensione` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `testo` varchar(255) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `recensioni`
--

INSERT INTO `recensioni` (`id_recensione`, `id_libro`, `id_utente`, `testo`, `data`) VALUES
(4, 6, 17, 'Libro fantastico, specie il finale!', '2019-06-02'),
(5, 5, 17, 'Libri bruttino', '2019-07-23');

-- --------------------------------------------------------

--
-- Struttura della tabella `relazioni`
--

CREATE TABLE `relazioni` (
  `id_relazione` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `amico_di` int(11) NOT NULL,
  `stato` tinyint(1) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `relazioni`
--

INSERT INTO `relazioni` (`id_relazione`, `id_utente`, `amico_di`, `stato`, `tipo`) VALUES
(16, 17, 19, 1, 'Studente');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `msg_body` varchar(200) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `msg_seen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_to`, `user_from`, `msg_body`, `date`, `msg_seen`) VALUES
(1, 19, 17, 'Ciao', '2019-07-23 11:07:07.000000', 'no');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratori`
--
ALTER TABLE `amministratori`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indici per le tabelle `appunti`
--
ALTER TABLE `appunti`
  ADD PRIMARY KEY (`id_appunto`);

--
-- Indici per le tabelle `bookcrossing`
--
ALTER TABLE `bookcrossing`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `canali`
--
ALTER TABLE `canali`
  ADD PRIMARY KEY (`id_canale`);

--
-- Indici per le tabelle `commenti_canali`
--
ALTER TABLE `commenti_canali`
  ADD PRIMARY KEY (`id_commento`);

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indici per le tabelle `mebri_canali`
--
ALTER TABLE `mebri_canali`
  ADD PRIMARY KEY (`id_m`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indici per le tabelle `post_canali`
--
ALTER TABLE `post_canali`
  ADD PRIMARY KEY (`id_post`);

--
-- Indici per le tabelle `professori`
--
ALTER TABLE `professori`
  ADD PRIMARY KEY (`id_prof`);

--
-- Indici per le tabelle `prova`
--
ALTER TABLE `prova`
  ADD UNIQUE KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`id_recensione`);

--
-- Indici per le tabelle `relazioni`
--
ALTER TABLE `relazioni`
  ADD PRIMARY KEY (`id_relazione`);

--
-- Indici per le tabelle `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `amministratori`
--
ALTER TABLE `amministratori`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `appunti`
--
ALTER TABLE `appunti`
  MODIFY `id_appunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `bookcrossing`
--
ALTER TABLE `bookcrossing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `canali`
--
ALTER TABLE `canali`
  MODIFY `id_canale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `commenti_canali`
--
ALTER TABLE `commenti_canali`
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `mebri_canali`
--
ALTER TABLE `mebri_canali`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT per la tabella `post_canali`
--
ALTER TABLE `post_canali`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `professori`
--
ALTER TABLE `professori`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `prova`
--
ALTER TABLE `prova`
  MODIFY `id_utente` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `id_recensione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `relazioni`
--
ALTER TABLE `relazioni`
  MODIFY `id_relazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
