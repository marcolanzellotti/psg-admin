<?php
session_start();
$con = new mysqli("localhost", "root", "Luc@s180", "eudesa99_forms");
$pCon = new mysqli("localhost", "root", "Luc@s180", "eudesa99_platform");
$psCon = new mysqli("localhost", "root", "Luc@s180", "eudesa99_plataforma_assinatura");
$pfCon = new mysqli("localhost", "root", "Luc@s180", "eudesa99_pfase2");
$perPage = 40;
$offset = isset($_GET['page']) ? (intval($_GET['page']) - 1) * $perPage : 0;
