<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Saint Louis University COMELEC</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>
<style type="text/css">
  * {
  margin: 0;
  padding: 0;
}

html, body {
  height: 100%;
}

main {
  min-height: 100%;
}

#container {
  overflow: auto;
}

footer{
  position: relative;
  clear: both;
}

input[type="radio"] {
  display: none;
}
input[type="radio"]:not(:disabled) ~ label {
  cursor: pointer;
}
input[type="radio"]:disabled ~ label {
  color: #00C851
  border-color: #00C851
  box-shadow: none;
}

label {
  display: block;
  background: white;
  border: 1px solid #20df80;
  text-align: center;
  box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
  position: relative;
}

input[type="radio"]:checked + label{
  background: #00C851;
  color: white;
}
input[type="radio"]:checked + label::after {
  color: #3d3f43;
  font-family: 'Font Awesome\ 5 Free';
  border: 2px solid #1dc973;
  content: "\f00c";
  font-size: 24px;
  position: absolute;
  top: -25px;
  left: 70%;
  transform: translateX(-400%);
  height: 50px;
  width: 50px;
  line-height: 50px;
  text-align: center;
  border-radius: 50%;
  background: white;
  box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
  font-weight: 900;
}
.voteMe {
  display:block;
  cursor:pointer;
}

.h5 {
    position: absolute;
    bottom: 0;
    width: 100%;
}

</style>
