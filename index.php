<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Controle MIO800</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="card">
  <h1>Controle MIO800</h1>

  <input type="number" id="address" placeholder="Address (ex: 1)">
  <input type="number" id="time" placeholder="Tempo (ms opcional)">

  <button class="ligar" onclick="ligar()">LIGAR</button>
  <button class="desligar" onclick="desligar()">DESLIGAR</button>

  <div class="status" id="status">Aguardando ação...</div>
</div>

<script>
function ligar() {
  let address = document.getElementById('address').value;
  let time = document.getElementById('time').value;

  fetch(`ligar.php?address=${address}&time_1=${time}`)
    .then(r => r.text())
    .then(data => {
      document.getElementById('status').innerText = "Dispositivo LIGADO ✔";
      console.log(data);
    })
    .catch(err => {
      document.getElementById('status').innerText = "Erro ao ligar ❌";
    });
}

function desligar() {
  let address = document.getElementById('address').value;

  fetch(`desligar.php?address=${address}`)
    .then(r => r.text())
    .then(data => {
      document.getElementById('status').innerText = "Dispositivo DESLIGADO ✔";
      console.log(data);
    })
    .catch(err => {
      document.getElementById('status').innerText = "Erro ao desligar ❌";
    });
}
</script>

</body>
</html>