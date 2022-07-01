let pass1 = document.querySelector("#register-password");
let pass2 = document.querySelector("#register-confirmed-password");
let pass1check = document.querySelector("#password-check");
let pass2check = document.querySelector("#confirmed-password-check");
let pass1progress = document.querySelector("#password-progress");

let progressBar = [0, 0, 0, 0, 0, 0];

pass1.addEventListener("input",function(){

    pass1check.children[0].innerHTML = "Au moins un chiffre";
    pass1check.children[1].innerHTML = "Au moins une minuscule";
    pass1check.children[2].innerHTML = "Au moins une majuscule";
    pass1check.children[3].innerHTML = "Au moins un caractère spécial";
    pass1check.children[4].innerHTML = "Au moins 8 caractères";

    let hasDigits = (pass1.value.match(/(?=.*[0-9])/) != null);
    let hasLowerCase = (pass1.value.match(/(?=.*[a-z])/) != null); // (de a-z + éèêëàâîïôöûü) == minuscules
    let hasUpperCase = (pass1.value.match(/(?=.*[A-Z])/) != null);
    let hasSpecialChar = (pass1.value.match(/(?=.*[\+\(\)\|\*\$\^\.\[\]\{\}\-\?\/\_\=\~\!\€\#\@\;])/) != null); // Négation de (Lettres, Chiffres, accents) == Special chars
    let has8chars = (pass1.value.length >= 8);

    if(hasDigits === true){
        pass1check.children[0].setAttribute('class', 'valid');
        if(progressBar[0] === 0){
            progressBar[0] = 12;
        }
    }else{
        pass1check.children[0].setAttribute('class', 'invalid');
        if(progressBar[0] === 12){
            progressBar[0] = 0;
        }
    }

    if(hasLowerCase === true){
        pass1check.children[1].setAttribute('class', 'valid');
        if(progressBar[1] === 0){
            progressBar[1] = 12;
        }
    }else{
        pass1check.children[1].setAttribute('class', 'invalid');
        if(progressBar[1] === 12){
            progressBar[1] = 0;
        }
    }

    if(hasUpperCase === true){
        pass1check.children[2].setAttribute('class', 'valid');
        if(progressBar[2] === 0){
            progressBar[2] = 12;
        }
    }else{
        pass1check.children[2].setAttribute('class', 'invalid');
        if(progressBar[2] === 12){
            progressBar[2] = 0;
        }
    }

    if(hasSpecialChar === true
    ){pass1check.children[3].setAttribute('class', 'valid');
        if(progressBar[3] === 0){
            progressBar[3] = 12;
        }
    }else{
        pass1check.children[3].setAttribute('class', 'invalid');
        if(progressBar[3] === 12){
            progressBar[3] = 0;
        }
    }

    if(has8chars === true){
        pass1check.children[4].setAttribute('class', 'valid');
        if(progressBar[4] === 0){
            progressBar[4] = 12;
        }
    }else{
        pass1check.children[4].setAttribute('class', 'invalid');
        if(progressBar[4] === 12){
            progressBar[4] = 0;
        }
    }

    if(pass1.value.length >= 8 && pass1.value.length < 14 && somme(progressBar) >= 60){
        pass1progress.classList.remove("progress-bar-striped");
        pass1progress.classList.remove("bg-danger");
        pass1progress.classList.add("bg-success");
        progressBar[5] = 20;
    }else if(pass1.value.length >= 14 && somme(progressBar) >= 80){
        pass1progress.classList.add("progress-bar-striped");
        progressBar[5] = 40;
    }else {
        progressBar[5] = 0;
        pass1progress.classList.remove("progress-bar-striped");
        pass1progress.classList.add("bg-danger");
    }

    pass1progress.style.cssText = `width:${somme(progressBar)}%;`;
});

function somme(tab){
    let somme = 0;
    for(let i=0; i < tab.length; i++){
        somme += tab[i];
    }
    return somme;
}