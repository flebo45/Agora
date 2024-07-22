const $menuItems = $(".menu-items");
const $theme = $("#theme");
const $themeModal = $(".customize-theme");
const $fontSize = $(".choose-size span");
const $root = $(":root");
const $colorPalette = $(".choose-color span");
const $bg1 = $(".bg-1");
const $bg2 = $(".bg-2");
const $bg3 = $(".bg-3");

let font;
let colors;
let bg;
const Theme = [font, colors, bg];

// REMOVE ACTIVE CLASS FROM ALL MENU ITEMS
const changeActiveItem = () => {
  $menuItems.removeClass("active");
};

// NOTIFICATION POPUP AND HIGHLIGHTS SIDEBAR
$menuItems.on("click", function () {
  changeActiveItem();
  $(this).addClass("active");
});

// THEME CUSTOMIZATION
// OPEN MODAL
const openThemeModal = () => {
  $themeModal.css("display", "grid");
};

const closeThemeModal = (e) => {
  if ($(e.target).hasClass("customize-theme")) {
    const ThemeJSON = JSON.stringify(Theme);
    document.cookie = `theme=${ThemeJSON}; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/; samesite=None; secure`;
    $themeModal.css("display", "none");
  }
};

// CLOSE MODAL
$themeModal.on("click", closeThemeModal);
$theme.on("click", openThemeModal);

// FONTS
// REMOVE ACTIVE CLASS FROM SPANS OR FONT SIZE SELECTOR
const removeSizeSelector = () => {
  $fontSize.removeClass("active");
};

$fontSize.on("click", function () {
  removeSizeSelector();
  let fontSize;
  $(this).addClass("active");

  if ($(this).hasClass("font-size-1")) {
    fontSize = "10px";
    $root.css("--sticky-top-left", "5.4rem");
    $root.css("--sticky-top-right", "5.4rem");
    font = 10;
  } else if ($(this).hasClass("font-size-2")) {
    fontSize = "13px";
    $root.css("--sticky-top-left", "5.4rem");
    $root.css("--sticky-top-right", "-7rem");
    font = 13;
  } else if ($(this).hasClass("font-size-3")) {
    fontSize = "16px";
    $root.css("--sticky-top-left", "2rem");
    $root.css("--sticky-top-right", "-17rem");
    font = 16;
  } else if ($(this).hasClass("font-size-4")) {
    fontSize = "19px";
    $root.css("--sticky-top-left", "-5rem");
    $root.css("--sticky-top-right", "-25rem");
    font = 19;
  } else if ($(this).hasClass("font-size-5")) {
    fontSize = "22px";
    $root.css("--sticky-top-left", "-12rem");
    $root.css("--sticky-top-right", "-35rem");
    font = 22;
  }

  // CHANGE FONT SIZE OF THE ROOT HTML ELEMENT
  $("html").css("fontSize", fontSize);
  setCookieFont(font);
});

function setCookieFont(font) {
  Theme[0] = font;
}

// REMOVE ACTIVE COLOR CHANGE
const changeActiveColorClass = () => {
  $colorPalette.removeClass("active");
};

// CHANGE PRIMARY COLOR
$colorPalette.on("click", function () {
  let primaryHue;
  changeActiveColorClass();
  if ($(this).hasClass("color-1")) {
    primaryHue = 252;
    colors = 1;
  } else if ($(this).hasClass("color-2")) {
    primaryHue = 52;
    colors = 2;
  } else if ($(this).hasClass("color-3")) {
    primaryHue = 352;
    colors = 3;
  } else if ($(this).hasClass("color-4")) {
    primaryHue = 152;
    colors = 4;
  } else if ($(this).hasClass("color-5")) {
    primaryHue = 202;
    colors = 5;
  }

  $(this).addClass("active");
  $root.css("--primary-color-hue", primaryHue);
  setCookieColor(colors);
});

function setCookieColor(colors) {
  Theme[1] = colors;
}

// THEME BACKGROUND VALUES
let lightColorLightness;
let whiteColorLightness;
let darkColorLightness;

const changeBG = () => {
  $root.css("--light-color-lightness", lightColorLightness);
  $root.css("--white-color-lightness", whiteColorLightness);
  $root.css("--dark-color-lightness", darkColorLightness);
};

$bg1.on("click", function () {
  darkColorLightness = "0%";
  whiteColorLightness = "100%";
  lightColorLightness = "90%";

  $bg1.addClass("active");
  $bg2.removeClass("active");
  $bg3.removeClass("active");
  changeBG();
  Theme[2] = 1;
});

$bg2.on("click", function () {
  darkColorLightness = "95%";
  whiteColorLightness = "20%";
  lightColorLightness = "15%";

  $bg2.addClass("active");
  $bg1.removeClass("active");
  $bg3.removeClass("active");
  changeBG();
  Theme[2] = 2;
});

$bg3.on("click", function () {
  darkColorLightness = "95%";
  whiteColorLightness = "10%";
  lightColorLightness = "0%";

  $bg3.addClass("active");
  $bg1.removeClass("active");
  $bg2.removeClass("active");
  changeBG();
  Theme[2] = 3;
});
