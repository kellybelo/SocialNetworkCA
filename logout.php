<!-- Kelly Domingues 2014243 -->
<?php

echo 'Logged out!';

session_unset();

session_destroy();


?>

<script>
window.location="index.php";
</script>