<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}
.brand{
    font-size: 25px;
}

.sidenav {
  height: 100%;
  width: 150px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #dbdbdb;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 15px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav">
    <br>
    <br>
    <br>
    <a href="indexCPU.php">CPU</a>
    <a href="indexMB.php">Mainboard</a>
    <a href="indexGPU.php">GPU</a>
    <a href="indexRAM.php">RAM</a>
    <a href="indexSR.php">Storage</a>
    <a href="indexMonitor.php">Monitor</a>
    <a href="indexPSU.php">Power Supply</a>
    <a href="indexCase.php">Case</a>
</div>
   
</body>
</html> 
