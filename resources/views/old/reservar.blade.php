<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<style>
    @import url("https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap");

* {
  box-sizing: border-box;
}

html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 30px 10px;
  font-family: 'DM Sans', sans-serif;
  transition: background .4s ease-in;
  background-color: #070920;
  
  &.blue {
    background-color: #428aa6;
  }
}

input[type=radio] {
  display: none;
}

.card {
  position: absolute;
  width: 60%;
  height: 100%;
  left: 0;
  right: 0;
  margin: auto;
  transition: transform .4s ease;
  cursor: pointer;
}

.container {
  width: 100%;
  max-width: 800px;
  max-height: 600px;
  height: 100%;
  transform-style: preserve-3d;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}

.cards {
  position: relative;
  width: 100%;
  height: 100%;
  margin-bottom: 20px;
}

img {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  object-fit: cover;
}

#item-4:checked ~ .cards #song-3, #item-2:checked ~ .cards #song-1, #item-3:checked ~ .cards #song-2, #item-1:checked ~ .cards #song-4 {
  transform: translatex(-40%) scale(.8);
  opacity: .4;
  z-index: 0;
}

#item-1:checked ~ .cards #song-2, #item-2:checked ~ .cards #song-3, #item-3:checked ~ .cards #song-4, #item-4:checked ~ .cards #song-1 {
  transform: translatex(40%) scale(.8);
  opacity: .4;
  z-index: 0;
}

#item-1:checked ~ .cards #song-1, #item-2:checked ~ .cards #song-2, #item-3:checked ~ .cards #song-3 , #item-4:checked ~ .cards #song-4{
  transform: translatex(0) scale(1);
  opacity: 1;
  z-index: 1;
  
  img {
    box-shadow: 0px 0px 5px 0px rgba(81, 81, 81, 0.47);
  }
}

.player {
  background-color: #fff;
  border-radius: 8px;
  min-width: 320px;
  padding: 16px 10px;
  font-family:inherit;
 
}

.upper-part {
  position: relative;
  display: flex;
  align-items: center;
  margin-bottom: 12px;
  height: 40px;
  overflow: hidden;
}

.play-icon{ 
  margin-right: 10px; 
  height: 60%;
  display: none;
}
.play-icon img{ 
 
  border-radius: 100%;
}
.song-info {
  width: calc(100% - 32px);
  display: block;
}

.song-info .title {
  color: #403d40;
  font-size: 14px;
  line-height: 24px;
}

.sub-line {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.subtitle, .time {
  font-size: 12px;
  line-height: 16px;
  color: #403d40;
}

.time {
  font-size: 15px;
  line-height: 16px;
  color: #403d40;
  font-weight: 500;
  margin-left: auto;
}

.progress-bar {
  height: 3px;
  width: 100%;
  background-color: #e9efff;
  border-radius: 2px;
  overflow: hidden;
}

.progress {
  display: block;
  position: relative;
  width: 60%;
  height: 100%;
  background-color: #2992dc;
  border-radius: 6px;
}

.info-area {
  width: 100%;
  position: absolute;
  top: 0;
  left: 30px;
  transition: transform .4s ease-in;
}

#item-2:checked ~ .player #test {
  transform: translateY(0);
}

#item-2:checked ~ .player #test  {
  transform: translateY(-40px);
}

#item-3:checked ~ .player #test  {
  transform: translateY(-80px);
}
#item-4:checked ~ .player #test  {
  transform: translatey(-120px);
}
@media (max-width: 640px){
  .cards{height: 50%;}
}
</style>

</head>
<body>
    <div class="container">
        <input type="radio" name="slider" id="item-1" checked>
        <input type="radio" name="slider" id="item-2">
        <input type="radio" name="slider" id="item-3">
        <input type="radio" name="slider" id="item-4">
      <div class="cards">
        <label class="card" for="item-1" id="song-1">
          <img src="img/fiestas/1.png" alt="song">
        </label>
        <label class="card" for="item-2" id="song-2">
          <img src="img/fiestas/2.png" alt="song">
        </label>
        <label class="card" for="item-3" id="song-3">
          <img src="img/fiestas/3.png" alt="song">
        </label>
        <label class="card" for="item-4" id="song-4">
          <img src="img/fiestas/4.png" alt="song">
        </label>
      </div>
      <div class="player">
        <div class="upper-part">
         <div class="play-icon">
          <img src="img/fiestas/cairos.png" alt="logo">
         </div>
          <div class="info-area" id="test">
            <label class="song-info" id="song-info-1">
              <div class="title">Martes 10 en Hola Habana</div>
              <div class="sub-line">
                <div class="subtitle">Cairos</div>
                <div class="time">150 cup</div>
              </div>
              
            </label>
            
            <label class="song-info" id="song-info-2">
              <div class="title">Jueves 24 LM bar</div>
              <div class="sub-line">
                <div class="subtitle">Ibiza</div>
                <div class="time">300 cup</div>
              </div>
            </label>
            <label class="song-info" id="song-info-3">
              <div class="title">Tomorrowland</div>
              <div class="sub-line">
                <div class="subtitle"></div>
                <div class="time">300 usd</div>
              </div>
            </label>
            <label class="song-info" id="song-info-4">
              <div class="title">xxx</div>
              <div class="sub-line">
                <div class="subtitle">xxx</div>
                <div class="time">xxx cup</div>
              </div>
            </label>
          </div>
        </div>
        <button type="submit" style="    border-radius: 10px;
        background-color: dodgerblue;
        color: white;
        border: white;
        height: 40%;
        margin-left: 35%;
        cursor: pointer;
        padding: 9px;
        margin-top: 5px;
        font-family:inherit"> Ir a reservar</button>
      </div>
    </div>
    <script>$('input').on('change', function() {
      $('body').toggleClass('blue');
    });
    </script>
</body>

</html>