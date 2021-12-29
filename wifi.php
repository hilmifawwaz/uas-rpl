<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Aurelio De Rosa">
  <title>Network Information API Demo by Aurelio De Rosa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <style>
    * {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }

    body {
      max-width: 500px;
      margin: 2em auto;
      padding: 0 0.5em;
      font-size: 20px;
    }

    h1 {
      text-align: center;
    }

    .api-support {
      display: block;
    }

    .hidden {
      display: none;
    }

    .value {
      font-weight: bold;
    }

    .author {
      display: block;
      margin-top: 1em;
    }
  </style>
</head>

<body>
  <a class="btn btn-primary" href="index.html" role="button">Back</a><br>
  <h1>Network Information API</h1>

  <span id="ni-unsupported" class="api-support hidden">API not supported</span>
  <span id="nio-supported" class="api-support hidden">Old API version supported</span>

  <ul>
    <li class="new-api hidden">
      The connection type is <span id="t-value" class="value">undefined</span>.
    </li>
    <li class="old-api hidden">
      The connection bandwidth is <span id="b-value" class="value">undefined</span>.
    </li>
    <li class="old-api hidden">
      The connection is <span id="m-value" class="value">undefined</span>.
    </li>
  </ul>

  <p>Sumber : https://github.com/AurelioDeRosa/HTML5-API-demos</p>

  <script>
    var connection = window.navigator.connection ||
      window.navigator.mozConnection ||
      null;
    if (connection === null) {
      document.getElementById('ni-unsupported').classList.remove('hidden');
    } else if ('metered' in connection) {
      document.getElementById('nio-supported').classList.remove('hidden');
      [].slice.call(document.getElementsByClassName('old-api')).forEach(function(element) {
        element.classList.remove('hidden');
      });

      var bandwidthValue = document.getElementById('b-value');
      var meteredValue = document.getElementById('m-value');

      connection.addEventListener('change', function(event) {
        bandwidthValue.innerHTML = connection.bandwidth;
        meteredValue.innerHTML = (connection.metered ? '' : 'not ') + 'metered';
      });
      connection.dispatchEvent(new Event('change'));
    } else {
      var typeValue = document.getElementById('t-value');
      [].slice.call(document.getElementsByClassName('new-api')).forEach(function(element) {
        element.classList.remove('hidden');
      });

      connection.addEventListener('typechange', function(event) {
        typeValue.innerHTML = connection.type;
      });
      connection.dispatchEvent(new Event('typechange'));
    }
  </script>
</body>

</html>