//size
let fontSizeCookie = document.querySelectorAll('.choose-size span');
const rootCookie = document.querySelector(':root');
//color
const colorPaletteCookie = document.querySelectorAll('.choose-color span')
//background
const bg1Cookie = document.querySelector('.bg-1');
const bg2Cookie = document.querySelector('.bg-2');
const bg3Cookie = document.querySelector('.bg-3');

const cookieValue = document.cookie
    .split("; ")
    .find((row) => row.startsWith("theme="))
    ?.split("=")[1]
    .replace('[',"")
    .replace("]","")
    .split(",");

        if (cookieValue[0] == '10') {
            fontSizeCookie = '10px';
            rootCookie.style.setProperty('----sticky-top-left', '5.4rem');
            rootCookie.style.setProperty('----sticky-top-right', '5.4rem');
        }
        else if (cookieValue[0] == '13') {
            fontSizeCookie = '13px';
            rootCookie.style.setProperty('----sticky-top-left', '5.4rem');
            rootCookie.style.setProperty('----sticky-top-right', '-7rem');
        }
        else if (cookieValue[0] == '16' || cookieValue[0] ===  null ) {
            fontSizeCookie = '16px';
            rootCookie.style.setProperty('----sticky-top-left', '2rem');
            rootCookie.style.setProperty('----sticky-top-right', '-17rem');
        }
        else if (cookieValue[0] == '19') {
            fontSizeCookie = '19px';
            rootCookie.style.setProperty('----sticky-top-left', '-5rem');
            rootCookie.style.setProperty('----sticky-top-right', '-25rem');
        }
        else if (cookieValue[0] == '22') {
            fontSizeCookie = '22px';
            rootCookie.style.setProperty('----sticky-top-left', '-12');
            rootCookie.style.setProperty('----sticky-top-right', '-35');
        }
        //CHANGE FONT SIZE OF THE ROOT HTML ELEMENT
        else if (cookieValue[0] ==  'null') {
            fontSizeCookie = '16px';
            rootCookie.style.setProperty('----sticky-top-left', '2rem');
            rootCookie.style.setProperty('----sticky-top-right', '-17rem');
        }
        document.querySelector('html').style.fontSize = fontSizeCookie;


//CHANGE PRIMARY COLOR

        let primaryHue;
        //REMOVE ACTIVE COLOR CHANGE
        if (cookieValue[1] == '1' || cookieValue[1] == 'null' ) {
            primaryHue = 252;
        } else if (cookieValue[1] == '2') {
            primaryHue = 52;
        } else if (cookieValue[1] == '3') {
            primaryHue = 352;
        } else if (cookieValue[1] == '4') {
            primaryHue = 152;

        } else if (cookieValue[1] == '5') {
            primaryHue = 202;
        }

        rootCookie.style.setProperty('--primary-color-hue', primaryHue);




//theme background values
let lightColorLightnessCookie;
let whiteColorLightnessCookie;
let darkColorLightnessCookie;

const changeBGCookie = () => {
    rootCookie.style.setProperty('--light-color-lightness', lightColorLightnessCookie);
    rootCookie.style.setProperty('--white-color-lightness', whiteColorLightnessCookie);
    rootCookie.style.setProperty('--dark-color-lightness', darkColorLightnessCookie);
}



if (cookieValue[2] == '1' || cookieValue[2] == 'null') {

    darkColorLightnesCookie='0%';
    whiteColorLightnessCookie ='100%';
    lightColorLightnessCookie = '90%';

    changeBGCookie()
}


 if (cookieValue[2] == '2') {
    darkColorLightnesCookie='95%';
    whiteColorLightnessCookie ='20%';
    lightColorLightnessCookie = '15%';

    changeBGCookie()
}

else if (cookieValue[2] == '3' ) {
    darkColorLightnessCookie = '95%';
    whiteColorLightnessCookie = '10%';
    lightColorLightnessCookie = '0%';

    changeBGCookie()
}

