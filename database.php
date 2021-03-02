<?php
session_start();
include 'paypal/config.php';
include 'paypal/conexion.php';

$pdo->query("CREATE DATABASE IF NOT EXISTS masterguides");
$pdo->query("use masterguides");

$cliente = ("CREATE TABLE IF NOT EXISTS cliente (
  id int(11) AUTO_INCREMENT NOT NULL,
  nombre varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  apellidos varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  email varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  contrasena varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  fecha timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  rol varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY(id))
");
$pdo->exec($cliente);

$comentarios = ("CREATE TABLE IF NOT EXISTS comentarios (
  id int(11) AUTO_INCREMENT NOT NULL,
  comentario varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  idproducto int(11) NOT NULL,
  usuario int(11) NOT NULL,
  fecha date NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($comentarios);

$productos = ("CREATE TABLE IF NOT EXISTS productos (
  id int(11) AUTO_INCREMENT NOT NULL,
  nombre varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  precio decimal(20,2) NOT NULL,
  descripcion text COLLATE utf8_spanish_ci NOT NULL,
  imagen varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($productos);

$ventas = ("CREATE TABLE IF NOT EXISTS ventas (
  id int(11) AUTO_INCREMENT NOT NULL,
  clave varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  datos text COLLATE utf8_spanish_ci NOT NULL,
  fecha datetime NOT NULL,
  correo varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  total decimal(60,2) NOT NULL,
  status varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($ventas);

$detalleventas = ("CREATE TABLE IF NOT EXISTS detalleventas (
  id int(11) AUTO_INCREMENT NOT NULL,
  idventa int(11) NOT NULL,
  idproducto int(11) NOT NULL,
  precio decimal(20,2) NOT NULL,
  cantidad int(11) NOT NULL,
  descargado int(1) NOT NULL,
  PRIMARY KEY (id))
");
$pdo->exec($detalleventas);
?>