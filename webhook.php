<?php

// دریافت داده‌های ورودی از Telegram
$update = json_decode(file_get_contents("php://input"), true);

// بررسی وجود پیام
if (!isset($update["message"])) {
    exit("No message received.");
}

// اطلاعات پیام
$message = $update["message"];
$chat_id = $message["chat"]["id"];
$text = $message["text"];

// توکن ربات Telegram
require_once("config.php"); // توکن داخل فایل config.php ذخیره می‌شه

// پاسخ ساده برای تست
$response_text = "🎶 خوش آمدید به فروشگاه موسیقی ملورانی!\nشما فرستادید: " . $text;

// ارسال پاسخ به کاربر
$url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage";
$data = [
    "chat_id" => $chat_id,
    "text" => $response_text
];

// ارسال درخواست با CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// ذخیره لاگ در فایل log.txt
$log_file = __DIR__ . "/log.txt";
$log_content = "Time: " . date("Y-m-d H:i:s") . "\n";
$log_content .= "Response: " . $response . "\n";
$log_content .= "Error: " . $error . "\n\n";

file_put_contents($log_file, $log_content, FILE_APPEND);

?>
