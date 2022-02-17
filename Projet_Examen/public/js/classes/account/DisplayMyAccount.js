export default class DisplayMyAccount{

    constructor(number){
        this.content1 = document.querySelector('.accountContent1'),
        this.content2 = document.querySelector('.accountContent2'),
        this.content3 = document.querySelector('.accountContent3');

        this.whichDisplay(number)
    }

    whichDisplay(number){
        
        switch (number) {
            case 1:
                this.displayAC1()
                break;
            case 2:
                this.displayAC2();
                break;
            case 3:
                this.displayAC3();
                break;       
        }

    }


    displayAC1(){
        this.content1.style.display = 'block';
        this.content2.style.display = 'none';
        this.content3.style.display = 'none';
    }
    
     displayAC2(){
        this.content2.style.display = 'block';
        this.content3.style.display = 'none';
        this.content1.style.display = 'none';
    }
    
     displayAC3(){
        this.content3.style.display = 'block';
        this.content2.style.display = 'none';
        this.content1.style.display = 'none';
    }
}