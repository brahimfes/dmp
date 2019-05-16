function getHL7(data) {
  console.log(data);
  var message = '';
  message = message + 'MSH|^~\&|GHH LAB|ELAB-3|GHH OE|BLDG4|200202150930||ORU^R01|CNTRL-3456|P|2.4\n';
  message = message + 'PID|||' + data.pid + '|||' + data.nom_du_patient + '|196203520||||' + data.nom_du_medecin + '||||||||| 67 - A4335 ^ OH ^ 20030520\n';
  message = message + 'SCH|' + data.id + '||||||||20|MIN||||||JOHN|||||||||ARRIVED|\n';
  message = message + 'OBR|1|845439^GHH OE|1045813^GHH LAB|1554-5^GLUCOSE|||' + data.dates +'||||||||555-55-5555^PRIMARY^PATRICIA P^^^^MD^^LEVEL SEVEN HEALTHCARE, INC.|||||||||F||||||444-44-4444^HIPPOCRATES^HOWARD H^^^^MD\n';
  message = message + 'OBX|1|SN| ' + data.acte + '||^182|mg/dl|70_105|H|||F\n';
  rdvButton = document.getElementById(data.id);
  rdvButton.disabled = true;
  rdvButton.innerText = "Examen en cours";
  addTransaction(message);
}

const addTransaction = async (data) => {
  const response = await fetch('http://127.0.0.1:5000/transactions', {
    method: 'POST',
    body: data,
    headers: {
      'Content-Type': 'text/plain'
    }
  });
  const myJson = await response.json(); //extract JSON from the http response
  console.log('result', myJson);
  mine();
}

const mine = async () => {
  const response = await fetch('http://127.0.0.1:5000/mine', {
    method: 'GET'
  });
  const myJson = await response.json(); //extract JSON from the http response
  console.log('result', myJson);
}