<?php include 'includes/header.php'; ?>

<style>
.pascal-triangle-text {
    font-family: 'Consolas', 'Monaco', 'Courier New', monospace !important;
    white-space: pre !important;
    line-height: normal !important;
    font-size: 1rem !important;
    text-align: left !important; /* Explicitly align text to the left within the pre block */
    overflow-x: auto; /* Ensure scrolling if content is too wide */
}
</style>

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
                        <label for="rows" class="form-label">Enter number of rows (0 for zeroth row):</label>
                        <input type="number" class="form-control" id="rows" name="rows" required min="0" value="<?php echo isset($_POST['rows']) ? htmlspecialchars($_POST['rows']) : ''; ?>">
                        <div class="invalid-feedback">Please enter a non-negative number (0 or greater).</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rows'])) {
                    $rows = intval($_POST['rows']);
                    if ($rows < 0) {
                        echo '<div class="alert alert-danger mt-3">Number must be greater than or equal to 0</div>';
                    } else {
                        echo '<div class="mt-4">';
                        echo '<h4>Result:</h4>';
                        if ($rows == 0) {
                            echo '<div class="small mb-2">Pascal\'s Triangle with 0 rows (zeroth row)</div>';
                            echo '<div class="result-box p-3 bg-light rounded text-monospace result-scroll">';
                            echo '<pre class="pascal-triangle-text">1</pre>';
                            echo '</div></div>';
                        } else {
                            echo '<div class="small mb-2">Pascal\'s Triangle with ' . $rows . ' rows (scroll to view all)</div>';
                            echo '<div class="result-box p-3 bg-light rounded text-monospace result-scroll">';
                            // Pre-calculate all values to determine maximum width needed
                            $values = [];
                            $maxLength = 1; // Track longest number length
                            for ($i = 0; $i <= $rows; $i++) {
                                $values[$i] = [];
                                $num = 1;
                                $values[$i][0] = $num;
                                for ($j = 1; $j <= $i; $j++) {
                                    $num = $num * ($i - $j + 1) / $j;
                                    $values[$i][$j] = $num;
                                    $maxLength = max($maxLength, strlen((string)$num));
                                }
                            }
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
                            // Find the maximum width needed for any number
                            $maxNum = 1;
                            foreach ($values as $row) {
                                foreach ($row as $value) {
                                    $maxNum = max($maxNum, $value);
                                }
                            }
                            $cellWidth = strlen((string)$maxNum) + 2; // +2 for spacing, ensure it's odd for better centering if possible
                            if ($cellWidth % 2 == 0) {
                                $cellWidth++; // Make cellWidth odd for symmetrical padding
                            }

                            $triangle = "";
                            $maxRowWidth = ($rows + 1) * $cellWidth; // Total width of the last row

                            for ($i = 0; $i <= $rows; $i++) {
                                $currentRowCellCount = $i + 1;
                                $currentRowWidth = $currentRowCellCount * $cellWidth;
                                $leadingSpacesCount = floor(($maxRowWidth - $currentRowWidth) / 2);
                                
                                $line = str_repeat(' ', $leadingSpacesCount);
                                
                                for ($j = 0; $j <= $i; $j++) {
                                    $number = $values[$i][$j];
                                    $numStr = strval($number);
                                    // Center each number in its cell
                                    $padTotal = $cellWidth - strlen($numStr);
                                    $padLeft = floor($padTotal / 2);
                                    $padRight = ceil($padTotal / 2);
                                    $line .= str_repeat(' ', $padLeft) . $numStr . str_repeat(' ', $padRight);
                                }
                                $triangle .= $line . "\n"; // Keep the newline for preformatted text
                            }
                            echo '<pre class="pascal-triangle-text">' . $triangle . '</pre>';
                            echo '</div></div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
