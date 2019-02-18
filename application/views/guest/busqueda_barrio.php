<?//var_dump($barrios);?>
<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left"><strong>Busqueda por Barrio</strong></h2>
				<div class="row">
					<div class="col-md-12">
						<span style="font-size:16px;">Seleccione el barrio para desplegar el listado de parques.</span>
						</br></br>
						<a class="btn btn-success" id="mod_barrios">Listado de Barrios</a>
						</br></br>
						<?php $attributes = array("name" => "busqueda_barrio_form", "id" => "busqueda_barrio_form", "role" => "form", "method"=>"post"); echo form_open("busqueda/busquedaPorBarrio", $attributes);?>
							<div class="form-group">
								<div class="input-group">
									<input id ="buscar_barrio" type="text" class="form-control" name="barrio" placeholder="Ingrese el nombre del barrio..">
									<span class="input-group-btn">
										<button class="btn btn-success" name="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
									</span>
								</div>
							</div>
							<p class="errorbarrio text-danger"></p>
						<?php echo form_close();?>
            <br/>
						<div class="row" id="resultado">
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>

<!-- 
								<input class="btn btn-default" id="submit" name="submit" type="submit" value="Ingresar" />
-->

<!-- ventana modal barrios -->
<div id="modal_barrios" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="overflow-y: initial">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" style="color: #000000;">
						<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>"> Barrios
					</h4>
			</div>
			<div class="modal-body" id="myModalBody" style="overflow-y: auto; height: 300px;">
				<div class="form-group">
					 <p style="color: #000000; font-weight: bold; text-align: center; font-size: 19px;">Listado</p>
				</div>
				<div class="row" id ="lista_barrios">
					<?php foreach($barrios as $barrio) { ?>
						<center id ="lista_barrios">
							<span style="color: #000000;"><?php echo($barrio->barrio)?></span>
						</center>
					<?php }?>
				</div>
			</div>
			<div class="modal-footer">
				<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
			</div>
		</div>
	</div>
</div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<script>
$(document).ready(function(){
    barrios = new Array;
    $('#lista_barrios').find('span').each(function() {
        barrios.push(this.innerText);
    });
    //console.log(barrios);

    function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
}

autocomplete(document.getElementById("buscar_barrio"), barrios);
});

</script>