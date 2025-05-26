<?php include 'includes/header.php'; ?>



<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-text">
                <h2 class="text-center mb-0">Collatz Calculator</h2>
                <p class="text-center mb-0 mt-2">Explore the sequence that always reaches 1: divide by 2 if even, multiply by 3 and add 1 if odd</p>
            </div>
            <div class="card-body">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="number" class="form-label">Enter a positive odd integer:</label>
                        <input type="number" class="form-control" id="number" name="number" required min="1" step="2" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>">
                        <div class="invalid-feedback">Please enter a positive odd integer.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Calculate</button>
                    </div>
                </form>
                
                <script>
                document.getElementById('number').addEventListener('input', function() {
                    const value = parseInt(this.value);
                    if (value && value % 2 === 0) {
                        this.setCustomValidity('Please enter an odd number');
                    } else {
                        this.setCustomValidity('');
                    }
                });
                </script>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['number'])) {
                    $n = intval($_POST['number']);
                    if ($n <= 0) {
                        echo '<div class="alert alert-danger mt-3">Number must be positive</div>';
                    } elseif ($n % 2 == 0) {
                        echo '<div class="alert alert-danger mt-3">Number must be odd</div>';
                    } else {
                        $sequence = array();
                        $count = 0;
                        $currentNumber = $n;
                        
                        // Start with the initial number
                        $sequence[] = $currentNumber;
                        
                        while ($currentNumber !== 1) {
                            if ($currentNumber % 2 == 0) {
                                $currentNumber = $currentNumber / 2;
                            } else {
                                $currentNumber = 3 * $currentNumber + 1;
                            }
                            $sequence[] = $currentNumber;
                            $count++;
                        }
                        
                        echo '<div class="mt-4">';
                        echo '<div class="result-box p-4 bg-light rounded text-center">';
                        echo '<h4 class="mb-3">Starting Number: ' . $n . '</h4>';
                        echo '<h5 class="mb-3">Collatz Sequence:</h5>';
                        echo '<p class="mb-4 fs-5">' . implode(', ', $sequence) . '</p>';
                        echo '<h5 class="mb-3">Steps:</h5>';
                        
                        // Show step-by-step breakdown
                        echo '<div class="text-start">';
                        $currentNumber = $n;
                        for ($i = 0; $i < count($sequence) - 1; $i++) {
                            $currentNumber = $sequence[$i];
                            $nextNumber = $sequence[$i + 1];
                            
                            if ($currentNumber % 2 == 0) {
                                echo '<p class="mb-1">' . $currentNumber . ' → even → ' . $currentNumber . ' / 2 = ' . $nextNumber . '</p>';
                            } else {
                                echo '<p class="mb-1">' . $currentNumber . ' → odd → 3 * ' . $currentNumber . ' + 1 = ' . $nextNumber . '</p>';
                            }
                        }
                        echo '</div>';
                        
                        echo '</div></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
