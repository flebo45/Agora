// Retrieve theme settings from session storage
const savedFontSize = sessionStorage.getItem('fontSize');
const savedPrimaryColorHue = sessionStorage.getItem('primaryColorHue');
const savedBackgroundChoice = sessionStorage.getItem('backgroundChoice');

// Apply retrieved settings
if (savedFontSize) {
    // Apply the saved font size to the root HTML element
    document.querySelector('html').style.fontSize = savedFontSize;
}

if (savedPrimaryColorHue) {
    // Apply the saved primary color hue to your CSS custom property
    root.style.setProperty('--primary-color-hue', savedPrimaryColorHue);
}

if (savedBackgroundChoice) {
    // Apply the saved background choice
    if (savedBackgroundChoice === 'bg1') {
        bg1.classList.add('active');
        bg2.classList.remove('active');
        bg3.classList.remove('active');
        // Apply background 1 styles
        // ...
    } else if (savedBackgroundChoice === 'bg2') {
        bg2.classList.add('active');
        bg1.classList.remove('active');
        bg3.classList.remove('active');
        // Apply background 2 styles
        // ...
    } else if (savedBackgroundChoice === 'bg3') {
        bg3.classList.add('active');
        bg1.classList.remove('active');
        bg2.classList.remove('active');
        // Apply background 3 styles
        // ...
    }
}