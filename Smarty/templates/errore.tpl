<!DOCTYPE html>
<html lang="en">
<head>
<script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
</head>
<body>
    {$titolo}
    {$descrizione}
    {$categoria}
    {print_r($file['imageFile']['size'][0])}
    
</body>