<!DOCTYPE html>
<html lang="en">

<head>
  <title>Accelerometer</title>

  <!-- panggil css -->
  <link rel="stylesheet" href="/assets/css/main.css">

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
  <a class="btn btn-primary" href="index.html" role="button">Back</a><br>
  <div class="content">

    <div class="text-center">
      <h3>Gyroscope</h3>

      <a class="btn btn-success" role="button" id="start_demo">Start demo</a><br>

      <h4>Num. of datapoints: <span id="num-observed-events">0</span></h4><br>
      <h4>Accelerometer</h4>
      <ul>
        <li>
          X-axis: <span id="Accelerometer_x">0</span><span> m/s<sup>2</sup></span>
        </li>
        <li>
          Y-axis: <span id="Accelerometer_y">0</span><span> m/s<sup>2</sup></span>
        </li>
        <li>
          Z-axis: <span id="Accelerometer_z">0</span><span> m/s<sup>2</sup></span>
        </li>
        <li>Data Interval: <span id="Accelerometer_i">0</span><span> ms</span></li>
      </ul>

      <h4>Accelerometer including gravity</h4>

      <ul>
        <li>
          X-axis: <span id="Accelerometer_gx">0</span><span> m/s<sup>2</sup></span>
        </li>
        <li>
          Y-axis: <span id="Accelerometer_gy">0</span><span> m/s<sup>2</sup></span>
        </li>
        <li>
          Z-axis: <span id="Accelerometer_gz">0</span><span> m/s<sup>2</sup></span>
        </li>
      </ul>

      <p>Sumber: https://developer.mozilla.org/en-US/docs/Web/API/DeviceMotionEvent/rotationRate#syntax</p>
    </div>
  </div>

  <!-- method -->
  <script>
    function incrementEventCount() {
      let counterElement = document.getElementById("num-observed-events");
      let eventCount = parseInt(counterElement.innerHTML);
      counterElement.innerHTML = eventCount + 1;
    }

    function updateFieldIfNotNull(fieldName, value, precision = 10) {
      if (value != null) document.getElementById(fieldName).innerHTML = value.toFixed(precision);
    }

    function handleMotion(event) {
      updateFieldIfNotNull("Accelerometer_gx", event.accelerationIncludingGravity.x);
      updateFieldIfNotNull("Accelerometer_gy", event.accelerationIncludingGravity.y);
      updateFieldIfNotNull("Accelerometer_gz", event.accelerationIncludingGravity.z);

      updateFieldIfNotNull("Accelerometer_x", event.acceleration.x);
      updateFieldIfNotNull("Accelerometer_y", event.acceleration.y);
      updateFieldIfNotNull("Accelerometer_z", event.acceleration.z);

      updateFieldIfNotNull("Accelerometer_i", event.interval, 2);
      incrementEventCount();
    }

    let is_running = false;
    let demo_button = document.getElementById("start_demo");
    demo_button.onclick = function(e) {
      e.preventDefault();

      // Request permission for iOS 13+ devices
      if (DeviceMotionEvent && typeof DeviceMotionEvent.requestPermission === "function") {
        DeviceMotionEvent.requestPermission();
      }

      if (is_running) {
        window.removeEventListener("devicemotion", handleMotion);
        demo_button.innerHTML = "Start demo";
        demo_button.classList.add("btn-success");
        demo_button.classList.remove("btn-danger");
        is_running = false;
      } else {
        window.addEventListener("devicemotion", handleMotion);
        document.getElementById("start_demo").innerHTML = "Stop demo";
        demo_button.classList.remove("btn-success");
        demo_button.classList.add("btn-danger");
        is_running = true;
      }
    };
  </script>

  <!-- Javascript Support -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>