<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Network</title>
</head>

<body>
  <script>
    function getConnection() {
      return navigator.connection || navigator.mozConnection ||
        navigator.webkitConnection || navigator.msConnection;
    }

    function updateNetworkInfo(info) {
      document.getElementById('networkType').innerHTML = info.type;
      document.getElementById('effectiveNetworkType').innerHTML = info.effectiveType;
      document.getElementById('downlinkMax').innerHTML = info.downlinkMax;
    }

    var info = getConnection();
    if (info) {
      info.onchange = function(event) {
        updateNetworkInfo(event.target);
      }
      updateNetworkInfo(info);
    }
  </script>
  <p> Current theoretical network type is <b id="networkType"> not available </b>.</p>
  <p> Current effective network type is <b id="effectiveNetworkType"> not available </b>.</p>
  <p> Current max downlink speed is <b id="downlinkMax"> not available </b>.

</body>

</html>