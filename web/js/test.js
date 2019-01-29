function monClick() {
    var t = window.document.querySelector("#test");
    t.innerHTML = "test is ok.";
    console.log("t");
}

function even(evt) {
    var tmp = "";
    evt = evt || window.event;
    for(p in evt){
        tmp+= p + " = "+evt[p]+"<br/>";
    }
    document.getElementById("test").innerHTML = tmp;
}

function activer() {
    alert("le lien ne fonctionne pas");
    return false;
}

var notes = (function(){
    var model = {
        data : []
    };
    model.ajout = function(note){
        this.data.push({"texte" : note });
        vue.maj();
    };
    model.supprimer = function(){
        this.data.splice(index,1);
        vue.maj();
    };

    var vue = {
        maj : function(){
            var v = document.getElementById("notesVue") || document.body;
            var tmp = "";
            for(var i = 0; i < model.data.length;i++){
                tmp += "<div>";
                tmp += model.data[i].texte;
                tmp += "<a href=\"#\" onClick = 'notes.supprimerItem("+i+")'>[-]</a>";
                tmp += "</div>"
            }
            v.innerHTML = tmp;
        }
    };

    return{
        ajoutItem : function(){
            var note = prompt("votre note");
            if(note){
                model.ajout(note);
            }
        },
        supprimerItem : function(index){
            model.supprimer(index);
        }
    };
})();


var qcm = (function(){

    Array.prototype.randomize = function(){
       this.sort(function(a , b){
           if(Math.random() <= 0.5)
           {return 1;}
           else
           {return -1;}
       });
    };

    var questions = [];

    function creationQuestion(){
        var objet = {
          question : arguments[0],
          reponses : []
        };
        for(var i = 1; i< arguments.length;i++){
            objet.reponses.push(arguments[i]);
        }
        objet.reponses.randomize();
        objet.reponse = arguments[1];
        return objet;
    }

    function afficher(id){
        var parent = document.getElementById(id);

        for(var i = 0 ; i < questions.length ; i++){
            var d = document.createElement("div");
            d.appendChild(document.createTextNode(questions[i].question));
            d.appendChild(document.createElement("br"));

            for(var j = 0 ; j < questions[i].reponses.length ; j++){
                var r = document.createElement("input");
                r.type = "checkbox";
                d.appendChild(r);
                d.appendChild(document.createTextNode(questions[i].reponses[j]));
                d.appendChild(document.createElement("br"));
            }
            parent.appendChild(d);

        }
    }

    function valider(id){
        var score = 0;

        var parent = document.getElementById(id);
        var l = parent.childNodes;
        for(var i = l.length - 1; i>=0;i++){
            var reponses = l[i].childNodes;
            var cptRep = 0;
            for(var j = reponses.length-1;j>=0;j--) {
                if (reponses[j].nodeName == "INPUT") {
                    if (reponses[j].checked) {
                        if (reponses[j].nextSibling.nodeValue === questions[i].reponse) {
                            score++
                        }
                    }
                }
            }
        }
        alert("votre score est de "+ score+" / "+ questions.length );
    }

    return{
        ajouterQuestion : function(){
            questions.push(creationQuestion.apply(this , arguments));
        },
        demarrer : function(){
            questions.randomize();
            afficher("qcm");
        },
        valider : function(){
            valider("qcm");
        }

    };

})();


