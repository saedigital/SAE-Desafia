window.onload = () => {
  attachEventHandlers();
  atualizarEventos();
};

const BASE_URL = "http://localhost:3000/";

// https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
function post(url = "", data = {}) {
  // Default options are marked with *
  return fetch(url, {
    method: "POST", // *GET, POST, PUT, DELETE, etc.
    mode: "cors", // no-cors, cors, *same-origin
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    credentials: "same-origin", // include, *same-origin, omit
    headers: {
      "Content-Type": "application/json"
      // "Content-Type": "application/x-www-form-urlencoded",
    },
    redirect: "follow", // manual, *follow, error
    referrer: "no-referrer", // no-referrer, *client
    body: JSON.stringify(data) // body data type must match "Content-Type" header
  });
}
// Cant use deleted because of the keyword delete
function del(url = "", data = {}) {
  // Default options are marked with *
  return fetch(url, {
    method: "DELETE", // *GET, POST, PUT, DELETE, etc.
    mode: "cors", // no-cors, cors, *same-origin
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    credentials: "same-origin", // include, *same-origin, omit
    headers: {
      "Content-Type": "application/json"
      // "Content-Type": "application/x-www-form-urlencoded",
    },
    redirect: "follow", // manual, *follow, error
    referrer: "no-referrer", // no-referrer, *client
    body: JSON.stringify(data) // body data type must match "Content-Type" header
  });
}

function get(url = "") {
  return fetch(BASE_URL + url).then(response => response.json());
}

function atualizarEventos() {
  get("api/espetaculos").then(data => {
    const selectEspetaculos = document.getElementById("espetaculos");

    clearElementChilds(selectEspetaculos);

    const emptyElement = document.createElement("option");
    selectEspetaculos.appendChild(emptyElement);

    for(const espetaculo of data){
      const element = document.createElement("option");

      element.setAttribute("value", espetaculo._id);
      element.text = espetaculo.nome;

      selectEspetaculos.appendChild(element);
    }
  });
}

function clearElementChilds(element){
  while(element.firstChild){
    element.removeChild(element.firstChild);
  }
}

function onEspetaculoChanged(event){
  const id = event.target.value;

  if (id){
    atualizarAssentos(id);
  }
}

function atualizarAssentos(idEspetaculo){
  const elementoAssentos = document.getElementById("container-assentos");

  clearElementChilds(elementoAssentos);

  get("api/espetaculo/" + idEspetaculo).then((espetaculo) => {    
    for(let i = 0; i < espetaculo.numeroAssentos; i++){
      const templateCopy = document.importNode(document.getElementById("template-assento").content, true);

      const reserva = espetaculo.reservas.find(reserva => reserva.numeroCadeira == i);

      const divCirculo = templateCopy.querySelector(".circle");
      const divNumero = templateCopy.querySelector(".center-content");
      const divTexto = templateCopy.querySelector(".text");
      const root = templateCopy.children[0];

      divNumero.textContent = i;
      root.setAttribute("data-assento", i);
      root.setAttribute("data-espetaculo", idEspetaculo);

      if (reserva){
        root.setAttribute("data-reserva", reserva._id);

        divCirculo.classList.add("red");
        divTexto.textContent = "Reservado";
      }else{
        divCirculo.classList.add("gray");
        divTexto.textContent = "Livre";
      }

      root.addEventListener("click", onAssentoClicked);

      elementoAssentos.appendChild(templateCopy);        
    }
  });
}

function getReservaFromModal(){
  const idEspetaculoElement = document.getElementById("reserva-espetaculo-id");
  const nomeElement = document.getElementById("reserva-nome");
  const emailElement = document.getElementById("reserva-email");
  const numeroCadeiraElement = document.getElementById("reserva-cadeira");

  return {
    idEspetaculo: idEspetaculoElement.value,
    nomePessoa: nomeElement.value,
    email: emailElement.value,
    numeroCadeira: numeroCadeiraElement.value
  };
}

function onSalvarReservaClicked(){
  const reserva = getReservaFromModal();
  
  if (!reserva.nomePessoa){
    setReservaErrorMessage("O nome não pode ser vazio");
    showReservaErrorMessage();
    return;
  }

  if (!reserva.email){
    setReservaErrorMessage("O email não pode ser vazio");
    showReservaErrorMessage();
    return;
  }

  post(`api/espetaculo/${reserva.idEspetaculo}/reservar`, reserva).then(() => {
    hideReservaModal();
    
    atualizarEventos();
    atualizarAssentos(reserva.idEspetaculo);
  });
}

