<?php
$token = "8471018926:AAEv7SfKS9Luxo9poCBf0VEdWsmcoSHWgRI"; // اینجا توکن واقعی رباتت رو بذار
$input = file_get_contents("php://input");
$update = json_decode($input, true);

$chat_id = $update["message"]["chat"]["id"] ?? null;
$text = $update["message"]["text"] ?? "";

if ($text == "/start" && $chat_id) {
    $message = "سلام کریم جان! ربات موسیقی آماده‌ست 🎶";
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($message));
}
?>
