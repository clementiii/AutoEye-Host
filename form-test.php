<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-text">
                <h2 class="text-center mb-0">Form Submission Test</h2>
                <p class="text-center mb-0 mt-2">This page tests if form submissions are working correctly</p>
            </div>
            <div class="card-body">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="test_input" class="form-label">Enter any text:</label>
                        <input type="text" class="form-control" id="test_input" name="test_input" required value="<?php echo isset($_POST['test_input']) ? htmlspecialchars($_POST['test_input']) : ''; ?>">
                        <div class="invalid-feedback">Please enter some text.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="test_submit">Test Submit</button>
                    </div>
                </form>

                <div class="mt-4">
                    <h4>Form Submission Diagnostics:</h4>
                    <div class="result-box p-3 rounded">
                        <?php
                        echo '<p>REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD'] . '</p>';
                        
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            echo '<p class="text-success">POST request detected ✓</p>';
                            
                            echo '<p>POST Data:</p><pre>';
                            print_r($_POST);
                            echo '</pre>';
                            
                            if (isset($_POST['test_input']) && $_POST['test_input'] !== '') {
                                echo '<p class="text-success">Input received successfully ✓</p>';
                                echo '<p>You entered: ' . htmlspecialchars($_POST['test_input']) . '</p>';
                            } else {
                                echo '<p class="text-danger">No input data received ✗</p>';
                            }
                        } else {
                            echo '<p>No form submission detected. Please submit the form.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header header-text">
                <h2 class="text-center mb-0">JavaScript Check</h2>
            </div>
            <div class="card-body">
                <div id="js-test-result">
                    JavaScript is not working! This message should be replaced if JavaScript is loading properly.
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // This will run if JavaScript is working
    document.getElementById('js-test-result').innerHTML = 
        '<p class="text-success">JavaScript is working properly! ✓</p>' + 
        '<p>Bootstrap.js Status: <span id="bootstrap-status">Checking...</span></p>';
    
    // Test if Bootstrap JavaScript is loaded
    setTimeout(function() {
        if (typeof bootstrap !== 'undefined') {
            document.getElementById('bootstrap-status').className = 'text-success';
            document.getElementById('bootstrap-status').textContent = 'Loaded successfully ✓';
        } else {
            document.getElementById('bootstrap-status').className = 'text-danger';
            document.getElementById('bootstrap-status').textContent = 'Not loaded ✗';
        }
    }, 500);
</script>
