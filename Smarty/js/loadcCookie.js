// Funzione per leggere i valori dei temi dai cookie
function loadThemeSettings() {
    let themeSettings = null;
    const cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.indexOf("themeSettings=") === 0) {
            const cookieValue = cookie.substring("themeSettings=".length, cookie.length);
            themeSettings = JSON.parse(cookieValue);
            break;
        }
    }

    return themeSettings;
}

// Utilizza i valori dei cookie per applicare le impostazioni del tema
const savedThemeSettings = loadThemeSettings();
if (savedThemeSettings) {
    // Applica le impostazioni del tema
    applyTheme(savedThemeSettings.fontSize, savedThemeSettings.primaryColor, savedThemeSettings.backgroundColor);
}

function applyTheme(fontSize, primaryColor, backgroundColor) {
    // Applica la dimensione del carattere
    document.body.style.fontSize = fontSize + "px";

    // Applica il colore principale
    var elementsWithPrimaryColor = document.querySelectorAll(".primary-color");
    for (var i = 0; i < elementsWithPrimaryColor.length; i++) {
        elementsWithPrimaryColor[i].style.color = primaryColor;
    }

    // Applica lo sfondo
    document.body.style.backgroundColor = backgroundColor;
}
