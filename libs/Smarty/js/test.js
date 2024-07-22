const $fontSizeCookie = $(".choose-size span");
const $rootCookie = $(":root");
const $colorPaletteCookie = $(".choose-color span");
const $bg1Cookie = $(".bg-1");
const $bg2Cookie = $(".bg-2");
const $bg3Cookie = $(".bg-3");

const cookieValue = document.cookie
  .split("; ")
  .find((row) => row.startsWith("theme="))
  ?.split("=")[1]
  .replace("[", "")
  .replace("]", "")
  .split(",");

let fontSizeCookie;

switch (cookieValue[0]) {
  case "10":
    fontSizeCookie = "10px";
    $rootCookie.css("--sticky-top-left", "5.4rem");
    $rootCookie.css("--sticky-top-right", "5.4rem");
    break;
  case "13":
    fontSizeCookie = "13px";
    $rootCookie.css("--sticky-top-left", "5.4rem");
    $rootCookie.css("--sticky-top-right", "-7rem");
    break;
  case "16":
  case "null":
    fontSizeCookie = "16px";
    $rootCookie.css("--sticky-top-left", "2rem");
    $rootCookie.css("--sticky-top-right", "-17rem");
    break;
  case "19":
    fontSizeCookie = "19px";
    $rootCookie.css("--sticky-top-left", "-5rem");
    $rootCookie.css("--sticky-top-right", "-25rem");
    break;
  case "22":
    fontSizeCookie = "22px";
    $rootCookie.css("--sticky-top-left", "-12rem");
    $rootCookie.css("--sticky-top-right", "-35rem");
    break;
  default:
    fontSizeCookie = "16px";
    $rootCookie.css("--sticky-top-left", "2rem");
    $rootCookie.css("--sticky-top-right", "-17rem");
    break;
}

$("html").css("fontSize", fontSizeCookie);

// CHANGE PRIMARY COLOR
let primaryHue;

switch (cookieValue[1]) {
  case "1":
  case "null":
    primaryHue = 252;
    break;
  case "2":
    primaryHue = 52;
    break;
  case "3":
    primaryHue = 352;
    break;
  case "4":
    primaryHue = 152;
    break;
  case "5":
    primaryHue = 202;
    break;
  default:
    primaryHue = 252;
    break;
}

$rootCookie.css("--primary-color-hue", primaryHue);

// THEME BACKGROUND VALUES
let lightColorLightnessCookie;
let whiteColorLightnessCookie;
let darkColorLightnessCookie;

const changeBGCookie = () => {
  $rootCookie.css("--light-color-lightness", lightColorLightnessCookie);
  $rootCookie.css("--white-color-lightness", whiteColorLightnessCookie);
  $rootCookie.css("--dark-color-lightness", darkColorLightnessCookie);
};

switch (cookieValue[2]) {
  case "1":
  case "null":
    darkColorLightnessCookie = "0%";
    whiteColorLightnessCookie = "100%";
    lightColorLightnessCookie = "90%";
    changeBGCookie();
    break;
  case "2":
    darkColorLightnessCookie = "95%";
    whiteColorLightnessCookie = "20%";
    lightColorLightnessCookie = "15%";
    changeBGCookie();
    break;
  case "3":
    darkColorLightnessCookie = "95%";
    whiteColorLightnessCookie = "10%";
    lightColorLightnessCookie = "0%";
    changeBGCookie();
    break;
  default:
    darkColorLightnessCookie = "0%";
    whiteColorLightnessCookie = "100%";
    lightColorLightnessCookie = "90%";
    changeBGCookie();
    break;
}
