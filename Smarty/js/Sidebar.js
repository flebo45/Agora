//SIDE BAR
// MENU
const menuItems = document.querySelectorAll('.menu-items');

//THEME
const theme = document.querySelector('#theme');
const themeModal1 = document.querySelector('.customize-theme')
//size
const fontSize = document.querySelectorAll('.choose-size span');
const root = document.querySelector(':root');
//color
const colorPalette = document.querySelectorAll('.choose-color span')
//background
const bg1 = document.querySelector('.bg-1');
const bg2 = document.querySelector('.bg-2');
const bg3 = document.querySelector('.bg-3');

//REMOVE ACTIVE CLASS FROM ALL MENU ITEMS

const changeActiveItem = () => {
    menuItems.forEach(item=> {
        item.classList.remove('active');
    })
}

//NOTIFICATION POPUP AND HIGHLIGHTS SIDEBAR
menuItems.forEach(item=> {
    item.addEventListener('click',()=> {
        changeActiveItem();
        item.classList.add('active');
    })
})

// THEME CUSTOMIZATION
//OPEN MODAL
const openThemeModal =() => {
    themeModal1.style.display = 'grid'
}

const closeThemeModal=(e)=>{
    if(e.target.classList.contains('customize-theme')){
        themeModal1.style.display =  'none';
    }
}
//CLOSE MODAL
themeModal1.addEventListener('click', closeThemeModal)
theme.addEventListener('click', openThemeModal)
//FONTS
//REMOVE ACTIVE CLASS FROM SPANS OR FONT SIZE SELECTOR

const removeSizeSelector = () =>{
    fontSize.forEach(size =>{
        size.classList.remove('active')
    })
}


fontSize.forEach(size =>{


    size.addEventListener('click', ()=> {

        removeSizeSelector()
        let fontSize;
        size.classList.toggle('active');


        if (size.classList.contains('font-size-1')) {
            fontSize = '10px';
            root.style.setProperty('----sticky-top-left', '5.4rem');
            root.style.setProperty('----sticky-top-right', '5.4rem');

        }
        else if (size.classList.contains('font-size-2')) {
            fontSize = '13px';
            root.style.setProperty('----sticky-top-left', '5.4rem');
            root.style.setProperty('----sticky-top-right', '-7rem');

        }
        else if (size.classList.contains('font-size-3')) {
            fontSize = '16px';
            root.style.setProperty('----sticky-top-left', '2rem');
            root.style.setProperty('----sticky-top-right', '-17rem');
        }
        else if (size.classList.contains('font-size-4')) {
            fontSize = '19px';
            root.style.setProperty('----sticky-top-left', '-5rem');
            root.style.setProperty('----sticky-top-right', '-25rem');
        }
        else if (size.classList.contains('font-size-5')) {
            fontSize = '22px';
            root.style.setProperty('----sticky-top-left', '-12');
            root.style.setProperty('----sticky-top-right', '-35');
        }
        //CHANGE FONT SIZE OF THE ROOT HTML ELEMENT

        document.querySelector('html').style.fontSize = fontSize;
    })


})
//REMOVE ACTIVE COLOR CHANGE
const changeActiveColorClass = () =>{
    colorPalette.forEach(colorPicker =>{
        colorPicker.classList.remove('active');
    })
}
//CHANGE PRIMARY COLOR
colorPalette.forEach(color => {
    color.addEventListener('click', () =>{
        let primaryHue;
        //REMOVE ACTIVE COLOR CHANGE
        changeActiveColorClass()
        if (color.classList.contains('color-1')) {
            primaryHue = 252;
        } else if (color.classList.contains('color-2')) {
            primaryHue = 52;
        } else if (color.classList.contains('color-3')) {
            primaryHue = 352;
        } else if (color.classList.contains('color-4')) {
            primaryHue = 152;
        } else if (color.classList.contains('color-5')) {
            primaryHue = 202;
        }

        color.classList.add('active');
        root.style.setProperty('--primary-color-hue', primaryHue);
    })
})

//theme background values

let lightColorLightness;
let whiteColorLightness;
let darkColorLightness;

const changeBG = () => {
    root.style.setProperty('--light-color-lightness', lightColorLightness);
    root.style.setProperty('--white-color-lightness', whiteColorLightness);
    root.style.setProperty('--dark-color-lightness', darkColorLightness);
}



bg1.addEventListener('click', ()=> {


    bg1.classList.add('active');
    bg3.classList.remove('active');
    bg2.classList.remove('active');
    window.location.reload();
})


bg2.addEventListener('click', ()=>{
    darkColorLightness='95%';
    whiteColorLightness ='20%';
    lightColorLightness = '15%';

    bg2.classList.add('active');
    bg1.classList.remove('active');
    bg3.classList.remove('active');
    changeBG();
})

bg3.addEventListener('click', ()=> {
    darkColorLightness = '95%';
    whiteColorLightness = '10%';
    lightColorLightness = '0%';

    bg3.classList.add('active');
    bg1.classList.remove('active');
    bg2.classList.remove('active');
    changeBG();
})

