<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-text">
                <h2 class="text-center mb-0">PHP Function and Extension Diagnostics</h2>
                <p class="text-center mb-0 mt-2">This page tests PHP functions and extensions that might affect your algorithms</p>
            </div>
            <div class="card-body">
                <h4>PHP Version Information</h4>
                <div class="result-box p-3 rounded mb-4">
                    <p>PHP Version: <?php echo phpversion(); ?></p>
                </div>

                <h4>BCMath Extension Check</h4>
                <div class="result-box p-3 rounded mb-4">
                    <p>BCMath Extension: <?php echo extension_loaded('bcmath') ? '<span class="text-success">Enabled ✓</span>' : '<span class="text-danger">Disabled ✗</span>'; ?></p>
                    <?php if (extension_loaded('bcmath')): ?>
                        <p>Testing bcadd(): 1 + 2 = <?php echo bcadd('1', '2'); ?></p>
                    <?php else: ?>
                        <p>BCMath extension is not available. The modified algorithms now use standard PHP addition instead.</p>
                    <?php endif; ?>
                </div>

                <h4>Form Submission Test</h4>
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="test_num" class="form-label">Enter a number:</label>
                        <input type="number" class="form-control" id="test_num" name="test_num" required min="1" value="<?php echo isset($_POST['test_num']) ? htmlspecialchars($_POST['test_num']) : ''; ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Test Submit</button>
                    </div>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['test_num'])) {
                    $num = intval($_POST['test_num']);
                    echo '<div class="mt-4">';
                    echo '<h4>Form Test Result:</h4>';
                    echo '<div class="result-box p-3 rounded">';
                    echo 'Received number: ' . $num . '<br>';
                    echo 'Number + 10: ' . ($num + 10) . '<br>';
                    echo '</div></div>';
                }
                ?>

                <h4 class="mt-4">Error Reporting Settings</h4>
                <div class="result-box p-3 rounded">
                    <p>Display Errors: <?php echo ini_get('display_errors') ? 'On' : 'Off'; ?></p>
                    <p>Error Reporting Level: <?php echo ini_get('error_reporting'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
