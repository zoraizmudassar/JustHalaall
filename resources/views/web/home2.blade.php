<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
.container {
  display: flex;
  row-gap: 10px;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  height: 100vh;
  width: 100%;
  overflow: hidden;
}
.container .image {
  position: absolute;
  height: 100%;
  width: 100%;
  object-fit: cover;
  z-index: -1;
}
body::after {
  position: absolute;
  content: "";
  top: 0;
  height: 100%;
  width: 100%;
  background: #000;
  z-index: -1;
  opacity: 0.2;
}
.container header {
  font-size: 60px;
  color: #fff;
  font-weight: 600;
  text-align: center;
}
.container p {
  font-size: 16px;
  font-weight: 400;
  color: #fff;
  max-width: 550px;
  text-align: center;
}
.container .time-content {
  display: flex;
  column-gap: 40px;
  font-size: x-large;
  align-items: center;
  margin: 2rem;
  border: 1px solid white;
  padding: 2rem 2.5rem;
  border-radius: 0.5rem;
  background: rgba(250, 250, 250, 0.2);
}
.time-content .time {
  display: flex;
  align-items: center;
  flex-direction: column;
  width: 100px;
}
.time .number {
  font-weight: 800;
  font-size: 80px;
  line-height: 1;
  color: #eee;
}
.time .text {
  text-transform: capitalize;
  color: #fff;
  font-weight: 600;
  font-size: 12px;
}
.email-content {
  display: flex;
  align-items: center;
  flex-direction: column;
  width: 100%;
}
.email-content p {
  font-size: 13px;
}
.input-box {
  display: flex;
  align-items: center;
  height: 40px;
  max-width: 360px;
  width: 100%;
  margin-top: 20px;
  column-gap: 20px;
}
.input-box input,
.input-box button {
  height: 100%;
  outline: none;
  border: none;
  border: 1px solid #fff;
  border-radius: 4px;
  background-color: rgba(255, 255, 255, 0.2);
  font-weight: 400;
}
.input-box input {
  width: 100%;
  padding: 0 15px;
  color: #fff;
}
input::placeholder {
  color: #fff;
}
.input-box button {
  cursor: pointer;
  background-color: #eee;
  color: #0d6a81;
  white-space: nowrap;
  padding: 0 20px;
  transition: all 0.3s ease;
}
.input-box button:hover {
  background-color: #fff;
}

@media screen and (max-width: 480px) {
  .container header {
    font-size: 50px;
  }
}

</style>
<section class="container">
  <img src="https://images.unsplash.com/photo-1625558298116-38f0173a522c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="" class="image" />
  <header>Website Coming Soon</header>
  <p>
    We are excited to announce that we will be launching soon and can't wait to share our new platform with you.
  </p>
  <div class="time-content" style="text-align: center; color: white">
    <div class="time days">
      <span class="number"></span>
      <span id="c_days">days</span>
    </div>
    <div class="time hours">
      <span class="number"></span>
      <span id="c_hours">hours</span>
    </div>
    <div class="time minutes">
      <span class="number"></span>
      <span id="c_minutes">minutes</span>
    </div>
    <div class="time seconds">
      <span class="number"></span>
      <span id="c_seconds">seconds</span>
    </div>
  </div>
</section>
<script>
 var CountDownDate = new Date("Aug 23, 2023 12:00:00").getTime();

var countdownfunction = setInterval(function() {

    var TimeNow = new Date().getTime();
    var distance = CountDownDate - TimeNow;
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("c_days").innerHTML = days + "<br> Days";
    document.getElementById("c_hours").innerHTML = hours + "<br> Hours";
    document.getElementById("c_minutes").innerHTML = minutes + "<br> Minutes";
    document.getElementById("c_seconds").innerHTML = seconds + "<br> Seconds";

    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("c_days").innerHTML = "0 <br> Days";
    }

    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("c_hours").innerHTML = "0 <br> Hours";
    }

    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("c_minutes").innerHTML = "0 <br> Minutes";
    }

    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("c_seconds").innerHTML = "0 <br> Seconds";
    }

}, 1000);

</script>