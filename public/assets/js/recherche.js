var ligneDeRecherche = document.getElementById("rechercheFormation");

var evenement = ligneDeRecherche.addEventListener('keyup', recherche);


var resultat = document.getElementById("resultat")


function recherche() {
    if (document.getElementById("resultatLangage")) {
        var resultatUl = document.getElementById("resultatLangage");
        resultat.removeChild(resultatUl);
    }
    if (document.getElementById("resultatFormation")) {
        var resultatUl = document.getElementById("resultatFormation");
        resultat.removeChild(resultatUl);
    }
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4) {
            monParse = JSON.parse(this.response);
            console.log(monParse[1]);
            var tabLangage = monParse[0];
            var tabFormation=monParse[1];

            if (ligneDeRecherche.value !== "") {
                if (monParse[0] !== null) {
                    var monUl = document.createElement("ul");
                    monUl.id = "resultatLangage";
                    resultat.appendChild(monUl);
                    for (var i = 0; i < tabLangage.length; i++) {
                        var nouvelleLI = document.createElement("li");
                        nouvelleLI.innerHTML = '<a href="'+'http://127.0.0.1:8000/formation/browse/'+tabLangage[i].nomLangage+'">' + tabLangage[i].nomLangage + '</a>';
                        monUl.appendChild(nouvelleLI);
                    }
                }
                if (monParse[1] !== null) {
                    var monUl = document.createElement("ul");
                    monUl.id = "resultatFormation";
                    resultat.appendChild(monUl);
                    for (var i = 0; i < tabFormation.length; i++) {
                        var nouvelleLI = document.createElement("li");
                        nouvelleLI.innerHTML = '<a href="'+'http://127.0.0.1:8000/formation/cours/'+tabFormation[i].idFormation+'">' + tabFormation[i].titreFormation + '</a>';
                        monUl.appendChild(nouvelleLI);
                    }
                }
            }
        }
    };
    ajax.open('POST', 'http://127.0.0.1:8000/rechercher', true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.send('recherche=' + ligneDeRecherche.value);
}