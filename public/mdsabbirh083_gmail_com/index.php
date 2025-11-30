<?php
// Get x and y from URL parameters
$x = $_GET['x'] ?? '';
$y = $_GET['y'] ?? '';

// Validate: must be non-empty digits
if (!preg_match('/^\d+$/', $x) || !preg_match('/^\d+$/', $y)) {
    die("NaN");
}

try {
    $f_num = gmp_init($x);
    $s_num = gmp_init($y);

    // LCM(0,0) is undefined
    if (gmp_cmp($f_num, 0) === 0 && gmp_cmp($s_num, 0) === 0) {
        throw new Exception("NaN");
    }

    // GCD
    $gcd = gmp_gcd($f_num, $s_num);

    // LCM = (x * y) / GCD
    $lcm = gmp_div_q(gmp_mul($f_num, $s_num), $gcd);

    // Output as plain string
    echo gmp_strval($lcm);

} catch (Exception $e) {
    echo "NaN";
}
