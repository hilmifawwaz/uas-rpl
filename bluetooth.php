<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bluetooth</title>
</head>

<body>

  <script>
    function readBatteryLevel() {
      var $target = document.getElementById('target');

      if (!('bluetooth' in navigator)) {
        $target.innerText = 'Bluetooth API not supported.';
        return;
      }

      navigator.bluetooth.requestDevice({
          filters: [{
            services: ['battery_service']
          }]
        })
        .then(function(device) {
          return device.gatt.connect();
        })
        .then(function(server) {
          return server.getPrimaryService('battery_service');
        })
        .then(function(service) {
          return service.getCharacteristic('battery_level');
        })
        .then(function(characteristic) {
          return characteristic.readValue();
        })
        .then(function(value) {
          $target.innerHTML = 'Battery percentage is ' + value.getUint8(0) + '.';
        })
        .catch(function(error) {
          $target.innerText = error;
        });
    }
  </script>

  <p>
    <button onclick="readBatteryLevel()">Read Bluetooth device's<br>battery level</button>
  </p>

  <p id="target"></p>
</body>

</html>