<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$playersFile = __DIR__ . '/players_data.json';
$guestbookFile = __DIR__ . '/guestbook_data.json';

// Auto-create files with full permissions if missing
if (!file_exists($playersFile)) {
    @file_put_contents($playersFile, '[]');
    @chmod($playersFile, 0666);
}
if (!file_exists($guestbookFile)) {
    @file_put_contents($guestbookFile, '[]');
    @chmod($guestbookFile, 0666);
}

function readJsonFile($file) {
    if (!file_exists($file)) return [];
    $content = @file_get_contents($file);
    if (!$content) return [];
    $data = json_decode($content, true);
    return is_array($data) ? $data : [];
}

function writeJsonFile($file, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    if ($json === false) return false;
    $bytes = @file_put_contents($file, $json, LOCK_EX);
    return $bytes !== false;
}

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
if (!is_array($input)) {
    $input = $_POST;
}

$action = isset($input['action']) ? $input['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($action)) {
    
    // Register or update player
    if ($action === 'register_or_update_player') {
        $players = readJsonFile($playersFile);
        $playerData = isset($input['player']) ? $input['player'] : null;

        if ($playerData && isset($playerData['code'])) {
            $existingIndex = -1;
            foreach ($players as $index => $p) {
                if (isset($p['code']) && (string)$p['code'] === (string)$playerData['code']) {
                    $existingIndex = $index;
                    break;
                }
            }

            if ($existingIndex !== -1) {
                $players[$existingIndex] = $playerData;
            } else {
                $players[] = $playerData;
            }

            $writeSuccess = writeJsonFile($playersFile, $players);
            if (!$writeSuccess) {
                echo json_encode([
                    'status' => 'error', 
                    'message' => 'Erreur d\'écriture sur le serveur (players_data.json). Vérifiez les permissions CHMOD du dossier.'
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        }

        echo json_encode(['status' => 'success', 'players' => $players], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Delete player
    if ($action === 'delete_player') {
        $players = readJsonFile($playersFile);
        $code = isset($input['code']) ? (string)$input['code'] : '';

        $players = array_values(array_filter($players, function($p) use ($code) {
            return isset($p['code']) && (string)$p['code'] !== $code;
        }));

        writeJsonFile($playersFile, $players);
        echo json_encode(['status' => 'success', 'players' => $players], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Add guestbook entry
    if ($action === 'add_guestbook_message') {
        $guestbook = readJsonFile($guestbookFile);
        $entry = isset($input['entry']) ? $input['entry'] : null;

        if ($entry) {
            $guestbook[] = $entry;
            writeJsonFile($guestbookFile, $guestbook);
        }

        echo json_encode(['status' => 'success', 'guestbook' => $guestbook], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$players = readJsonFile($playersFile);
$guestbook = readJsonFile($guestbookFile);

echo json_encode([
    'status' => 'success',
    'players' => $players,
    'guestbook' => $guestbook,
    'server_time' => date('Y-m-d H:i:s')
], JSON_UNESCAPED_UNICODE);