-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 06 okt 2018 kl 10:00
-- Serverversion: 5.7.23
-- PHP-version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databas: `blacklist`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `blacklist`
--

CREATE TABLE `blacklist` (
  `bl_name` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `blacklist`
--

INSERT INTO `blacklist` (`bl_name`) VALUES
('password'),
('123456'),
('12345678'),
('qwerty'),
('123456789'),
('football'),
('iloveyou'),
('welcome'),
('starwars'),
('passw0rd'),
('freedom'),
('whatever'),
('trustno1'),
('1234567890'),
('princess'),
('passw0rd'),
('sunshine'),
('password1'),
('zaq1zaq1');