<?php
session_start(); // 啟用 session 功能

echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE); //顯示JSON格式