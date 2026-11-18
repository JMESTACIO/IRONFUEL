<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

require 'products.php';

// form values
$name = trim($_POST['customer_name'] ?? '');
$age = filter_var($_POST['age'] ?? null, FILTER_VALIDATE_INT);
$type = $_POST['customer_type'] ?? '';
$goalKey = $_POST['goal'] ?? '';
$mealCode = $_POST['meal'] ?? '';
$extraCode = $_POST['extra'] ?? 'none';
$suppCode = $_POST['supplement'] ?? 'none';
$quantity = filter_var($_POST['quantity'] ?? null, FILTER_VALIDATE_INT);
$budget = filter_var($_POST['budget'] ?? null, FILTER_VALIDATE_FLOAT);

// validation with logical operators
$valid = $name !== ''
    && $age !== false && $age >= 12 && $age <= 90
    && in_array($type, ['member', 'student', 'senior', 'guest'])
    && isset($goals[$goalKey])
    && isset($products[$mealCode]) && $products[$mealCode]["category"] == "Meals"
    && ($extraCode == 'none' || (isset($products[$extraCode]) && in_array($products[$extraCode]["category"], ["Shakes", "Snacks"])))
    && ($suppCode == 'none' || (isset($products[$suppCode]) && $products[$suppCode]["category"] == "Supplements"))
    && $quantity !== false && $quantity >= 1 && $quantity <= 10
    && $budget !== false && $budget >= 0;

if (!$valid) {
    include 'header.php';
    echo '<h2>Order Failed</h2>';
    echo '<p class="error">Invalid order. Please check your input.</p>';
    echo '<a href="index.php">Back to menu</a>';
    include 'footer.php';
    exit;
}

// pre-workout has caffeine, not for under 18
if ($age < 18 && $suppCode == "SU5") {
    include 'header.php';
    echo '<h2>Order Failed</h2>';
    echo '<p class="error">Pre-workout is for 18 and up only.</p>';
    echo '<p>Try BCAA or Fish Oil instead.</p>';
    echo '<a href="index.php">Back to menu</a>';
    include 'footer.php';
    exit;
}

// age group using if...elseif
if ($age < 18) {
    $ageGroup = "Teen";
    $ageTip = "Whole food first. Ask a parent, coach or doctor before using supplements.";
} elseif ($age < 50) {
    $ageGroup = "Adult";
    $ageTip = "Stay consistent with your training, meals and sleep.";
} else {
    $ageGroup = "50 and up";
    $ageTip = "Spread your protein through the day, keep lifting and don't skip calcium and vitamin D.";
}

// the items picked for ONE set
$chosen = [$mealCode];
if ($extraCode != 'none') {
    $chosen[] = $extraCode;
}
if ($suppCode != 'none') {
    $chosen[] = $suppCode;
}

// stock check and set totals (foreach)
$setPrice = 0;
$setProtein = 0;
$setCarbs = 0;
$setCal = 0;
$names = [];
$stockError = "";

foreach ($chosen as $code) {
    $p = $products[$code];
    if ($quantity > $p["stock"]) {
        $stockError = $p["name"] . " (only " . $p["stock"] . " left)";
        break;
    }
    $setPrice += $p["price"];
    $setProtein += $p["protein"];
    $setCarbs += $p["carbs"];
    $setCal += $p["cal"];
    $names[] = $p["name"];
}

if ($stockError != "") {
    include 'header.php';
    echo '<h2>Order Failed</h2>';
    echo '<p class="error">Not enough stock!</p>';
    echo '<p>' . $stockError . '</p>';
    echo '<a href="index.php">Back to menu</a>';
    include 'footer.php';
    exit;
}

// match: discount by customer type
$rate = match ($type) {
    'member'  => 0.10,
    'student' => 0.05,
    'senior'  => 0.20,
    default   => 0,
};

// math operators
$subtotal = $setPrice * $quantity;
$discount = $subtotal * $rate;
$total = $subtotal - $discount;

$goal = $goals[$goalKey];
$percent = ($setProtein / $goal["protein"]) * 100;
$barWidth = ($percent > 100) ? 100 : round($percent);

include 'header.php';
echo '<h2>Order Receipt</h2>';
echo '<p>Athlete: ' . htmlspecialchars($name) . ' (' . $age . ' yrs, ' . $ageGroup . ')</p>';
echo '<p>Customer type: ' . ucfirst($type) . ' | Goal: ' . $goal["label"] . '</p>';

echo '<h3>Sets Ordered</h3>';
echo '<table><tr><th>Set</th><th>Items</th><th>Price</th></tr>';
for ($i = 1; $i <= $quantity; $i++) {
    echo '<tr><td>' . $i . '</td><td>' . implode(" + ", $names) . '</td><td>PHP ' . number_format($setPrice, 2) . '</td></tr>';
}
echo '</table>';

echo '<p>Subtotal: PHP ' . number_format($subtotal, 2) . '</p>';
echo '<p>Discount: PHP ' . number_format($discount, 2) . '</p>';
echo '<h2>Total: PHP ' . number_format($total, 2) . '</h2>';
echo '<p>Budget: PHP ' . number_format($budget, 2) . '</p>';

if ($budget >= $total) {
    echo '<p class="success">Budget is sufficient!</p>';
    echo '<p>Change: PHP ' . number_format($budget - $total, 2) . '</p>';
} else {
    echo '<p class="error">Insufficient budget!</p>';
    echo '<p>Short by: PHP ' . number_format($total - $budget, 2) . '</p>';
}

// macro check (per set)
echo '<h3>Macro Check (per set)</h3>';
echo '<p>Protein: ' . $setProtein . 'g | Carbs: ' . $setCarbs . 'g | Calories: ' . $setCal . '</p>';
echo '<p>' . $goal["label"] . ' target: ' . $goal["protein"] . 'g protein, ' . $goal["calMin"] . '-' . $goal["calMax"] . ' cal</p>';
echo '<div class="bar"><div style="width: ' . $barWidth . '%"></div></div>';

if ($setProtein >= $goal["protein"]) {
    echo '<p class="success">Protein goal reached!</p>';
} elseif ($setProtein >= $goal["protein"] / 2) {
    echo '<p class="low">Almost there, add a shake or snack for more protein.</p>';
} else {
    echo '<p class="error">Not enough protein for your goal.</p>';
}

if ($setCal < $goal["calMin"]) {
    echo '<p class="low">Calories are a bit low for ' . $goal["label"] . '.</p>';
} elseif ($setCal > $goal["calMax"]) {
    echo '<p class="low">Calories are a bit high for ' . $goal["label"] . '.</p>';
} else {
    echo '<p class="success">Calories are on target!</p>';
}

echo '<h3>Tip for ' . $ageGroup . '</h3>';
echo '<p class="box">' . $ageTip . '</p>';

// while loop for preparing the order
echo '<h3>Prep Status</h3>';
$counter = 1;
while ($counter <= $quantity) {
    echo '<p>Prepping set ' . $counter . ' of ' . $quantity . '...</p>';
    $counter++;
}

echo '<p>Thank you for buying! Keep grinding!</p>';
echo '<p><a href="index.php">New order</a></p>';
include 'footer.php';
?>
