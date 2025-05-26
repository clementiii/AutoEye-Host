<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-text">
                <h2 class="text-center mb-0">GCD Calculator</h2>
                <p class="text-center text-muted mb-0 mt-2">Find the Greatest Common Divisor using Euclidean algorithm</p>
            </div>
            <div class="card-body">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="first" class="form-label">First Number:</label>
                        <input type="number" class="form-control" id="first" name="first" required min="1" value="<?php echo isset($_POST['first']) ? htmlspecialchars($_POST['first']) : ''; ?>">
                        <div class="invalid-feedback">Please enter a positive integer.</div>
                    </div>
                    <div class="mb-3">
                        <label for="second" class="form-label">Second Number:</label>
                        <input type="number" class="form-control" id="second" name="second" required min="1" value="<?php echo isset($_POST['second']) ? htmlspecialchars($_POST['second']) : ''; ?>">
                        <div class="invalid-feedback">Please enter a positive integer.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Calculate GCD</button>
                    </div>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['first']) && isset($_POST['second'])) {
                    $originalA = intval($_POST['first']);
                    $originalB = intval($_POST['second']);
                    
                    if ($originalA <= 0 || $originalB <= 0) {
                        echo '<div class="alert alert-danger mt-3">Both numbers must be positive integers.</div>';
                    } elseif ($originalA == $originalB) {
                        echo '<div class="alert alert-danger mt-3">The two numbers must not be equal.</div>';
                    } else {
                        $iter_a = $originalA;
                        $iter_b = $originalB;
                        
                        echo '<div class="mt-4">';
                        echo '<h4>Result:</h4>';
                        echo '<div class="result-box p-3 bg-light rounded">';
                        echo '<p class="mb-2">Euclidean Algorithm Steps:</p>';
                        echo '<p class="mb-2">Finding GCD of ' . htmlspecialchars($originalA) . ' and ' . htmlspecialchars($originalB) . ':</p>';
                        
                        while ($iter_b != 0) {
                            $x_val = max($iter_a, $iter_b);
                            $y_val = min($iter_a, $iter_b);
                            
                            // Given $originalA, $originalB > 0, $y_val will be > 0 in the first iteration.
                            // In subsequent iterations, $iter_a = previous $y_val (>0)$ and $iter_b = previous $r (>=0)$.
                            // The loop condition `while ($iter_b != 0)` ensures that when we use $y_val$ as a divisor,
                            // which is min($iter_a, $iter_b$), it won't be zero unless $iter_b$ itself is zero (caught by loop)
                            // or $iter_a$ is zero (which means previous $y_val$ was zero, impossible if inputs were positive).
                            // Thus, $y_val$ in $x_val / y_val$ will be positive.
                            $q = floor($x_val / $y_val);
                            $r = $x_val % $y_val;
                            
                            echo htmlspecialchars($x_val) . ' = ' . htmlspecialchars($y_val) . ' * ' . htmlspecialchars($q) . ' + ' . htmlspecialchars($r) . '<br>';
                            
                            $iter_a = $y_val;
                            $iter_b = $r;
                        }
                        
                        $gcd_result = $iter_a; // When $iter_b is 0, $iter_a holds the GCD
                        
                        echo '<p class="mt-3 mb-0">Result: gcd(' . htmlspecialchars($originalA) . ', ' . htmlspecialchars($originalB) . ') = ' . htmlspecialchars($gcd_result) . '</p>';
                        echo '</div></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
