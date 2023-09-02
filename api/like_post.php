<?php

$postData = json_decode(file_get_contents("php://input"), true);

// Verifica che i dati siano stati ricevuti correttamente
if (empty($postData) || !isset($postData['action']) || !isset($postData['postId'])) {
    // Gestire un errore se i dati non sono validi
    http_response_code(400); // Codice HTTP 400 Bad Request
    echo json_encode(['error' => 'Dati non validi']);
    exit;
}


if ($postData['action'] === 'like') {
    // Assumiamo che tu abbia un database MySQL
    $db = new PDO('mysql:host=hostname;dbname=dbname', 'username', 'password');

    // Aggiungi un "Mi Piace" al post nel database
    $postId = $postData['postId'];
    $stmt = $db->prepare("UPDATE posts SET likes = likes + 1 WHERE id = :postId");
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Ritorna una conferma di successo alla richiesta AJAX
        echo json_encode(['success' => 'Mi Piace aggiunto con successo']);
        exit;
    } else {
        // Gestisci un errore se l'aggiornamento del database fallisce
        http_response_code(500); // Codice HTTP 500 Internal Server Error
        echo json_encode(['error' => 'Impossibile aggiungere il Mi Piace']);
        exit;
    }
}
