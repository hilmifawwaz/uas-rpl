<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <title>Notification</title>
</head>

<body>
  <a class="btn btn-primary" href="index.html" role="button">Back</a><br>
  <script>
    var $status = document.getElementById('status');

    if ('Notification' in window) {
      $status.innerText = Notification.permission;
    }

    function requestPermission() {
      if (!('Notification' in window)) {
        alert('Notification API not supported!');
        return;
      }

      Notification.requestPermission(function(result) {
        $status.innerText = result;
      });
    }

    function nonPersistentNotification() {
      if (!('Notification' in window)) {
        alert('Notification API not supported!');
        return;
      }

      try {
        var notification = new Notification("Hi there - non-persistent!");
      } catch (err) {
        alert('Notification API error: ' + err);
      }
    }

    function persistentNotification() {
      if (!('Notification' in window) || !('ServiceWorkerRegistration' in window)) {
        alert('Persistent Notification API not supported!');
        return;
      }

      try {
        navigator.serviceWorker.getRegistration()
          .then((reg) => reg.showNotification("Hi there - persistent!"))
          .catch((err) => alert('Service Worker registration error: ' + err));
      } catch (err) {
        alert('Notification API error: ' + err);
      }
    }
  </script>
  <p>Current permission status is <b id="status">available</b>.</p>

  <p class="btn btn-success" role="button" onclick="requestPermission()">Request permission</button></p>
  <p class="btn btn-success" role="button" onclick="nonPersistentNotification()">Non-persistent notification</button></p>
  <p class="btn btn-success" role="button" onclick="persistentNotification()">Persistent notification</button></p>


</body>

</html>