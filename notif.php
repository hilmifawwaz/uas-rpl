<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notification</title>
</head>

<body>

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

  <p><button onclick="requestPermission()">Request permission</button></p>
  <p><button onclick="nonPersistentNotification()">Non-persistent notification</button></p>
  <p><button onclick="persistentNotification()">Persistent notification</button></p>


</body>

</html>