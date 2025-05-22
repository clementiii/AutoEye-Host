<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-text">
                <h2 class="text-center mb-0">Pascal's Triangle</h2>
                <p class="text-center mb-0 mt-2">Generate Pascal's triangle where each number is the sum of the two numbers above it</p>
            </div>
            <div class="card-body">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="rows" class="form-label">Enter number of rows:</label>
                        <input type="number" class="form-control" id="rows" name="rows" required min="1" value="<?php echo isset($_POST['rows']) ? htmlspecialchars($_POST['rows']) : ''; ?>">
                        <div class="invalid-feedback">Please enter a positive number.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rows'])) {
                    $rows = intval($_POST['rows']);
                    if ($rows < 1) {
                        echo '<div class="alert alert-danger mt-3">Number must be greater than or equal to 1</div>';
                    } else {                        
                        echo '<div class="mt-4">';
                        echo '<h4>Result:</h4>';
                        echo '<div class="small mb-2">Pascal\'s Triangle with ' . $rows . ' rows (scroll to view all)</div>';
                        // Always add scrolling capability
                        echo '<div class="result-box p-3 bg-light rounded text-monospace result-scroll">';
                        
                        // Pre-calculate all values to determine maximum width needed
                        $values = [];
                        $maxLength = 1; // Track longest number length
                        
                        for ($i = 0; $i < $rows; $i++) {
                            $values[$i] = [];
                            $num = 1;
                            $values[$i][0] = $num;
                            
                            for ($j = 1; $j <= $i; $j++) {
                                $num = $num * ($i - $j + 1) / $j;
                                $values[$i][$j] = $num;
                                // Keep track of maximum number length
                                $maxLength = max($maxLength, strlen((string)$num));
                            }
                        }
                        
                        // Find the maximum width needed for each number
                        $maxDigits = 1;
                        foreach ($values as $row) {
                            foreach ($row as $value) {
                                $displayValue = $value;
                                if ($value > 999999) {
                                    $displayValue = sprintf("%.2e", $value);
                                }
                                $length = strlen((string)$displayValue);
                                $maxDigits = max($maxDigits, $length);
                            }
                        }
                        
                        // Create a plain text representation of the triangle
                        $triangle = "";
                        
                        // Add more padding to ensure consistent rendering across environments
                        $cellWidth = $maxDigits + ($maxDigits % 2 == 0 ? 5 : 4);
                        
                        for ($i = 0; $i < $rows; $i++) {
                            // Leading spaces for the triangle shape - use more spaces to ensure proper alignment
                            // Use fixed width for each level to ensure consistent spacing
                            $leadingSpaces = str_repeat(' ', ($rows - $i - 1) * ceil($cellWidth / 2));
                            $line = $leadingSpaces;
                            
                            for ($j = 0; $j <= $i; $j++) {
                                $number = $values[$i][$j];
                                
                                // Format large numbers for display
                                $displayNumber = $number;
                                if ($number > 999999) {
                                    // Use scientific notation for very large numbers
                                    $displayNumber = sprintf("%.2e", $number);
                                }
                                
                                // Center the number in its cell
                                $numLength = strlen($displayNumber);
                                $leftPad = floor(($cellWidth - $numLength) / 2);
                                $rightPad = $cellWidth - $numLength - $leftPad;
                                
                                $line .= str_repeat(' ', $leftPad) . $displayNumber . str_repeat(' ', $rightPad);
                            }
                            
                            $triangle .= $line . "\n";
                        }
                        
                        // Output the triangle as preformatted text
                        echo '<pre class="pascal-triangle-text">' . $triangle . '</pre>';
                        echo '</div></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