function showReservaErrorMessage(){
  document.getElementById("reserva-error").style.display = "block";
}

function hideReservaErrorMessage(){
  document.getElementById("reserva-error").style.display = "none";
}

function setReservaErrorMessage(message){
  document.getElementById("reserva-error").innerText = message;
}

function onCancelarReservaClicked(){
  hideReservaModal();
}

function getEspetaculoFromModal(){
  const idElement = document.getElementById("espetaculo-id");
  const nomeElement = document.getElementById("espetaculo-nome");
  const assentosElement = document.getElementById("espetaculo-assentos");

  const espetaculo = {};

  if (idElement.value){
    espetaculo._id = idElement.value;
  }

  espetaculo.nome = nomeElement.value;
  espetaculo.numeroAssentos = parseInt(assentosElement.value);

  return espetaculo;
}

function setEspetaculoErrorMessage(message){
  document.getElementById("espetaculo-error").innerText = message;
}

function showEspetaculoError(){
  document.getElementById("espetaculo-error").style.display = "block";
}

function hideEspetaculoError(){
  document.getElementById("espetaculo-error").style.display = "hidden";
}

function onSalvarEspetaculoClicked(){
  const espetaculo = getEspetaculoFromModal();

  if (!espetaculo.nome){
    setEspetaculoErrorMessage("O nome não pode ser vazio");
    showEspetaculoError();
    return;
  }

  if (!espetaculo.numeroAssentos){
    setEspetaculoErrorMessage("A quantidade de assentos não pode ser vazia");
    showEspetaculoError();
    return;
  }

  if (espetaculo.numeroAssentos < 0){
    setEspetaculoErrorMessage("A quantidade de assentos não pode ser negativa");
    showEspetaculoError();
    return;
  }

  hideEspetaculoError();

  post("api/espetaculo", espetaculo).then(() => {
    hideEspetaculoModal();
    atualizarEventos();

    if (espetaculo._id){
      atualizarAssentos(espetaculo._id);
    }
  });
}

function onCancelarEspetaculoClicked(){
  hideEspetaculoModal();
}

function hideEspetaculoModal(){
  document.getElementById("modal-espetaculo").style.display = "none";
}

function showEspetaculoModal(){
  document.getElementById("modal-espetaculo").style.display = "flex";
}

function onAssentoClicked(event){
  const element = event.target;
  const idReserva = element.getAttribute("data-reserva");
  const idEspetaculo = element.getAttribute("data-espetaculo");
  const numeroCadeira = element.getAttribute("data-assento");

  if (idReserva){
    del(`api/espetaculo/${idEspetaculo}/reserva/${idReserva}`).then(() => {
      atualizarAssentos(idEspetaculo);
    });
  }else{
    document.getElementById("reserva-espetaculo-id").value = idEspetaculo;
    document.getElementById("reserva-cadeira").value = numeroCadeira;
    document.getElementById("reserva-nome").value = "";
    document.getElementById("reserva-email").value = "";
    
    showReservaModal();
  }
}

function showReservaModal(){
  document.getElementById("modal-reserva").style.display = "flex";
}

function hideReservaModal(){
  document.getElementById("modal-reserva").style.display = "none";
}

function onNovoEventoClicked() {
  showEspetaculoModal();
}

function onEditarEventoClicked() {
  const idSelecionado = document.getElementById("espetaculos").value;
  if (idSelecionado){
    get("api/espetaculo/" + idSelecionado).then(espetaculo => {
      document.getElementById("espetaculo-id").value = espetaculo._id;
      document.getElementById("espetaculo-nome").value = espetaculo.nome;
      document.getElementById("espetaculo-assentos").value = espetaculo.numeroAssentos;

      showEspetaculoModal();
    });
  }
  
}

function onDeletarEventoClicked() {
  const idEspetaculo = document.getElementById("espetaculos").value;

  if (idEspetaculo){
    del(`api/espetaculo/${idEspetaculo}`).then(() => {
      atualizarEventos();
      clearElementChilds(document.getElementById("container-assentos"));
    });
  }
}

function attachEventHandlers(){
  const selectEspetaculos = document.getElementById("espetaculos");
  selectEspetaculos.addEventListener("change", onEspetaculoChanged);
}
