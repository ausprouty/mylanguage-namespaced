
<?php
$url = 'https://www.hereslife.com';
$size = 240;
$filePath = 'hereslife_com_100.png';
echo "I started QRCode Tst";
$qrCodeGenerator = new QrCodeGenerator($url, $size, $filePath);
$qrCodeGenerator->generateQrCode();
echo "I finished QRCode Tst";
