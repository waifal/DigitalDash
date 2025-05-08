<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
    <script src="../../js/scripts.js" type="module"></script>
<?php else: ?>
    <script src="../js/scripts.js" type="module"></script>
<?php endif;?>
</body>

</html>