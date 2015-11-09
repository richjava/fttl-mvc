<?php if ($flashes): ?>
    <ul id="flashes">
        <?php foreach ($flashes as $flash): ?>
            <li><?php echo $flash; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

