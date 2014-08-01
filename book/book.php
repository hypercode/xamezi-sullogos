<?php
  include("../php_library/session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Βιβλιοθήκη</title>

<link href="../css/site.css" type="text/css" rel="stylesheet"/>
<link href="css/book.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="../javascript/jquery-1.8.3.js"></script>
<script type="text/javascript" src="../plugins/PDFreader/pdfobject.js"></script>
<script type="text/javascript">
      window.onload = function (){
        var myPDF = new PDFObject({ url: "books/sample.pdf" }).embed("pdf");
		$windowHeight=$(document).height()-50;
		$("#pdf").css({"height":$windowHeight});
      };
</script>
</head>

<body>
</body>
  <div id="pdf">
  </div>

</html>