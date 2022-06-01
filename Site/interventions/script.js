

function changeDivToInput() {
    // Change input to div
    var inputs = document.getElementsByClassName('modifierType');
    for (i = 0; i < inputs.length; i++) {
        var div = document.createElement('input');
        for (var attr of inputs[i].attributes) {
            div.setAttribute(attr.name, attr.value);
        }
        div.removeAttribute("name");
        div.removeAttribute("type");
        div.removeAttribute("onchange");

        div.innerHTML = inputs[i].value;
        inputs[i].replaceWith(div);
    }
    addElement();   
}



	function addElement() {
        $("#bouton_modifier").one( "click", function() {
            let btn = document.createElement("button");
            btn.innerHTML = "Click Me";
            btn.addEventListener("click", function () {
                alert("Button is clicked");
              });
            document.body.appendChild(btn);
        }
        );
    }

    function uneFois(){
        getElementsById('bouton_modifier').one( "click", function addElement() {
          });
    }
  


