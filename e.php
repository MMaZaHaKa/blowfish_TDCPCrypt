<?php

require_once('../blowfish.php');

// Файл для чтения
$file = '1.ts';

// Чтение содержимого файла
$ciphertext = file_get_contents($file);
if ($ciphertext === false) {
    die("Ошибка при чтении файла $file");
}
// 54 53 76 31 TSV1.0
// Пример ключа и вектора инициализации (вы можете использовать ваши значения)
$key = hex2bin('4efc4dacf09e07ec23ed97a9647575253651511d');   // ключ
$iv = '';  // инициализационный вектор

// Расшифровка содержимого файла
$deciphered = Blowfish::decrypt(
    $ciphertext,
    $key,  // ключ
    Blowfish::BLOWFISH_MODE_CBC,  // Режим шифрования
    Blowfish::BLOWFISH_PADDING_RFC,  // Стиль дополнения
    $iv  // Инициализационный вектор
);

// Извлечение первых двух байтов и вывод в формате HEX
$first_two_bytes = substr($deciphered, 0, 2);
$hex_output = bin2hex($first_two_bytes);
//header('Content-Type: text/plain; charset=UTF-8');
//header('Content-Type: text/plain; charset=windows-1251');
//header('Content-Disposition: inline; filename="decoded.txt"');
//$deciphered = mb_convert_encoding($deciphered, 'Windows-1251', 'UTF-8');
echo $deciphered;

// Вывод результатов
echo '<pre>';
printf('Ciphertext length: %d%s', strlen($ciphertext), PHP_EOL);
printf('Deciphered text (first 2 bytes in HEX): %s%s', $hex_output, PHP_EOL);
?>