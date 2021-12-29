<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <title>Microphone</title>
</head>

<body>
  <a class="btn btn-primary" href="index.html" role="button">Back</a><br>
  <script>
    function getUserMedia(constraints) {
      // if Promise-based API is available, use it
      if (navigator.mediaDevices) {
        return navigator.mediaDevices.getUserMedia(constraints);
      }

      // otherwise try falling back to old, possibly prefixed API...
      var legacyApi = navigator.getUserMedia || navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia || navigator.msGetUserMedia;

      if (legacyApi) {
        // ...and promisify it
        return new Promise(function(resolve, reject) {
          legacyApi.bind(navigator)(constraints, resolve, reject);
        });
      }
    }

    function getStream(type) {
      if (!navigator.mediaDevices && !navigator.getUserMedia && !navigator.webkitGetUserMedia &&
        !navigator.mozGetUserMedia && !navigator.msGetUserMedia) {
        alert('User Media API not supported.');
        return;
      }

      var constraints = {};
      constraints[type] = true;

      getUserMedia(constraints)
        .then(function(stream) {
          var mediaControl = document.querySelector(type);

          if ('srcObject' in mediaControl) {
            mediaControl.srcObject = stream;
          } else if (navigator.mozGetUserMedia) {
            mediaControl.mozSrcObject = stream;
          } else {
            mediaControl.src = (window.URL || window.webkitURL).createObjectURL(stream);
          }

          mediaControl.play();
        })
        .catch(function(err) {
          alert('Error: ' + err);
        });
    }
  </script>
  </div>
  <div class="column">
    <p><button type="button" onclick="getStream('audio')">Grab audio</button></p>

    <audio controls></audio>
  </div>
  </div>

</body>

</html>