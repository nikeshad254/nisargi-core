        let catBtnActive = false;
        let hamMenuActive = false;
        const catBtn = document.getElementById("cat-btn");
        const categories = document.getElementById('categories');
        const hamMenu = document.getElementById('three-bars');
        const mainNav = document.getElementById('main-nav')
        const middleNav = document.querySelector('.middle-nav');
        const rightNav = document.querySelector('.right-nav');

        function handleCategory(){
            if(catBtnActive){
                catBtn.classList.add('active');
                categories.classList.add('active');
            }else{
                catBtn.classList.remove('active');
                categories.classList.remove('active');
            }
        }
        function handleMenu(){
            if(hamMenuActive){
                middleNav.classList.remove('hidden');
                rightNav.classList.remove('hidden');
                mainNav.style.height = "100vh";
                hamMenu.src = "../images/icons/cross.svg";
            }else{
                middleNav.classList.add('hidden');
                rightNav.classList.add('hidden');
                mainNav.style.height = "3rem";
                hamMenu.src = "../images/icons/3bars.svg";
            }
        }
        handleMenu()

        catBtn.addEventListener('click', ()=>{
            catBtnActive = !catBtnActive? true : false;
            handleCategory();
        })

        hamMenu.addEventListener('click', ()=>{
            hamMenuActive = hamMenuActive? false: true;
            catBtnActive = false;
            handleCategory();
            handleMenu();
        })