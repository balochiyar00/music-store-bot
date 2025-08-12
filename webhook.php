<?php

// دریافت داده‌های ورودی از Telegram
$update = json_decode(file_get_contents("php://input"), true);

// بررسی وجود پیام
if (!isset($update["message"])) {
    exit("No message received.");
}

// اطلاعات پیام
$chat_id = $update["message"]["chat"]["id"];
$text = $update["message"]["text"];

// توکن ربات مستقیم داخل فایل
$token = "8471018926:AAEv7SfKS9Luxo9poCBf0VEdWsmcoSHWgRI";

// فقط پاسخ به پیام /start
if ($text == "/start") {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        "chat_id" => $chat_id,
        "text" => "🎶 خوش آمدید کریم جان!\nربات موسیقی آماده‌ی خدمت‌گذاریه."
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    // ذخیره لاگ ساده
    file_put_contents("log.txt", "Response: $response\nError: $error\n", FILE_APPEND);
}

?>
