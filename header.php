<?php

require_once 'backend/config.php'; ?>


<header>
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <nav>
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/logs/index.php">Logs</a>
        </nav>

        <div style="display: flex; gap: 10px; align-items: center;">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="<?php echo $base_url; ?>/login.php">Inloggen</a>
                <a href="<?php echo $base_url; ?>/register.php">registreren</a>
            <?php else: ?>
                <span>Hallo <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a>
            <?php endif; ?>
        </div>
    </div>
</header>
